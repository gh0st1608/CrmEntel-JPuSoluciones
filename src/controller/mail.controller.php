<?php
//require_once 'library/mailing.php';
//require_once "vendor/autoload.php";
require_once "vendor/autoload.php";


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$dotenv = Dotenv\Dotenv::createImmutable('./');
$dotenv->load();

/*
$sender = getenv('SMTP_SENDER');
$senderName = getenv('SMTP_SENDERNAME');
$usernameSmtp = getenv('SMTP_USER');
$passwordSmtp = getenv('SMTP_PASSWORD');
$configurationSet = getenv('SMTP_CONFIG');
$host = getenv('SMTP_HOST');
$port = 587;//getenv('SMTP_PORT');
$recipient = 'egalindoa@uni.pe';
$subject = 'Amazon SES test (SMTP interface accessed using PHP)';
$bodyText = 'Las credenciales son: ';
$bodyHtml = '<h1>Email Test</h1><p>This email was sent through the <a href="https://aws.amazon.com/ses">Amazon SES</a> SMTP interface using the <a href="https://github.com/PHPMailer/PHPMailer"> PHPMailer</a> class.</p>';
*/
$sender = 'egalindoa@uni.pe';
$senderName = 'Erick';
$usernameSmtp = 'AKIA22XAJNR7QY554C4V';
$passwordSmtp = 'BB410MvHXQy7Dcl7DGsZJD8oHAS5KyDBsbS9kscddpwx';
$configurationSet = 'ConfigSet';
$host = 'email-smtp.us-east-1.amazonaws.com';
$port = 587;//getenv('SMTP_PORT');
$recipient = 'egalindoa@uni.pe';
$subject = 'Amazon SES test (SMTP interface accessed using PHP)';
$bodyText = 'Las credenciales son: ';
$bodyHtml = '<h1>Email Test</h1><p>This email was sent through the <a href="https://aws.amazon.com/ses">Amazon SES</a> SMTP interface using the <a href="https://github.com/PHPMailer/PHPMailer"> PHPMailer</a> class.</p>';


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
            $mail->Subject    = $subject;
            $mail->Body       = $bodyHtml . 'Usuario: ' . $objmail->__GET('user') . ' Password: '. $objmail->__GET('password');
            $mail->AltBody    = $bodyText;
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