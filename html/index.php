<!DOCTYPE html>
<html lang="en">
<head>
  <title>FFXIV Market</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="js/forms.js"></script> <!-- Change this when included in index.php !!!!  -->
</head>
<body>

<div class="container">
  <div class="jumbotron">
    <div class="row">
      <div class="col-sm-9">
        <h1>FFXIV Market</h1>
      </div>
      <div class="col-sm-3">
        <div class="form-group">
          <p><input type="text" class="form-control" id="usr" value="Username"></p>
          <p><input type="password" class="form-control" id="pwd" value=""></p>
          <p><input type="submit" class="btn" id="submit" value="Login"></p>
        </div>
      </div>
    </div>
  </div>

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

  <div class="col-sm-10 col-sm-offset-1">
    <div class="well">
      <div class="row">
        <div class="col-sm-8">
          <h4>Search what?</h4>
        </div>
        <div class="form-group">
          <div class="col-sm-6">
            <input type="search" class="form-control" id="search" value="Search">
          </div>
          <div class="col-sm-2">
            <input type="submit" class="btn" id="pwd" value="Search">
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-sm-10 col-sm-offset-1">
    <button type="button" class="btn">Refresh Item List</button><br><br>
    <div class="well">
      <div class="row" style="text-align: center">
        <div class="col-sm-6">
	        <h4>Selling</h4>
        </div>
        <div class="col-sm-6">
          <h4>Buying</h4>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="well" style="background-color: #A4A4A4">
            <div class="well">
              Item
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="well" style="background-color: #A4A4A4">
            <div class="well">
              Item
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
