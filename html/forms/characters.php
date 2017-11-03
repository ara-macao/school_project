<form>
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Characters</h4>
  </div>

  <div class="modal-body" id="modalBody">
    <label for="firstname">Linked characters:</label>
    <!-- show a list of linked characters -->
    <hr>
    <button type="button" id="submitButton" onclick="requestVerificationKey()" class="btn btn-warning" style="float: left">Request verification key</button><br><br>
    <p id="verificationKeyInfo" style="display: none">Use the following verification key on your account:</p>
    <strong><div id="verificationKey" class="alert alert-success" style="display: none"></div></strong>

    <label for="password">Add character:</label><br>
    <input type="text" class="form-control" id="addCharacter" name="addcharacter" placeholder="Lodestone url"><br/>
  </div>

  <div class="modal-footer">
    <button type="button" id="submitButton" onclick="requestVerificationKey()" class="btn btn-primary" style="float: left">Link character</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  </div>
</form>
