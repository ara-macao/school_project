<!DOCTYPE html>
<html lang="en">
<head>
  <title>FFXIV Market</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<script>
function validateForm() {
  var userInput = document.getElementById("usernameInputField");;
  var inputDiv = document.getElementById("usernameInputDiv");;
  var feedback = document.getElementById("usernameFeedback");

    if (userInput.value == "Name") {
        inputDiv.className = "form-group has-success has-feedback"
        feedback.className = "glyphicon glyphicon-ok form-control-feedback";

        return true;
    }else{
        inputDiv.className = "form-group has-error has-feedback"
        feedback.className = "glyphicon glyphicon-remove form-control-feedback";
        // remove class
    }
}
</script>


<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
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

          <!-- <div class="form-group has-error has-feedback">
            <label for="inputError2">Input with error</label>
            <input type="text" class="form-control" id="inputError2">
            <span class="glyphicon glyphicon-remove form-control-feedback"></span>
          </div>  -->

          <label for="password">Password:</label> <br/>
          <input type="password" class="form-control" name="password" placeholder="password"> <br/>

          <label for="username">Verify password:</label> <br/>
          <input type="password" class="form-control" name="verpassword" placeholder="password"> <br/>
          <br/><br/>
          <button type="submit" class="btn btn-primary" formmethod="post">Submit</button>
      </form>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Close</button>
      </div>
    </div>
  </div>
</div>



</body>
</html>
