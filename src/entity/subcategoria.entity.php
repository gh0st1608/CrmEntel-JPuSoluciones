<?php

class SubCategoria
{

    private $idSubCategoria;
    private $Categoria_id;
    private $Nombre;
    private $Aplicar_Logica;
    private $Logica_Json;
    private $Estado;
    private $Ingresado_por;
    private $Fecha_Registro;
    private $fecha_modificacion;
    private $Eliminado;
    
    public function __GET($atributo){ 

      return $this->$atributo; 
      
    }

    public function __SET($atributo, $variable){

      return $this->$atributo = $variable; 

    }


}