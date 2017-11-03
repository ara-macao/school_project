// typt de eerste 3 chararacters -> modulo
// dan doe je request naar de server met itemsearch met 3 chararacters
// die genereert dataset die hij teruggeeft
// dan update je jquery

// database search
// Onchangeevent kijken naar value (kijk 0 zo niet modulo 3 als die 0 is -> check dan result max 5 of 10)

// Auto complete
function tryAutoComplete(){
  var input = $("#itemInputField").val();
  var stringLength = input.length;

  if(stringLength == 0){
    cleartryAutoCompleteCallbackSource();
  }else{
    if(stringLength % 3 == 0)
      apiRequest('autoComplete', {searchInput:input}, tryAutoCompleteCallback);
  }
}

// logout callback
function tryAutoCompleteCallback(html){
    console.log(html); // debug the returned html
    var data = JSON.parse(html); // parse to json
    console.log(data); // debug parsed

    if(data['error']){
      console.log('fail: ' + data['message']); // write error to console
    }else{

      var length = data['message'].length;
      var itemArray = [];

      for (var i = 0; i < length; i++) {
        var itemName = data['message'][i]['item_nicename'];
        itemArray.push(itemName);
      }


      var availableTags = itemArray;

      $( "#itemInputField" ).autocomplete({
        source: availableTags
      });

    }
}

function cleartryAutoCompleteCallbackSource(){
  var availableTags = "";

  $( "#itemInputField" ).autocomplete({
    source: availableTags
  });
}
