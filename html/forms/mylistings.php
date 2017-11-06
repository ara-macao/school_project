<form>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">My listings</h4>
    </div>

    <div class="modal-body" id="modalBody">
        <script>myListings()</script>
        <h4>My orders:</h4><br>
        <div id="myOrders">
            <!-- orders are listed here -->
        </div>
        <hr>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
</form>
