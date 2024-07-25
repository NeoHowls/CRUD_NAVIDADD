<?php
//Solicito el archivo ConexionDB.php para conectarme a la base de dato
require_once '../config/ConexionDB.php';

//todo:-------------------------------------------------------------------------------------------
//La clase Personas Model hereda funciones de ConexionDB
class Organizaciones extends ConexionBD{
        
    //!listar Organizacion
    public function listarOrganizaciones(){
        $sql = "SELECT O.id AS id,
                O.nombre AS nombre,
                O.direccion AS direccion,
                O.tipo AS tipo,
                CASE
                        WHEN O.tipo= 1 THEN 'JUNTA VECINAL'
                        WHEN O.tipo= 2 THEN 'COMÍTE VIVIENDA'
                        WHEN O.tipo= 3 THEN 'CONDOMINIO'
                        WHEN O.tipo= 4 THEN 'PROVIDENCIA'
                END AS organizacion,
                O.fechaIngreso AS fechaIngreso,
                O.checkVigente AS checkVigente,
                O.numProvidencia AS numProvidencia,
                O.checkHabilitado AS checkHabilitado,
                CASE
                    WHEN O.checkHabilitado = 0 THEN 'DESHABILITADA'
                    WHEN O.checkHabilitado = 1 THEN 'HABILITADA'
                END AS habilitado,
                O.estado AS estado,
            DO.aniosVigente AS aniosVigente,
            vigente = 'VIGENTE'
            FROM A_ORGANIZACION O
            JOIN A_DETALLE_ORGANIZACION DO ON O.id=idOrganizacion
            WHERE DO.estado=1 AND O.checkVigente=1
            UNION
            SELECT O.id AS id,
                O.nombre AS nombre,
                O.direccion AS direccion,
                O.tipo AS tipo,
                CASE
                        WHEN O.tipo= 1 THEN 'JUNTA VECINAL'
                        WHEN O.tipo= 2 THEN 'COMÍTE VIVIENDA'
                        WHEN O.tipo= 3 THEN 'CONDOMINIO'
                        WHEN O.tipo= 4 THEN 'PROVIDENCIA'	
                END AS organizacion,
                O.fechaIngreso AS fechaIngreso,
                O.checkVigente AS checkVigente,
                O.numProvidencia AS numProvidencia,
                O.checkHabilitado AS checkHabilitado,
                CASE
                    WHEN O.checkHabilitado = 0 THEN 'DESHABILITADA'
                    WHEN O.checkHabilitado = 1 THEN 'HABILITADA'
                END AS habilitado,
                O.estado AS estado,
            aniosVigente=0,
            vigente = 'NO VIGENTE'
            FROM A_ORGANIZACION O WHERE O.checkVigente=0
            ORDER BY tipo";
        $this->connect();
        $query = $this->ejecutaConsulta($sql);
            
        return $query;
    }

    //!Guardar Organizacion
    public function guardarOrganizacion(
        $nombre, $direccion, 
        $tipo, $fechaIngreso, $checkVigente, 
        $numProvidencia, $checkHabilitado, $estado){
        $sql="INSERT INTO A_ORGANIZACION 
            (
                nombre,
                direccion, 
                tipo, 
                --fechaIngreso, --automatico getdate
                checkVigente, 
                numProvidencia,
                checkHabilitado, 
                --estado --activado 1
            ) 
        VALUES ( 
                :nombre, 
                :direccion, 
                :tipo, 
                :fechaIngreso, 
                :checkVigente, 
                :numProvidencia, 
                :checkHabilitado,
                :estado)";
        $parametros =array(
            "nombre"=>$nombre,
            "direccion"=>$direccion,
            "tipo"=>$tipo,
            "fechaIngreso"=>$fechaIngreso,
            "checkVigente"=>$checkVigente,
            "numProvidencia"=>$numProvidencia,
            "checkHabilitado"=>$checkHabilitado,
            "estado"=>$estado
        );
        $this->connect();
        $query = $this->ejecutarOrden($sql, $parametros);
        return $query;
        
    }

    //!Buscar el checkHabilitado de una Org
    public function buscarCheckHabilitadoOrg($idOrganizacion){
        $sql="SELECT checkHabilitado FROM A_ORGANIZACION 
            WHERE id=:idOrganizacion";
        // var_dump($sql);  
        $parametros =array("idOrganizacion"=>$idOrganizacion);
        $this->connect();
        $query = $this->iniciar($sql, $parametros);
        return $query;
    }

    //!Buscar Organizacion
    public function buscarOrganizacion($nombre,$estado){
        $sql="SELECT id,nombre
            FROM A_ORGANIZACION
            WHERE nombre = :nombre AND estado=:estado";
        $parametros =array("nombre"=>$nombre,"estado"=>$estado);
        $this->connect();
        $query = $this->iniciar($sql, $parametros);

        return $query;
    }

    //!DESHABILITAR GENERAL WEB
    public function DeshabilitarGeneral(){
        $sql="UPDATE A_ORGANIZACION 
              SET checkHabilitado=0";
        $this->connect();
        $query = $this->ejecutarOrden($sql);
        return $query;
    }
    //!BUSCAR ID DE PERSONAS DE DETALLEPO ACTIVAS 
    public function consultarDeshabilitar(){
        $sql="SELECT idPersona FROM A_DETALLE_PO WHERE estado=1";
        $this->connect();
        $query = $this->iniciar($sql);
        return $query;
    }

    public function consultarDeshabilitarPorOrg($user_id){
        $sql="SELECT idPersona FROM A_DETALLE_PO 
            WHERE idOrganizacion=:user_id and estado=1";
        $parametros =array(":user_id"=>$user_id);
        $this->connect();
        $query = $this->iniciar($sql, $parametros);
        
        return $query;
    }


    //!DESHABILITAR Y HABILITAR WEB ORGANIZACION
    public function deshabilitarWebOrg($user_id){
        $sql="UPDATE A_ORGANIZACION SET checkHabilitado = 0 WHERE id=:user_id";
        $parametros =array(":user_id"=>$user_id);
        $this->connect();
        $query = $this->ejecutarOrden($sql, $parametros);
        return $query;
    }
    public function habilitarWebOrg($user_id){
        $sql="UPDATE A_ORGANIZACION SET checkHabilitado = 1 WHERE id=:user_id";
        $parametros =array(":user_id"=>$user_id);
        $this->connect();
        $query = $this->ejecutarOrden($sql, $parametros);
        return $query;
    }
    

    //!--------------------------------------
    //!--------------------------------------
    //!DESACTIVAR ACTIVAR ORGANIZACION (BORRAR)

    public function desactivarPersona($user_id){
        $sql="UPDATE A_PERSONA SET checkHabilitado=0, estado=0 WHERE id=:user_id and idPerfil !=7";
        $parametros =array(":user_id"=>$user_id);
        $this->connect();
        $query = $this->ejecutarOrden($sql, $parametros);
        return $query;
    }
    public function activarPersona($user_id){
        $sql="UPDATE A_PERSONA SET checkHabilitado=1, estado=1 WHERE id=:user_id and idPerfil !=7";
        $parametros =array(":user_id"=>$user_id);
        $this->connect();
        $query = $this->ejecutarOrden($sql, $parametros);
        return $query;
    }


    //!--------------------------------------
    //!--------------------------------------
    //todo: HABILITAR GENERAL ORGANIZACION WEB
    public function habilitarGeneral(){
        
        $sql="UPDATE A_ORGANIZACION SET checkHabilitado = 1";
        $this->connect();
        $query = $this->ejecutarOrden($sql);
        
        return $query;

    }



}
?>