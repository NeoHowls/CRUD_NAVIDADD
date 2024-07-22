<?php
  //llama al MenuModel
  // require_once("../model/MenuModel.php");
  require_once ("../model/MODEL_NINOS.php");

  require_once ("../funciones.php");

  session_start();
    
  //declaro una variable para poder invocar a MenuModel
  
  $idNino = (isset($_POST['idNino'])) ? $_POST['idNino'] : '';
  $dni = (isset($_POST['dni'])) ? $_POST['dni'] : '';
  $nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
  $sexo = (isset($_POST['sexo'])) ? $_POST['sexo'] : '';
  $edad = (isset($_POST['edad'])) ? $_POST['edad'] : '';
  $periodo = (isset($_POST['periodo'])) ? $_POST['periodo'] : '';
  
  $naciemiento = (isset($_POST['naciemiento'])) ? $_POST['naciemiento'] : '';
  // $comuna = (isset($_POST['comuna'])) ? $_POST['comuna'] : '';
  //!check discapacidad
  $check_dis = (isset($_POST['check_dis'])) ? $_POST['check_dis'] : '';
  $ceguera = (isset($_POST['ceguera'])) ? $_POST['ceguera'] : '';
  $sordera = (isset($_POST['sordera'])) ? $_POST['sordera'] : '';
  $mudez = (isset($_POST['mudez'])) ? $_POST['mudez'] : '';
  $fisica = (isset($_POST['fisica'])) ? $_POST['fisica'] : '';
  $mental = (isset($_POST['mental'])) ? $_POST['mental'] : '';
  $psiquica = (isset($_POST['psiquica'])) ? $_POST['psiquica'] : '';
  
  $ceguera_p = (isset($_POST['ceguera_p'])) ? $_POST['ceguera_p'] : '';
  $sordera_p = (isset($_POST['sordera_p'])) ? $_POST['sordera_p'] : '';
  $mudez_p = (isset($_POST['mudez_p'])) ? $_POST['mudez_p'] : '';
  $fisica_p = (isset($_POST['fisica_p'])) ? $_POST['fisica_p'] : '';
  $mental_p = (isset($_POST['mental_p'])) ? $_POST['mental_p'] : '';
  $psiquica_p = (isset($_POST['psiquica_p'])) ? $_POST['psiquica_p'] : '';

  $descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : '';

  //!check nacionalidad
  $check_nac = (isset($_POST['check_nac'])) ? $_POST['check_nac'] : '';
  $nacion = (isset($_POST['nacion'])) ? $_POST['nacion'] : '';

  $usuario_id = $_SESSION['id_persona'];
  $organizacion = (isset($_POST['organizacion'])) ? $_POST['organizacion'] : '';
  $etnia = (isset($_POST['etnia'])) ? $_POST['etnia'] : '';

