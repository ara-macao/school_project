function refreshListing() {
    var isbuying = $('#isbuying').val();
    apiRequest('getListings', {isbuying: isbuying}, listingCallback);
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

function listingCallback(html) {
    console.log(html);
    var data = JSON.parse(html);
    console.log(data);
    if(data['error']) {
        $("#listingFeedback").html(data['message']);
        $("#listingFeedback").show();
        console.log('fail');
    }else {
        $("#loginUsernameFeedback").hide();
        console.log('succcess');
        location.reload();
    }
  }
