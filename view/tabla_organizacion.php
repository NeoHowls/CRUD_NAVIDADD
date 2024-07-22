    <style>
        .btnBorrar, .btnHabilitar, .btnDeshabilitar, .btnAutorizar, .btnEditar, .btnAnular, .btnDesHabGeneral, .btnHabGeneral, .btnNuevo, .btnPdf, .btnPdf2  {
            height: 40px; /* Ajusta la altura del botón */
            line-height: 40px; /* Alinea el contenido del botón verticalmente */
            padding: 0 5px; /* Ajusta el padding del botón */
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .btnBorrar i, .btnHabilitar i, .btnDeshabilitar i, .btnAutorizar i, .btnEditar i, .btnAnular i, .btnDesHabGeneral i, .btnHabGeneral i, .btnNuevo i, .btnPdf i, .btnPdf2 i {
            font-size: 30px; /* Ajusta el tamaño del icono */
            padding: 0; /* Ajusta el padding del icono */
        }
    </style>
<div class="container">
        <br>
      <!-- Cambiar  -->
        <div class="card">
          <div class="card-header">
            Tabla de Organizaciones
          </div>
          <div class="card-body">
            <p class="card-text">
              
            </p>
            <div class="container">
          <div class="row">
              <div class="col-lg-12">            
                <button id="btnNuevo" type="button" class="btn btn-primary text-light btnNuevo" data-toggle="tooltip" data-placement="top" title="Añadir Organizacion">
                    <i id="btnNuevo" class="bi bi-plus fs-4"></i>
                </button>
                <button id="btnDesHabGeneral" type="button" class="btn btn-danger btnDesHabGeneral" data-toggle="tooltip" data-placement="top" title="Deshabilitar Web general">
                    <i id="iconHabGeneral" class="bi bi-x-square"></i> 
                </button>  
                <button id="btnHabGeneral" type="button" class="btn btn-success btnHabGeneral" data-toggle="tooltip" data-placement="top" title="Habilitar Web general">
                    <i id="iconHabGeneral" class="bi bi-check-square"></i> 
               </button> 
               
               
               <!--nuevo -->
                <!-- Modal para seleccionar el año INFORME DETALLADO -->
                <div class="modal fade" id="imprimirModal" tabindex="-1" aria-labelledby="imprimirModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="imprimirModalLabel">Informes por Organización</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="d-flex align-items-end justify-content-center mb-3">
                                    <div class="col-lg-3 text-center">
                                        <label for="select_periodo" class="col-form-label">Periodo:</label>
                                        <select name="periodo" id="select_periodo" class="form-control" onchange="mostrarBoton()">
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
                                    <div class="ms-3" id="botonInforme">
                                        <!-- Aquí se insertará el botón correspondiente al año seleccionado -->
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--FINAL Modal para seleccionar el año INFORME DETALLADO -->


                <!-- Modal para seleccionar el año INFORME CON RUT Y FIRMA  -->
                <div class="modal fade" id="imprimirModal2" tabindex="-1" aria-labelledby="imprimirModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="imprimirModalLabel">Informes por Organización</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="d-flex align-items-end justify-content-center mb-3">
                                    <div class="col-lg-3 text-center">
                                        <label for="select_periodo2" class="col-form-label">Periodo:</label>
                                        <select name="periodo" id="select_periodo2" class="form-control" onchange="mostrarBoton2()">
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
                                    <div class="ms-3" id="botonInforme2">
                                        <!-- Aquí se insertará el botón correspondiente al año seleccionado -->
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--FINAL Modal para seleccionar el año INFORME CON RUT Y FIRMA -->



            <!-- nuevo -->
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
                    <div class="col-lg-12">
                        <div class="form-group" style = "text-align: center;">
                            <label for="" class="col-form-label">Nombre:</label>
                            <input type="text" class="form-control" id="nombre">
                        </div>
                        <div class="form-group" style = "text-align: center;">
                            <label for="" class="col-form-label">Dirección:</label>
                            <input type="text" class="form-control" id="direccion">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-6" style = "text-align: center;">
                                <label for="tipo" class="col-form-label">Tipo:</label>
                                <select name="cars" id="tipo" class = "form-control">
                                <option value="">Selecciona una opción</option>
                                  <option value=1>JUNTA VECINAL</option>
                                  <option value=2>COMÍTE VIVIENDA</option>
                                  <option value=3>CONDOMINIO</option>
                                  <option value=4>PROVIDENCIA</option> 
                                </select>
                        </div>
                        <div class="col-lg-6" style = "text-align: center;">
                                <label for="" class="col-form-label">Fecha Ingreso:</label>
                                <input type="datetime-local" class="form-control" id="fechaIngreso">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-6" style = "text-align: center;">
                            <label for="aniosVigente" class="col-form-label">Años Vigente:</label>
                            <select name="cars" id="aniosVigente" class = "form-control">
                            <option value="">Selecciona una opción</option>
                                  <option value=1>1</option>
                                  <option value=4>4</option> 
                                </select>
                        </div>
                        <div class="col-lg-6" style="text-align: center;" id="numProvidenciaGroup">
                    <label for="numProvidencia" class="col-form-label">Número de Providencia:</label>
                    <input type="text" class="form-control" id="numProvidencia">
                </div>
                    </div>
                        <!-- <div class="form-group">
                            <label for="" class="col-form-label">Check Vigente:</label>
                            <input type="text" class="form-control" id="checkVigente">
                        </div> -->
                        <!--<div class="form-group">
                            <label for="" class="col-form-label">Habilitado:</label>
                            <input type="text" class="form-control" id="checkHabilitado">
                        </div>
                        <div class="form-group">
                            <label for="" class="col-form-label">Estado:</label>
                            <input type="text" class="form-control" id="estado">
                        </div>-->
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
    <div class="table-responsive mx-3 text-left">
        <table id="myTable2" class="table table-striped nowrap" style="width:100%">
            <thead>
                <tr>
                
                    <th class ='never'>id</th>
                    <th class ='never'>Nombre</th>
                    <th class ='never'>Dirección</th>
                    <th class ='never'>tipo</th>
                    <th class ='never'>Fecha Ingreso</th>
                    <th class ='never'>checkVigente</th>
                    <th class ='never'>numProvidencia</th>
                    <th class ='never'>checkHabilitado</th>
                    <th class ='never'>estado</th>
                    <th class ='never'>Años Vigente</th>
                    <th class ='never'>Vigente</th>

                    <th class ='never'>id</th>
                    <th>Nombre</th>
                    <th>Dirección</th>
                    <th>Organización</th>
                    <th class ='never'>Fecha Ingreso</th>
                    <th class ='never'>checkVigente</th>
                    <th class ='never'>numProvidencia</th>
                    <th>Habilitada</th>
                    <th class ='never'>estado</th>
                    <th class ='never'>Años Vigente</th>
                    <th>Vigente</th>
                    <th class='all'>acciones</th>
                    
                
                </tr>
            </thead>
            <tbody>
            </tbody>
    </div>
    </table>
    <script type="text/javascript" src="../datatables.js"></script>
    <script type="text/javascript" src="../js/idioma.js"></script>
    <script type="text/javascript" src="../js/AJAX_ORGANIZACION.js">
        
    </script>