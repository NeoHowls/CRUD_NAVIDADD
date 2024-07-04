<?php
  //llama al MenuModel
  require_once("../model/model_Organizacion1.php");
$menu= new MenuModelOrganizacion();




$datos=$menu->mostrarOrganizacion();

?>