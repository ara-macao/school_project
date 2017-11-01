<form>
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Log into your account</h4>
  </div>

  <div class="modal-body" id="modalBody">
      <div class="form-group" id="createUsernameBox">
        <label for="firstname">Username: </label>
        <!-- Shows detailed information on what went wrong -->
        <small id="loginUsernameFeedback" class="text-danger" style="display: none">        </small>
        <!-- input field for username -->
        <input type="text" class="form-control" id="loginUsername" name="username" placeholder="username">
        <span id="createFeedback"></span>
      </div>

      <label for="password">Password:</label>
      <!-- input field for password -->
      <input type="password" id="loginPassword" class="form-control" name="password" placeholder="password"> <br/>
    <br/>
  </div>

  <div class="modal-footer">
      <button type="button" id="loginbtn" onclick="tryLogin()" class="btn btn-primary" style="float: right">Login</button>
  </div>
</form>
