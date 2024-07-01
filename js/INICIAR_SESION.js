
$('#iniciar').click(function () {
  var usuario = $("#emails").val();
  var contrasena = $("#password").val();


  var url = "./controller/controller_sesion.php"
  $.post(url, {usuario:usuario, contrasena:contrasena}, function(datos){
    $('#respuesta').html(datos);
  });
  
});

// Evento para detectar la tecla Enter y disparar el clic en el botón "Iniciar Sesión"
window.addEventListener("keydown", (e) => {
  if (e.keyCode === 13) {
      e.preventDefault(); // Previene el comportamiento por defecto del Enter
      $('#iniciar').click(); // Dispara el evento de clic en el botón "Iniciar Sesión"
  }
});