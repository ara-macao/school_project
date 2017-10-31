<form >
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Create account</h4>
  </div>


  <!-- Modal body -->
  <div class="modal-body" id="modalBody">
    <!-- Username input box -->
      <div class="form-group" id="createUsernameBox">
        <label for="firstname">Desired username:</label>
        <!-- Shows detailed information on what went wrong -->
        <small id="createFeedbackHelper" class="text-danger" style="visibility: hidden">
        </small>

        <!-- input field for username -->
        <input type="text" class="form-control" name="firstname" placeholder="username" onfocusout="validateUsernameCreateForm()" id="createUsernameInput">
        <span id="createFeedback"></span>
      </div>

      <label for="mail">Email:</label>
      <!-- input field for Email -->
      <input type="email" class="form-control" name="mail" placeholder="example@mail.com" onfocusout="validateCreateForm()">
      <br/>

      <label for="password">Password:</label>
      <!-- Shows detailed information on what went wrong-->
      <small id="createPasswordHelper" class="text-danger">
        Must be 8-20 characters long and contain A-Z, a-z, 0-9, ! @ # $ % ?
      </small>
      <br/>
      <!-- input field for password -->
      <input type="password" class="form-control" name="password" placeholder="password"> <br/>

      <label for="username">Verify password:</label> <br/>
      <!-- input field for password -->
      <input type="password" class="form-control" name="verpassword" placeholder="password"> <br/>


      <div id="createResult" class="alert alert-warning" style="visibility: hidden">
        <strong>Warning!</strong> Indicates a warning that might need attention.
      </div>

  </div>

  <div class="modal-footer">
    <button type="button" id="submitButton" onclick="validateCreateForm()"  class="btn btn-primary" style="float: left">Submit</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  </div>
</form>
