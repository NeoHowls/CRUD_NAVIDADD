<?php
session_start();
use Dompdf\Dompdf;
if (!isset($_SESSION["id_persona"]) || empty($_SESSION["id_persona"])) {
  header("Location:../index.php");
}
else{

// require_once '../model/MODEL_REPORTE.php';
require_once ("../model/MODEL_REPORTE.php");

require_once '../dompdf/autoload.inc.php';


$periodo=$_GET['periodo'];
// echo $periodo;
$datos = array();
$rep = new Reportes();
$datos = $rep->pdfGeneral($periodo);
  

    // Inicializar totales
    $totalMasculino = 0;
    $totalFemenino = 0;
    $totalGeneral = 0;

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
    <link rel="icon" type="image/png" href="../images/Escudo_de_Alto_Hospicio.png">
    <title>Informe general</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 10px;
            background-color: #ffffff;
        }
        .container {
            background-color: #fff;
            padding: 10px;
            border: 2px solid #000;
            border-radius: 10px;
            width: 100%; 
            margin: 0 auto; 
            text-align: center;
        }
        .logo-container {
            display: right;
            vertical-align: top;
            width: 30%;
            text-align: right;
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
    </style>
</head>
<body>
    <div class="container">
        <div class="fecha-hora">
            <p><?php echo $fechaHora; ?></p>
        </div>
        <div class="logo-container">
            <?php if ($logoDataUri): ?>
                <img src="<?php echo $logoDataUri; ?>" alt="Logo de la organización" class="logo">
            <?php else: ?>
                <p>Logo no encontrado</p>
            <?php endif; ?>
        </div>
        <div class="content">
            <h2>Navidad <?php echo $periodo; ?> - Municipalidad de Alto Hospicio</h2>
            <h3>Informe General</h3>
            <?php if (!empty($datos)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Edad</th>
                        <th>Masculino</th>
                        <th>Femenino</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datos as $row): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['edadV']); ?></td>
                            <td><?php echo htmlspecialchars($row['MASCULINO']); ?></td>
                            <td><?php echo htmlspecialchars($row['FEMENINO']); ?></td>
                            <td><?php echo htmlspecialchars($row['TOTAL']); ?></td>
                        </tr>
                        <?php
                            // Acumular totales
                            $totalMasculino += $row['MASCULINO'];
                            $totalFemenino += $row['FEMENINO'];
                            $totalGeneral += $row['TOTAL'];
                        ?>
                    <?php endforeach; ?>
                    <!-- Fila de totales -->
                    <tr>
                        <td style="font-weight: bold;">Total</td>
                        <td style="font-weight: bold;"><?php echo $totalMasculino; ?></td>
                        <td style="font-weight: bold;"><?php echo $totalFemenino; ?></td>
                        <td style="font-weight: bold;"><?php echo $totalGeneral; ?></td>
                    </tr>
                </tbody>
            </table>
            <?php else: ?>
                <p>No hay datos para mostrar.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>

<?php
    $html = ob_get_clean();

    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);

    $dompdf->setPaper('letter', 'portrait');

    $dompdf->render();

    $dompdf->stream('reporteGeneral.pdf', array("Attachment" => false));

    $connection = null;

}
?>
