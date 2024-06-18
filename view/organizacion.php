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
include_once("./nav_bar.php");
?>

<!--NAV BAR END -->
    <div class="container">
		
      <br>
    <!-- Cambiar  -->
      <div class="card">
        <div class="card-header">
          Tabla de Organizaciones
        </div>
        <div class="card-body">
          <p class="card-text">
            <?php echo "Bienvenido ".$_SESSION["perfil"]." ".$_SESSION["test"]." ".$_SESSION["id_p"]; ?>
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
	<!--Modal para CRUD-->
<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>

				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      
                </button>
            </div>
        <form id="formUsuarios">    
		<div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                    <div class="form-group">
                    <label for="" class="col-form-label">correlativo:</label>
                    <input type="text" class="form-control" id="correlativo">
                    </div>
                    <div class="form-group">
                    <label for="" class="col-form-label">nombre:</label>
                    <input type="text" class="form-control" id="nombre">
                    </div>
                    <div class="form-group">
                    <label for="" class="col-form-label">direccion:</label>
                    <input type="text" class="form-control" id="direccion">
                    </div>
                    <div class="form-group">
                    <label for="" class="col-form-label">tipo:</label>
                    <input type="text" class="form-control" id="tipo">
                    </div>
                    <div class="form-group">
                    <label for="" class="col-form-label">fechaVigencia:</label>
                    <input type="text" class="form-control" id="fechaVigencia">
                    </div>
                    <div class="form-group">
                    <label for="" class="col-form-label">checkVigente:</label>
                    <input type="text" class="form-control" id="checkVigente">
                    </div>
                    <div class="form-group">
                    <label for="" class="col-form-label">estado:</label>
                    <input type="text" class="form-control" id="estado">
                    </div>
                    <div class="form-group">
                    <label for="" class="col-form-label">numProvidencia:</label>
                    <input type="text" class="form-control" id="numProvidencia">
                    </div>
                    </div>
                    
                </div>
            <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
            </div>
        </form>    
        </div>
    </div>
</div>   

      </div>
   

      <!--  x-->
      <?php 
		

	
	  require_once '../controller/controller_vista.php';
      $nu = 4;
	  //permisos
	  if($nu == 1){
        test();
      }

	  //etnia
      elseif($nu == 2){
		test2();
		
      }

      //persona
      elseif($nu == 3){
		test3();
		
      }
      
      //organizacion
      elseif($nu == 4){
		test4();
		
      }
      
      ?>
    <!-- -->
    </div>
	
    </div>
    

    
    
  </body>
</html>
    