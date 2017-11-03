// typt de eerste 3 chararacters -> modulo
// dan doe je request naar de server met itemsearch met 3 chararacters
// die genereert dataset die hij teruggeeft
// dan update je jquery

// database search
// Onchangeevent kijken naar value (kijk 0 zo niet modulo 3 als die 0 is -> check dan result max 5 of 10)

function trySearch(){
  var input = $("#itemInputField").val();
  apiRequest('autoComplete', {searchInput:input}, trySearchCallback);
}

// logout callback
function trySearchCallback(html){
    console.log(html); // debug the returned html
    var data = JSON.parse(html); // parse to json
    console.log(data); // debug parsed

    if(data['error']){
      console.log('fail: ' + data['message']); // write error to console
    }else{
        // To-do
    }
}
