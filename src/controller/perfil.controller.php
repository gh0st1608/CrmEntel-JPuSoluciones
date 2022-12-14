<?php
require_once 'model/perfil.model.php';
require_once 'entity/perfil.entity.php';


class PerfilController{    
  
    private $model;
    
    public function __CONSTRUCT()
    {
        $this->model = new PerfilModel();
    }
    /**==========================Vistas=======================================*/
    public function Index(){        
        require_once 'view/header.php';
        require_once 'view/seguridad/perfil/index.php';
        require_once 'view/footer.php';       
    }

    public function v_Actualizar(){        
        require_once 'view/header.php';
        require_once 'view/seguridad/perfil/actualizar.php';
        require_once 'view/footer.php';       
    }

    public function v_Registrar(){        
        require_once 'view/header.php';
        require_once 'view/seguridad/perfil/registrar.php';
        require_once 'view/footer.php';       
    }
    /**=======================================================================*/   
    public function Listar()
    {
        $perfiles = $this->model->Listar();
        return $perfiles;
    }

    public function Consultar($idPerfil)
    {
        $perfil = new Perfil();
        $perfil->__SET('idPerfil',$idPerfil);

        $consulta = $this->model->Consultar($perfil);
        return $consulta;
    }

    public function Actualizar(){
        $perfil = new Perfil();
        $perfil->__SET('idPerfil',$_REQUEST['idPerfil']);
        $perfil->__SET('nombre',$_REQUEST['nombre']);   
        $perfil->__SET('modificado_por',$_SESSION['Usuario_Actual']);
        $perfil->__SET('activo',$_REQUEST['activo']);       
        $actualizar_perfil = $this->model->Actualizar($perfil);  
         
        if($actualizar_perfil=='error'){
            header('Location: index.php?c=Perfil&a=v_Actualizar&idUsuario='. $perfil->__GET('idPerfil'));
            echo 'No se Ha Podido Actualizar el Usuario';
         }else{
            echo 'Usuario Actualizado Correctamente';
            header('Location: index.php?c=Perfil');
         }
    }

    public function Registrar(){
        $perfil = new Perfil(); 
        $perfil->__SET('nombre',$_REQUEST['nombre']);         
        $perfil->__SET('ingresado_por',$_SESSION['Usuario_Actual']);
        $registrar_perfil = $this->model->Registrar($perfil);  
         
        if($registrar_perfil=='error'){
            header('Location: index.php?c=Perfil&a=v_Registrar');
            echo 'No se Ha Podido Registrar el perfil';
         }else{
            echo 'Perfil Registrado Correctamente';
            header('Location: index.php?c=Perfil');
         }
    }

    public function Eliminar(){
        $perfil = new Perfil();
        $perfil->__SET('idPerfil',$_REQUEST['idPerfil']);      
        $perfil->__SET('modificado_por',$_SESSION['Usuario_Actual']);
        $perfil->__SET('eliminado',1); 
        $eliminar_perfil = $this->model->eliminar($perfil);  
         
        if($eliminar_perfil=='error'){
            header('Location: index.php?c=Perfil');
            echo 'No se Ha Podido Eliminar el Perfil';
         }else{
            echo 'Perfil Eliminado Correctamente';
            header('Location: index.php?c=Perfil');
         }
    }


}