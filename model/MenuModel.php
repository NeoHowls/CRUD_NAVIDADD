<?php
    //Solicito el archivo ConexionDB.php para conectarme a la base de dato
    require_once '../config/ConexionDB.php';

    //La clase Menu Model hereda funciones de ConexionDB
    class MenuModel extends ConexionBD{

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
        
        //NO SE USARA AUN
        public function loginPersonal($rut, $pass){
   
            $sql ="SELECT RUT FROM A_PERSONAL WHERE RUT = :rut AND PASSWORD = :pass";
            $parametros = array("rut"=>$rut,"pass"=>$pass);
            $this->connect();
            $query = $this->ejecutaConsulta($sql, $parametros);
            if(count($query)){
                return true;
            }else{
                return false;
            }
        }

    }


?>