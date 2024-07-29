<!--AUTOCOMPLETAR NOT FOUND,-->
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href= ../style/font/bootstrap-icons.min.css >
    
     <!-- Incluir jQuery y Popper.js (necesario para Bootstrap) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <!-- Incluir Bootstrap JS (opcional) -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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


    <?php
    session_start();
    ?>

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
    