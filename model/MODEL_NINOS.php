<?php
//Solicito el archivo ConexionDB.php para conectarme a la base de dato
require_once '../config/ConexionDB.php';

//todo:-------------------------------------------------------------------------------------------
//La clase Menu Model hereda funciones de ConexionDB
class Ninos extends ConexionBD{

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
    //NO SE USARA AUN
    /* public function loginPersonal($rut, $pass){

        $sql ="SELECT RUT FROM A_PERSONAL WHERE RUT = :rut AND PASSWORD = :pass";
        $parametros = array("rut"=>$rut,"pass"=>$pass);
        $this->connect();
        $query = $this->ejecutaConsulta($sql, $parametros);
        if(count($query)){
            return true;
        }else{
            return false;
        }
    } */


    public function listarNinos($tipoO, $organizacionO, $periodo){


        $sql="SELECT  
          N.id AS id,
		  N.dni AS dni,
          N.nombre AS nombre,
          N.sexo AS sexo,
		  CASE
			WHEN [sexo] = 0 THEN 'FEMENINO'
			WHEN [sexo]= 1 THEN 'MASCULINO'
			END AS sexo_vista,
          N.edad AS edad,
          N.fechaNacimiento AS fechaNacimiento,
          N.periodo AS periodo,
          N.descripcion AS descripcion,
          N.fechaRegistro AS fechaRegistro,
          N.idNacionalidad AS idNacionalidad,
          N.checkExtranjero AS checkExtranjero,
		  N.checkCeguera AS checkCeguera,
		  N.checkSordera AS checkSordera,
		  N.checkMudez AS checkMudez,
		  N.checkFisica AS checkFisica,
		  N.checkMental AS checkMental,
		  N.checkPsiquica AS checkPsiquica,
		  N.idOrganizacion AS idOrganizacion,
		  N.idPersonalRegistro AS idPersonalRegistro,

		  N.checkDiscapacitado AS checkDiscapacitado,
		  N.porcentajeCeguera AS porcentajeCeguera,
		  N.porcentajeSordera AS porcentajeSordera,
		  N.porcentajeMudez AS porcentajeMudez,
		  N.porcentajeFisica AS porcentajeFisica,
		  N.porcentajeMental AS porcentajeMental,
		  N.porcentajePsiquica AS porcentajePsiquica,

          E.etnia AS etnia,
          NA.nacionalidad AS nacionalidad,
          O.nombre AS NOMBRE_ORGANIZACION,
           
          O.tipo AS tipo,
          CASE
			WHEN tipo = 1 THEN 'JUNTA VECINAL'
			WHEN tipo = 2 THEN 'COMÍTE'
			WHEN tipo = 3 THEN 'CONDOMINIO'
			WHEN tipo = 4 THEN 'PROVIDENCIA'
		END AS tipo_org,
		N.idEtnia AS idEtnia--,

		--N.idOrganizacion AS idOrganizacion


        FROM A_NINOS N
          JOIN A_ETNIA E ON N.idEtnia = E.id
          JOIN A_NACIONALIDAD NA ON N.idNacionalidad = NA.id
          JOIN A_ORGANIZACION O ON N.idOrganizacion = O.id
           ";

        if($tipoO==0 && ($organizacionO==null || $organizacionO=='') ){
            $sql = $sql." WHERE N.periodo = :periodo";
            $parametros =array("periodo"=>$periodo);
            $this->connect();
            $query = $this->ejecutaConsulta($sql, $parametros);
        }elseif($tipoO!=0 && ($organizacionO==null || $organizacionO=='')){
            $sql = $sql." WHERE O.tipo= :tipoO
		    AND N.periodo = :periodo";
            $parametros =array("tipoO"=>$tipoO,"periodo"=>$periodo);
            $this->connect();
            $query = $this->ejecutaConsulta($sql, $parametros);
        }elseif($tipoO!=0 && ($organizacionO!=null || $organizacionO!='') && $periodo!=0){
            $sql = $sql." WHERE O.tipo= :tipoO
            AND N.idOrganizacion = :organizacionO
		    AND N.periodo = :periodo";
            $parametros =array("tipoO"=>$tipoO,"organizacionO"=>$organizacionO,"periodo"=>$periodo);
            $this->connect();
            $query = $this->ejecutaConsulta($sql, $parametros);
        }
        else{
            $sql = $sql." WHERE N.periodo = :periodo";
            $parametros =array("periodo"=>$periodo);
            $this->connect();
            $query = $this->ejecutaConsulta($sql, $parametros);
            
        }

        return $query;

    }
}