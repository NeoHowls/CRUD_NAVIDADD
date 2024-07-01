<?php
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
  $checkVigente = (isset($_POST['checkVigente'])) ? $_POST['checkVigente'] : '';
  $numProvidencia = (isset($_POST['numProvidencia'])) ? $_POST['numProvidencia'] : '';
  $checkHabilitado = (isset($_POST['checkHabilitado'])) ? $_POST['checkHabilitado'] : '';
  $estado = (isset($_POST['estado'])) ? $_POST['estado'] : '';
  $tipoMovimiento=(isset($_POST['tipoMovimiento'])) ? $_POST['tipoMovimiento'] : '';
  $usuarioCambio=(isset($_POST['usuarioCambio'])) ? $_POST['usuarioCambio'] : '';
  $fechaCambio=(isset($_POST['fechaCambio'])) ? $_POST['fechaCambio'] : '';
  $fechaIngreso = date('Y-m-d H:i:s', strtotime($fechaIngreso));
  //Armo un GET "op" donde OP signific operacion
  switch($_GET["op"]){
   //en caso que llame el controller debo usar op y la opcionen, en esta caso solo es listar
  case "organizacionH":
    //define la consulta
    $CONSULTA = "SELECT  
A_ORGANIZACION_HISTORIAL.id,
A_ORGANIZACION_HISTORIAL.nombre,
A_ORGANIZACION_HISTORIAL.direccion,
A_ORGANIZACION_HISTORIAL.tipo,
A_ORGANIZACION_HISTORIAL.fechaIngreso,
A_ORGANIZACION_HISTORIAL.checkVigente,
A_ORGANIZACION_HISTORIAL.numProvidencia,
A_ORGANIZACION_HISTORIAL.checkHabilitado,
A_ORGANIZACION_HISTORIAL.estado,
A_ORGANIZACION_HISTORIAL.usuarioCambio,
A_ORGANIZACION_HISTORIAL.fechaCambio,
A_ORGANIZACION_HISTORIAL.tipoMovimiento


FROM [dbo].[A_ORGANIZACION_HISTORIAL]";
    //llamo al metodo listar y le doy la variable CONSULTA
    $datos=$menu->listar($CONSULTA);
    //imprimir los datos en JSON
    print($datos);
    break;
  }
  
?>