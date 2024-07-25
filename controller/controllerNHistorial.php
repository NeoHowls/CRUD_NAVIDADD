<?php
  //llama al MenuModel
  require_once("../model/MenuModel.php");
  
  //declaro una variable para poder invocar a MenuModel
  $menu= new MenuModel();
  //Armo un GET "op" donde OP signific operacion
  switch($_GET["op"]){
   //en caso que llame el controller debo usar op y la opcionen, en esta caso solo es listar
  case "ninosH":
    //define la consulta
    $CONSULTA = "SELECT [id]
      ,[dni]
      ,[nombre]
      ,[sexo]
      ,[edad]
      ,[fechaNacimiento]
      ,[idNacionalidad]
      ,[idEtnia]
      ,[estado]
      ,[periodo]
      ,[checkCeguera]
      ,[checkSordera]
      ,[checkMudez]
      ,[checkFisica]
      ,[checkMental]
      ,[checkPsiquica]
      ,[descripcion]
      ,[idOrganizacion]
      ,[idPersonalRegistro]
      ,[fechaRegistro]
      ,[checkExtranjero]
      ,[checkDiscapacitado]
      ,[checkRSH]
      ,[porcentajeCeguera]
      ,[porcentajeSordera]
      ,[porcentajeMudez]
      ,[porcentajeFisica]
      ,[porcentajeMental]
      ,[porcentajePsiquica]
      ,[tipoMovimiento]
      ,[usuarioCambio]
      ,[fechaCambio]
  FROM [BD_NAVIDAD].[dbo].[A_NINOS_HISTORIAL]";
    //llamo al metodo listar y le doy la variable CONSULTA
    $datos=$menu->listar($CONSULTA);
    //imprimir los datos en JSON
    print($datos);
    break;
  }
  
?>