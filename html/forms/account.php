<?php
  $username = "";
  $email = "";

  if (isset($_GET['username'])) {
    $username = $_GET['username'];
  }

  if (isset($_GET['email'])) {
    $email = $_GET['email'];
  }
?>

<form>
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Account details</h4>
  </div>

  <div class="modal-body" id="modalBody">
      <label for="firstname">Username:</label><br>
      <p><?php echo $username; ?></p><br>

      <label for="email">Email:</label><br>
      <p><?php echo $email; ?></p><br>

      <h4 class="modal-title">Change password</h4><br>
      <label for="verpassword">Old password:</label>

      <!-- input field for old password -->
      <input type="password" class="form-control" id="oldPassword" name="password" placeholder="Old password"><br/>

      <label for="verpassword">New password:</label>

      <!-- Shows detailed information on what went wrong-->
      <small id="createPasswordHelper" class="text-danger">Must be 6 characters or more!</small><br>

      <!-- input field for new password -->
      <input type="password" class="form-control" id="createPassword" name="newpassword" placeholder="New password"><br/>
      <span id="createPasswordFeedback"></span>

      <!-- input field for repeat new password -->
      <input type="password" class="form-control" id="createVerPassword" name="verpassword" placeholder="Repeat new password"><br/>

      <div id="createResult" class="alert alert-warning" style="visibility: hidden">
        <strong>Warning!</strong> Indicates a warning that might need attention.
      </div>
  </div>

  <div class="modal-footer">
    <button type="button" id="submitButton" onclick="validateChangePassword()" class="btn btn-primary" style="float: left">Change password</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  </div>
</form>
