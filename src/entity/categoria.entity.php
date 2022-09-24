<?php

class Categoria
{

    private $idCategoria;
    private $Nombre;
    private $Estado;
    private $Ingresado_por;
    private $Fecha_Registro;
    private $Eliminado;
    
    public function __GET($atributo){ 

      return $this->$atributo; 
      
    }

    public function __SET($atributo, $variable){

      return $this->$atributo = $variable; 

    }


}