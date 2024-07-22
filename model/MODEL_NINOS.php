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

        $sql1 = "SELECT  
          N.id AS id,
		  N.dni AS dni,
          N.nombre AS nombre,
          N.sexo AS sexo,
		  CASE
			WHEN [sexo] = 0 THEN 'FEMENINO'
			WHEN [sexo]= 1 THEN 'MASCULINO'
			END AS sexo_vista,
          N.edad AS edad,
          (CONVERT(VARCHAR(24),N.fechaNacimiento,105)) AS fechaNacimiento,
          --N.fechaNacimiento AS fechaNacimiento,
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
		N.idEtnia AS idEtnia,

		N.idOrganizacion AS idOrganizacion


        FROM A_NINOS N
          JOIN A_ETNIA E ON N.idEtnia = E.id
          JOIN A_NACIONALIDAD NA ON N.idNacionalidad = NA.id
          JOIN A_ORGANIZACION O ON N.idOrganizacion = O.id
		WHERE N.idEtnia <>0";

$sql2 = "SELECT 
		  N.id AS id,
		  N.dni AS dni,
          N.nombre AS nombre,
          N.sexo AS sexo,
		  CASE
			WHEN [sexo] = 0 THEN 'FEMENINO'
			WHEN [sexo]= 1 THEN 'MASCULINO'
			END AS sexo_vista,
          N.edad AS edad,
          (CONVERT(VARCHAR(24),N.fechaNacimiento,105)) AS fechaNacimiento,
          --N.fechaNacimiento AS fechaNacimiento,
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
		etnia = 'Sin Etnia',
		NA.nacionalidad AS nacionalidad,
		O.nombre AS NOMBRE_ORGANIZACION,
           
          O.tipo AS tipo,
          CASE
			WHEN tipo = 1 THEN 'JUNTA VECINAL'
			WHEN tipo = 2 THEN 'COMÍTE'
			WHEN tipo = 3 THEN 'CONDOMINIO'
			WHEN tipo = 4 THEN 'PROVIDENCIA'
		END AS tipo_org,
		idEtnia = 0,

		N.idOrganizacion AS idOrganizacion

