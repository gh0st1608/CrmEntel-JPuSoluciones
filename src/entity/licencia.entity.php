<?php
class Licencia
{

    private $idLicencia;
    private $Usuario_id;
    private $Periodo;
    private $Fecha_Inicio;
    private $Fecha_Fin;
    private $Estado;
    private $Ingresado_por;
    private $Fecha_registro;
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