<?php
require_once 'model/interfaz.model.php';
require_once 'entity/interfaz.entity.php';


class InterfazController{    
  
    private $model;
    
    public function __CONSTRUCT()
    {
        $this->model = new InterfazModel();
    }
    /**==========================Vistas=======================================*/
    public function Index(){        
        require_once 'view/header.php';
        require_once 'view/seguridad/interfaz/index.php';
        require_once 'view/footer.php';       
    }

    public function v_Actualizar(){        
        require_once 'view/header.php';
        require_once 'view/seguridad/interfaz/actualizar.php';
        require_once 'view/footer.php';       
    }

    public function v_Registrar(){        
        require_once 'view/header.php';
        require_once 'view/seguridad/interfaz/registrar.php';
        require_once 'view/footer.php';       
    }
    /**=======================================================================*/   
    public function Listar()
    {
        $interfaz = $this->model->Listar();
        return $interfaz;
    }
    public function ConsultaModulo()
    {
        
        $consulta = $this->model->ConsultaModulo();
        return $consulta;
    }


    public function ListarNivel($idInterfaz_superior)
    {
        $interfaz = new Interfaz();
        $interfaz->__SET('idInterfaz_superior',$idInterfaz_superior);

        $consulta = $this->model->ListarNivel($interfaz);
        return $consulta;
    }


    public function Consultar($idInterfaz)
    {
        $interfaz = new Interfaz();
        $interfaz->__SET('idInterfaz',$idInterfaz);

        $consulta = $this->model->Consultar($interfaz);
        return $consulta;
    }

    public function Actualizar(){
        $interfaz = new Interfaz();
        $interfaz->__SET('idInterfaz',$_REQUEST['idInterfaz']);
        $interfaz->__SET('Nombre',$_REQUEST['Nombre']);              
        $interfaz->__SET('Estado',$_REQUEST['Estado']);
        $interfaz->__SET('Ingresado_por',$_SESSION['Usuario_Actual']);    
        $actualizar_interfaz = $this->model->Actualizar($interfaz);  
         
        if($actualizar_interfaz=='error'){
            header('Location: index.php?c=Interfaz&a=v_Actualizar&idInterfaz='. $interfaz->__GET('idInterfaz'));
            echo 'No se Ha Podido Actualizar';
        }else{
            echo 'Actualizado Correctamente';
            header('Location: index.php?c=Interfaz');
         }
    }

    public function Registrar(){
        
        $interfaz = new Interfaz();
        $interfaz->__SET('Nombre',$_REQUEST['nombre']);
        $interfaz->__SET('Url',$_REQUEST['Url']);
        $interfaz->__SET('Nivel',$_REQUEST['nivel']);
       $interfaz->__SET('Modulo_Principal',$_REQUEST['modulo']);
        $interfaz->__SET('IdInterfaz_Superior',$_REQUEST['modulosecundario']);
        $interfaz->__SET('Orden',$_REQUEST['orden']);
        $interfaz->__SET('Icono',$_REQUEST['Icono']);
        $interfaz->__SET('Ingresado_por',$_SESSION['Usuario_Actual']);
        $interfaz->__SET('Estado',$_REQUEST['Estado']);    
       
        $registrar_interfaz = $this->model->Registrar($interfaz);  
       
        if($registrar_interfaz=='error'){
            header('Location: index.php?c=Interfaz&a=v_Registrar');
 
           // echo 'No se Ha Podido Registrar';
         }else{
           // echo 'Registrado Correctamente';
               header('Location: index.php?c=Interfaz');
         }
 
    }

    public function Eliminar(){
        $interfaz = new Interfaz();
        $interfaz->__SET('idInterfaz',$_REQUEST['idInterfaz']);      
        $interfaz->__SET('Ingresado_por',$_SESSION['Usuario_Actual']);
        $interfaz->__SET('Eliminado',1); 
        $eliminar_interfaz = $this->model->Eliminar($interfaz);  
         
        if($eliminar_interfaz=='error'){
            echo 'No se Ha Podido Eliminar';
            header('Location: index.php?c=Interfaz');            
         }else{
            echo 'Eliminado Correctamente';
            header('Location: index.php?c=Interfaz');
         }
    }

    public function ListarxTipo_Ajax()
    {
        $tipo = $_POST['tipo_interfaz'];
        $registros = $this->model->ListarxTipo($tipo);

        echo  json_encode($registros);
    }

    /* combos */
    public function ComboNivel()
    {
 
        $consulta = $this->model->ComboNivel();
        return $consulta;
    }
    
    public function ComboModuloSecundario()
    {
 
       $interfaz =  $_POST['idInterfaz'];
 
        $consulta = $this->model->ComboModuloSecundario($interfaz);

 
       $cadena = '<option value='.'>-- Seleccionar Modulo--</option>';
 

        foreach($consulta as $moduloSecundario){
            $cadena.='<option value='.$moduloSecundario['idInterfaz'].'>'.$moduloSecundario['Nombre'].'</option>';

        }    
       
         echo $cadena;

 
        //return $consulta;
    }
    public function ComboOrden()
    {
        $IdInterfaz_superior =  $_POST['idInterfaz_superior'];
 
  
        $consulta = $this->model->ComboOrden($IdInterfaz_superior);
        
        $cadena = '<option value='.'>-- Seleccionar Ordeb--</option>';
 

        foreach($consulta as $orden){
            $cadena.='<option value='.$orden['Orden'].'>'.$orden['Orden'].'</option>';

        }    
       
         echo $cadena; 




    }


}