function tryLogin() {
    var user = $('#loginUsername').val();
    var pass = $('#loginPassword').val();
    apiRequest('login', {username: user, password: pass}, loginCallback);
}

function loginCallback(html) {
    console.log(html);
    var data = JSON.parse(html);
    console.log(data);
    if(data['error']) {
        $("#loginUsernameFeedback").html(data['message']);
        $("#loginUsernameFeedback").show();
        console.log('fail');
    } else {
        $("#loginUsernameFeedback").hide();
        console.log('succcess');
        location.reload();
    }
}

// Function to loggout
function tryLoggout(){
  apiRequest('logout', null, loggoutCallback)
}

// logout callback
function loggoutCallback(html){
    console.log(html); // debug the returned html
    var data = JSON.parse(html); // parse to json
    console.log(data); // debug parsed

    if(data['error']){
      console.log('fail: ' + data['message']); // write error to console
    }else{
      location.reload(); // reloads the page
    }
}
