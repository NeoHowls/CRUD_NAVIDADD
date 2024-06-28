<?php
  //llama al MenuModel
  require_once("../model/MenuModel.php");
  session_start();
    
  //declaro una variable para poder invocar a MenuModel
  $menu= new MenuModel();
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
      //define la consulta

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
           ,[fechaRegistro]
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
           ,1
           ,1
           ,1
           ,1
           ,1
           ,1
           ,'$descripcion'
           ,$organizacion
           ,$usuario_id
           ,'$fechaIngreso'
           ,1
           ,1
           ,0
           ,1
           ,1
           ,1
           ,1
           ,1
           ,1)";
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
      //define la consulta
      echo $etnia;
      $CONSULTA = "UPDATE A_ETNIA SET etnia='$etnia' WHERE id='$user_id'";
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
        //define la consulta
        $CONSULTA = "SELECT  
          A_NINOS.id,

          A_NINOS.dni,
          A_NINOS.nombre,
          A_NINOS.sexo,

          A_NINOS.edad,
          A_NINOS.fechaNacimiento,
          A_NINOS.periodo,
          A_NINOS.descripcion,
          A_NINOS.fechaRegistro,

          A_NINOS.idNacionalidad,
          A_NINOS.checkExtranjero,
          A_ETNIA.etnia,
          A_NACIONALIDAD.nacionalidad,
          A_ORGANIZACION.nombre AS COMUNA,
           
          A_ORGANIZACION.tipo



        FROM [dbo].[A_NINOS]
          INNER JOIN A_ETNIA ON A_NINOS.idEtnia = A_ETNIA.id
          INNER JOIN A_NACIONALIDAD ON A_NINOS.idNacionalidad = A_NACIONALIDAD.id
          INNER JOIN A_ORGANIZACION ON A_NINOS.idOrganizacion = A_ORGANIZACION.id;";
        //llamo al metodo listar y le doy la variable CONSULTA
        $datos=$menu->listar($CONSULTA);
        //imprimir los datos en JSON
        print($datos);
        break;

  }

  
?>