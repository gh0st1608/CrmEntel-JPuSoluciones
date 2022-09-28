<?php
include_once 'conexion.php';
class UsuarioModel 
{
	
 private $bd;

   

    public function Listar()
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT usuario.idUsuario as idUsuario,usuario.Perfil_id as Perfil_id,usuario.idUsuario as idUsuario, usuario.Persona_id as Persona_id,usuario.Login as Login, usuario.Estado as Estado FROM usuario 
        INNER JOIN perfil on perfil.idPerfil=usuario.perfil_id
        where usuario.eliminado=0 order by idUsuario desc" );
        $stmt->execute();

        if (!$stmt->execute()) {
            return 'error';
            print_r($stmt->errorInfo());
        }else{            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);       }
        

    }

    public function Consultar_informacion_usuario($idUsuario)
    {
         


        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT idUsuario,idPersona,primer_nombre,segundo_nombre,apellido_paterno,apellido_materno,fecha_nacimiento,sexo,correo,perfil.nombre as perfil from usuario
        inner join perfil on perfil.idPerfil=usuario.Perfil_id
        inner join persona on persona.idPersona=usuario.Persona_id
        where idUsuario=$idUsuario;" );
        

        if (!$stmt->execute()) {
            return 'error';
            //print_r($stmt->errorInfo());
        }else{            
            return $stmt->fetch(PDO::FETCH_ASSOC);       
        }
        

    }
    public function Consultar(Usuario $usuario)
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT * FROM usuario WHERE idUsuario = :idUsuario");
        $stmt->bindParam(':idUsuario', $usuario->__GET('idUsuario'));
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);      

        $objUsuario = new Usuario();     
        $objUsuario->__SET('idUsuario',$row->idUsuario);
        $objUsuario->__SET('Persona_id',$row->Persona_id);
        $objUsuario->__SET('Login',$row->Login);
        $objUsuario->__SET('Password',$row->Password);
        $objUsuario->__SET('Perfil_id',$row->Perfil_id);
        $objUsuario->__SET('Estado',$row->Estado);      

        
        return $objUsuario;
    }

    public function Actualizar(Usuario $usuario)
    {
       
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("UPDATE usuario SET  login = :login,password=:password,Perfil_id=:Perfil_id,modificado_por=:modificado_por,activo=:activo WHERE idUsuario = :idUsuario");

        $stmt->bindParam(':idUsuario',$usuario->__GET('idUsuario'));
        $stmt->bindParam(':login',$usuario->__GET('login'));
        $stmt->bindParam(':password',$usuario->__GET('password'));
        $stmt->bindParam(':Perfil_id',$usuario->__GET('Perfil_id'));       
        $stmt->bindParam(':modificado_por',$usuario->__GET('modificado_por'));
        $stmt->bindParam(':activo',$usuario->__GET('activo'));    
        if (!$stmt->execute()) {
            return 'error';
        //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
    }    

    public function Registrar(Usuario $usuario,Persona $persona)
    {
       
       
        $this->bd = new Conexion();

        $stmt = $this->bd->prepare("INSERT INTO usuario(Login,Password,Perfil_id,Persona_id) VALUES(:Login,:Password,:Perfil_id,:Persona_id)");
        $stmt->bindValue(':Login', $usuario->__GET('Login'),PDO::PARAM_STR);
        $stmt->bindValue(':Password', $usuario->__GET('Password'),PDO::PARAM_STR);
        $stmt->bindValue(':Perfil_id', $usuario->__GET('Perfil_id'),PDO::PARAM_INT);
        $stmt->bindValue(':Persona_id', $usuario->__GET('Persona_id'),PDO::PARAM_INT);
        //$stmt->bindValue(':ingresado_por', $usuario->__GET('ingresado_por'),PDO::PARAM_STR);
        $stmt->execute();
        $errors = $stmt->errorInfo();

        $stmt = $this->bd->prepare("INSERT INTO persona(Tipo_Documento,Documento,Primer_Nombre,Segundo_Nombre,Apellido_Paterno,Apellido_Materno
                                             ) VALUES
                                                (:Tipo_Documento,:Documento,:Primer_Nombre,:Segundo_Nombre,:Apellido_Paterno,:Apellido_Materno
                                             )");

        $stmt->bindParam(':Tipo_Documento',$persona->__GET('Tipo_Documento'));
        $stmt->bindParam(':Documento',$persona->__GET('Documento'));
        $stmt->bindParam(':Primer_Nombre',$persona->__GET('Primer_Nombre'));
        $stmt->bindParam(':Segundo_Nombre',$persona->__GET('Segundo_Nombre'));
        $stmt->bindParam(':Apellido_Paterno',$persona->__GET('Apellido_Paterno'));
        $stmt->bindParam(':Apellido_Materno',$persona->__GET('Apellido_Materno'));
        $stmt->execute();
        $errors = $stmt->errorInfo();    
        //$stmt->bindParam(':Fecha_Nacimiento',$persona->__GET('Fecha_Nacimiento'));
        //$stmt->bindParam(':Sexo',$persona->__GET('Sexo'));
        //$stmt->bindParam(':Celular',$persona->__GET('Celular'));
        //$stmt->bindParam(':Correo',$persona->__GET('Correo'));
        //$stmt->bindParam(':Cargo_id_SubCategoria',$persona->__GET('Cargo_id_SubCategoria'));
        //$stmt->bindParam(':Estado',$persona->__GET('Estado'));


        if (isset($errors)) {
            // echo($errors[2]);
           return $errors[2];          
            //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
    }

    public function Eliminar(Usuario $usuario)
    {
       
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("UPDATE usuario SET  modificado_por=:modificado_por,eliminado=:eliminado WHERE idUsuario = :idUsuario");

        $stmt->bindParam(':idUsuario',$usuario->__GET('idUsuario'));         
        $stmt->bindParam(':modificado_por',$usuario->__GET('modificado_por'));
        $stmt->bindParam(':eliminado',$usuario->__GET('eliminado'));    
        if (!$stmt->execute()) {
            return 'error';
        //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
         
    }


	public function Validar_Usuario(Usuario $usuario)
    {
        try
        {   $_SESSION['Estado_usuario'] = 1;
        	//instanciamos a la clase conexion 
            $this->bd = new Conexion();
            //preparamos la consulta sql para verificar si el usuario existe en la BD
            $stmt = $this->bd->prepare("SELECT * FROM usuario WHERE login=:Login and eliminado=0");
            $stmt->bindParam(':Login', $usuario->__GET('login'));
            //ejecutamos la consulta sql        
            $stmt->execute();
            //almacenamos los registros obtenidos de la consulta
            $usuario_registrado=$stmt->fetch(PDO::FETCH_ASSOC);
            //verificamos si se han encontrado registros
            if($stmt->rowCount() > 0)
            {
                //si se an encontrado registros comparamos las contraseñas
                if(strtolower($usuario->__GET('password'))==strtolower($usuario_registrado['Password']))
                {
                    //validamos que el usuario este activo en la BD 
                    if($usuario_registrado['Estado'] == 1 )
	                {   
                        $_SESSION['Estado_usuario'] = 1;
	                    //devolvemos los datos del  usuario
	                    return $usuario_registrado;
	                }
                    elseif ($usuario_registrado['Estado'] == 2 ) {
                        $_SESSION['Estado_usuario'] = 2;
                        return FALSE;
   
                    }       
	                else
	                {   
                        $_SESSION['Estado_usuario'] = 3;
	                    return FALSE;
   
                	}	
                }
                else
                {
                    $_SESSION['Estado_usuario'] = 3;
                     // contador
                    if (is_null($_SESSION['intentoSesion']) || $_SESSION['intentoSesion'] == 0  ){
                        $_SESSION['intentoSesion']  = 1 ;

                    }
                    else{
                        $_SESSION['intentoSesion'] = $_SESSION['intentoSesion'] + 1 ;
                    }
                    $intentoSesion= $_SESSION['intentoSesion'];
 
                    return FALSE;
                }
            }
            
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }
    

    public function AddLogInicioSession(LogSesion $loginiciosesion)
    {
        try
        {       
        	//instanciamos a la clase conexion 
            $this->bd = new Conexion();
            //preparamos la consulta sql para verificar si el usuario existe en la BD
            $stmt = $this->bd->prepare( "CALL procInsertLogSesion(:Login,:Password,:LoggedIn,:IP,:Dispositivo,:NombreDispositivo)"     );
            $stmt->bindParam(':Login', $loginiciosesion->__GET('login'));
            $stmt->bindParam(':Password', $loginiciosesion->__GET('password'));
            $stmt->bindParam(':LoggedIn', $loginiciosesion->__GET('loggedin'));
            $stmt->bindParam(':IP', $loginiciosesion->__GET('ip_usuario'));
            $stmt->bindParam(':Dispositivo', $loginiciosesion->__GET('dispositivo'));
            $stmt->bindParam(':NombreDispositivo', $loginiciosesion->__GET('nombredispositivo'));
            //ejecutamos la consulta sql        
            $stmt->execute();
            //almacenamos los registros obtenidos de la consulta
            $login_registro = $stmt->fetch(PDO::FETCH_ASSOC);

            //verificamos si se han encontrado registros
            //si se an encontrado registros comparamos las contraseñas
           
            //validamos que el usuario este activo en la BD 
           // print_r($login_registro['Estado']);
            if( $login_registro['Estado']==1)
            {
                
                return $login_registro;
            }
            else
            {   
                $_SESSION['EstadoUsuario'] = 'Usuario bloqueado';
                return FALSE;
            }	
        
 
            
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    public function CierreSesion()
    {
        try
        {       
           
            $Login =  $_SESSION['Login']  ;
            $ip_usuario =  $_SESSION['IP']  ;
            $dispositivo = $_SESSION['Dispositivo']  ;
            $NombreDispositivo = $_SESSION['NombreDispositivo'] ;


            //instanciamos a la clase conexion 
            $this->bd = new Conexion();
            //preparamos la consulta sql para verificar si el usuario existe en la BD
            $stmt = $this->bd->prepare( "CALL ProcUpdateLogSesion(:Login,'','',:IP,:Dispositivo,:NombreDispositivo)"     );
            $stmt->bindParam(':Login', $Login);
            $stmt->bindParam(':IP', $ip_usuario);
            $stmt->bindParam(':Dispositivo', $dispositivo);
            $stmt->bindParam(':NombreDispositivo', $NombreDispositivo);
            //ejecutamos la consulta sql        
            $stmt->execute();
        
 
            
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }


 


}