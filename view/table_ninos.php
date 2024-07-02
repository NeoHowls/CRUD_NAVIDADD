
<div class="container">
		
  <br>
  <!-- Cambiar  -->
  <div class="card">
    <div class="card-header">
      Tabla de Niños
    </div>
    <div class="card-body">
      <p class="card-text">
        <?php echo "Bienvenido ".$_SESSION["perfil"]." ".$_SESSION["test"]." ".$_SESSION["id_p"]; ?>
      </p>
      <!-- <div class="container"> -->
        <div class="row">
          <div class="col-lg-12">            
            <button id="btnNuevo" type="button" class="btn btn-info bi bi-plus" data-toggle="modal"><i class="material-icons">

            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
            </svg>

            </i></button>    
            
          </div>    
        </div>    
      <table id="myTable" class="table table-striped nowrap" style="width:100%">
        <thead>
            <tr>
             
                <th class = "never">id</th>  <!-- 0 -->
                <th>dni</th> <!-- 1 -->
                <th>nombre</th><!-- 2 -->
                <th class = "never">sexo</th><!-- 3 -->
                <th>sexo_vista</th><!-- 4 -->
                <th>edad</th><!-- 5 -->
                <th>fechaNacimiento</th><!-- 6 -->
                <th>periodo</th><!-- 7 -->
                
                <th class = "never">fechaRegistro</th><!-- 8 -->
                <th class = "never">idNacionalidad</th><!-- 9 -->
                <th class = "never">checkExtranjero</th><!-- 10 -->

                <th class = "never">checkCeguera</th>mental<!-- 11 -->
                <th class = "never">checkSordera</th><!-- 12-->
                <th class = "never">checkMudez</th><!-- 13 -->
                <th class = "never">checkFisica</th><!-- 14 -->
                <th class = "never">checkMental</th><!-- 15 -->
                <th class = "never">checkPsiquica</th><!-- 16 -->

                <th class = "never">idOrganizacion</th><!-- 17 -->
                <th class = "never">idPersonalRegistro</th><!-- 18 -->
                <th class = "never">checkDiscapacitado</th><!-- 19 -->

                <th>porcentajeCeguera</th><!-- 20 -->
                <th>porcentajeSordera</th><!-- 21 -->
                <th>porcentajeMudez</th><!-- 22 -->
                <th>porcentajeFisica</th><!-- 23 -->
                <th>porcentajeMental</th><!-- 24 -->
                <th>porcentajePsiquica</th><!-- 25 -->
                <th>descripcion</th><!-- 26 -->
                <th>etnia</th><!-- 27 -->
                <th>nacionalidad</th><!-- 28 -->
                <th>NOMBRE_ORGANIZACION</th><!-- 29 -->
                <th class = "never">tipo</th><!-- 30 -->
                <th class >tipo_org</th><!-- 31 -->
                <th class class = "never">idEtnia</th><!-- 32 -->
                <th class='all'>acciones</th><!-- 32 -->


            </tr>
        </thead>
        <tbody>

        </tbody>

      </table>
    </div><!--div card body-->  
  </div><!--div card-->   

