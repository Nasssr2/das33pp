$(document).ready(function () {
  $("#findTypelbl").addClass('jqSearchFindClass1');
  $("#lostTypelbl").addClass('jqSearchLostClass1');

  $("#findTypelbl").click(function () {
    $("#findTypelbl").addClass('jqSearchFindClass2');
    $("#lostTypelbl").addClass('jqSearchLostClass2');
  });
  $("#lostTypelbl").click(function () {
    $("#findTypelbl").removeClass('jqSearchFindClass2');
    $("#lostTypelbl").removeClass('jqSearchLostClass2');
  });
});