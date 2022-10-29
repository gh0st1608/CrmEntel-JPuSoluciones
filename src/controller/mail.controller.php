<?php
require_once "vendor/autoload.php";


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$dotenv = Dotenv\Dotenv::createImmutable('./');
//$dotenv = new Dotenv\Dotenv('./');
$dotenv->load();


$sender =  $_ENV['SMTP_SENDER_ADMIN_SYSTEM'];
$senderName =  $_ENV['SMTP_SENDERNAME'];
$usernameSmtp =  $_ENV['SMTP_USER'];
$passwordSmtp = $_ENV['SMTP_PASSWORD'];
$configurationSet = $_ENV['SMTP_CONFIG'];
$host =  $_ENV['SMTP_HOST'];
$port =  $_ENV['SMTP_PORT'];
/*
$recipient = 'egalindoa@uni.pe';
$subject = 'Notificación de Recuperación Clave';
$bodyText = 'Las credenciales son: ';
$bodyHtml = '<h1>Mensaje</h1><p>Se envía su usuario y contraseña actual, de tener alguna observación por favor contactar al administrador del sistema</p>';
*/
class MailController{

    public function EnviarCorreo(Mail $objmail){
        global $sender,$senderName,$usernameSmtp,$passwordSmtp,$configurationSet,$host,$port,$recipient,$subject,$bodyText,$bodyHtml;
        $mail = new PHPMailer(true);
        try {
            // Specify the SMTP settings.
            $mail->isSMTP();
            $mail->setFrom($sender);
            $mail->Username   = $usernameSmtp;
            $mail->Password   = $passwordSmtp;
            $mail->Host       = $host;
            $mail->Port       = $port;
            $mail->SMTPAuth   = true;
            $mail->SMTPSecure = 'tls';
            //$mail->addCustomHeader('X-SES-CONFIGURATION-SET', $configurationSet);
            // Specify the message recipients.
            $mail->addAddress($objmail->__GET('correo_recuperacion'));
            // You can also add CC, BCC, and additional To recipients here.
            // Specify the content of the message.
            $mail->isHTML(true);
            $mail->Subject    = $objmail->__GET('subject');
            $mail->Body       = $objmail->__GET('bodyHtml') . 'Usuario: ' . $objmail->__GET('user') . ' Password: '. $objmail->__GET('password');
            $mail->AltBody    = $objmail->__GET('bodyText');
            $mail->Send();
            echo "Email sent!" , PHP_EOL;
            } catch (phpmailerException $e) {
            echo "An error occurred. {$e->errorMessage()}", PHP_EOL; //Catch errors from PHPMailer.
            } catch (Exception $e) {
            echo "Email not sent. {$mail->ErrorInfo}", PHP_EOL; //Catch errors from Amazon SES.
            }
    }


    
}
?>