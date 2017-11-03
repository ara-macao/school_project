function serverList() {
    apiRequest('getServerList', {}, placeButton);
}

function placeButton(html) {
    var data = JSON.parse(html);
    if (data['error']) {
        $("#loginUsernameFeedback").html(data['message']);
        $("#loginUsernameFeedback").show();
        console.log('fail');
    } else {
        var result = JSON.parse(html);
        for (var i = 0; i < result["data"].length; i++) {
            if (result["data"][i]["id"] === 1) {
                var radioBtn = $('<label><input type="radio" checked="checked" name="serverbtn" value=' + result["data"][i]["id"] + '> ' + result["data"][i]["server"] + '</input></label><br>');
                radioBtn.appendTo("#" + result["data"][i]["datacenter"]);
            } else {
                var radioBtn = $('<label><input type="radio" name="serverbtn" value=' + result["data"][i]["id"] + '> ' + result["data"][i]["server"] + '</input></label><br>');
                radioBtn.appendTo("#" + result["data"][i]["datacenter"]);
            }
        }
        $("#loginUsernameFeedback").hide();
        console.log('succcess');
    }
}