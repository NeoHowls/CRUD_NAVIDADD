
      <!--Modal para CRUD-->
  <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content" style="width: 110%;">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"></h5>
  
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        
                  </button>
              </div>
          <form id="formUsuarios">    
          <div class="modal-body" style="background: #E7E7E7">
                  <div class="row">
    <div class="col-lg-12" style = "text-align: center;" >   
    <label for="" class="col-form-label">Nombre:</label>
                      <input type="text" class="form-control" id="perfil">
                      <br>
    </div>              
    <div class="col-lg-6" style = "text-align: center;">   
    <label for="" class="col-form-label">Tipo:</label>
                      <select name="cars" id="tipo" class = "form-control">
                        <option hidden   defauld value=0>-------</option>
                        <option value=1>DIDECO</option>
                        <option value=2>REPRESENTANTE</option>
                      </select>
                      <br>
    </div>     
    <div class="col-lg-6" style = "text-align: center;">   
    <label for="" class="col-form-label">Estado:</label>
                      <select name="cars" id="estado" class = "form-control">
                        <option value=1>ACTIVA</option>
                        <option value=0>NO ACTIVA</option>
                        
                      </select>
                      <br>
    </div>     
    <br>
    <hr>
  


    <!--NIÑOS-->
                      <div class="col-lg-12">
                          
                                        <h5 style = "text-align: center;"> NIÑOS</h5>
                      </div>
                          <div class="col-lg-6" style = "text-align: center;">
                      <label for="" class="col-form-label">Crear:</label>
                      <div class=" form-check form-switch" style= "display: flex;justify-content: center;" >
                        <input class="form-check-input" type="checkbox" id="NC" name="more" value= 1  >
                    </div>
                        <label for="" class="col-form-label">Editar:</label>
                      <div class=" form-check form-switch" style= "display: flex;justify-content: center;">
                        <input class="form-check-input" type="checkbox" id="NE" name="more" value= 1>
                    </div>
                    <br>
                    </div>
                    <div class="col-lg-6" style = "text-align: center;">
                      <label for="" class="col-form-label">Lectura:</label>
  
                      <div class=" form-check form-switch" style= "display: flex;justify-content: center;">
                        <input class="form-check-input" type="checkbox" id="NL" name="more" value= 1>
                    </div>
                      <label for="" class="col-form-label">Eliminar:</label>
                      <div class=" form-check form-switch" style= "display: flex;justify-content: center;">
                        <input class="form-check-input" type="checkbox" id="NB" name="more" value= 1>
                    </div>
                    <br>
                        </div>

                        <hr>
                        
                        <!--ORGANIZACION-->
    <div class="col-lg-12">
        
                      <h5 style = "text-align: center;">ORGANIZACION</h5>
</div>
    <div class="col-lg-6" style = "text-align: center;">
                      <label for="" class="col-form-label">Crear:</label>
                      <div class=" form-check form-switch" style= "display: flex;justify-content: center;">
                        <input class="form-check-input" type="checkbox" id="OC" name="more" value= 1>
                    </div>
                        <label for="" class="col-form-label">Editar:</label>
                      <div class=" form-check form-switch" style= "display: flex;justify-content: center;">
                        <input class="form-check-input" type="checkbox" id="OE" name="more" value= 1>
                    </div>
                     <br>
                    </div>
                    <div class="col-lg-6" style = "text-align: center;">
                      <label for="" class="col-form-label">Lectura:</label>
  
                      <div class=" form-check form-switch" style= "display: flex;justify-content: center;">
                        <input class="form-check-input" type="checkbox" id="OL" name="more" value= 1>
                    </div>
                      <label for="" class="col-form-label">Eliminar:</label>
                      <div class=" form-check form-switch" style= "display: flex;justify-content: center;">
                        <input class="form-check-input" type="checkbox" id="OB" name="more" value= 1>
                    </div>
                     <br>
                        </div>
                        <hr>

                        <!--PERSONA-->
    <div class="col-lg-12">
        
                      <h5 style = "text-align: center;">PERSONA</h5>
</div>
    <div class="col-lg-6"  style = "text-align: center;">
                      <label for="" class="col-form-label">Crear:</label>
                      <div class=" form-check form-switch" style= "display: flex;justify-content: center;">
                        <input class="form-check-input" type="checkbox" id="PC" name="more" value= 1>
                    </div>
                        <label for="" class="col-form-label">Editar:</label>
                      <div class=" form-check form-switch" style= "display: flex;justify-content: center;">
                        <input class="form-check-input" type="checkbox" id="PE" name="more" value= 1>
                    </div>
                    </div>
                    <div class="col-lg-6" style = "text-align: center;">
                      <label for="" class="col-form-label">Lectura:</label>
  
                      <div class=" form-check form-switch" style= "display: flex;justify-content: center;">
                        <input class="form-check-input" type="checkbox" id="PL" name="more" value= 1>
                    </div>
                      <label for="" class="col-form-label">Eliminar:</label>
                      <div class=" form-check form-switch" style= "display: flex;justify-content: center;">
                        <input class="form-check-input" type="checkbox" id="PB" name="more" value= 1>
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



<table id="myTable2" class="table table-striped nowrap" style='width:100%'>
        <thead>
            <tr>
                
                <th class ='never'>id</th>
                <th>perfil</th>
                <th>tipo</th>
                <th>Crear niño</th>
                <th>Editar niño</th>
                <th>Leer datos de niños</th>
                <th>Eliminar niños</th>

                <th class="none">Crear Organanizacion</th>
                <th class="none">Editar Organizacion</th>
                <th class="none">Leer datos de Organizacion</th>
                <th class="none">Eliminar Organizacion</th>

                <th class="none">Crear Persona</th>
                <th class="none">checkUpdateP</th>
                <th class="none">checkReadP</th>
                <th class="none">checkDeleteP</th>
                <th class="none">estado</th>
                <th class='all'>acciones</th>
            </tr>
        </thead>
        <tbody>

        </tbody>

    </table>
    <script type="text/javascript" src="../datatables.js"></script>
    <script type="text/javascript" src="../js/ajax/idioma.js"></script>>
    <script type="text/javascript" src="../js/AJAX_TIPO_USUARIO.js"> </script>