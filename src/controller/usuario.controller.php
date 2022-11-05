<?php
require_once 'model/usuario.model.php';
require_once 'entity/usuario.entity.php';
require_once 'entity/logsesion.entity.php';
require_once 'controller/persona.controller.php';
require_once 'entity/persona.entity.php';
require_once 'controller/licencia.controller.php';
require_once 'entity/licencia.entity.php';

require_once 'entity/mail.entity.php';
require_once 'controller/mail.controller.php';
require_once "vendor/autoload.php";


use UAParser\Parser;
//ini_set("session.cookie_lifetime","43200");
//ni_set("session.gc_maxlifetime","43200");
session_start();
class UsuarioController{    
  
    private $model;
    
    public function __CONSTRUCT()
    {
        $this->model = new UsuarioModel();
    }
    /**==========================Vistas=======================================*/

    public function validarPermiso ($idPerfil,$idVista){
      try
        {
             ini_set('memory_limit', -1); 
            $this->pdo = new Conexion();
            $result = array();

            $stm = $this->pdo->prepare("SELECT acceder FROM permiso
                WHERE Interfaz_id =$idVista
                AND Perfil_id=$idPerfil");
            $stm->execute();
                   
            return $stm->fetch(PDO::FETCH_ASSOC);
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }

  }



    public function Index(){
            require_once 'view/header.php';
            require_once 'view/seguridad/usuario/index.php';
            require_once 'view/footer.php';
    }

    public function v_Actualizar(){        
        
     
            require_once 'view/header.php';
            require_once 'view/seguridad/usuario/actualizar.php';
            require_once 'view/footer.php';       

        
    }

    public function v_RecuperarClave(){        
        $correo = $_POST['Correo'];
        print_r($correo = $_POST['Correo']);
        $permiso=$this->validarPermiso($_SESSION['Perfil_Actual'],1);
        if($permiso['acceder']==1){      
            $consulta = $this->model->RecuperarClave($correo);
            return $consulta;    
        }else{
          header('Location: index.php?c=index&a=denegado');
        }
        
    }

    public function v_Registrar(){        
        require_once 'view/header.php';
        require_once 'view/seguridad/usuario/registrar.php';
        require_once 'view/footer.php';       
    }
    /**=======================================================================*/   
    public function Listar()
    {
        $perfil_id = $_SESSION['Perfil_Actual'];
        if ($perfil_id == 1)
        {
            $usuarios = $this->model->Listar();
            return $usuarios;
        }else
        {
            $usuarios = $this->model->Listar_por_usuario($_SESSION['Usuario_Actual']);
            return $usuarios;
        }
        
    }


    public function Consultar_informacion_usuario($idUsuario)
    {
        $usuario = $this->model->Consultar_informacion_usuario($idUsuario);
        return $usuario;
    }

    public function Consultar($idUsuario)
    {
        $usuario = new Usuario();
        $usuario->__SET('idUsuario',$idUsuario);

        $consulta = $this->model->Consultar($usuario);
        return $consulta;
    }

    public function ObtenerIndice()
    {
        $consulta = $this->model->ObtenerIndice();
        return $consulta;     
    }

    public function RecuperarClave()
    {
 

            $mail = new Mail();
            $mail->__SET('user',$_REQUEST['Usuario']);
            //Obtener password y correo
            $consulta = $this->model->RecuperarClave($_REQUEST['Usuario']);
            $mail->__SET('password',$consulta[0]['Password']);
            $mail->__SET('correo_recuperacion',$consulta[0]['Correo']);
            print_r($mail);
            //$mail->__SET('correo_recuperacion',$_REQUEST['Correo']);
            $mailing = new MailController;
            $respuesta = $mailing->EnviarCorreo($mail);
    }  

    public function Actualizar(){
        $usuario = new Usuario();
        $usuario->__SET('idUsuario',$_REQUEST['idUsuario']);
        $usuario->__SET('Login',$_REQUEST['Documento']);
        $usuario->__SET('Password',$_REQUEST['Clave']);
        $usuario->__SET('Password_Digital',$_REQUEST['Password_Digital']);
        $usuario->__SET('Perfil_id',$_REQUEST['Perfil']);         
        $usuario->__SET('Estado',$_REQUEST['Estado']);
        $usuario->__SET('Modificado_por',$_SESSION['Usuario_Actual']);
        $bolFlujo = FALSE;
        
        if($_REQUEST['Estado'] == 0)
        {
            $licencia = new LicenciaController;
            $licencia->Inactivar_Licencia($_REQUEST['idUsuario']);
        }

        if($_REQUEST['Estado'] == 1)
        {
            $licencia = new LicenciaController;
            $licencia->Registrar($_REQUEST['idUsuario'],$bolFlujo);
        }
        $actualizar_usuario = $this->model->actualizar($usuario);  
         
        if($actualizar_usuario=='error'){
            header('Location: index.php?c=Usuario&a=v_Actualizar&idUsuario='. $usuario->__GET('idUsuario'));
         }else{
            header('Location: index.php?c=Usuario');
         }
    }

    public function Registrar(){

        
        
        $persona = new PersonaController;
        $persona->Registrar();

        $persona_id = $persona->ObtenerIndice();
        $indice = $persona_id[0]['idPersona'];

        $usuario = new Usuario();
        $usuario->__SET('Persona_id',$indice);
        $usuario->__SET('Login',$_REQUEST['Documento']);
        $usuario->__SET('Password',$_REQUEST['Clave']);
        $usuario->__SET('PasswordEquipo',$_REQUEST['PasswordEquipo']);
        $usuario->__SET('Perfil_id',$_REQUEST['Perfil']);
        $usuario->__SET('Ingresado_por',$_SESSION['Usuario_Actual']);
        $bolFlujo = TRUE;
        $registrar_usuario = $this->model->Registrar($usuario);

        $usuario_id = $this->ObtenerIndice();
        $indice = $usuario_id[0]['idUsuario'];

        $licencia = new LicenciaController;
        $licencia->Registrar($indice,$bolFlujo);

        if($registrar_usuario=='error'){
            header('Location: index.php?c=Usuario&a=v_Registrar');
         }else{
            header('Location: index.php?c=Usuario');
         }


         
    }

    public function Eliminar(){
        $usuario = new Usuario();
        $usuario->__SET('idUsuario',$_REQUEST['idUsuario']);      
        $usuario->__SET('Modificado_por',$_SESSION['Usuario_Actual']);
        $usuario->__SET('Eliminado',1); 
        $eliminar_usuario = $this->model->eliminar($usuario);  
         
        if($eliminar_usuario=='error'){
            header('Location: index.php?c=Usuario');
         }else{
            header('Location: index.php?c=Usuario');
         }
    }


     /**============================Login===========================================*/  

    public function Iniciar_Sesion($Login,$Password,$Password_Digital)
    {   
     
        // log inicio session
        $loginiciosesion = new LogSesion();
        //asignamos valores a las variables de la entidad
        $loginiciosesion->__SET('login',$Login);
        $loginiciosesion->__SET('password',$Password);
 
        $ip_usuario = gethostbyaddr($_SERVER['REMOTE_ADDR']); // CAPTURA IP 
 
        $agenteDeUsuario = $_SERVER["HTTP_USER_AGENT"];
        $parseador = Parser::create();
        $resultado = $parseador->parse($agenteDeUsuario); 
        
        $nombredispositivo = $resultado->device->family; // captura 
        $dispositivo = $resultado->os->family; 

        $loginiciosesion->__SET('ip_usuario',$ip_usuario);
        $loginiciosesion->__SET('dispositivo',$dispositivo);
        $loginiciosesion->__SET('nombredispositivo',$nombredispositivo); 
    /*  ----------------------------------- */
        
 

        //instanciamos ala entidad usuario.
        $usuario = new Usuario();
        //asignamos valores a las variables de la entidad
        $usuario->__SET('login',$Login);
        $usuario->__SET('password',$Password);
        $usuario->__SET('digital',$Password_Digital);
     
        //validamos al usuario en el clase modelo del usuario
        //print_r($usuario);
        $usuario_registrado = $this->model->Validar_Usuario($usuario);
         //validamos que el resultado de la validacion sea diferente a FALSE
     
        if(!$usuario_registrado==FALSE ){
           

            $LoggedIn = "Si";
            $loginiciosesion->__SET('loggedin',$LoggedIn); 
            $log_inicio_session = $this->model->AddLogInicioSession($loginiciosesion); 
            
         
            if(!$log_inicio_session==FALSE){
                //creamos variables de session del idUsuario y el perfil
                $_SESSION['Usuario_Actual'] = $usuario_registrado['idUsuario'];
                $_SESSION['Tipo_sistema'] = 'Prejudicial';
                $_SESSION['Perfil_Actual'] = $usuario_registrado['Perfil_id'];
                $_SESSION['Persona_Actual'] = $usuario_registrado['Persona_id'];
                $_SESSION['Login'] = $log_inicio_session['Login'];
                $_SESSION['IP'] = $log_inicio_session['IP'];
                $_SESSION['Dispositivo'] = $log_inicio_session['Dispositivo'];
                $_SESSION['NombreDispositivo'] = $log_inicio_session['NombreDispositivo'];
                $_SESSION['Tiempo'] =  time();
                //confirmamos que el usuario y la contraseña son correctas
        
                return TRUE;
                
            }  
            else  
            {
               
                return FALSE;
            } 
        }else 
        {   
           
            
            
            $LoggedIn = "No";
            $loginiciosesion->__SET('loggedin',$LoggedIn); 
            $log_inicio_session = $this->model->AddLogInicioSession($loginiciosesion);    
            //Usuario o Contraseña Incorrecta
 
            return FALSE;
 
        } 
        
                   
    }

    public function Verificar_InicioSesion()
    {
        //verifico si la session a sido iniciada
        if(isset($_SESSION['Usuario_Actual']) && isset($_SESSION['Tipo_sistema'])=="Prejudicial")
        {
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function Validar_Sesion()
    {
        $sesion_activa = $this->model->Validar_Sesion($_SESSION['Usuario_Actual']);
        //verifico si la session a sido iniciada
        if($sesion_activa && isset($_SESSION['Tipo_sistema'])=="Prejudicial")
        {
            return TRUE;

        }else{

            return FALSE;
        }
    }

    public function DesbloquearEliminarSesion()
    {
        $usuario = new Usuario();
        //asignamos valores a las variables de la entidad
        $usuario->__SET('idUsuario',$_REQUEST['idUsuario']);
        $usuario->__SET('Login',$_REQUEST['Login']);
        $usuario->__SET('LoggedIn','No');
        $login = $this->model->EliminarSesion($usuario);
        $idUsuario = $this->model->DesbloquearUsuario($usuario);
        //verifico si la session a sido iniciada

            header('Location: index.php?c=Usuario');
       
    }


    
    public function redirect($url)
    {
        header("Location: $url");
    }    
  
    public function CerrarSesion(){
 
        $this->model->CierreSesion();      
        session_destroy();
        unset($_SESSION['Usuario_Actual']); 
        unset($_SESSION['Login'] ) ;
        unset($_SESSION['IP'] ) ;
        unset($_SESSION['Dispositivo'])  ;
        unset($_SESSION['NombreDispositivo'] );
        unset($_SESSION['Tiempo'] );
        
        header('Location: login.php');           
       
    }
    
    public function ContinuarSesion(){
        $_SESSION['Tiempo'] = time();
 
        
    }

}