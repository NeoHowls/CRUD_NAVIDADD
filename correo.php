<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


function enviarCorreo($correlativo,$rut_personal,$codigo_area){
    //Load Composer's autoloader
    // require 'vendor/autoload.php';
    require 'PHPMailer/Exception.php';
    require 'PHPMailer/PHPMailer.php';
    require 'PHPMailer/SMTP.php';

    
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
    try {
        //Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->SMTPDebug = 0; //0 desactivado, 2 activo         //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'mail.maho.cl';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'asistencia@maho.cl';                     //SMTP username
        $mail->Password   = 'M4h02005';                               //SMTP password
        $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        //Indicamos cual es nuestra dirección de correo y el nombre que 
        //queremos que vea el usuario que lee nuestro correo
        $mail->setFrom('asistencia@maho.cl', 'Navidad MAHO.');
        //Indicamos cual es la dirección de destino del correo
        // $mail->addAddress('jarroyo@maho.cl', 'Juan Pablito Arroyo');     //Add a recipient
        // $mail->addAddress($correo, $nombre);     //Add a recipient
        // $mail->addAddress('abaeza@maho.cl', 'Alessandro');               //Name is optional

        //!:-----------------------------------------------------------------

         $mensaje = "mensaje";

        //!:-----------------------------------------------------------------
        
        //!:------------------------------------------------------------
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');
        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->CharSet = 'UTF-8';
        $mail->Subject = 'Asistencia Finalizada N°'.$cor;
        $mail->Body = $mensaje;
        /* $mail->Body    = '<strong>Sistema de Asistencia</strong><br><br>'.
                         'Solicitud N°'.$cor.'<br>'.
                         'Rut : '.$rut.'<br>'.
                         'Nombre : '.$nombre.'<br>'.
                         'Área : '.$area.'<br>'.
                         'Dirección : '.$direccion.'<br>'.
                         'Correo : '.$correo.'<br>'.
                         'Contacto : '.$contacto.'<br>'.
                         'Codigo Inventario : '.$codigo_inventario.'<br>'.
                         'Solicitud : '.$solicitud.'<br>'; */
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->send();
        // echo 'enviado correctamente';
        
        return 1;
    } catch (Exception $e) {
        // echo "error al enviar: {$mail->ErrorInfo}";
        return 0;
    }
}//fin funcion
?>