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
                    <button id="btnNuevo" type="button" class="btn btn-info text-light btnNuevo" data-toggle="tooltip" data-placement="top" title="Agregar Persona">
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

            <div class="table-responsive mx-2 text-left">
                <table id="myTable1" class="table table-striped nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th class='never'>id</th>
                            <th class='never'>dni</th>
                            <th class='never'>nombre</th>
                            <th class='never'>direccion</th>
                            <th class='never'>telefono</th>
                            <th class='never'>mail</th>
                            <th class='never'>idPerfil</th>
                            <th class='never'>estado</th>
                            <th class='never'>Habilitado</th>
                            <th class='never'>usuario</th>
                            <th class='never'>contraseña</th>
                            <th class='never'>idOrganizacion</th>
                            <th class='never'>Nombre Organizacion</th>
                            <th class='never'>tipo</th>
                            <th class='never'>id</th>
                            <th style='text-align: center;'>Dni/RUT</th>
                            <th style='text-align: center;'>Nombre</th>
                            <th class='never' style='text-align: center;'>Dirección</th>
                            <th style='text-align: center;'>Teléfono</th>
                            <th style='text-align: center;'>Mail</th>
                            <th class='never' style='text-align: center;'>idPerfil</th>
                            <th style='text-align: center;'>Estado</th>
                            <th style='text-align: center;'>Habilitado</th>
                            <th class='never' style='text-align: center;'>usuario</th>
                            <th class='never' style='text-align: center;'>contraseña</th>
                            <th class='never' style='text-align: center;'>idOrganizacion</th>
                            <th style='text-align: center;'>Nombre Organización</th>
                            <th style='text-align: center;'>Tipo Organización</th>
                            <th class='all' style='text-align: center;'>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="../datatables.js"></script>
<script src="../js/idioma.js"></script>
<script src="../js/AJAX_PERSONA.js"></script>
