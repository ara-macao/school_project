<nav class="navbar navbar-fixed-top navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <img alt="logo" src="https://vignette.wikia.nocookie.net/finalfantasy/images/5/5d/FFXIV_A_Realm_Restored_trophy_icon.png/revision/latest?cb=20160508021814" style=" float: left; width: 50px; heigh: 50px;">
      <h4 class="navbar-text">FFXIV MARKET</h4>
    </div>
    <div id="navbuttons" class="show">
      <ul class="nav navbar-nav navbar-right">
        <li><a data-toggle="modal" href="forms/login.php" id="loginbutton" data-target="#remoteModal"><span class="glyphicon glyphicon-log-in" ></span> Login</a></li>
        <li><a data-toggle="modal" href="forms/createaccount.php" id="createaccbutton" data-target="#remoteModal"><span class="glyphicon glyphicon-tag"></span> Sign Up</a></li>
      </ul>
    </div>
    <div id="loggedin" class="hidden">
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">
          <span class="glyphicon glyphicon-user"></span> <?php echo $user->username; ?> <span class="caret"></span></a>

          <ul class="dropdown-menu">
            <li><a data-toggle="modal" href="forms/account.php" id="accountpage" data-target="#remoteModal">Account</a></li>
            <li><a data-toggle="modal" href="forms/characters.php" id="characterspage" data-target="#remoteModal">Characters</a></li>
            <li><a id="logoutbtn">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="navbarspacer"></div>
