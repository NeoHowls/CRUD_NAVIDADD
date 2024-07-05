<?php
require_once("../model/model_Organizacion1.php");
$menu= new MenuModelOrganizacion();
if(isset($_POST['codigo_area'])){
    switch ($_POST['codigo_area']) {
        case 1:
            $area = "JUNTA VECINAL";
            break;
        case 2:
            $area = "COMITE";
            break;
        case 3:
            $area = "CONDOMINIO";
            break;
        case 4:
            $area = "PROVIDENCIA";
            break;
        case 99:
            echo "PERSONAL";
            break;
    }

   
    $html="<option selected value=0>Mostrar todo de ".$area."</option>";
    $datos=$menu->listarDireccionesS($_POST['codigo_area']);

    foreach($datos as $key => $value){
        $html.='<option value="'.$value['id'].'">'.$value['nombre'].'</option>'; 
    }
    echo $html;
}else{
    $html="<option selected disabled value = 0>Sin</option>";
    echo $html;
}
?>