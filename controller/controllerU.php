<?php
  //llama al MenuModel
  require_once("../model/MenuModel.php");
  
  //declaro una variable para poder invocar a MenuModel
  $menu= new MenuModel();
  $user_id = (isset($_POST['user_id'])) ? $_POST['user_id'] : '';
  $perfil = (isset($_POST['perfil'])) ? $_POST['perfil'] : '';
  $tipo = (isset($_POST['tipo'])) ? $_POST['tipo'] : '';
  $Estado = (isset($_POST['Estado'])) ? $_POST['Estado'] : '';
  $CheckNC = (isset($_POST['CheckNC'])) ? $_POST['CheckNC'] : '';
  $CheckNE = (isset($_POST['CheckNE'])) ? $_POST['CheckNE'] : '';
  $CheckNL = (isset($_POST['CheckNL'])) ? $_POST['CheckNL'] : '';
  $CheckNB = (isset($_POST['CheckNB'])) ? $_POST['CheckNB'] : '';


  $CheckOC = (isset($_POST['CheckOC']))? $_POST['CheckOC'] : '';
  $CheckOE = (isset($_POST['CheckOE'])) ? $_POST['CheckOE'] : '';
  $CheckOL = (isset($_POST['CheckOL'])) ? $_POST['CheckOL'] : '';
  $CheckOB = (isset($_POST['CheckOB'])) ? $_POST['CheckOB'] : '';
  
  $CheckPC = (isset($_POST['CheckPC'])) ? $_POST['CheckPC'] : '';
  $CheckPE = (isset($_POST['CheckPE'])) ? $_POST['CheckPE'] : '';
  $CheckPL = (isset($_POST['CheckPL'])) ? $_POST['CheckPL'] : '';
  $CheckPB = (isset($_POST['CheckPB'])) ? $_POST['CheckPB'] : '';

  $CheckPPC = (isset($_POST['CheckPPC'])) ? $_POST['CheckPPC'] : '';
  $CheckPPE = (isset($_POST['CheckPPE'])) ? $_POST['CheckPPE'] : '';
  $CheckPPL = (isset($_POST['CheckPPL'])) ? $_POST['CheckPPL'] : '';
  $CheckPPB = (isset($_POST['CheckPPB'])) ? $_POST['CheckPPB'] : '';



  //Armo un GET "op" donde OP signific operacion
  switch($_GET["op"]){
   //en caso que llame el controller debo usar op y la opcionen, en esta caso solo es listar
  case "usuario":
    //define la consulta
    $CONSULTA = "SELECT id
      ,perfil
      ,tipo
	  ,CASE
			WHEN tipo = 0 THEN 'ADMINISTRADOR'
			WHEN tipo = 1 THEN 'DIDECO'
			WHEN tipo = 2 THEN 'REPRESENTANTE'
		END AS nombreTipo
      ,checkCreateN
	  ,CASE
			WHEN checkCreateN = 0 THEN 'NO'
			WHEN checkCreateN = 1 THEN 'SI'
		END AS expCreateN
      ,checkUpdateN
	  ,CASE
			WHEN checkUpdateN = 0 THEN 'NO'
			WHEN checkUpdateN = 1 THEN 'SI'
		END AS expUpdateN
      ,checkReadN
	  ,CASE
			WHEN checkReadN = 0 THEN 'NO'
			WHEN checkReadN = 1 THEN 'SI'
		END AS expReadN 
      ,checkDeleteN
	  ,CASE
			WHEN checkDeleteN = 0 THEN 'NO'
			WHEN checkDeleteN = 1 THEN 'SI'
		END AS expDeleteN
      ,checkCreateO
	  ,CASE
			WHEN checkCreateO = 0 THEN 'NO'
			WHEN checkCreateO = 1 THEN 'SI'
		END AS expCreateO
      ,checkUpdateO
	  ,CASE
			WHEN checkUpdateO = 0 THEN 'NO'
			WHEN checkUpdateO = 1 THEN 'SI'
		END AS expUpdateO
      ,checkReadO
	  ,CASE
			WHEN checkReadO = 0 THEN 'NO'
			WHEN checkReadO = 1 THEN 'SI'
		END AS expReadO
      ,checkDeleteO
	  ,CASE
			WHEN checkDeleteO= 0 THEN 'NO'
			WHEN checkDeleteO= 1 THEN 'SI'
		END AS expDeleteO
      ,checkCreateP
	  ,CASE
			WHEN checkCreateP= 0 THEN 'NO'
			WHEN checkCreateP= 1 THEN 'SI'
		END AS expCreateP
      ,checkUpdateP
	  ,CASE
			WHEN checkUpdateP= 0 THEN 'NO'
			WHEN checkUpdateP= 1 THEN 'SI'
		END AS expUpdateP
      ,checkReadP
	  ,CASE
			WHEN checkReadP= 0 THEN 'NO'
			WHEN checkReadP= 1 THEN 'SI'
		END AS expReadP
      ,checkDeleteP
	  ,CASE
			WHEN checkDeleteP= 0 THEN 'NO'
			WHEN checkDeleteP= 1 THEN 'SI'
		END AS expDeleteP
      ,checkCreatePer
	  ,CASE
			WHEN checkCreatePer= 0 THEN 'NO'
			WHEN checkCreatePer= 1 THEN 'SI'
		END AS expCreatePer
      ,checkUpdatePer
	  ,CASE
			WHEN checkUpdatePer= 0 THEN 'NO'
			WHEN checkUpdatePer= 1 THEN 'SI'
		END AS expUpdatePer
      ,checkReadPer
	  ,CASE
			WHEN checkReadPer= 0 THEN 'NO'
			WHEN checkReadPer= 1 THEN 'SI'
		END AS expReadPer
      ,checkDeletePer
	  ,CASE
			WHEN checkDeletePer= 0 THEN 'NO'
			WHEN checkDeletePer= 1 THEN 'SI'
		END AS expDeletePer
      ,estado
	  ,CASE
			WHEN estado= 0 THEN 'DESHABILITADO'
			WHEN estado= 1 THEN 'HABILITADO'
		END AS expEstado
  FROM A_PERFIL";
    //llamo al metodo listar y le doy la variable CONSULTA
    $datos=$menu->listar($CONSULTA);
    //imprimir los datos en JSON
    print($datos);
    break;
  
    case "add_persona":
      //define la consulta
      echo $CheckNC;
      echo $CheckNE;
      echo $CheckNL; 
      echo $CheckNB; 
      $CONSULTA = "INSERT INTO  A_PERFIL  VALUES  
      ('$perfil','$tipo', 
      '$CheckNC', '$CheckNE', '$CheckNL', '$CheckNB', 
      '$CheckOC', '$CheckOE', '$CheckOL', '$CheckOB', 
      '$CheckPC', '$CheckPE' , '$CheckPC', '$CheckPE', 
       '$CheckPPC', '$CheckPPE' , '$CheckPPC', '$CheckPPB',
      '$Estado')";
      //llamo al metodo listar y le doy la variable CONSULTA

      $datos=$menu->listar($CONSULTA);
        $CONSULTA = "SELECT * FROM A_PERFIL";
        //llamo al metodo listar y le doy la variable CONSULTA
        $datos=$menu->listar($CONSULTA);
        //imprimir los datos en JSON
        print($datos);
      //imprimir los datos en JSON

        //edita 1 dato selecionable de la tabla A_ETNIA
    case "edit_persona":
      //define la consulta
      echo $CheckNC;

      $CONSULTA = "UPDATE A_PERFIL SET 
        perfil = '$perfil',
        tipo = '$tipo',
        checkCreateN = '$CheckNC',
        checkUpdateN = '$CheckNE',
        checkReadN = '$CheckNL',
        checkDeleteN = '$CheckNB',

        checkCreateO = '$CheckOC',
        checkUpdateO = '$CheckOE',
        checkReadO = '$CheckOL',
        checkDeleteO = '$CheckOB',

        checkCreateP = '$CheckPC',
        checkUpdateP = '$CheckPE',
        checkReadP = '$CheckPL',
        checkDeleteP = '$CheckPB',

        checkCreatePer = '$CheckPPC',
        checkUpdatePer = '$CheckPPE',
        checkReadPer = '$CheckPPL',
        checkDeletePer = '$CheckPPB',
        estado= '$Estado'
        WHERE id = '$user_id'
      
      ";
      //llamo al metodo listar y le doy la variable CONSULTA

      $datos=$menu->listar($CONSULTA);
        $CONSULTA = "SELECT * FROM A_PERFIL
        ";
        //llamo al metodo listar y le doy la variable CONSULTA
        $datos=$menu->listar($CONSULTA);
        //imprimir los datos en JSON
        print($datos);
      break;
  }
  
?>