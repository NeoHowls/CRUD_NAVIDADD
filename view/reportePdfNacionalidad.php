<?php
require_once ("../model/MODEL_REPORTE.php");

require_once '../dompdf/autoload.inc.php';
use Dompdf\Dompdf;

$periodo=$_GET['periodo'];

$rep = new Reportes();


$datos2 = $rep->reporteNacionalidad($periodo);



$nacionalidades = $rep->listarNacionalidad();

$datosPorNacionalidad = [];
foreach ($nacionalidades as $nacion){
    $datosPorNacionalidad[$nacion['nacionalidad']] = $rep->reporteNacionalidadEtario($periodo,$nacion['nacionalidad'],$nacion['id']);
}
    
    // Construir el HTML con los datos obtenidos
    ob_start();

    // Datos para el encabezado
    $logoPath = '../images/MahoH.png';
    if (file_exists($logoPath)) {
        $logoBase64 = base64_encode(file_get_contents($logoPath));
        $logoDataUri = 'data:image/png;base64,' . $logoBase64;
    } else {
        $logoDataUri = '';
    }

    date_default_timezone_set('America/Santiago');
    $fechaHora = date('d/m/Y H:i');
    $anio = date('Y');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta charset="UTF-8">
    <title>Informe por Nacionalidad</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #ffffff;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border: 2px solid #fff;
            border-radius: 10px;
            width: 100%; 
            margin: 0 auto; 
            text-align: center;
            page-break-after: always;
        }
        .logo-container {
            display: inline-block;
            vertical-align: top;
            width: 50%;
            text-align: left;
        }
        .logo {
            max-width: 100%;
            height: auto;
        }
        .content {
            display: inline-block;
            width: 75%;
            vertical-align: middle;
            text-align: left;
        }
        h2 {
            color: #333;
            display: inline-block;
            margin: 0;
            line-height: 1.5;
        }
        .label {
            font-weight: bold;
        }
        .fecha-hora {
            text-align: right;
            font-size: 0.9em;
            color: #000;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .page-break {
            page-break-before: always;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="fecha-hora">
            <p><?php echo $fechaHora; ?></p>
        </div>
        <br>
        <div class="logo-container">
            <?php if ($logoDataUri): ?>
                <img src="<?php echo $logoDataUri; ?>" class="logo" alt="Logo">
            <?php endif; ?>
        </div>
        <div class="content">
            <h2>Navidad <?php echo $periodo; ?> - Municipalidad de Alto Hospicio</h2>
            <h2>Informe General</h2>
        </div>
        <?php
            $totalMasculino2 = 0;
            $totalFemenino2 = 0;
            $totalGeneral2 = 0;
        ?>
        <table>
            <thead>
                <tr>
                    <th>NACIONALIDAD</th>
                    <th>HOMBRES</th>
                    <th>MUJERES</th>
                    <th>TOTAL</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($datos2 as $dato): ?>
                    <tr>
                        <td><?php echo $dato['nacionalidad']; ?></td>
                        <td><?php echo $dato['MASCULINO']; ?></td>
                        <td><?php echo $dato['FEMENINO']; ?></td>
                        <td><?php echo $dato['TOTAL']; ?></td>
                    </tr>
                    <?php
                        $totalMasculino2 += $dato['MASCULINO'];
                        $totalFemenino2 += $dato['FEMENINO'];
                        $totalGeneral2 += $dato['TOTAL'];
                    ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        <table>
            <tfoot>
                <tr>
                    <th>TOTALES</th>
                    <th><?php echo $totalMasculino2; ?></th>
                    <th><?php echo $totalFemenino2; ?></th>
                    <th><?php echo $totalGeneral2; ?></th>
                </tr>
            </tfoot>
        </table>
    </div>
    
    <?php foreach ($datosPorNacionalidad as $nacionalidad => $datos): ?>
        <div class="container">
            <div class="content">
                <h2>Informe Nacionalidad: <?php echo $nacionalidad; ?></h2>
            </div>
            <?php
                $totalMasculino = 0;
                $totalFemenino = 0;
                $totalGeneral = 0;
            ?>
            <table>
                <thead>
                    <tr>
                        <th>EDAD</th>
                        <th>NACIONALIDAD</th>
                        <th>HOMBRES</th>
                        <th>MUJERES</th>
                        <th>TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datos as $dato): ?>
                        <tr>
                            <td><?php echo $dato['edadV']; ?></td>
                            <td><?php echo $dato['nacionalidad']; ?></td>
                            <td><?php echo $dato['MASCULINO']; ?></td>
                            <td><?php echo $dato['FEMENINO']; ?></td>
                            <td><?php echo $dato['TOTAL']; ?></td>
                        </tr>
                        <?php
                            $totalMasculino += $dato['MASCULINO'];
                            $totalFemenino += $dato['FEMENINO'];
                            $totalGeneral += $dato['TOTAL'];
                        ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <table>
                <tfoot>
                    <tr>
                        <th colspan="2">TOTALES</th>
                        <th><?php echo $totalMasculino; ?></th>
                        <th><?php echo $totalFemenino; ?></th>
                        <th><?php echo $totalGeneral; ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    <?php endforeach; ?>
</body>
</html>

<?php
    $html = ob_get_clean();

    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream('informe_por_nacionalidad.pdf', ['Attachment' => false]);


?>
