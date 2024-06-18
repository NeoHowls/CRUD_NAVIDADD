<?php
  //llama al MenuModel
  require_once("../model/MenuModel.php");
  
  //declaro una variable para poder invocar a MenuModel
  $menu= new MenuModel();
  $po = (isset($_POST['po'])) ? $_POST['po'] : '';
  $user_id = (isset($_POST['user_id'])) ? $_POST['user_id'] : '';
  $idPersona = (isset($_POST['idPersona'])) ? $_POST['idPersona'] : '';
  $idOrganizacion = (isset($_POST['idOrganizacion'])) ? $_POST['idOrganizacion'] : '';
  $fechaIngreso = (isset($_POST['fechaIngreso'])) ? $_POST['fechaIngreso'] : '';
  $fechaTermino = (isset($_POST['fechaTermino'])) ? $_POST['fechaTermino'] : '';
  $estado = (isset($_POST['estado'])) ? $_POST['estado'] : '';
  $fechaIngreso = date('Y-m-d H:i:s', strtotime($fechaIngreso));
  $fechaTermino = date('Y-m-d H:i:s', strtotime($fechaTermino));
  //Armo un GET "op" donde OP signific operacion
  switch($_GET["op"]){
   //en caso que llame el controller debo usar op y la opcionen, en esta caso solo es listar
  case "po":
    //define la consulta
    $CONSULTA = "SELECT  
A_DETALLE_PO.id,
A_DETALLE_PO.idPersona,
A_DETALLE_PO.idOrganizacion,
A_DETALLE_PO.fechaIngreso,
A_DETALLE_PO.fechaTermino,
A_DETALLE_PO.estado


FROM [dbo].[A_DETALLE_PO]
WHERE A_DETALLE_PO.estado = 1
";
    //llamo al metodo listar y le doy la variable CONSULTA
    $datos=$menu->listar($CONSULTA);
    //imprimir los datos en JSON
    print($datos);
    break;
    
    case "add_PO":
      //define la consulta
      echo $po;
      $CONSULTA = "INSERT INTO A_DETALLE_PO (idPersona, idOrganizacion, fechaIngreso, fechaTermino, estado) VALUES ('$idPersona','$idOrganizacion','$fechaIngreso','$fechaTermino','$estado')";
      //llamo al metodo listar y le doy la variable CONSULTA
      echo $po;
      $datos=$menu->listar($CONSULTA);
        $CONSULTA = "SELECT * FROM A_DETALLE_PO";
        //llamo al metodo listar y le doy la variable CONSULTA
        $datos=$menu->listar($CONSULTA);
        //imprimir los datos en JSON
        print($datos);
      //imprimir los datos en JSON

        //edita 1 dato selecionable de la tabla A_ETNIA
    case "edit_PO":
      //define la consulta
      echo $fechaIngreso;
      echo $fechaTermino;
      $CONSULTA = "UPDATE A_DETALLE_PO SET idPersona ='$idPersona',idOrganizacion ='$idOrganizacion',fechaIngreso ='$fechaIngreso',fechaTermino ='$fechaTermino',estado ='$estado' WHERE id='$user_id'";
      //llamo al metodo listar y le doy la variable CONSULTA
      echo $po;
      $datos=$menu->listar($CONSULTA);
        $CONSULTA = "SELECT * FROM A_DETALLE_PO";
        //llamo al metodo listar y le doy la variable CONSULTA
        $datos=$menu->listar($CONSULTA);
        //imprimir los datos en JSON
        print($datos);
      break;
  }
  
?>