<?php
  //llama al MenuModel
  require_once("../model/MenuModel.php");
  
  //declaro una variable para poder invocar a MenuModel
  $menu= new MenuModel();
  $organizacion = (isset($_POST['organizacion'])) ? $_POST['organizacion'] : '';
  $user_id = (isset($_POST['user_id'])) ? $_POST['user_id'] : '';
  $correlativo = (isset($_POST['correlativo'])) ? $_POST['correlativo'] : '';
  $nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
  $direccion = (isset($_POST['direccion'])) ? $_POST['direccion'] : '';
  $tipo = (isset($_POST['tipo'])) ? $_POST['tipo'] : '';
  $fechaVigencia = (isset($_POST['fechaVigencia'])) ? $_POST['fechaVigencia'] : '';
  $checkVigente = (isset($_POST['checkVigente'])) ? $_POST['checkVigente'] : '';
  $estado = (isset($_POST['estado'])) ? $_POST['estado'] : '';
  $numProvidencia = (isset($_POST['numProvidencia'])) ? $_POST['numProvidencia'] : '';
  //Armo un GET "op" donde OP signific operacion
  switch($_GET["op"]){
   //en caso que llame el controller debo usar op y la opcionen, en esta caso solo es listar
  case "organizacion":
    //define la consulta
    $CONSULTA = "SELECT  
A_ORGANIZACION.id,
A_ORGANIZACION.correlativo,
A_ORGANIZACION.nombre,
A_ORGANIZACION.direccion,
A_ORGANIZACION.tipo,
A_ORGANIZACION.fechaVigencia,
A_ORGANIZACION.checkVigente,
A_ORGANIZACION.estado,
A_ORGANIZACION.numProvidencia


FROM [dbo].[A_ORGANIZACION]";
    //llamo al metodo listar y le doy la variable CONSULTA
    $datos=$menu->listar($CONSULTA);
    //imprimir los datos en JSON
    print($datos);
    break;
    
    case "add_organizacion":
      //define la consulta
      echo $organizacion;
      $CONSULTA = "INSERT INTO A_ORGANIZACION (correlativo, nombre, direccion, tipo, fechaVigencia, checkVigente, estado, numProvidencia) VALUES ('$correlativo','$nombre','$direccion','$tipo','$fechaVigencia','$checkVigente','$estado','$numProvidencia')";
      //llamo al metodo listar y le doy la variable CONSULTA
      echo $organizacion;
      $datos=$menu->listar($CONSULTA);
        $CONSULTA = "SELECT * FROM A_ORGANIZACION";
        //llamo al metodo listar y le doy la variable CONSULTA
        $datos=$menu->listar($CONSULTA);
        //imprimir los datos en JSON
        print($datos);
      //imprimir los datos en JSON

        //edita 1 dato selecionable de la tabla A_ETNIA
    case "edit_organizacion":
      //define la consulta
      echo $organizacion;
      $CONSULTA = "UPDATE A_ORGANIZACION SET correlativo ='$correlativo',nombre ='$nombre',direccion ='$direccion',tipo ='$tipo',fechaVigencia ='$fechaVigencia',checkVigente ='$checkVigente',estado ='$estado',numProvidencia ='$numProvidencia' WHERE id='$user_id'";
      //llamo al metodo listar y le doy la variable CONSULTA
      echo $organizacion;
      $datos=$menu->listar($CONSULTA);
        $CONSULTA = "SELECT * FROM A_ORGANIZACION";
        //llamo al metodo listar y le doy la variable CONSULTA
        $datos=$menu->listar($CONSULTA);
        //imprimir los datos en JSON
        print($datos);
      break;
  }
  
?>