<?php
include_once "api/engine.php";
session_start();
$user = null;
if(array_key_exists('token', $_SESSION)){
    $user = new User();
    $user->getUser($_SESSION['token']);
    //var_dump($user);
}
?>
<html lang="en">
<head>
  <title>FFXIV Market</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="style/modal.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="js/forms.js"></script>
  <script src="js/login.js"></script>
  <script src="js/api.js"></script>
  <script src="js/listing.js"></script>
  <script src="js/serverlist.js"></script>
  <script src="js/autocomplete.js"></script>
  <script src="js/character.js"></script>
  <script>
  // This function destroys a modal completly.
  $(document).ready(function()
  {
      // codes works on all bootstrap modal windows in application
      $('.modal').on('hidden.bs.modal', function(e)
      {
          $(this).removeData();
      });
    serverList();
    refreshListing(1);
  });
  </script>
</head>
