function searchItems(){
  var id = $('input[name=serverbtn]:checked', '#radiobuttons').val();
  var searchInput = $('#itemInputField').val();
  console.log(searchInput);
  apiRequest('searchListing', {serverid: id, searchInput: searchInput}, refreshCallback);
}

function refreshListing(id) {
    var isbuying = $('#isbuying').val();
    apiRequest('getListings', {isbuying: isbuying, serverid: id}, refreshCallback);
}

function getListingWithID(id) {
    apiRequest('getListingWithID', {id: id}, listingCallback);
}

function removeListingWithID() {
    var id = $('#id').val();
    apiRequest('removeListingWithID', {id: id}, listingCallback);
}

function addListing() {
    var characterid = $('#characterid').val();
    var itemid = $('#itemid').val();
    var listingtype = $('#listingtype').val();
    var itemprice = $('#itemprice').val();
    var itemcount = $('#itemcount').val();
    var comment = $('#comment').val();
    apiRequest('addListing', {characterid: characterid, itemid: itemid, listingtype: listingtype, itemprice: itemprice, itemcount: itemcount, comment: comment}, listingCallback);
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
        var result = JSON.parse(data["data"]);
        for (var i = 0; i < result.length; i++) {
          var listing = $('<button type="button" data-button={"listingid":' + result[i]["listing_id"] + '} class="btn btn-' + (result[i]["listing_type"] == 0 ? 'primary' : 'warning') + ' col-12" data-toggle="modal" href="forms/buyitem.php" onclick="getListingWithID(' + result[i]["listing_id"] + ')" id="buyitem" data-target="#remoteModal" > ' + result[i]["item_count"] + " x " + result[i]["item_price"] + " GIL    " + result[i]["item_nicename"] + '</button><br><div class="smallspacer"></div>');
          listing.appendTo("#" + (result[i]["listing_type"] == 0 ? "sell" : "buy") + "-orders");
          //console.log(result[i]);
        }
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
         var itemname = $('<button type="button" class="close bigtext" data-dismiss="modal">&times;</button><h4 class="modal-title modalbuytext"><b>'+ result[0]["item_nicename"] +'</b></h4>');
         $("#inameheader").html(itemname);
         var itemimg = $('<img class="img-rounded" src="'+result[0]["item_image_url"]+'" alt="Image" width="100" height="100">');
         $("#itemimg").html(itemimg);
         var iteminfo = $('<table class="bigtext cellpadderino"><tr><td align="left">Price: </td><td align="right"> '+result[0]["item_price"]+' Gil</td></tr><tr><td align="left">Amount: </td><td align="right"> '+result[0]["item_count"]+'</td></tr></table>');
         $("#iteminfo").html(iteminfo);
         var itemdescr = $('<p">Item description:<br>'+result[0]["item_description"]+'</p>');
         $("#itemdescr").html(itemdescr);
         var charname = $('<table class="midtext fixedtable"><tr><td align="left">Character: </td><td align="right"> '+result[0]["character_name"]+'</td></tr>\n\
         <tr><td align="left">Server: </td><td align="right"> '+result[0]["server_name"]+'</td></tr></table>');
         $("#charname").html(charname);
         var comment = $('<table class="fixedtable cellpadderino"><tr><td valign="top" align="left"><b>Comment: </b></td></tr><tr><td align="left"> '+result[0]["comment"]+'</td></tr></table>');
         $("#comment").html(comment);
       }, 200);
    }
}

function myListings() {
  apiRequest('getListingFromUser', {user: user}, myListingsCallback);
}

function myListingsCallback(html) {
  console.log(html); // debug the returned html
  var data = JSON.parse(html); // parse to json
  console.log(data); // debug parsed

  if(data['error']) {
    console.log('fail: ' + data['message']); // write error to console
  }
  else {
    //console.log(data['data']);
    var itemArray = data['data'];
    for (var i = 0; i < itemArray.length; i++) {
      var itemAmount = itemArray[i]['item_count'];
      var itemPrice = itemArray[i]['item_price'];
      var itemName = itemArray[i]['item_nice_name'];
      var itemImg = itemArray[i]['item_url'];
      var listingId = itemArray[i]['listing_id'];
      var orderType = itemArray[i]['listing_type'];

      // Create a well element where all the character info will be located.
      var well = document.createElement("div");
      well.setAttribute("class", "well well-sm");
      well.setAttribute("id", listingId);

      var image = document.createElement("img");
      image.setAttribute("class", "img-rounded");
      image.setAttribute("style", "height: 50px;");
      image.setAttribute("src", itemImg);

      var text = document.createTextNode(" " + itemName + " " + itemAmount + " " + itemPrice + " " + orderType);

      var removeButton = document.createElement("button");
      removeButton.setAttribute("type", "button");
      removeButton.setAttribute("style", "float: right; margin: 8px");
      removeButton.setAttribute("class", "btn btn-danger");
      removeButton.setAttribute("onclick", "removeListing(" + listingId + ")");

      var removeButtonText = document.createTextNode("Remove");
      removeButton.appendChild(removeButtonText);

      // Make all the elements child of the well element.
      well.appendChild(image);
      well.appendChild(text);
      well.appendChild(removeButton);
      document.getElementById("myListings").appendChild(well);
    }
  }
}
