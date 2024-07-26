<?php

require_once '../config/ConexionDB.php';

//todo:-------------------------------------------------------------------------------------------
//La clase Personas Model hereda funciones de ConexionDB
class Reportes extends ConexionBD{
    /* public function listar($CONSULTA){
        //$sql = "SELECT * FROM A_ETNIA";
        //Realizo la conexion paara comunicarme con la bdd
        $this->connect();
        //configuro la consulta 
        $query = $this->ejecutaConsulta($CONSULTA);
        //retorno la consulta hacia controller.php
        return $query;
    } */
    public function pdfGeneralJSON($periodo){

        $sql="SELECT edad,
                   REPLACE(edad, 99, 'MAYORES DE 10 AÑOS') edadV,
                   ISNULL(sum(masculino), 0) MASCULINO,
                   ISNULL(sum(femenino), 0) FEMENINO,
                   ISNULL(sum(masculino)+sum(femenino), 0) TOTAL
            FROM (
                SELECT E.edad edad,
                       VCN.masculino masculino,
                       VCN.FEMENINO femenino
                FROM (SELECT * FROM V_CONTEONINOS WHERE edad <= 10 and periodo=:periodo AND estado=1) VCN
                RIGHT JOIN A_EDAD E ON VCN.edad = E.edad
                UNION
                SELECT edad = 99,
                       sum(masculino) MASCULINO,
                       sum(femenino) FEMENINO
                FROM V_CONTEONINOS VCN
                WHERE VCN.edad > 10 AND VCN.periodo=:periodo2  AND estado=1
            ) vista
            GROUP BY edad
            ORDER BY edad";
        $parametros =array(":periodo"=>$periodo,":periodo2"=>$periodo);
        $this->connect();
        $query = $this->ejecutaConsulta($sql, $parametros);
        
        return $query;

    }

    public function pdfGeneral($periodo){

        $sql="SELECT edad,
                   REPLACE(edad, 99, 'MAYORES DE 10 AÑOS') edadV,
                   ISNULL(sum(masculino), 0) MASCULINO,
                   ISNULL(sum(femenino), 0) FEMENINO,
                   ISNULL(sum(masculino)+sum(femenino), 0) TOTAL
            FROM (
                SELECT E.edad edad,
                       VCN.masculino masculino,
                       VCN.FEMENINO femenino
                FROM (SELECT * FROM V_CONTEONINOS WHERE edad <= 10 and periodo=:periodo AND estado=1) VCN
                RIGHT JOIN A_EDAD E ON VCN.edad = E.edad
                UNION
                SELECT edad = 99,
                       sum(masculino) MASCULINO,
                       sum(femenino) FEMENINO
                FROM V_CONTEONINOS VCN
                WHERE VCN.edad > 10 AND VCN.periodo=:periodo2  AND estado=1
            ) vista
            GROUP BY edad
            ORDER BY edad";
        $parametros =array(":periodo"=>$periodo,":periodo2"=>$periodo);
        $this->connect();
        $query = $this->iniciar($sql, $parametros);
        
        return $query;

    }

    public function listarNacionalidad(){
        $sql="SELECT id,nacionalidad
            FROM A_NACIONALIDAD";
        $this->connect();
        $query = $this->iniciar($sql);
        
        return $query;
    }

    public function reporteNacionalidadJSON($periodo){

        $sql="SELECT idNacionalidad,
                    COALESCE(nacionalidad, 'SIN DATOS') AS nacionalidad,
                            COALESCE(SUM(masculino), 0) AS MASCULINO,
                            COALESCE(SUM(femenino), 0) AS FEMENINO,
                            COALESCE(SUM(masculino) + SUM(femenino), 0) AS TOTAL

            FROM(
                SELECT NA.id idNacionalidad, NA.nacionalidad nacionalidad,VP.masculino masculino, VP.femenino femenino 
                FROM(
                SELECT * FROM V_CONTEONINOSNACION
                WHERE periodo = :periodo AND estado=1
                ) VP
            RIGHT JOIN A_NACIONALIDAD NA ON VP.idNacionalidad=NA.id) VISTA
            GROUP BY idNacionalidad,nacionalidad
            ORDER BY idNacionalidad";
        $parametros =array(":periodo"=>$periodo);
        $this->connect();
        $query = $this->ejecutaConsulta($sql, $parametros);
        
        return $query;
    }

