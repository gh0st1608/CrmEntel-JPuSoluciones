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
    public function consultar_codigo($codigo)
    {   
        $persona = new Persona();
        $persona->__SET('codigo',$codigo);
        $consulta = $this->model->consultar_codigo($persona);
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
        $persona->__SET('codigo',$_REQUEST['codigo']);
        $persona->__SET('dni',$_REQUEST['dni']);
        $persona->__SET('primer_nombre',$_REQUEST['primer_nombre']);
        $persona->__SET('segundo_nombre',$_REQUEST['segundo_nombre']);
        $persona->__SET('apellido_paterno',$_REQUEST['apellido_paterno']);
        $persona->__SET('apellido_materno',$_REQUEST['apellido_materno']);
        $persona->__SET('fecha_nacimiento',$_REQUEST['fecha_nacimiento']);
        $persona->__SET('sexo',$_REQUEST['sexo']);
        $persona->__SET('celular',$_REQUEST['celular']);
        $persona->__SET('fecha_ingreso',$_REQUEST['fecha_ingreso']);
        $persona->__SET('tipo_horario',$_REQUEST['tipo_horario']);
        $persona->__SET('horario_entrada',$_REQUEST['horario_entrada']);
        $persona->__SET('horario_salida',$_REQUEST['horario_salida']);
        $persona->__SET('sueldo',$_REQUEST['sueldo']);
        $persona->__SET('correo',$_REQUEST['correo']);
        $persona->__SET('anexo',$_REQUEST['anexo']);
        $persona->__SET('Area_id',$_REQUEST['Area_id']);
        $persona->__SET('Cargo_id',$_REQUEST['Cargo_id']);
        $persona->__SET('Sede_id',$_REQUEST['Sede_id']);
        $persona->__SET('fecha_salida',$_REQUEST['fecha_salida']);
        $persona->__SET('activo',$_REQUEST['activo']);                  
        $persona->__SET('modificado_por',$_SESSION['Usuario_Actual']);      
        $actualizar_persona = $this->model->Actualizar($persona);         
        if($actualizar_persona=='error'){
           header('Location: index.php?c=Persona&a=v_Actualizar&idPersona='. $persona->__GET('idPersona'));
            echo 'No se Ha Podido Actualizar';
        }else{
            echo 'Actualizado Correctamente';
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

        $registrar_persona = $this->model->Registrar($persona);  
         
        if($registrar_persona=='error'){
            echo 'No se Ha Podido Registrar Persona';
            header('Location: index.php?c=Persona&a=v_Registrar');
         }else{
            echo 'Persona Registrado Correctamente';
            header('Location: index.php?c=Persona');
         }

    }
    

    /*public function Registrar(){
        
        $persona = new Persona();
        $nropersona = $this->model->Consultar_persona_dia($_REQUEST['fecha_ingreso']);
        $date=date_create($_REQUEST['fecha_ingreso']);
        $cod_fecha=date_format($date,'ymd');
        if(strlen($nropersona)==1){
            $cod_dia="0".$nropersona;
        }else{
            $cod_dia=$nropersona;
        }

        $codigo=$cod_fecha.$cod_dia;
        $persona->__SET('primer_nombre',$_REQUEST['primer_nombre']);
        $persona->__SET('segundo_nombre',$_REQUEST['segundo_nombre']);
        $persona->__SET('apellido_paterno',$_REQUEST['apellido_paterno']);
        $persona->__SET('apellido_materno',$_REQUEST['apellido_materno']);
        $persona->__SET('dni',$_REQUEST['dni']);
        $persona->__SET('codigo',$codigo);
        $persona->__SET('celular',$_REQUEST['celular']);
        $persona->__SET('fecha_ingreso',$_REQUEST['fecha_ingreso']);
        $persona->__SET('fecha_nacimiento',$_REQUEST['fecha_nacimiento']);
        $persona->__SET('sexo',$_REQUEST['sexo']);
        $persona->__SET('tipo_horario',$_REQUEST['tipo_horario']);
        $persona->__SET('horario_entrada',$_REQUEST['horario_entrada']);
        $persona->__SET('horario_salida',$_REQUEST['horario_salida']);
        $persona->__SET('sueldo',$_REQUEST['sueldo']);
        $persona->__SET('correo',$_REQUEST['correo']);
        $persona->__SET('anexo',$_REQUEST['anexo']);
        $persona->__SET('Area_id',$_REQUEST['Area_id']);
        $persona->__SET('Cargo_id',$_REQUEST['Cargo_id']);
        $persona->__SET('Sede_id',$_REQUEST['Sede_id']);
        $persona->__SET('ingresado_por',$_SESSION['Usuario_Actual']);    
       
        $registrar_persona = $this->model->Registrar($persona);  
         
        if($registrar_persona=='error'){
            header('Location: index.php?c=Persona&a=v_Registrar');
            echo 'No se Ha Podido Registrar';
         }else{
            echo 'Registrado Correctamente';
            header('Location: index.php?c=Persona');
         }
    }
*/
    public function Eliminar(){
        $persona = new Persona();
        $persona->__SET('idPersona',$_REQUEST['idPersona']);      
        $persona->__SET('modificado_por',$_SESSION['Usuario_Actual']);
        $persona->__SET('eliminado',1); 
        $eliminar_persona = $this->model->Eliminar($persona);  
         
        if($eliminar_persona=='error'){
            echo 'No se Ha Podido Eliminar el Origen';
            header('Location: index.php?c=Cartera');            
        }else{
            echo 'Origen Eliminado Correctamente';
            header('Location: index.php?c=Origen');
        }
    }



}