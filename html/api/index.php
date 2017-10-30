<?php
/*! \file index.php
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

switch($_GET['action']) {
    case "login":
        $token = new Token($_GET['username'], $_GET['password']);
        if($token->error == NULL) {
            $_SESSION['token'] = $token;
            returnMessage(new Message(false));
        }else {
            returnMessage(new Message(true, "username or password is incorrect."));
        }
        break;
    
}