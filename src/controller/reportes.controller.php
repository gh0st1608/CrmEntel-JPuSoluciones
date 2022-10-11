<?php
require_once 'model/ficha_venta.model.php';
require_once 'entity/ficha_venta.entity.php';
require_once 'includes.controller.php';

class ReportesController extends IncludesController{        
  

    /**==========================Vistas=======================================*/
    public function v_Exp_Fichas_Venta(){        
        require_once 'view/header.php';
        require_once 'view/reportes/ficha_venta/exportar_filtros.php';
        require_once 'view/footer.php';       
    }



    public function Excel_Fichas_Venta(){
        $FechaInicio=$_REQUEST['FechaInicio'];
        $FechaFin=$_REQUEST['FechaFin'];

   
        if (isset($_REQUEST['VBO_Estado_Venta_BO']) && $_REQUEST['VBO_Estado_Venta_BO']!='null') {
            $VBO_Estado_Venta_BO=$_REQUEST['VBO_Estado_Venta_BO']; 
            $sqlVBO_Estado_Venta_BO="and ficha_venta.VBO_Estado_Venta_BO in($VBO_Estado_Venta_BO)";

        }else{
            $sqlVBO_Estado_Venta_BO="";
        }


        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=Reporte_Fichas_Venta_".$FechaInicio."_al_".$FechaFin.".xls");
        header("Pragma: no-cache");
        header("Expires: 0");    
        require_once 'view/reportes/ficha_venta/excel_fichas_venta_filtro.php';        
    }


    public function Excel_RH_Fichas_Venta(){
        $FechaInicio=$_REQUEST['FechaInicio'];
        $FechaFin=$_REQUEST['FechaFin'];

        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=Reporte_Historico_Fichas_Venta_".$FechaInicio."_al_".$FechaFin.".xls");
        header("Pragma: no-cache");
        header("Expires: 0");    
        require_once 'view/reportes/ficha_venta/excel_rh_fichas_venta_filtro.php';        
    }







}