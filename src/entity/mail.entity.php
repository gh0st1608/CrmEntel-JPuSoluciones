<?php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mail
{

    private $correo_recuperacion;
    private $sender;
    private $senderName;
    private $user;
    private $password;
    private $usernameSmtp = 'AKIA22XAJNR755IRWW4Y';
    private $passwordSmtp = 'BI24G5oiD74H4865lsydibO8i21IAr9AaepoXruZwS5x';
    private $configurationSet = 'ConfigSet';
    private $host = 'email-smtp.us-east-1.amazonaws.com';   
    private $port = 587;
    private $subject = 'Amazon SES test (SMTP interface accessed using PHP)';
    private $bodyText = 'Email Test\r\nTu password es.';
    private $bodyHtml = '<h1>Email Test</h1>
    <p>This email was sent through the
    <a href="https://aws.amazon.com/ses">Amazon SES</a> SMTP
    interface using the <a href="https://github.com/PHPMailer/PHPMailer">
    PHPMailer</a> class.</p>';

    public function __GET($atributo){ 

      return $this->$atributo; 
      
    }

    public function __SET($atributo, $variable){

      return $this->$atributo = $variable; 

    }

    public function settingSMTP() {

        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->setFrom($sender, $senderName);
            $mail->Username   = $objmail$usernameSmtp;
            $mail->Password   = $passwordSmtp;
            $mail->Host       = $host;
            $mail->Port       = $port;
            $mail->SMTPAuth   = true;
            $mail->SMTPSecure = 'tls';
            $mail->addCustomHeader('X-SES-CONFIGURATION-SET', $configurationSet);
            $mail->isHTML(true);
            $mail->Subject    = $subject;
            $mail->Body       = $bodyHtml;
            $mail->AltBody    = $bodyText;

        } catch (phpmailerException $e) {
            echo "An error occurred. {$e->errorMessage()}", PHP_EOL; //Catch errors from PHPMailer.
        } catch (Exception $e) {
            echo "Email not sent. {$mail->ErrorInfo}", PHP_EOL; //Catch errors from Amazon SES.
        }

        return $mail

    }
   
    public function sendMail() {
        $mail->Send();
    }

}