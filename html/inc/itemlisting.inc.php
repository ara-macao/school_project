<?php
  $loggedIn = $user != null ? "btn" : "hidden";

  echo "<script>refreshListing(1,". $isAdmin .");</script>";
?>
<div class="col-sm-10 col-sm-offset-1" id="itemlistingheader">
    <!-- Refresh lists and create listing buttons -->
    <div id="refreshbuttonholder">
      <button type="button" class="btn" id="refreshButton" <?php echo "onclick='refreshListing(1, ".$isAdmin.")'"; ?> >Refresh Item List</button>

      <?php
      echo "

      <script type='text/javascript'>

        $('#radiobuttons').on('change', function()
        {
            var id = $('input[name=serverbtn]:checked', '#radiobuttons').val();
            refreshListing(id,". $isAdmin .");
            $('#refreshButton').attr('onclick','refreshListing(' + id + '," . $isAdmin . ")');
        });
        </script>
      ";

      ?>
      <!-- <script type="text/javascript">
        $('#radiobuttons').on('change', function()
        {
            var id = $('input[name=serverbtn]:checked', '#radiobuttons').val();
            refreshListing(id);
            $("#refreshButton").attr("onclick","refreshListing(" + id + ")");
        });
      </script> -->
    </div>
    <div class="spacer"></div>
    <!-- Listed items and item order boxes -->
    <div class="well">
        <!-- search item bar -->
        <div class="form">
            <div class="row">
                <div class="col-sm-12">
                    <h4>Search item</h4>
                </div>
                <div class="col-sm-12">
                    <input type="search" oninput="tryAutoComplete('itemInputField')" class="form-control" id="itemInputField" placeholder="Search item"/>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-offset-5 col-sm-2">
                    <div class="spacer"></div>
                    <button type="button" class="btn btn-primary col-sm-12" id="searchbtn" <?php echo "onclick='searchItems(".$isAdmin.")'"; ?>><font style="font-size:120%;"><span class="glyphicon glyphicon-search"></span> Search</font></button>
                </div>
            </div>
        </div>
        <div class="spacer"></div>
        <!-- end of search item -->
        <div class="row">
            <!-- Sell orders list -->
            <div class="col-xs-12 col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title pnlheader">Sell Orders</h3>
                    </div>
                    <div class="panel-default" style="background-color: #a8a8a8">
                        <div class="panel-body" id="sell-orders">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Buy orders list -->
            <div class="col-xs-12 col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title pnlheader" style=''>Buy orders</h3>
                    </div>
                    <div class="panel-default" style="background-color: #a8a8a8">
                        <div class="panel-body" id="buy-orders">
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
</div>
