$(document).ready(function() {

  $('#verirun').click(function(e) {
    e.preventDefault();

    var jTipo = $("#hTipo").val();
    var jRun = $("#hRun").val();
    var jSerie = $("#hSerie").val();
    var jEmail = $("#hEmail").val();

    $.ajax({
      type: "POST",
      url: "/validador.php",
      data: {
        sTipo: jTipo,
        sRun: jRun,
        sSerie: jSerie
      },
      success: function(response) {
        alert(response);
      }
    });

  });

});
