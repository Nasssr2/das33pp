$(document).ready(function () {
  $("#searchFind").addClass('jqSearchFindClass1');
  $("#searchLost").addClass('jqSearchLostClass1');
  $("#searchFind").click(function () {
    $("#searchFind").addClass('jqSearchFindClass2');
    $("#searchLost").addClass('jqSearchLostClass2');
  });
  $("#searchLost").click(function () {
    $("#searchFind").removeClass('jqSearchFindClass2');
    $("#searchLost").removeClass('jqSearchLostClass2');
  });  
});