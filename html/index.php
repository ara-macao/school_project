<!DOCTYPE html>
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
  <script>
  // This function destroys a modal completly.
  $(document).ready(function()
  {
      // codes works on all bootstrap modal windows in application
      $('.modal').on('hidden.bs.modal', function(e)
      {
          $(this).removeData();
      }) ;
  });

</script>
</head>
<body>

<div class="container">
  <div class="jumbotron">
    <div class="row">
      <div class="col-sm-9">
          <h1>FFXIV Market</h1><br>
          <h3>For all your trading needs</h3>
      </div>
      <div class="col-sm-3">
        <form action="" class="form-group">
            <!-- Login forms -->
              <p><input type="text" class="form-control" id="usr" placeholder="Username"/></p>
              <p><input type="password" class="form-control" id="pwd" placeholder="Password">
            <!-- Login and create account buttons -->
            <p><input type="submit" class="btn btn-primary col-sm-4" id="submit" value="Login">
                <button type="button" class="btn btn-primary col-sm-7" data-toggle="modal" href="forms/createaccount.php" id="createaccbutton" data-target="#remoteModal" style="float:right">Create account</button></p>
          </form>
      </div>
    </div>
  </div>

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
