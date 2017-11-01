<?php
/*! \file /api/index.php
 *  \brief public API
 *  Clients use this to request data in a safe and responsible manner.
 */

session_start();
include_once "engine.php";

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
            returnMessage(new Message(true, "username or password is incorrect."));
        }
        break;
    case "changePassword":
        if(array_key_exists('token', $_SESSION)) {
            if(array_key_exists($_POST['currentPassword']) && array_key_exists($_POST['newPassword']) && array_key_exists($_POST['newPasswordAgain'])) {
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
        returnMessage(new Message(true, "Username already in use"));
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
            $user->logOut($token);
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
}
