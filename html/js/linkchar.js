function requestVerificationKey() {
    apiRequest('newCharacterChallenge', {}, verificationKeyCallback);
}

function verificationKeyCallback(html) {
    console.log(html);
    var data = JSON.parse(html);
    console.log(data);
    if(data['error']) {
        console.log('fail');
    }
    else {
        $("#verificationKey").html(data['message']);
        $("#verificationKey").show();
        $("#verificationKeyInfo").show();
        console.log('succcess');
    }
}

function verifyCharacter() {
    var url = $('#verificationUrl').val();
    apiRequest('verifyCharacter', {lodestoneUrl: url}, verifyCharacterCallback);
}

function verifyCharacterCallback(html) {
    console.log(html);
    var data = JSON.parse(html);
    console.log(data);
    if(data['error']) {
        $("#verifyCharacterFail").html(data['message']);
        $("#verifyCharacterFail").show();
        console.log('fail');
    }
    else {
        $("#verifyCharacterSuccess").html(data['message']);
        $("#verifyCharacterSuccess").show();
        console.log('succcess');
    }
}
