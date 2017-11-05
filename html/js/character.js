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
      var lodestoneId = charArray[0]['lodestone_character_id'];

      // Create a well element to show character info.
      var wellElement = document.createElement("div");
      wellElement.setAttribute("class", "well well-sm");

      // <img src="cinqueterre.jpg" class="img-rounded" alt="Cinque Terre" width="304" height="236">
      var imageElement = document.createElement("img");
      imageElement.setAttribute("class", "img-rounded");
      imageElement.setAttribute("style", "height: 50px");
      imageElement.setAttribute("src", charImgUrl);

      var text = document.createTextNode(" " + charName + " " + lodestoneId);

      wellElement.appendChild(imageElement);
      wellElement.appendChild(text);
      document.getElementById("linkedCharacters").appendChild(wellElement);
      //console.log(charArray[i]);
    }
  }
}
