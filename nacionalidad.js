
$('#iniciar').click(function () {
    var usuario = $("#emails").val();
    var contrasena = $("#password").val();
  
  
    var url = "./controller/controller_nac.php"
    $.post(url,function(datos){
      $('#respuesta').html(datos);
    });
    
  });

function myFunction() {
    $.post(url, {usuario:usuario, contrasena:contrasena}, function(datos){
        $('#demo').html(datos);
      });
}

let result = myFunction();
document.getElementById("demo").innerHTML = result;