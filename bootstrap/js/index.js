function hideconfirmMess(){
  $('.form-backa').css({"display": "none"});
  $('#delButton').val("");
}

function askBeforeDelete(id){
  $('.form-backa').css({"display": "block"});
  $('#delButton').val(id);
}

function deleteNews(){
  var id = $('#delButton').val();    
  $.ajax({
        url: "delete-news.php",
        type: "GET",
        data: {key: id},
        success: function(){
                  window.location.reload();
                 }
   });
}