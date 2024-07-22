<?php
// controllerReport.php
require_once("../model/MenuModel.php");
session_start();

$menu = new MenuModel();

$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$sexo = (isset($_POST['sexo'])) ? $_POST['sexo'] : '';
$edad = (isset($_POST['edad'])) ? $_POST['edad'] : '';
$nacionalidad = (isset($_POST['nacionalidad'])) ? $_POST['nacionalidad'] : '';
$organizacion = (isset($_POST['organizacion'])) ? $_POST['organizacion'] : '';
$etnia = (isset($_POST['etnia'])) ? $_POST['etnia'] : '';


switch ($_GET["op"]) {
    case "reporte":
        //define la consulta
        $CONSULTA = "SELECT  
          A_NINOS.id,
          A_NINOS.dni,
          A_NINOS.nombre as nombre,
          A_NINOS.sexo,
		  CASE
        WHEN [sexo] = 0 THEN 'MUJER'
        WHEN [sexo]= 1 THEN 'HOMBRE'
		END AS sexo_vista,
          A_NINOS.edad as edad,
          A_NINOS.fechaNacimiento,
          A_NINOS.periodo,
          A_NINOS.descripcion,
          A_NINOS.fechaRegistro,
          A_NINOS.idNacionalidad,
          A_NINOS.checkExtranjero,
		  A_NINOS.checkCeguera,
		  A_NINOS.checkSordera,
		  A_NINOS.checkMudez,
		  A_NINOS.checkFisica,
		  A_NINOS.checkMental,
		  A_NINOS.checkPsiquica,
		  A_NINOS.idOrganizacion,
		  A_NINOS.idPersonalRegistro,
		  A_NINOS.checkDiscapacitado,
		  A_NINOS.porcentajeCeguera,
		  A_NINOS.porcentajeSordera,
		  A_NINOS.porcentajeMudez,
		  A_NINOS.porcentajeFisica,
		  A_NINOS.porcentajeMental,
		  A_NINOS.porcentajePsiquica,
          A_ETNIA.etnia as etnia,
          A_NACIONALIDAD.nacionalidad as nacionalidad,
          A_ORGANIZACION.nombre AS NOMBRE_ORG,
           
          A_ORGANIZACION.tipo as tipo,
          CASE
			WHEN A_ORGANIZACION.tipo = 1 THEN 'JUNTA VECINAL'
			WHEN A_ORGANIZACION.tipo = 2 THEN 'COMÍTE VIVIENDA'
			WHEN A_ORGANIZACION.tipo = 3 THEN 'CONDOMINIO'
			WHEN A_ORGANIZACION.tipo = 4 THEN 'PROVIDENCIA'
		END AS tipo_org,
		A_NINOS.idEtnia
        FROM [dbo].[A_NINOS]
           JOIN A_ETNIA ON A_NINOS.idEtnia = A_ETNIA.id
           JOIN A_NACIONALIDAD ON A_NINOS.idNacionalidad = A_NACIONALIDAD.id
           JOIN A_ORGANIZACION ON A_NINOS.idOrganizacion = A_ORGANIZACION.id";
        //llamo al metodo listar y le doy la variable CONSULTA
        $datos=$menu->listar($CONSULTA);
        //imprimir los datos en JSON
        print($datos);
        break;

        case "pdf":
            // Esta parte se manejará en el script que genera el PDF
            $CONSULTA="SELECT edad,
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
            $datos=$menu->listar($CONSULTA);
            print($datos); 
            break;

            case "pdf2023":
                // Esta parte se manejará en el script que genera el PDF
                $CONSULTA="SELECT edad,
                       REPLACE(edad, 99, 'MAYORES DE 10 AÑOS') edadV,
                       ISNULL(sum(masculino), 0) MASCULINO,
                       ISNULL(sum(femenino), 0) FEMENINO,
                       ISNULL(sum(masculino)+sum(femenino), 0) TOTAL
                FROM (
                    SELECT E.edad edad,
                           VCN.masculino masculino,
                           VCN.FEMENINO femenino
                    FROM (SELECT * FROM V_CONTEONINOS WHERE edad <= 10 and periodo=2023 AND estado=1) VCN
                    RIGHT JOIN A_EDAD E ON VCN.edad = E.edad
                    UNION
                    SELECT edad = 99,
                           sum(masculino) MASCULINO,
                           sum(femenino) FEMENINO
                    FROM V_CONTEONINOS VCN
                    WHERE VCN.edad > 10 AND VCN.periodo=2023 AND estado=1
                ) vista
                GROUP BY edad
                ORDER BY edad";
                $datos=$menu->listar($CONSULTA);
                print($datos); 
                break;

        case "nacion":
            $CONSULTA="SELECT idNacionalidad,
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
            $datos=$menu->listar($CONSULTA);
            print($datos);
            break;   
            
            case "nacion2023":
                $CONSULTA="SELECT idNacionalidad,
                            COALESCE(nacionalidad, 'SIN DATOS') AS nacionalidad,
                                    COALESCE(SUM(masculino), 0) AS MASCULINO,
                                    COALESCE(SUM(femenino), 0) AS FEMENINO,
                                    COALESCE(SUM(masculino) + SUM(femenino), 0) AS TOTAL
    
                    FROM(
                        SELECT NA.id idNacionalidad, NA.nacionalidad nacionalidad,VP.masculino masculino, VP.femenino femenino 
                        FROM(
                        SELECT * FROM V_CONTEONINOSNACION
                        WHERE periodo = 2023 AND estado=1
                        ) VP
                    RIGHT JOIN A_NACIONALIDAD NA ON VP.idNacionalidad=NA.id) VISTA
                    GROUP BY idNacionalidad,nacionalidad
                    ORDER BY idNacionalidad";
                $datos=$menu->listar($CONSULTA);
                print($datos);
                break;

    
}



?>
