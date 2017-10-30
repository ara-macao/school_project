<!DOCTYPE html>
<html lang="en">
<head>
  <title>FFXIV Market</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="../style/modal.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="../js/forms.js"></script> <!-- Change this when included in index.php !!!!  -->
</head>
<body>


  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#createAdvertisement">Create Advertisement</button>

  <!-- Modal -->
  <div class="modal fade" id="createAdvertisement" tabindex="-1" role="dialog" aria-labelledby="createAdvertisementLable" aria-hidden="true">
    <div class="vertical-alignment-helper">
      <div class="modal-dialog vertical-align-center">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Place advertisement</h4>
          </div>
          <div class="modal-body">
            <form action="#">
              <div class="form-group" id="createAdvertisementBox">
                <div class="row">
                 <div class="col-sm-6">
                   <input type="text" class="form-control" name="itemName" placeholder="Type to search item" onfocusout="validateCreateForm()">
                   <input type="number" class="form-control" name="itemPrice" placeholder="price">
                   <input type="number" class="form-control" name="itemAmount" placeholder="amount for sale">
                 </div>
                 <div class="col-sm-6">
                   <img src="http://www.html5gamedevs.com/uploads/monthly_2017_08/image.jpg.31a662f3a122c7509c42474ce5346aeb.jpg" alt="placeholder" width="100" height="100">
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

              <button type="submit" class="btn btn-primary" formmethod="post">Submit</button>
          </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
    </div>
      </div>
  </div>


</body>
</html>
