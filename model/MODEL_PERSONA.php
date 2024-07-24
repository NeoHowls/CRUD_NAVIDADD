<?php
//Solicito el archivo ConexionDB.php para conectarme a la base de dato
require_once '../config/ConexionDB.php';

//todo:-------------------------------------------------------------------------------------------
//La clase Personas Model hereda funciones de ConexionDB
class Personas extends ConexionBD{



    public function guardarPersona(
        $dni, $nombre, $direccion, 
        $telefono, $mail, $idPerfil, 
        $usuario, $contrasena, $checkOrganizacion){
        $sql="INSERT INTO A_PERSONA
              (
                dni, 
                nombre, 
                direccion, 
                telefono, 
                mail, 
                idPerfil, 
                usuario, 
                contrasena,
                checkOrganizacion
              )
        VALUES (:dni, 
                :nombre, 
                :direccion, 
                :telefono, 
                :mail, 
                :idPerfil, 
                :usuario, 
                :contrasena,
                :checkOrganizacion)";
        $parametros =array(
            "dni"=>$dni,
            "nombre"=>$nombre,
            "direccion"=>$direccion,
            "telefono"=>$telefono,
            "mail"=>$mail,
            "idPerfil"=>$idPerfil,
            "usuario"=>$usuario,
            "contrasena"=>$contrasena,
            "checkOrganizacion"=>$checkOrganizacion
        );
        // $parametros =array("periodo"=>$periodo,"periodo2"=>$periodo);
        $this->connect();
        $query = $this->ejecutarOrden($sql, $parametros);
        return $query;
        
    }

    public function buscarPersona($dni,$estado){
        $sql="SELECT id,dni
            FROM A_PERSONA
            WHERE dni = :dni AND estado=:estado";
        $parametros =array("dni"=>$dni,"estado"=>$estado);
        $this->connect();
        $query = $this->iniciar($sql, $parametros);

        return $query;
    }

    //!DESHABILITAR GENERAL PERSONA WEB
    public function DeshabilitarGeneral(){
        $sql="UPDATE A_PERSONA 
              SET checkHabilitado=0
              WHERE idPerfil !=7 and idPerfil !=8";
        $this->connect();
        $query = $this->ejecutarOrden($sql);
        return $query;
    }

    public function consultarNoHabilitar(){
        $sql="SELECT idPersona 
            FROM A_ORGANIZACION O
            JOIN A_DETALLE_PO DPO ON O.id=DPO.idOrganizacion
            JOIN A_PERSONA P ON DPO.idPersona=P.id
            WHERE DPO.estado=1 AND O.checkHabilitado=0";
        $this->connect();
        $query = $this->iniciar($sql);
        return $query;
    }

    //!DESHABILITAR Y HABILITAR WEB
    public function deshabilitarWebPersona($user_id){
        $sql="UPDATE A_PERSONA SET checkHabilitado=0 WHERE id=:user_id and idPerfil !=7";
        $parametros =array(":user_id"=>$user_id);
        $this->connect();
        $query = $this->ejecutarOrden($sql, $parametros);
        return $query;
    }
    public function habilitarWebPersona($user_id){
        $sql="UPDATE A_PERSONA SET checkHabilitado=1 WHERE id=:user_id and idPerfil !=7";
        $parametros =array(":user_id"=>$user_id);
        $this->connect();
        $query = $this->ejecutarOrden($sql, $parametros);
        return $query;
    }
    

    //!--------------------------------------
    //!--------------------------------------
    //!DESACTIVAR ACTIVAR PERSONA (BORRAR)

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
    //!HABILITAR GENERAL PERSONA WEB
    public function habilitarGeneral($idPersonas){
        
        $sql="UPDATE A_PERSONA 
              SET checkHabilitado=1
              WHERE idPerfil !=7 and idPerfil !=8";
        if($idPersonas!='' || $idPersonas!=null){
            $sql=$sql." AND id NOT IN (".$idPersonas.")";
            $this->connect();
            $query = $this->ejecutarOrden($sql);
        }else{
            $sql=$sql;
            $this->connect();
            $query = $this->ejecutarOrden($sql);
        }
        return $query;

    }

    //!DESHABILITAR PERSONAS POR ORGANIZACION (por que la organizacion se desabilito)
    public function deshabilitarPorOrganizacion($idPersonas){
    
        $sql="UPDATE A_PERSONA 
                SET checkHabilitado=0 
                WHERE id IN (".$idPersonas.")";
        $this->connect();
        $query = $this->ejecutarOrden($sql);
        
        return $query;
    }

    public function actualizarPersona($dni,$nombre,$direccion,
                                    $telefono,$mail,$idPerfil,
                                    $usuario,$contrasena,
                                    $user_id){
        
        $sql="UPDATE A_PERSONA 
                    SET dni = :dni,
                    nombre =:nombre,
                    direccion =:direccion,
                    telefono =:telefono,
                    mail =:mail,
                    idPerfil =:idPerfil,
                    usuario =:usuario,
                    contrasena =:contrasena 
                WHERE id=:user_id";
        
        $parametros =array(
            ":dni"=>$dni,
            ":nombre"=>$nombre,
            ":direccion"=>$direccion,
            ":telefono"=>$telefono,
            ":mail"=>$mail,
            ":idPerfil"=>$idPerfil,
            ":usuario"=>$usuario,
            ":contrasena"=>$contrasena,
            ":user_id"=>$user_id
        );
        $this->connect();
        $query = $this->ejecutarOrden($sql, $parametros);
        return $query;

    }

