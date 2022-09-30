<?php
require_once 'model/permiso.model.php';
require_once 'entity/permiso.entity.php';


class PermisoController{    
  
    private $model;
    
    public function __CONSTRUCT()
    {
        $this->model = new PermisoModel();
    }
    /**==========================Vistas=======================================*/
    public function Index(){        
        require_once 'view/header.php';
        require_once 'view/seguridad/permiso/index.php';
        require_once 'view/footer.php';       
    }

    public function v_Actualizar(){        
        require_once 'view/header.php';
        require_once 'view/seguridad/permiso/actualizar.php';
        require_once 'view/footer.php';       
    }

    public function v_Registrar(){        
        require_once 'view/header.php';
        require_once 'view/seguridad/permiso/registrar.php';
        require_once 'view/footer.php';       
    }
    /**=======================================================================*/   
    public function Listar()
    {
        $permisos = $this->model->Listar();
        return $permisos;
    }

    public function Consultar($idPermiso)
    {
        $permiso = new permiso();
        $permiso->__SET('idPermiso',$idPermiso);

        $consulta = $this->model->Consultar($permiso);
        return $consulta;
    }

    public function Actualizar(){
        $permiso = new permiso();
        $permiso->__SET('idPermiso',$_REQUEST['idPermiso']);
        $permiso->__SET('Perfil_id',$_REQUEST['Perfil_id']);
        $permiso->__SET('Interfaz_id',$_REQUEST['Interfaz_id']);
        $permiso->__SET('Acceder',$_REQUEST['Acceder']);           
        $permiso->__SET('Estado',$_REQUEST['Estado']);
        $permiso->__SET('Ingresado_por',$_SESSION['Usuario_Actual']);    
        $actualizar_permiso = $this->model->Actualizar($permiso);  
         
        if($actualizar_permiso=='error'){
            header('Location: index.php?c=Permiso&a=v_Actualizar&idPermiso='. $permiso->__GET('idPermiso'));
        }else{
            header('Location: index.php?c=Permiso');
         }
    }

    public function Registrar(){
        
        $permiso->__SET('Perfil_id',$_REQUEST['Perfil_id']);
        $permiso->__SET('Interfaz_id',$_REQUEST['Interfaz_id']);
        $permiso->__SET('Acceder',$_REQUEST['Acceder']);           
        $permiso->__SET('Estado',$_REQUEST['Estado']);
        $permiso->__SET('Ingresado_por',$_SESSION['Usuario_Actual']);     
       
        $registrar_permiso = $this->model->Registrar($permiso);  
       
        if($registrar_permiso=='error'){
            header('Location: index.php?c=Permiso&a=v_Registrar');
         }else{
            header('Location: index.php?c=Permiso');
         }
 
    }

    public function Eliminar(){
        $permiso = new permiso();
        $permiso->__SET('idPermiso',$_REQUEST['idPermiso']);      
        $permiso->__SET('Ingresado_por',$_SESSION['Usuario_Actual']);
        $permiso->__SET('Eliminado',1); 
        $eliminar_permiso = $this->model->Eliminar($permiso);  
         
        if($eliminar_permiso=='error'){
            header('Location: index.php?c=Permiso');            
         }else{
            header('Location: index.php?c=Permiso');
         }
    }

    public function ListarxTipo_Ajax()
    {
        $tipo = $_POST['tipo_permiso'];
        $registros = $this->model->ListarxTipo($tipo);

        echo  json_encode($registros);
    }



}