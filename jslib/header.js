$(document).ready(function () {
  
  $('#noti_number').bind('DOMSubtreeModified', function(){
  console.log('changed');
    if($("#noti_number").text()==0||$("#noti_number").text()=="0"){
      $("#noti_number").hide();
    }else $("#noti_number").show();
  });  
  
});