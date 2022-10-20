<?php
require_once 'model/licencia.model.php';
require_once 'entity/licencia.entity.php';
require_once 'includes.controller.php';


class LicenciaController extends IncludesController{    
  
    private $model;
    
    public function __CONSTRUCT()
    {
        $this->model = new LicenciaModel();
    }
    /**==========================Vistas=======================================*/
    public function Index(){        
        require_once 'view/header.php';
        require_once 'view/licencias/index.php';
        require_once 'view/footer.php';       
    }

    /**=======================================================================*/   
    public function Listar()
    {
        $Licencia = $this->model->Listar();
        return $Licencia;
    }

    public function ListarPeriodos()
    {
        $Licencia = $this->model->ListarPeriodos();
        return $Licencia;
    }

    public function Consultar($idLicencia)
    {
        $Licencia = new Licencia();
        $Licencia->__SET('idLicencia',$idLicencia);

        $consulta = $this->model->Consultar($Licencia);
        return $consulta;
    }

    public function Reporte_Excel_Licencia(){
        $Periodo=$_REQUEST['Periodo'];

   
        if (isset($_REQUEST['Periodo']) && $_REQUEST['Periodo']!='null') {
            $VBO_Periodo=$_REQUEST['Periodo']; 
            $sqlVBO_Periodo="and licencia.Periodo in($VBO_Periodo)";

        }else{
            $sqlVBO_Periodo="";
        }


        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=Reporte_Licencias_".$Periodo.".xls");
        header("Pragma: no-cache");
        header("Expires: 0");    
        require_once 'view/licencias/excel_reporte_periodo.php';        
    }

    public function Registrar($indice,$bolFlujo){
        $Licencia = new Licencia();

        /*Fecha Actual*/
        $fecha_actual = date("d-M");
        $date_fecha_actual = new DateTime($fecha_actual);
        $fecha_actual_formato=$date_fecha_actual->format('Y-m-d');
        

        /*ultimo dia del mes*/
        $ultima_dia_fecha_actual = date("t-M", strtotime(date("Y-m-d")));
        $date_ultima_dia_fecha_actual = new DateTime($ultima_dia_fecha_actual);
        $ultima_dia_fecha_actual_formato = $date_ultima_dia_fecha_actual->format('Y-m-d');

        /*Periodo*/
        $periodo_año_actual = date("Y");
        $periodo_mes_actual = date("m");
        $periodo_actual = $periodo_año_actual.$periodo_mes_actual;


        $Licencia->__SET('Usuario_id',$indice);
        $Licencia->__SET('Periodo',$periodo_actual);
        $Licencia->__SET('Fecha_Inicio',$fecha_actual_formato);
        $Licencia->__SET('Fecha_Fin',$ultima_dia_fecha_actual_formato);
        $Licencia->__SET('Estado',1);           
        $Licencia->__SET('Ingresado_por',$_SESSION['Usuario_Actual']);
        $registrar_Licencia = $this->model->Registrar($Licencia);  
         
        if($registrar_Licencia=='error'){
            header('Location: index.php?c=Licencia&a=v_Registrar');
         }else{
            if($bolFlujo)
            {
                header('Location: index.php?c=Licencia');
            }else{
                //nothing
            }
            
         }
    }

    public function Inactivar_Licencia($idUsuario){
        $Licencia = new Licencia();
        /*Fecha Actual*/
        $fecha_actual = date("d-M");
        $date_fecha_actual = new DateTime($fecha_actual);
        $fecha_actual_formato=$date_fecha_actual->format('Y-m-d');


        $Licencia->__SET('Usuario_id',$idUsuario);
        $Licencia->__SET('Fecha_Fin',$fecha_actual_formato);
        $Licencia->__SET('Estado',0);           
        $Licencia->__SET('Ingresado_por',$_SESSION['Usuario_Actual']);
        $Inactivar_Licencia = $this->model->Inactivar_Licencia($Licencia);  
         
        if($Inactivar_Licencia=='error'){
            header('Location: index.php?c=Licencia&a=v_Registrar');
         }else{
            //header('Location: index.php?c=Licencia');
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