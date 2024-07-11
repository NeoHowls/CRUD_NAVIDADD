<?php
require_once("../model/model_Organizacion1.php");
$menu= new MenuModelOrganizacion();
if(isset($_POST['tipo'])){
    switch ($_POST['tipo']) {
        case 1:
            $tipo = "JUNTA VECINAL";
            break;
        case 2:
            $tipo = "COMITE";
            break;
        case 3:
            $tipo = "CONDOMINIO";
            break;
        case 4:
            $tipo = "PROVIDENCIA";
            break;
        case 99:
            echo "PERSONAL";
            break;
    }

   
    // $html="<option selected value=0 disabled>Sin Organizacion".$tipo."</option>";
    $html="<option disabled selected value=0 disabled>Seleccione Organización</option>";
    $datos=$menu->listarOrganizacionS($_POST['tipo']);

    foreach($datos as $key => $value){
        $html.='<option value="'.$value['id'].'">'.$value['nombre'].'</option>'; 
    }
    echo $html;
}else{
    $html="<option selected disabled value = 0>Sin Organización</option>";
    echo $html;
}
?>