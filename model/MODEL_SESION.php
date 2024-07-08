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
            $query = $this->ejecutaConsulta($CONSULTA);
            //retorno la consulta hacia controller.php
            return $query;
        }
        
        //NO SE USARA AUN
        public function loginPersonal($rut, $pass){
            $user = $rut;
            $contra = $pass;
            $sql ="SELECT  
            A_PERSONA.nombre,
            A_PERSONA.usuario,
            A_PERSONA.contrasena,
            A_PERFIL.id,
            A_PERFIL.PERFIL
            FROM [dbo].[A_PERSONA]
            INNER JOIN A_PERFIL ON A_PERSONA.idPerfil = A_PERFIL.id
            WHERE A_PERSONA.usuario = :rut AND A_PERSONA.contrasena = :pass 
            ";
            $parametros = array("rut"=>$user,"pass"=>$contra);
            $this->connect();
            $listo = "gracias";
            $mal = "mal";
            $query = $this->iniciar($sql, $parametros);
            if(count($query)){
                return TRUE ;
            }else{
                return  FALSE ;
            }
            /*if(count(array($query))){
                return  var_dump($query);
            }else{
                return  $mal;
            }*/
        }
        public function datosPersonal($rut, $pass){
            $user = $rut;
            $contra = $pass;
            /* $sql ="SELECT  
            A_PERSONA.id as id_persona,
            A_PERSONA.nombre,
            A_PERSONA.usuario,
            A_PERSONA.contrasena,
            A_PERSONA.checkHabilitado,
            A_PERFIL.id,
            A_PERFIL.PERFIL,
            A_PERFIL.checkCreateN,
            A_PERFIL.checkUpdateN,	
            A_PERFIL.checkReadN,	
            A_PERFIL.checkDeleteN,	
            A_PERFIL.checkCreateO,	
            A_PERFIL.checkUpdateO,	
            A_PERFIL.checkReadO,	
            A_PERFIL.checkDeleteO,	
            A_PERFIL.checkCreateP,	
            A_PERFIL.checkUpdateP,	
            A_PERFIL.checkReadP,	
            A_PERFIL.checkDeleteP,
            A_PERFIL.tipo		
            FROM [dbo].[A_PERSONA]
            INNER JOIN A_PERFIL ON A_PERSONA.idPerfil = A_PERFIL.id
            WHERE A_PERSONA.usuario = :rut AND A_PERSONA.contrasena = :pass
            "; */
            $sql ="SELECT  
            P.id AS id_persona,
            P.nombre AS nombre,
            P.usuario AS usuario,
            P.contrasena AS contrasena,
            P.checkHabilitado AS checkHabilitado,
            PE.id AS id,
            PE.PERFIL AS PERFIL,
            PE.checkCreateN AS checkCreateN,
            PE.checkUpdateN AS checkUpdateN,	
            PE.checkReadN AS checkReadN,	
            PE.checkDeleteN AS checkDeleteN,	
            PE.checkCreateO AS checkCreateO,	
            PE.checkUpdateO AS checkUpdateO,	
            PE.checkReadO AS checkReadO,	
            PE.checkDeleteO AS checkDeleteO,	
            PE.checkCreateP AS checkCreateP,	
            PE.checkUpdateP AS checkUpdateP,	
            PE.checkReadP AS checkReadP,	
            PE.checkDeleteP AS checkDeleteP,
            PE.tipo	AS tipo,
			O.nombre AS nombreOrganizacion
            FROM A_PERSONA P
            JOIN A_PERFIL PE ON P.idPerfil = PE.id
			INNER JOIN A_DETALLE_PO DPO ON P.id =  DPO.idPersona
			INNER JOIN A_ORGANIZACION O ON O.id = DPO.idOrganizacion
			WHERE DPO.estado=1 AND P.usuario = :rut AND P.contrasena = :pass
UNION
SELECT  
            P.id AS id_persona,
            P.nombre AS nombre,
            P.usuario AS usuario,
            P.contrasena AS contrasena,
            P.checkHabilitado AS checkHabilitado,
            PE.id AS id,
            PE.PERFIL AS PERFIL,
            PE.checkCreateN AS checkCreateN,
            PE.checkUpdateN AS checkUpdateN,	
            PE.checkReadN AS checkReadN,	
            PE.checkDeleteN AS checkDeleteN,	
            PE.checkCreateO AS checkCreateO,	
            PE.checkUpdateO AS checkUpdateO,	
            PE.checkReadO AS checkReadO,	
            PE.checkDeleteO AS checkDeleteO,	
            PE.checkCreateP AS checkCreateP,	
            PE.checkUpdateP AS checkUpdateP,	
            PE.checkReadP AS checkReadP,	
            PE.checkDeleteP AS checkDeleteP,
            PE.tipo	AS tipo,
			nombreOrganizacion = 'NINGUNA'
            FROM A_PERSONA P
            JOIN A_PERFIL PE ON P.idPerfil = PE.id
			--INNER JOIN A_DETALLE_PO DPO ON P.id =  DPO.idPersona
			WHERE P.checkOrganizacion=0 AND P.usuario = :rut2 AND P.contrasena = :pass2";
            $parametros = array("rut"=>$user,"pass"=>$contra,"rut2"=>$user,"pass2"=>$contra);
            $this->connect();
            $listo = "gracias";
            $mal = "mal";
            $query = $this->iniciar($sql, $parametros);
            if(count($query)){
                return $query;
            }else{
                return $query;
            }
            /*if(count(array($query))){
                return  var_dump($query);
            }else{
                return  $mal;
            }*/
        }
    }


?>