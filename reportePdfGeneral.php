<?php
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;

$host = '10.20.10.13';
$dbname = 'BD_NAVIDAD';
$user = 'sa';
$password = '1';

try {
    $connection = new PDO("sqlsrv:server=$host;database=$dbname", $user, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta SQL
        $sql = "SELECT edad,
                   REPLACE(edad, 99, 'MAYORES DE 10 AÑOS') edadV,
                   ISNULL(sum(masculino), 0) MASCULINO,
                   ISNULL(sum(femenino), 0) FEMENINO,
                   ISNULL(sum(masculino)+sum(femenino), 0) TOTAL
            FROM (
                SELECT E.edad edad,
                       VCN.masculino masculino,
                       VCN.FEMENINO femenino
                FROM (SELECT * FROM V_CONTEONINOS WHERE edad <= 10 and periodo=2024 AND estado=1) VCN
                RIGHT JOIN A_EDAD E ON VCN.edad = E.edad
                UNION
                SELECT edad = 99,
                       sum(masculino) MASCULINO,
                       sum(femenino) FEMENINO
                FROM V_CONTEONINOS VCN
                WHERE VCN.edad > 10 AND VCN.periodo=2024 AND estado=1
            ) vista
            GROUP BY edad
            ORDER BY edad";

    $stmt = $connection->prepare($sql);
    $stmt->execute();
    $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Inicializar totales
    $totalMasculino = 0;
    $totalFemenino = 0;
    $totalGeneral = 0;

    // Construir el HTML con los datos obtenidos
    ob_start();

    // Datos para el encabezado
    $logoPath = './images/MahoH.png';
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
    <title>Informe general</title>
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
            width: 100%; 
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
            <br>
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

    $dompdf->setPaper('A4', 'portrait');

    $dompdf->render();

    $dompdf->stream('reporte.pdf', array("Attachment" => false));

    $connection = null;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
