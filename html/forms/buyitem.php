<!-- Modal -->
<div class="modal-header" id="inameheader">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h4 class="modal-title"></h4>
</div>
<div class="modal-body">
  <form action="#">
    <div class="form-group" id="createbuyitembox">
      <div class="row">
       <div class="col-sm-6">
           <!-- Item picture will be up for debate currently just a placeholder -->
         <img class="image-rounded" src="" alt="placeholder" width="100" height="100">
       </div>
       <div class="col-sm-6">
         <!-- these placeholder variabled will be Json items from the query -->
         Item name: $itemName <br>
         Item price: $itemPrice <br>
         <!-- $itemAmount will be left out if there is only 1 -->
         Item amount: $itemAmount <br>
       </div>
     </div>

     <div class="row">
      <div class="col-sm-6">
          <!-- $itemDesc is a placeholder -->
        <p class="lead"> $itemDesc </p>
      </div>
     </div>
        <div class="spacer"></div>
        <div class="row">
      <div class="col-sm-6">
          <!-- owner of item is a placeholder -->
        <p class="lead"> $userID </p>
      </div>
     </div>
        <div class="spacer"></div>
     <textarea  class="form-control" placeholder="Additional comment"></textarea>
     <br>

    <label for="characterSelect">Select your character</label>
    <select name="characterSelect" class="form-control" id="character">
        <option>Mister Poopybutthole</option>
        <option>RickSanchez (C-137)</option>
        <option>RickSanchez (J19?7)</option>
        <option>Just aMorty</option>
    </select>
   </div>
</form>
</div>
<div id="iteminfo">
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
</div>
<script>
    var itemname = $('<h4 class="modal-title">'+result["data"]["id"]["item_nicename"]+'</h4>');
    itemname.appentTo("#inameheader");
    var iteminfo = $("test");
    iteminfo.appendTo("#iteminfo");
</script>