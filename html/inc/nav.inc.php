<?php
// Check if the user is logged in
if ($user != null) {
    $navButtons = "hidden";
    $loggedIn = "show";
} else {
    $navButtons = "show";
    $loggedIn = "hidden";
}
// if (isset($_GET['logout']) && isset($user->username)) {
//   $user->logOut();
//}
?>
<div class="navbarspacer"></div>
<nav class="navbar navbar-fixed-top navbar-inverse navbar-collapse" id="head-navbar">
    <div class="container-fluid">
        <!-- start header -->
        <div class="navbar-header">
            <div class="<?php echo $navButtons; ?>">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse-navbuttons" aria-expanded="false">
                    <span class="sr-only">Toggle user options</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="<?php echo $loggedIn; ?>">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse-loggedin" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <img alt="logo" class="fflogo" src="https://orig00.deviantart.net/cd48/f/2014/244/5/3/final_fantasy_xiv_dalamud_token_icon_by_doctor_cool-d7xn4e7.png">
            <h4 class="navbar-text">FFXIV MARKET</h4>
        </div>
        <!-- end of header -->
        <div class="row inline-nav navbar-right">
            <div class="collapse navbar-collapse" id="collapse-navbuttons">
                <div class="<?php echo $navButtons; ?>">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a data-toggle="modal" href="forms/login.php" id="loginbutton" data-target="#remoteModal"><span class="glyphicon glyphicon-log-in" ></span> Login</a></li>
                        <li><a data-toggle="modal" href="forms/createaccount.php" id="createaccbutton" data-target="#remoteModal"><span class="glyphicon glyphicon-tag"></span> Sign Up</a></li>
                    </ul>
                </div>
            </div>
            <div class="collapse navbar-collapse" id="collapse-loggedin">
                <div class=<?php echo $loggedIn; ?>>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <span class="glyphicon glyphicon-user"></span> <?php echo $user->username; ?> <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a data-toggle="modal" href="forms/account.php?username=<?php echo $user->username . "&email=" . $user->emailAddress; ?>" id="accountpage" data-target="#remoteModal">Account</a></li>
                                <li><a data-toggle="modal" href="forms/characters.php" id="characterspage" data-target="#remoteModal">Characters</a></li>
                                <li><a href="" onclick="tryLoggout()">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>