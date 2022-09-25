<?php

class Usuario
{


    private $idUsuario;
    private $Persona_id;
    private $Perfil_id;
    private $Login;
    private $Password;
    private $Estado;
    private $Ingresado_por;
    private $Fecha_registro;
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
 