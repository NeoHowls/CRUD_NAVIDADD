<?php
//!:cortar cadena por caracter
function cortarCaracter($cadena, $caracter){
    $resp = explode($caracter, $cadena);
    return $resp;
}

//!:verificar si esta select esta en la posicion 0
function selectVacio($dato){
    if($dato==0){
        return true;//correcto
    }else{
        return false;//incorrecto
    }
}

//!:verificar input vacio
function inputVacio($dato){
    if($dato=="" && trim($dato)==""){
        return true;//correcto
    }else{
        return false;//incorrecto
    }
}

//!:ordenar fecha a formato calendario 
function ordenarFechaCalendario($fecha,$hora){
    return ordenaFechaYMD($fecha).'T'.quitarSegundos($hora);
}

//!:ordena fecha de formato dd-MM-YYYY a YYYY-MM-dd
function ordenaFechaYMD($fecha){
    $fecha=cortarCaracter($fecha,'-');
    $fechaOrdenada=$fecha[2].'-'.$fecha[1].'-'.$fecha[0];
    return $fechaOrdenada;
}

//!:quitar segundos
function quitarSegundos($hora){
    $hora=cortarCaracter($hora,':');
    $horaOrdenada=$hora[0].':'.$hora[1];
    return $horaOrdenada;
}

//!:reemplazr tabulaciones, saltos de linea por cadena
function sanitizeTabReturn( $cadena )
{
    $cadena=trim($cadena);
    return preg_replace( '/[\n\r\t]+/', '<br>', $cadena);
}

//!:Conviete fecha año-mes-diaThora:min a d-m-Y H:i:s
function ordenar_fecha_hora($fecha){//año-mes-diaThora:min
    //año-mes-dia hora:min:ssT000
    $fechaHora =explode('T', $fecha);
    //var_dump($fechaHora);
    $fechas = explode( '-', $fechaHora[0]  );
    $hora = $fechaHora[1];
    //$fecha = $fechas[2].'-'.$fechas[1].'-'.$fechas[0].' '.$hora.':00';
    $fecha = $fechas[2].'-'.$fechas[1].'-'.$fechas[0].' '.$hora.':'.date('s');
    $dfecha = date("d-m-Y H:i:s", strtotime($fecha));
    return $dfecha;
}

function ordenar_fecha_horaBD($fecha){//año-mes-dia hora:min:ss por consulta de BD
    $fechaHora = cortarCaracter($fecha,' ');
    $ffecha = cortarCaracter($fechaHora[0],'-');
    $fhora = cortarCaracter($fechaHora[1],':');

    $fordenada = $ffecha[2].'-'.$ffecha[1].'-'.$ffecha[0].'T'.$fhora[0].':'.$fhora[1];
    return $fordenada;
}

function ordenar_fecha($fecha){//año-mes-diaThora:min
    //año-mes-dia
    $fechaHora =explode('T', $fecha);
    //var_dump($fechaHora);
    $fechas = explode( '-', $fechaHora[0]  );
    
    //$fecha = $fechas[2].'-'.$fechas[1].'-'.$fechas[0].' '.$hora.':00';
    $fecha = $fechas[2].'-'.$fechas[1].'-'.$fechas[0];
    $dfecha = date("d-m-Y", strtotime($fecha));
    return $dfecha;
}

function obtener_mes($mesN){
    switch ($mesN) {
        case 1:
            $mesL = "ENERO";
            break;
        case 2:
            $mesL = "FEBRERO";
            break;
        case 3:
            $mesL = "MARZO";
            break;
        case 4:
            $mesL =  "ABRIL";
            break;
        case 5:
            $mesL =  "MAYO";
            break;
        case 6:
            $mesL =  "JUNIO";
            break;
        case 7:
            $mesL =  "JULIO";
            break;
        case 8:
            $mesL =  "AGOSTO";
            break;
        case 9:
            $mesL =  "SEPTIEMBRE";
            break;
        case 10:
            $mesL =  "OCTUBRE";
            break;
        case 11:
            $mesL =  "NOVIEMBRE";
            break;
        case 12:
            $mesL =  "DICIEMBRE";
            break;
    }
    return $mesL;
}

//!------------------------------------------------FUNCIONES----------------------------------------------------------
//!------------------------------------------------FUNCIONES----------------------------------------------------------
//!------------------------------------------------FUNCIONES----------------------------------------------------------
function validadorRut($trut)//dddddddddd-d
{
    // $rut=strtoupper(trim($_POST['rut']));
    $rut = $trut;

    //calcular digito verificador rut
    $separar=explode("-",$rut);
    $rut2=$separar[0];
    $dv=$separar[1];
    $contador=2;
    $totalrut=strlen($rut2);
    $totaldv=strlen($dv);
    $acumulador=0;

    if($dv=='k' or $dv=='K') { $dv=10;}
    if($dv==0) { $dv=11;}
    for($i=1;$i<=$totalrut;$i++)
          {
          $multiplo = ($rut2 % 10) * $contador;
          $acumulador = $acumulador + $multiplo;
          $rut2 = $rut2/10;
          $contador = $contador + 1;
          if ($contador == 8)
                {
                $contador = 2;
                }
          }
          $rut3= 11 - ($acumulador % 11);
    //fin rut
    //ver si rut esta en bases de datos y pertenece a junta vecinal
    $separar2=explode("-",$rut);
    $rutcount=$separar2[0];
    if($rut3==$dv){
          return 1;
    }else{
          //   echo 'El rut ingresado ', $trut, ' es invalido';
          return 0;
    }
}

function verificarExpresion($cadena,$expresion) {
    $patron=$expresion;
    // Verificar si la contraseña cumple con el patrón
    if (preg_match($patron, $cadena)) {
        // echo "true";
        return true;
    } else {
        // echo "false";
        return false;
    }
}
//!------------------------------------------------FUNCIONES----------------------------------------------------------
//!------------------------------------------------FUNCIONES----------------------------------------------------------
//!------------------------------------------------FUNCIONES----------------------------------------------------------
?>