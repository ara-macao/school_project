// All form related JS belongs in this file
function validateValuesCreateForm() {



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
    }else{
        createEmailBox.className = "form-group has-error has-feedback"
        emailHelper.style.visibility = "visible";
        emailHelper.innerHTML = "The error message";
        emailFeedbackIcon.className = "glyphicon glyphicon-remove form-control-feedback";
    }
  }
}


// Handles the form of creating a account, displays message based on the result!
function validateCreateForm() {

  // vallidation check here
  var usernameWarning = document.getElementById("createUsernameHelper");
  var emailWarning = document.getElementById("createEmailHelper");
  var emailWarning = document.getElementById("createEmailHelper");

  var succeed = true;

  // if the validation was correct
  if(succeed){
    document.getElementById("submitButton").style.visibility = "hidden";
    document.getElementById("createResult").style.visibility = "visible"
    document.getElementById("createResult").className = "alert alert-success";
    document.getElementById("createResult").innerHTML = "Succeed!"
  }else{
    document.getElementById("submitButton").style.visibility = "visible";
    document.getElementById("createResult").style.visibility = "visible"
    document.getElementById("createResult").className = "alert alert-danger";

    // Show the error message
    document.getElementById("createResult").innerHTML = "Something went wrong!"
  }
}

function checkUsername(){
  var inputUsername = document.getElementById("createUsernameInput").value;

  // createAccount
  var xhttp = new XMLHttpRequest();
  var url = './api/?action=checkUser';
  var params = 'username=' + inputUsername;

  xhttp.open("POST", url, true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.onreadystatechange = function() {//Call a function when the state changes.

      if(xhttp.readyState == 4 && xhttp.status == 200) {

          //alert(xhttp.responseText);
          if(inputUsername.length > 0){
            // Get fields for username
            var createUsernameBox = document.getElementById("createUsernameBox");;
            var feedbackHelper = document.getElementById("createUsernameHelper");
            var usernameFeedbackIcon = document.getElementById("createUsernameFeedback");

            console.log(JSON.parse(xhttp.responseText));

            var response = JSON.parse(xhttp.responseText);

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
