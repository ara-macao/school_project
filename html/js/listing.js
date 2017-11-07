function searchItems(isAdmin = 0){
  var id = $('input[name=serverbtn]:checked', '#radiobuttons').val();
  var searchInput = $('#itemInputField').val();
  console.log(searchInput);
  apiRequest('searchListing', {serverid: id, searchInput: searchInput, isadmin:isAdmin}, refreshCallback);
}

function refreshListing(id, isAdmin = 0) {
    var isbuying = $('#isbuying').val();
    apiRequest('getListings', {isbuying: isbuying, serverid: id, isadmin:isAdmin}, refreshCallback);
}

function getListingWithID(id) {
    apiRequest('getListingWithID', {id: id}, listingCallback);
}

function removeListingWithID() {
    var id = $('#id').val();
    apiRequest('removeListingWithID', {id: id}, listingCallback);
}

function getItemByName(name) {
    apiRequest('getItemByName', {name: name}, getItemCallback);
}

function addListing() {
    var characterid = $('#listingCharacter').val();
    var itemid = $('#listingItemID').val();
    var listingtype = $('#listingListingType').val();
    var itemprice = $('#listingItemPrice').val();
    var itemcount = $('#listingItemAmount').val();
    var comment = $('#listingComment').val();
    apiRequest('addListing', {characterid: characterid, itemid: itemid, listingtype: listingtype, itemprice: itemprice, itemcount: itemcount, comment: comment}, addCallback);
}

function refreshCallback(html)
{
    //console.log(html);
    var data = JSON.parse(html);
    if(data['error']) {
        $("#listingFeedback").html(data['message']);
        $("#listingFeedback").show();
        console.log('fail');
    }else{
        $('#buy-orders').empty();
        $('#sell-orders').empty();
        $("#loginUsernameFeedback").hide();
        var result = JSON.parse(data["data"]['result']);
        var isAdmin = JSON.parse(data["data"]['isadmin']);
        for (var i = 0; i < result.length; i++) {
          var listing = $('<div><button type="button" data-button={"listingid":' + result[i]["listing_id"] + '} class="btn btn-' + (result[i]["listing_type"] == 0 ? 'primary' : 'warning') + ' no-overflow ' + (isAdmin == 0 ? 'col-12' : 'col-11') + '" data-toggle="modal" href="forms/buyitem.php" onclick="getListingWithID(' + result[i]["listing_id"] + ')" id="buyitem" data-target="#remoteModal" > ' + result[i]["item_count"] + " x " + result[i]["item_price"] + " GIL    " + result[i]["item_nicename"] + '</button><button id="removeItem" class="' + (isAdmin == 0 ? 'hidden' : 'col-1') + ' btn btn-danger"> X </button></div><div class="smallspacer"></div>');
          listing.appendTo("#" + (result[i]["listing_type"] == 0 ? "sell" : "buy") + "-orders");
          //console.log(result[i]);
        }
    }
}

function myListings(id) {
  console.log('My listing: ' + id);
    apiRequest('getAllListings', {listing: id}, myListingCallback);
}

function myListingCallback(html)
{
    console.log(html);
    $("#myOrders").empty();

    var data = JSON.parse(html);
    console.log(data);

    if(data['error']) {
        $("#listingFeedback").html(data['message']);
        $("#listingFeedback").show();
        console.log('fail');
    }else{
        $("#loginUsernameFeedback").hide();
        var result = JSON.parse(data["data"]);
        for (var i = 0; i < result.length; i++) {
          var listingid = result[i]["listing_id"];
          var listingType = result[i]["listing_type"] == 0 ? 'primary' : 'warning'
          var isAdmin = result[i]["is_admin"] == 0 ? 'col-12' : 'col-11';
          var itemCount = result[i]["item_count"];
          var itemPrice = result[i]["item_price"];
          var itemNicename = result[i]["item_nicename"];

          var listing = $('<div><button type="button" data-button={"listingid":' + listingid + '} class="btn btn-' + listingType + ' no-overflow ' + isAdmin + '"> ' + itemCount + " x " + itemPrice + " GIL    " +
          itemNicename + '</button><button id="removeItem" class="col-1 btn btn-danger" data-button={"listingid":' + listingid + '} onclick="removeListingWithMyID(' + listingid + ')"> X </button></div><div class="smallspacer"></div>');

          console.log(listing);

          listing.appendTo("#myOrders");
          //console.log(result[i]);
        }
    }
}

