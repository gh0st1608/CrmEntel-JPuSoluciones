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

    public function v_ListarxPerfil(){
        if (isset($_REQUEST['idPerfil'])) 
        {                  
            require_once 'view/header.php';
            require_once 'view/seguridad/permiso/listar_por_perfil.php';
            require_once 'view/footer.php';  
        }else{
            header('Location: index.php?c=Perfil');
        }    
    }
    /*
    public function v_Registrar(){        
        $interfaz = new InterfazController;

        $nivel = 0;
        if (isset($_REQUEST['ModuloPrincipal']))
        {
            $nivel = 1;
            $permiso = new Permiso();
            $permiso->__SET('Perfil_id',$_REQUEST['idPerfil']);
            $permiso->__SET('Interfaz_id',$_REQUEST['ModuloPrincipal']);
            $permiso->__SET('Acceder',1);
            $permiso->__SET('Estado',1);
            $registrar_permiso = $this->model->Registrar($permiso);  

            if(isset($_REQUEST['ModuloSecundario']))
            {
                $nivel = 2;
                $permiso = new Permiso();
                $permiso->__SET('Perfil_id',$_REQUEST['idPerfil']);
                $permiso->__SET('Interfaz_id',$_REQUEST['ModuloSecundario']);
                $permiso->__SET('Acceder',1);
                $permiso->__SET('Estado',1);
                $registrar_permiso = $this->model->Registrar($permiso);
            }
        }

       
        if($registrar_permiso=='error'){
            header('Location: index.php?c=Permiso&a=v_Registrar');
         }else{
            header('Location: index.php?c=Permiso');
         }
        
    }
    */

    public function v_Actualizar(){        
        require_once 'view/header.php';
        require_once 'view/seguridad/permiso/actualizar.php';
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
        $permiso = new Permiso();
        $permiso->__SET('idPermiso',$idPermiso);

        $consulta = $this->model->Consultar($permiso);
        return $consulta;
    }

    public function Listar_por_perfil($idPerfil)
    {   
        $permiso = new Permiso();
        $permiso->__SET('Perfil_id',$idPerfil);
        $permisos = $this->model->Listar_por_perfil($permiso);
        return $permisos;
    }

    public function Actualizar(){
        $permiso = new Permiso();
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
        $permiso = new Permiso();

        if (isset($_REQUEST['ModuloPrincipal']) && isset($_REQUEST['ModuloSecundario']))
        {
            $permiso->__SET('Perfil_id',$_REQUEST['idPerfil']);
            $permiso->__SET('Interfaz_id',$_REQUEST['ModuloSecundario']);
            $permiso->__SET('Acceder',1);
            $permiso->__SET('Estado',1);
            $registrar_permiso = $this->model->Registrar($permiso);  
        }else
        {
            $permiso->__SET('Perfil_id',$_REQUEST['idPerfil']);
            $permiso->__SET('Interfaz_id',$_REQUEST['ModuloPrincipal']);
            $permiso->__SET('Acceder',1);
            $permiso->__SET('Estado',1);
            $registrar_permiso = $this->model->Registrar($permiso);

        }

       
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