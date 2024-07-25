<?php
  //llama al MenuModel
  require_once("../model/MenuModel.php");
  
  //declaro una variable para poder invocar a MenuModel
  $menu= new MenuModel();
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