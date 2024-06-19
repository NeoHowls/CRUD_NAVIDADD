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
    $CONSULTA = "SELECT  
*
FROM [dbo].[A_PERFIL]";
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
       '$CheckPPC', '$CheckPPE' , '$CheckPPC', '$ChecKPPE',
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