<?php

class ConexionBD{

    private $host;
    private $db;
    private $user;
    private $password;
    private $conexion;
    private $error;

    public function getError(){
        return $this->error;
    }
    

    public function  __construct()
    {
        $this->host = 'DESKTOP-1DC178O\SQLEXPRESS';

        $this->db = 'BD_NAVIDAD';
        //$this->db = 'BD_Inventario';
        $this->user = 'sa';
        $this->password ='1';
        $this->error= '';

        /* $this->host = '10.20.10.6';
        // $this->db = 'Inventario_Test';
        $this->db = 'BD_NAVIDAD';
        $this->user = 'abaeza';
        $this->password ='abaeza';
        $this->error= '';
         */
    }

    public function connect()
    {
        try{
        $connection = 'sqlsrv:server='.$this->host.';database='.$this->db;
        $options = [PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_EMULATE_PREPARES=>false];
        $this-> conexion = new PDO($connection, $this->user, $this->password);
         
        }catch (Exception $ex){
            print_r ("Error connection: ".$ex->getMessage());
        }
    }

    public function ejecutaConsulta($sql = "", $valores =array())
    {
        if($sql != "" && strlen($sql) > 0){
            $consulta = $this->conexion->prepare($sql);
            //echo $sql.'<br>';
            $consulta->execute($valores);
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
            $resultado1 = json_encode($resultado, JSON_UNESCAPED_UNICODE);
            // var_dump($resultado);
            $this->error='0';
            return $resultado1;
        }else{
            $this->error='5';
            //return ;
        }
    }


    public function iniciar($sql = "", $valores =array())
    {
        if($sql != "" && strlen($sql) > 0){
            $consulta = $this->conexion->prepare($sql);
            //echo $sql.'<br>';
            $consulta->execute($valores);
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
            // var_dump($resultado);
            $this->error='0';
            return $resultado;
        }else{
            $this->error='5';
            //return ;
        }
    }


    public function ejecutarOrden($sql = "", $valores =array())
    {
        if($sql != "" && strlen($sql) > 0){
             try{
                $this->conexion->beginTransaction();
                //echo $sql.'<br>';
                $consulta = $this->conexion->prepare($sql);
                
                $consulta->execute($valores);
                /* var_dump($consulta);
                var_dump($valores); */
                //echo ($consulta->errorCode()." ".intval($consulta->errorCode())." <br>" );
                //  var_dump($consulta);/////////
                //echo "<br>";
                $arr =array();
                 if (intval($consulta->errorCode())===0){
                     $this->conexion->commit(); //confirma accion realizada
                     $filasAfectadas = $consulta->rowCount();
                     $arr=array("error"=>$consulta->errorCode(),"filasAfectadas"=>$filasAfectadas, "cod"=>'0');//realizado
                     $this->error='0';
                     //return $filasAfectadas;
                     return $arr;
                    //  return $this->error=0;
                     /* return 0; */
                 }else{
                     $this->conexion->rollBack();
                     $arr=array("error"=>$consulta->errorCode(), "cod"=>'4');//falla en ejecucion
                     //return -1;
                     $this->error='4';
                    //  var_dump($arr);
                     return $arr;
                    // return $this->error=-1;
                 }
             }catch(Exception $ex){
                 $this->conexion->rollBack();
                 // //return $this->conexion->errorInfo();
                 $arr=array("error"=>$ex->getMessage(),"cod"=>'3');//falla exepcion
                 $this->error='3';
                 return $arr;
                 /* return 3; */
                 //return $ex->getMessage();
                //  return $this->error=3;
             }
        }else{
            $arr=array("cod"=>'2');//error ejecutar sql vacia
            $this->error='2';
            return $arr;
            /* return 2; */
            //return 0;
            // return $this->error=2;
        }
    } 

}



?>