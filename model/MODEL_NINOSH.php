<?php
//Solicito el archivo ConexionDB.php para conectarme a la base de dato
require_once '../config/ConexionDB.php';

//todo:-------------------------------------------------------------------------------------------
//La clase Personas Model hereda funciones de ConexionDB
class NinosH extends ConexionBD{
    
    public function guardarNinosH($dni,$nombre,$sexo,
    $edad,$naciemiento,$nacion,$etnia,$periodo,
    $ceguera,$sordera,$mudez,$fisica,$mental,$psiquica,
    $descripcion,$organizacion,$usuario_id,$check_nac ,$check_dis,
    $ceguera_p,$sordera_p ,$mudez_p,$fisica_p ,$mental_p,$psiquica_p,$tipoMovimiento,$usuarioCambio){
        $sql="INSERT INTO A_NINOS_HISTORIAL
              (
                dni,--1
                nombre,--2
                sexo,--3
                edad,--4
                fechaNacimiento,--5
                idNacionalidad,--6
                idEtnia,--7
                periodo,--8
                checkCeguera,--9
                checkSordera,--10
                checkMudez,--11
                checkFisica,--12
                checkMental,--13
                checkPsiquica,--14
                descripcion,--15
                idOrganizacion,--16
                idPersonalRegistro,--17
                checkExtranjero,--18
                checkDiscapacitado,--19
                porcentajeCeguera,--20
                porcentajeSordera,--21
                porcentajeMudez,--22
                porcentajeFisica,--23
                porcentajeMental,--24
                porcentajePsiquica,--25
                tipoMovimiento,
                usuarioCambio
              )
        VALUES
              (:dni,:nombre,:sexo
              ,:edad,:naciemiento,:nacion,:etnia,:periodo
              ,:ceguera,:sordera ,:mudez,:fisica,:mental,:psiquica
              ,:descripcion,:organizacion,:usuario_id,:check_nac ,:check_dis
              ,:ceguera_p,:sordera_p ,:mudez_p,:fisica_p ,:mental_p,:psiquica_p,:tipoMovimiento,
                :usuarioCambio)";
        $parametros =array(
            "dni"=>$dni,
            "nombre"=>$nombre,
            "sexo"=>$sexo,
            "edad"=>$edad,
            "naciemiento"=>$naciemiento,
            "nacion"=>$nacion,
            "etnia"=>$etnia,
            "periodo"=>$periodo,
            "ceguera"=>$ceguera,
            "sordera"=>$sordera, 
            "mudez"=>$mudez,
            "fisica"=>$fisica,
            "mental"=>$mental,
            "psiquica"=>$psiquica,
            "descripcion"=>$descripcion,
            "organizacion"=>$organizacion,
            "usuario_id"=>$usuario_id,
            "check_nac"=>$check_nac, 
            "check_dis"=>$check_dis,
            "ceguera_p"=>$ceguera_p,
            "sordera_p"=>$sordera_p,
            "mudez_p"=>$mudez_p,
            "fisica_p"=>$fisica_p,
            "mental_p"=>$mental_p,
            "psiquica_p"=>$psiquica_p,
            "tipoMovimiento"=>$tipoMovimiento,
            "usuarioCambio"=>$usuarioCambio
        );
        // $parametros =array("periodo"=>$periodo,"periodo2"=>$periodo);
        $this->connect();
        $query = $this->ejecutarOrden($sql, $parametros);
        return $query;
        
    }
}
?>