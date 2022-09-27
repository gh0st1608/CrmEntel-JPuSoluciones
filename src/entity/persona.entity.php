<?php

class Persona
{



    private $idPersona;
    private $codigo;
    private $dni;
    private $primer_nombre;
    private $segundo_nombre;
    private $apellido_paterno;
    private $apellido_materno;
    private $fecha_nacimiento;
    private $sexo;
    private $celular;
    private $fecha_ingreso;
    private $tipo_horario;
    private $horario_entrada;
    private $horario_salida;
    private $sueldo;
    private $correo;
    private $anexo;
    private $Area_id;
    private $Cargo_id;
    private $Sede_id;
    private $fecha_salida;
    private $fecha_registro;
    private $ingresado_por;
    private $fecha_modificacion;
    private $modificado_por;
    private $activo;
    private $eliminado;
    
    public function __GET($atributo){ 

      return $this->$atributo; 
      
    }

    public function __SET($atributo, $variable){

      return $this->$atributo = $variable; 

    }


}