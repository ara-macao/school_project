<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h4 class="modal-title">Create account</h4>
</div>
<div class="modal-body">
  <form action="#">
    <div class="form-group" id="createUsernameBox">
      <label for="firstname">Desired username:</label>
      <input type="text" class="form-control" name="firstname" placeholder="username" onfocusout="validateCreateForm()" id="createUsernameInput">
      <span id="createFeedback"></span>
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
