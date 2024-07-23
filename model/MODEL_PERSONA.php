<?php
//Solicito el archivo ConexionDB.php para conectarme a la base de dato
require_once '../config/ConexionDB.php';

//todo:-------------------------------------------------------------------------------------------
//La clase Personas Model hereda funciones de ConexionDB
class Personas extends ConexionBD{

    public function listar($CONSULTA){
        //$sql = "SELECT * FROM A_ETNIA";
        //Realizo la conexion paara comunicarme con la bdd
        $this->connect();
        //configuro la consulta 
        $query = $this->ejecutaConsulta($CONSULTA);
        //retorno la consulta hacia controller.php
        return $query;
    }

    public function ejecutar($CONSULTA){
        //$sql = "SELECT * FROM A_ETNIA";
        //Realizo la conexion paara comunicarme con la bdd
        $this->connect();
        //configuro la consulta 
        $query = $this->ejecutarOrden($CONSULTA);
        //retorno la consulta hacia controller.php
        return $query;
    }
    public function consultar($CONSULTA){
        //$sql = "SELECT * FROM A_ETNIA";
        //Realizo la conexion paara comunicarme con la bdd
        $this->connect();
        //configuro la consulta 
        $query = $this->iniciar($CONSULTA);
        //retorno la consulta hacia controller.php
        return $query;
    }

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

    public function habilitarGeneral($idPersonas){
        
        $sql="UPDATE A_PERSONA 
              SET checkHabilitado=1
              WHERE idPerfil !=7 and idPerfil !=8";
        if($idPersonas!='' || $idPersonas!=null){
            /* echo "asdasd";
            var_dump($idPersonas); */
            $sql=$sql." AND id NOT IN (".$idPersonas.")";
            // echo $sql;
            // $parametros =array("idPersonas"=>$idPersonas);
            $this->connect();
            // $query = $this->ejecutarOrden($sql, $parametros);
            $query = $this->ejecutarOrden($sql);
        }else{
            $sql=$sql;
            $this->connect();
            $query = $this->ejecutarOrden($sql);
        }
        
        /* $this->connect();
        $query = $this->ejecutarOrden($sql, $parametros); */
        return $query;

    }
}//cierre clase
?>