<!--AUTOCOMPLETAR NOT FOUND,-->
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href= style/bootstrap.css >
	<link rel="stylesheet" href= js/jquery-3.7.0.js >
    <link rel="stylesheet" href= style/styles.css >
    <link rel="stylesheet" href="datatables.css" >
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
include_once("./view/nav_bar.php");
?>

<!--NAV BAR END -->
    <div class="container">
		
      <br>
    <!-- Cambiar  -->
      <div class="card">
        <div class="card-header">
          Tabla de Niños
        </div>
        <div class="card-body">
          <p class="card-text">
            <?php echo "Bienvenido ".$_SESSION["perfil"]." ".$_SESSION["test"]; ?>
            <?php echo "Crear:".$_SESSION["CCN"]." Editar:".$_SESSION["CUN"]." Leer".$_SESSION["CRN"]." Delete:".$_SESSION["CDN"]; ?>
          </p>
		  <div class="container">
        <div class="row">
            <div class="col-lg-12">       
            <?php 
            if ($_SESSION["CCN"] == 1) {
              echo '<button id="btnNuevo" type="button" class="btn btn-info bi bi-plus" data-toggle="modal"><i class="material-icons">';
              echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">';
			        echo '<path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>';
			        echo    '</svg>';
            }
            ?>     
			

			</i></button>    
			
		</div>    
        </div>    
    </div> 


      </div>
   

      <!--  x-->
      <?php 
		

	
	  require_once './controller/controller_vista.php';
		if ($_SESSION["CRN"] == 1) {
      if ($_SESSION["id_p"] == 3) {
        echo "funciona";
      }
      else {
        test2();
      }
      
    }
    else {
      echo "NO TIENES PERMISOS";
    }



      
      ?>
    <!-- -->
    </div>
	
    </div>
    

    
    
  </body>
</html>