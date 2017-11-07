<script type="text/javascript">getCharacterOptions();</script>
<script type="text/javascript">myListings();</script>

<form>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">My listings</h4>
    </div>
    <div class="modal-body" id="modalBody">
        <div id="myCharacters">
            <!-- dropdown for character list -->
            <label for="characterSelect">Select character </label>
            <select name="characterSelect" class="form-control" id="listingCharacter">
                <option value=0>Please add a character in the Characters menu</option>
            </select>
        </div>
        <hr>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title pnlheader" style=''>My orders</h3>
            </div>
            <div class="panel-default" style="background-color: #a8a8a8">
                <div class="panel-body" id="myOrders">
                </div>
            </div>
        </div>
    </div>
    <!--<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
</form> -->
