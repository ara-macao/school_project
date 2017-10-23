<!DOCTYPE HTML>
<?php
/*! \file engine.php
 *  \brief Internal library for handling backend logic & communicating with the database in a safe way.
 *  engine.php provides an OOP based abstraction layer for communicating with the database.
 */

/*!
 * Returns PDO object used by the API itself.
 */
echo '<pre>';
function getPDO() {
    $host = '127.0.0.1';
    $db = 'ffxivmarket';
    $user = 'ffxivmarket';
    $pass = 'QEzeHar3zufjxl65';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $opt = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
    return new PDO($dsn, $user, $pass, $opt);
}

//! Functions class, contains commonly used functions used by other classes.
/*! 
 * Functions provide commonly used functions used by most Classes.
 */
class Functions {

    //! Verifies token provided, returns a non 0 value (account_id) when token is valid and not expired.
    protected function verifyToken($token /*!< Instance of the Token class */) {
        $PDO = getPDO();
        $stmt = $PDO->prepare('SELECT * FROM api_token WHERE token = ?;');
        $stmt->execute([$token->value]);
        $res = $stmt->fetch();
        if (!$res) {
            return 0;
        } else {
            if (time() < strtotime($res['expiration_date'])) {
                return $res['account_id'];
            }else {
                return 0;
            }

        }
    }
    //! Verifies token provided, returns an object with all relevant account data
    protected function getUserData($token /*!< Instance of the Token class */) {
        $account_id = $this->verifyToken($token);
        if($account_id) {
            $PDO = getPDO();
            $stmt = $PDO->prepare('SELECT * FROM account join account_info on account.account_id = account_info.account_id where account.account_id = ?;');
            $stmt->execute([$account_id]);
            return $stmt->fetch();
        }
    }

}

//! Token class, generates a token upon supplying a correct combination of user credentials.
/*!Filters input and looks up the username password combination.
 * Generates a token when provided with correct credentials. 
 * This token is used to interact with all privileged parts of the API.
 */
class Token {

    public $error = NULL; /*!< Result of the operation, will be NULL on succesful operation, containers string with error message if something went wrong. */
    public $value = NULL; /*!< Text representation of the token, will be NULL when verification failed */
    public $valid = NULL; /*!< Contains a Date object containing the exact date & time the token stops being valid (default 24 hours), will be NULL when verification failed */

    //! Token constructor function, when instantiating this class you are required to supply 2 parameters.
    function __construct($username /* !< The username of the user, does not need filtering */, $password /* !< The password of the user, does not need filtering */) {
        if (!preg_match('/^\w{1,32}$/', $username)) {

            $this->error = "Username or password does not match.";
            return;
        }
        $PDO = getPDO();
        $stmt = $PDO->prepare('SELECT * FROM account WHERE username = ?;');
        $stmt->execute([$username]);
        $res = $stmt->fetch();
        if (!$res) {
            $this->error = "Username or password does not match.";
            return;
        }
        if (!password_verify($password, $res['password_hashed'])) {
            $this->error = "Username or password does not match.";
            return;
        }
        // insert or update the API token.
        $this->value = uniqid();
        $stmt = $PDO->prepare("INSERT INTO api_token VALUES(?, ?, FROM_UNIXTIME(?)) ON DUPLICATE KEY UPDATE token = ?, expiration_date = FROM_UNIXTIME(?);");
        $stmt->execute([$res['account_id'], $this->value, time() + 86400, $this->value, time() + 86400]);
        
        // update last login value of the user account
        $stmt = $PDO->prepare("UPDATE account SET last_login = FROM_UNIXTIME(?) WHERE account_id = ?;");
        $stmt->execute([time(), $res['account_id']]);
    }

}

//! User class, generates an User object when provided with a valid Token of said user
/*! 
 * Creates an object with useful information of a user, provides functions to aid management of said user account. Implements Functions.
 */
class User extends Functions {

    public $error = NULL; /*!< Result of the operation, will be NULL on succesful operation, containers string with error message if something went wrong. */
    public $accountId = NULL; /*!< account_id, unique for every account. */
    public $username = NULL; /*!< login name of the user account. */
    public $lastLogin = NULL; /*!< last time (Datetime object) the user has logged in. */
    public $isAdmin = NULL; /*!< last time the user has logged in. */
    public $emailAddress = NULL; /*!< contains RFC 822 compliant email address of the user. */
    public $accountCreationDate = NULL; /*!< time and date (Datetime object) when the user account has been created. */
    //! User constructor, populates members of this class with information regarding an user account
    function __construct($token /*!< Valid instance of the Token class. */) {
        // verify token
        $user = $this->verifyToken($token);
        if($user === 0) {
            $error = "Invalid Token!";
            return;
        }
        // fetch user information.
        $userData = $this->getUserData($token);
        if(!$userData) {
            $error = "Invalid user data!";
            return;
        }
        $date = new DateTime();
        $this->accountId = $userData['account_id'];
        $this->username = $userData['username'];
        $this->lastLogin = $date->setTimestamp(strtotime($userData['last_login']));
        $this->isAdmin = $userData['is_admin'];
        $this->emailAddress = $userData['email_address'];
        $date = new DateTime();
        $this->accountCreationDate = $date->setTimestamp(strtotime($userData['account_creation_date']));
    }
    //! Creates a challenge (verification key) which will be used for verifying a new lodestone character, this challenge is valid for 600 seconds (10 minutes)
    public function newCharacterChallenge() {
        $challenge = "ffxiv.market:".uniqid();
        $PDO = getPDO();
        $stmt = $PDO->prepare('INSERT INTO character_verification_token '
                . 'VALUES(?, ?, FROM_UNIXTIME(?), FROM_UNIXTIME(?)) '
                . 'ON DUPLICATE KEY UPDATE challenge = ?, creation_date = FROM_UNIXTIME(?), expiry_date = FROM_UNIXTIME(?);');
        $stmt->execute([$this->accountId, $challenge, time(), time() + 600, $challenge, time(), time() + 600]);
        return $challenge;
    }
    //! Verifies the created character challenge by scraping the target lodestone page, returns TRUE when the character has been succesfully verified and added and FALSE when verification has failed.
    public function verifyCharacterChallenge($lodestone_url /*!< lodestone URL of the character wishing to be verified e.g.: https://eu.finalfantasyxiv.com/lodestone/character/18770557/ */) {
        preg_match('/lodestone\/character\/(\d+)/',$lodestone_url , $match);
        if(!$match) {
            return false;
        }
        $PDO = getPDO();
        $stmt = $PDO->prepare('SELECT challenge FROM character_verification_token WHERE account_id = ? ' /*.' AND expiry_date < UNIX_TIMESTAMP(?)'*/);
        $stmt->execute([$this->accountId/*,time()*/]);
        $res = $stmt->fetch();
        if(!$res) {
            return false;
        }
        // is rate limiting necessary?
        $scrape = file_get_contents("https://eu.finalfantasyxiv.com/lodestone/character/".$match[1]."/");
        if(!preg_match('/'.str_replace('.','\.',$res['challenge']).'/',$scrape)){
            return fail;
        }else {
            /*
             * TODO:
             * Extract relevant information from this scrape.
             */
            
        }
        
    }
    
    

}

//$token = new Token($_GET['user'], $_GET['pass']);
//$user = new User($token);
//var_dump($user->newCharacterChallenge());
//$challenge = $user->verifyCharacterChallenge("https://eu.finalfantasyxiv.com/lodestone/character/18770557/");