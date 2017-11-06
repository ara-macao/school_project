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

function getCharacters() {
  apiRequest('getCharacters', null, getCharactersCallback);
}

function getCharactersCallback(html) {
  console.log(html); // debug the returned html
  var data = JSON.parse(html); // parse to json
  console.log(data); // debug parsed

  if(data['error']) {
    console.log('fail: ' + data['message']); // write error to console
  }
  else {
    //console.log(data['data']);
    var charArray = data['data'];
    for (var i = 0; i < charArray.length; i++) {
      var charImgUrl = charArray[i]['character_avatar_url'];
      var charName = charArray[i]['character_name'];
      var lodestoneID = charArray[i]['lodestone_character_id'];

      // Create a well element where all the character info will be located.
      var well = document.createElement("div");
      well.setAttribute("class", "well well-sm");
      well.setAttribute("id", lodestoneID);

      var image = document.createElement("img");
      image.setAttribute("class", "img-rounded");
      image.setAttribute("style", "height: 50px; border-radius: 60px");
      image.setAttribute("src", charImgUrl);

      var text = document.createTextNode(" " + charName + " " + lodestoneID);

      var removeButton = document.createElement("button");
      removeButton.setAttribute("type", "button");
      removeButton.setAttribute("style", "float: right; margin: 8px");
      removeButton.setAttribute("class", "btn btn-danger");
      removeButton.setAttribute("onclick", "removeCharacter(" + lodestoneID + ")");

      var removeButtonText = document.createTextNode("Remove");
      removeButton.appendChild(removeButtonText);

      // Make all the elements child of the well element.
      well.appendChild(image);
      well.appendChild(text);
      well.appendChild(removeButton);
      document.getElementById("linkedCharacters").appendChild(well);
    }
  }
}

function removeCharacter(charID) {
  apiRequest('deleteCharacter', {characterid: charID}, removeCharacterCallback);
}

function removeCharacterCallback(html) {
  console.log(html);
  var data = JSON.parse(html);
  console.log(data);

  if (data['error']) {
    console.log('fail: ' + data['message']);
  }
  else {
    console.log('succcess');
    // Remove deleted character element.
    document.getElementById(data['data']).remove();
  }
}
