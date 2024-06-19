<?php
session_start();
  //llama al MenuModel
  require_once("../model/MenuModel.php");
  
  //declaro una variable para poder invocar a MenuModel
  $menu= new MenuModel();
  $organizacion = (isset($_POST['organizacion'])) ? $_POST['organizacion'] : '';
  $user_id = (isset($_POST['user_id'])) ? $_POST['user_id'] : '';
  $nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
  $direccion = (isset($_POST['direccion'])) ? $_POST['direccion'] : '';
  $tipo = (isset($_POST['tipo'])) ? $_POST['tipo'] : '';
  $fechaIngreso = (isset($_POST['fechaIngreso'])) ? $_POST['fechaIngreso'] : '';
  $aniosVigente = (isset($_POST['aniosVigente'])) ? $_POST['aniosVigente'] : '';
  $checkVigente = (isset($_POST['checkVigente'])) ? $_POST['checkVigente'] : '';
  $numProvidencia = (isset($_POST['numProvidencia'])) ? $_POST['numProvidencia'] : '';
  $checkHabilitado = (isset($_POST['checkHabilitado'])) ? $_POST['checkHabilitado'] : '';
  $estado = (isset($_POST['estado'])) ? $_POST['estado'] : '';
  $fechaIngreso = date('Y-m-d H:i:s', strtotime($fechaIngreso));
  //Armo un GET "op" donde OP signific operacion
  switch($_GET["op"]){
   //en caso que llame el controller debo usar op y la opcionen, en esta caso solo es listar
  case "organizacion":
    //define la consulta
    $CONSULTA = "SELECT  
A_ORGANIZACION.id,
A_ORGANIZACION.nombre,
A_ORGANIZACION.direccion,
A_ORGANIZACION.tipo,
A_ORGANIZACION.fechaIngreso,
A_ORGANIZACION.aniosVigente,
A_ORGANIZACION.checkVigente,
A_ORGANIZACION.numProvidencia,
A_ORGANIZACION.checkHabilitado,
A_ORGANIZACION.estado


FROM [dbo].[A_ORGANIZACION]";
    //llamo al metodo listar y le doy la variable CONSULTA
    $datos=$menu->listar($CONSULTA);
    //imprimir los datos en JSON
    print($datos);
    break;
    
    case "add_organizacion":
      //define la consulta
      $CONSULTA = "INSERT INTO A_ORGANIZACION (nombre, direccion, tipo, fechaIngreso, aniosVigente, checkVigente, numProvidencia,
      checkHabilitado, estado) VALUES ('$nombre','$direccion','$tipo','$fechaIngreso','$aniosVigente','$checkVigente','$numProvidencia',
      '$checkHabilitado','$estado')";
      echo($CONSULTA);
      //llamo al metodo listar y le doy la variable CONSULTA
      $datos=$menu->listar($CONSULTA);
        $CONSULTA = "SELECT * FROM A_ORGANIZACION";
        //llamo al metodo listar y le doy la variable CONSULTA
        $datos=$menu->listar($CONSULTA);
        //imprimir los datos en JSON
        print($datos);
      //imprimir los datos en JSON
      
      $usuarioCambio = $_SESSION["test"];
      $CONSULTA = "INSERT INTO A_ORGANIZACION_HISTORIAL (nombre,direccion,tipo,fechaIngreso,aniosVigente,checkVigente,numProvidencia,
      checkHabilitado,estado,usuarioCambio,fechaCambio,tipoMovimiento) values ('$nombre', '$direccion', '$tipo', '$fechaIngreso', 
      '$aniosVigente','$checkVigente', '$numProvidencia', '$checkHabilitado','$estado','$usuarioCambio',getdate(),'Añadir Nueva Organizacion')";
      $datos=$menu->listar($CONSULTA);
      $CONSULTA = "SELECT * FROM A_ORGANIZACION_HISTORIAL"; 
      $datos=$menu->listar($CONSULTA);
      print($datos);
      
    break; 
        //edita 1 dato selecionable de la tabla A_ETNIA
    case "edit_organizacion":
      //define la consulta
      $CONSULTA = "UPDATE A_ORGANIZACION SET nombre ='$nombre',direccion ='$direccion',tipo ='$tipo',fechaIngreso ='$fechaIngreso',aniosVigente ='$aniosVigente',
      checkVigente ='$checkVigente',numProvidencia ='$numProvidencia',checkHabilitado ='$checkHabilitado',estado ='$estado' WHERE id='$user_id'";
      //llamo al metodo listar y le doy la variable CONSULTA
      echo($CONSULTA);
      $datos=$menu->listar($CONSULTA);
        $CONSULTA = "SELECT * FROM A_ORGANIZACION";
        //llamo al metodo listar y le doy la variable CONSULTA
        $datos=$menu->listar($CONSULTA);
        //imprimir los datos en JSON
        print($datos);

        $usuarioCambio = $_SESSION["test"];
        $CONSULTA = "INSERT INTO A_ORGANIZACION_HISTORIAL (nombre,direccion,tipo,fechaIngreso,aniosVigente,checkVigente,numProvidencia,
        checkHabilitado,estado,usuarioCambio,fechaCambio,tipoMovimiento) values ('$nombre', '$direccion', '$tipo', '$fechaIngreso', 
        '$aniosVigente','$checkVigente', '$numProvidencia', '$checkHabilitado','$estado','$usuarioCambio',getdate(),'Editar una Organizacion')";
        $datos=$menu->listar($CONSULTA);
        $CONSULTA = "SELECT * FROM A_ORGANIZACION_HISTORIAL"; 
        $datos=$menu->listar($CONSULTA);
        print($datos);

      break;
  }
  
?>