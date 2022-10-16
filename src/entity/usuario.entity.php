<?php

class Usuario
{


    private $idUsuario;
    private $Persona_id;
    private $Login;
    private $Perfil_id;
    private $Password;
    private $PasswordEquipo;
    private $Estado;
    private $Fecha_registro;
    private $Ingresado_por;
    private $Modificado_por;
    private $Fecha_modificacion;
    private $Eliminado;

    public function __GET($atributo){ 

      return $this->$atributo; 
      
    }

    public function __SET($atributo, $variable){

      return $this->$atributo = $variable; 

    }

   

}
 