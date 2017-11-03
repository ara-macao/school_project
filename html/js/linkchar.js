function requestVerificationKey() {
    apiRequest('newCharacterChallenge', {}, verificationKeyCallback);
}

function verificationKeyCallback(html) {
    console.log(html);
    var data = JSON.parse(html);
    console.log(data);
    if(data['error']) {
        $("#verificationKey").hide();
        console.log('fail');
    }
    else {
        $("#verificationKey").html(data['message']);
        $("#verificationKey").show();
        $("#verificationKeyInfo").show();
        console.log('succcess');
    }
}
