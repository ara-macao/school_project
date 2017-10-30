<!-- Modal -->
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h4 class="modal-title">Place advertisement</h4>
</div>
<div class="modal-body">
  <form action="#">
    <div class="form-group" id="createAdvertisementBox">
      <div class="row">
       <div class="col-sm-6">
         <input type="text" class="form-control" name="itemName" placeholder="Type to search item" >
         <input type="number" class="form-control" name="itemPrice" placeholder="price">
         <input type="number" class="form-control" name="itemAmount" placeholder="amount for sale">
       </div>
       <div class="col-sm-6">
         <img class="image-rounded" src="http://img.finalfantasyxiv.com/lds/pc/global/images/itemicon/cc/cc5bf488fa6167d399f6310067ffc19dfd44dd82.png?20171024" alt="placeholder" width="100" height="100">
       </div>
     </div>

     <div class="row">
      <div class="col-sm-6">
        <p class="lead"> Description of item </p>
      </div>
      <div class="col-sm-6">
        <p class="lead">  name of item </p>
      </div>
     </div>
     <p>
       Lorem ipsum dolor sit amet <br/>
       Lorem ipsum dolor sit amet <br/>
       Lorem ipsum dolor sit amet <br/>
       Lorem ipsum dolor sit amet <br/>
     </p>

     <textarea  class="form-control" placeholder="Additional comment"></textarea>

     <br/>

     <select class="form-control" id="state">
       <option>Choose something</option>
       <option>Selling</option>
       <option>Buying</option>
     </select>

     <label for="characterSelect">Select character </label>
     <select name="characterSelect" class="form-control" id="character">
       <option>Choose character</option>
     </select>

    </div>


</form>
</div>
<div class="modal-footer">
  <button type="submit" class="btn btn-primary" formmethod="post" style="float: left">Submit</button>
  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
