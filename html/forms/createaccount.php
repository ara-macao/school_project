<!DOCTYPE html>
<html lang="en">
<head>
  <title>FFXIV Market</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  <script src="../js/forms.js"></script> <!-- Change this when included in index.php !!!!  -->
</head>
<body>


  <!-- Button trigger modal -->
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createAccount">
    Create account
  </button>

  <!-- Modal -->
  <div class="modal fade" id="createAccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
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
          <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#createAccount">Close</button>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
