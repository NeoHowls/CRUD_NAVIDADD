<?php
  //llama al MenuModel
  require_once("../model/MenuModel.php");
  
  //declaro una variable para poder invocar a MenuModel
  $menu= new MenuModel();
  $ninos = (isset($_POST['ninos'])) ? $_POST['ninos'] : '';
  $user_id = (isset($_POST['user_id'])) ? $_POST['user_id'] : '';
  $correlativo = (isset($_POST['correlativo'])) ? $_POST['correlativo'] : '';
  $dni = (isset($_POST['dni'])) ? $_POST['dni'] : '';
  $nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
  $sexo = (isset($_POST['sexo'])) ? $_POST['sexo'] : '';
  $edad = (isset($_POST['edad'])) ? $_POST['edad'] : '';
  $fechaNacimiento = (isset($_POST['fechaNacimiento'])) ? $_POST['fechaNacimiento'] : '';
  $idNacionalidad = (isset($_POST['idNacionalidad'])) ? $_POST['idNacionalidad'] : '';
  $idEtnia = (isset($_POST['idEtnia'])) ? $_POST['idEtnia'] : '';
  $estado = (isset($_POST['estado'])) ? $_POST['estado'] : '';
  $periodo = (isset($_POST['periodo'])) ? $_POST['periodo'] : '';
  $checkCeguera = (isset($_POST['checkCeguera'])) ? $_POST['checkCeguera'] : '';
  $checkSordera = (isset($_POST['checkSordera'])) ? $_POST['checkSordera'] : '';
  $checkMudez = (isset($_POST['checkMudez'])) ? $_POST['checkMudez'] : '';
  $checkFisica = (isset($_POST['checkFisica'])) ? $_POST['checkFisica'] : '';
  $checkMental = (isset($_POST['checkMental'])) ? $_POST['checkMental'] : '';
  $checkPsiquica = (isset($_POST['checkPsiquica'])) ? $_POST['checkPsiquica'] : '';
  $descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : '';
  $idOrganizacion = (isset($_POST['idOrganizacion'])) ? $_POST['idOrganizacion'] : '';
  $corrRegistro = (isset($_POST['corrRegistro'])) ? $_POST['corrRegistro'] : '';
  $fechaRegistro = (isset($_POST['fechaRegistro'])) ? $_POST['fechaRegistro'] : '';
  $checkNacional = (isset($_POST['checkNacional'])) ? $_POST['checkNacional'] : '';
  $checkDiscapacitado = (isset($_POST['checkDiscapacitado'])) ? $_POST['checkDiscapacitado'] : '';
  $checkRSH = (isset($_POST['checkRSH'])) ? $_POST['checkRSH'] : '';

  //Armo un GET "op" donde OP signific operacion
  switch($_GET["op"]){
   //en caso que llame el controller debo usar op y la opcionen, en esta caso solo es listar
   case "listarA":
    //define la consulta
    $CONSULTA = "SELECT * FROM A_NINOS";
    //llamo al metodo listar y le doy la variable CONSULTA
    $datos=$menu->listar($CONSULTA);
    //imprimir los datos en JSON
    print($datos);
    break;
   case "listarB":
      //define la consulta
      $CONSULTA = "SELECT * FROM A_PERFIL";
      //llamo al metodo listar y le doy la variable CONSULTA
      $datos=$menu->listar($CONSULTA);
      //imprimir los datos en JSON
      print($datos);
      break;
      //añade datos a la tabla A_ETNIA
   case "add_ninos":
      //define la consulta
      echo $ninos;
      $CONSULTA = "INSERT INTO A_NINOS (correlativo,dni,nombre,sexo,edad,fechaNacimiento,idNacionalidad,idEtnia,estado,periodo,checkCeguera,checkSordera,checkMudez,checkFisica,checkMental,checkPsiquica,descripcion,idOrganizacion,corrRegistro,fechaRegistro,checkNacional,checkDiscapacitado,checkRSH) VALUES ('$correlativo','$dni','$nombre','$sexo','$edad',
      '$fechaNacimiento','$idNacionalidad','$idEtnia','$estado','$periodo','$checkCeguera','$checkSordera','$checkMudez','$checkFisica',
      '$checkMental','$checkPsiquica','$descripcion','$idOrganizacion','$corrRegistro','$fechaRegistro','$checkNacional','$checkDiscapacitado','$checkRSH')";
      //llamo al metodo listar y le doy la variable CONSULTA
      echo $ninos;
      $datos=$menu->listar($CONSULTA);
        $CONSULTA = "SELECT * FROM A_NINOS";
        //llamo al metodo listar y le doy la variable CONSULTA
        $datos=$menu->listar($CONSULTA);
        //imprimir los datos en JSON
        print($datos);
      //imprimir los datos en JSON

        //edita 1 dato selecionable de la tabla A_ETNIA
    case "edit_ninos":
      //define la consulta
      echo $ninos;
      $CONSULTA = "UPDATE A_ NINOS SET correlativo='$correlativo',dni='$dni',nombre='$nombre',sexo='$sexo',edad='$edad',fechaNacimiento='$fechaNacimiento',idNacionalidad='$idNacionalidad',idEtnia='$idEtnia',estado='$estado',periodo='$periodo',checkCeguera='$checkCeguera',checkSordera='$checkSordera',checkMudez='$checkMudez',checkFisica='$checkFisica',checkMental='$checkMental',
      checkPsiquica='$checkPsiquica',descripcion='$descripcion',idOrganizacion='$idOrganizacion',corrRegistro='$corrRegistro',fechaRegistro='$fechaRegistro',checkNacional='$checkNacional',checkDiscapacitado='$checkDiscapacitado',checkRSH='$checkRSH' WHERE id='$user_id'";
      //llamo al metodo listar y le doy la variable CONSULTA
      echo $ninos;
      $datos=$menu->listar($CONSULTA);
        $CONSULTA = "SELECT * FROM A_NINOS";
        //llamo al metodo listar y le doy la variable CONSULTA
        $datos=$menu->listar($CONSULTA);
        //imprimir los datos en JSON
        print($datos);
      break;
      case "ninos":
        //define la consulta
        $CONSULTA = "SELECT  
	A_NINOS.id,
	A_NINOS.correlativo,
	A_NINOS.dni,
	A_NINOS.nombre,
	A_NINOS.sexo,
	A_NINOS.edad,
	A_NINOS.fechaNacimiento,
	A_NINOS.periodo,
	A_NINOS.descripcion,
	A_NINOS.fechaRegistro,
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