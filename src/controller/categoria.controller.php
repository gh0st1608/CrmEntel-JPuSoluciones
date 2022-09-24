<?php
require_once 'model/categoria.model.php';
require_once 'entity/categoria.entity.php';


class CategoriaController{    
  
    private $model;
    
    public function __CONSTRUCT()
    {
        $this->model = new CategoriaModel();
    }
    /**==========================Vistas=======================================*/
    public function Index(){        
        require_once 'view/header.php';
        require_once 'view/administracion/categoria/index.php';
        require_once 'view/footer.php';       
    }

    public function v_Actualizar(){        
        require_once 'view/header.php';
        require_once 'view/administracion/categoria/actualizar.php';
        require_once 'view/footer.php';       
    }

    public function v_Registrar(){        
        require_once 'view/header.php';
        require_once 'view/administracion/categoria/registrar.php';
        require_once 'view/footer.php';       
    }
    /**=======================================================================*/   
    public function Listar()
    {
        $categorias = $this->model->Listar();
        return $categorias;
    }

    public function Consultar($idCategoria)
    {
        $categoria = new Categoria();
        $categoria->__SET('idCategoria',$idCategoria);

        $consulta = $this->model->Consultar($categoria);
        return $consulta;
    }

    public function Actualizar(){
        $categoria = new Categoria();
        $categoria->__SET('idCategoria',$_REQUEST['idCategoria']);
        $categoria->__SET('Nombre',$_REQUEST['Nombre']);              
        $categoria->__SET('Estado',$_SESSION['Estado']);    
        $actualizar_categoria = $this->model->Actualizar($categoria);  
         
        if($actualizar_categoria=='error'){
            header('Location: index.php?c=Categoria&a=v_Actualizar&idCategoria='. $categoria->__GET('idCategoria'));
            echo 'No se Ha Podido Actualizar';
        }else{
            echo 'Actualizado Correctamente';
            header('Location: index.php?c=Categoria');
         }
    }

    public function Registrar(){
        
        $categoria = new Categoria();
        $categoria->__SET('Nombre',$_REQUEST['Nombre']);
        $categoria->__SET('Estado',$_REQUEST['Estado']);
        $categoria->__SET('Ingresado_por',$_SESSION['Usuario_Actual']);     
       
        $registrar_categoria = $this->model->Registrar($categoria);  
         
        if($registrar_categoria=='error'){
            header('Location: index.php?c=Categoria&a=v_Registrar');
           // echo 'No se Ha Podido Registrar';
         }else{
           // echo 'Registrado Correctamente';
            header('Location: index.php?c=Categoria');
         }
    }

    public function Eliminar(){
        $categoria = new Contacto();
        $categoria->__SET('idCategoria',$_REQUEST['idCategoria']);      
        $categoria->__SET('Ingresado_por',$_SESSION['Usuario_Actual']);
        $categoria->__SET('Eliminado',1); 
        $eliminar_categoria = $this->model->Eliminar($categoria);  
         
        if($eliminar_categoria=='error'){
            echo 'No se Ha Podido Eliminar';
            header('Location: index.php?c=Categoria');            
         }else{
            echo 'Eliminado Correctamente';
            header('Location: index.php?c=Categoria');
         }
    }

    public function ListarxTipo_Ajax()
    {
        $tipo = $_POST['tipo_categoria'];
        $registros = $this->model->ListarxTipo($tipo);

        echo  json_encode($registros);
    }



}