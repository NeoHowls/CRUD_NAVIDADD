
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
          <div class="modal-content" style="width: 110%;">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"></h5>
  
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        
                  </button>
              </div>
          <form id="formUsuarios">    
          <div class="modal-body" style="background: #E7E7E7">
                  <div class="row">
    <div class="col-lg-6" style = "text-align: center;" >   
    <label for="" class="col-form-label">nombre:</label>
                      <input type="text" class="form-control" id="nombre">
    <label for="" class="col-form-label">DNI:</label>
                      <input type="text" class="form-control" id="dni">
                      <br>
    </div>              
    <div class="col-lg-6" style = "text-align: center;">   
    <label for="" class="col-form-label">periodo:</label>
                      <select name="cars" id="periodo" class = "form-control">
                        <option value=1>2022</option>
                        <option value=2>2023</option>
                        <option value=3>2024</option>
                        <option value=4>2025</option>
                      </select>
                      
 
    <label for="" class="col-form-label">Sexo:</label>
                      <select name="cars" id="periodo" class = "form-control">
                        <option value=1>HOMBRE</option>
                        <option value=0>MUJER</option>
                        
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
                      <label for="" class="col-form-label">Naciemiento:</label>
                        <input type="date" class="form-control" id="Naciemiento">


                        <label for="" class="col-form-label">etnia:</label>
                      <select name="cars" id="etnia" class = "form-control">
                        <option value=1>Mapuche</option>
                        <option value=2>Aymara</option>
                        <option value=3>Rapa Nui</option>
                        <option value=4>Quechua</option>
                        <option value=5>Colla</option>
                        <option value=6>Chango</option>
                        <option value=7>Diaguita</option>
                        <option value=8>Kawésqar</option>
                        <option value=9>Yagan</option>
                      </select>
                    <br>
                    </div>
                    <div class="col-lg-6" style = "text-align: center;">
                      

                       <label for="" class="col-form-label">Naciemiento:</label>
                      <input type="date" class="form-control" id="Naciemiento">
                      
                      
                      <label for="" class="col-form-label">descripcion:</label>
                      <input type="text" class="form-control" id="descripcion">
                    <br>
                        </div>

                        <hr>
                        

                        <!--PERSONA-->
</div>
    <label class="col-form-label" for="flexSwitchCheckDefault">Discapacidad</label>
                      <div class="elnt_container form-check form-switch">
                     
                    
                        <input class="form-check-input" type="checkbox" id="more_info" name="more" value= 1>
                    </div>


      <div id="conditional_part">
    <div class="col-lg-6">
                      <label for="" class="col-form-label">Ceguera:</label>
                      <input type="checkbox" id="cbox2" value= 1 id="comuna">
                        <label for="" class="col-form-label">Sordera:</label>
                      <input type="checkbox" id="cbox2" value= 1 id="comuna">
                      <label for="" class="col-form-label">Mudez:</label>
  
                      <input type="checkbox" id="cbox2" value= 1 id="comuna">
                      
                      <label for="" class="col-form-label">Fisica:</label>
                      <input type="checkbox" id="cbox2" value= 1 id="comuna">
                      <label for="" class="col-form-label">Mental:</label>
                      <input type="checkbox" id="cbox2" value= 1 id="comuna">
                      <label for="" class="col-form-label">Psiquica:</label>
                      <input type="checkbox" id="cbox2" value= 1 id="comuna">
                      </div>
     </div>
                    
                    <div class="col-lg-6" style = "text-align: center;">
                      <label class="col-form-label" for="flexSwitchCheckDefault">EXTRANJERO <div class="elnt_container form-check form-switch">
                     <input class="form-check-input" type="checkbox" id="more_infos" name="more" value = 1>
                    </div></label>
                      
                      
                    
                        
                      <div id="conditional_parts">


                      <?php 
                      include_once("../controller/controller_nac.php");
                      ?>
                      <select name="cars" id="nacion" class = "form-control">              
                        <?php

                        foreach($datos as $key => $value){
                          if($value['id'] >= 2){
                            echo '<option value="'.$value['id'].'">'.$value['nacionalidad'].'</option>'; 
                            

                          }
                        }
                        ?>
                      </select>
                      </div>
                        </div>
                 
              <div class="modal-footer" style="justify-content: center">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                  <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
              </div>
              </div>
              </div>
            


</form>  
      </div>
      </div>
      

 
<table id="myTable" class="table table-striped nowrap" style="width:100%">
        <thead>
            <tr>
                
                <th>id</th>
                <th>correlativo</th>
                <th>dni</th>
                <th>nombre</th>
                <th>sexo</th>

                <th>edad</th>
                <th>periodo</th>
                <th>descripcion</th>
                <th>fechaRegistro</th>
                <th>Naciemiento</th>
                
                <th>etnia</th>
                <th class="none">nacionalidad</th>
                <th class="none">comuna</th>
                <th class="none">tipo</th>
                <th class="never">id_nac</th>
                <th class="none">check_extra</th>
                
                

                <th class='all'>acciones</th>
            </tr>
        </thead>
        <tbody>

        </tbody>

    </table>
    <script type="text/javascript" src="../datatables.js"></script>
    <script type="text/javascript" src="../js/ajax/idioma.js"></script>>
    <script type="text/javascript" src="../js/AJAX_NINOS.js"> </script>
        
    </script>