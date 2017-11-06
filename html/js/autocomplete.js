// typt de eerste 3 chararacters -> modulo
// dan doe je request naar de server met itemsearch met 3 chararacters
// die genereert dataset die hij teruggeeft
// dan update je jquery

// database search
// Onchangeevent kijken naar value (kijk 0 zo niet modulo 3 als die 0 is -> check dan result max 5 of 10)

// Auto complete
function tryAutoComplete(inputField){
  var currentField = '#' + inputField;
  var inputText = $(currentField).val();
  var stringLength = inputText.length;

  if(stringLength == 0){
    cleartryAutoCompleteCallbackSource(inputField);
  }else{
      apiRequest('autoComplete', {searchInput:inputText, searchField:currentField}, tryAutoCompleteCallback);
  }
}

// logout callback
function tryAutoCompleteCallback(html){

    //console.log(html); // debug the returned html
    var data = JSON.parse(html); // parse to json
    //onsole.log(data); // debug parsed

    console.log('Test' + data['data']['search'] );

    if(data['error']){
      console.log('fail: ' + data['message']); // write error to console
    }else{

      var length = data['data']['result'].length;
      var itemArray = [];

      for (var i = 0; i < length; i++) {
        var itemName = data['data']['result'][i]['item_nicename'];
        itemArray.push(itemName);
      }


      var availableTags = itemArray;

      $( data['data']['search'] ).autocomplete({
        source: availableTags
      });

    }
}

function cleartryAutoCompleteCallbackSource(inputField){
  var availableTags = "";

  $(inputField).autocomplete({
    source: availableTags
  });
}
