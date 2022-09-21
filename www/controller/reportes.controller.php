<?php
require_once 'model/cartera.model.php';
require_once 'entity/cartera.entity.php';
require_once 'includes.controller.php';

class ReportesController extends IncludesController{        
  

    /**==========================Vistas=======================================*/
    public function ExpGestionesFiltros(){        
        require_once 'view/header.php';
        require_once 'view/reportes/gestiones/exportar_filtros.php';
        require_once 'view/footer.php';       
    }



    public function v_Exportar_Gestiones(){
        $FechInic=$_REQUEST['FechInic'];
        $FechFin=$_REQUEST['FechFin'];

   
            if (isset($_REQUEST['Carteras']) && $_REQUEST['Carteras']!='null') {
            $Carteras=$_REQUEST['Carteras']; 
            $sqlCarteras="and campana.cartera_id in($Carteras)";

            }else{
                $sqlCarteras="";
            }
   
            if (isset($_REQUEST['Canales']) && $_REQUEST['Canales']!='null') {
            $Canales=$_REQUEST['Canales'];    
            $sqlCanales="and gestion.tipoGestion_id in($Canales)";

            }else{
                $sqlCanales="";
            }


        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=Gestiones del ".$FechInic." al ".$FechFin.".xls");
        header("Pragma: no-cache");
        header("Expires: 0");    
        require_once 'view/reportes/gestiones/excel_gestionesfiltros.php';        
    }







}