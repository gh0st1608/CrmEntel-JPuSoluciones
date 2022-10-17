<?php
require_once 'model/licencia.model.php';
require_once 'entity/licencia.entity.php';


class LicenciaController{    
  
    private $model;
    
    public function __CONSTRUCT()
    {
        $this->model = new LicenciaModel();
    }
    /**==========================Vistas=======================================*/
    public function Index(){        
        require_once 'view/header.php';
        require_once 'view/seguridad/licencia/index.php';
        require_once 'view/footer.php';       
    }

    /**=======================================================================*/   
    public function Listar()
    {
        $Licenciaes = $this->model->Listar();
        return $Licenciaes;
    }

    public function Consultar($idLicencia)
    {
        $Licencia = new Licencia();
        $Licencia->__SET('idLicencia',$idLicencia);

        $consulta = $this->model->Consultar($Licencia);
        return $consulta;
    }

    public function Registrar($indice){
        $Licencia = new Licencia();
        $fecha_hoy_año = date("Y");
        $fecha_hoy_mes = date("m");
        $fecha_hoy_dia = date("d");
        $fecha_actual = date("d-M");
        $periodo_año_actual = date("Y");
        $periodo_mes_actual = date("m");
        $periodo_actual = $periodo_año_actual.$periodo_mes_actual;
        $fecha_referencia_actual = $fecha_hoy_año . "-" . $fecha_hoy_mes . "-" . $fecha_hoy_dia;
        $ultima_dia_fecha_actual = date("t-M", strtotime(date("Y-m-d")));

        print_r("periodo actual".$periodo_actual);
        print_r("fecha actual".$fecha_actual);
        print_r("ultima fecha actual".$ultima_dia_fecha_actual);
        print_r("fecha referencia actual".$fecha_referencia_actual);
        $Licencia->__SET('Usuario_id',$indice);
        $Licencia->__SET('Periodo',$periodo_actual);
        $Licencia->__SET('Fecha_Inicio',$fecha_actual);
        $Licencia->__SET('Fecha_Fin',$ultima_dia_fecha_actual);
        $Licencia->__SET('Estado',1);           
        $Licencia->__SET('Ingresado_por',$_SESSION['Usuario_Actual']);
        $registrar_Licencia = $this->model->Registrar($Licencia);  
         
        if($registrar_Licencia=='error'){
            header('Location: index.php?c=Licencia&a=v_Registrar');
         }else{
            header('Location: index.php?c=Licencia');
         }
    }

    public function Inactivar_Licencia($indice){
        $Licencia = new Licencia();
        $fecha_hoy_año = date("Y");
        $fecha_hoy_mes = date("m");
        $fecha_hoy_mes = date("t");
        $fecha_referencia_actual = $fecha_hoy_año + "-" + $fecha_hoy_mes + "-" +$fecha_hoy_mes;
        $ultima_dia_fecha_actual = date("m-t", strtotime($fecha_referencia_actual));


        $Licencia->__SET('Usuario_id',$indice);
        $Licencia->__SET('Periodo',$indice);
        $Licencia->__SET('Fecha_Inicio',$_REQUEST['Nombre']);
        $Licencia->__SET('Fecha_Fin',$_REQUEST['Nombre']);
        $Licencia->__SET('Estado',1);           
        $Licencia->__SET('Ingresado_por',$_SESSION['Usuario_Actual']);
        $registrar_Licencia = $this->model->Registrar($Licencia);  
         
        if($registrar_Licencia=='error'){
            header('Location: index.php?c=Licencia&a=v_Registrar');
         }else{
            header('Location: index.php?c=Licencia');
         }
    }


    /*
    public function Actualizar(){
        $Licencia = new Licencia();
        $Licencia->__SET('idLicencia',$_REQUEST['idLicencia']);
        $Licencia->__SET('Nombre',$_REQUEST['Nombre']);   
        $Licencia->__SET('Modificado_por',$_SESSION['Usuario_Actual']);
        $Licencia->__SET('Estado',$_REQUEST['Estado']);       
        $actualizar_Licencia = $this->model->Actualizar($Licencia);  
         
        if($actualizar_Licencia=='error'){
            header('Location: index.php?c=Licencia&a=v_Actualizar&idLicencia='. $Licencia->__GET('idLicencia'));
         }else{
            header('Location: index.php?c=Licencia');
         }
    }



    public function Eliminar(){
        $Licencia = new Licencia();
        $Licencia->__SET('idLicencia',$_REQUEST['idLicencia']);      
        $Licencia->__SET('Modificado_por',$_SESSION['Usuario_Actual']);
        $Licencia->__SET('Eliminado',1); 
        $eliminar_Licencia = $this->model->eliminar($Licencia);  
         
        if($eliminar_Licencia=='error'){
            header('Location: index.php?c=Licencia');
         }else{
            header('Location: index.php?c=Licencia');
         }
    }
*/

}