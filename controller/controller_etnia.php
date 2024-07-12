<?php
//llama al MenuModel
require_once("../model/MODEL_ETNIA.php");
/* $menu= new MenuModelEtnia();

$datos=$menu->loginPersonal(); */

$etnia = new Etnia();
$datos = $etnia->listarEtnia();


?>
