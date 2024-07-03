<div class="container">
    <br>
    <div class="card">
        <div class="card-header">
            Tabla de Personas
        </div>
        <div class="card-body">
            <p class="card-text">
                <?php echo "Bienvenido ".$_SESSION["perfil"]." ".$_SESSION["test"]." ".$_SESSION["id_p"]; ?>
            </p>
            <div class="row">
                <div class="col-lg-12">
                    <button id="btnNuevo" type="button" class="btn btn-info bi bi-plus" data-toggle="tooltip" data-placement="top" title="Agregar Persona">
                        <i class="material-icons"></i>
                    </button>
                    <button id="btnDesHabGeneral" type="button" class="btn btn-danger btnDesHabGeneral" data-toggle="tooltip" data-placement="top" title="Deshabilitar registros">
                        <i id="iconHabGeneral" class="bi bi-x-square"></i>
                    </button>
                    <button id="btnHabGeneral" type="button" class="btn btn-success btnHabGeneral" data-toggle="tooltip" data-placement="top" title="Habilitar registros">
                        <i id="iconHabGeneral" class="bi bi-check-square"></i>
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
                                                <div class="text-center">
                                                    <input type="number" class="form-control" id="telefono" required data-error="Por favor ingrese su Teléfono" min="0" max="999999999" onKeyPress="if(this.value.length==9) return false;">
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="perfil" class="col-form-label text-center">Perfil:</label>
                                                <div>
                                                    <?php include_once("../controller/controller_mostrarPerfil.php") ?>
                                                    <select id="idPerfil" class="form-control" required data-error="Por favor ingrese un perfil">
                                                        <?php foreach($datos as $key => $value): ?>
                                                            <option value="<?= $value['id'] ?>"><?= $value['perfil'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
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
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-auto" for="flexSwitchCheckDefault">Desea agregar Organización:</label>
                                            <div class="col-md-auto elnt_container form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="more_infos" name="more" value="1">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6" id="conditional_parts" style="display: none;">
                                                <?php 
                                                    include_once("../controller/controller_mostrarO.php"); 
                                                ?>
                                                <select name="cars" id="O_ID" class="form-control">
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
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="table-responsive mx-3 text-left">
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
                            <th>Dni/RUT</th>
                            <th>Nombre</th>
                            <th>Dirección</th>
                            <th>Teléfono</th>
                            <th>Mail</th>
                            <th class='never'>idPerfil</th>
                            <th>Estado</th>
                            <th>Habilitado</th>
                            <th class='never'>usuario</th>
                            <th class='never'>contraseña</th>
                            <th class='never'>idOrganizacion</th>
                            <th>Nombre Organización</th>
                            <th>Tipo Organización</th>
                            <th class='all'>Acciones</th>
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
