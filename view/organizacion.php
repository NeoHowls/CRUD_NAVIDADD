<?php
    session_start();
    if (!isset($_SESSION["id_persona"]) || empty($_SESSION["id_persona"])) {
      header("Location:../index.php");
    }
    else{
?><!--AUTOCOMPLETAR NOT FOUND,-->
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="../images/Escudo_de_Alto_Hospicio.png">
    <link rel="stylesheet" href= ../style/bootstrap.css >
	<link rel="stylesheet" href= ../js/jquery-3.7.0.js >
    <link rel="stylesheet" href= ../style/styles.css >
    <link rel="stylesheet" href="../datatables.css" >
    <script src="../js/sweetalert.js"></script>
    <link rel="stylesheet" href= ../style/font/bootstrap-icons.min.css >
    
  <!-- Incluir jQuery y Popper.js (necesario para Bootstrap) -->
  <script src="../js/jqueryBootstrap.js"></script>
     <script src="../js/popper.js"></script>
  <!-- Incluir Bootstrap JS (opcional) -->
  <script src="../js/bootstrapOP.js"></script>

  <script>
      // Script para mostrar el Tooltip al pasar el cursor sobre el botón
      $(document).ready(function() {
            // Inicializar tooltips de Bootstrap
          $('[data-toggle="tooltip"]').tooltip();
      });
    </script> 
    <style>
        /* estilos */
    </style>


    

    <title>Navidad</title>
    
  </head>
  <body id = "bodyt">
  <!--NAV BAR NEW -->
<?php
include_once("./nav_bar.php");
?>

<!--NAV BAR END -->

   

      <!--  x-->
      <?php 
		

	
	  require_once '../controller/controller_vista.php';
      //organizacion
      tablaOrg();
      
      ?>
    <!-- -->
    </div>
	
    </div>
    

    
    
  </body>
</html>
<?php

}

?>   