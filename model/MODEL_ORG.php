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

    //todo Guardar Organizacion
    public function guardarOrganizacion(
        $nombre, $direccion, 
        $tipo,$numProvidencia){
        $sql="INSERT INTO A_ORGANIZACION 
            (
                nombre,
                direccion, 
                tipo, 
                numProvidencia
            ) 
        VALUES ( 
                :nombre, 
                :direccion, 
                :tipo, 
                :numProvidencia)";
        $parametros =array(
            "nombre"=>$nombre,
            "direccion"=>$direccion,
            "tipo"=>$tipo,
            "numProvidencia"=>$numProvidencia
        );
        $this->connect();
        $query = $this->ejecutarOrden($sql, $parametros);
        return $query;
        
    }



    //todo: Buscar el checkHabilitado de una Org
    public function buscarCheckHabilitadoOrg($idOrganizacion){
        $sql="SELECT checkHabilitado FROM A_ORGANIZACION 
            WHERE id=:idOrganizacion";
        // var_dump($sql);  
        $parametros =array("idOrganizacion"=>$idOrganizacion);
        $this->connect();
        $query = $this->iniciar($sql, $parametros);
        return $query;
    }

     //todo: Buscar el checkHabilitado de una Org
     public function buscarEstadoyCheckHabilitadoOrg($idOrganizacion){
        $sql="SELECT estado,checkHabilitado FROM A_ORGANIZACION 
            WHERE id=:idOrganizacion";
        // var_dump($sql);  
        $parametros =array("idOrganizacion"=>$idOrganizacion);
        $this->connect();
        $query = $this->iniciar($sql, $parametros);
        return $query;
    }
    public function consultarNoHabilitarDesactivada(){
        $sql="SELECT id
        FROM A_ORGANIZACION
        WHERE estado=0";
        $this->connect();
        $query = $this->iniciar($sql);
        return $query;
    }

    //todo: Buscar Organizacion
    public function buscarOrganizacion($nombre,$estado){
        $sql="SELECT id,nombre
            FROM A_ORGANIZACION
            WHERE nombre = :nombre AND estado=:estado";
        $parametros =array("nombre"=>$nombre,"estado"=>$estado);
        $this->connect();
        $query = $this->iniciar($sql, $parametros);

        return $query;
    }

    //todo: BUSCAR ORGANIZACION (ID,NOMBRE)
    public function buscarOrganizacionIdNombre($id,$nombre,$estado){
        $sql="SELECT id,nombre
            FROM A_ORGANIZACION
            WHERE id = :id AND nombre=:nombre AND estado=:estado"; 
        $parametros =array("id"=>$id,"nombre"=>$nombre,"estado"=>$estado);
        $this->connect();
        $query = $this->iniciar($sql, $parametros);

        return $query;
    }

    //todo: DESHABILITAR GENERAL WEB
    public function DeshabilitarGeneral(){
        $sql="UPDATE A_ORGANIZACION 
              SET checkHabilitado=0";
        $this->connect();
        $query = $this->ejecutarOrden($sql);
        return $query;
    }
    //todo: HABILITAR GENERAL ORGANIZACION WEB
    public function habilitarGeneral(){
        
        $sql="UPDATE A_ORGANIZACION SET checkHabilitado = 1";
        $this->connect();
        $query = $this->ejecutarOrden($sql);
        
        return $query;

    }
    public function habilitarGeneralOrgDesactivadas($idOrganizaciones){
        
        $sql="UPDATE A_ORGANIZACION 
              SET checkHabilitado=1";
        if($idOrganizaciones!='' || $idOrganizaciones!=null){
            $sql=$sql." WHERE id NOT IN (".$idOrganizaciones.")";
            $this->connect();
            $query = $this->ejecutarOrden($sql);
        }else{
            $sql=$sql;
            $this->connect();
            $query = $this->ejecutarOrden($sql);
        }
        return $query;

    }
    //todo: BUSCAR ID DE PERSONAS DE DETALLEPO ACTIVAS 
    public function consultarDeshabilitar(){
        $sql="SELECT idPersona FROM A_DETALLE_PO WHERE estado=1";
        $this->connect();
        $query = $this->iniciar($sql);
        return $query;
    }
    //todo: BUSCAR ID DE PERSONAS DE DETALLEPO ACTIVAS PERTENECIENTES A UNA ORG EN ESPECIFICO
    public function consultarDeshabilitarPorOrg($user_id){
        $sql="SELECT idPersona FROM A_DETALLE_PO 
            WHERE idOrganizacion=:user_id and estado=1";
        $parametros =array(":user_id"=>$user_id);
        $this->connect();
        $query = $this->iniciar($sql, $parametros);
        
        return $query;
    }


    //todo: DESHABILITAR Y HABILITAR WEB ORGANIZACION
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
    //todo--------------------------------------
    //todo--------------------------------------

    
    //todo:DESACTIVAR ACTIVAR ORGANIZACION (BORRAR)
    public function desactivarOrg($user_id){
        $sql="UPDATE A_ORGANIZACION SET checkHabilitado=0, estado=0 WHERE id=:user_id";
        $parametros =array(":user_id"=>$user_id);
        $this->connect();
        $query = $this->ejecutarOrden($sql, $parametros);
        return $query;
    }
    public function activarOrg($user_id){
        $sql="UPDATE A_ORGANIZACION SET checkHabilitado=1, estado=1 WHERE id=:user_id";
        $parametros =array(":user_id"=>$user_id);
        $this->connect();
        $query = $this->ejecutarOrden($sql, $parametros);
        return $query;
    }
    //todo--------------------------------------
    //todo--------------------------------------

    //todo GUARDAR DETALLE ORGANIZACION 
    public function guardarDO($idOrganizacion,$fechaVencimiento,$aniosVigente){
        $sql="INSERT INTO A_DETALLE_ORGANIZACION(
                idOrganizacion, 
                fechaVencimiento, 
                aniosVigente,
                estado) 
            VALUES(
            :idOrganizacion, 
            :fechaVencimiento, 
            :aniosVigente,
            1)";
        $parametros =array(
            "idOrganizacion"=>$idOrganizacion,
            "fechaVencimiento"=>$fechaVencimiento,
            "aniosVigente"=>$aniosVigente
        );
        $this->connect();
        $query = $this->ejecutarOrden($sql, $parametros);
        return $query;
    }

    //! ACTUALIZAR DETALLE ORGANIZACION 
    public function actualizarDO($idOrganizacion,$fechaIngreso,$fechaVencimiento,$anioVigencia){
        $sql="UPDATE A_DETALLE_ORGANIZACION 
        SET 
            fechaIngreso=:fechaIngreso,
            fechaVencimiento =:fechaVencimiento,
            aniosVigente=:anioVigencia
            WHERE idOrganizacion=:idOrganizacion";
        $parametros =array(
            "idOrganizacion"=>$idOrganizacion,
            "fechaIngreso"=>$fechaIngreso,
            "fechaVencimiento"=>$fechaVencimiento,
            "anioVigencia"=>$anioVigencia
        );
        $this->connect();
        $query = $this->ejecutarOrden($sql, $parametros);
        return $query;
    }

    //! ACTUALIZAR ORGANIZACION 
    public function actualizarOrganizacion($user_id,
        $nombre, $direccion, 
        $tipo,$numProvidencia){
        $sql="UPDATE A_ORGANIZACION 
                SET nombre =:nombre,
                direccion =:direccion,
                tipo =:tipo,
                numProvidencia =:numProvidencia 
              WHERE id=:user_id";
        $parametros =array(
            "nombre"=>$nombre,
            "direccion"=>$direccion,
            "tipo"=>$tipo,
            "numProvidencia"=>$numProvidencia,
            "user_id"=>$user_id
        );
        $this->connect();
        $query = $this->ejecutarOrden($sql, $parametros);
        return $query;
        
    }

    //todo ACTUALIZAR ORGANIZACION 
    public function actualizarVigencia($user_id){
        $sql="UPDATE A_ORGANIZACION 
                SET checkVigente=1,
                    estado=1,
                    checkHabilitado=1
                
              WHERE id=:user_id";
        $parametros =array(
            "user_id"=>$user_id
        );
        $this->connect();
        $query = $this->ejecutarOrden($sql, $parametros);
        return $query;
        
    }

    //! ACTUALIZAR ORGANIZACION
    
    public function consultaOrganizacionVencida(){
        $sql="SELECT DTO.idOrganizacion idOrganizacion
            FROM A_DETALLE_ORGANIZACION DTO WHERE fechaVencimiento<GETDATE()";
        $this->connect();
        $query = $this->iniciar($sql);
        return $query;
    }

    public function desactivarOrganizacionesVigencia($idOrganizacion){
        // organizacion estado=0, checkHabilitado=0, checkVigente=0
        $sql="UPDATE A_ORGANIZACION 
                SET checkVigente=0,
                    estado=0,
                    checkHabilitado=0
                
                WHERE id=:idOrganizacion";
        $parametros =array(
            "idOrganizacion"=>$idOrganizacion
        );
        $this->connect();
        $query = $this->ejecutarOrden($sql, $parametros);
        return $query;
        
    }
    public function desactivarDTOVigencia($idOrganizacion){
        // organizacion estado=0, checkHabilitado=0, checkVigente=0
        $sql="UPDATE A_DETALLE_ORGANIZACION 
                SET aniosVigente = 0
                WHERE idOrganizacion=:idOrganizacion";
        $parametros =array(
            "idOrganizacion"=>$idOrganizacion
        );
        $this->connect();
        $query = $this->ejecutarOrden($sql, $parametros);
        return $query;
        
    }

    public function consultaPersonasOrganizacionVencida($idOrganizacion){
        $sql="SELECT idPersona
            FROM A_DETALLE_PO
            WHERE idOrganizacion =:idOrganizacion";
        $parametros =array(
            "idOrganizacion"=>$idOrganizacion
        );
        $this->connect();
        $query = $this->iniciar($sql,$parametros);
        return $query;
    }

    public function desactivarPersonaVigencia($idPersona){
        // organizacion estado=0, checkHabilitado=0, checkVigente=0
        $sql="UPDATE A_PERSONA
                SET 
                    estado=0,
                    checkHabilitado=0
                WHERE id=:idPersona";
        $parametros =array(
            "idPersona"=>$idPersona
        );
        $this->connect();
        $query = $this->ejecutarOrden($sql, $parametros);
        return $query;
        
    }
    
}
?>