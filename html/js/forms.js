// All form related JS belongs in this file
function validateCreateForm() {
  var nameInput = document.getElementById("createUsernameInput");;
  var inputField = document.getElementById("createUsernameBox");;
  var feedbackIcon = document.getElementById("createFeedback");

    // If the nameinput is equal to Name mark it correct! 
    if (nameInput.value == "Name") {
        inputField.className = "form-group has-success has-feedback"
        feedbackIcon.className = "glyphicon glyphicon-ok form-control-feedback";
    }else{
        inputField.className = "form-group has-error has-feedback"
        feedbackIcon.className = "glyphicon glyphicon-remove form-control-feedback";
    }
}
