<?php
//Solicito el archivo ConexionDB.php para conectarme a la base de dato
require_once '../config/ConexionDB.php';

//todo:-------------------------------------------------------------------------------------------
//La clase Personas Model hereda funciones de ConexionDB
class OrganizacionesH extends ConexionBD{

    //!Guardar Organizacion
    public function guardarOrganizacionH(
        $nombre, $direccion, 
        $tipo, $fechaIngreso, $checkVigente, 
        $numProvidencia,$tipoMovimiento,$usuarioCambio,$checkHabilitado,$estado){
        $sql="INSERT INTO A_ORGANIZACION_HISTORIAL 
            (
                nombre,
                direccion, 
                tipo, 
                fechaIngreso, 
                checkVigente, 
                numProvidencia,
                tipoMovimiento,
                usuarioCambio,
                checkHabilitado,
                estado
            ) 
        VALUES ( 
                :nombre, 
                :direccion, 
                :tipo, 
                :fechaIngreso, 
                :checkVigente, 
                :numProvidencia,
                :tipoMovimiento,
                :usuarioCambio,
                :checkHabilitado, 
                :estado)";
        $parametros =array(
            "nombre"=>$nombre,
            "direccion"=>$direccion,
            "tipo"=>$tipo,
            "fechaIngreso"=>$fechaIngreso,
            "checkVigente"=>$checkVigente,
            "numProvidencia"=>$numProvidencia,
            "tipoMovimiento"=>$tipoMovimiento,
            "usuarioCambio"=>$usuarioCambio,
            "checkHabilitado"=>$checkHabilitado,
            "estado"=>$estado
        );
        $this->connect();
        $query = $this->ejecutarOrden($sql, $parametros);
        return $query;
        
    }
    
    public function guardarOrganizacionHG(
        $tipoMovimiento,$usuarioCambio,$checkHabilitado){
        $sql="INSERT INTO A_ORGANIZACION_HISTORIAL
            (
                nombre,
                direccion, 
                tipo, 
                fechaIngreso, 
                checkVigente, 
                numProvidencia,
                tipoMovimiento,
                usuarioCambio,
                checkHabilitado
            ) 
        VALUES ( 
                :nombre, 
                :direccion, 
                :tipo, 
                :fechaIngreso, 
                :checkVigente, 
                :numProvidencia,
                :tipoMovimiento,
                :usuarioCambio,
                :checkHabilitado)";
        $parametros =array(
            "nombre"=>'*',
            "direccion"=>'*',
            "tipo"=>0,
            "fechaIngreso"=>NULL,
            "checkVigente"=>NULL,
            "numProvidencia"=>NULL,
            "tipoMovimiento"=>$tipoMovimiento,
            "usuarioCambio"=>$usuarioCambio,
            "checkHabilitado"=>$checkHabilitado
        );
        $this->connect();
        $query = $this->ejecutarOrden($sql, $parametros);
        return $query;
        
    }



}
?>