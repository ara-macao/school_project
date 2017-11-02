function serverList(){
  apiRequest('getServerList', null, placeButton);
  }
  function placeButton(html){
      console.log(html);
      var data = JSON.parse(html);
      console.log(data);
      if(data['error']) {
          $("#loginUsernameFeedback").html(data['message']);
          $("#loginUsernameFeedback").show();
          console.log('fail');
      }else {
          $("#loginUsernameFeedback").hide();
          console.log('succcess');
      }
  }