/*   $fechaIngreso = date('Y-m-d H:i:s', strtotime($fechaIngreso));
  $fechaTermino = date('Y-m-d H:i:s', strtotime($fechaTermino)); */


  
  //Armo un GET "op" donde OP signific operacion
  switch($_GET["op"]){
   //en caso que llame el controller debo usar op y la opcionen, en esta caso solo es listar
   case "eliminarNino":
        $ninos= new Ninos();

        $respuesta = array();
        $i=0;
        
        $id = $_POST['id'];
        $datos=$ninos->eliminarNino($id);

        if($ninos->getError()==0){
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
   //! agregar nino 
  //  case "add_etnia":
    case "agregarNino":

      $respuesta = array();
      $i=0;
      $erut = '/^[0-9]{7,8}\-[0-9kK]{1}$/';
      $enombre = '/^[a-zA-Z ]+$/';

      $ninos= new Ninos();
      
      if($check_nac==0){
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
          $resultado=$ninos->buscarNinoDniPeriodo($dni,$periodo,1);
          
          if(count($resultado)!=0){
              if(count($resultado)==1){
                  $respuesta[$i]['action']='ERROR';
                  $respuesta[$i]['error']=1;
                  $respuesta[$i]['mensaje']='<p class="mensaje">RUT/DNI '.$resultado[0]['dni'].' se encuentra registrado en '. $resultado[0]['nombreOrganizacion'] .'</p>';
                  $i++;
                  //SELECT N.dni dni, O.nombre nombreOrganizacion FROM A_NINOS N
              }
          }
          $nacion=1;//chile
      }else{
          if($nacion=='' || $nacion==null || $nacion==0){
              $respuesta[$i]['action']='ERROR';
              $respuesta[$i]['error']=10;
              $respuesta[$i]['mensaje']='<p class="mensaje">Debe seleccionar nacionalidad</p>';
              $i++;
          }
      }
      
      if(verificarExpresion($nombre,$enombre)==false){
        $respuesta[$i]['action']='ERROR';
        $respuesta[$i]['error']=2;
        $respuesta[$i]['mensaje']='<p class="mensaje">Debe ingresar nombre</p>';
        $i++;
      }
      if($periodo=='' || $periodo==0){
        $respuesta[$i]['action']='ERROR';
        $respuesta[$i]['error']=3;
        $respuesta[$i]['mensaje']='<p class="mensaje">Debe seleccionar Periodo</p>';
        $i++;
      }
      if($sexo==''){
        $respuesta[$i]['action']='ERROR';
        $respuesta[$i]['error']=4;
        $respuesta[$i]['mensaje']='<p class="mensaje">Debe seleccionar Sexo</p>';
        $i++;
      }
      if($organizacion=='' || $organizacion==0){
        $respuesta[$i]['action']='ERROR';
        $respuesta[$i]['error']=5;
        $respuesta[$i]['mensaje']='<p class="mensaje">Debe seleccionar Organización</p>';
        $i++;
      }
      
      if($naciemiento==''){
        $respuesta[$i]['action']='ERROR';
        $respuesta[$i]['error']=6;
        $respuesta[$i]['mensaje']='<p class="mensaje">Seleccionar Fecha de Nacimiento</p>';
        $i++;
      }

      //edad 7
      if($edad=='' || $edad==null){
        $respuesta[$i]['action']='ERROR';
        $respuesta[$i]['error']=7;
        $respuesta[$i]['mensaje']='<p class="mensaje">Seleccionar Fecha de Nacimiento para la edad</p>';
        $i++;
      }
      if($etnia=='' || $etnia==0){
        $respuesta[$i]['action']='ERROR';
        $respuesta[$i]['error']=8;
        $respuesta[$i]['mensaje']='<p class="mensaje">Debe seleccionar Etnia</p>';
        $i++;
      }
      if($check_dis==1){

        if(($ceguera==1 && $ceguera_p=='') || /* $ceguera==1 && $ceguera_p==0 ||  */ ($ceguera==1 && $ceguera_p==null)){
          $respuesta[$i]['action']='ERROR';
          $respuesta[$i]['error']=9;
          $respuesta[$i]['mensaje']='<p class="mensaje">Debe ingresar valor valido</p>';
          $i++;
        }
        if(($sordera==1 && $sordera_p=='') || /* $sordera==1 && $sordera_p==0 || */ ($sordera==1 && $sordera_p==null)){
          $respuesta[$i]['action']='ERROR';
          $respuesta[$i]['error']=9;
          $respuesta[$i]['mensaje']='<p class="mensaje">Debe ingresar valor valido</p>';
          $i++;
        }
        if(($mudez==1 && $mudez_p=='') || /* $mudez==1 && $mudez_p==0 || */ ($mudez==1 && $mudez_p==null)){
          $respuesta[$i]['action']='ERROR';
          $respuesta[$i]['error']=9;
          $respuesta[$i]['mensaje']='<p class="mensaje">Debe ingresar valor valido</p>';
          $i++;
        }
        if(($fisica==1 && $fisica_p=='') || /* $fisica==1 && $fisica_p==0 || */ ($fisica==1 && $fisica_p==null)){
          $respuesta[$i]['action']='ERROR';
          $respuesta[$i]['error']=9;
          $respuesta[$i]['mensaje']='<p class="mensaje">Debe ingresar valor valido</p>';
          $i++;
        }
        if(($mental==1 && $mental_p=='') || /* $mental==1 && $mental_p==0 || */ ($mental==1 && $mental_p==null)){
          $respuesta[$i]['action']='ERROR';
          $respuesta[$i]['error']=9;
          $respuesta[$i]['mensaje']='<p class="mensaje">Debe ingresar valor valido</p>';
          $i++;
        }
        if(($psiquica==1 && $psiquica_p=='') || /* $psiquica==1 && $psiquica_p==0 || */ ($psiquica==1 && $psiquica_p==null)){
          $respuesta[$i]['action']='ERROR';
          $respuesta[$i]['error']=9;
          $respuesta[$i]['mensaje']='<p class="mensaje">Debe ingresar valor valido</p>';
          $i++;
        }
      }

      if(count($respuesta)==0){
        // $ninos= new Ninos();
        // $datos=$ninos->listarNinos(1,1,2024);
        $datos=$ninos->guardarNinos($dni,$nombre,$sexo,
        $edad,$naciemiento,$nacion,$etnia,$periodo,
        $ceguera,$sordera,$mudez,$fisica,$mental,$psiquica,
        $descripcion,$organizacion,$usuario_id,$check_nac ,$check_dis,
        $ceguera_p,$sordera_p ,$mudez_p,$fisica_p ,$mental_p,$psiquica_p);

        if($ninos->getError()==0){
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

      }else{
        echo json_encode($respuesta);
      }
        break;
        //edita 1 dato selecionable de la tabla A_ETNIA

    //! editar niño
    case "editarNino":
      $respuesta = array();
      $i=0;
      $erut = '/^[0-9]{7,8}\-[0-9kK]{1}$/';
      $enombre = '/^[a-zA-Z ]+$/';

      $ninos= new Ninos();
      // $user_id
      if($check_nac==0){
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
          
          $resultado=$ninos->buscarNinoIdDni($idNino,$dni,$periodo,1);
          if(count($resultado)!=1){
            $resultado=$ninos->buscarNinoDniPeriodo($dni,$periodo,1);
          
            if(count($resultado)!=0){
                if(count($resultado)==1){
                    $respuesta[$i]['action']='ERROR';
                    $respuesta[$i]['error']=1;
                    $respuesta[$i]['mensaje']='<p class="mensaje">RUT/DNI '.$resultado[0]['dni'].' se encuentra registrado en '. $resultado[0]['nombreOrganizacion'] .'</p>';
                    $i++;
                    //SELECT N.dni dni, O.nombre nombreOrganizacion FROM A_NINOS N
                }
            }
          }
          
          
          $nacion=1;//chile
      }else{
          if($nacion=='' || $nacion==null || $nacion==0){
              $respuesta[$i]['action']='ERROR';
              $respuesta[$i]['error']=10;
              $respuesta[$i]['mensaje']='<p class="mensaje">Debe seleccionar nacionalidad</p>';
              $i++;
          }
      }
      
      if(verificarExpresion($nombre,$enombre)==false){
        $respuesta[$i]['action']='ERROR';
        $respuesta[$i]['error']=2;
        $respuesta[$i]['mensaje']='<p class="mensaje">Debe ingresar nombre</p>';
        $i++;
      }
      if($periodo=='' || $periodo==0){
        $respuesta[$i]['action']='ERROR';
        $respuesta[$i]['error']=3;
        $respuesta[$i]['mensaje']='<p class="mensaje">Debe seleccionar Periodo</p>';
        $i++;
      }
      if($sexo==''){
        $respuesta[$i]['action']='ERROR';
        $respuesta[$i]['error']=4;
        $respuesta[$i]['mensaje']='<p class="mensaje">Debe seleccionar Sexo</p>';
        $i++;
      }
      if($organizacion=='' || $organizacion==0){
        $respuesta[$i]['action']='ERROR';
        $respuesta[$i]['error']=5;
        $respuesta[$i]['mensaje']='<p class="mensaje">Debe seleccionar Organización</p>';
        $i++;
      }
      
      if($naciemiento==''){
        $respuesta[$i]['action']='ERROR';
        $respuesta[$i]['error']=6;
        $respuesta[$i]['mensaje']='<p class="mensaje">Seleccionar Fecha de Nacimiento</p>';
        $i++;
      }

      //edad 7
      if($edad=='' || $edad==null){
        $respuesta[$i]['action']='ERROR';
        $respuesta[$i]['error']=7;
        $respuesta[$i]['mensaje']='<p class="mensaje">Seleccionar Fecha de Nacimiento para la edad</p>';
        $i++;
      }
      if($etnia=='' || $etnia==0){
        $respuesta[$i]['action']='ERROR';
        $respuesta[$i]['error']=8;
        $respuesta[$i]['mensaje']='<p class="mensaje">Debe seleccionar Etnia</p>';
        $i++;
      }
      if($check_dis==1){

        if(($ceguera==1 && $ceguera_p=='') || /* $ceguera==1 && $ceguera_p==0 ||  */ ($ceguera==1 && $ceguera_p==null)){
          $respuesta[$i]['action']='ERROR';
          $respuesta[$i]['error']=9;
          $respuesta[$i]['mensaje']='<p class="mensaje">Debe ingresar valor valido</p>';
          $i++;
        }
        if(($sordera==1 && $sordera_p=='') || /* $sordera==1 && $sordera_p==0 || */ ($sordera==1 && $sordera_p==null)){
          $respuesta[$i]['action']='ERROR';
          $respuesta[$i]['error']=9;
          $respuesta[$i]['mensaje']='<p class="mensaje">Debe ingresar valor valido</p>';
          $i++;
        }
        if(($mudez==1 && $mudez_p=='') || /* $mudez==1 && $mudez_p==0 || */ ($mudez==1 && $mudez_p==null)){
          $respuesta[$i]['action']='ERROR';
          $respuesta[$i]['error']=9;
          $respuesta[$i]['mensaje']='<p class="mensaje">Debe ingresar valor valido</p>';
          $i++;
        }
        if(($fisica==1 && $fisica_p=='') || /* $fisica==1 && $fisica_p==0 || */ ($fisica==1 && $fisica_p==null)){
          $respuesta[$i]['action']='ERROR';
          $respuesta[$i]['error']=9;
          $respuesta[$i]['mensaje']='<p class="mensaje">Debe ingresar valor valido</p>';
          $i++;
        }
        if(($mental==1 && $mental_p=='') || /* $mental==1 && $mental_p==0 || */ ($mental==1 && $mental_p==null)){
          $respuesta[$i]['action']='ERROR';
          $respuesta[$i]['error']=9;
          $respuesta[$i]['mensaje']='<p class="mensaje">Debe ingresar valor valido</p>';
          $i++;
        }
        if(($psiquica==1 && $psiquica_p=='') || /* $psiquica==1 && $psiquica_p==0 || */ ($psiquica==1 && $psiquica_p==null)){
          $respuesta[$i]['action']='ERROR';
          $respuesta[$i]['error']=9;
          $respuesta[$i]['mensaje']='<p class="mensaje">Debe ingresar valor valido</p>';
          $i++;
        }
      }


      if(count($respuesta)==0){
      
        $datos=$ninos->actualizarNinos($idNino,$dni,$nombre,$sexo,
        $edad,$naciemiento,$nacion,$etnia,$periodo,
        $ceguera,$sordera,$mudez,$fisica,$mental,$psiquica,
        $descripcion,$organizacion,$usuario_id,$check_nac ,$check_dis,
        $ceguera_p,$sordera_p ,$mudez_p,$fisica_p ,$mental_p,$psiquica_p);

        if($ninos->getError()==0){
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
        
      }else{
        echo json_encode($respuesta);
      }
      break;

      //! listar Niños
      case "listarNinos":
        // $menu= new MenuModel();
        $tipoO = $_POST['tipoO'];
        $OrganizacionO = $_POST['Organizacion'];
        $periodo = $_POST['periodo'];
        

        
        //llamo al metodo listar y le doy la variable CONSULTA
        // $datos=$menu->listar($sql);

        $ninos= new Ninos();
        // $datos=$ninos->listarNinos(1,1,2024);
        $datos=$ninos->listarNinos($tipoO,$OrganizacionO,$periodo);

        /* $ninos= new Ninos();
        $datos=$ninos->listar($sql); */

        //imprimir los datos en JSON
        // var_dump($datos);
        print($datos);
        break;

  }

  
?>