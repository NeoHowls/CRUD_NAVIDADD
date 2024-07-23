<?php
//Solicito el archivo ConexionDB.php para conectarme a la base de dato
require_once '../config/ConexionDB.php';

//todo:-------------------------------------------------------------------------------------------
//La clase Personas Model hereda funciones de ConexionDB
class PersonasH extends ConexionBD{

    public function guardarPersonaH(
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