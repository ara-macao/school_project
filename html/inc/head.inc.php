<?php
include_once "api/engine.php";
session_start();
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
  <link rel="stylesheet" href="style/modal.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="js/forms.js"></script>
  <script src="js/login.js"></script>
  <script src="js/api.js"></script>
  <script src="js/listing.js"></script>
  <script>
  // This function destroys a modal completly.
  $(document).ready(function()
  {
      // codes works on all bootstrap modal windows in application
      $('.modal').on('hidden.bs.modal', function(e)
      {
          $(this).removeData();
      });
  });
  //Server list button generator
    $.get("./api/?action=getServerList", function(data, status){
            var result = JSON.parse(data);
            for (var i = 0; i < result["data"].length; i++) {
             switch (result["data"][i]["datacenter"]) {
                case "Mana":
                    var radioBtn = $('<label><input type="radio" name="optradio"> '+result["data"][i]["server"]+'</input></label><br>');
              radioBtn.appendTo('#DCMANA');
                      console.log(result["data"][i]);
                      break;
                  case "Gaia":
                      var radioBtn = $('<label><input type="radio" name="optradio"> ' + result["data"][i]["server"] + '</input></label><br>');
                      radioBtn.appendTo('#DCGAIA');
                      console.log(result["data"][i]);
                      break;
                  case "Elemental":
                      var radioBtn = $('<label><input type="radio" name="optradio"> ' + result["data"][i]["server"] + '</input></label><br>');
                      radioBtn.appendTo('#DCELEMENTAL');
                      console.log(result["data"][i]);
                      break;
                  case "Aether":
                      var radioBtn = $('<label><input type="radio" name="optradio"> ' + result["data"][i]["server"] + '</input></label><br>');
                      radioBtn.appendTo('#DCAETHER');
                      console.log(result["data"][i]);
                      break;
                  case "Primal":
                      var radioBtn = $('<label><input type="radio" name="optradio"> ' + result["data"][i]["server"] + '</input></label><br>');
                      radioBtn.appendTo('#DCPRIMAL');
                      console.log(result["data"][i]);
                      break;
                  case "Chaos":
                      var radioBtn = $('<label><input type="radio" name="optradio"> ' + result["data"][i]["server"] + '</input></label><br>');
                      radioBtn.appendTo('#DCCHAOS');
                      console.log(result["data"][i]);
                      break;
                  default:
              }
          }
      });
  </script>
</head>
