<?php
require_once ("../model/MODEL_REPORTE.php");

require_once '../dompdf/autoload.inc.php';
use Dompdf\Dompdf;

$periodo=$_GET['periodo'];

$rep = new Reportes();





// $reporteNE = $rep->reporteNacionalidadEtario($periodo,$nombreNacionalidad,$idNacionalidad)


/* $host = '10.20.10.13';
$dbname = 'BD_NAVIDAD';
$user = 'sa';
$password = '1'; */

/* try {
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
                edad, idNacionalidad, nacionalidad
            ORDER BY
                edad";

    $stmt1 = $connection->prepare($sql1);
    $stmt1->execute();
    $datos1 = $stmt1->fetchAll(PDO::FETCH_ASSOC); */

    // Consulta SQL para la nueva tabla
    /* $sql2 = "SELECT idNacionalidad,
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
    $datos2 = $stmt2->fetchAll(PDO::FETCH_ASSOC); */

    $datos2 = $rep->reporteNacionalidad($periodo);

    
    

    /* $nacionalidades = [
        1 => 'Chile',
        2 => 'Argentina',
        3 => 'Uruguay',
        4 => 'Paraguay',
        5 => 'Bolivia',
        6 => 'Peru',
        7 => 'Brasil',
        8 => 'Ecuador',
        9 => 'Colombia',
        10 => 'Venezuela'
    ]; */

    $nacionalidades = $rep->listarNacionalidad();

    $datosPorNacionalidad = [];
    foreach ($nacionalidades as $nacion){
        // $nacion['nacionalidad']
        $datosPorNacionalidad[$nacion['nacionalidad']] = $rep->reporteNacionalidadEtario($periodo,$nacion['nacionalidad'],$nacion['id']);
    }
    // foreach ($nacionalidades as $idNacionalidad => $nombreNacionalidad) {

        
        // $datosPorNacionalidad[$nombreNacionalidad] = $rep->reporteNacionalidadEtario($periodo,$nombreNacionalidad,$idNacionalidad);
        /* $sql = "SELECT
                    edad,
                    REPLACE(CAST(edad AS VARCHAR), '99', 'MAYORES DE 10 AÑOS') AS edadV,
                    COALESCE(nacionalidad, '$nombreNacionalidad') AS nacionalidad,
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
                        (SELECT * FROM V_CONTEONINOSNACION WHERE edad <= 10 AND periodo = 2024 AND estado=1 AND idNacionalidad=$idNacionalidad) VCN
                    RIGHT JOIN
                        A_EDAD E ON VCN.edad = E.edad
                    UNION ALL
                    SELECT
                        99 AS edad,
                        '$nombreNacionalidad' AS nacionalidad,
                        99 AS idNacionalidad,
                        SUM(VCN.masculino) AS masculino,
                        SUM(VCN.femenino) AS femenino
                    FROM
                        V_CONTEONINOSNACION VCN
                    WHERE
                        VCN.edad > 10 AND VCN.periodo = 2024 AND estado=1 AND idNacionalidad=$idNacionalidad
                ) vista
                GROUP BY
                    edad, idNacionalidad, nacionalidad
                ORDER BY
                    edad";

        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $datosPorNacionalidad[$nombreNacionalidad] = $stmt->fetchAll(PDO::FETCH_ASSOC); */
    // }

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

/* } catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
} */
?>
