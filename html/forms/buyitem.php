<!-- Modal -->
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h4 class="modal-title">Buy item</h4>
</div>
<div class="modal-body">
  <form action="#">
    <div class="form-group" id="createbuyitembox">
      <div class="row">
       <div class="col-sm-6">
           <!-- Item picture will be up for debate currently just a placeholder -->
         <img class="image-rounded" src="http://img.finalfantasyxiv.com/lds/pc/global/images/itemicon/cc/cc5bf488fa6167d399f6310067ffc19dfd44dd82.png?20171024" alt="placeholder" width="100" height="100">
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
            <!-- tables first row will be headers and 2nd row will be stats loaded in through json -->
    <div class="container">
      <table class="table table-bordered" style="word-wrap:break-word; width:auto;">
        <thead>
          <tr>
            <th>Physical damage</th>
            <th>Magic damage</th> 
            <th>Attack Power</th>
            <th>DPS</th>
            <th>Delay</th> 
          </tr>
        </thead>
        <tr>
          <td>Json[Pdmg]</td>
          <td>Json[Mdmg]</td> 
          <td>Json[AP]</td>
          <td>Json[DPS]</td>
          <td>Json[DELAY]</td>
        </tr>
      </table>
        <br>
    </div>
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
<div class="modal-footer">
  <button type="submit" class="btn btn-primary" formmethod="post" style="float: left">Buy now!</button>
  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
</div>