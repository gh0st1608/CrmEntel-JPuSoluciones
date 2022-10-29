<?php


class Mail
{

    private $correo_recuperacion;
    private $sender;
    private $senderName ;
    private $user;
    private $password;
    private $usernameSmtp;
    private $passwordSmtp;
    private $configurationSet;
    private $host;   
    private $port;
    private $subject;
    private $bodyText;
    private $bodyHtml;



    public function __GET($atributo){ 

      return $this->$atributo; 
      
    }

    public function __SET($atributo, $variable){

      return $this->$atributo = $variable; 

    }

    public function __construct(){
      $this->subject = 'Notificacion sobre la Recuperacion de Clave';
      $this->bodyText = 'Las credenciales son: ';
      $this->bodyHtml = '<h1>Mensaje</h1><p>Se envía su usuario y contraseña actual, de tener alguna observación por favor contactar al administrador del sistema. Gracias</p>';
		}
    
}