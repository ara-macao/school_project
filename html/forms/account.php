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

      <label for="password">Change Password:</label>
      <!-- input field for old password -->
      <input type="password" class="form-control" name="password" placeholder="Old password"> <br/>

      <div class="form-group" id="createPasswordBox">
        <label for="verpassword">New password:</label>
        <!-- Shows detailed information on what went wrong-->
        <small id="createPasswordHelper" class="text-danger" style="visibility: hidden"></small>
        <!-- input field for new password -->
        <input type="password" class="form-control" name="password" placeholder="New password" onfocusout="validatePassword()" id="createPassword"> <br/>
        <span id="createPasswordFeedback"></span>
      </div>

      <!-- input field for repeat new password -->
      <input type="password" class="form-control" name="verpassword" placeholder="Repeat new password" id="createVerPassword"> <br/>
  </div>

  <div class="modal-footer">
    <button type="button" id="changePassButton" onclick="validateCreateForm()"  class="btn btn-primary" style="float: left">Change password</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  </div>
</form>
