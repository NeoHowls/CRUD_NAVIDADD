<?php
//Solicito el archivo ConexionDB.php para conectarme a la base de dato
require_once '../config/ConexionDB.php';

//todo:-------------------------------------------------------------------------------------------
//La clase Personas Model hereda funciones de ConexionDB
class PersonasH extends ConexionBD{

    public function guardarPersonaH(
        $dni, $nombre, $direccion, 
        $telefono, $mail, $idPerfil,$checkOrganizacion,
        $usuario, $contrasena,$checkHabilitado,$estado,$tipoMovimiento,$usuarioCambio){
        $sql="INSERT INTO A_PERSONA_HISTORIAL
              (
                dni, 
                nombre, 
                direccion, 
                telefono, 
                mail, 
                idPerfil,
                checkOrganizacion, 
                usuario, 
                contrasena,
                checkHabilitado,
                estado,
                tipoMovimiento,
                usuarioCambio
              )
        VALUES (:dni, 
                :nombre, 
                :direccion, 
                :telefono, 
                :mail, 
                :idPerfil,
                :checkOrganizacion, 
                :usuario, 
                :contrasena,
                :checkHabilitado,
                :estado,
                :tipoMovimiento,
                :usuarioCambio
                )";
        $parametros =array(
            "dni"=>$dni,
            "nombre"=>$nombre,
            "direccion"=>$direccion,
            "telefono"=>$telefono,
            "mail"=>$mail,
            "idPerfil"=>$idPerfil,
            "checkOrganizacion"=>$checkOrganizacion,
            "usuario"=>$usuario,
            "contrasena"=>$contrasena,
            "checkHabilitado"=>$checkHabilitado,
            "estado"=>$estado,
            "tipoMovimiento"=>$tipoMovimiento,
            "usuarioCambio"=>$usuarioCambio
        );
        $this->connect();
        $query = $this->ejecutarOrden($sql, $parametros);
        return $query;
        
    }

    public function guardarPersonaHG(
        $tipoMovimiento,$usuarioCambio){
        $sql="INSERT INTO A_PERSONA_HISTORIAL
              (
                dni, 
                nombre, 
                direccion, 
                telefono, 
                mail, 
                idPerfil,
                checkOrganizacion, 
                usuario, 
                contrasena,
                tipoMovimiento,
                usuarioCambio
              )
        VALUES (:dni, 
                :nombre, 
                :direccion, 
                :telefono, 
                :mail, 
                :idPerfil,
                :checkOrganizacion, 
                :usuario, 
                :contrasena,
                :tipoMovimiento,
                :usuarioCambio
                )";
        $parametros =array(
            "dni"=>'*',
            "nombre"=>'*',
            "direccion"=>'*',
            "telefono"=>0,
            "mail"=>'*',
            "idPerfil"=>0,
            "checkOrganizacion"=>NULL,
            "usuario"=>NULL,
            "contrasena"=>NULL,
            "tipoMovimiento"=>$tipoMovimiento,
            "usuarioCambio"=>$usuarioCambio
        );
        $this->connect();
        $query = $this->ejecutarOrden($sql, $parametros);
        return $query;
        
    }

    public function buscarPersonaH($dni,$estado){
        $sql="SELECT id,dni
            FROM A_PERSONA
            WHERE dni = :dni AND estado=:estado";
        $parametros =array("dni"=>$dni,"estado"=>$estado);
        $this->connect();
        $query = $this->iniciar($sql, $parametros);

        return $query;
    }

}//cierre clase
?>