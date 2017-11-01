<form>
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Characters</h4>
  </div>

  <div class="modal-body" id="modalBody">
      <div class="form-group" id="createUsernameBox">
        <label for="firstname">Username: </label>
        <!-- Shows detailed information on what went wrong -->
        <small id="createFeedbackHelper" class="text-danger" style="visibility: hidden">        </small>
        <!-- input field for username -->
        <input type="text" class="form-control" name="username" placeholder="username" onfocusout="validateCreateForm()" id="createUsernameInput">
        <span id="createFeedback"></span>
      </div>

      <label for="password">Password:</label>
      <!-- input field for password -->
      <input type="password" class="form-control" name="password" placeholder="password"> <br/>
   <br/>
  </div>

  <div class="modal-footer">
      <button type="button" id="loginbtn" onclick="validateCreateForm()"  class="btn btn-primary" style="float: right">Login</button>
  </div>
</form>
