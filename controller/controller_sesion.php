<?php
  //llama al MenuModel
  require_once("../model/MODEL_SESION.php");
$menu= new MenuModel();
$USUARIO = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
$PASS = (isset($_POST['contrasena'])) ? $_POST['contrasena'] : '';


$datos=$menu->loginPersonal($USUARIO,$PASS);
if($datos === TRUE){ ;
  session_start();
  $datos=$menu->datosPersonal($USUARIO,$PASS);
  
  $_SESSION["id_persona"]=$datos[0]['id_persona'];
  $_SESSION["test"]=$datos[0]['nombre'];
  $_SESSION["perfil"]=ucfirst($datos[0]['PERFIL']);
  $_SESSION["id_p"]=$datos[0]['id'];
  $_SESSION["CCN"]=$datos[0]['checkCreateN'];
  $_SESSION["CUN"]=$datos[0]['checkUpdateN'];
  $_SESSION["CRN"]=$datos[0]['checkReadN'];
  $_SESSION["CDN"]=$datos[0]['checkDeleteN'];
  $_SESSION["CCO"]=$datos[0]['checkCreateO'];
  $_SESSION["CUO"]=$datos[0]['checkUpdateO'];
  $_SESSION["CRO"]=$datos[0]['checkReadO'];
  $_SESSION["CDO"]=$datos[0]['checkDeleteO'];
  $_SESSION["CCP"]=$datos[0]['checkCreateP'];
  $_SESSION["CUP"]=$datos[0]['checkUpdateP'];
  $_SESSION["CRP"]=$datos[0]['checkReadP'];
  $_SESSION["CDP"]=$datos[0]['checkDeleteP']; 




  $_SESSION["tipo_usuario"]=$datos[0]['tipo'];

  if ($_SESSION["id_p"] == 4) {
             echo '</div>
          <script type="text/javascript"> 
          Swal.fire({
            icon: "warning",
            title: "PERMISOS INSUFICIENTES",
            width: 300,
            showConfirmButton: false,
            timer: 1500
            
          });


          </script>';
  }
  else {
    echo '</div>
          <script type="text/javascript"> 
          Swal.fire({
            icon: "success",
            title: "ENTRANDO",
            width: 300,
            showConfirmButton: false,
            timer: 1500
            
          });
          const myTimeout = setTimeout(myGreeting, 1700);

          function myGreeting() {
            window.location.href="view/ninos.php"
          }

          </script>';
  }
  ?>



  <?php

}else{
  
?>

      <!-- usuario incorrecto -->
  <script>
 Swal.fire({
  
  title: "Oops...",
  width: 300,
  imageUrl: "https://navidad.es/wp-content/uploads/2009/10/santa-se-quema-en-chimenea.gif",
  imageWidth: 400,
  imageHeight: 200,
  text: "usuario incorrecto",
  didOpen: () =>{
    Swal.getPopup().addEventListener('keydown',(e)=>{
      if(e.key===13){
        Swal.close();
      }
    })
    
  }
});

  </script>

  <?php
}

?>