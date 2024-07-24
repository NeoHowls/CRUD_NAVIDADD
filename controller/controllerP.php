<?php
session_start();
  //llama al MenuModel
  require_once("../model/MenuModel.php");

  require_once ("../model/MODEL_PERSONA.php");
  require_once ("../model/MODEL_PERSONAH.php");
  require_once ("../funciones.php");
  
  //declaro una variable para poder invocar a MenuModel
  $menu= new MenuModel();
  $per = new Personas();
  $perH= new PersonasH();

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
  $usuarioCambio = $_SESSION["nombre"];

  //Armo un GET "op" donde OP signific operacion
  switch($_GET["op"]){
   //en caso que llame el controller debo usar op y la opcionen, en esta caso solo es listar
  case "persona":
    //define la consulta
    $CONSULTA = "SELECT 
    P.id AS id, 
    P.dni AS dni, 
    P.nombre AS nombreP, 
    P.direccion AS direccion, 
    P.telefono AS telefono, 
    P.mail AS mail, 
    P.idPerfil AS idPerfil, 
    P.estado AS estadoP,
    CASE
        WHEN P.estado = 0 THEN 'DESACTIVADO'
        WHEN P.estado = 1 THEN 'ACTIVADO'
    END AS estadoPersona,
    P.usuario AS usuario, 
    P.contrasena AS contrasena, 
    P.checkHabilitado AS checkHabilitado,
    CASE
        WHEN P.checkHabilitado = 0 THEN 'DESHABILITADO'
        WHEN P.checkHabilitado = 1 THEN 'HABILITADO'
    END AS habilitado,
    P.checkOrganizacion,
    PO.idOrganizacion AS idOrganizacion,
	O.tipo AS tipo,
	CASE
			WHEN O.tipo= NULL THEN 'asd'
			WHEN O.tipo= 1 THEN 'JUNTA VECINAL'
			WHEN O.tipo= 2 THEN 'COMÍTE VIVIENDA'
			WHEN O.tipo= 3 THEN 'CONDOMINIO'
			WHEN O.tipo= 4 THEN 'PROVIDENCIA'	
	END AS organizacion,
	--ISNULL(O.tipo, 'no posee') AS Org,
    O.nombre AS NOMBRE_O,
    ISNULL(O.nombre, 'no posee') AS NOMBRE_O,
    PO.fechaIngreso AS fechaIngreso,
    PO.fechaTermino AS fechaTermino,
    PO.estado AS estado
FROM A_PERSONA P
JOIN A_DETALLE_PO PO ON P.id = PO.idPersona
JOIN A_ORGANIZACION O ON PO.idOrganizacion = O.id
WHERE PO.estado = 1

UNION

SELECT 
    P.id AS id, 
    P.dni AS dni, 
    P.nombre AS nombreP, 
    P.direccion AS direccion, 
    P.telefono AS telefono, 
    P.mail AS mail, 
    P.idPerfil AS idPerfil, 
    P.estado AS estadoP,
    CASE
        WHEN P.estado = 0 THEN 'DESACTIVADO'
        WHEN P.estado = 1 THEN 'ACTIVADO'
    END AS estadoPersona,
    P.usuario AS usuario, 
    P.contrasena AS contrasena, 
    P.checkHabilitado AS checkHabilitado,
    CASE
        WHEN P.checkHabilitado = 0 THEN 'DESHABILITADO'
        WHEN P.checkHabilitado = 1 THEN 'HABILITADO'
    END AS habilitado,
    P.checkOrganizacion,
    0 AS idOrganizacion,
	  null as tipo,
	  'DIDECO' AS tipo,
	  --null AS org,
    NULL AS nombre,
    'ADMINISTRACION' AS NOMBRE_O,
    NULL AS fechaIngreso,
    NULL AS fechaTermino,
    0 AS estado
FROM A_PERSONA P
WHERE P.checkOrganizacion = 0
ORDER BY idOrganizacion"; 
    //llamo al metodo listar y le doy la variable CONSULTA
    $datos=$menu->listar($CONSULTA);
    //imprimir los datos en JSON
    print($datos);
    break;
  
    
    case "add_persona":

      $respuesta = array();
      $i=0;
      $erut = '/^[0-9]{7,8}\-[0-9kK]{1}$/';
      $enombre = '/^[a-zA-Z ]+$/';
      $ecorreo = '/^[a-zA-Z0-9.!#$%&*+=?^_`{|}~-]+@[a-zA-Z0-9-]+\.(?:[a-zA-Z0-9-]+)*$/';
      $econtacto = '/^(?:\d{4}|\d{9})$/';

      if(verificarExpresion($dni,$erut)==false){
        $respuesta[$i]['action']='ERROR';
        $respuesta[$i]['error']=1;
        $respuesta[$i]['mensaje']='<p class="mensaje">Rut inválido debe incluir guión y dígito verificador</p>';
        $i++;
      }
      if(verificarExpresion($dni,$erut)==true){
        if(validadorRut($dni)==false){
            $respuesta[$i]['action']='ERROR';
            $respuesta[$i]['error']=1;
            $respuesta[$i]['mensaje']='<p class="mensaje">Rut inválido debe incluir guión y dígito verificador</p>';
            $i++;
        }
      }

      $resultado = $per->buscarPersona($dni,1);
      if(count($resultado)!=0){
        if(count($resultado)==1){
            $respuesta[$i]['action']='ERROR';
            $respuesta[$i]['error']=1;
            $respuesta[$i]['mensaje']='<p class="mensaje">RUT/DNI '.$resultado[0]['dni'].' se encuentra registrado</p>';
            $i++;
            //SELECT N.dni dni, O.nombre nombreOrganizacion FROM A_NINOS N
        }
    }


      if(verificarExpresion($nombre,$enombre)==false){
        $respuesta[$i]['action']='ERROR';
        $respuesta[$i]['error']=2;
        $respuesta[$i]['mensaje']='<p class="mensaje">Debe ingresar nombre</p>';
        $i++;
      }
      if($direccion=='' || $direccion==null){
        $respuesta[$i]['action']='ERROR';
        $respuesta[$i]['error']=3;
        $respuesta[$i]['mensaje']='<p class="mensaje">Debe ingresar Dirección</p>';
        $i++;
      }
      if(verificarExpresion($mail,$ecorreo)==false){
        $respuesta[$i]['action']='ERROR';
        $respuesta[$i]['error']=4;
        $respuesta[$i]['mensaje']='<p class="mensaje">Debe ingresar mail valido</p>';
        $i++;
      }
      if($telefono=='' || $telefono==null){
        $respuesta[$i]['action']='ERROR';
        $respuesta[$i]['error']=5;
        $respuesta[$i]['mensaje']='<p class="mensaje">Debe ingresar telefono</p>';
        $i++;
      }
      if($idPerfil=='' || $idPerfil==null){
        $respuesta[$i]['action']='ERROR';
        $respuesta[$i]['error']=6;
        $respuesta[$i]['mensaje']='<p class="mensaje">Debe seleccionar Perfil</p>';
        $i++;
      }
      
      if($checkOrganizacion==1){
        if($idOrganizacion=='' || $idOrganizacion==null){
          $respuesta[$i]['action']='ERROR';
          $respuesta[$i]['error']=7;
          $respuesta[$i]['mensaje']='<p class="mensaje">Debe seleccionar Organización</p>';
          $i++;
        }
      }
    if(count($respuesta)==0){

        $per->guardarPersona($dni, $nombre, $direccion, $telefono, $mail, $idPerfil, $usuario, $contrasena, $checkOrganizacion);
        if($per->getError()==0){
          // $per1=new Personas();
          $res= $per->buscarPersona($dni,1);
          // var_dump($res);
          if(count($res)==1 && $checkOrganizacion == 1){//!ingresa con organizacion
              $idPersona=$res[0]['id'];
              $per->guardarDPO($idPersona,intval($idOrganizacion),1);
              $perH->guardarPersonaH($dni, $nombre, $direccion, $telefono, $mail, $idPerfil, $checkOrganizacion, $usuario, $contrasena,'Añadir Usuario Nuevo con organizacion',$usuarioCambio);
              if($per->getError()==0){
                  $respuesta[$i]['action']="OK";
                  $respuesta[$i]['error']=0;
                  $respuesta[$i]['mensaje']="OK";
                  $i++;

                  echo json_encode($respuesta);
              }else{
                $respuesta[$i]['action']="ERROR";
                $respuesta[$i]['error']=99;
                $respuesta[$i]['mensaje']="ERROR BD Persona y PDO";
                $i++;
                echo json_encode($respuesta);
              }
          }else{//!ingresa sin organizacion
            $perH->guardarPersonaH($dni, $nombre, $direccion, $telefono, $mail, $idPerfil, $checkOrganizacion, $usuario, $contrasena,'Añadir Usuario Nuevo sin organizacion',$usuarioCambio);
              $respuesta[$i]['action']="OK";
              $respuesta[$i]['error']=0;
              $respuesta[$i]['mensaje']="OK";
              $i++;

              echo json_encode($respuesta);
          }  
        }else{
          $respuesta[$i]['action']="ERROR";
          $respuesta[$i]['error']=99;
          $respuesta[$i]['mensaje']="ERROR BD";
          $i++;
          echo json_encode($respuesta);

        }
    }
    else{
       //!errores
        echo json_encode($respuesta);
    }
    break; 

    case "edit_persona":

      $resultado = array();
      $respuesta = array();
      $i=0;
      $erut = '/^[0-9]{7,8}\-[0-9kK]{1}$/';
      $enombre = '/^[a-zA-Z ]+$/';
      $ecorreo = '/^[a-zA-Z0-9.!#$%&*+=?^_`{|}~-]+@[a-zA-Z0-9-]+\.(?:[a-zA-Z0-9-]+)*$/';
      $econtacto = '/^(?:\d{4}|\d{9})$/';

        if(verificarExpresion($dni,$erut)==false){
          $respuesta[$i]['action']='ERROR';
          $respuesta[$i]['error']=1;
          $respuesta[$i]['mensaje']='<p class="mensaje">Rut inválido debe incluir guión y dígito verificador</p>';
          $i++;
        }
        if(verificarExpresion($dni,$erut)==true){
          if(validadorRut($dni)==false){
              $respuesta[$i]['action']='ERROR';
              $respuesta[$i]['error']=1;
              $respuesta[$i]['mensaje']='<p class="mensaje">Rut inválido debe incluir guión y dígito verificador</p>';
              $i++;
          }
        }

      $resultado=$per->buscarPersonaIdDni($user_id,$dni,1);
      // var_dump($resultado);
      if(count($resultado)!=1){
        $resultado=$per->buscarPersona($dni,1);
      
        if(count($resultado)!=0){
            if(count($resultado)==1){
                $respuesta[$i]['action']='ERROR';
                $respuesta[$i]['error']=1;
                $respuesta[$i]['mensaje']='<p class="mensaje">RUT/DNI '.$resultado[0]['dni'].' se encuentra registrado </p>';
                $i++;
            }
        }
      }

      if(verificarExpresion($nombre,$enombre)==false){
        $respuesta[$i]['action']='ERROR';
        $respuesta[$i]['error']=2;
        $respuesta[$i]['mensaje']='<p class="mensaje">Debe ingresar nombre</p>';
        $i++;
      }
      if($direccion=='' || $direccion==null){
        $respuesta[$i]['action']='ERROR';
        $respuesta[$i]['error']=3;
        $respuesta[$i]['mensaje']='<p class="mensaje">Debe ingresar Dirección</p>';
        $i++;
      }
      if(verificarExpresion($mail,$ecorreo)==false){
        $respuesta[$i]['action']='ERROR';
        $respuesta[$i]['error']=4;
        $respuesta[$i]['mensaje']='<p class="mensaje">Debe ingresar mail valido</p>';
        $i++;
      }
      if($telefono=='' || $telefono==null){
        $respuesta[$i]['action']='ERROR';
        $respuesta[$i]['error']=5;
        $respuesta[$i]['mensaje']='<p class="mensaje">Debe ingresar telefono</p>';
        $i++;
      }
      if($idPerfil=='' || $idPerfil==null){
        $respuesta[$i]['action']='ERROR';
        $respuesta[$i]['error']=6;
        $respuesta[$i]['mensaje']='<p class="mensaje">Debe seleccionar Perfil</p>';
        $i++;
      }
      if($checkOrganizacion==1){
        if($idOrganizacion=='' || $idOrganizacion==null){
          $respuesta[$i]['action']='ERROR';
          $respuesta[$i]['error']=7;
          $respuesta[$i]['mensaje']='<p class="mensaje">Debe seleccionar Organización</p>';
          $i++;
        }
      }
      if($usuario=='' || $usuario==null){
        $respuesta[$i]['action']='ERROR';
        $respuesta[$i]['error']=8;
        $respuesta[$i]['mensaje']='<p class="mensaje">Debe ingresar usuario</p>';
        $i++;
      }
      if($contrasena=='' || $contrasena==null){
        $respuesta[$i]['action']='ERROR';
        $respuesta[$i]['error']=9;
        $respuesta[$i]['mensaje']='<p class="mensaje">Debe ingresar contrasena</p>';
        $i++;
      }
    if(count($respuesta)==0){
      if($checkOrganizacion == 1){
        $per->actualizarPersona($dni,$nombre,$direccion,
        $telefono,$mail,$idPerfil,$usuario,$contrasena,$user_id);
        $per->actualizarPDO($user_id);
        $per->guardarDPO($user_id,intval($idOrganizacion),1);
        $perH->guardarPersonaH($dni, $nombre, $direccion, $telefono, $mail, $idPerfil, $checkOrganizacion, $usuario, $contrasena,'Editar Usuario con organizacion',$usuarioCambio);
        if($per->getError()==0){
          $respuesta[$i]['action']="OK";
          $respuesta[$i]['error']=0;
          $respuesta[$i]['mensaje']="OK checko 1";
          $i++;

          echo json_encode($respuesta);
        }else{
          $respuesta[$i]['action']="ERROR";
          $respuesta[$i]['error']=99;
          $respuesta[$i]['mensaje']="ERROR BD";
          $i++;
          echo json_encode($respuesta);
        }
      }else{
        $per->actualizarPersona($dni,$nombre,$direccion,
        $telefono,$mail,$idPerfil,$usuario,$contrasena,$user_id);
        $perH->guardarPersonaH($dni, $nombre, $direccion, $telefono, $mail, $idPerfil, $checkOrganizacion, $usuario, $contrasena,'Editar Usuario sin organizacion',$usuarioCambio);
        if($per->getError()==0){
          $respuesta[$i]['action']="OK";
          $respuesta[$i]['error']=0;
          $respuesta[$i]['mensaje']="OK  checko 0";
          $i++;

          echo json_encode($respuesta);
        }else{
          $respuesta[$i]['action']="ERROR";
          $respuesta[$i]['error']=99;
          $respuesta[$i]['mensaje']="ERROR BD";
          $i++;
          echo json_encode($respuesta);
        }
      }
        
    }else{
      //!errores
      echo json_encode($respuesta);
    }

      break;
      
      case "borrar_persona":
        echo($estado);
        if($estado == 1){

          echo "funciona el if de editar";
          //define la consulta
          $CONSULTA = "UPDATE A_PERSONA SET checkHabilitado=0, estado=0 WHERE id='$user_id' and idPerfil !=7";
          //llamo al metodo listar y le doy la variable CONSULTA
          $datos=$menu->listar($CONSULTA);
            $CONSULTA = "SELECT * FROM A_PERSONA";
            //llamo al metodo listar y le doy la variable CONSULTA
            $datos=$menu->listar($CONSULTA);
            //imprimir los datos en JSON
            //print($datos);

            $usuarioCambio = $_SESSION["nombre"];
            $CONSULTA = "INSERT INTO A_PERSONA_HISTORIAL (dni,nombre,direccion,telefono,mail,idPerfil,estado,usuario,contrasena,usuarioCambio,fechaCambio,tipoMovimiento) values 
            ('$dni', '$nombre', '$direccion', '$telefono', '$mail', '$idPerfil', '$estado', '$usuario', '$contrasena','$usuarioCambio',getdate(),'Borrar persona (estado=0, checkHabilitado=0)')";
            $datos=$menu->listar($CONSULTA);
            $CONSULTA = "SELECT * FROM A_PERSONA_HISTORIAL";
            $datos=$menu->listar($CONSULTA);
            print($datos);
            
          } else {
            echo("este es el idPerfil");
            $CONSULTA = "SELECT idPerfil FROM A_PERSONA WHERE id='$user_id'";
            $datos = $menu->consultar($CONSULTA);
            $perfilId = $datos[0]['idPerfil'];
            echo($perfilId);
        
          if($perfilId==8){
  
          $CONSULTA = "UPDATE A_PERSONA SET checkHabilitado=1,estado=1 WHERE id='$user_id' and idPerfil !=1";
          //llamo al metodo listar y le doy la variable CONSULTA
          $datos=$menu->listar($CONSULTA);
            $CONSULTA = "SELECT * FROM A_PERSONA";
            //llamo al metodo listar y le doy la variable CONSULTA
            $datos=$menu->listar($CONSULTA);
          }else { 
            $CONSULTA = "SELECT idOrganizacion FROM A_DETALLE_PO WHERE idPersona='$user_id' AND estado=1";
            $datos = $menu->consultar($CONSULTA);
            $Org_id = $datos[0]['idOrganizacion'];
    
            $CONSULTA = "SELECT checkHabilitado FROM A_ORGANIZACION WHERE id='$Org_id'";
            $datos = $menu->consultar($CONSULTA);
            $Org_hab = $datos[0]['checkHabilitado'];
            echo($Org_id);
            echo($Org_hab);
    
            if ($Org_hab == 1) {
                $CONSULTA1 = "UPDATE A_PERSONA SET checkHabilitado = 1, estado=1 WHERE id='$user_id'";
                // Llama al método listar y le da la variable CONSULTA
                $menu->listar($CONSULTA1);
                $datos = $menu->listar($CONSULTA1);
                $CONSULTA = "SELECT * FROM A_PERSONA";
                // Llama al método listar y le da la variable CONSULTA
                $datos = $menu->listar($CONSULTA);
                // Imprimir los datos en JSON
                print($datos);

            $usuarioCambio = $_SESSION["nombre"];
            $CONSULTA = "INSERT INTO A_PERSONA_HISTORIAL (dni,nombre,direccion,telefono,mail,idPerfil,estado,checkHabilitado,usuario,contrasena,usuarioCambio,fechaCambio,tipoMovimiento) values 
            ('$dni', '$nombre', '$direccion', '$telefono', '$mail', '$idPerfil', '$estado', '$checkHabilitado', '$usuario', '$contrasena','$usuarioCambio',getdate(),'Activar Persona (estado=1, checkHabilitado=1)')";
            $datos=$menu->listar($CONSULTA);
            $CONSULTA = "SELECT * FROM A_PERSONA_HISTORIAL";
            $datos=$menu->listar($CONSULTA);
            print($datos);

            } else {
                // Enviar un mensaje JSON al frontend
                $response = array(
                    "status" => "error",
                    "message" => "La organización está deshabilitada."
                );
                print(json_encode($response));
            $usuarioCambio = $_SESSION["nombre"];
            $CONSULTA = "INSERT INTO A_PERSONA_HISTORIAL (dni,nombre,direccion,telefono,mail,idPerfil,estado,checkHabilitado,usuario,contrasena,usuarioCambio,fechaCambio,tipoMovimiento) values 
            ('$dni', '$nombre', '$direccion', '$telefono', '$mail', '$idPerfil', '$estado', '$checkHabilitado', '$usuario', '$contrasena','$usuarioCambio',getdate(),'Error, la organizacion esta deshabilitada')";
            $datos=$menu->listar($CONSULTA);
            $CONSULTA = "SELECT * FROM A_PERSONA_HISTORIAL";
            $datos=$menu->listar($CONSULTA);
            print($datos);
            
            }
          }
        }
        break;

  case "Habilitar_persona":
    //!deshabilitar web persona
    if($checkHabilitado == 1){
      $per->deshabilitarWebPersona($user_id);
      $perH->guardarPersonaH($dni, $nombre, $direccion, $telefono, $mail, $idPerfil, $checkOrganizacion, $usuario, $contrasena,'deshabilitar Persona con organizacion tabla',$usuarioCambio);
        if($per->getError()==0){
          $respuesta[$i]['action']="OK";
          $respuesta[$i]['error']=0;
          $respuesta[$i]['mensaje']="OK checko 1";
          $i++;

          echo json_encode($respuesta);
        }else{
          $respuesta[$i]['action']="ERROR";
          $respuesta[$i]['error']=99;
          $respuesta[$i]['mensaje']="ERROR BD";
          $i++;
          echo json_encode($respuesta);
        }
    }else{
        if($idPerfil==8){
          $per->habilitarWebPersona($user_id);
          $perH->guardarPersonaH($dni, $nombre, $direccion, $telefono, $mail, $idPerfil, $checkOrganizacion, $usuario, $contrasena,'habilitar Persona(DIDECO) sin organizacion tabla',$usuarioCambio);
            if($per->getError()==0){
              $respuesta[$i]['action']="OK";
              $respuesta[$i]['error']=0;
              $respuesta[$i]['mensaje']="OK checko 1";
              $i++;

              echo json_encode($respuesta);
            }else{
              $respuesta[$i]['action']="ERROR";
              $respuesta[$i]['error']=99;
              $respuesta[$i]['mensaje']="ERROR BD";
              $i++;
              echo json_encode($respuesta);
            }
        }else{
          $resultado=$per->buscarCheckHabilitadoOrg($idOrganizacion);
          if(count($resultado)==1){
            $per->habilitarWebPersona($user_id);
            $perH->guardarPersonaH($dni, $nombre, $direccion, $telefono, $mail, $idPerfil, $checkOrganizacion, $usuario, $contrasena,'habilitar Persona con organizacion tabla',$usuarioCambio);
              if($per->getError()==0){
                $respuesta[$i]['action']="OK";
                $respuesta[$i]['error']=0;
                $respuesta[$i]['mensaje']="OK checko 1";
                $i++;

                echo json_encode($respuesta);
              }else{
                $respuesta[$i]['action']="ERROR";
                $respuesta[$i]['error']=99;
                $respuesta[$i]['mensaje']="ERROR BD";
                $i++;
                echo json_encode($respuesta);
              }
          }else{
            $respuesta[$i]['action']="ERROR";
            $respuesta[$i]['error']=99;
            $respuesta[$i]['mensaje']="La organización está deshabilitada";
            $i++;
            echo json_encode($respuesta);
          }
        }
    }

      //!habilitar web personas
      /* else {
        echo("este es el idPerfil");
        $CONSULTA = "SELECT idPerfil FROM A_PERSONA WHERE id='$user_id'";
        $datos = $menu->consultar($CONSULTA);
        $perfilId = $datos[0]['idPerfil'];
        echo($perfilId);
        if($perfilId==8){
  
          $CONSULTA = "UPDATE A_PERSONA SET checkHabilitado=1 WHERE id='$user_id' and idPerfil !=1";
          //llamo al metodo listar y le doy la variable CONSULTA
          $datos=$menu->listar($CONSULTA);
            $CONSULTA = "SELECT * FROM A_PERSONA";
            //llamo al metodo listar y le doy la variable CONSULTA
            $datos=$menu->listar($CONSULTA);
          }else { 
        
            $CONSULTA = "SELECT idOrganizacion FROM A_DETALLE_PO WHERE idPersona='$user_id' AND estado=1";
            $datos = $menu->consultar($CONSULTA);
            $Org_id = $datos[0]['idOrganizacion'];
    
            $CONSULTA = "SELECT checkHabilitado FROM A_ORGANIZACION WHERE id='$Org_id'";
            $datos = $menu->consultar($CONSULTA);
            $Org_hab = $datos[0]['checkHabilitado'];
            echo($Org_id);
            echo($Org_hab);
    
            if ($Org_hab == 1) {
                $CONSULTA1 = "UPDATE A_PERSONA SET checkHabilitado = 1 WHERE id='$user_id'";
                // Llama al método listar y le da la variable CONSULTA
                $menu->listar($CONSULTA1);
                $datos = $menu->listar($CONSULTA1);
                $CONSULTA = "SELECT * FROM A_PERSONA";
                // Llama al método listar y le da la variable CONSULTA
                $datos = $menu->listar($CONSULTA);
                // Imprimir los datos en JSON
                print($datos);
    
                $usuarioCambio = $_SESSION["nombre"];
                $CONSULTA = "INSERT INTO A_PERSONA_HISTORIAL (dni,nombre,direccion,telefono,mail,idPerfil,estado,checkHabilitado,usuario,contrasena,usuarioCambio,fechaCambio,tipoMovimiento) values 
                ('$dni', '$nombre', '$direccion', '$telefono', '$mail', '$idPerfil', '$estado', '$checkHabilitado', '$usuario', '$contrasena','$usuarioCambio',getdate(),'Habilitar Persona (checkHabilitado=1)')";
                $datos=$menu->listar($CONSULTA);
                $CONSULTA = "SELECT * FROM A_PERSONA_HISTORIAL";
                $datos=$menu->listar($CONSULTA);
                print($datos);
    
            } else {
                // Enviar un mensaje JSON al frontend
                $response = array(
                    "status" => "error",
                    "message" => "La organización está deshabilitada."
                );
                print(json_encode($response));
    
                $usuarioCambio = $_SESSION["nombre"];
                $CONSULTA = "INSERT INTO A_PERSONA_HISTORIAL (dni,nombre,direccion,telefono,mail,idPerfil,estado,checkHabilitado,usuario,contrasena,usuarioCambio,fechaCambio,tipoMovimiento) values 
                ('$dni', '$nombre', '$direccion', '$telefono', '$mail', '$idPerfil', '$estado', '$checkHabilitado', '$usuario', '$contrasena','$usuarioCambio',getdate(),'Error, la organizacion esta deshabilitada')";
                $datos=$menu->listar($CONSULTA);
                $CONSULTA = "SELECT * FROM A_PERSONA_HISTORIAL";
                $datos=$menu->listar($CONSULTA);
                print($datos);
            }
        }
      } */
        break;


case "habGeneral":
  $personasId = array();
    $j=0;
  $respuesta= array();
    $i=0;
  $personasDeshabilitadasIds=array();
  $datos=$per->consultarNoHabilitar(); //los personas a no habilitar
  //echo json_encode($personasDeshabilitadasIds);
  if(count($datos)!=0){
    foreach($datos as $key => $value){
      $personasId[$j]=$value['idPersona'];
      $j++;
    }
    // echo json_encode(gettype($personasDeshabilitadasIds));
    // var_dump($personasId);
      $personasIdStr = implode(',', $personasId);
      // var_dump($personasIdStr);
      $per->habilitarGeneral($personasIdStr);
      // echo json_encode($per);
      if($per->getError()==0){
        $respuesta[$i]['action']="OK";
        $respuesta[$i]['error']=0;
        $respuesta[$i]['mensaje']="OK habilitar con organizaciones no activas";
        $respuesta[$i]['bandera']=2;
        $i++;
        echo json_encode($respuesta);
      }else{
        $respuesta[$i]['action']="ERROR";
        $respuesta[$i]['error']=99;
        $respuesta[$i]['mensaje']="ERROR BD";
        $i++;
        echo json_encode($respuesta);
      }
  }else{
    $per->habilitarGeneral("");
    if($per->getError()==0){
      $respuesta[$i]['action']="OK";
      $respuesta[$i]['error']=0;
      $respuesta[$i]['mensaje']="OK habilitar con organizaciones activas";
      $i++;
      echo json_encode($respuesta);
    }else{
      $respuesta[$i]['action']="ERROR";
      $respuesta[$i]['error']=99;
      $respuesta[$i]['mensaje']="ERROR BD";
      $i++;
      echo json_encode($respuesta);
    }
  }
  
  

  
   /* if (!empty($personasDeshabilitadasIds)){
      $personasDeshabilitadasIdsStr = implode(',', $personasDeshabilitadasIds);
      $per->habilitarGeneral($personasDeshabilitadasIdsStr);
      echo json_encode($personasDeshabilitadasIdsStr);
  }else{
    $per->habilitarGeneral($personasDeshabilitadasIdsStr);
    echo json_encode($personasDeshabilitadasIdsStr);
  }  */ 

  /* if($per->getError()==0){
    $respuesta[$i]['action']="OK";
    $respuesta[$i]['error']=0;
    $respuesta[$i]['mensaje']="OK";
    $i++;
    echo json_encode($respuesta);
}else{
  $respuesta[$i]['action']="ERROR";
  $respuesta[$i]['error']=99;
  $respuesta[$i]['mensaje']="ERROR BD";
  $i++;
  echo json_encode($respuesta);
} */

  /* // Obtener todas las organizaciones deshabilitadas
  $consultaOrganizaciones = "SELECT id FROM A_ORGANIZACION WHERE estado = 0 OR checkHabilitado = 0";
  $resultadoOrganizaciones = $menu->consultar($consultaOrganizaciones);

  if (count($resultadoOrganizaciones) > 0) {
      $organizacion_idP = array_column($resultadoOrganizaciones, 'id');
      
      // Obtener las personas asociadas a organizaciones deshabilitadas
      $consultaPersonasDeshabilitadas = "SELECT idPersona FROM A_DETALLE_PO WHERE estado =1 and idOrganizacion IN (" . implode(',', $organizacion_idP) . ")";
      $personasDeshabilitadas = $menu->consultar($consultaPersonasDeshabilitadas);
      $personasDeshabilitadasIds = array_column($personasDeshabilitadas, 'idPersona');
  

      // Excluir las personas con organizaciones deshabilitadas
      if (!empty($personasDeshabilitadasIds)) {
          $personasDeshabilitadasIdsStr = implode(',', $personasDeshabilitadasIds);
          $CONSULTA = "UPDATE A_PERSONA SET checkHabilitado = 1 WHERE idPerfil != 7 AND idPerfil != 8 AND id NOT IN ($personasDeshabilitadasIdsStr)";
          $datos=$menu->listar($CONSULTA);
      } else {
          // Si no hay personas deshabilitadas, habilitar a todas las personas elegibles
          $CONSULTA = "UPDATE A_PERSONA SET checkHabilitado = 1 WHERE idPerfil != 7 AND idPerfil != 8";
          $datos=$menu->listar($CONSULTA);
      }
  } else {
      // Si no hay organizaciones deshabilitadas, habilitar a todas las personas elegibles
      $CONSULTA = "UPDATE A_PERSONA SET checkHabilitado = 1 WHERE idPerfil != 7 AND idPerfil != 8";
      $datos=$menu->listar($CONSULTA);
  }

  $CONSULTA = "SELECT * FROM A_PERSONA";
  $datos = $menu->listar($CONSULTA);
  print($datos); // Cambiado print_r por echo json_encode */

break;

  case "DesHabGeneral": 
    $respuesta= array();
    $i=0;

        $per->DeshabilitarGeneral();    
        if($per->getError()==0){
          $respuesta[$i]['action']="OK";
          $respuesta[$i]['error']=0;
          $respuesta[$i]['mensaje']="OK";
          $i++;
          echo json_encode($respuesta);
      }else{
        $respuesta[$i]['action']="ERROR";
        $respuesta[$i]['error']=99;
        $respuesta[$i]['mensaje']="ERROR BD";
        $i++;
        echo json_encode($respuesta);
      }

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