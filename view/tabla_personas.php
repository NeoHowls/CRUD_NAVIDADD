<style>
        .btnBorrar, .btnHabilitar, .btnDeshabilitar, .btnAutorizar, .btnEditar, .btnAnular, .btnDesHabGeneral, .btnHabGeneral, .btnNuevo  {
            height: 40px; /* Ajusta la altura del botón */
            line-height: 40px; /* Alinea el contenido del botón verticalmente */
            padding: 0 5px; /* Ajusta el padding del botón */
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .btnBorrar i, .btnHabilitar i, .btnDeshabilitar i, .btnAutorizar i, .btnEditar i, .btnAnular i, .btnDesHabGeneral i, .btnHabGeneral i, .btnNuevo i {
            font-size: 30px; /* Ajusta el tamaño del icono */
            padding: 0; /* Ajusta el padding del icono */
        }
    </style>
<div class="container">
    <br>
    <div class="card">
        <div class="card-header">
            Tabla de Personas
        </div>
        <div class="card-body">
            <p class="card-text">
                
            </p>
            <div class="row">
                <div class="col-lg-12">
                    <button id="btnNuevo" type="button" class="btn btn-primary text-light btnNuevo" data-toggle="tooltip" data-placement="top" title="Agregar Persona">
                        <i id="btnNuevo" class="bi bi-plus fs-4"></i>
                    </button>
                    <button id="btnDesHabGeneral" type="button" class="btn btn-danger text-light btnDesHabGeneral" data-toggle="tooltip" data-placement="top" title="Deshabilitar registros">
                        <i id="iconHabGeneral" class="bi bi-x-square fs-4"></i>
                    </button>
                    <button id="btnHabGeneral" type="button" class="btn btn-success text-light btnHabGeneral" data-toggle="tooltip" data-placement="top" title="Habilitar registros">
                        <i id="iconHabGeneral" class="bi bi-check-square fs-4"></i>
                    </button>
                </div>
            </div>

            <!-- Modal para CRUD -->
            <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="formUsuarios">
                            <div class="modal-body" style="background: #E7E7E7">
                                <div class="row">
                                    <div class="col-lg-12" style="text-align: center;">
                                        <div class="form-group">
                                            <label for="" class="col-form-label">DNI/RUT:</label>
                                            <input type="text" class="form-control" id="dni" required data-error="Por favor ingrese su DNI/RUT">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-form-label">Nombre completo:</label>
                                            <input type="text" class="form-control" id="nombre" required data-error="Por favor ingrese su nombre">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-form-label">Dirección:</label>
                                            <input type="text" class="form-control" id="direccion" required data-error="Por favor ingrese su dirección">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-form-label">Mail:</label>
                                            <input type="email" class="form-control" id="mail" required data-error="Por favor ingrese su correo">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="telefono" class="col-form-label text-center">Teléfono:</label>
                                                <div class="text-center phone-input">
                                                    <input type="text" class="form-control" id="telefono" placeholder="569XXXXXXXX" data-error="Por favor ingrese su Teléfono" min="0" max="999999999" onKeyPress="if(this.value.length==12) return false;" oninput="validatePhoneNumber(this)">
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="perfil" class="col-form-label text-center">Perfil:</label>
                                                <div>
                                                    <?php include_once("../controller/controller_mostrarPerfil.php") ?>
                                                    <select id="idPerfil" class="form-control" required data-error="Por favor ingrese un perfil">
                                                        <option value="">Selecciona un perfil</option>
                                                        <?php foreach($datos as $key => $value): ?>
                                                            <option value="<?= $value['id'] ?>"><?= $value['perfil'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <div id="perfilError" class="text-danger"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="usuario" class="col-form-label text-center">Usuario:</label>
                                                <div class="text-center">
                                                    <input type="text" class="form-control" id="usuario" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="contrasena" class="col-form-label text-center">Contraseña:</label>
                                                <div class="text-center">
                                                    <input type="text" class="form-control" id="contrasena" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row" id="checkbox-container" style="display: none;">
                                            <label class="col-form-label col-md-auto" for="flexSwitchCheckDefault">Desea agregar Organización:</label>
                                            <div class="col-md-auto elnt_container form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="more_infos" name="more" value="1">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-12" id="conditional_parts" style="display: none;">
                                                <?php include_once("../controller/controller_mostrarO.php"); ?>
                                                <select name="cars" id="O_ID" class="form-control">
                                                    <option value="">Selecciona una opción</option>
                                                    <?php foreach($datos as $key => $value): ?>
                                                        <option value="<?= $value['id'] ?>" data-tipo="<?= $value['tipo'] ?>"><?= $value['nombre'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div id="organizacionError" class="text-danger"></div>
                                            </div>
                                        </div>      
                                    </div>
                                    </div>
                                </div>
                            
                            <div class="modal-footer" style="justify-content: center">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- <div class="table-responsive mx-1 text-left"> -->
                <table id="myTable1" class="table table-striped nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th class='never'>id</th><!-- 0 -->
                            <th class='never'>dni</th><!-- 1 -->
                            <th class='never'>nombre</th><!-- 2 -->
                            <th class='never'>direccion</th><!-- 3 -->
                            <th class='never'>telefono</th><!-- 4 -->
                            <th class='never'>mail</th><!-- 5 -->
                            <th class='never'>idPerfil</th><!-- 6 -->
                            <th class='never'>estado</th><!-- 7 -->
                            <th class='never'>Habilitado</th><!-- 8 -->
                            <th class='never'>usuario</th><!-- 9 -->
                            <th class='never'>contraseña</th><!-- 10 -->
                            <th class='never'>idOrganizacion</th><!-- 11 -->
                            <th class='never'>Nombre Organizacion</th><!-- 12 -->
                            <th class='never'>tipo</th><!-- 13 -->
                            <th class='never'>id</th><!-- 14 -->
                            <th >Dni/RUT</th><!-- 15 -->
                            <th >Nombre</th><!-- 16 -->
                            <th class='never' >Dirección</th><!-- 17 -->
                            <th>Teléfono</th><!-- 18 -->
                            <th>Mail</th><!-- 19 -->
                            <th class='never' style='text-align: center;'>idPerfil</th><!-- 20 -->
                            <th>Estado</th><!-- 21 -->
                            <th>Habilitado</th><!-- 22-->
                            <th class='never' style='text-align: center;'>usuario</th><!-- 23 -->
                            <th class='never' style='text-align: center;'>contraseña</th><!-- 24 -->
                            <th class='never' style='text-align: center;'>idOrganizacion</th><!-- 25 -->
                            <th>Nombre Organización</th><!-- 26 -->
                            <th >Tipo Organización</th><!-- 27 -->
                            <th class='all'>Acciones</th><!-- 28 -->
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            <!-- </div> -->
        </div>
    </div>
</div>
<script src="../datatables.js"></script>
<script src="../js/idioma.js"></script>
<script src="../js/AJAX_PERSONA.js"></script>