FROM A_NINOS N
JOIN A_NACIONALIDAD NA ON N.idNacionalidad = NA.id
JOIN A_ORGANIZACION O ON N.idOrganizacion = O.id
WHERE N.idEtnia =0";

        if($tipoO==0 && ($organizacionO==null || $organizacionO=='') ){
            $sql1 = $sql1." AND N.periodo = :periodo AND N.estado=1";
            $sql2 = $sql2." AND N.periodo = :periodo2 AND N.estado=1";
            $sql = $sql1. " UNION " . $sql2;
            $parametros =array("periodo"=>$periodo,"periodo2"=>$periodo);
            $this->connect();
            $query = $this->ejecutaConsulta($sql, $parametros);
        }elseif($tipoO!=0 && ($organizacionO==null || $organizacionO=='')){
            $sql1 = $sql1." AND O.tipo= :tipoO AND N.periodo = :periodo AND N.estado=1";
            $sql2 = $sql2." AND O.tipo= :tipoO2 AND N.periodo = :periodo2 AND N.estado=1";
            $sql = $sql1. " UNION " . $sql2;
            $parametros =array("tipoO"=>$tipoO,"periodo"=>$periodo,"tipoO2"=>$tipoO,"periodo2"=>$periodo);
            $this->connect();
            $query = $this->ejecutaConsulta($sql, $parametros);
        }elseif($tipoO!=0 && ($organizacionO!=null || $organizacionO!='') && $periodo!=0){
            $sql1 = $sql1." AND O.tipo= :tipoO AND N.idOrganizacion = :organizacionO AND N.periodo = :periodo AND N.estado=1";
            $sql2 = $sql2." AND O.tipo= :tipoO2 AND N.idOrganizacion = :organizacionO2 AND N.periodo = :periodo2 AND N.estado=1";
            $sql = $sql1. " UNION " . $sql2;
            $parametros =array("tipoO"=>$tipoO,"organizacionO"=>$organizacionO,"periodo"=>$periodo,
                               "tipoO2"=>$tipoO,"organizacionO2"=>$organizacionO,"periodo2"=>$periodo);
            $this->connect();
            $query = $this->ejecutaConsulta($sql, $parametros);
        }
        else{
            $sql1 = $sql1." AND N.periodo = :periodo AND N.estado=1";
            $sql2 = $sql2." AND N.periodo = :periodo2 AND N.estado=1";
            $sql = $sql1. " UNION " . $sql2;
            $parametros =array("periodo"=>$periodo,"periodo2"=>$periodo);
            $this->connect();
            $query = $this->ejecutaConsulta($sql, $parametros);
            
        }
        return $query;
    }

    public function guardarNinos($dni,$nombre,$sexo,
    $edad,$naciemiento,$nacion,$etnia,$periodo,
    $ceguera,$sordera,$mudez,$fisica,$mental,$psiquica,
    $descripcion,$organizacion,$usuario_id,$check_nac ,$check_dis,
    $ceguera_p,$sordera_p ,$mudez_p,$fisica_p ,$mental_p,$psiquica_p){
        $sql="INSERT INTO A_NINOS
              (
                dni,--1
                nombre,--2
                sexo,--3
                edad,--4
                fechaNacimiento,--5
                idNacionalidad,--6
                idEtnia,--7
                periodo,--8
                checkCeguera,--9
                checkSordera,--10
                checkMudez,--11
                checkFisica,--12
                checkMental,--13
                checkPsiquica,--14
                descripcion,--15
                idOrganizacion,--16
                idPersonalRegistro,--17
                checkExtranjero,--18
                checkDiscapacitado,--19
                porcentajeCeguera,--20
                porcentajeSordera,--21
                porcentajeMudez,--22
                porcentajeFisica,--23
                porcentajeMental,--24
                porcentajePsiquica--25
              )
        VALUES
              (:dni,:nombre,:sexo
              ,:edad,:naciemiento,:nacion,:etnia,:periodo
              ,:ceguera,:sordera ,:mudez,:fisica,:mental,:psiquica
              ,:descripcion,:organizacion,:usuario_id,:check_nac ,:check_dis
              ,:ceguera_p,:sordera_p ,:mudez_p,:fisica_p ,:mental_p,:psiquica_p)";
        $parametros =array(
            "dni"=>$dni,
            "nombre"=>$nombre,
            "sexo"=>$sexo,
            "edad"=>$edad,
            "naciemiento"=>$naciemiento,
            "nacion"=>$nacion,
            "etnia"=>$etnia,
            "periodo"=>$periodo,
            "ceguera"=>$ceguera,
            "sordera"=>$sordera, 
            "mudez"=>$mudez,
            "fisica"=>$fisica,
            "mental"=>$mental,
            "psiquica"=>$psiquica,
            "descripcion"=>$descripcion,
            "organizacion"=>$organizacion,
            "usuario_id"=>$usuario_id,
            "check_nac"=>$check_nac, 
            "check_dis"=>$check_dis,
            "ceguera_p"=>$ceguera_p,
            "sordera_p"=>$sordera_p,
            "mudez_p"=>$mudez_p,
            "fisica_p"=>$fisica_p,
            "mental_p"=>$mental_p,
            "psiquica_p"=>$psiquica_p
        );
        // $parametros =array("periodo"=>$periodo,"periodo2"=>$periodo);
        $this->connect();
        $query = $this->ejecutarOrden($sql, $parametros);
        return $query;
        
    }

    public function buscarNinoDniPeriodo($dni,$periodo,$estado){
        $sql="SELECT N.id id, N.dni dni, O.nombre nombreOrganizacion 
            FROM A_NINOS N
            JOIN A_ORGANIZACION O ON O.id=N.idOrganizacion
            WHERE N.dni=:dni AND N.periodo=:periodo AND N.estado=:estado";
        $parametros =array("dni"=>$dni,"periodo"=>$periodo,"estado"=>$estado);
        $this->connect();
        $query = $this->iniciar($sql, $parametros);

        return $query;
    }

    public function buscarNinoIdDni($id,$dni,$periodo,$estado){
        $sql="SELECT N.id id, N.dni dni, O.nombre nombreOrganizacion 
            FROM A_NINOS N
            JOIN A_ORGANIZACION O ON O.id=N.idOrganizacion
            WHERE N.id = :id AND N.dni=:dni AND N.periodo=:periodo AND N.estado=:estado";
        $parametros =array("id"=>$id,"dni"=>$dni,"periodo"=>$periodo,"estado"=>$estado);
        $this->connect();
        $query = $this->iniciar($sql, $parametros);

        return $query;
    }

    public function eliminarNino($id){
        $sql="UPDATE A_NINOS
                SET estado = 0
                WHERE id=:id";
        $parametros =array("id"=>$id);
        $this->connect();
        $query = $this->ejecutarOrden($sql, $parametros);

        return $query;
    }

    public function actualizarNinos($id,$dni,$nombre,$sexo,
    $edad,$naciemiento,$nacion,$etnia,$periodo,
    $ceguera,$sordera,$mudez,$fisica,$mental,$psiquica,
    $descripcion,$organizacion,$usuario_id,$check_nac ,$check_dis,
    $ceguera_p,$sordera_p ,$mudez_p,$fisica_p ,$mental_p,$psiquica_p){
        $sql="UPDATE A_NINOS
                SET dni = :dni,--1
                    nombre = :nombre,--2
                    sexo = :sexo,--3
                    edad = :edad,--4
                    fechaNacimiento = :naciemiento,
                    idNacionalidad = :nacion,
                    idEtnia = :etnia,
                    periodo = :periodo,
                    checkCeguera = :ceguera,
                    checkSordera = :sordera,
                    checkMudez = :mudez,
                    checkFisica = :fisica,
                    checkMental = :mental,
                    checkPsiquica = :psiquica,
                    descripcion = :descripcion,
                    idOrganizacion = :organizacion,
                    idPersonalRegistro = :usuario_id,
                    checkExtranjero = :check_nac,
                    checkDiscapacitado = :check_dis,
                    porcentajeCeguera = :ceguera_p,
                    porcentajeSordera = :sordera_p,
                    porcentajeMudez = :mudez_p,
                    porcentajeFisica = :fisica_p,
                    porcentajeMental = :mental_p,
                    porcentajePsiquica =:psiquica_p
                WHERE id = :id";

              

        $parametros =array(
            "id"=>$id,
            "dni"=>$dni,
            "nombre"=>$nombre,
            "sexo"=>$sexo,
            "edad"=>$edad,
            "naciemiento"=>$naciemiento,
            "nacion"=>$nacion,
            "etnia"=>$etnia,
            "periodo"=>$periodo,
            "ceguera"=>$ceguera,
            "sordera"=>$sordera, 
            "mudez"=>$mudez,
            "fisica"=>$fisica,
            "mental"=>$mental,
            "psiquica"=>$psiquica,
            "descripcion"=>$descripcion,
            "organizacion"=>$organizacion,
            "usuario_id"=>$usuario_id,
            "check_nac"=>$check_nac, 
            "check_dis"=>$check_dis,
            "ceguera_p"=>$ceguera_p,
            "sordera_p"=>$sordera_p,
            "mudez_p"=>$mudez_p,
            "fisica_p"=>$fisica_p,
            "mental_p"=>$mental_p,
            "psiquica_p"=>$psiquica_p
        );
        // $parametros =array("periodo"=>$periodo,"periodo2"=>$periodo);
        $this->connect();
        $query = $this->ejecutarOrden($sql, $parametros);
        return $query;
        
    }
}