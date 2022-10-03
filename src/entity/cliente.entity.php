<?php

class Cliente
{



    private $idCliente;
    private $TipoDocumento;
    private $Documento;
    private $Nombre_Cliente;
    private $Apellido_Paterno;
    private $Apellido_Materno;
    private $Nacionalidad;
    private $Lugar_Nacimiento;
    private $Fecha_Nacimiento;
    private $Nombre_Padre;
    private $Nombre_Madre;
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
