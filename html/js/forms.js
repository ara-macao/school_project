// All form related JS belongs in this file

// This function validates if the username is already in use or isn't correct format
function validateCreateUsername(){

  var inputUsername = document.getElementById("createUsernameInput").value;

  // createAccount
  var xhttp = new XMLHttpRequest();
  var url = './api/?action=checkUser';
  var params = 'username=' + inputUsername;

  xhttp.open("POST", url, true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.onreadystatechange = function() {//Call a function when the state changes.

      if(xhttp.readyState == 4 && xhttp.status == 200) {

        if(inputUsername.length > 0){
          // Get fields for username
          var createUsernameBox = document.getElementById("createUsernameBox");;
          var feedbackHelper = document.getElementById("createUsernameHelper");
          var usernameFeedbackIcon = document.getElementById("createUsernameFeedback");

          // Debug response
          console.log(JSON.parse(xhttp.responseText));

          // Parse response
          var response = JSON.parse(xhttp.responseText);

          // If the response contain no error
          if(response['error'] == false){
            createUsernameBox.className = "form-group has-success has-feedback"
            feedbackHelper.style.visibility = "hidden";
            usernameFeedbackIcon.className = "glyphicon glyphicon-ok form-control-feedback";
          }else{
            createUsernameBox.className = "form-group has-error has-feedback"
            feedbackHelper.style.visibility = "visible";
            feedbackHelper.innerHTML = response['message'];
            usernameFeedbackIcon.className = "glyphicon glyphicon-remove form-control-feedback";

          }
        }
      }
    }
  xhttp.send(params);
}

// This function validates if the email is the correct format
function validateCreateEmail() {

  var emailInput = document.getElementById("createEmailInput");;

  if(emailInput.value.length != 0){
    // Get fields for email
    var createEmailBox = document.getElementById("createEmailBox");;
    var emailHelper = document.getElementById("createEmailHelper");
    var emailFeedbackIcon = document.getElementById("createEmailFeedback");

    // email Regex
    var expression = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    var emailGiven = emailInput.value;
    var regex = new RegExp(expression);
    var result = regex.test(emailGiven);

    // Check username input
    if (result) {
        createEmailBox.className = "form-group has-success has-feedback"
        emailHelper.style.visibility = "hidden";
        emailFeedbackIcon.className = "glyphicon glyphicon-ok form-control-feedback";

        return true;
    }else{
        createEmailBox.className = "form-group has-error has-feedback"
        emailHelper.style.visibility = "visible";
        emailHelper.innerHTML = "The error message";
        emailFeedbackIcon.className = "glyphicon glyphicon-remove form-control-feedback";
    }
  }

  return false;
}

// This function validates if the password is the correct format
function validatePassword() {

  var passwordInput = document.getElementById("createPassword");;

  if (passwordInput.value.length != 0) {
    // Get fields for email
    var createPasswordBox = document.getElementById("createPasswordBox");;
    var passwordHelper = document.getElementById("createPasswordHelper");
    var passwordFeedbackIcon = document.getElementById("createPasswordFeedback");

    // Password expresion that requires one lower case letter, one upper case letter,
    // one digit, 6-13 length, and no spaces. This is merely an extension of a previously
    // posted expression by Steven Smith (ssmith@aspalliance.com) . The no spaces is new.
    var expression = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).{4,8}$/;

    var passwordGiven = passwordInput.value;
    var regex = new RegExp(expression);
    var result = regex.test(passwordGiven);

    // Check username input
    if (result) {
        createPasswordBox.className = "form-group has-success has-feedback"
        passwordHelper.style.visibility = "hidden";
        passwordFeedbackIcon.className = "glyphicon glyphicon-ok form-control-feedback";

        return true;
    }
    else {
        createPasswordBox.className = "form-group has-error has-feedback"
        passwordHelper.style.visibility = "visible";
        passwordHelper.innerHTML = "Must be 6-13 characters long with one upper case letter, one digit and no spaces.";
        passwordFeedbackIcon.className = "glyphicon glyphicon-remove form-control-feedback";
    }
  }

  return false;
}

// Handles the form of creating a account, displays message based on the result!
function validateCreateForm() {

  var inputUsername = document.getElementById("createUsernameInput").value;
  var emailInput = document.getElementById("createEmailInput").value;
  var passwordInput = document.getElementById("createPassword").value;
  var verPasswordInput = document.getElementById("createVerPassword").value;
  // createAccount
  var xhttp = new XMLHttpRequest();
  var url = './api/?action=createAccount';
  var params = 'username=' + inputUsername + '&mail=' + emailInput + '&password=' + passwordInput+ '&verpassword=' + verPasswordInput;

  xhttp.open("POST", url, true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.onreadystatechange = function() {//Call a function when the state changes.

      if(xhttp.readyState == 4 && xhttp.status == 200) {

          // Debug response
          //console.log(xhttp.responseText);
          console.log(JSON.parse(xhttp.responseText));

          // Parse response
          var response = JSON.parse(xhttp.responseText);

          // If the response contain no error
          if(response['error'] == false){
            var box = document.getElementById("createResult");
            box.style.visibility = "visible";
            box.innerHTML = response['message'];
            box.className = "alert alert-success"

            var sendButton = document.getElementById("submitButton");
              sendButton.parentNode.removeChild(sendButton);

          }else{
            var box = document.getElementById("createResult");
            box.style.visibility = "visible";
            box.innerHTML = response['message'];
            box.className = "alert alert-danger"
          }
      }
    }
  xhttp.send(params);
}
