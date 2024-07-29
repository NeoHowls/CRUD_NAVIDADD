<?php
require_once ("../correo.php");
require_once ("../funciones.php");
switch($_GET["op"]){
    case "enviarCorreo":
        $nombre = $_POST['nombre'];
        $correo = $_POST['mail'];
        $telefono = $_POST['telefono'];
        $mensaje = $_POST['mensaje'];

        $respuesta = array();
        $i=0;

        if($nombre=='' || $nombre==NULL){
            $respuesta[$i]['action']='ERROR';
            $respuesta[$i]['error']=1;
            $respuesta[$i]['mensaje']='<p class="mensaje">Debe ingresar nombre</p>';
            $i++;
        }
        if($correo=='' || $correo==NULL){
            $respuesta[$i]['action']='ERROR';
            $respuesta[$i]['error']=2;
            $respuesta[$i]['mensaje']='<p class="mensaje">Debe ingresar correo</p>';
            $i++;
        }
        if($telefono=='' || $telefono==NULL){
            $respuesta[$i]['action']='ERROR';
            $respuesta[$i]['error']=3;
            $respuesta[$i]['mensaje']='<p class="mensaje">Debe ingresar telefono</p>';
            $i++;
        }
        if($mensaje=='' || $mensaje==NULL){
            $respuesta[$i]['action']='ERROR';
            $respuesta[$i]['error']=4;
            $respuesta[$i]['mensaje']='<p class="mensaje">Debe ingresar mensaje</p>';
            $i++;
        }
        if(count($respuesta)==0){
            $correo = enviarCorreo($nombre,$correo,$telefono,$mensaje);
            if($correo==1){
                $respuesta[$i]['action']="OK";
                $respuesta[$i]['error']=0;
                $respuesta[$i]['mensaje']="OK";
                $i++;
                echo json_encode($respuesta);
            }else{
                $respuesta[$i]['action']="ERROR";
                $respuesta[$i]['error']=99;
                $respuesta[$i]['mensaje']="ERROR ENVIO CORREO";
                $i++;
                echo json_encode($respuesta);
            }
    
        }else{
            echo json_encode($respuesta);
        }    
    break;
}

?>