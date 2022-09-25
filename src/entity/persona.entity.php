<?php

class Persona
{



    private $idPersona;
    private $Codigo;
    private $Dni;
    private $Primer_Nombre;
    private $Segundo_Nombre;
    private $Apellido_Paterno;
    private $Apellido_materno;
    private $Fecha_nacimiento;
    private $Sexo;
    private $Celular;
    private $Fecha_ingreso;
    private $Tipo_horario;
    private $Horario_entrada;
    private $Horario_salida;
    private $Sueldo;
    private $Correo;
    private $Anexo;
    private $Area_id;
    private $Cargo_id;
    private $Sede_id;
    private $Fecha_salida;
    private $Fecha_registro;
    private $Ingresado_por;
    private $Fecha_modificacion;
    private $Modificado_por;
    private $Estado;
    private $Eliminado;
    
    public function __GET($atributo){ 

      return $this->$atributo; 
      
    }

    public function __SET($atributo, $variable){

      return $this->$atributo = $variable; 

    }


}