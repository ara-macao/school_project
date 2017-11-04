<form>
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Characters</h4>
  </div>

  <div class="modal-body" id="modalBody">
    <script>getCharacters()</script>
    <h4 for="firstname">Linked characters:</h4><br>
    <!-- show a list of linked characters -->
    <div id="linkedCharacters"></div>
    <hr>
    <button type="button" id="submitButton" onclick="requestVerificationKey()" class="btn btn-warning" style="float: left">Request verification key</button><br><br>
    <p id="verificationKeyInfo" style="display: none">Use the following verification key on your account:</p>
    <strong><div id="verificationKey" class="alert alert-success" style="display: none"></div></strong>
    <hr>

    <label for="password">Add character:</label><br>
    <input type="text" class="form-control" id="verificationUrl" name="addcharacter" placeholder="Lodestone url"><br/>
    <strong><div id="verifyCharacterSuccess" class="alert alert-success" style="display: none"></div></strong>
    <strong><div id="verifyCharacterFail" class="alert alert-danger" style="display: none"></div></strong>
  </div>

  <div class="modal-footer">
    <button type="button" id="submitButton" onclick="verifyCharacter()" class="btn btn-primary" style="float: left">Link character</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  </div>
</form>
