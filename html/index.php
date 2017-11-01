<!DOCTYPE html>
<?php include 'head.php'; ?>
<div w3-include-html="head.php"></div>
<body>
<nav class="navbar navbar-fixed-top navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <img alt="logo" src="https://vignette.wikia.nocookie.net/finalfantasy/images/5/5d/FFXIV_A_Realm_Restored_trophy_icon.png/revision/latest?cb=20160508021814" style=" float: left; width: 50px; heigh: 50px;">
      <h4 class="navbar-text">FFXIV MARKET</h4>
      <!-- this button will be replaced by a token check to see if a user is logged in -->
      <button id="replace" type="button">simulate login</button>
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
          <span class="glyphicon glyphicon-user"></span> Username<span class="caret"></span></a>

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
<!--<div class="container"> this container was making the site content too small-->
  <div class="col-sm-10 col-sm-offset-1">
        <!-- Datacenter row and columns -->
        <div class="row">
          <div class="col-md-2">
            <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Chaos .EU</h3>
            </div>
              <div id="DCCHAOS" class="panel-body" style="background-color: #def7e2">
                    <div class="radio">
                      <label><input type="radio" name="optradio">Cerberus</label>
                    </div>
                    <div class="radio">
                      <label><input type="radio" name="optradio">Lich</label>
                    </div>
                    <div class="radio">
                      <label><input type="radio" name="optradio">Louisoix</label>
                    </div>
                    <div class="radio">
                      <label><input type="radio" name="optradio">Moogle</label>
                    </div>
                    <div class="radio">
                      <label><input type="radio" name="optradio">Odin</label>
                    </div>
                    <div class="radio">
                      <label><input type="radio" name="optradio">Omega</label>
                    </div>
                  </div>
              </div>
          </div>
            <div class="col-md-2">
            <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Aether USA</h3>
            </div>
              <div id="DCCHAOS" class="panel-body" style="background-color: #dee4f7">
                    <div class="radio">
                      <label><input type="radio" name="optradio">Adamantoise</label>
                    </div>
                    <div class="radio">
                      <label><input type="radio" name="optradio">Balmung</label>
                    </div>
                    <div class="radio">
                      <label><input type="radio" name="optradio">Cactuar</label>
                    </div>
                    <div class="radio">
                      <label><input type="radio" name="optradio">Coeurl</label>
                    </div>
                    <div class="radio">
                      <label><input type="radio" name="optradio">Fearie</label>
                    </div>
                    <div class="radio">
                      <label><input type="radio" name="optradio">Gilgamesh</label>
                    </div>
                  </div>
              </div>
          </div>
          <div class="col-md-2">
            <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Primal USA</h3>
            </div>
              <div id="DCCHAOS" class="panel-body" style="background-color: #dee4f7">
                    <div class="radio">
                      <label><input type="radio" name="optradio">Behemoth</label>
                    </div>
                    <div class="radio">
                      <label><input type="radio" name="optradio">Brynhildr</label>
                    </div>
                    <div class="radio">
                      <label><input type="radio" name="optradio">Diabolos</label>
                    </div>
                    <div class="radio">
                      <label><input type="radio" name="optradio">Excalibur</label>
                    </div>
                    <div class="radio">
                      <label><input type="radio" name="optradio">Exodus</label>
                    </div>
                    <div class="radio">
                      <label><input type="radio" name="optradio">Famfrit</label>
                    </div>
                  </div>
              </div>
          </div>
          <div class="col-md-2">
            <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Elemental JP</h3>
            </div>
              <div id="DCCHAOS" class="panel-body" style="background-color: #f4def7">
                    <div class="radio">
                      <label><input type="radio" name="optradio">Aegis</label>
                    </div>
                    <div class="radio">
                      <label><input type="radio" name="optradio">Atomos</label>
                    </div>
                    <div class="radio">
                      <label><input type="radio" name="optradio">Carbuncle</label>
                    </div>
                    <div class="radio">
                      <label><input type="radio" name="optradio">Garuda</label>
                    </div>
                    <div class="radio">
                      <label><input type="radio" name="optradio">Gungnir</label>
                    </div>
                    <div class="radio">
                      <label><input type="radio" name="optradio">Kujata</label>
                    </div>
                  </div>
              </div>
          </div>
            <div class="col-md-2">
            <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Gaia JP</h3>
            </div>
              <div id="DCCHAOS" class="panel-body" style="background-color: #f4def7">
                    <div class="radio">
                      <label><input type="radio" name="optradio">Aegis</label>
                    </div>
                    <div class="radio">
                      <label><input type="radio" name="optradio">Atomos</label>
                    </div>
                    <div class="radio">
                      <label><input type="radio" name="optradio">Carbuncle</label>
                    </div>
                    <div class="radio">
                      <label><input type="radio" name="optradio">Garuda</label>
                    </div>
                    <div class="radio">
                      <label><input type="radio" name="optradio">Gungnir</label>
                    </div>
                    <div class="radio">
                      <label><input type="radio" name="optradio">Kujata</label>
                    </div>
                  </div>
              </div>
          </div>
            <div class="col-md-2">
            <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Mana JP</h3>
            </div>
              <div id="DCCHAOS" class="panel-body" style="background-color: #f4def7">
                    <div class="radio">
                      <label><input type="radio" name="optradio">Aegis</label>
                    </div>
                    <div class="radio">
                      <label><input type="radio" name="optradio">Atomos</label>
                    </div>
                    <div class="radio">
                      <label><input type="radio" name="optradio">Carbuncle</label>
                    </div>
                    <div class="radio">
                      <label><input type="radio" name="optradio">Garuda</label>
                    </div>
                    <div class="radio">
                      <label><input type="radio" name="optradio">Gungnir</label>
                    </div>
                    <div class="radio">
                      <label><input type="radio" name="optradio">Kujata</label>
                    </div>
                  </div>
              </div>
          </div>
            <!-- end of datacenter row and columns -->
        </div>
  </div>


    <!-- search item bar (placeholder) -->
  <div class="col-sm-10 col-sm-offset-1">
    <div class="well">
      <div class="row">
        <div class="col-sm-8">
          <h4>Search item</h4>
        </div>
        <div class="form-group">
          <div class="col-sm-6">
              <input type="search" class="form-control" id="search" placeholder="Search item"/>
          </div>
          <div class="col-sm-2">
            <!-- Search button (placeholder) -->
            <input type="submit" class="btn" id="searchbtn" value="Search">
          </div>
        </div>
      </div>
    </div>
  </div>

