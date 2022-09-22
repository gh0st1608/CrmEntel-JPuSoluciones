<?php
  require ("library/SunatPHP/curl.php");
  require ("library/SunatPHP/sunat.php");
class ProcesosController extends IncludesController{

	public function ImportarInformacion(){        
        require_once 'view/header.php';
        require_once 'view/procesos/importar/informacion_contacto.php';
        require_once 'view/footer.php';       
    }

    public function ImportarGestionesCall(){        
        require_once 'view/header.php';
        require_once 'view/procesos/importar/gestiones_call.php';
        require_once 'view/footer.php';       
    }



    
}