    public function reporteNacionalidad($periodo){

        $sql="SELECT idNacionalidad,
                    COALESCE(nacionalidad, 'SIN DATOS') AS nacionalidad,
                            COALESCE(SUM(masculino), 0) AS MASCULINO,
                            COALESCE(SUM(femenino), 0) AS FEMENINO,
                            COALESCE(SUM(masculino) + SUM(femenino), 0) AS TOTAL

            FROM(
                SELECT NA.id idNacionalidad, NA.nacionalidad nacionalidad,VP.masculino masculino, VP.femenino femenino 
                FROM(
                SELECT * FROM V_CONTEONINOSNACION
                WHERE periodo = :periodo AND estado=1
                ) VP
            RIGHT JOIN A_NACIONALIDAD NA ON VP.idNacionalidad=NA.id) VISTA
            GROUP BY idNacionalidad,nacionalidad
            ORDER BY idNacionalidad";
        $parametros =array(":periodo"=>$periodo);
        $this->connect();
        $query = $this->iniciar($sql, $parametros);
        
        return $query;
    }

    public function reporteNacionalidadEtario($periodo,$nombreNacionalidad,$idNacionalidad){
        $sql="SELECT
                    edad,
                    REPLACE(CAST(edad AS VARCHAR), '99', 'MAYORES DE 10 AÑOS') AS edadV,
                    COALESCE(nacionalidad, :nombreNacionalidad) AS nacionalidad,
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
                        (SELECT * FROM V_CONTEONINOSNACION WHERE edad <= 10 AND periodo = :periodo AND estado=1 AND idNacionalidad=:idNacionalidad) VCN
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
                        VCN.edad > 10 AND VCN.periodo = :periodo2 AND estado=1 AND idNacionalidad=:idNacionalidad2
                ) vista
                GROUP BY
                    edad, idNacionalidad, nacionalidad
                ORDER BY
                    edad";
            $parametros =array(":periodo"=>$periodo,
                                ":periodo2"=>$periodo,
                                ":idNacionalidad"=>$idNacionalidad,
                                ":idNacionalidad2"=>$idNacionalidad,
                                ":nombreNacionalidad"=>$nombreNacionalidad);
            $this->connect();
            $query = $this->iniciar($sql, $parametros);
            
            return $query;
    }
//!cambiar
    public function reporteOrganizacion($idOrganizacion,$periodo){

        $sql="SELECT            
            NN.dni,
            NN.nombre,
            NN.sexo, 
            CASE
                WHEN [sexo] = 0 THEN 'MUJER'
                WHEN [sexo] = 1 THEN 'HOMBRE'
            END AS sexo_vista,
            NN.edad,
            NN.fechaNacimiento,
            NN.idNacionalidad,
            NA.nacionalidad,
            NN.idEtnia,
            ET.etnia,
            NN.estado,
            NN.periodo,
            NN.idOrganizacion
            FROM A_NINOS NN
            JOIN A_NACIONALIDAD NA ON NA.id=NN.idNacionalidad
            JOIN A_ETNIA ET ON ET.id= NN.idEtnia
            WHERE idOrganizacion = :idOrganizacion AND periodo = :periodo and NN.estado=1
            ORDER BY edad";
        $parametros =array(":idOrganizacion"=>$idOrganizacion,":periodo"=>$periodo);
        $this->connect();
        $query = $this->iniciar($sql, $parametros);
        
        return $query;
    }

}
?>