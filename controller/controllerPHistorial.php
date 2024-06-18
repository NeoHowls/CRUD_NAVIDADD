<?php
  //llama al MenuModel
  require_once("../model/MenuModel.php");
  
  //declaro una variable para poder invocar a MenuModel
  $menu= new MenuModel();
  $persona = (isset($_POST['persona'])) ? $_POST['persona'] : '';
  $user_id = (isset($_POST['user_id'])) ? $_POST['user_id'] : '';
  $dni = (isset($_POST['dni'])) ? $_POST['dni'] : '';
  $nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
  $direccion = (isset($_POST['direccion'])) ? $_POST['direccion'] : '';
  $telefono = (isset($_POST['telefono'])) ? $_POST['telefono'] : '';
  $mail = (isset($_POST['mail']))? $_POST['mail'] : '';
  $idPerfil = (isset($_POST['idPerfil'])) ? $_POST['idPerfil'] : '';
  $estado = (isset($_POST['estado'])) ? $_POST['estado'] : '';
  $usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
  $contrasena = (isset($_POST['contrasena'])) ? $_POST['contrasena'] : '';
  $checkOrganizacion=(isset($_POST['checkOrganizacion'])) ? $_POST['checkOrganizacion'] : '';
  $id_org=(isset($_POST['id_org'])) ? $_POST['id_org'] : '';
  $checkHabilitado=(isset($_POST['checkHabilitado'])) ? $_POST['checkHabilitado'] : '';
  $usuarioCambio=(isset($_POST['usuarioCambio'])) ? $_POST['usuarioCambio'] : '';
  $fechaCambio=(isset($_POST['fechaCambio'])) ? $_POST['fechaCambio'] : '';
  $tipoMovimiento=(isset($_POST['tipoMovimiento'])) ? $_POST['tipoMovimiento'] : '';

  //Armo un GET "op" donde OP signific operacion
  switch($_GET["op"]){
   //en caso que llame el controller debo usar op y la opcionen, en esta caso solo es listar
  case "personaH":
    //define la consulta
    $CONSULTA = "SELECT  
A_PERSONA_HISTORIAL.id,
A_PERSONA_HISTORIAL.dni,
A_PERSONA_HISTORIAL.nombre,
A_PERSONA_HISTORIAL.direccion,
A_PERSONA_HISTORIAL.telefono,
A_PERSONA_HISTORIAL.mail,
A_PERSONA_HISTORIAL.idPerfil,
A_PERSONA_HISTORIAL.estado,
A_PERSONA_HISTORIAL.usuario,
A_PERSONA_HISTORIAL.contrasena,
A_PERSONA_HISTORIAL.checkHabilitado,
A_PERSONA_HISTORIAL.usuarioCambio,
A_PERSONA_HISTORIAL.fechaCambio,
A_PERSONA_HISTORIAL.tipoMovimiento


FROM [dbo].[A_PERSONA_HISTORIAL]";
    //llamo al metodo listar y le doy la variable CONSULTA
    $datos=$menu->listar($CONSULTA);
    //imprimir los datos en JSON
    print($datos);
    break;
  }
  
?>