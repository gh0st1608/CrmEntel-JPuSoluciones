<?php
include_once 'model/conexion.php';
require_once 'controller/usuario.controller.php'; 
require 'controller/interfaz.controller.php'; 
require_once 'includes.controller.php';

class IndexController extends IncludesController{    
  
    
    public function __CONSTRUCT()
    {
        try
        {
              $this->pdo = new Conexion();                
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }
    
    public function Index(){

  
        require_once 'view/header.php';
        require_once 'view/index.php';
        require_once 'view/footer.php';
   

       
    }


    public function Error(){
        
  
       require_once 'view/header.php';
        require_once 'view/404.php';
        require_once 'view/footer.php';
      
    }

    public function Denegado(){  
        require_once 'view/header.php';
        require_once 'view/denegado.php';
        require_once 'view/footer.php';
      
    }

    public function MediosPago(){  
        require_once 'view/header.php';
        require_once 'view/documentos/medios_pago.php';
        require_once 'view/footer.php';
      
    }

    public function CodigosTipificacion(){  
        require_once 'view/header.php';
        require_once 'view/documentos/codigos_tipificacion.php';
        require_once 'view/footer.php';
      
    }

    public function CerrarSesion(){
 
        if($_SESSION['user_session']!="")
        {
            $user->redirect('home.php');
        }
        if(isset($_GET['logout']) && $_GET['logout']=="true")
        {
            $user->logout();
            $user->redirect('login.php');
        }
        if(!isset($_SESSION['user_session']))
        {
            $user->redirect('login.php');
        }
    }
    
    public function listar_menu()
    {
        try
        {
            $result = array();

            $stm = $this->pdo->prepare("select * from menu where estado=1");
            $stm->execute();
            $registro = $stm->fetchAll();            
            return $registro;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    } 




}