<!--Modal para CRUD-->
<div  class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content" style="width: 110%;">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"></h5>
  
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        
                  <!-- </button> -->

              </div><!-- modal-header-->

              <form id="formUsuarios">    
                  <div class="modal-body" style="background: #9C9C9C">
                      <div class="row">
                     

                            <div class="col-6" >
                                <label class="col-form-label" for="flexSwitchCheckDefault">EXTRANJERO <div class="elnt_container form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="more_infos" name="more" value = 1>
                                </div></label>
                            </div>  
                            

                            <div class="col-lg-6">
                                <label class="col-form-label" for="flexSwitchCheckDefault">Discapacidad</label>
                                <div class="elnt_container form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="more_info" name="more" value= 1>
                                </div>
   
                            </div>  
                            </div>
                        <div class="row">
                          <div class="col-lg-12" style = "text-align: center;" >   
                            <label for="" class="col-form-label">DNI/RUT::</label>
                            <input type="text" class="form-control" id="dni">  
                            <label for="" class="col-form-label">Nombre Completo:</label>
                            <input type="text" class="form-control" id="nombre">
                              
                              <br>
                          </div>
                      </div><!--row-->
                      <div class="row">
                          <div class="col-lg-3" style = "text-align: center;">   
                              <label for="" class="col-form-label">Periodo:</label>
                              <select name="cars" id="periodo" class = "form-control">
                                <?php
                                  for($i=2023;$i<=date("Y");$i++){
                                    echo ("<option value=".$i.">".$i."</option>");
                                  }
                                ?>
                                <!-- <option value=1>2022</option>
                                <option value=2>2023</option>
                                <option value=3>2024</option>
                                <option value=4>2025</option> -->
                              </select>
                          </div>
                          <div class="col-lg-3" style = "text-align: center;">                    
                              <label for="" class="col-form-label">Sexo:</label>
                              <select name="cars" id="sexo" class = "form-control">
                                  <option value=1>Hombre</option>
                                  <option value=0>Mujer</option> 
                              </select>
                          </div>   
                          <div class="col-lg-6" style = "text-align: center;">                    
                              <label for="" class="col-form-label">Organizacion:</label>
                              <?php include_once("../controller/controller_mostrarO.php") ?>
                                <select name="cars" id="O_ID" class="form-control">
                                    <?php
                                    foreach($datos as $key => $value){
                                        echo '<option value="'.$value['id'].'">'.$value['nombre'].'</option>'; 
                                    }
                                    ?>
                                </select>
                          </div>    
                          <br>
                          <hr>
                      </div><!--row-->
                      <div class="row">
                          <div class="col-lg-4" style = "text-align: center;">
                              <label for="" class="col-form-label">Nacimiento:</label>
                              <input type="date" class="form-control" id="Naciemiento">
                              <br>
                          </div>
                          <div class="col-lg-2" style = "text-align: center;">
                              <label for="" class="col-form-label">Edad:</label>
                              <input type="number" class="form-control" id="edad">
                              <br>
                          </div>
                          <div class="col-lg-6" style = "text-align: center;">
                              <label for="" class="col-form-label">Etnia:</label>
                              <?php 
                                  include_once("../controller/controller_etnia.php");
                              ?>
                              <select name="carsn" id="etnia" class = "form-control">
                              <option value= 0 >No tiene</option>               
                              <?php

                                  foreach($datos as $key => $value){
                                      if($value['id'] >= 1){
                                          echo '<option value="'.$value['id'].'">'.$value['etnia'].'</option>'; 
                                      }
                                  }
                              ?>
                              </select>
                              <br>
                          </div>
                      <hr>
                      </div><!--row-->
                      
                      <div id="conditional_part" style="display:none;">
                      <div class="row p-1">
                        
                          <div class="col-lg-3">


                              <label for="" class="col-form-label">Ceguera:</label>
                              <input class="form-check-input" type="checkbox" id="ceguera" name="more" value = 1>
                          </div>
                          <div class="col-lg-3">
                              <input type="number" id="ceguera_percil" name="ceguera" min="0" max="100" value = "0"/>
                              
                          </div>
                          <div class="col-lg-3">
                              <label for="" class="col-form-label">Sordera:</label>
                              <input class="form-check-input" type="checkbox" id="sordera" name="more" value = 1>
                          </div>
                          <div class="col-lg-3">
                              <input type="number" id="sordera_percil" name="tentacles" min="0" max="100" value = "0"/>
                              
                          </div>
                      </div>

                      <div class="row p-1">
                        
                          <div class="col-lg-3">


                              <label for="" class="col-form-label">Mudez:</label>
                              <input class="form-check-input" type="checkbox" id="mudez" name="more" value = 1>
                          </div>
                          <div class="col-lg-3">
                              <input type="number" id="mudez_percil" name="tentacles" min="0" max="100" value = "0"/>
                              
                          </div>
                          <div class="col-lg-3">
                              <label for="" class="col-form-label">Fisica:</label>
                              <input class="form-check-input" type="checkbox" id="fisica" name="more" value = 1>
                          </div>
                          <div class="col-lg-3">
                              <input type="number" id="fisica_percil" name="tentacles" min="0" max="100" value = "0" />
                              
                          </div>
                      </div>

                      <div class="row p-1">
                        
                          <div class="col-lg-3">


                              <label for="" class="col-form-label">Mental:</label>
                              <input class="form-check-input" type="checkbox" id="mental" name="more" value = 1>
                          </div>
                          <div class="col-lg-3">
                              <input type="number" id="mental_percil" name="tentacles" min="0" max="100" value = "0"/>
                              
                          </div>
                          <div class="col-lg-3">
                              <label for="" class="col-form-label">Psiquica:</label>
                              <input class="form-check-input" type="checkbox" id="psiquica" name="more" value = 1>
                          </div>
                          <div class="col-lg-3">
                              <input type="number" id="psiquica_percil" name="tentacles" min="0" max="100" value = "0"/>
                              
                          </div>
                      </div>

                      <div class="row">
                      <div class="col-lg-6">
                              <label for="" class="col-form-label">descripcion:</label>
                              <!-- <input type="text" class="form-control" id="descripcion"> -->
                              <!-- <input type="number" id="ceguera_percil" name="tentacles" min="0" max="100" /> -->
                              <textarea id="descripcion" name="descripcion" rows="4" cols="50"></textarea>
                              
                              <br> 
                              </div>
                        </div>
                      </div><!--row-->
                      <div class="row">
                                <div class="col-6" id="conditional_parts" style="display:none;">
                                    <?php 
                                    include_once("../controller/controller_nac.php");
                                    ?>
                                    
                                    <select name="cars" id="nacion" class = "form-control">   
                                    <option value= 1 >---------</option>            
                                    <?php
                                    foreach($datos as $key => $value){
                                        if($value['id'] >= 2){
                                        echo '<option value="'.$value['id'].'">'.$value['nacionalidad'].'</option>';                                       
                                        }
                                    }
                                    ?>
                                    </select>
                                </div>

                            </div><!--row-->
                      <div class="row">
                      </div><!--row-->
                      <div class="row">
                      </div><!--row-->
                  </div><!--modal-body--> 
                  <div class="modal-footer" style="justify-content: center">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                      <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
                  </div><!--modal footer-->


              </form>             
          </div><!--modal-content-->
      </div><!--modal-dialog-->
</div><!--modal-->



</div><!--div contenedor principal-->   
    <script type="text/javascript" src="../datatables.js"></script>
    <script type="text/javascript" src="../js/ajax/idioma.js"></script>
    <script type="text/javascript" src="../js/AJAX_NINOS.js"> </script>
        
    <script>
    // A $( document ).ready() block.
    let userTipo;
    let id_usuario

        
        userTipo = <?php echo($_SESSION['tipo_usuario']); ?>;
        id_usuario = <?php echo($_SESSION['id_persona']); ?>;
        // alert( id_usuario );
    
    </script>                   