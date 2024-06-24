
<?php
    //Solicito el archivo ConexionDB.php para conectarme a la base de dato
    require_once '../config/ConexionDB.php';

    //La clase Menu Model hereda funciones de ConexionDB
    class MenuModelPerfil extends ConexionBD{

        public function listar($CONSULTA){
            //$sql = "SELECT * FROM A_ETNIA"
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
        public function mostrarPerfil(){
   
            $sql ="SELECT id, perfil FROM A_PERFIL";
            $this->connect();
            $query = $this->iniciar($sql);
            
                return $query;
           
        }

    }


?>
