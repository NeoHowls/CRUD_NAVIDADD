<?php
  //llama al MenuModel
  require_once("../model/model.php");
$menu= new MenuModel();




$datos=$menu->loginPersonal();
?>