function removeListingWithMyID(id) {
    console.log(id);
    apiRequest('removeListingWithID', {id: id}, null);
}

function addCallback(html)
{
  var data = JSON.parse(html);
  if(data['error']) {
      $("#listingFeedback").html(data['message']);
      $("#listingFeedback").show();
      console.log('fail: ' + data['message']);
  }
  else
  {
    $("#listingFeedback").hide();
    console.log('Added entry!');
    $('#remoteModal').modal('hide');
  }
}

function listingCallback(html)
{
    var data = JSON.parse(html);
    if(data['error']) {
        $("#listingFeedback").html(data['message']);
        $("#listingFeedback").show();
        console.log('fail');
    }else{
        $("#loginUsernameFeedback").hide();
        var result = JSON.parse(data["data"]);
        console.log(result[0]);
        setTimeout(function()
        {
         var itemname = $('<button type="button" class="close bigtext" data-dismiss="modal">&times;</button><h4 class="modal-title modalbuytext"><b><a target="_blank" class="eorzeadb_link" href="https://na.finalfantasyxiv.com/lodestone/playguide/db/item/'+result[0]["lodestone_item_id"]+'">'+ result[0]["item_nicename"] +'</a></b></h4>');
         $("#inameheader").html(itemname);
         var itemimg = $('<a target="_blank" class="eorzeadb_link" href="https://na.finalfantasyxiv.com/lodestone/playguide/db/item/'+result[0]["lodestone_item_id"]+'"> <img class="img-rounded" src="'+result[0]["item_image_url"]+'" alt="Image" width="100" height="100"></a>');
         $("#itemimg").html(itemimg);
         var iteminfo = $('<table class="bigtext cellpadderino"><tr><td align="left">Price: </td><td align="right"> '+result[0]["item_price"]+' Gil</td></tr><tr><td align="left">Quantity: </td><td align="right"> '+result[0]["item_count"]+'</td></tr></table>');
         $("#iteminfo").html(iteminfo);
         var itemdescr = $('<p">Item description:<br>'+result[0]["item_description"]+'</p>');
         $("#itemdescr").html(itemdescr);
         var charname = $('<table class="fixedtable midtext"><tr><td align="left"><img class="img-circle" src="'+result[0]["character_avatar_url"]+'" style="height: 50px; float: left"></td> <td valign="center" align="center"> '+result[0]["character_name"]+'</td>\n\</table>');
         $("#charname").html(charname);
         var comment = $('<table class="fixedtable cellpadderino"><tr><td valign="top" align="left"><b>Comment: </b></td></tr><tr><td align="left"> '+result[0]["comment"]+'</td></tr></table>');
         $("#comment").html(comment);
       }, 200);
    }
}

function getItemCallback(html)
{
  var data = JSON.parse(html);
  if(data['error']) {
      $("#listingFeedback").html(data['message']);
      $("#listingFeedback").show();
      console.log('fail');
  }else{
      $('#listingItemName').empty();
      $('#listingItemDescription').empty();
      $("#loginUsernameFeedback").hide();
      var result = JSON.parse(data["data"]);
      var itemID = result[0]["item_id"];
      var itemName = $('<p>' + result[0]["name"] + '</p>');
      var itemDescription = $('<p>' + result[0]["description"] + '</p>');
      var itemImage = $('<img class="image-rounded" src="' + result[0]["icon"] + '" alt="placeholder" width="100" height="100">');
      $("#listingItemInfo").attr('class', "row");
      $("#listingSpacerAfterInfo").attr('class', "");
      $('#listingItemName').html(itemName);
      $("#listingItemDescription").html(itemDescription);
      $("#listingItemImage").html(itemImage);
      $("#listingItemID").val(itemID);
  }
}
