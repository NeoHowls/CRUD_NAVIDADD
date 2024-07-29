<?php 
// Inicia el almacenamiento en búfer de la salida
ob_start();

// Ruta absoluta a la imagen
// $logoPath = 'C:\\xampp\\htdocs\\Proyecto_navidad\\CRUD_NAVIDADD\\images\\MahoH.png';
$logoPath = './images/MahoH.png';
if (file_exists($logoPath)) {
    $logoBase64 = base64_encode(file_get_contents($logoPath));
    $logoDataUri = 'data:image/png;base64,' . $logoBase64;
} else {
    $logoDataUri = '';
}


date_default_timezone_set('America/Santiago');
// Obtener la fecha y hora actuales
$fechaHora = date('d/m/Y H:i');
$anio = date('Y');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="../images/Escudo_de_Alto_Hospicio.png">
    <title>Reporte de Usuario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #ffffff;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border: 2px solid #000;
            border-radius: 10px;
            width: 80%; 
            margin: 0 auto; 
            text-align: center;
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
			line-height:1.5;
        }
        .label {
            font-weight: bold;
        }
        .fecha-hora {
            text-align: right;
            font-size: 0.9em;
            color: #000;
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
                <img src="<?php echo $logoDataUri; ?>" alt="Logo de la organización" class="logo">
            <?php else: ?>
                <p>Logo no encontrado</p>
            <?php endif; ?>
        </div>
        <div class="content">
            <h2>Navidad <?php echo $anio; ?> - Municipalidad de Alto Hospicio</h2>
            <br>
            <p>Estimado/a <span class="label"><?php echo htmlspecialchars($_GET['nombre']); ?></span>, de <span class="label"><?php echo htmlspecialchars($_GET['tipo']); ?></span>- <span class="label"><?php echo htmlspecialchars($_GET['organizacion']); ?></span>
			, sus datos para acceder al sistema de navidad son los siguientes:</p>
            
            <p>Página Web: <span class="label"><?php echo htmlspecialchars('https://www.maho.cl/navidad'); ?></span></p>
            <p>Usuario: <span class="label"><?php echo htmlspecialchars($_GET['usuario']); ?></span></p>
            <p>Contrase&ntilde;a: <span class="label"><?php echo htmlspecialchars($_GET['contrasena']); ?></span></p>
        </div>
    </div>
</body>
</html>

<?php
// Captura el contenido del búfer de salida
$html = ob_get_clean();

// Carga la librería dompdf
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;

// Instancia un objeto de la clase DOMPDF
$pdf = new Dompdf();

// Define el tamaño y orientación del papel
$pdf->set_paper("letter", "portrait");

// Carga el contenido HTML
$pdf->load_html($html);

// Renderiza el documento PDF
$pdf->render();

// Envía el fichero PDF al navegador
$pdf->stream('reportePdf.pdf', array("Attachment" => false));
?>
