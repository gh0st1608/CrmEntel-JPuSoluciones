<?php
require_once 'model/persona.model.php';
require_once 'entity/persona.entity.php';


class PersonaController{    
  
    private $model;
    
    public function __CONSTRUCT()
    {
        $this->model = new PersonaModel();
    }
    /**==========================Vistas=======================================*/
    public function Index(){        
        require_once 'view/header.php';
        require_once 'view/administracion/persona/index.php';
        require_once 'view/footer.php';       
    }

    public function v_Actualizar(){        
        require_once 'view/header.php';
        require_once 'view/administracion/persona/actualizar.php';
        require_once 'view/footer.php';       
    }

    public function v_Registrar(){        
        require_once 'view/header.php';
        require_once 'view/administracion/persona/registrar.php';
        require_once 'view/footer.php';       
    }
    /**=======================================================================*/   
    public function Listar()
    {
        $personas = $this->model->Listar();
        return $personas;
    }

    public function Listar_Sin_Usuario()
    {
        $personas = $this->model->Listar_Sin_Usuario();
        return $personas;
    }
    public function ConsultarxDocumento($documento)
    {   
        $persona = new Persona();
        $persona->__SET('Documento',$documento);
        $consulta = $this->model->ConsultarxDocumento($documento);
        return $consulta;
    }

    public function ObtenerIndice()
    {
        $indice = $this->model->ObtenerIndice();
        return $indice;
    }

    public function Consultar($idPersona)
    {
        $persona = new Persona();
        $persona->__SET('idPersona',$idPersona);

        $consulta = $this->model->Consultar($persona);
        return $consulta;
    }

    public function Actualizar(){
        $persona = new Persona();
        $persona->__SET('idPersona',$_REQUEST['idPersona']);
        $persona->__SET('Tipo_Documento',$_REQUEST['Tipo_Documento']);
        $persona->__SET('Documento',$_REQUEST['Documento']);
        $persona->__SET('Primer_Nombre',$_REQUEST['Primer_Nombre']);
        $persona->__SET('Segundo_Nombre',$_REQUEST['Segundo_Nombre']);
        $persona->__SET('Apellido_Paterno',$_REQUEST['Apellido_Paterno']);
        $persona->__SET('Apellido_Materno',$_REQUEST['Apellido_Materno']);
        $persona->__SET('Fecha_Nacimiento',$_REQUEST['Fecha_Nacimiento']);
        $persona->__SET('Sexo',$_REQUEST['Sexo']);
        $persona->__SET('Celular',$_REQUEST['Celular']);
        $persona->__SET('Correo',$_REQUEST['Correo']);
        $persona->__SET('Cargo_id_SubCategoria',$_REQUEST['Cargo_id_SubCategoria']);
        $persona->__SET('Estado',$_REQUEST['Estado']);
        $persona->__SET('Funcion',$_REQUEST['Funcion']);                    
        $persona->__SET('Modificado_por',$_SESSION['Usuario_Actual']);      
        $actualizar_persona = $this->model->Actualizar($persona);         
        if($actualizar_persona=='error'){
            header('Location: index.php?c=Persona&a=v_Actualizar&idPersona='. $persona->__GET('idPersona'));
        }else{
            header('Location: index.php?c=Persona');
         }
    }
     public function Registrar(){

        $persona = new Persona();           
        $persona->__SET('Tipo_Documento',$_REQUEST['Tipo_Documento']);
        $persona->__SET('Documento',$_REQUEST['Documento']);
        $persona->__SET('Primer_Nombre',$_REQUEST['Primer_Nombre']);
        $persona->__SET('Segundo_Nombre',$_REQUEST['Segundo_Nombre']);
        $persona->__SET('Apellido_Paterno',$_REQUEST['Apellido_Paterno']);
        $persona->__SET('Apellido_Materno',$_REQUEST['Apellido_Materno']);
        $persona->__SET('Sexo','N');
        $persona->__SET('Ingresado_por',$_SESSION['Usuario_Actual']);
        $registrar_persona = $this->model->Registrar($persona);  
        /*
        if($registrar_persona=='error'){
            header('Location: index.php?c=Persona&a=v_Registrar');
         }else{
            header('Location: index.php?c=Persona');
         }
         */
    }
    
    public function Eliminar(){
        $persona = new Persona();
        $persona->__SET('idPersona',$_REQUEST['idPersona']);      
        $persona->__SET('modificado_por',$_SESSION['Usuario_Actual']);
        $persona->__SET('eliminado',1); 
        $eliminar_persona = $this->model->Eliminar($persona);  
         
        if($eliminar_persona=='error'){
            header('Location: index.php?c=Cartera');            
        }else{
            header('Location: index.php?c=Origen');
        }
    }



}