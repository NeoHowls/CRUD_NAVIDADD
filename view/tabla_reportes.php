<style>
    /* Estilos personalizados */
    body {
      color: #c43d3d;
      font-size: 15px;
      font-family: 'Poppins', sans-serif;
      line-height: 1.80857;
      background-color: #bd0000;
      background: url("../images/bg.jpg");
      background-size: 50%;
    }

    .container {
      margin-top: 28px;
      max-width: 1343px; /* Ajusta el tamaño máximo del contenedor */
      width: 100%; /* Asegura que el contenedor use todo el espacio disponible */
      margin-left: auto; /* Centra el contenedor horizontalmente */
      margin-right: auto; /* Centra el contenedor horizontalmente */
    }

    .card-custom {
      background-color: #fff; /* Fondo del recuadro */
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
      text-align: center;
      margin-top: 28px;
    }

    .chart-container {
      display: flex;
      justify-content: center;
      margin-top: 20px;
      margin-left: auto; /* Centra el contenedor horizontalmente */
      margin-right: auto;
    }

    h1.text-center {
      margin-bottom: 20px;
      color: #000;
    }
  </style>  
<div class="container">
    <br>
    <div class="card">
        <div class="card-header">
            
                          <!-------------->
                          <!-------------->
                          <!-- Reportes -->
                          <!-------------->
                          <!-------------->
                              <div class="container">
                            <div class="card-custom">
                              <h1 class="text-center">Generar Informes</h1>
                              <div class="row">
                              <div class="col-lg-4"></div>
                              <div class="col-lg-4" style="text-align: center;">
                                  <label for="select_periodo" class="col-form-label">Periodo:</label>
                                  <select name="periodo" id="select_periodo" class="form-control">
                                      <?php
                                          for ($i = 2023; $i <= date("Y"); $i++) {
                                              echo "<option value=\"$i\" " . ($i == date("Y") ? "selected" : "") . ">$i</option>";
                                          }
                                      ?>
                                  </select>
                              </div>

                          <div class="col-lg-4"></div>  
                          </div>                                
                              <div class="row">
                                <div class="col-lg-12">
                                  <h3>IMPRIMIR REPORTE GENERAL</h3>
                                  <button id="btnReportGen" type="button" class="btn btn-warning text-light btnReportGen" data-toggle="tooltip" data-placement="top" title="Imprimir Reporte General">
                                    <i id="iconReportGen" class="bi bi-filetype-pdf fs-3"></i>
                                  </button>
                                </div>
                                <div class="col-lg-12 chart-container">
                                  <canvas id="chartReportGen"></canvas>
                                  <div><br></br></div> 
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-lg-12">
                                <div><br></br></div> 
                                  <h3>IMPRIMIR REPORTE NACIONALIDAD</h3>
                                  <button id="btnReportNat" type="button" class="btn btn-warning text-light btnReportGen" data-toggle="tooltip" data-placement="top" title="Imprimir Reporte Nacionalidad">
                                    <i id="iconReportNat" class="bi bi-filetype-pdf fs-3"></i>
                                  </button>
                                </div>
                                <div class="col-lg-12 chart-container">
                                  <canvas id="chartReportGen3"></canvas>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-------------->
                          <!-------------->
                          <!-- Reportes -->
                          <!-------------->
                          <!-------------->
                          

                          <!-------------->
                          <!-------------->
                          <!----TABLA----->
                          <!-------------->
                          <!-------------->
                           <!-- <div class="table-responsive mx-2 text-left">
                          <table id="myTable11" class="table table-striped nowrap table-centered" style="width:100%">
                            <thead>
                                <tr>
                                
                                    <th class='never'>EDAD</th>  
                                    <th style='text-align: center;'>RANGO ETARIO</th> 
                                    <th style='text-align: center;'>MASCULINO</th>  
                                    <th style='text-align: center;'>FEMENINO</th>  
                                    <th style='text-align: center;'>TOTAL</th>  
                                  
                                    
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                    <tr>
                                        <th></th> 
                                        <th style='text-align: center;'>TOTAL:</th> 
                                        <th style='text-align: right;' id="totalMasculino2"></th> 
                                        <th style='text-align: right;' id="totalFemenino2"></th> 
                                        <th style='text-align: right;' id="totalGeneral2"></th> 
                                    </tr>
                                </tfoot>
                          </table>
                        </div> --> 
                          <!-------------->
                          <!-------------->
                          <!----TABLA----->
                          <!-------------->
                          <!-------------->
                          <!-- <div class="table-responsive mx-2 text-left">
                          <table id="myTable12" class="table table-striped nowrap" style="width:100%">
                            <thead>
                                <tr>
                                
                                    <th class='never'>ID</th>  
                                    <th style='text-align: center;'>NACIONALIDAD</th> 
                                    <th style='text-align: center;'>MASCULINO</th>  
                                    <th style='text-align: center;'>FEMENINO</th>  
                                    <th style='text-align: center;'>TOTAL</th>  
                                  
                                    
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                    <tr>
                                        <th></th> 
                                        <th style='text-align: center;'>TOTAL:</th> 
                                        <th style='text-align: right;' id="totalMasculino2"></th> 
                                        <th style='text-align: right;' id="totalFemenino2"></th> 
                                        <th style='text-align: right;' id="totalGeneral2"></th> 
                                    </tr>
                                </tfoot>
                          </table>
                        </div> -->
                          
        </div>
    </div>
</div>

<script src="../datatables.js"></script>
<script src="../js/idioma.js"></script>
<script src="../js/AJAX_REPORTES.js"></script> 