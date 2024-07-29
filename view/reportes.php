<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="../images/Escudo_de_Alto_Hospicio.png">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../style/bootstrap.css">

    <link rel="stylesheet" href= ../js/jquery-3.7.0.js >
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="../datatables.css">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../style/font/bootstrap-icons.min.css">
    
    <!-- Custom Styles -->
    <link rel="stylesheet" href="../style/styles.css">
    
    <!-- DataTables JS -->
    <script src="../datatables.js"></script>

    <!-- Chart.js -->
    <script src="../js/chart.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>

    
    
    <script>
      // Script para mostrar el Tooltip al pasar el cursor sobre el botón
      $(document).ready(function() {
        // Inicializar tooltips de Bootstrap
        $('[data-toggle="tooltip"]').tooltip({
          delay: { show: 0, hide: 0 },
          placement: 'top'
        });
        
        // Inicializar DataTables
        $('#reportTable').DataTable();
      });
    </script>
    

    
    <?php session_start(); ?>
    
    <title>Navidad</title>

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

.table-responsive {
  margin-top: 20px;
}

.nav-bar {
  margin-bottom: 20px;
}

.btnReportGen {
  height: 40px; /* Ajusta la altura del botón */
  line-height: 40px; /* Alinea el contenido del botón verticalmente */
  padding: 10 10px; /* Ajusta el padding del botón */
  display: inline-flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 20px;
}

.btnReportGen i {
  font-size: 100; /* Ajusta el tamaño del icono */
  padding: 100; /* Ajusta el padding del icono */
}

.card-custom {
  background-color: #fff; /* Fondo del recuadro */
  padding: 20px;
  border-left: 20px;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
}

h1.text-center {
  margin-bottom: 20px;
  color: #000;
}

.chart-container {
  width: 50%; /* Ajusta el tamaño del contenedor del gráfico */
}
    </style>
  </head>
  <body>
    <!-- NAV BAR -->
    <?php include_once("./nav_bar.php"); ?>
    <!-- NAV BAR END -->
    
    
        <?php 
          require_once '../controller/controller_vista.php';
          tablaReportes();
          
        ?>
      
  </body>
</html>
