<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h4 class="modal-title">Create account</h4>
</div>

<div class="modal-body">
  <form action="#">
    <div class="form-group" id="createUsernameBox">
      <label for="firstname">Desired username:</label>
      <!-- Shows detailed information on what went wrong -->
      <small id="createFeedbackHelper" class="text-danger" style="visibility: hidden">

      </small>

      <!-- input field for username -->
      <input type="text" class="form-control" name="firstname" placeholder="username" onfocusout="validateCreateForm()" id="createUsernameInput">
      <span id="createFeedback"></span>
    </div>

    <label for="password">Password:</label>
    <!-- Shows detailed information on what went wrong-->
    <small id="createPasswordHelper" class="text-danger">
      Must be 8-20 characters long and contain A-Z, a-z, 0-9, ! @ # $ % ?
    </small>
    <br/>
    <!-- input field for password -->
    <input type="password" class="form-control" name="password" placeholder="password"> <br/>
 <br/>
    <label for="username">Verify password:</label> <br/>
    <!-- input field for password -->
    <input type="password" class="form-control" name="verpassword" placeholder="password"> <br/>
    <br/><br/>
</form>
</div>

<div class="modal-footer">
  <button type="submit" class="btn btn-primary" formmethod="post" style="float: left">Submit</button>
  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
