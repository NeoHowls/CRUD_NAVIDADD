<?php
session_start();
use Dompdf\Dompdf;
if (!isset($_SESSION["id_persona"]) || empty($_SESSION["id_persona"])) {
    header("Location:../index.php");
  }
  else{
require_once '../model/MODEL_REPORTE.php';
require_once '../dompdf/autoload.inc.php';


$idOrg = isset($_GET['idOrg']) ? $_GET['idOrg'] : null;
$nombreO = isset($_GET['nombre1']) ? $_GET['nombre1'] : '';
$Organizacion = isset($_GET['organizacion']) ? $_GET['organizacion'] : '';
$periodo = isset($_GET['periodo']) ? $_GET['periodo'] : date('Y');

$rep=new Reportes();
$datos=$rep->reporteOrganizacion($idOrg,$periodo);

    // Paso 2: Construir el HTML con los datos obtenidos
    ob_start(); // Iniciar almacenamiento en búfer de salida

    // Datos para el encabezado
    $logoPath = '../images/MahoH.png';
    if (file_exists($logoPath)) {
        $logoBase64 = base64_encode(file_get_contents($logoPath));
        $logoDataUri = 'data:image/png;base64,' . $logoBase64;
    } else {
        $logoDataUri = '';
    }

    date_default_timezone_set('America/Santiago');
    // Obtener la fecha y hora actuales
    $fechaHora = date('d/m/Y H:i');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta charset="UTF-8">
    <title>Informe de Organizacion <?php echo htmlspecialchars($_GET['nombre1']); ?></title>
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
        }
        .logo-container {
            display: left;
            vertical-align: top;
            width: 30%;
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
            <h2>Navidad <?php echo htmlspecialchars($periodo); ?> - Municipalidad de Alto Hospicio</h2>
            <!-- <p>id Organización: <span class="label"><?php echo htmlspecialchars($idOrg); ?></span></p> -->
            <h3>Informe de la organizacion: <span class="label"><?php echo htmlspecialchars($_GET['organizacion']); ?></span> - <span class="label"><?php echo htmlspecialchars($_GET['nombre1']); ?></span></h3>
            <?php if (!empty($datos)): ?>
            <table>
                <thead>
                    <tr>
                        <!-- <th>ID</th> -->
                        <th>DNI/RUT</th>
                        <th>Nombre</th>
                        <th>Sexo</th>
                        <th>Edad</th>
                        <!-- <th>Periodo</th> -->
                        <th>Etnia</th>
                        <th>Nacionalidad</th>
                        <!-- <th>ID Organización</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datos as $row): ?>
                        <tr>
                            <!-- <td><?php echo htmlspecialchars($row['id']); ?></td> -->
                            <td><?php echo htmlspecialchars($row['dni']); ?></td>
                            <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($row['sexo_vista']); ?></td>
                            <td><?php echo htmlspecialchars($row['edad']); ?></td>
                            <!-- <td><?php echo htmlspecialchars($row['periodo']); ?></td> -->
                            <td><?php echo htmlspecialchars($row['etnia']); ?></td>
                            <td><?php echo htmlspecialchars($row['nacionalidad']); ?></td>
                            <!-- <td><?php echo htmlspecialchars($row['idOrganizacion']); ?></td> -->
                        </tr>
                    <?php endforeach; ?>
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
    $html = ob_get_clean(); // Capturar contenido del búfer y limpiarlo

    // Paso 3: Generar el PDF con Dompdf
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);

    // Configurar opciones del PDF (tamaño, orientación, etc.)
    $dompdf->setPaper('letter', 'landscape');

    // Renderizar PDF (generar el contenido del PDF)
    $dompdf->render();

    // Salida del PDF al navegador
    $dompdf->stream('reporteOrganizacion.pdf', array("Attachment" => false));
}
?>
