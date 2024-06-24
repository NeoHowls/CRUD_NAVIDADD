<?php
  //llama al MenuModel
  require_once("../model/model_Perfil.php");
$menu= new MenuModelPerfil();




$datos=$menu->mostrarPerfil();

?>