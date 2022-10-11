<?php

class Persona
{



    private $idPersona;
    //private $codigo;
    private $Tipo_Documento;
    private $Documento;
    private $Primer_Nombre;
    private $Segundo_Nombre;
    private $Apellido_Paterno;
    private $Apellido_Materno;
    private $Fecha_Nacimiento;
    private $Sexo;
    private $Celular;
    private $Cargo_id_SubCategoria;
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