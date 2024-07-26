<?php
session_start();
  //llama al MenuModel
  //require_once("../model/MenuModel.php");

  require_once ("../model/MODEL_PERSONA.php");
  require_once ("../model/MODEL_PERSONAH.php");
  require_once ("../model/MODEL_ORG.php");
  require_once ("../funciones.php");
  
  //declaro una variable para poder invocar a MenuModel
  //$menu= new MenuModel();
  $per = new Personas();
  $perH = new PersonasH();
  $perO = new Organizaciones();

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
    $datos=$per->listarPersonas();
    // var_dump($datos);
    print($datos);
    break;
  
 //todo: agregar persona   
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


      /* if(verificarExpresion($nombre,$enombre)==false){
        $respuesta[$i]['action']='ERROR';
        $respuesta[$i]['error']=2;
        $respuesta[$i]['mensaje']='<p class="mensaje">Debe ingresar nombre</p>';
        $i++;
      } */
      if($nombre=='' || $nombre==null){
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
              $perH->guardarPersonaH($dni, $nombre, $direccion, $telefono, $mail, $idPerfil, $checkOrganizacion, $usuario, $contrasena,$checkHabilitado,$estado,'Añadir Usuario Nuevo con organizacion',$usuarioCambio);
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
            $perH->guardarPersonaH($dni, $nombre, $direccion, $telefono, $mail, $idPerfil, $checkOrganizacion, $usuario, $contrasena,$checkHabilitado,$estado,'Añadir Usuario Nuevo sin organizacion',$usuarioCambio);
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
//todo: Editar persona-------------------------------------------------
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
        $perH->guardarPersonaH($dni, $nombre, $direccion, $telefono, $mail, $idPerfil, $checkOrganizacion, $usuario, $contrasena,$checkHabilitado,$estado,'Editar Usuario con organizacion',$usuarioCambio);
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
        $perH->guardarPersonaH($dni, $nombre, $direccion, $telefono, $mail, $idPerfil, $checkOrganizacion, $usuario, $contrasena,$checkHabilitado,$estado,'Editar Usuario sin organizacion',$usuarioCambio);
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
//todo: desactivar/activar persona----------------------------------------------      
      case "borrar_persona":
        $resultado = array();
      $respuesta = array();
      $i=0;
    //!desactivar persona
    if($estado == 1){
      $per->desactivarPersona($user_id);
      $perH->guardarPersonaH($dni, $nombre, $direccion, $telefono, $mail, $idPerfil, $checkOrganizacion, $usuario, $contrasena,$checkHabilitado,$estado,'deshabilitar Persona WEB ',$usuarioCambio);
        if($per->getError()==0){
          $respuesta[$i]['action']="OK";
          $respuesta[$i]['error']=0;
          $respuesta[$i]['mensaje']="Desactivar Persona";
          $i++;

          echo json_encode($respuesta);
        }else{
          $respuesta[$i]['action']="ERROR";
          $respuesta[$i]['error']=99;
          $respuesta[$i]['mensaje']="ERROR BD";
          $i++;
          echo json_encode($respuesta);
        }
    //!activar persona
    }else{
        if($idPerfil==8){

              $per->activarPersona($user_id);
              $perH->guardarPersonaH($dni, $nombre, $direccion, $telefono, $mail, $idPerfil, $checkOrganizacion, $usuario, $contrasena,$checkHabilitado,$estado,'habilitar Persona(DIDECO) sin organizacion WEB',$usuarioCambio);
                if($per->getError()==0){
                  $respuesta[$i]['action']="OK";
                  $respuesta[$i]['error']=0;
                  $respuesta[$i]['mensaje']="Activar Persona(DIDECO)";
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

              $resultado=$perO->buscarCheckHabilitadoOrg($idOrganizacion);
              if($resultado[0]['checkHabilitado']==1){
                $per->activarPersona($user_id);
                $perH->guardarPersonaH($dni, $nombre, $direccion, $telefono, $mail, $idPerfil, $checkOrganizacion, $usuario, $contrasena,$checkHabilitado,$estado,'habilitar Persona con organizacion WEB',$usuarioCambio);
                  if($per->getError()==0){
                    $respuesta[$i]['action']="OK";
                    $respuesta[$i]['error']=0;
                    $respuesta[$i]['mensaje']="Activar Persona";
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
                $respuesta[$i]['mensaje']="La organización está desactivada";
                $i++;
                echo json_encode($respuesta);
              }
        }
    }
        break;

//todo: habilitar y deshabilitar persona
  case "Habilitar_persona":
      $resultado = array();
      $respuesta = array();
      $i=0;
    //!deshabilitar web persona
    if($checkHabilitado == 1){
      $per->deshabilitarWebPersona($user_id);
      $perH->guardarPersonaH($dni, $nombre, $direccion, $telefono, $mail, $idPerfil, $checkOrganizacion, $usuario, $contrasena,$checkHabilitado,$estado,'deshabilitar Persona WEB ',$usuarioCambio);
        if($per->getError()==0){
          $respuesta[$i]['action']="OK";
          $respuesta[$i]['error']=0;
          $respuesta[$i]['mensaje']="Deshabilitar Persona WEB";
          $i++;

          echo json_encode($respuesta);
        }else{
          $respuesta[$i]['action']="ERROR";
          $respuesta[$i]['error']=99;
          $respuesta[$i]['mensaje']="ERROR BD";
          $i++;
          echo json_encode($respuesta);
        }
    //!habilitar web persona
    }else{
        if($idPerfil==8){
          if($estado==1){
              $per->habilitarWebPersona($user_id);
              $perH->guardarPersonaH($dni, $nombre, $direccion, $telefono, $mail, $idPerfil, $checkOrganizacion, $usuario, $contrasena,$checkHabilitado,$estado,'habilitar Persona(DIDECO) sin organizacion WEB',$usuarioCambio);
                if($per->getError()==0){
                  $respuesta[$i]['action']="OK";
                  $respuesta[$i]['error']=0;
                  $respuesta[$i]['mensaje']="Habilitar Persona(DIDECO) sin organizacion WEB";
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
              $respuesta[$i]['mensaje']="Persona debe estar activa para habilitar WEB";
              $i++;
              echo json_encode($respuesta);
          }
        }else{
          if($estado==1){
              $resultado=$perO->buscarCheckHabilitadoOrg($idOrganizacion);
              if($resultado[0]['checkHabilitado']==1){
                $per->habilitarWebPersona($user_id);
                $perH->guardarPersonaH($dni, $nombre, $direccion, $telefono, $mail, $idPerfil, $checkOrganizacion, $usuario, $contrasena,$checkHabilitado,$estado,'habilitar Persona con organizacion WEB',$usuarioCambio);
                  if($per->getError()==0){
                    $respuesta[$i]['action']="OK";
                    $respuesta[$i]['error']=0;
                    $respuesta[$i]['mensaje']="Habilitar Persona con organizacion WEB";
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
           }else{
            $respuesta[$i]['action']="ERROR";
            $respuesta[$i]['error']=99;
            $respuesta[$i]['mensaje']="Persona debe estar activa para habilitar WEB";
            $i++;
            echo json_encode($respuesta);
           }
        }
    }
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
      $perH->guardarPersonaHG('Habilitar todas las Personas con organizaciones activas',$usuarioCambio);
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
    $perH->guardarPersonaHG('Habilitar todas las Personas',$usuarioCambio);
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
  break;

  case "DesHabGeneral": 
    $respuesta= array();
    $i=0;

        $per->DeshabilitarGeneral();
        $perH->guardarPersonaHG('Deshabilitar todas las Personas',$usuarioCambio);    
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