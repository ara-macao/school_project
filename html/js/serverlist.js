function serverList() {
    apiRequest('getServerList', {}, placeButton);
}

function placeButton(html) {
    console.log(html);
    var data = JSON.parse(html);
    console.log(data);
    if (data['error']) {
        $("#loginUsernameFeedback").html(data['message']);
        $("#loginUsernameFeedback").show();
        console.log('fail');
    } else {
        var result = JSON.parse(html);
        for (var i = 0; i < result["data"].length; i++) {
            var radioBtn = $('<label><input type="radio" name="optradio" name='+result["data"][i]["id"]+'> ' + result["data"][i]["server"] + '</input></label><br>');
            radioBtn.appendTo("#"+result["data"][i]["datacenter"]);         
        }
        $("#loginUsernameFeedback").hide();
        console.log('succcess');
    }
}