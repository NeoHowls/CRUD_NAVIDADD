<?php
session_start();
  //llama al MenuModel
  require_once("../model/MenuModel.php");

  require_once("../model/MODEL_ORG.php");
  require_once("../model/MODEL_ORGH.php");
  require_once("../model/MODEL_PERSONA.php");
  require_once ("../funciones.php");

  $org = new Organizaciones();
  $orgH = new OrganizacionesH();
  $per = new Personas();

  
  //declaro una variable para poder invocar a MenuModel
  $menu= new MenuModel();
  $organizacion = (isset($_POST['organizacion'])) ? $_POST['organizacion'] : '';
  $user_id = (isset($_POST['user_id'])) ? $_POST['user_id'] : '';
  $nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
  $direccion = (isset($_POST['direccion'])) ? $_POST['direccion'] : '';
  $tipo = (isset($_POST['tipo'])) ? $_POST['tipo'] : '';
  $fechaIngreso = (isset($_POST['fechaIngreso'])) ? $_POST['fechaIngreso'] : '';
  $aniosVigente = (isset($_POST['aniosVigente'])) ? $_POST['aniosVigente'] : '';
  $checkVigente = (isset($_POST['checkVigente'])) ? $_POST['checkVigente'] : '';
  $numProvidencia = (isset($_POST['numProvidencia'])) ? $_POST['numProvidencia'] : '';
  $checkHabilitado = (isset($_POST['checkHabilitado'])) ? $_POST['checkHabilitado'] : '';
  $estado = (isset($_POST['estado'])) ? $_POST['estado'] : '';
  
  $fechaIngreso = date('Y-m-d H:i:s');
  
  $usuarioCambio = $_SESSION["nombre"];

  echo ($aniosVigente);
  //Armo un GET "op" donde OP signific operacion
  switch($_GET["op"]){
   //en caso que llame el controller debo usar op y la opcionen, en esta caso solo es listar
  case "organizacion":
    $datos = $org->listarOrganizaciones();
    /* $CONSULTA = "SELECT O.id AS id,
    O.nombre AS nombre,
    O.direccion AS direccion,
    O.tipo AS tipo,
	CASE
			WHEN O.tipo= 1 THEN 'JUNTA VECINAL'
			WHEN O.tipo= 2 THEN 'COMÍTE VIVIENDA'
			WHEN O.tipo= 3 THEN 'CONDOMINIO'
			WHEN O.tipo= 4 THEN 'PROVIDENCIA'
	END AS organizacion,
    O.fechaIngreso AS fechaIngreso,
    O.checkVigente AS checkVigente,
    O.numProvidencia AS numProvidencia,
    O.checkHabilitado AS checkHabilitado,
    CASE
        WHEN O.checkHabilitado = 0 THEN 'DESHABILITADA'
        WHEN O.checkHabilitado = 1 THEN 'HABILITADA'
    END AS habilitado,
    O.estado AS estado,
  DO.aniosVigente AS aniosVigente,
  vigente = 'VIGENTE'
FROM A_ORGANIZACION O
JOIN A_DETALLE_ORGANIZACION DO ON O.id=idOrganizacion
WHERE DO.estado=1 AND O.checkVigente=1
UNION
SELECT O.id AS id,
    O.nombre AS nombre,
    O.direccion AS direccion,
    O.tipo AS tipo,
	CASE
			WHEN O.tipo= 1 THEN 'JUNTA VECINAL'
			WHEN O.tipo= 2 THEN 'COMÍTE VIVIENDA'
			WHEN O.tipo= 3 THEN 'CONDOMINIO'
			WHEN O.tipo= 4 THEN 'PROVIDENCIA'	
	END AS organizacion,
    O.fechaIngreso AS fechaIngreso,
    O.checkVigente AS checkVigente,
    O.numProvidencia AS numProvidencia,
    O.checkHabilitado AS checkHabilitado,
    CASE
        WHEN O.checkHabilitado = 0 THEN 'DESHABILITADA'
        WHEN O.checkHabilitado = 1 THEN 'HABILITADA'
    END AS habilitado,
    O.estado AS estado,
  aniosVigente=0,
  vigente = 'NO VIGENTE'
FROM A_ORGANIZACION O WHERE O.checkVigente=0
ORDER BY tipo";
    //llamo al metodo listar y le doy la variable CONSULTA
    $datos=$menu->listar($CONSULTA); */
    //imprimir los datos en JSON
    print($datos);
    break;
    
    case "add_organizacion":
        $resultado = array();
        $respuesta = array();
        $i=0;

        if($nombre=='' || $nombre==null){
          $respuesta[$i]['action']='ERROR';
          $respuesta[$i]['error']=1;
          $respuesta[$i]['mensaje']='<p class="mensaje">Debe ingresar nombre</p>';
          $i++;
        }
        $resultado=$org->buscarOrganizacion($nombre,1);
        if(count($resultado)!=0){
            if(count($resultado)==1){
              $respuesta[$i]['action']='ERROR';
              $respuesta[$i]['error']=1;
              $respuesta[$i]['mensaje']='<p class="mensaje">Nombre de la Organización '.$resultado[0]['nombre'].' se encuentra registrado.</p>';
              $i++;
            }else{
              $respuesta[$i]['action']='ERROR';
              $respuesta[$i]['error']=1;
              $respuesta[$i]['mensaje']='<p class="mensaje">Nombre de la Organización '.$resultado[0]['nombre'].' se encuentra repetida.</p>';
              $i++;
            }
        }
        if($direccion=='' || $direccion==null){
          $respuesta[$i]['action']='ERROR';
          $respuesta[$i]['error']=2;
          $respuesta[$i]['mensaje']='<p class="mensaje">Debe ingresar Dirección</p>';
          $i++;
        }
        if($tipo=='' || $tipo==null){
          $respuesta[$i]['action']='ERROR';
          $respuesta[$i]['error']=3;
          $respuesta[$i]['mensaje']='<p class="mensaje">Debe seleccionar Tipo de Organización</p>';
          $i++;
        }

        if($tipo==4){//providencia
          if($numProvidencia=='' || $numProvidencia==null){
            $respuesta[$i]['action']='ERROR';
            $respuesta[$i]['error']=5;
            $respuesta[$i]['mensaje']='<p class="mensaje">Debe ingresar Numero de Providencia</p>';
            $i++;
          }
        }
        // var_dump($respuesta);
        if($tipo==4){$vigencia=1;
        }else{ $vigencia=4;}
        
        
        if(count($respuesta)==0){

            $fechaActual = date('Y-m-d H:i:s');
            $fechaProceso = strtotime('+ '.$vigencia.' year', strtotime($fechaActual));
            $fechaVencimiento = date ('Y-m-d H:i:s',$fechaProceso);
            // echo($fechaVencimiento);

            $org->guardarOrganizacion($nombre, $direccion, $tipo, $numProvidencia);
            $resultado=$org->buscarOrganizacion($nombre,1);
            $idOrganizacion=$resultado[0]['id'];

            // $fechaVencimiento = date('Y-m-d', strtotime("+{$vigencia} year", strtotime($fechaIngreso)));
            /* $fechaActual = date('Y-m-d H:i:s');
            $fechaVencimiento = strtotime('+ '.$vigencia.' year', strtotime($fechaActual));
            var_dump($fechaVencimiento); */
            $org->guardarDO($idOrganizacion,$fechaVencimiento,$vigencia);

            $orgH->guardarOrganizacionH(
              $nombre, $direccion,$tipo, $fechaIngreso, 1, 
              $numProvidencia,'Agregar Organización',$usuarioCambio,1,1);
              if($org->getError()==0 && $orgH->getError()==0){
                $respuesta[$i]['action']="OK";
                $respuesta[$i]['error']=0;
                $respuesta[$i]['mensaje']="Agregar Organización";
                $i++;
                echo json_encode($respuesta, JSON_PRETTY_PRINT);
            }elseif($orgH->getError()!=0){
                $respuesta[$i]['action']="ERROR";
                $respuesta[$i]['error']=99;
                $respuesta[$i]['mensaje']="ERROR BD HISTORIAL";
                $i++;
                echo json_encode($respuesta, JSON_PRETTY_PRINT);
            }else{
                $respuesta[$i]['action']="ERROR";
                $respuesta[$i]['error']=99;
                $respuesta[$i]['mensaje']="ERROR BD";
                $i++;
                echo json_encode($respuesta, JSON_PRETTY_PRINT);
            }
        }else{
            //!errores
            echo json_encode($respuesta);
        }

    break; 
    //todo: EDITAR ORGANIZACION
    case "edit_organizacion":
      $resultado = array();
      $respuesta = array();
      $i=0;

      // var_dump($nombre);
      if($nombre=='' || $nombre==null){
        $respuesta[$i]['action']='ERROR';
        $respuesta[$i]['error']=1;
        $respuesta[$i]['mensaje']='<p class="mensaje">Debe ingresar nombre</p>';
        $i++;
      }

      $resultado=$org->buscarOrganizacionIdNombre($user_id,$nombre,1);
      // var_dump($resultado);
      if(count($resultado)!=1){
        $resultado=$org->buscarOrganizacion($nombre,1);
        //var_dump($resultado);
        if(count($resultado)!=0){
            if(count($resultado)==1){
                $respuesta[$i]['action']='ERROR';
                $respuesta[$i]['error']=1;
                $respuesta[$i]['mensaje']='<p class="mensaje">Nombre '.$resultado[0]['nombre'].' se encuentra registrado </p>';
                $i++;
            }
        }
      }
      if($direccion=='' || $direccion==null){
        $respuesta[$i]['action']='ERROR';
        $respuesta[$i]['error']=2;
        $respuesta[$i]['mensaje']='<p class="mensaje">Debe ingresar Dirección</p>';
        $i++;
      }
      if($tipo=='' || $tipo==null){
        $respuesta[$i]['action']='ERROR';
        $respuesta[$i]['error']=3;
        $respuesta[$i]['mensaje']='<p class="mensaje">Debe seleccionar Tipo de Organización</p>';
        $i++;
      }

      if($tipo==4){//providencia
        if($numProvidencia=='' || $numProvidencia==null){
          $respuesta[$i]['action']='ERROR';
          $respuesta[$i]['error']=5;
          $respuesta[$i]['mensaje']='<p class="mensaje">Debe ingresar Numero de Providencia</p>';
          $i++;
        }
      }
      // var_dump($respuesta);
      if($tipo==4){$vigencia=1;
      }else{ $vigencia=4;}

      if(count($respuesta)==0){
            $org->actualizarOrganizacion($user_id, $nombre, $direccion, $tipo, $numProvidencia);
            $orgH->guardarOrganizacionH($nombre, $direccion, $tipo, $fechaIngreso, $checkVigente, 
            $numProvidencia,'Organizacion actualizada',
            $usuarioCambio,$checkHabilitado,$estado);
          if($org->getError()==0 && $orgH->getError()==0){
              $respuesta[$i]['action']="OK";
              $respuesta[$i]['error']=0;
              $respuesta[$i]['mensaje']="Actualizar Organización";
              $i++;
              echo json_encode($respuesta, JSON_PRETTY_PRINT);
          }elseif($orgH->getError()!=0){
              $respuesta[$i]['action']="ERROR";
              $respuesta[$i]['error']=99;
              $respuesta[$i]['mensaje']="ERROR BD HISTORIAL";
              $i++;
              echo json_encode($respuesta, JSON_PRETTY_PRINT);
          }else{
              $respuesta[$i]['action']="ERROR";
              $respuesta[$i]['error']=99;
              $respuesta[$i]['mensaje']="ERROR BD";
              $i++;
              echo json_encode($respuesta, JSON_PRETTY_PRINT);
          }
      }else{
            //!errores
            echo json_encode($respuesta);
      }
    break;
    //todo: DESHABILITA OPCION WEB DE LA PERSONA Y LA ORGANIZACION      
    case "Habilitar_organizacion":
        $respuesta= array();
        $i=0;
        $personasId = array();
        $j=0;
      if($checkHabilitado == 1){
        $datos=$org->consultarDeshabilitarPorOrg($user_id);
        if(count($datos)!=0){
            foreach($datos as $key => $value){
              $personasId[$j]=$value['idPersona'];
              $j++;
            }
            $personasIdStr = implode(',', $personasId);
            $per->deshabilitarPorOrganizacion($personasIdStr);
            $org->deshabilitarWebOrg($user_id);
            $orgH->guardarOrganizacionH($nombre, $direccion, 
              $tipo, $fechaIngreso, $checkVigente, 
              $numProvidencia,'Organizacion deshabilitada y Personas Correspondientes',$usuarioCambio,$checkHabilitado,$estado);
            if($org->getError()==0 && $orgH->getError()==0){
                $respuesta[$i]['action']="OK";
                $respuesta[$i]['error']=0;
                $respuesta[$i]['mensaje']="Organizacion deshabilitada y Personas Correspondientes";
                $i++;
                echo json_encode($respuesta, JSON_PRETTY_PRINT);
            }elseif($orgH->getError()!=0){
                $respuesta[$i]['action']="ERROR";
                $respuesta[$i]['error']=99;
                $respuesta[$i]['mensaje']="ERROR BD HISTORIAL";
                $i++;
                echo json_encode($respuesta, JSON_PRETTY_PRINT);
            }else{
                $respuesta[$i]['action']="ERROR";
                $respuesta[$i]['error']=99;
                $respuesta[$i]['mensaje']="ERROR BD";
                $i++;
                echo json_encode($respuesta, JSON_PRETTY_PRINT);
            }
        }else{
            $org->deshabilitarWebOrg($user_id);
            $orgH->guardarOrganizacionH($nombre, $direccion, 
              $tipo, $fechaIngreso, $checkVigente, 
              $numProvidencia,'Organizacion deshabilitada',$usuarioCambio,$checkHabilitado,$estado);
            if($org->getError()==0 && $orgH->getError()==0){
                $respuesta[$i]['action']="OK";
                $respuesta[$i]['error']=0;
                $respuesta[$i]['mensaje']="Organizacion deshabilitada";
                $i++;
                echo json_encode($respuesta, JSON_PRETTY_PRINT);
            }elseif($orgH->getError()!=0){
                $respuesta[$i]['action']="ERROR";
                $respuesta[$i]['error']=99;
                $respuesta[$i]['mensaje']="ERROR BD HISTORIAL";
                $i++;
                echo json_encode($respuesta, JSON_PRETTY_PRINT);
            }else{
                $respuesta[$i]['action']="ERROR";
                $respuesta[$i]['error']=99;
                $respuesta[$i]['mensaje']="ERROR BD";
                $i++;
                echo json_encode($respuesta, JSON_PRETTY_PRINT);
            }
        }
      }else{
        if($estado==1){
          $org->habilitarWebOrg($user_id);
          $orgH->guardarOrganizacionH($nombre, $direccion, 
            $tipo, $fechaIngreso, $checkVigente, 
            $numProvidencia,'Organizacion habilitadas',$usuarioCambio,$checkHabilitado,$estado);
          if($org->getError()==0 && $orgH->getError()==0){
              $respuesta[$i]['action']="OK";
              $respuesta[$i]['error']=0;
              $respuesta[$i]['mensaje']="Organizacion habilitada";
              $i++;
              echo json_encode($respuesta, JSON_PRETTY_PRINT);
          }elseif($orgH->getError()!=0){
              $respuesta[$i]['action']="ERROR";
              $respuesta[$i]['error']=99;
              $respuesta[$i]['mensaje']="ERROR BD HISTORIAL";
              $i++;
              echo json_encode($respuesta, JSON_PRETTY_PRINT);
          }else{
              $respuesta[$i]['action']="ERROR";
              $respuesta[$i]['error']=99;
              $respuesta[$i]['mensaje']="ERROR BD";
              $i++;
              echo json_encode($respuesta, JSON_PRETTY_PRINT);
          }
        }else{
          $respuesta[$i]['action']="ERROR";
          $respuesta[$i]['error']=99;
          $respuesta[$i]['mensaje']="Organizacion debe estar activa para habilitar WEB";
          $i++;
          echo json_encode($respuesta);
      }
      }
    break;//! final habilitar y deshabilitar org
    //todo: ACTIVA Y DESACTIVA LA ORGANIZACION Y SUS RESPECTIVAS PERSONAS 
    case "borrar_organizacion":
        $respuesta= array();
        $i=0;
        $personasId = array();
        $j=0;
      if($estado == 1){
        $datos=$org->consultarDeshabilitarPorOrg($user_id);
        if(count($datos)!=0){
            foreach($datos as $key => $value){
              $personasId[$j]=$value['idPersona'];
              $j++;
            }
            $personasIdStr = implode(',', $personasId);
            $per->desactivarPorOrganizacion($personasIdStr);
            $org->desactivarOrg($user_id);
            $orgH->guardarOrganizacionH($nombre, $direccion, 
              $tipo, $fechaIngreso, $checkVigente, 
              $numProvidencia,'Organizacion desactivada y Personas Correspondientes',$usuarioCambio,$checkHabilitado,$estado);
            if($org->getError()==0 && $orgH->getError()==0){
                $respuesta[$i]['action']="OK";
                $respuesta[$i]['error']=0;
                $respuesta[$i]['mensaje']="Organizacion desactivada y Personas Correspondientes";
                $i++;
                echo json_encode($respuesta, JSON_PRETTY_PRINT);
            }elseif($orgH->getError()!=0){
                $respuesta[$i]['action']="ERROR";
                $respuesta[$i]['error']=99;
                $respuesta[$i]['mensaje']="ERROR BD HISTORIAL";
                $i++;
                echo json_encode($respuesta, JSON_PRETTY_PRINT);
            }else{
                $respuesta[$i]['action']="ERROR";
                $respuesta[$i]['error']=99;
                $respuesta[$i]['mensaje']="ERROR BD";
                $i++;
                echo json_encode($respuesta, JSON_PRETTY_PRINT);
            }
        }else{
            $org->desactivarOrg($user_id);
            $orgH->guardarOrganizacionH($nombre, $direccion, 
              $tipo, $fechaIngreso, $checkVigente, 
              $numProvidencia,'Organizacion desactivada',$usuarioCambio,$checkHabilitado,$estado);
            if($org->getError()==0 && $orgH->getError()==0){
                $respuesta[$i]['action']="OK";
                $respuesta[$i]['error']=0;
                $respuesta[$i]['mensaje']="Organizacion desactivada";
                $i++;
                echo json_encode($respuesta, JSON_PRETTY_PRINT);
            }elseif($orgH->getError()!=0){
                $respuesta[$i]['action']="ERROR";
                $respuesta[$i]['error']=99;
                $respuesta[$i]['mensaje']="ERROR BD HISTORIAL";
                $i++;
                echo json_encode($respuesta, JSON_PRETTY_PRINT);
            }else{
                $respuesta[$i]['action']="ERROR";
                $respuesta[$i]['error']=99;
                $respuesta[$i]['mensaje']="ERROR BD";
                $i++;
                echo json_encode($respuesta, JSON_PRETTY_PRINT);
            }
        }
      }else{
        $org->activarOrg($user_id);
        $orgH->guardarOrganizacionH($nombre, $direccion, 
          $tipo, $fechaIngreso, $checkVigente, 
          $numProvidencia,'Organizacion activada',$usuarioCambio,$checkHabilitado,$estado);
        if($org->getError()==0 && $orgH->getError()==0){
            $respuesta[$i]['action']="OK";
            $respuesta[$i]['error']=0;
            $respuesta[$i]['mensaje']="Organizacion activada";
            $i++;
            echo json_encode($respuesta, JSON_PRETTY_PRINT);
        }elseif($orgH->getError()!=0){
            $respuesta[$i]['action']="ERROR";
            $respuesta[$i]['error']=99;
            $respuesta[$i]['mensaje']="ERROR BD HISTORIAL";
            $i++;
            echo json_encode($respuesta, JSON_PRETTY_PRINT);
        }else{
            $respuesta[$i]['action']="ERROR";
            $respuesta[$i]['error']=99;
            $respuesta[$i]['mensaje']="ERROR BD";
            $i++;
            echo json_encode($respuesta, JSON_PRETTY_PRINT);
        }
      }
    break;//! final activar y desactivar org
    //todo: HABILITAR GENERAL ORGANIZACION
    case "habGeneralO":
      $respuesta= array();
      $i=0;
      $personasId = array();
      $j=0;

      $org->habilitarGeneral();
      $orgH->guardarOrganizacionHG('Habilitar Todas las Organizaciones',$usuarioCambio,$checkHabilitado);
      if($org->getError()==0 && $orgH->getError()==0){
        $respuesta[$i]['action']="OK";
        $respuesta[$i]['error']=0;
        $respuesta[$i]['mensaje']="Habilitar Todas las Organizaciones";
        $i++;
        echo json_encode($respuesta);
      }elseif($orgH->getError()!=0){
        $respuesta[$i]['action']="ERROR";
        $respuesta[$i]['error']=99;
        $respuesta[$i]['mensaje']="ERROR BD HISTORIAL";
        $i++;
        echo json_encode($respuesta);
      }else{
        $respuesta[$i]['action']="ERROR";
        $respuesta[$i]['error']=99;
        $respuesta[$i]['mensaje']="ERROR BD";
        $i++;
        echo json_encode($respuesta);
      }
    break;//! final habilitar general org
    //todo: DESHABILITAR GENERAL ORGANIZACION
    case "DesHabGeneralO": 
        //define la consulta

        $respuesta= array();
        $i=0;
        $personasId = array();
        $j=0;

        $datos=$org->consultarDeshabilitar();
        if(count($datos)!=0){
            foreach($datos as $key => $value){
              $personasId[$j]=$value['idPersona'];
              $j++;
            }
            $personasIdStr = implode(',', $personasId);
            $per->deshabilitarPorOrganizacion($personasIdStr);
            $org->DeshabilitarGeneral();
            
            $orgH->guardarOrganizacionHG('Deshabilitar Todas las Organizaciones',$usuarioCambio,$checkHabilitado);

            if($org->getError()==0 && $orgH->getError()==0){
              $respuesta[$i]['action']="OK";
              $respuesta[$i]['error']=0;
              $respuesta[$i]['mensaje']="Todas las Organizaciones deshabilitadas y Personas Correspondientes";
              $i++;
              echo json_encode($respuesta);
            }elseif($orgH->getError()!=0){
              $respuesta[$i]['action']="ERROR";
              $respuesta[$i]['error']=99;
              $respuesta[$i]['mensaje']="ERROR BD HISTORIAL";
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
          $org->DeshabilitarGeneral();
          $orgH->guardarOrganizacionHG('Deshabilitar Todas las Organizaciones',$usuarioCambio,$checkHabilitado);
          if($org->getError()==0  && $orgH->getError()==0){
            $respuesta[$i]['action']="OK";
            $respuesta[$i]['error']=0;
            $respuesta[$i]['mensaje']="Todas las organizaciones deshabilitadas";
            $i++;
            echo json_encode($respuesta);
          }elseif($orgH->getError()!=0){
            $respuesta[$i]['action']="ERROR";
            $respuesta[$i]['error']=99;
            $respuesta[$i]['mensaje']="ERROR BD HISTORIAL";
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
    break;//! final deshabilitar general org
  }
  
?>