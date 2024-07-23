<?php
session_start();
  //llama al MenuModel
  require_once("../model/MenuModel.php");
  
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
  $fechaIngreso = date('Y-m-d H:i:s', strtotime($fechaIngreso));

  echo ($aniosVigente);
  //Armo un GET "op" donde OP signific operacion
  switch($_GET["op"]){
   //en caso que llame el controller debo usar op y la opcionen, en esta caso solo es listar
  case "organizacion":
    //define la consulta
    /* $CONSULTA = "SELECT  
A_ORGANIZACION.id,
A_ORGANIZACION.nombre,
A_ORGANIZACION.direccion,
A_ORGANIZACION.tipo,
A_ORGANIZACION.fechaIngreso,
A_ORGANIZACION.aniosVigente,
A_ORGANIZACION.checkVigente,
A_ORGANIZACION.numProvidencia,
A_ORGANIZACION.checkHabilitado,
A_ORGANIZACION.estado


FROM [dbo].[A_ORGANIZACION]"; */
    $CONSULTA = "SELECT O.id AS id,
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
    $datos=$menu->listar($CONSULTA);
    //imprimir los datos en JSON
    print($datos);
    break;
    
    case "add_organizacion":
      // Define la consulta para insertar en A_ORGANIZACION
      $CONSULTA = "INSERT INTO A_ORGANIZACION (nombre, direccion, tipo, fechaIngreso, checkVigente, numProvidencia,
        checkHabilitado, estado) VALUES ('$nombre','$direccion','$tipo','$fechaIngreso',1,'$numProvidencia',1,1)";
      echo($CONSULTA);
      // Ejecuta la consulta para insertar en A_ORGANIZACION
      $datos = $menu->listar($CONSULTA);
  
      // Obtiene el ID de la organización recién insertada
      $CONSULTA = "SELECT id FROM A_ORGANIZACION WHERE nombre='$nombre' AND direccion='$direccion'";
      echo($CONSULTA);
      $datos = $menu->consultar($CONSULTA);
      $idOrganizacion = $datos[0]['id'];
  
      // Calcula la fecha de vencimiento basada en los años vigentes
      $fechaVencimiento = date('Y-m-d H:i:s', strtotime("+{$aniosVigente} year", strtotime($fechaIngreso)));
  
      // Define la consulta para insertar en A_DETALLE_ORGANIZACION
      $CONSULTA = "INSERT INTO A_DETALLE_ORGANIZACION (idOrganizacion, fechaIngreso,fechaVencimiento, aniosVigente, estado) 
                  VALUES ('$idOrganizacion', '$fechaIngreso','$fechaVencimiento', '$aniosVigente', 1)";
      echo($CONSULTA);
      // Ejecuta la consulta para insertar en A_DETALLE_ORGANIZACION
      $menu->listar($CONSULTA);
  
      // Aquí podrías añadir la lógica para el historial si lo necesitas
       $usuarioCambio = $_SESSION["test"];
      $CONSULTA = "INSERT INTO A_ORGANIZACION_HISTORIAL (nombre,direccion,tipo,fechaIngreso,checkVigente,numProvidencia,
      checkHabilitado,estado,usuarioCambio,fechaCambio,tipoMovimiento) values ('$nombre', '$direccion', '$tipo', '$fechaIngreso', 
      1, '$numProvidencia', 1,1,'$usuarioCambio',getdate(),'Añadir Nueva Organizacion')";
      $datos=$menu->listar($CONSULTA);
      $CONSULTA = "SELECT * FROM A_ORGANIZACION_HISTORIAL"; 
      $datos=$menu->listar($CONSULTA);
      print($datos);
  
      // Consulta final para obtener los datos actualizados de A_ORGANIZACION
      $CONSULTA = "SELECT * FROM A_ORGANIZACION";
      // Ejecuta la consulta para obtener los datos actualizados
      $datos = $menu->listar($CONSULTA);
      // Imprime los datos en JSON o realiza la acción necesaria
      print($datos); 
        
      
      
      
    break; 
        //edita 1 dato selecionable de la tabla A_ETNIA
      case "edit_organizacion":

        if($tipo==4){
        //define la consulta
        $CONSULTA = "UPDATE A_ORGANIZACION SET nombre ='$nombre',direccion ='$direccion',tipo ='$tipo',fechaIngreso ='$fechaIngreso',
        numProvidencia ='$numProvidencia' WHERE id='$user_id'";
        //llamo al metodo listar y le doy la variable CONSULTA
        $datos=$menu->listar($CONSULTA);

        // Obtiene el ID de la organización recién insertada
        $CONSULTA = "SELECT id FROM A_ORGANIZACION WHERE nombre='$nombre' AND direccion='$direccion'";
        echo($CONSULTA);
        $datos = $menu->consultar($CONSULTA);
        $idOrganizacion = $datos[0]['id'];
    
        // Calcula la fecha de vencimiento basada en los años vigentes
        $fechaVencimiento = date('Y-m-d H:i:s', strtotime("+{$aniosVigente} year", strtotime($fechaIngreso)));

        $CONSULTA = "UPDATE A_DETALLE_ORGANIZACION SET idOrganizacion='$idOrganizacion', fechaIngreso='$fechaIngreso',fechaVencimiento ='$fechaVencimiento',
        aniosVigente ='$aniosVigente' WHERE idOrganizacion='$user_id'";
        //llamo al metodo listar y le doy la variable CONSULTA
        $datos=$menu->listar($CONSULTA);

        $CONSULTA = "SELECT * FROM A_ORGANIZACION";
        //llamo al metodo listar y le doy la variable CONSULTA
        $datos=$menu->listar($CONSULTA);
        //imprimir los datos en JSON
        //print($datos);

        $usuarioCambio = $_SESSION["nombre"];
         $CONSULTA = "INSERT INTO A_ORGANIZACION_HISTORIAL (nombre,direccion,tipo,fechaIngreso,checkVigente,numProvidencia,
         checkHabilitado,estado,usuarioCambio,fechaCambio,tipoMovimiento) values ('$nombre', '$direccion', '$tipo', '$fechaIngreso', 
         '$checkVigente', '$numProvidencia', '$checkHabilitado','$estado','$usuarioCambio',getdate(),'Editar una Organizacion')";
         $datos=$menu->listar($CONSULTA);
         $CONSULTA = "SELECT * FROM A_ORGANIZACION_HISTORIAL"; 
         $datos=$menu->listar($CONSULTA);
         print($datos);
        }
        else{
          //define la consulta
        $CONSULTA = "UPDATE A_ORGANIZACION SET nombre ='$nombre',direccion ='$direccion',tipo ='$tipo',fechaIngreso ='$fechaIngreso'
        WHERE id='$user_id'";
        //llamo al metodo listar y le doy la variable CONSULTA
        $datos=$menu->listar($CONSULTA);

        // Obtiene el ID de la organización recién insertada
        $CONSULTA = "SELECT id FROM A_ORGANIZACION WHERE nombre='$nombre' AND direccion='$direccion'";
        echo($CONSULTA);
        $datos = $menu->consultar($CONSULTA);
        $idOrganizacion = $datos[0]['id'];
    
        // Calcula la fecha de vencimiento basada en los años vigentes
        $fechaVencimiento = date('Y-m-d H:i:s', strtotime("+{$aniosVigente} year", strtotime($fechaIngreso)));

        $CONSULTA = "UPDATE A_DETALLE_ORGANIZACION SET idOrganizacion='$idOrganizacion', fechaIngreso='$fechaIngreso',fechaVencimiento ='$fechaVencimiento',
        aniosVigente ='$aniosVigente' WHERE idOrganizacion='$user_id'";
        //llamo al metodo listar y le doy la variable CONSULTA
        $datos=$menu->listar($CONSULTA);

        $CONSULTA = "SELECT * FROM A_ORGANIZACION";
        //llamo al metodo listar y le doy la variable CONSULTA
        $datos=$menu->listar($CONSULTA);
        //imprimir los datos en JSON
        print($datos);
        }
         $usuarioCambio = $_SESSION["nombre"];
         $CONSULTA = "INSERT INTO A_ORGANIZACION_HISTORIAL (nombre,direccion,tipo,fechaIngreso,checkVigente,numProvidencia,
         checkHabilitado,estado,usuarioCambio,fechaCambio,tipoMovimiento) values ('$nombre', '$direccion', '$tipo', '$fechaIngreso', 
         '$checkVigente', '$numProvidencia', '$checkHabilitado','$estado','$usuarioCambio',getdate(),'Editar una Organizacion')";
         $datos=$menu->listar($CONSULTA);
         $CONSULTA = "SELECT * FROM A_ORGANIZACION_HISTORIAL"; 
         $datos=$menu->listar($CONSULTA);
         print($datos);

      break;

      case "Habilitar_organizacion":
        echo($checkHabilitado);
        if($checkHabilitado == 1){
          echo "funciona el if de habilitar organizacion";
          
          $CONSULTA ="SELECT idPersona FROM A_DETALLE_PO WHERE idOrganizacion='$user_id' and estado=1";
        $datos=$menu->consultar($CONSULTA);
        $persona_ids = array_column($datos, 'idPersona');
        $persona_ids_string = implode(',', $persona_ids);

        if (!empty($persona_ids_string)) {
        $CONSULTA = "UPDATE A_PERSONA SET checkHabilitado=0 WHERE id IN ($persona_ids_string)";
        $menu->listar($CONSULTA);
        }

        //define la consulta
        $CONSULTA = "UPDATE A_ORGANIZACION SET checkHabilitado = 0 WHERE id='$user_id'";
        //llamo al metodo listar y le doy la variable CONSULTA
        $datos=$menu->listar($CONSULTA);
          $CONSULTA = "SELECT * FROM A_ORGANIZACION";
          //llamo al metodo listar y le doy la variable CONSULTA
          $datos=$menu->listar($CONSULTA);
          //imprimir los datos en JSON
          //print($datos);
    
         $usuarioCambio = $_SESSION["nombre"];
         $CONSULTA = "INSERT INTO A_ORGANIZACION_HISTORIAL (nombre,direccion,tipo,fechaIngreso,checkVigente,numProvidencia,
         checkHabilitado,estado,usuarioCambio,fechaCambio,tipoMovimiento) values ('$nombre', '$direccion', '$tipo', '$fechaIngreso', 
         '$checkVigente', '$numProvidencia', '$checkHabilitado','$estado','$usuarioCambio',getdate(),'Deshabilitar a una organizacion')";
         $datos=$menu->listar($CONSULTA);
         $CONSULTA = "SELECT * FROM A_ORGANIZACION_HISTORIAL"; 
         $datos=$menu->listar($CONSULTA);
         print($datos);
        
    
        
        }else {
          
          $CONSULTA1 = "UPDATE A_ORGANIZACION SET checkHabilitado = 1 WHERE id='$user_id'";
        //llamo al metodo listar y le doy la variable CONSULTA
          $menu->listar($CONSULTA1);
          $datos=$menu->listar($CONSULTA1);
          $CONSULTA = "SELECT * FROM A_ORGANIZACION";
          //llamo al metodo listar y le doy la variable CONSULTA
          $datos=$menu->listar($CONSULTA);
          //imprimir los datos en JSON
           print($datos);
    
           $usuarioCambio = $_SESSION["nombre"];
           $CONSULTA = "INSERT INTO A_ORGANIZACION_HISTORIAL (nombre,direccion,tipo,fechaIngreso,aniosVigente,checkVigente,numProvidencia,
           checkHabilitado,estado,usuarioCambio,fechaCambio,tipoMovimiento) values ('$nombre', '$direccion', '$tipo', '$fechaIngreso', 
           '$checkVigente', '$numProvidencia', '$checkHabilitado','$estado','$usuarioCambio',getdate(),'Habilitar una organizacion')";
           $datos=$menu->listar($CONSULTA);
           $CONSULTA = "SELECT * FROM A_ORGANIZACION_HISTORIAL"; 
           $datos=$menu->listar($CONSULTA);
           print($datos);
    
    }
    break;
    
    case "borrar_organizacion":
      echo($estado);
      if($estado == 1){
        echo "funciona el if de editar";

        $CONSULTA ="SELECT idPersona FROM A_DETALLE_PO WHERE idOrganizacion='$user_id' and estado=1";
        $datos=$menu->consultar($CONSULTA);
        $persona_ids = array_column($datos, 'idPersona');
        $persona_ids_string = implode(',', $persona_ids);

        if (!empty($persona_ids_string)) {
        $CONSULTA = "UPDATE A_PERSONA SET checkHabilitado=0, estado=0 WHERE id IN ($persona_ids_string)";
        $menu->listar($CONSULTA);
        }

        //define la consulta
        $CONSULTA = "UPDATE A_ORGANIZACION SET checkHabilitado = 0 WHERE id='$user_id'";
        //llamo al metodo listar y le doy la variable CONSULTA
        $datos=$menu->listar($CONSULTA);

        //define la consulta
        $CONSULTA = "UPDATE A_ORGANIZACION SET estado = 0 WHERE id='$user_id'";
        //llamo al metodo listar y le doy la variable CONSULTA
        $datos=$menu->listar($CONSULTA);
        
        $CONSULTA = "SELECT * FROM A_ORGANIZACION";
        //llamo al metodo listar y le doy la variable CONSULTA
        $datos=$menu->listar($CONSULTA);
        //imprimir los datos en JSON
        print($datos);

            $usuarioCambio = $_SESSION["nombre"];
            $CONSULTA = "INSERT INTO A_ORGANIZACION_HISTORIAL (nombre,direccion,tipo,fechaIngreso,aniosVigente,checkVigente,numProvidencia,
            checkHabilitado,estado,usuarioCambio,fechaCambio,tipoMovimiento) values ('$nombre', '$direccion', '$tipo', '$fechaIngreso', 
            '$checkVigente', '$numProvidencia', '$checkHabilitado','$estado','$usuarioCambio',getdate(),'Habilitar una organizacion')";
            $datos=$menu->listar($CONSULTA);
            $CONSULTA = "SELECT * FROM A_ORGANIZACION_HISTORIAL"; 
            $datos=$menu->listar($CONSULTA);
            print($datos);
      
 
      
      }else {


        $CONSULTA1 = "UPDATE A_ORGANIZACION SET checkHabilitado = 1 WHERE id='$user_id'";
          //llamo al metodo listar y le doy la variable CONSULTA
          $menu->listar($CONSULTA1);
          $datos=$menu->listar($CONSULTA1);

        $CONSULTA1 = "UPDATE A_ORGANIZACION SET estado = 1 WHERE id='$user_id'";
      //llamo al metodo listar y le doy la variable CONSULTA
        $menu->listar($CONSULTA1);
        $datos=$menu->listar($CONSULTA1);
        $CONSULTA = "SELECT * FROM A_ORGANIZACION";
        //llamo al metodo listar y le doy la variable CONSULTA
        $datos=$menu->listar($CONSULTA);
        //imprimir los datos en JSON
         print($datos);

            $usuarioCambio = $_SESSION["nombre"];
            $CONSULTA = "INSERT INTO A_ORGANIZACION_HISTORIAL (nombre,direccion,tipo,fechaIngreso,aniosVigente,checkVigente,numProvidencia,
            checkHabilitado,estado,usuarioCambio,fechaCambio,tipoMovimiento) values ('$nombre', '$direccion', '$tipo', '$fechaIngreso', 
            '$checkVigente', '$numProvidencia', '$checkHabilitado','$estado','$usuarioCambio',getdate(),'Habilitar una organizacion')";
            $datos=$menu->listar($CONSULTA);
            $CONSULTA = "SELECT * FROM A_ORGANIZACION_HISTORIAL"; 
            $datos=$menu->listar($CONSULTA);
            print($datos);
  
}
break;
    
    case "habGeneralO":
      //define la consulta
      $CONSULTA = "UPDATE A_ORGANIZACION SET checkHabilitado = 1";
      //llamo al metodo listar y le doy la variable CONSULTA
      $datos=$menu->listar($CONSULTA);
        
      $CONSULTA = "SELECT * FROM A_ORGANIZACION";
      //llamo al metodo listar y le doy la variable CONSULTA
      $datos=$menu->listar($CONSULTA);
      //imprimir los datos en JSON
      print($datos);
    
      $usuarioCambio = $_SESSION["nombre"];
      $CONSULTA = "INSERT INTO A_ORGANIZACION_HISTORIAL (nombre,direccion,tipo,fechaIngreso,checkVigente,numProvidencia,
      checkHabilitado,estado,usuarioCambio,fechaCambio,tipoMovimiento) values ('$nombre', '$direccion', '$tipo', '$fechaIngreso', 
      '$checkVigente', '$numProvidencia', '$checkHabilitado','$estado','$usuarioCambio',getdate(),'Habilitar a todas las organizaciones')";
      $datos=$menu->listar($CONSULTA);
      $CONSULTA = "SELECT * FROM A_ORGANIZACION_HISTORIAL"; 
      $datos=$menu->listar($CONSULTA);
        
      
      break;
    
      case "DesHabGeneralO": 
        //define la consulta

        $CONSULTA ="SELECT idPersona FROM A_DETALLE_PO WHERE estado=1";
        $datos=$menu->consultar($CONSULTA);
        $persona_ids = array_column($datos, 'idPersona');
        $persona_ids_string = implode(',', $persona_ids);

        if (!empty($persona_ids_string)) {
        $CONSULTA = "UPDATE A_PERSONA SET checkHabilitado=0 WHERE id IN ($persona_ids_string)";
        $menu->listar($CONSULTA);
        }

        $CONSULTA = "UPDATE A_ORGANIZACION SET checkHabilitado = 0";
        //llamo al metodo listar y le doy la variable CONSULTA
        $datos=$menu->listar($CONSULTA);
        $CONSULTA = "SELECT * FROM A_ORGANIZACION";
          //llamo al metodo listar y le doy la variable CONSULTA
        $datos=$menu->listar($CONSULTA);
          //print($datos);
          //imprimir los datos en JSON
          //print($datos);
      
         $usuarioCambio = $_SESSION["nombre"];
         $CONSULTA = "INSERT INTO A_ORGANIZACION_HISTORIAL (nombre,direccion,tipo,fechaIngreso,checkVigente,numProvidencia,
         checkHabilitado,estado,usuarioCambio,fechaCambio,tipoMovimiento) values ('$nombre', '$direccion', '$tipo', '$fechaIngreso', 
         '$checkVigente', '$numProvidencia', '$checkHabilitado','$estado','$usuarioCambio',getdate(),'Deshabilitar a todas las organizaciones')";
         $datos=$menu->listar($CONSULTA);
         $CONSULTA = "SELECT * FROM A_ORGANIZACION_HISTORIAL"; 
         $datos=$menu->listar($CONSULTA);
         print($datos);
        
      
        break;
  }
  
?>