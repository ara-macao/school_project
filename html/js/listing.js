function refreshListing() {
    var isbuying = $('#isbuying').val();
    apiRequest('getListings', {isbuying: isbuying}, refreshCallback);
}

function getListingWithID() {
    var id = $('#id').val();
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
          var listing = $('<button type="button" class="btn btn-' + (result[i]["listing_type"] == 0 ? 'primary' : 'warning') + ' col-sm-12" data-toggle="modal" href="forms/buyitem.php" id="buyitem" data-target="#remoteModal"> ' + result[i]["item_count"] + " x " + result[i]["item_price"] + " GIL    " + result[i]["item_nicename"] + '</button><br>');
          listing.appendTo("#" + (result[i]["listing_type"] == 0 ? "sell" : "buy") + "-orders");
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
        var result = data["data"];
        console.log(result);
    }
}
