
$('#iniciar').click(function () {
  var usuario = $("#emails").val();
  var contrasena = $("#password").val();


  var url = "./controller/controller_sesion.php"
  $.post(url, {usuario:usuario, contrasena:contrasena}, function(datos){
    $('#respuesta').html(datos);
  });
  
});