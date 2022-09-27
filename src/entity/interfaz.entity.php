<?php

class Interfaz
{
 
    private	$idInterfaz ; 
	private $Nombre; 	  
	private $Url	;   
	private $Nivel; 	 
	private $Modulo_Principal ; 
	private $IdInterfaz_Superior	;  
	private $Orden; 	   
	private $Icono; 	 
	private $Estado; 
	private $Ingresado_por; 	 
	private $Fecha_Registro; 	 
	private $Modificado_por	;  
	private $Fecha_Modificacion; 	 
	private $Eliminado; 
    
    public function __GET($atributo){ 

      return $this->$atributo; 
      
    }

    public function __SET($atributo, $variable){

      return $this->$atributo = $variable; 

    }


}