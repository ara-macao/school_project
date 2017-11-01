<?php
/*! \file engine.php
 *  \brief Internal library for handling backend logic & communicating with the database in a safe way.
 *  engine.php provides an OOP based abstraction layer for communicating with the database.
 */

include_once "listingmanager.php";

/*!
 * Returns PDO object used by the API itself.
 */
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
    function verifyToken($token /*!< Instance of the Token class */) {
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
    function getUserData($token /*!< Instance of the Token class */) {
        $account_id = $this->verifyToken($token);
        if($account_id) {
            $PDO = getPDO();
            $stmt = $PDO->prepare('SELECT * FROM account join account_info on account.account_id = account_info.account_id where account.account_id = ?;');
            $stmt->execute([$account_id]);
            return $stmt->fetch();
        }
    }
    //! return true when username already exists in the database.
    function usernameExists($username) {
        $PDO = getPDO();
        $stmt = $PDO->prepare('SELECT * FROM account WHERE username = ?;');
        $stmt->execute([$username]);
        $res = $stmt->fetch();
        if($res) {
            return true;
        }else {
            return false;
        }
    }
    //! Get array with servers.
    public function getServerList() {
        $PDO = getPDO();
        $stmt = $PDO->prepare('SELECT * FROM server WHERE 1 ORDER BY id;');
        $res = $stmt->execute();
        return $stmt->fetchAll();
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
            $this->error = "Password does not match.";
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
    //! Populate user struct by using a Token
    function getUser($token /*!< Valid instance of the Token class. */) {
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
    //! Create new user, true when succesful, string with reason when it failed
    function createUser($username /*!< Requested username */, $email /*!< User email address */, $password /*!< User password */, $passwordAgain /*!< User password again*/) {
        if($this->userNameExists($username)) {
            return "Username is not available.";
        }else if(strlen($password) < 6 ) {
            return "Password is too short.";
        }else if($password !== $passwordAgain) {
            return "Passwords do not match.";
        }else {
            if(!preg_match('/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD', $email)) {
                return "Invalid email address.";
            }
            $PDO = getPDO();
            $stmt = $PDO->prepare('INSERT INTO account(is_admin, username, password_hashed, last_login) VALUES(?, ?, ?, FROM_UNIXTIME(?));');
            $stmt->execute([0, $username, password_hash($password, PASSWORD_BCRYPT), 0]);
            $stmt = $PDO->prepare('SELECT account_id FROM account WHERE username = ?');
            $stmt->execute([$username]);
            $res = $stmt->fetch();
            $stmt = $PDO->prepare('INSERT into account_info VALUES(?, ?, FROM_UNIXTIME(?));');
            $stmt->execute([$res['account_id'], $email, time()]);
            return true;
        }
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
    //! Verifies the created character challenge by scraping the target lodestone page, returns TRUE when the character has been succesfully verified and added and string with error when failed.
    public function verifyCharacterChallenge($lodestone_url /*!< lodestone URL of the character wishing to be verified e.g.: https://eu.finalfantasyxiv.com/lodestone/character/18770557/ */) {
        preg_match('/lodestone\/character\/(\d+)/',$lodestone_url , $match);
        if(!$match) {
            return "Invalid character URL!";
        }
        $PDO = getPDO();
        // check of character is already linked
        $check = $PDO->prepare('SELECT * FROM `character` WHERE lodestone_character_id = ?;');
        $check->execute([$match[1]]);
        if($check->fetch()){
            // character already exists.
            return "Character is already linked to an account!";
        }

        $stmt = $PDO->prepare('SELECT challenge FROM character_verification_token WHERE account_id = ? ' /*.' AND expiry_date < UNIX_TIMESTAMP(?)'*/);
        $stmt->execute([$this->accountId/*,time()*/]);
        $res = $stmt->fetch();
        if(!$res) {
            return "Challenge expired, please try again.";
        }
        // is rate limiting necessary?
        $scrape = file_get_contents("https://eu.finalfantasyxiv.com/lodestone/character/".$match[1]."/");
        if(!preg_match('/'.str_replace('.','\.',$res['challenge']).'/',$scrape)){
            return "Failed to acquire character information.";
        }else {
            /*
             * Extract character name, avatar and server.
             */
            $unameRegex = '/__chara__name">(.+?)(?=<\/p>)/';
            $serverRegex = '/__chara__world">(.+?)(?=<\/p>)/';
            $userImageRegex = '/chara__face">[\s\S]+?(?=")"(\S+)\?\d+"/';
            preg_match($unameRegex, $scrape, $characterName);
            preg_match($serverRegex, $scrape, $characterServer);
            preg_match($userImageRegex, $scrape, $characterImage);
            // fetch server id from name
            $PDO = getPDO();
            $stmt = $PDO->prepare('SELECT id FROM server WHERE server = ? ');
            $stmt->execute([$characterServer[1]]);
            $res = $stmt->fetch();
            if(!$res) {
                error_log("Server not found in database: ".$characterServer[1],0);
                return "Unknown error has occurred";
            }
            // insert user into database
            $stmt = $PDO->prepare('INSERT INTO `character` VALUES(?, ?, ?, ?, ?);');
            $stmt->execute([$match[1], $this->accountId, $characterName[1], $res['id'], $characterImage[1]]);
            return true;
        }

    }
    //! forces password update without verifying the account. I hope you are using this for good and not evil. Takes 2 arguments.
    public function forcePasswordReset( $newPassword /*!< new password */, $newPasswordVerification /*!< new password again */) {
        if(strlen($newPassword) > 1 && $newPassword === $newPasswordVerification) {
            $newHash = password_hash($newPassword, PASSWORD_BCRYPT);
            $stmt = $PDO->prepare('UPDATE account SET password_hashed = ? WHERE account_id = ?;');
            $stmt->execute([$newHash, $this->accountId]);
        }

    }
    //! Verify password if necessary, returns a string containing an error if failed or true when succesful.
    public function changePassword($currentPassword /*!< current password of the user */, $newPassword /*!< new password */, $newPasswordVerification /*!< new password again */) {
        $PDO = getPDO();
        $stmt = $PDO->prepare('SELECT * FROM account WHERE account_id = ?;');
        $stmt->execute([$this->accountId]);
        $res = $stmt->fetch();
        if(password_verify($currentPassword, $res['password_hashed'])) {
            // at least the password isn't empty
            if(strlen($newPassword) > 1 && $newPassword === $newPasswordVerification) {
                $newHash = password_hash($newPassword, PASSWORD_BCRYPT);
                $stmt = $PDO->prepare('UPDATE account SET password_hashed = ? WHERE account_id = ?;');
                $stmt->execute([$newHash, $this->accountId]);
                return true;
            }else {
                return "Password does not match/Does not meet password requirements";
            }
        }else {
            return "Password does not match";
        }
    }
}

class Character {
    public $lodestone_character_id;
    public $character_name;
    public $character_server_id;
    public $character_server_name;
    public $character_avatar_url;
    
    
}