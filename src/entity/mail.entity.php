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

}