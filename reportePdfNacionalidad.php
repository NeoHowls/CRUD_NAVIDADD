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

    // Consulta SQL para la primera tabla
    $sql1 = "SELECT
                edad,
                REPLACE(CAST(edad AS VARCHAR), '99', 'MAYORES DE 10 AÑOS') AS edadV,
                COALESCE(nacionalidad, 'SIN DATOS') AS nacionalidad,
                idNacionalidad,
                COALESCE(SUM(masculino), 0) AS MASCULINO,
                COALESCE(SUM(femenino), 0) AS FEMENINO,
                COALESCE(SUM(masculino) + SUM(femenino), 0) AS TOTAL
            FROM (
                SELECT
                    E.edad AS edad,
                    VCN.nacionalidad,
                    VCN.idNacionalidad AS idNacionalidad,
                    VCN.masculino AS masculino,
                    VCN.femenino AS femenino
                FROM
                    (SELECT * FROM V_CONTEONINOSNACION WHERE edad <= 10 AND periodo = 2024 AND estado=1) VCN
                RIGHT JOIN
                    A_EDAD E ON VCN.edad = E.edad
                UNION ALL
                SELECT
                    99 AS edad,
                    'MULTIPLES' AS nacionalidad,
                    99 AS idNacionalidad,
                    SUM(VCN.masculino) AS masculino,
                    SUM(VCN.femenino) AS femenino
                FROM
                    V_CONTEONINOSNACION VCN
                WHERE
                    VCN.edad > 10 AND VCN.periodo = 2024 AND estado=1
            ) vista
            GROUP BY
                edad,idNacionalidad, nacionalidad
            ORDER BY
                edad";

    $stmt1 = $connection->prepare($sql1);
    $stmt1->execute();
    $datos1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

    // Consulta SQL para la nueva tabla
    $sql2 = "SELECT idNacionalidad,
                    COALESCE(nacionalidad, 'SIN DATOS') AS nacionalidad,
                            COALESCE(SUM(masculino), 0) AS MASCULINO,
                            COALESCE(SUM(femenino), 0) AS FEMENINO,
                            COALESCE(SUM(masculino) + SUM(femenino), 0) AS TOTAL

            FROM(
                SELECT NA.id idNacionalidad, NA.nacionalidad nacionalidad,VP.masculino masculino, VP.femenino femenino 
                FROM(
                SELECT * FROM V_CONTEONINOSNACION
                WHERE periodo = 2024 AND estado=1
                ) VP
            RIGHT JOIN A_NACIONALIDAD NA ON VP.idNacionalidad=NA.id) VISTA
            GROUP BY idNacionalidad,nacionalidad
            ORDER BY idNacionalidad";

    $stmt2 = $connection->prepare($sql2);
    $stmt2->execute();
    $datos2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

    // Inicializar totales
    $totalMasculino1 = 0;
    $totalFemenino1 = 0;
    $totalGeneral1 = 0;

    $totalMasculino2 = 0;
    $totalFemenino2 = 0;
    $totalGeneral2 = 0;

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
            <h3>Informe por Nacionalidad</h3>
            <?php if (!empty($datos2)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Nacionalidad</th>
                        <th>Masculino</th>
                        <th>Femenino</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datos2 as $row): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['nacionalidad']); ?></td>
                            <td><?php echo htmlspecialchars($row['MASCULINO']); ?></td>
                            <td><?php echo htmlspecialchars($row['FEMENINO']); ?></td>
                            <td><?php echo htmlspecialchars($row['TOTAL']); ?></td>
                        </tr>
                        <?php
                            // Acumular totales
                            $totalMasculino2 += $row['MASCULINO'];
                            $totalFemenino2 += $row['FEMENINO'];
                            $totalGeneral2 += $row['TOTAL'];
                        ?>
                    <?php endforeach; ?>
                    <!-- Fila de totales -->
                    <tr>
                        <td style="font-weight: bold;">Total</td>
                        <td style="font-weight: bold;"><?php echo $totalMasculino2; ?></td>
                        <td style="font-weight: bold;"><?php echo $totalFemenino2; ?></td>
                        <td style="font-weight: bold;"><?php echo $totalGeneral2; ?></td>
                    </tr>
                </tbody>
            </table>
            <?php else: ?>
                <p>No hay datos para mostrar.</p>
            <?php endif; ?>

            <br>
            <br>
            <br>
            <br>
            <h3>Informe Detallado por Edad y Nacionalidad</h3>
            <?php if (!empty($datos1)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Edad</th>
                        <th>Nacionalidad</th>
                        <th>Masculino</th>
                        <th>Femenino</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datos1 as $row): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['edadV']); ?></td>
                            <td><?php echo htmlspecialchars($row['nacionalidad']); ?></td>
                            <td><?php echo htmlspecialchars($row['MASCULINO']); ?></td>
                            <td><?php echo htmlspecialchars($row['FEMENINO']); ?></td>
                            <td><?php echo htmlspecialchars($row['TOTAL']); ?></td>
                        </tr>
                        <?php
                            // Acumular totales
                            $totalMasculino1 += $row['MASCULINO'];
                            $totalFemenino1 += $row['FEMENINO'];
                            $totalGeneral1 += $row['TOTAL'];
                        ?>
                    <?php endforeach; ?>
                    <!-- Fila de totales -->
                    <tr>
                        <td style="font-weight: bold;">Total</td>
                        <td></td>
                        <td style="font-weight: bold;"><?php echo $totalMasculino1; ?></td>
                        <td style="font-weight: bold;"><?php echo $totalFemenino1; ?></td>
                        <td style="font-weight: bold;"><?php echo $totalGeneral1; ?></td>
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
