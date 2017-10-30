<!DOCTYPE html>
<html lang="en">
<head>
  <title>FFXIV Market</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="../style/modal.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="../js/forms.js"></script> <!-- Change this when included in index.php !!!!  -->
</head>
<body>


  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#createAccount">Create account</button>

  <!-- Modal -->
  <div class="modal fade" id="createAccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="vertical-alignment-helper">
      <div class="modal-dialog vertical-align-center">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Create account</h4>
          </div>
          <div class="modal-body">
            <form action="#">
              <div class="form-group" id="usernameInputDiv">
                <label for="firstname">Desired username:</label>
                <input type="text" class="form-control" name="firstname" placeholder="username" onfocusout="validateForm()" id="usernameInputField">
                <span id="usernameFeedback"></span>
              </div>

              <label for="password">Password:</label> <br/>
              <input type="password" class="form-control" name="password" placeholder="password"> <br/>

              <label for="username">Verify password:</label> <br/>
              <input type="password" class="form-control" name="verpassword" placeholder="password"> <br/>
              <br/><br/>
              <button type="submit" class="btn btn-primary" formmethod="post">Submit</button>
          </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
    </div>
      </div>
  </div>


</body>
</html>
