<?php
  //llama al MenuModel
  require_once("../model/MenuModel.php");
  
  //declaro una variable para poder invocar a MenuModel
  $menu= new MenuModel();
  $persona = (isset($_POST['persona'])) ? $_POST['persona'] : '';
  $user_id = (isset($_POST['user_id'])) ? $_POST['user_id'] : '';
  $dni = (isset($_POST['dni'])) ? $_POST['dni'] : '';
  $nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
  $direccion = (isset($_POST['direccion'])) ? $_POST['direccion'] : '';
  $telefono = (isset($_POST['telefono'])) ? $_POST['telefono'] : '';
  $mail = (isset($_POST['mail']))? $_POST['mail'] : '';
  $idPerfil = (isset($_POST['idPerfil'])) ? $_POST['idPerfil'] : '';
  $estado = (isset($_POST['estado'])) ? $_POST['estado'] : '';
  $usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
  $contrasena = (isset($_POST['contrasena'])) ? $_POST['contrasena'] : '';
  $checkOrganizacion=(isset($_POST['checkOrganizacion'])) ? $_POST['checkOrganizacion'] : '';
  $id_org=(isset($_POST['id_org'])) ? $_POST['id_org'] : '';


  //Armo un GET "op" donde OP signific operacion
  switch($_GET["op"]){
   //en caso que llame el controller debo usar op y la opcionen, en esta caso solo es listar
  case "persona":
    //define la consulta
    $CONSULTA = "SELECT  
A_PERSONA.id,
A_PERSONA.dni,
A_PERSONA.nombre,
A_PERSONA.direccion,
A_PERSONA.telefono,
A_PERSONA.mail,
A_PERSONA.idPerfil,
A_PERSONA.estado,
A_PERSONA.usuario,
A_PERSONA.contrasena


FROM [dbo].[A_PERSONA]";
    //llamo al metodo listar y le doy la variable CONSULTA
    $datos=$menu->listar($CONSULTA);
    //imprimir los datos en JSON
    print($datos);
    break;
  
    case "add_persona":

        if($checkOrganizacion=1){
      //define la consulta

      $CONSULTA = "INSERT INTO A_PERSONA (dni, nombre, direccion, telefono, mail, idPerfil, estado, usuario, contrasena) VALUES ('$dni', '$nombre', '$direccion', '$telefono', '$mail', '$idPerfil', '$estado', '$usuario', '$contrasena')";
      //llamo al metodo listar y le doy la variable CONSULTA

      $datos=$menu->listar($CONSULTA);
        $CONSULTA = "SELECT * FROM A_PERSONA";
        //llamo al metodo listar y le doy la variable CONSULTA
        $datos=$menu->listar($CONSULTA);
        //imprimir los datos en JSON
  
      //imprimir los datos en JSON
      
      $CONSULTA = "SELECT id FROM A_PERSONA WHERE dni='$dni'";
      $datos=$menu->array_conver($CONSULTA);
      $user_id=$datos[0]['id'];
      $CONSULTA2 = "SELECT id,fechaIngreso  FROM A_ORGANIZACION WHERE id='$id_org'";
      $dato_org=$menu->array_conver($CONSULTA2);
      $CONSULTA ="INSERT INTO A_DETALLE_PO (idPersona, idOrganizacion, estado) VALUES ('$user_id','$id_org' , 1)";
      $menu->listar($CONSULTA);
      

        }else {
          //define la consulta
 
      $CONSULTA = "INSERT INTO A_PERSONA (dni, nombre, direccion, telefono, mail, idPerfil, estado, usuario, contrasena) VALUES ('$dni', '$nombre', '$direccion', '$telefono', '$mail', '$idPerfil', '$estado', '$usuario', '$contrasena')";
      //llamo al metodo listar y le doy la variable CONSULTA
      echo $persona;
      $datos=$menu->listar($CONSULTA);
        $CONSULTA = "SELECT * FROM A_PERSONA";
        //llamo al metodo listar y le doy la variable CONSULTA
        $datos=$menu->listar($CONSULTA);
        //imprimir los datos en JSON
        print($datos);
      //imprimir los datos en JSON  
        }

        //edita 1 dato selecionable de la tabla A_ETNIA
    case "edit_persona":
      //define la consulta
      echo $persona;
      $CONSULTA = "UPDATE A_PERSONA SET dni = '$dni',nombre ='$nombre',direccion ='$direccion',telefono ='$telefono',mail ='$mail',idPerfil ='$idPerfil',estado = '$estado',usuario ='$usuario',contrasena ='$contrasena' WHERE id='$user_id'";
      //llamo al metodo listar y le doy la variable CONSULTA
      echo $persona;
      $datos=$menu->listar($CONSULTA);
        $CONSULTA = "SELECT * FROM A_PERSONA";
        //llamo al metodo listar y le doy la variable CONSULTA
        $datos=$menu->listar($CONSULTA);
        //imprimir los datos en JSON
        print($datos);
      break;
  }
  
?>