    public function buscarPersonaIdDni($id,$dni,$estado){
        $sql="SELECT P.id id, P.dni dni
            FROM A_PERSONA P
            WHERE P.id = :id AND P.dni=:dni AND P.estado=:estado";
            //WHERE P.id = :id AND P.dni=:dni AND P.estado=:estado
            //WHERE P.id = ".$id." AND P.dni='".$dni."' AND P.estado=".$estado"
        // var_dump($sql);  
        $parametros =array("id"=>$id,"dni"=>$dni,"estado"=>$estado);
        $this->connect();
        $query = $this->iniciar($sql, $parametros);

        return $query;
    }

    //!GUARDAR PDO
    public function guardarDPO(
        $idPersona, $idOrganizacion, $estado){
        $sql="INSERT INTO A_DETALLE_PO
              (
                idPersona, idOrganizacion, estado
              )
        VALUES (:idPersona, :idOrganizacion, :estado)";
        $parametros =array(
            "idPersona"=>$idPersona,
            "idOrganizacion"=>$idOrganizacion,
            "estado"=>$estado
        );
        $this->connect();
        $query = $this->ejecutarOrden($sql, $parametros);
        return $query;
        
    }
    //!ACTUALIZAR PDO
    public function actualizarPDO($user_id){
        $sql="UPDATE A_DETALLE_PO SET estado=0,fechaTermino=GETDATE() WHERE idPersona=:user_id";
        $parametros =array(":user_id"=>$user_id);
        $this->connect();
        $query = $this->ejecutarOrden($sql, $parametros);
        return $query;
    }

    //!listar Persona
    public function listarPersonas(){
        $sql = "SELECT 
                P.id AS id, 
                P.dni AS dni, 
                P.nombre AS nombreP, 
                P.direccion AS direccion, 
                P.telefono AS telefono, 
                P.mail AS mail, 
                P.idPerfil AS idPerfil, 
                P.estado AS estadoP,
                CASE
                    WHEN P.estado = 0 THEN 'DESACTIVADO'
                    WHEN P.estado = 1 THEN 'ACTIVADO'
                END AS estadoPersona,
                P.usuario AS usuario, 
                P.contrasena AS contrasena, 
                P.checkHabilitado AS checkHabilitado,
                CASE
                    WHEN P.checkHabilitado = 0 THEN 'DESHABILITADO'
                    WHEN P.checkHabilitado = 1 THEN 'HABILITADO'
                END AS habilitado,
                P.checkOrganizacion,
                PO.idOrganizacion AS idOrganizacion,
                O.tipo AS tipo,
                CASE
                        WHEN O.tipo= NULL THEN 'asd'
                        WHEN O.tipo= 1 THEN 'JUNTA VECINAL'
                        WHEN O.tipo= 2 THEN 'COMÍTE VIVIENDA'
                        WHEN O.tipo= 3 THEN 'CONDOMINIO'
                        WHEN O.tipo= 4 THEN 'PROVIDENCIA'	
                END AS organizacion,
                --ISNULL(O.tipo, 'no posee') AS Org,
                O.nombre AS NOMBRE_O,
                ISNULL(O.nombre, 'no posee') AS NOMBRE_O,
                PO.fechaIngreso AS fechaIngreso,
                PO.fechaTermino AS fechaTermino,
                PO.estado AS estado
            FROM A_PERSONA P
            JOIN A_DETALLE_PO PO ON P.id = PO.idPersona
            JOIN A_ORGANIZACION O ON PO.idOrganizacion = O.id
            WHERE PO.estado = 1

            UNION

            SELECT 
                P.id AS id, 
                P.dni AS dni, 
                P.nombre AS nombreP, 
                P.direccion AS direccion, 
                P.telefono AS telefono, 
                P.mail AS mail, 
                P.idPerfil AS idPerfil, 
                P.estado AS estadoP,
                CASE
                    WHEN P.estado = 0 THEN 'DESACTIVADO'
                    WHEN P.estado = 1 THEN 'ACTIVADO'
                END AS estadoPersona,
                P.usuario AS usuario, 
                P.contrasena AS contrasena, 
                P.checkHabilitado AS checkHabilitado,
                CASE
                    WHEN P.checkHabilitado = 0 THEN 'DESHABILITADO'
                    WHEN P.checkHabilitado = 1 THEN 'HABILITADO'
                END AS habilitado,
                P.checkOrganizacion,
                0 AS idOrganizacion,
                null as tipo,
                'DIDECO' AS tipo,
                --null AS org,
                NULL AS nombre,
                'ADMINISTRACION' AS NOMBRE_O,
                NULL AS fechaIngreso,
                NULL AS fechaTermino,
                0 AS estado
            FROM A_PERSONA P
            WHERE P.checkOrganizacion = 0
            ORDER BY idOrganizacion";
        $this->connect();
        $query = $this->ejecutaConsulta($sql);
            
        return $query;
    }
}//cierre clase
?>