<?php
  //llama al MenuModel
  require_once("../model/model_Organizacion.php");
$menu= new MenuModel();




$datos=$menu->mostrarOrganizacion();
?>