<?php

class Permiso
{


    private $idPermiso;
    private $Perfil_id;
    private $Interfaz_id;
    private $Acceder;
    private $Estado;
    private $Ingresado_por;
    private $Fecha_Registro;
    private $Modificado_por;
    private $Fecha_Modificacion;
    private $Eliminado;

    public function __GET($atributo){ 

      return $this->$atributo; 
      
    }

    public function __SET($atributo, $variable){

      return $this->$atributo = $variable; 

    }


   

}