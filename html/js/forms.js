// All form related JS belongs in this file
function validateUsernameCreateForm() {
  var nameInput = document.getElementById("createUsernameInput");;
  var inputField = document.getElementById("createUsernameBox");;
  var feedbackIcon = document.getElementById("createFeedback");
  var feedbackHelper = document.getElementById("createFeedbackHelper");

    // If the nameinput is equal to Name mark it correct!
    if (nameInput.value == "Name") {
        inputField.className = "form-group has-success has-feedback"
        feedbackIcon.className = "glyphicon glyphicon-ok form-control-feedback";
        feedbackHelper.style.visibility = "hidden";
    }else{
        inputField.className = "form-group has-error has-feedback"
        feedbackIcon.className = "glyphicon glyphicon-remove form-control-feedback";
        feedbackHelper.style.visibility = "visible";


        feedbackHelper.innerHTML = "The error message";
    }
}

// Handles the form of creating a account, displays message based on the result!
function validateCreateForm() {

  // vallidation check here

  var succeed = true;

  if(succeed){
    document.getElementById("submitButton").style.visibility = "hidden";
    document.getElementById("createResult").style.visibility = "visible"
    document.getElementById("createResult").className = "alert alert-success";
    document.getElementById("createResult").innerHTML = "Succeed!"
  }else{
    document.getElementById("submitButton").style.visibility = "visible";
    document.getElementById("createResult").style.visibility = "visible"
    document.getElementById("createResult").className = "alert alert-danger";
    document.getElementById("createResult").innerHTML = "Something went wrong!"
  }
}
