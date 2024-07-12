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

<script>
    // Script para mostrar el Tooltip al pasar el cursor sobre el botón
    $(document).ready(function() {
      // Inicializar tooltips de Bootstrap
      $('[data-toggle="tooltip"]').tooltip({
        delay: { show: 0, hide: 0 },
        placement: 'top'
      });

      // Inicializar gráficos de Chart.js GENERAL
      const ctx1 = document.getElementById('chartReportGen').getContext('2d');
      const chartReportGen = new Chart(ctx1, {
        type: 'bar',
        data: {
          labels: ['FEMENINO', 'MASCULINO', 'TOTAL'],
          datasets: [{
            label: '# of Votes',
            data: [11, 19, 30],
            backgroundColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(255, 206, 86, 0.2)'
            ],
            borderColor: [
              'rgba(255, 99, 132, 1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)'
            ],
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });

      // Inicializar gráficos de Chart.js POR NACIONALIDAD
      const ctx3 = document.getElementById('chartReportGen3').getContext('2d');
      const chartReportGen3 = new Chart(ctx3, {
        type: 'bar',
        data: {
          labels: ['CHILE', 'ARGENTINA', 'URUGUAY', 'PARAGUAY', 'BOLIVIA', 'PERU', 'BRASIL', 'ECUADOR', 'COLOMBIA', 'VENEZUELA'],
          datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3, 14, 4, 9, 10],
            backgroundColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(255, 206, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(255, 159, 64, 0.2)',
              'rgba(123, 239, 178, 0.2)',
              'rgba(232, 90, 130, 0.2)',
              'rgba(101, 143, 255, 0.2)',
              'rgba(255, 123, 167, 0.2)'
            ],
            borderColor: [
              'rgba(255, 99, 132, 1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)',
              'rgba(255, 159, 64, 1)',
              'rgba(123, 239, 178, 1)',
              'rgba(232, 90, 130, 1)',
              'rgba(101, 143, 255, 1)',
              'rgba(255, 123, 167, 1)'
            ],
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
    });
  </script>

<div class="container">
    <br>
    <div class="card">
        <div class="card-header">
            Tabla de edades
                          <!-------------->
                          <!-------------->
                          <!-- Reportes -->
                          <!-------------->
                          <!-------------->
                             <!-- <div class="container">
                            <div class="card-custom">
                              <h1 class="text-center">Generar Informes</h1>
                              <div class="row">
                                <div class="col-lg-12">
                                  <h3>IMPRIMIR REPORTE GENERAL POR ORGANIZACION</h3>
                                  <button id="btnReportOrg" type="button" class="btn btn-warning text-light btnReportGen" data-toggle="tooltip" data-placement="top" title="Imprimir Reporte General por Organización">
                                    <i id="iconReportOrg" class="bi bi-filetype-pdf fs-3"></i>
                                  </button>
                                </div>
                                 <div><br></br></div>  
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
                          </div> --> 
                          <!-------------->
                          <!-------------->
                          <!-- Reportes -->
                          <!-------------->
                          <!-------------->

                          <!-- ------------>
                          <!-------------->
                          <!----TABLA----->
                          <!-------------->
                          <!-------------->
                          <div class="table-responsive mx-2 text-left">
                          <table id="myTable11" class="table table-striped nowrap" style="width:100%">
                            <thead>
                                <tr>
                                
                                    <th>EDAD</th>  <!-- 0 -->
                                    <th>MASCULINO</th>  <!-- 1 -->
                                    <th>FEMENINO</th>  <!-- 2 -->
                                    <th>TOTAL</th>  <!-- 3 -->
                                  
                                    
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>

                          </table>
                        </div>
                          <!-------------->
                          <!-------------->
                          <!----TABLA----->
                          <!-------------->
                          <!-------------->
                          
        </div>
    </div>
</div>

<script src="../datatables.js"></script>
<script src="../js/idioma.js"></script>
<script src="../js/AJAX_REPORTES.js"></script> 