<?php

class LogSesion 
{

    private $idLog_Sesion;
    private $Login;
    private $Password;
    private $LoggedIn;
    private $IP;
    private $Dispositivo;
    private $NombreDispositivo;
    private $Fecha_Registro;
 

    public function __GET($atributo){ 

      return $this->$atributo; 
      
    }

    public function __SET($atributo, $variable){

      return $this->$atributo = $variable; 

    }

   

}