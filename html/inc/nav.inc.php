<?php

// Check if the user is logged in
if($user != null){
  $navButtons = "hidden";
  $loggedIn = "show";
}else{
  $navButtons = "show";
  $loggedIn = "hidden";
}

  // if (isset($_GET['logout']) && isset($user->username)) {
  //   $user->logOut();
  //}
?>

<nav class="navbar navbar-fixed-top navbar-inverse" style="height:52px;">
  <div class="container-fluid">
    <div class="navbar-header">
      <img alt="logo" class="fflogo" src="https://orig00.deviantart.net/cd48/f/2014/244/5/3/final_fantasy_xiv_dalamud_token_icon_by_doctor_cool-d7xn4e7.png">
      <h4 class="navbar-text">FFXIV MARKET</h4>
    </div>

    <div id="navbuttons" class=<?php echo $navButtons; ?>>
      <ul class="nav navbar-nav navbar-right">
        <li><a data-toggle="modal" href="forms/login.php" id="loginbutton" data-target="#remoteModal"><span class="glyphicon glyphicon-log-in" ></span> Login</a></li>
        <li><a data-toggle="modal" href="forms/createaccount.php" id="createaccbutton" data-target="#remoteModal"><span class="glyphicon glyphicon-tag"></span> Sign Up</a></li>
      </ul>
    </div>

    <div id="loggedin" class=<?php echo $loggedIn; ?>>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">
          <span class="glyphicon glyphicon-user"></span>  <?php echo $user->username; ?> <span class="caret"></span></a>

          <ul class="dropdown-menu">
            <li><a data-toggle="modal" href="forms/account.php?username=<?php echo $user->username . "&email=" . $user->emailAddress; ?>" id="accountpage" data-target="#remoteModal">Account</a></li>
            <li><a data-toggle="modal" href="forms/characters.php" id="characterspage" data-target="#remoteModal">Characters</a></li>
            <li><a data-toggle="modal" href="forms/listitem.php" id="listitempage" data-target="#remoteModal">List Item</a></li>
            <li><a href="" onclick="tryLoggout()">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>

  </div>
</nav>
<div class="navbarspacer"></div>
