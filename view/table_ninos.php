<style>
    /* Thick red border */
    hr.linea {
    background: #5c94f4;
    border: 2px solid #5c94f4;
    opacity: 1;
    }
</style>

<?php
    //  var_dump($_SESSION);
?>
<div class="container">
		
  <br>
  <!-- Cambiar  -->
  <div class="card">
    <div class="card-header">
        <div class="row">
        <div class="col-lg-6" style = "text-align: center;" >
      <p style = "text-align: left; font-size:100%;">Niños <?php echo '('.$_SESSION["nombreOrganizacion"].')'; ?></p>
      <p style = "text-align: left; font-size:100%;"></p>
      <!-- <p style = "text-align: left; font-size:100%;">Niños <?php //echo '('.$_SESSION["nombreOrganizacion"].')'; ?></p>
      <p style = "text-align: left; font-size:100%;"></p> -->
      </div>
      <div class="col-lg-6" style = "text-align: center;" >
      <p style = "text-align: right; font-size:100%;"><?php echo $_SESSION["nombre"].'('.$_SESSION["perfil"].')'; ?>
      </p>
      <!-- <p style = "text-align: right; font-size:60%;"><?php echo $_SESSION["perfil"]; ?>
      </p> --> 
    </div>
      
      </div>
    </div>
    <div class="card-body">
      <p class="card-text">
              </p>

              <table class="inputs">
        <tbody><tr>
        <div class="row">
            <?php 
                if($_SESSION['tipo_usuario']==0 || $_SESSION['tipo_usuario']==1 ){
            ?>
                <div class="col-lg-3" style = "text-align: center;" >
                    <label >Tipo:</label>
                    <select id="tipo" class = "form-control">
                        <option value=0 selected disabled>Seleccione Tipo</option>
                        <option value=1>Junta Vecinal</option>
                        <option value=2>Comite</option>
                        <option value=3>Condominio</option>
                        <option value=4>Providencia</option>
                    </select>  
                </div>              
                <div class="col-lg-6" style = "text-align: center;" >
                    <label for="organizacion_selection">Organización</label>
                    <select class="form-control" id="organizacion_selection" name="organizacion_selection" disabled>
                        <option selected disabled value=0>Sin Organización</option>
                        <!-- carga select direcciones-->
                    </select>
                </div>
                <div class="col-lg-3" style = "text-align: center;">   
                    <label for="" class="col-form-label">Periodo:</label>
                    <select name="cars" id="select_periodo" class = "form-control">
                        <?php
                            for($i=2023;$i<=date("Y");$i++){
                            //for($i=2023;$i<=2025;$i++){
                            // echo ("<option value=".$i.">".$i."</option>");
                            if($i==date("Y")){
                                echo ("<option value=".$i." selected>".$i."</option>");
                            }else{
                                echo ("<option value=".$i.">".$i."</option>");
                            }
                            }
                        ?>
                    </select>
                </div>
            <?php
                }//fin if
                else{
            ?>
                <div class="col-lg-3" style = "text-align: center;" >
                    <label >Tipo:</label>
                    <select id="tipo" class = "form-control" disabled>
                        <option value=0 disabled>Seleccione Tipo</option>
                        <option value=1 <?php if($_SESSION['tipoOrganizacion']==1) { echo('selected');}?>>Junta Vecinal</option>
                        <option value=2 <?php if($_SESSION['tipoOrganizacion']==2) { echo('selected');}?>>Comite</option>
                        <option value=3 <?php if($_SESSION['tipoOrganizacion']==3) { echo('selected');}?>>Condominio</option>
                        <option value=4 <?php if($_SESSION['tipoOrganizacion']==4) { echo('selected');}?>>Providencia</option>
                    </select>  
                </div>              
                <div class="col-lg-6" style = "text-align: center;" >
                    <label for="organizacion_selection">Organización</label>
                    <select class="form-control" id="organizacion_selection" name="organizacion_selection" disabled>
                        <option disabled value=0>Sin Organización</option>
                        <?php echo("<option disabled value=".$_SESSION['idOrganizacion']." selected>".$_SESSION['nombreOrganizacion']."</option>"); ?>
                        <!-- carga select direcciones-->
                    </select>
                </div>
                <div class="col-lg-3" style = "text-align: center;">   
                    <label for="" class="col-form-label">Periodo:</label>
                    <select name="cars" id="select_periodo" class = "form-control" disabled>
                        <?php
                            for($i=2023;$i<=date("Y");$i++){
                            //for($i=2023;$i<=2025;$i++){
                            // echo ("<option value=".$i.">".$i."</option>");
                                if($i==date("Y")){
                                    echo ("<option value=".$i." selected>".$i."</option>");
                                }else{
                                    echo ("<option value=".$i.">".$i."</option>");
                                }
                            }
                        ?>
                    </select>
                </div>
            <?php
                }//fin else
                
            ?>
        </div>
    </tbody></table>
      <!-- <div class="container"> -->
        <br>
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
                <th>DNI/RUT</th> <!-- 1 dni-->
                <th>Nombre</th><!-- 2 nombre-->
                <th class = "never">sexo</th><!-- 3 -->
                <th>Sexo</th><!-- 4 sexo_vista-->
                <th>Edad</th><!-- 5 -->
                <th>Fecha Nacimiento</th><!-- 6 -->
                <th>Periodo</th><!-- 7 -->
                
                <th class = "never">fechaRegistro</th><!-- 8 -->
                <th class = "never">idNacionalidad</th><!-- 9 -->
                <th class = "never">checkExtranjero</th><!-- 10 -->

                <th class = "never">checkCeguera</th><!-- 11 -->
                <th class = "never">checkSordera</th><!-- 12-->
                <th class = "never">checkMudez</th><!-- 13 -->
                <th class = "never">checkFisica</th><!-- 14 -->
                <th class = "never">checkMental</th><!-- 15 -->
                <th class = "never">checkPsiquica</th><!-- 16 -->

                <th class = "never">idOrganizacion</th><!-- 17 -->
                <th class = "never">idPersonalRegistro</th><!-- 18 -->
                <th class = "never">checkDiscapacitado</th><!-- 19 -->

                <th class = "none">% Ceguera</th><!-- 20 -->
                <th class = "none">% Sordera</th><!-- 21 -->
                <th class = "none">% Mudez</th><!-- 22 -->
                <th class = "none">% Fisica</th><!-- 23 -->
                <th class = "none">% Mental</th><!-- 24 -->
                <th class = "none">% Psiquica</th><!-- 25 -->
                <th class = "none">Descripción</th><!-- 26 -->
                <th class = "none">Etnia</th><!-- 27 -->
                <th class = "none">Nacionalidad</th><!-- 28 -->
                <th class = "none">Organizació</th><!-- 29 NOMBRE_ORGANIZACION-->
                <th class = "never">tipo</th><!-- 30 -->
                <th class = "none" >Tipo Organización</th><!-- 31 -->
                <th class  = "never">idEtnia</th><!-- 32 -->
                <th class='all'>Acciones</th><!-- 32 -->


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
          <div class="modal-content" style="width: 100%;">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"></h5>
  
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        
                  <!-- </button> -->

              </div><!-- modal-header-->

              <form id="formNinos" autocomplete="off">    
                  <div class="modal-body" style="background: #E7E7E7">
                      <div class="row">
                     

                            <div class="col-6" >
                                <!-- <label class="col-form-label" for="flexSwitchCheckDefault">EXTRANJERO <div class="elnt_container form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="chExtrajero" name="more" value = 1>
                                </div></label> -->

                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="chExtrajero" name="more" value = 1>
                                    <label class="form-check-label" for="chExtrajero">Extranjero</label>
                                </div>
                            </div>  
                            


                            <div class="col-lg-6">
                                <!-- <label class="col-form-label" for="flexSwitchCheckDefault">Discapacidad</label>
                                <div class="elnt_container form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="chDiscapacidad" name="more" value= 1>
                                </div> -->

                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="chDiscapacidad" name="more" 
                                    <?php if($_SESSION['tipo_usuario']==2){echo('disabled');}
                                            
                                    ?> 
                                    value = 1 >
                                    <label class="form-check-label" for="chDiscapacidad">Discapacidad</label>
                                </div>
                            </div>  
                        </div>
                        <div class="row">
                          <div class="col-lg-12" style = "text-align: center;" >   
                            <label for="" class="col-form-label">DNI/RUT</label>
                            <input type="text" class="form-control" id="dni" required>  
                            <label for="" class="col-form-label">Nombre Completo</label>
                            <input type="text" class="form-control" id="nombre" required>
                              
                              <!-- <br> -->
                          </div>
                      </div><!--row-->
                      <div class="row">
                          <div class="col-lg-6" style = "text-align: center;">   
                              <label for="" class="col-form-label">Periodo</label>
                              <select name="cars" id="periodo" class = "form-control" required <?php if($_SESSION['tipo_usuario']==2){echo('disabled');}?> >
                                <?php
                                  for($i=2023;$i<=date("Y");$i++){
                                    // for($i=2023;$i<=2025;$i++){
                                    // echo ("<option value=".$i.">".$i."</option>");
                                    if($i==date("Y")){
                                        echo ("<option value=".$i." selected>".$i."</option>");
                                    }else{
                                        echo ("<option value=".$i.">".$i."</option>");
                                    }
                                  }
                                ?>
                                <!-- <option value=1>2022</option>
                                <option value=2>2023</option>
                                <option value=3>2024</option>
                                <option value=4>2025</option> -->
                              </select>
                          </div>
                          <div class="col-lg-6" style = "text-align: center;">                    
                              <label for="" class="col-form-label">Sexo</label>
                              <select name="cars" id="sexo" class = "form-control" required>
                                  <option value=1>MASCULINO</option>
                                  <option value=0>FEMENINO</option> 
                              </select>
                          </div>
                        </div>
                        <div class="row">   
                          <div class="col-lg-12" style = "text-align: center;">                    
                              <label for="" class="col-form-label">Organización</label>
                              <?php include_once("../controller/controller_mostrarO.php") ?>
                                <select name="cars" id="O_ID" class="form-control" required <?php if($_SESSION['tipo_usuario']==2){ echo('disabled');} ?>>
                                    
                                    <?php
                                        if($_SESSION['tipo_usuario']==2 ){
                                            echo("<option disabled value=0>Sin Organización</option>");
                                            echo("<option disabled value=".$_SESSION['idOrganizacion']." selected>".$_SESSION['nombreOrganizacion']."</option>");
                                        }else{
                                            echo("<option disabled selected value=0>Sin Organización</option>");
                                            foreach($datos as $key => $value){
                                                echo '<option value="'.$value['id'].'">'.$value['nombre'].'</option>'; 
                                            }
                                        }
                                    ?>
                                </select>
                          </div>    
                          <!-- <br>
                          <hr> -->
                      </div><!--row-->
                      <div class="row">
                          <div class="col-lg-4" style = "text-align: center;">
                              <label for="" class="col-form-label">Fecha Nacimiento</label>
                              <input type="date" name='fecha'  class="form-control" id="Naciemiento" required>
                              <br>
                          </div>
                          <div class="col-lg-2" style = "text-align: center;">
                              <label for="" class="col-form-label">Edad</label>
                              <input type="number" class="form-control" id="edad">
                              <br>
                          </div>
                          <div class="col-lg-6" style = "text-align: center;">
                              <label for="" class="col-form-label">Etnia</label>
                              <?php 
                                  include_once("../controller/controller_etnia.php");
                              ?>
                              <select name="carsn" id="etnia" class = "form-control" required>
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
                      <hr class="linea">
                      </div><!--row-->
                      
                      <div id="contenidoDiscapacidad" style="display:none;">
                      <div class="row p-1">
                        
                          <div class="col-lg-3">
                              <!-- <label for="" class="col-form-label">Ceguera:</label>
                              <input class="form-check-input" type="checkbox" id="ceguera" name="more" value = 1> -->

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="ceguera" name="more" value = 1>
                                <label class="form-check-label" for="ceguera">Ceguera</label>
                            </div>
                          </div>
                          <div class="col-lg-3">
                              <input type="number" id="ceguera_percil" name="ceguera" min="0" max="100" value = "0"/>
                              
                          </div>
                          <div class="col-lg-3">
                              <!-- <label for="" class="col-form-label">Sordera:</label>
                              <input class="form-check-input" type="checkbox" id="sordera" name="more" value = 1> -->
                              
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="sordera" name="more" value = 1>
                                <label class="form-check-label" for="sordera">Sordera</label>
                            </div>
                          </div>
                          <div class="col-lg-3">
                              <input type="number" id="sordera_percil" name="tentacles" min="0" max="100" value = "0"/>
                              
                          </div>
                      </div>

                      <div class="row p-1">
                        
                          <div class="col-lg-3">

                              <!-- <label for="" class="col-form-label">Mudez:</label>
                              <input class="form-check-input" type="checkbox" id="mudez" name="more" value = 1> -->
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="mudez" name="more" value = 1>
                                <label class="form-check-label" for="mudez">Mudez</label>
                            </div>
                          </div>
                          <div class="col-lg-3">
                              <input type="number" id="mudez_percil" name="tentacles" min="0" max="100" value = "0"/>
                              
                          </div>
                          <div class="col-lg-3">
                              <!-- <label for="" class="col-form-label">Fisica:</label>
                              <input class="form-check-input" type="checkbox" id="fisica" name="more" value = 1> -->
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="fisica" name="more" value = 1>
                                <label class="form-check-label" for="fisica">Fisica</label>
                            </div>
                              
                          </div>
                          <div class="col-lg-3">
                              <input type="number" id="fisica_percil" name="tentacles" min="0" max="100" value = "0" />
                              
                          </div>
                      </div>

                      <div class="row p-1">
                        
                          <div class="col-lg-3">


                              <!-- <label for="" class="col-form-label">Mental:</label>
                              <input class="form-check-input" type="checkbox" id="mental" name="more" value = 1> -->
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="mental" name="more" value = 1>
                                <label class="form-check-label" for="mental">Mental</label>
                            </div>

                          </div>
                          <div class="col-lg-3">
                              <input type="number" id="mental_percil" name="tentacles" min="0" max="100" value = "0"/>
                              
                          </div>
                          <div class="col-lg-3">
                              <!-- <label for="" class="col-form-label">Psiquica:</label>
                              <input class="form-check-input" type="checkbox" id="psiquica" name="more" value = 1> -->
                              <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="psiquica" name="more" value = 1>
                                <label class="form-check-label" for="psiquica">Psiquica</label>
                            </div>
                          </div>
                          <div class="col-lg-3">
                              <input type="number" id="psiquica_percil" name="tentacles" min="0" max="100" value = "0"/>
                              
                          </div>
                      </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <label for="" class="col-form-label">Descripción</label>

                                <!-- <textarea id="descripcion" name="descripcion" rows="4" cols="50"></textarea> -->
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Leave a comment here" name="descripcion" id="descripcion" style="height: 100px"></textarea>
                                    <label for="descripcion">Detallar Descripción !!!</label>
                                </div>
                                <br> 
                            </div>
                        </div>

                        <!-- <div class="row">
                            <div class="col-lg-12">  
                                <label for="" class="col-form-label">Descripción</label>
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                                    <label for="floatingTextarea2">Comments</label>
                                </div>
                            </div>
                        </div>    -->      

                    </div><!--row-->





                      <div class="row">
                                <div class="col-12" id="contenidoExtrajero" style="display:none;">
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
    <!-- <script type="text/javascript" src="../js/AJAX_NINOS.js"> </script> -->
    <script type="text/javascript" src="../js/AJAX_NINOS2.js"> </script>
        
    <script>
    // A $( document ).ready() block.
    let userTipo;
    let id_usuario
    let periodo;
        
        userTipo = <?php echo($_SESSION['tipo_usuario']); ?>;
        id_usuario = <?php echo($_SESSION['id_persona']); ?>;
        periodo = $('#select_periodo').val();
        tipoO = $('#tipo').val();
        Organizacion = $('#organizacion_selection').val();
        // alert( periodo  );

        listarNinos(tipoO,Organizacion,periodo);
    
    </script>                   