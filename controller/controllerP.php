<?php
session_start();
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
  $checkHabilitado = (isset($_POST['checkHabilitado'])) ? $_POST['checkHabilitado'] : '';
  $usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
  $contrasena = (isset($_POST['contrasena'])) ? $_POST['contrasena'] : '';
  $checkOrganizacion=(isset($_POST['checkOrganizacion'])) ? $_POST['checkOrganizacion'] : '';
  $idOrganizacion=(isset($_POST['idOrganizacion'])) ? $_POST['idOrganizacion'] : '';
  $checkOrganizacion=intval($checkOrganizacion);
  $_SESSION["usuario"]= $usuario;
  $_SESSION["contrasena"]= $contrasena;

  //Armo un GET "op" donde OP signific operacion
  switch($_GET["op"]){
   //en caso que llame el controller debo usar op y la opcionen, en esta caso solo es listar
  case "persona":
    //define la consulta
    $CONSULTA = 
    "SELECT 
	  P.id as id, 
    P.dni as dni, 
    P.nombre as nombre, 
    P.direccion as direccion, 
    P.telefono as telefono, 
    P.mail as mail, 
    P.idPerfil as idPerfil, 
    P.estado as estadoP,
	CASE
			WHEN P.estado= 0 THEN 'DESACTIVADO'
			WHEN P.estado= 1 THEN 'ACTIVADO'
	END AS estadoPersona,
    P.usuario as usuario, 
    P.contrasena as contrasena, 
    P.checkHabilitado as checkHabilitado,
	CASE
			WHEN P.checkHabilitado= 0 THEN 'DESHABILITADO'
			WHEN P.checkHabilitado= 1 THEN 'HABILITADO'
	END AS habilitado,
	P.checkOrganizacion,
    PO.idOrganizacion as idOrganizacion, 
    O.nombre AS NOMBRE_O,
    PO.fechaIngreso as fechaIngreso,
	PO.fechaTermino as fechaTermino,
	PO.estado as estado
FROM A_PERSONA P
JOIN A_DETALLE_PO PO ON P.id=PO.idPersona
JOIN A_ORGANIZACION O ON PO.idOrganizacion=O.id
WHERE PO.estado=1
UNION
SELECT 
	P.id as id, 
    P.dni as dni, 
    P.nombre as nombre, 
    P.direccion as direccion, 
    P.telefono as telefono, 
    P.mail as mail, 
    P.idPerfil as idPerfil, 
    P.estado as estadoP, 
	CASE
			WHEN P.estado= 0 THEN 'DESACTIVADO'
			WHEN P.estado= 1 THEN 'ACTIVADO'
	END AS estadoPersona,
    P.usuario as usuario, 
    P.contrasena as contrasena, 
    P.checkHabilitado as checkHabilitado,
	CASE
			WHEN P.checkHabilitado= 0 THEN 'DESHABILITADO'
			WHEN P.checkHabilitado= 1 THEN 'HABILITADO'
	END AS habilitado,
	P.checkOrganizacion,
    idOrganizacion = 0, 
    NOMBRE_O = NULL,
    fechaIngreso = NULL,
	fechaTermino = NULL,
	estado = 0
FROM A_PERSONA P
WHERE P.checkOrganizacion=0"; 
    //llamo al metodo listar y le doy la variable CONSULTA
    $datos=$menu->listar($CONSULTA);
    //imprimir los datos en JSON
    print($datos);
    break;
  
    
    case "add_persona":
      echo ($_GET["op"]);
      if($checkOrganizacion == 1){
        echo "funciona el if de anadir";
      //define la consulta
      $CONSULTA = "INSERT INTO A_PERSONA (dni, nombre, direccion, telefono, mail, idPerfil, estado, usuario, contrasena,checkOrganizacion) 
      VALUES ('$dni', '$nombre', '$direccion', '$telefono', '$mail', '$idPerfil', '$estado', '$usuario', '$contrasena',1)";
      //llamo al metodo listar y le doy la variable CONSULTA

      $datos=$menu->listar($CONSULTA);
        $CONSULTA = "SELECT * FROM A_PERSONA";
        //llamo al metodo listar y le doy la variable CONSULTA
        $datos=$menu->listar($CONSULTA);
        //imprimir los datos en JSON
  
      //imprimir los datos en JSON
      
      $CONSULTA = "SELECT id FROM A_PERSONA WHERE dni='$dni'";
      $datos=$menu->consultar($CONSULTA);
      $user_id=$datos[0]['id'];
      $CONSULTA2 = "SELECT id,fechaIngreso  FROM A_ORGANIZACION WHERE id='$idOrganizacion'";
      $datos=$menu->consultar($CONSULTA2);
      $fechaIngreso=$datos[0]['fechaIngreso'];    
      $fechaIngreso = date('Y-m-d H:i');
      $dato_org=$menu->consultar($CONSULTA2);
      
      $CONSULTA ="INSERT INTO A_DETALLE_PO (idPersona, idOrganizacion, estado,fechaIngreso) VALUES ('$user_id','$idOrganizacion' , 1,'$fechaIngreso')";
      $menu->listar($CONSULTA);

      $usuarioCambio = $_SESSION["test"];
      $CONSULTAH = "INSERT INTO A_PERSONA_HISTORIAL (dni,nombre,direccion,telefono,mail,idPerfil,estado,usuario,contrasena,usuarioCambio,fechaCambio,tipoMovimiento) values 
      ('$dni', '$nombre', '$direccion', '$telefono', '$mail', '$idPerfil', '$estado', '$usuario', '$contrasena','$usuarioCambio',getdate(),'Añadir Usuario Nuevo con Organizacion')";
      $datos=$menu->listar($CONSULTAH);
      $CONSULTAH = "SELECT * FROM A_PERSONA_HISTORIAL";
      $datos=$menu->listar($CONSULTAH);
      print($datos);
      

        }else {
          echo "funciona el else de anadir";
          //define la consulta
      $CONSULTA = "INSERT INTO A_PERSONA (dni, nombre, direccion, telefono, mail, idPerfil, estado, usuario, contrasena) VALUES ('$dni', '$nombre', '$direccion', '$telefono', '$mail', '$idPerfil', '$estado', '$usuario', '$contrasena')";
      //llamo al metodo listar y le doy la variable CONSULTA
      $datos=$menu->listar($CONSULTA);
        $CONSULTA = "SELECT * FROM A_PERSONA";
        //llamo al metodo listar y le doy la variable CONSULTA
        $datos=$menu->listar($CONSULTA);
        //imprimir los datos en JSON
        print($datos);
      //imprimir los datos en JSON 

      $usuarioCambio = $_SESSION["test"];
      $CONSULTA = "INSERT INTO A_PERSONA_HISTORIAL (dni,nombre,direccion,telefono,mail,idPerfil,estado,usuario,contrasena,usuarioCambio,fechaCambio,tipoMovimiento) values 
      ('$dni', '$nombre', '$direccion', '$telefono', '$mail', '$idPerfil', '$estado', '$usuario', '$contrasena','$usuarioCambio',getdate(),'Añadir Usuario Nuevo Sin Organizacion')";
      $datos=$menu->listar($CONSULTA);
      $CONSULTA = "SELECT * FROM A_PERSONA_HISTORIAL";
      $datos=$menu->listar($CONSULTA);
      print($datos);
      

    }
    break;

        //edita 1 dato selecionable de la tabla A_ETNIA
    case "edit_persona":
      if($checkOrganizacion == 1){
        echo "funciona el if de editar";
      //define la consulta
      $CONSULTA = "UPDATE A_PERSONA SET dni = '$dni',nombre ='$nombre',direccion ='$direccion',telefono ='$telefono',mail ='$mail',
      idPerfil ='$idPerfil',estado = '$estado',usuario ='$usuario',contrasena ='$contrasena', checkOrganizacion=1 WHERE id='$user_id'";
      //llamo al metodo listar y le doy la variable CONSULTA
      $datos=$menu->listar($CONSULTA);
        $CONSULTA = "SELECT * FROM A_PERSONA";
        //llamo al metodo listar y le doy la variable CONSULTA
        $datos=$menu->listar($CONSULTA);
        //imprimir los datos en JSON
        //print($datos);
      $CONSULTA = "SELECT id FROM A_PERSONA WHERE dni='$dni'";
      $datos=$menu->listar($CONSULTA);
      $user_id=$datos[0]['id'];
      $CONSULTA2 = "SELECT id,fechaIngreso  FROM A_ORGANIZACION WHERE id='$idOrganizacion'";
      $datos=$menu->listar($CONSULTA2);
      $fechaIngreso=$datos[0]['fechaIngreso'];    
      $fechaIngreso = date('Y-m-d H:i');

      $dato_org=$menu->listar($CONSULTA2);

      $CONSULTA="UPDATE A_DETALLE_PO SET estado=0,fechaTermino='$fechaIngreso' WHERE idPersona='$user_id'";
      $menu->listar($CONSULTA);

      $CONSULTA ="INSERT INTO A_DETALLE_PO (idPersona, idOrganizacion, estado,fechaIngreso) VALUES ('$user_id','$idOrganizacion' , 1,'$fechaIngreso')";
      $menu->listar($CONSULTA);

      $usuarioCambio = $_SESSION["test"];
      $CONSULTA = "INSERT INTO A_PERSONA_HISTORIAL (dni,nombre,direccion,telefono,mail,idPerfil,estado,usuario,contrasena,usuarioCambio,fechaCambio,tipoMovimiento) values 
      ('$dni', '$nombre', '$direccion', '$telefono', '$mail', '$idPerfil', '$estado', '$usuario', '$contrasena','$usuarioCambio',getdate(),'Editar Usuario con Organizacion')";
      $datos=$menu->listar($CONSULTA);
      $CONSULTA = "SELECT * FROM A_PERSONA_HISTORIAL";
      $datos=$menu->listar($CONSULTA);
      print($datos);
      
 

      }else {
        $CONSULTA1 = "UPDATE A_PERSONA SET dni = '$dni',nombre ='$nombre',direccion ='$direccion',telefono ='$telefono',mail ='$mail',idPerfil ='$idPerfil'
        ,estado = '$estado',usuario ='$usuario',contrasena ='$contrasena',checkOrganizacion=0 WHERE id='$user_id'";
      //llamo al metodo listar y le doy la variable CONSULTA
        $fechaIngreso = date('Y-m-d H:i');
        $CONSULTA="UPDATE A_DETALLE_PO SET estado=0,fechaTermino='$fechaIngreso' WHERE idPersona='$user_id'";
        $menu->listar($CONSULTA1);
        $datos=$menu->listar($CONSULTA);
        $CONSULTA = "SELECT * FROM A_PERSONA";
        //llamo al metodo listar y le doy la variable CONSULTA
        $datos=$menu->listar($CONSULTA);
        //imprimir los datos en JSON
         print($datos);

         $usuarioCambio = $_SESSION["test"];
        $CONSULTA = "INSERT INTO A_PERSONA_HISTORIAL (dni,nombre,direccion,telefono,mail,idPerfil,estado,usuario,contrasena,usuarioCambio,fechaCambio,tipoMovimiento) values 
        ('$dni', '$nombre', '$direccion', '$telefono', '$mail', '$idPerfil', '$estado', '$usuario', '$contrasena','$usuarioCambio',getdate(),'Editar Usuario Sin Organizacion')";
        $datos=$menu->listar($CONSULTA);
        $CONSULTA = "SELECT * FROM A_PERSONA_HISTORIAL";
        $datos=$menu->listar($CONSULTA);
        print($datos);

      }

      break;
      case "borrar_persona":
        echo($estado);
        if($estado == 1){
          echo "funciona el if de editar";
        //define la consulta
        $CONSULTA = "UPDATE A_PERSONA SET estado = 0 WHERE id='$user_id'";
        //llamo al metodo listar y le doy la variable CONSULTA
        $datos=$menu->listar($CONSULTA);
          $CONSULTA = "SELECT * FROM A_PERSONA";
          //llamo al metodo listar y le doy la variable CONSULTA
          $datos=$menu->listar($CONSULTA);
          //imprimir los datos en JSON
          //print($datos);
  
        $usuarioCambio = $_SESSION["test"];
        $CONSULTA = "INSERT INTO A_PERSONA_HISTORIAL (dni,nombre,direccion,telefono,mail,idPerfil,estado,usuario,contrasena,usuarioCambio,fechaCambio,tipoMovimiento) values 
        ('$dni', '$nombre', '$direccion', '$telefono', '$mail', '$idPerfil', '$estado', '$usuario', '$contrasena','$usuarioCambio',getdate(),'Eliminar Usuario')";
        $datos=$menu->listar($CONSULTA);
        $CONSULTA = "SELECT * FROM A_PERSONA_HISTORIAL";
        $datos=$menu->listar($CONSULTA);
        print($datos);
        
   
        
        }else {
          $CONSULTA1 = "UPDATE A_PERSONA SET estado = 1 WHERE id='$user_id'";
        //llamo al metodo listar y le doy la variable CONSULTA
          $menu->listar($CONSULTA1);
          $datos=$menu->listar($CONSULTA1);
          $CONSULTA = "SELECT * FROM A_PERSONA";
          //llamo al metodo listar y le doy la variable CONSULTA
          $datos=$menu->listar($CONSULTA);
          //imprimir los datos en JSON
           print($datos);
  
           $usuarioCambio = $_SESSION["test"];
          $CONSULTA = "INSERT INTO A_PERSONA_HISTORIAL (dni,nombre,direccion,telefono,mail,idPerfil,estado,usuario,contrasena,usuarioCambio,fechaCambio,tipoMovimiento) values 
          ('$dni', '$nombre', '$direccion', '$telefono', '$mail', '$idPerfil', '$estado', '$usuario', '$contrasena','$usuarioCambio',getdate(),'Activar nuevamente a un usuario')";
          $datos=$menu->listar($CONSULTA);
          $CONSULTA = "SELECT * FROM A_PERSONA_HISTORIAL";
          $datos=$menu->listar($CONSULTA);
          print($datos);
    
  }
  break;

  case "Habilitar_persona":
    echo($checkHabilitado);
    if($checkHabilitado == 1){
      echo "funciona el if de editar";
      
    //define la consulta
    $CONSULTA = "UPDATE A_PERSONA SET checkHabilitado = 0 WHERE id='$user_id'";
    //llamo al metodo listar y le doy la variable CONSULTA
    $datos=$menu->listar($CONSULTA);
      $CONSULTA = "SELECT * FROM A_PERSONA";
      //llamo al metodo listar y le doy la variable CONSULTA
      $datos=$menu->listar($CONSULTA);
      //imprimir los datos en JSON
      //print($datos);

    $usuarioCambio = $_SESSION["test"];
    $CONSULTA = "INSERT INTO A_PERSONA_HISTORIAL (dni,nombre,direccion,telefono,mail,idPerfil,estado,usuario,contrasena,usuarioCambio,fechaCambio,tipoMovimiento) values 
    ('$dni', '$nombre', '$direccion', '$telefono', '$mail', '$idPerfil', '$estado', '$usuario', '$contrasena','$usuarioCambio',getdate(),'Deshabilitar a un  Usuario')";
    $datos=$menu->listar($CONSULTA);
    $CONSULTA = "SELECT * FROM A_PERSONA_HISTORIAL";
    $datos=$menu->listar($CONSULTA);
    print($datos);
    

    
    }else {
      $CONSULTA1 = "UPDATE A_PERSONA SET checkHabilitado = 1 WHERE id='$user_id'";
    //llamo al metodo listar y le doy la variable CONSULTA
      $menu->listar($CONSULTA1);
      $datos=$menu->listar($CONSULTA1);
      $CONSULTA = "SELECT * FROM A_PERSONA";
      //llamo al metodo listar y le doy la variable CONSULTA
      $datos=$menu->listar($CONSULTA);
      //imprimir los datos en JSON
       print($datos);

       $usuarioCambio = $_SESSION["test"];
      $CONSULTA = "INSERT INTO A_PERSONA_HISTORIAL (dni,nombre,direccion,telefono,mail,idPerfil,estado,usuario,contrasena,usuarioCambio,fechaCambio,tipoMovimiento) values 
      ('$dni', '$nombre', '$direccion', '$telefono', '$mail', '$idPerfil', '$estado', '$usuario', '$contrasena','$usuarioCambio',getdate(),'Habilitar nuevamente a un usuario')";
      $datos=$menu->listar($CONSULTA);
      $CONSULTA = "SELECT * FROM A_PERSONA_HISTORIAL";
      $datos=$menu->listar($CONSULTA);
      print($datos);

}
break;


case "habGeneral":
  //define la consulta
  $CONSULTA = "UPDATE A_PERSONA SET checkHabilitado = 1 WHERE idPerfil !=1 ";
  //llamo al metodo listar y le doy la variable CONSULTA
  $datos=$menu->listar($CONSULTA);
    $CONSULTA = "SELECT * FROM A_PERSONA";
    //llamo al metodo listar y le doy la variable CONSULTA
    $datos=$menu->listar($CONSULTA);
    //imprimir los datos en JSON
    print($datos);

  $usuarioCambio = $_SESSION["test"];
  $CONSULTA = "INSERT INTO A_PERSONA_HISTORIAL (dni,nombre,direccion,telefono,mail,idPerfil,estado,usuario,contrasena,usuarioCambio,fechaCambio,tipoMovimiento) values 
  ('$dni', '$nombre', '$direccion', '$telefono', '$mail', '$idPerfil', '$estado', '$usuario', '$contrasena','$usuarioCambio',getdate(),'Deshabilitar a un  Usuario')";
  $datos=$menu->listar($CONSULTA);
  $CONSULTA = "SELECT * FROM A_PERSONA_HISTORIAL";
  $datos=$menu->listar($CONSULTA);
  
  break;

  case "DesHabGeneral": 
    //define la consulta
    $CONSULTA = "UPDATE A_PERSONA SET checkHabilitado = 0 WHERE idPerfil !=1 ";
    //llamo al metodo listar y le doy la variable CONSULTA
    $datos=$menu->listar($CONSULTA);
    $CONSULTA = "SELECT * FROM A_PERSONA";
      //llamo al metodo listar y le doy la variable CONSULTA
    $datos=$menu->listar($CONSULTA);
    print($datos);
      //imprimir los datos en JSON
      //print($datos);
  
    $usuarioCambio = $_SESSION["test"];
    $CONSULTA = "INSERT INTO A_PERSONA_HISTORIAL (dni,nombre,direccion,telefono,mail,idPerfil,estado,usuario,contrasena,usuarioCambio,fechaCambio,tipoMovimiento) values 
    ('$dni', '$nombre', '$direccion', '$telefono', '$mail', '$idPerfil', '$estado', '$usuario', '$contrasena','$usuarioCambio',getdate(),'Deshabilitar a un  Usuario')";
    $datos=$menu->listar($CONSULTA);
    $CONSULTA = "SELECT * FROM A_PERSONA_HISTORIAL";
    $datos=$menu->listar($CONSULTA);
    
  
    break;

    case "imprimir": 
      ?>
      <script type="text/javascript"> 
        Swal.fire({
        title: "Do you want to save the changes?",
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: "Save",
        denyButtonText: `Don't save`
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          window.open("../crearPdf.php");
        } else if (result.isDenied) {
          Swal.fire("Changes are not saved", "", "info");
        }
      });


        window.open("../crearPdf.php");
        </script> 
      <?php

      // include_once("../crearPdf.php");
      
      break;
  }
  
?>