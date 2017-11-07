<?php
/*! \file /api/index.php
 *  \brief public API
 *  Clients use this to request data in a safe and responsible manner.
 */

include_once "engine.php";
include_once "listingmanager.php";
session_start();

//! Messageclass, used to encourage a standardized API output
/*!Takes one mandatory argument with 2 optionals.
 */
Class Message{
    public $error;
    public $message;    /*!< login name of the user account. */
    public $data;       /*!< Additional optional data if necessary. */
    //! Automatically populate Message struct
    function __construct($error /*!< is true when an error occured. */,$message = NULL /*!< Notification message */, $data = NULL /*!< Additional optional data, associative array */){
        $this->error = $error;
        $this->message = $message;
        $this->data = $data;
    }
}

//! Takes a Message object, serializes it, prints it and stops execution.
function returnMessage($message /*!< Instance of the Message class. */){
    echo json_encode($message);
    die();
}

// becomes $_POST in production.
switch($_GET['action']) {

    case "login":
      $token = new Token($_POST['username'], $_POST['password']);
      if($token->error == NULL) {
        $_SESSION['token'] = $token;
        returnMessage(new Message(false));
      }else {
        returnMessage(new Message(true, $token->error));
      }
      break;

    case "changePassword":
      if(array_key_exists('token', $_SESSION)) {
        //NOTE Changed array_key_exists to isset because array_key_exists demands two variables: key, value.
        if(isset($_POST['currentPassword']) && isset($_POST['newPassword']) && isset($_POST['newPasswordAgain'])) {
          $token = $_SESSION['token'];
          $user = new User();
          $user->getUser($token);
          $result = $user->changePassword($_POST['currentPassword'], $_POST['newPassword'], $_POST['newPasswordAgain']);
          if($result === true) {
            returnMessage(new Message(false, "Successfully updated your password."));
          }else {
            returnMessage(new Message(true, $result));
          }
        }else {
          returnMessage(new Message(true, "Missing parameters"));
        }
      }else {
        returnMessage(new Message(true, "Operation not authorized."));
      }
      break;

    case "createAccount":
      $username = $_POST['username'];
      $email = $_POST['mail'];
      $password = $_POST['password'];
      $verpassword = $_POST['verpassword'];
      $user = new User();

      $result = $user->createUser($username, $email, $password, $verpassword);

      if($result === true){
        returnMessage(new Message(false, "Acount succesfully created!"));
      }else{
        returnMessage(new Message(true, $result));
      }
      // to-do give back $result message
      break;

    case "checkUser":
      $username = $_POST['username'];
      $user = new User();
      $result = $user->usernameExists($username);

      if($result){
        returnMessage(new Message(true, "Username not valid!"));
      }else{
        returnMessage(new Message(false, $username));
      }
      break;

    case "getServerList":
      $func = new Functions();
      returnMessage(new Message(false, NULL,$func->getServerList()));
      break;

    case "logout":
      if(array_key_exists('token', $_SESSION)) {
        $user = new User();
        $user->logOut($_SESSION['token']);
        returnMessage(new Message(false));
      }else {
        returnMessage(new Message(true, "Not logged in!"));
      }
      break;

    case "deleteAccount":
     if(array_key_exists('token', $_SESSION)) {
        $user = new User();
        $user->deleteAccount($token);
        returnMessage(new Message(false));
      }else {
        returnMessage(new Message(true, "Not logged in!"));
      }
      break;

    case 'getListings':
      $isBuying = isset($_POST['isbuying']) ? $_POST['isbuying'] : null;
      $serverID = isset($_POST['serverid']) ? $_POST['serverid'] : null;
      $itemID = isset($_POST['itemid']) ? $_POST['itemid'] : null;
      $column = isset($_POST['column']) ? $_POST['column'] : null;
      $descending = isset($_POST['descending']) ? $_POST['descending'] : null;
      $limit = isset($_POST['limit']) ? $_POST['limit'] : null;
      $isAdmin = isset($_POST['isadmin']) ? $_POST['isadmin'] : 0;
      $listingmanager = new ListingManager();
      $result = array('isadmin' => $isAdmin, 'result' => $listingmanager->getListings($isBuying, $serverID, $itemID, $column, $descending, $limit));
      returnMessage(new Message(false, NULL, $result));
      break;

    case 'getListingWithID':
      $id = $_POST['id'];
      $listingmanager = new ListingManager();

      returnMessage(new Message(false, NULL, $listingmanager->getListingWithID($id)));
      break;

    case 'removeListingWithID':
      $id = $_POST['id'];
      $listingmanager = new ListingManager();

      returnMessage(new Message(false, $listingmanager->removeListingWithID($id)));
      break;

    case 'addListing':
      $characterID = $_POST['characterid'];
      $itemID = $_POST['itemid'];
      $listingType = $_POST['listingtype'];
      $itemPrice = $_POST['itemprice'];
      $itemCount = $_POST['itemcount'];
      $comment = isset($_POST['comment']) ? $_POST['comment'] : null;
      $listingmanager = new ListingManager();
      if($itemID <= 0)
      {
        returnMessage(new Message(true, "Please submit a valid item"));
      }
      elseif($itemPrice < 1 || $itemPrice > 100000)
      {
        returnMessage(new Message(true, "Please submit a price between 1 and 100000."));
      }
      elseif($itemCount < 1 || $itemCount > 1000)
      {
        returnMessage(new Message(true, "Please submit an item count between 1 and 1000."));
      }
      elseif($characterID <= 0)
      {
        returnMessage(new Message(true, "Please select a valid character"));
      }
      else
      {
        returnMessage(new Message(false, $listingmanager->addListing($characterID, $itemID, $listingType, $itemPrice, $itemCount, $comment)));
      }
      break;

      case 'searchListing':
        $serverID = isset($_POST['serverid']) ? $_POST['serverid'] : null;
        $searchInput = isset($_POST['searchInput']) ? $_POST['searchInput'] : null;
        $listingmanager = new ListingManager();
        $isAdmin = isset($_POST['isadmin']) ? $_POST['isadmin'] : 0;
        $result = array('isadmin' => $isAdmin, 'result' => $listingmanager->getFilteredListings($serverID, $searchInput));
        returnMessage(new Message(false, NULL, $result));
        break;

    case 'autoComplete':
      $searchInput = $_POST['searchInput'];
      $inputField = $_POST['searchField'];
      $listingmanager = new ListingManager();
      $result = $listingmanager->getItemNames($searchInput);

      $data = array("search" => $inputField, "result" => $result);

      returnMessage(new Message(false, NULL, $data));
      break;

    case 'newCharacterChallenge':
      $token = $_SESSION['token'];
      $user = new User();
      $user->getUser($token);
      returnMessage(new Message(false, $user->newCharacterChallenge()));
      break;

    case 'verifyCharacter':
      $lodestoneUrl = $_POST['lodestoneUrl'];
      $token = $_SESSION['token'];
      $user = new User();
      $user->getUser($token);

      $return = $user->verifyCharacterChallenge($lodestoneUrl);

      if ($return === true) {
        returnMessage(new Message(false, "Succesfully added character!"));
      }
      else {
        returnMessage(new Message(true, $return));
      }
      break;

    case 'getCharacters':
    // Check if the user is logged in
      if(array_key_exists('token', $_SESSION)) {
        $token = $_SESSION['token'];
        // Make user object
        $user = new User();
        $user->getUser($token);

        if ($user->lodestone_character_ids[0] != NULL) {
          $characters = [];
          foreach ($user->lodestone_character_ids as $key) {
            $characters[] = new Character($key);
          }

          returnMessage(new Message(false, null, $characters));
        }
        else {
          returnMessage(new Message(true, "User has no characters!"));
        }
      }
      else {
        returnMessage(new Message(true, "Operation not authorized."));
      }
      break;

    case 'deleteCharacter':
      $characterID = $_POST['characterid'];
      $character = new Character($characterID);
      if ($character->error == NULL) {
        $character->deleteCharacter();
        returnMessage(new Message(false, "Succesfully deleted character!", $characterID));
      }
      else {
        returnMessage(new Message(true, $character->error));
      }
      break;

      case 'getItemByName':
        $name = $_POST['name'];
        $listingmanager = new ListingManager();
        returnMessage(new Message(false, null, $listingmanager->getItemByName($name)));
        break;

      case 'getAllListings':
        $charId = $_POST['listing'];

        if(isset($charId)){
          $listingmanager = new ListingManager();
          $result = $listingmanager->getAllListingsByCharacter($charId);
          returnMessage(new Message(false, null, $result));

        }else{
          returnMessage(new Message(true, 'no character id given'));
        }
        break;
}
