<?php
session_start();
// controllerReport.php
require_once ("../model/MODEL_REPORTE.php");

$rep = new Reportes();

//$periodo=2024;
$periodo=$_POST['periodo'];

switch ($_GET["op"]) {
        
        case "pdfGeneral":

            $datos = $rep->pdfGeneralJSON($periodo);
            print($datos); 
            break;

        case "pdfNaciones":
            $datos = $rep->reporteNacionalidadJSON($periodo);

            print($datos);
            break;

        case "pdfGeneralDiscapacidad":
            $datos = $rep->pdfGeneralDiscapacidadJSON($periodo);

            print($datos);
            break;
             
}



?>
