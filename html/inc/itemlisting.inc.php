<div class="col-sm-10 col-sm-offset-1">
   <!-- Refresh lists and create listing buttons -->
   <button type="button" class="btn">Refresh Item List</button>
   <button type="button" class="btn" data-toggle="modal"  href="forms/listitem.php" data-target="#remoteModal" style="float: right;">List item</button><br><br>
   <!-- Listed items and item order boxes -->
   <div class="well">
  <!-- search item bar -->
     <div class="form">
       <div class="row">
         <div class="col-sm-12">
           <h4>Search item</h4>
         </div>
         <div class="col-sm-12">
           <input type="search" class="form-control" id="search" placeholder="Search item"/>
         </div>
   <!-- search item bar (placeholder) -->
 <div class="col-sm-10 col-sm-offset-1">
   <div class="well">
     <div class="row">
       <div class="col-sm-8">
         <h4>Search item</h4>
       </div>
       <div class="form-group">
         <div class="col-sm-6">
             <input type="search" class="form-control" id="search" placeholder="Search item"/>
         </div>
         <div class="col-sm-2">
           <!-- Search button (placeholder) -->
           <input type="submit" class="btn" id="searchbtn" value="Search">
         </div>
       </div>
     </div>
   </div>
 </div>

<div class="col-sm-10 col-sm-offset-1">
   <!-- Refresh lists and create listing buttons -->
   <button type="button" class="btn">Refresh Item List</button>

   <button type="button" class="btn" data-toggle="modal"  href="forms/listitem.php" data-target="#remoteModal" style="float: right;">List item</button><br><br>
   <!-- Listed items and item order boxes -->
<div class="well">
 <div class="row" style="text-align: center">
   <div class="col-sm-6">
     <h4>Recently posted</h4>
   </div>
   <div class="col-sm-6">
     <h4>Recently ordered</h4>
   </div>
 </div>
 <div class="row">
   <div class="col-sm-6">
     <div class="panel-default" style="background-color: #A4A4A4">
       <div class="panel-body">
         <button type="button" class="btn btn-primary col-sm-12" data-toggle="modal" href="forms/buyitem.php" id="buyitem" data-target="#remoteModal">Augmented Lost Allagan Claymore</button>
         <button type="button" class="btn btn-warning col-sm-12" data-toggle="modal" href="forms/buyitem.php" id="buyitem" data-target="#remoteModal">Placeholder for styling</button>
         <button type="button" class="btn btn-primary col-sm-12" data-toggle="modal" href="forms/buyitem.php" id="buyitem" data-target="#remoteModal">memes and other fun stuff</button>
       </div>
     </div>
   </div>
   <div class="col-sm-6">
       <div class="panel-default" style="background-color: #A4A4A4">
         <div class="panel-body">
           <button type="button" class="btn btn-primary col-sm-12" data-toggle="modal" href="forms/buyitem.php" id="buyitem" data-target="#remoteModal">Order placeholder</button>
         </div>
       </div>
     </div>
    </div>
   </div>
 </div>
</div>

   <!-- Remote modal -->
<div class="modal fade" id="remoteModal" tabindex="-1" role="dialog" aria-labelledby="remoteModal" aria-hidden="true">
 <div class="vertical-alignment-helper">
   <div class="modal-dialog vertical-align-center">
     <div class="modal-content">
         <!-- The remote modal gets loaded here -->
     </div>
   </div>
 </div>
</div>
