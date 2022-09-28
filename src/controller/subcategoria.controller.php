<?php
require_once 'model/subcategoria.model.php';
require_once 'entity/subcategoria.entity.php';


class SubCategoriaController{    
  
    private $model;
    
    public function __CONSTRUCT()
    {
        $this->model = new SubCategoriaModel();
    }
    /**==========================Vistas=======================================*/
    public function Index(){
        
        require_once 'view/header.php';
        require_once 'view/administracion/subcategoria/index.php';
        require_once 'view/footer.php';       
    }

    public function ListarxCategoria(){
        if (isset($_REQUEST['idCategoria'])) 
        {                  
            require_once 'view/header.php';
            require_once 'view/administracion/subcategoria/listar_por_categoria.php';
            require_once 'view/footer.php';  
        }else{
            header('Location: index.php?c=SubCategoria');
        }    
    }


    public function v_Actualizar(){        
        require_once 'view/header.php';
        require_once 'view/administracion/subcategoria/actualizar.php';
        require_once 'view/footer.php';       
    }

    public function v_Registrar(){        
        require_once 'view/header.php';
        require_once 'view/administracion/subcategoria/registrar.php';
        require_once 'view/footer.php';       
    }
    /**=======================================================================*/   
    public function Listar()
    {
        $subcategorias = $this->model->Listar();
        return $subcategorias;
    }

    public function Listar_por_categoria($idCategoria)
    {   
        $subcategoria = new SubCategoria();
        $subcategoria->__SET('Categoria_id',$idCategoria);
        $subcategorias = $this->model->Listar_por_categoria($subcategoria);
        return $subcategorias;
    }

    public function Consultar($idSubCategoria)
    {
        $subcategoria = new SubCategoria();
        $subcategoria->__SET('idSubCategoria',$idSubcategoria);

        $consulta = $this->model->Consultar($subcategoria);
        return $consulta;
    }

    public function ConsultarCategoria($idCategoria)
    {
        $subcategoria = new SubCategoria();
        $subcategoria->__SET('Categoria_id',$idCategoria);
        $consulta = $this->model->Consultar($subcategoria);
        return $consulta;
    }


    public function Actualizar(){
        $subcategoria = new SubCategoria();
        $subcategoria->__SET('idSubCategoria',$_REQUEST['idSubCategoria']);
        $subcategoria->__SET('Categoria_id',$_REQUEST['Categoria_id']);
        $subcategoria->__SET('Nombre',$_REQUEST['Nombre']);  
        $subcategoria->__SET('Estado',$_REQUEST['Estado']);              
        $subcategoria->__SET('Ingresado_por',$_SESSION['Usuario_Actual']);
        $actualizar_subcategoria = $this->model->Actualizar($subcategoria);  
         
        if($actualizar_subcategoria=='error'){
            header('Location: index.php?c=SubCategoria&a=v_Actualizar&idSubCategoria='. $subcategoria->__GET('idSubCategoria'));
            echo 'No se Ha Podido Actualizar';
        }else{
            echo 'Actualizado Correctamente';
            header('Location: index.php?c=SubCategoria');
         }
    }

    public function Registrar(){
        
        $subcategoria = new SubCategoria();

        //$subcategoria->__SET('Data',$_REQUEST['Data']);
        $subcategoria->__SET('Categoria_id',$_REQUEST['Categoria_id']);
        $subcategoria->__SET('Ingresado_por',$_SESSION['Usuario_Actual']); 

        $subcategoria->__SET('Aplicar_Logica',$_REQUEST['Logica']);
        if ($subcategoria -> Aplicar_Logica == 1)
        {
            $subcategorias = json_decode($_REQUEST['Data'],TRUE);

            foreach ($subcategorias as $subcategoria1 )
            {   
                foreach ($subcategoria1 as $valor )
                {
                    $subcategoria->__SET('Nombre',$valor['Nombre']);
                    $subcategoria->__SET('Estado',$valor['Estado']);
                    print_r($subcategoria);
                    $registrar_subcategoria = $this->model->Registrar($subcategoria);
                }
            }
        }
        else
        {
            $subcategoria->__SET('Nombre',$_REQUEST['Nombre']);
            $subcategoria->__SET('Estado',1);
            $registrar_subcategoria = $this->model->Registrar($subcategoria);
        }

 
        if($registrar_subcategoria=='error'){
            header('Location: index.php?c=SubCategoria&a=v_Registrar');
            echo 'No se Ha Podido Registrar';
         }else{
            echo 'Registrado Correctamente';
            header('Location: index.php?c=subcategoria');
         }
    }

    public function Eliminar(){
        $subcategoria = new SubCategoria();
        $subcategoria->__SET('idSubCategoria',$_REQUEST['idSubCategoria']);      
        $subcategoria->__SET('Ingresado_por',$_SESSION['Usuario_Actual']);
        $subcategoria->__SET('Eliminado',1); 
        $eliminar_subcategoria = $this->model->Eliminar($subcategoria);  
         
        if($eliminar_subcategoria=='error'){
            echo 'No se Ha Podido Eliminar';
            header('Location: index.php?c=SubCategoria');            
         }else{
            echo 'Eliminado Correctamente';
            header('Location: index.php?c=SubCategoria');
         }
    }

    public function ListarxTipo_Ajax()
    {
        $tipo = $_POST['tipo_subcategoria'];
        $registros = $this->model->ListarxTipo($tipo);

        echo  json_encode($registros);
    }



}