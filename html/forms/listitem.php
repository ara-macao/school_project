<!-- Modal -->
<script type="text/javascript">getCharacterOptions();</script>
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h4 class="modal-title">Place advertisement</h4>
</div>
<div class="modal-body">
  <form action="#">
    <div class="form-group" id="createAdvertisementBox">
      <input type="hidden" id="listingItemID" value="0">
      <div class="row">
         <script type="text/javascript">
         $( "#listingItemInput" ).on( "autocompleteselect", function( event, ui )
         {
           //$( "#listingItemInfo" ).attr("class", "hidden");
           getItemByName(ui.item.value)
         });
         </script>
         <div class="col-sm-12">
           <label for="listingItemInput">Select an item</label>
           <input type="search" oninput="tryAutoComplete('listingItemInput')" class="form-control" id="listingItemInput" placeholder="Search item"/>
           <br/>
         </div>
         <div class="col-sm-6">
           <label for="listingItemPrice">Set a price per item </label>
           <label for="listingItemPrice" style="float: right;">(GIL)</label>
           <input type="number" class="form-control" name="itemPrice" id="listingItemPrice" placeholder="Price" min="1" max="1000000">
         </div>
         <div class="col-sm-6">
           <label for="listingItemAmount">Set the quantity of items</label>
           <input type="number" class="form-control" name="itemAmount" id="listingItemAmount" placeholder="Quantity" min="1" max="1000">
         </div>
       </div>
     <div class="hidden" id="listingItemInfo">
       <hr style="height: 5px">
         <div class="col-sm-2">
           <div id="listingItemImage">
             <img class="image-rounded" src="" alt="" width="100" height="100">
           </div>
         </div>
         <div class="col-sm-10" style="padding-left: 25px">
           <label id="listingItemName" for="listingItemDescription"></label>
           <p id= "listingItemDescription"></p>
         </div>
       </div>
     </div>
     <br id="listingSpacerAfterInfo" class="hidden">
     <label for="listingComment">Comment</label>
     <textarea  class="form-control" placeholder="Additional comment" id="listingComment" style="resize:none"></textarea>
     <br/>
     <label for="listingListingType">Select Listing Type </label>
     <select class="form-control" name="listingListingType" id="listingListingType">
       <option value="0">Selling</option>
       <option value="1">Buying</option>
     </select>
     <br/>
     <label for="characterSelect">Select character </label>
     <select name="characterSelect" class="form-control" id="listingCharacter">
       <option value=0>Please add a character in the Characters menu</option>
     </select>
    </div>
</form>
</div>
<div class="modal-footer">
  <button type="submit" class="btn btn-primary" onclick="addListing()" formmethod="post" style="float: left">Submit</button>
  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
