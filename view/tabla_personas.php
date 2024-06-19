<div class="container">
		
      <br>
    <!-- Cambiar  -->
      <div class="card">
        <div class="card-header">
          Tabla de Personas
        </div>
        <div class="card-body">
          <p class="card-text">
            <?php echo "Bienvenido ".$_SESSION["perfil"]." ".$_SESSION["test"]." ".$_SESSION["id_p"]; ?>
          </p>
		  <div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevo" type="button" class="btn btn-info bi bi-plus" data-toggle="tooltip" data-placement="top" title="Agregar Persona"><i class="material-icons"></i>
            </button>  
            <button id="btnHabGeneral" type="button" class="btn btn-danger btnHabGeneral" data-toggle="tooltip" data-placement="top" title="Deshabilitar registros">
                <i id="iconHabGeneral" class="bi bi-x-square"></i> 
            </button> 
            <button id="btnDesHabGeneral" type="button" class="btn btn-success btnDesHabGeneral" data-toggle="tooltip" data-placement="top" title="Habilitar registros">
                <i id="iconHabGeneral" class="bi bi-check-square"></i> 
            </button>
			
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
		    <div class="modal-body" style="background: #E7E7E7">
                <div class="row">
    <div class="col-lg-12" style = "text-align: center;">
                    <div class="form-group">
                    <label for="" class="col-form-label">dni:</label>
                    <input type="text" class="form-control" id="dni">
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
                    <label for="" class="col-form-label">telefono:</label>
                    <input type="number" class="form-control" id="telefono">
                    </div>
                    <div class="form-group">
                    <label for="" class="col-form-label">mail:</label>
                    <input type="text" class="form-control" id="mail">
                    </div>
                    <div class="form-group">
                    <label for="" class="col-form-label">idPerfil:</label>
                    <input type="text" class="form-control" id="idPerfil">
                    </div>
                    <div class="form-group">
                    <label for="" class="col-form-label">estado:</label>
                    <input type="text" class="form-control" id="estado">
                    </div>
                    <div class="form-group">
                    <label for="" class="col-form-label">usuario:</label>
                    <input type="text" class="form-control" id="usuario">
                    </div>
                    <div class="form-group">
                    <label for="" class="col-form-label">contraseña:</label>
                    <input type="text" class="form-control" id="contrasena">
                    </div>
                    <label class="col-form-label" for="flexSwitchCheckDefault">Desea agregar Organizacion:</label>
                      <div class="elnt_container form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="more_infos" name="more" value = 1>
                    </div>
                      <div id="conditional_parts">
                      <div class="col-lg-6">
                      <?php 
                      include_once("../controller/controller_mostrarO.php")
                      ?>
                      <select name="cars" id="O_ID" class = "form-control">              
                        <?php

                        foreach($datos as $key => $value){
                          
                            echo '<option value="'.$value['id'].'">'.$value['nombre'].'</option>'; 
                          }
                        ?>
                      </select>
                      </div>
                    </div>
                      </div>
                    </div>
                    
                    
                </div>
            <div class="modal-footer" style="justify-content: center">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
            </div>
        </form>    
        </div>
    </div>
</div>   

      </div>
<div class="table-responsive mx-3 text-center">
        <table id="myTable1" class="table table-striped nowrap" style="width:100%">
              <thead>
                  <tr>
                      
                      <th class ='never'>id</th>
                      <th>dni</th>
                      <th>nombre</th>
                      <th>direccion</th>
                      <th>telefono</th>
                      <th>mail</th>
                      <th class ='never'>idPerfil</th>
                      <th class ='never'>estado</th>
                      <th class ='never'>Habilitado</th>
                      <th class ='never'>usuario</th>
                      <th class ='never'>contraseña</th>
                      <th class ='never'>idOrganizacion</th>
                      <th>Nombre Organizacion</th>
                      <th class='all'>Acciones</th>  
                  </tr>
              </thead>
              <tbody>
              </tbody>
        </div>
          </table>
          <script type="text/javascript" src="../datatables.js"></script>
          <script type="text/javascript" src="../js/idioma.js"></script>>
          <script type="text/javascript" src="../js/AJAX_PERSONA.js">
          <script type="text/javascript" src="nacionalidad.js"></script>    
          </script>

    </div>
  </div>
</div>