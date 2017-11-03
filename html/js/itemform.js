function getListItemId() {
    var id = $('#id').val();
    apiRequest('getListingWithID', {id: id}, listItemCallback);
}

function listItemCallback(html)
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
        var itemname = $('<h4 class="modal-title">'+result["data"]["item_nicename"]+'</h4>');
        itemname.appentTo("#inameheader");
        var iteminfo = $("test");
        iteminfo.appendTo("#iteminfo");
    }
}