<div class="col-sm-10 col-sm-offset-1">
    <!-- Refresh lists and create listing buttons -->
    <button type="button" class="btn">Refresh Item List</button>

    <button type="button" class="btn" data-toggle="modal"  href="forms/listitem.php" data-target="#remoteModal" style="float: right;">List item</button><br><br>
    <!-- Listed items and item order boxes -->
<div class="well">
  <div class="row" style="text-align: center">
    <div class="col-sm-6">
      <h4>Recently posted</h4>
    </div>
    <div class="col-sm-6">
      <h4>Recently ordered</h4>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-6">
      <div class="panel-default" style="background-color: #A4A4A4">
        <div class="panel-body">
          <button type="button" class="btn btn-primary col-sm-12" data-toggle="modal" href="forms/buyitem.php" id="buyitem" data-target="#remoteModal">Augmented Lost Allagan Claymore</button>
          <button type="button" class="btn btn-warning col-sm-12" data-toggle="modal" href="forms/buyitem.php" id="buyitem" data-target="#remoteModal">Placeholder for styling</button>
          <button type="button" class="btn btn-primary col-sm-12" data-toggle="modal" href="forms/buyitem.php" id="buyitem" data-target="#remoteModal">memes and other fun stuff</button>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
        <div class="panel-default" style="background-color: #A4A4A4">
          <div class="panel-body">
            <button type="button" class="btn btn-primary col-sm-12" data-toggle="modal" href="forms/buyitem.php" id="buyitem" data-target="#remoteModal">Order placeholder</button>
          </div>
        </div>
      </div>
     </div>
    </div>
  </div>
</div>

    <!-- Remote modal -->
<div class="modal fade" id="remoteModal" tabindex="-1" role="dialog" aria-labelledby="remoteModal" aria-hidden="true">
  <div class="vertical-alignment-helper">
    <div class="modal-dialog vertical-align-center">
      <div class="modal-content">
          <!-- The remote modal gets loaded here -->
      </div>
    </div>
  </div>
</div>
</body>
</html>
