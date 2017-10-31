<!DOCTYPE html> 
<?php include 'head.php'; ?>
    <div w3-include-html="head.php"></div> 
<body>
    <nav class="navbar navbar-fixed-top navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <img alt="logo" src="https://vignette.wikia.nocookie.net/finalfantasy/images/5/5d/FFXIV_A_Realm_Restored_trophy_icon.png/revision/latest?cb=20160508021814" style=" float: left; width: 50px; heigh: 50px;"> 
      <h4 class="navbar-text">FFXIV MARKET</h4>
    </div>
    <div>
      <ul class="nav navbar-nav navbar-right">
      <li><a data-toggle="modal" href="forms/createaccount.php" id="createaccbutton" data-target="#remoteModal"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li><a data-toggle="modal" href="forms/createaccount.php" id="createaccbutton" data-target="#remoteModal"><span class="glyphicon glyphicon-log-in" ></span> Login</a></li>
    </ul>  
  </div>
</nav>
    
  <!--</div>-->
<div class="container">
    <!-- server selection (placeholer) -->
  <div class="col-sm-10 col-sm-offset-1">
    <div class="well">
      <div class="row">
        <div class="col-sm-3">
        <h4>Datacenter 1</h4>
          <div class="form-group">
            <div class="checkbox">
              <label><input type="checkbox" value="">Server 1</label>
            </div>
            <div class="checkbox">
              <label><input type="checkbox" value="">Server 2</label>
            </div>
            <div class="checkbox">
              <label><input type="checkbox" value="">Server 3</label>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
        <h4>Datacenter 2</h4>
          <div class="form-group">
            <div class="checkbox">
              <label><input type="checkbox" value="">Server 1</label>
            </div>
            <div class="checkbox">
              <label><input type="checkbox" value="">Server 2</label>
            </div>
            <div class="checkbox">
              <label><input type="checkbox" value="">Server 3</label>
            </div>
          </div>
        </div>
      </div>
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
      <h4>For sale</h4>
    </div>
    <div class="col-sm-6">
      <h4>Orders</h4>
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


