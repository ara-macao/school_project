// All form related JS belongs in this file
function validateForm() {
  var userInput = document.getElementById("usernameInputField");;
  var inputDiv = document.getElementById("usernameInputDiv");;
  var feedback = document.getElementById("usernameFeedback");

    if (userInput.value == "Name") {
        inputDiv.className = "form-group has-success has-feedback"
        feedback.className = "glyphicon glyphicon-ok form-control-feedback";
    }else{
        inputDiv.className = "form-group has-error has-feedback"
        feedback.className = "glyphicon glyphicon-remove form-control-feedback";
    }
}
