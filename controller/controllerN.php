<?php
  //llama al MenuModel
  // require_once("../model/MenuModel.php");
  require_once ("../model/MODEL_NINOS.php");
  session_start();
    
  //declaro una variable para poder invocar a MenuModel
  
  $user_id = (isset($_POST['user_id'])) ? $_POST['user_id'] : '';
  $dni = (isset($_POST['dni'])) ? $_POST['dni'] : '';
  $nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
  $sexo = (isset($_POST['sexo'])) ? $_POST['sexo'] : '';
  $edad = (isset($_POST['edad'])) ? $_POST['edad'] : '';
  $periodo = (isset($_POST['periodo'])) ? $_POST['periodo'] : '';
  $descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : '';
  $naciemiento = (isset($_POST['naciemiento'])) ? $_POST['naciemiento'] : '';
  $nacion = (isset($_POST['nacion'])) ? $_POST['nacion'] : '';
  $comuna = (isset($_POST['comuna'])) ? $_POST['comuna'] : '';
  $check_dis = (isset($_POST['check_dis'])) ? $_POST['check_dis'] : '';
  $ceguera = (isset($_POST['ceguera'])) ? $_POST['ceguera'] : '';
  $sordera = (isset($_POST['sordera'])) ? $_POST['sordera'] : '';
  $mudez = (isset($_POST['mudez'])) ? $_POST['mudez'] : '';
  $fisica = (isset($_POST['fisica'])) ? $_POST['fisica'] : '';
  $mental = (isset($_POST['mental'])) ? $_POST['mental'] : '';
  $psiquica = (isset($_POST['psiquica'])) ? $_POST['psiquica'] : '';
  $check_nac = (isset($_POST['check_nac'])) ? $_POST['check_nac'] : '';


  $ceguera_p = (isset($_POST['ceguera_p'])) ? $_POST['ceguera_p'] : '';
  $sordera_p = (isset($_POST['sordera_p'])) ? $_POST['sordera_p'] : '';
  $mudez_p = (isset($_POST['mudez_p'])) ? $_POST['mudez_p'] : '';
  $fisica_p = (isset($_POST['fisica_p'])) ? $_POST['fisica_p'] : '';
  $mental_p = (isset($_POST['mental_p'])) ? $_POST['mental_p'] : '';
  $psiquica_p = (isset($_POST['psiquica_p'])) ? $_POST['psiquica_p'] : '';

  $usuario_id = $_SESSION['id_persona'];
  $organizacion = (isset($_POST['organizacion'])) ? $_POST['organizacion'] : '';
  $etnia = (isset($_POST['etnia'])) ? $_POST['etnia'] : '';




  
  //Armo un GET "op" donde OP signific operacion
  switch($_GET["op"]){
   //en caso que llame el controller debo usar op y la opcionen, en esta caso solo es listar


   case "add_etnia":
      $menu= new Ninos();;
      //define la consulta
      echo ($fisica_p);
      $fechaIngreso = date('Y-m-d H:i:s', strtotime($fechaIngreso));   
      $CONSULTA = "INSERT INTO [dbo].[A_NINOS]
           ([dni]
           ,[nombre]
           ,[sexo]
           ,[edad]
           ,[fechaNacimiento]
           ,[idNacionalidad]
           ,[idEtnia]
           ,[estado]
           ,[periodo]
           ,[checkCeguera]
           ,[checkSordera]
           ,[checkMudez]
           ,[checkFisica]
           ,[checkMental]
           ,[checkPsiquica]
           ,[descripcion]
           ,[idOrganizacion]
           ,[idPersonalRegistro]
           
           ,[checkExtranjero]
           ,[checkDiscapacitado]
           ,[checkRSH]
           ,[porcentajeCeguera]
           ,[porcentajeSordera]
           ,[porcentajeMudez]
           ,[porcentajeFisica]
           ,[porcentajeMental]
           ,[porcentajePsiquica])
     VALUES
           ('$dni'
           ,'$nombre'
           ,$sexo
           ,$edad
           ,'$naciemiento'
           ,$nacion
           ,$etnia
           ,1
           ,$periodo
           ,$ceguera
           ,$sordera 
           ,$mudez
           ,$fisica
           ,$mental
           ,$psiquica
           ,'$descripcion'
           ,$organizacion
           ,$usuario_id
           
           ,$check_nac 
           ,$check_dis
           ,0
           ,$ceguera_p
           ,$sordera_p 
           ,$mudez_p
           ,$fisica_p 
           ,$mental_p
           ,$psiquica_p)";
      //llamo al metodo listar y le doy la variable CONSULTA
      echo $CONSULTA;
      $datos=$menu->listar($CONSULTA);
        $CONSULTA = "SELECT * FROM A_NINOS";
        //llamo al metodo listar y le doy la variable CONSULTA
        $datos=$menu->listar($CONSULTA);
        //imprimir los datos en JSON
        print($datos);
      //imprimir los datos en JSON
        break;
        //edita 1 dato selecionable de la tabla A_ETNIA
    case "edit_etnia":
      $menu= new Ninos();
      //define la consulta
      echo $etnia;
      $CONSULTA = "UPDATE [dbo].[A_NINOS]
   SET [dni] = '$dni'
      ,[nombre] = '$nombre'
      ,[sexo] = $sexo
      ,[edad] = $edad
      ,[fechaNacimiento] = '$naciemiento'
      ,[idNacionalidad] = '$nacion '
      ,[idEtnia] = '$etnia '
      ,[periodo] = '$periodo'
      ,[checkCeguera] = $ceguera
      ,[checkSordera] = $sordera
      ,[checkMudez] = $mudez
      ,[checkFisica] = $fisica
      ,[checkMental] = $mental
      ,[checkPsiquica] = $psiquica
      ,[descripcion] = '$descripcion'
      ,[idOrganizacion] = '$organizacion'
      ,[checkExtranjero] = '$check_nac'
      ,[checkDiscapacitado] = '$check_dis'

      ,[porcentajeCeguera] = $ceguera_p 
      ,[porcentajeSordera] = $sordera_p
      ,[porcentajeMudez] = $mudez_p
      ,[porcentajeFisica] = $fisica_p
      ,[porcentajeMental] = $mental_p 
      ,[porcentajePsiquica] = $psiquica_p
 WHERE id = $user_id ";
      //llamo al metodo listar y le doy la variable CONSULTA
      echo $etnia;
      $datos=$menu->listar($CONSULTA);
        $CONSULTA = "SELECT * FROM A_ETNIA";
        //llamo al metodo listar y le doy la variable CONSULTA
        $datos=$menu->listar($CONSULTA);
        //imprimir los datos en JSON
        print($datos);
      break;
      case "ninos":
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