$(document).ready(function(){
    $( "#olho" ).mousedown(function() {
        $("#senha").attr("type", "text");
        $("#olho i").removeClass("fa-eye").addClass("fa-eye-slash");
      });    
      $( "#olho" ).mouseup(function() {
        $("#senha").attr("type", "password");
        $("#olho i").removeClass("fa-eye-slash").addClass("fa-eye");
      });
  });