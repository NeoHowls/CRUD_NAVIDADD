<?php
    session_start();
    if (!isset($_SESSION["id_persona"]) || empty($_SESSION["id_persona"])) {
      header("Location:../index.php");
    }
    else{
?>
<!--AUTOCOMPLETAR NOT FOUND,-->
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href= ../style/bootstrap.css >
	<link rel="stylesheet" href= ../js/jquery-3.7.0.js >
    <link rel="stylesheet" href= ../style/styles.css >
    <link rel="stylesheet" href="../datatables.css" >
    <script src="../js/sweetalert.js"></script>
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
    <div class="container">
		
      <br>
    <!-- Cambiar  -->
      <div class="card">
        <div class="card-header">
          Perfiles
        </div>
        <div class="card-body">
          <p class="card-text">
            <?php echo "Bienvenido ".$_SESSION["perfil"]." ".$_SESSION["nombre"]." ".$_SESSION["id_p"]; ?>
          </p>
		  <div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevo" type="button" class="btn btn-info bi bi-plus" data-toggle="modal"><i class="material-icons">

			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
			<path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
			</svg>

			</i></button>    
			
		</div>    
        </div>    
    </div> 

   

      <!--  x-->
      <?php 
		

	
	  require_once '../controller/controller_vista.php';
		tablaPerfiles();
      ?>
    <!-- -->
    </div>
	
    </div>
    

    
    
  </body>
</html>
<?php

    }
   
?>