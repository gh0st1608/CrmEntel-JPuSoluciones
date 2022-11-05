<?php
include_once 'conexion.php';
class UsuarioModel 
{
	
 private $bd;

    public function ObtenerIndice()
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT idUsuario FROM usuario order by idUsuario DESC LIMIT 1;");
        $stmt->execute();
        if (!$stmt->execute()) {
            return 'error';
            //print_r($stmt->errorInfo());
        }else{            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }       
    }
   

    public function Listar()
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT usuario.idUsuario as idUsuario,usuario.Perfil_id as Perfil_id,perfil.Nombre as Nombre_Perfil,usuario.idUsuario as idUsuario,usuario.Login as Login,usuario.Password_Digital as Password_Digital, usuario.Estado as Estado, 
usuario.Persona_id as Persona_id,persona.Documento,persona.Primer_Nombre,persona.Segundo_Nombre,persona.Apellido_Materno,persona.Apellido_Paterno 
FROM usuario 
INNER JOIN perfil on perfil.idPerfil=usuario.perfil_id
INNER JOIN persona on persona.idPersona=usuario.Persona_id
        where usuario.eliminado=0 order by idUsuario desc" );
        $stmt->execute();

        if (!$stmt->execute()) {
            return 'error';
            print_r($stmt->errorInfo());
        }else{            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);       }
        

    }

    public function Listar_por_usuario($usuario)
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT usuario.idUsuario as idUsuario,usuario.Perfil_id as Perfil_id,perfil.Nombre as Nombre_Perfil,usuario.idUsuario as idUsuario,usuario.Login as Login,usuario.Password_Digital as Password_Digital, usuario.Estado as Estado, 
        usuario.Persona_id as Persona_id,persona.Documento,persona.Primer_Nombre,persona.Segundo_Nombre,persona.Apellido_Materno,persona.Apellido_Paterno 
        FROM usuario 
        INNER JOIN perfil on perfil.idPerfil=usuario.perfil_id
        INNER JOIN persona on persona.idPersona=usuario.Persona_id
        where usuario.eliminado=0 AND usuario.idUsuario = $usuario order by idUsuario desc" );
        $stmt->execute();

        if (!$stmt->execute()) {
            return 'error';
            print_r($stmt->errorInfo());
        }else{            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);       }
        

    }

    public function RecuperarClave($Usuario){

        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT  usuario.Login as Login, usuario.Password as Password, persona.Correo as Correo FROM usuario 
        INNER JOIN persona ON persona.idPersona = usuario.Persona_id WHERE persona.Documento LIKE :Login;");
        $stmt->bindValue(':Login', $Usuario);
        $stmt->execute();

        if (!$stmt->execute()) {
            print_r($stmt->errorInfo());
            print_r($errors[2]);
            return 'error';
        }else{        
            return $stmt->fetchAll(PDO::FETCH_ASSOC);       
        }

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
        $stmt->bindValue(':idUsuario', $usuario->__GET('idUsuario'));
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);      

        $objUsuario = new Usuario();     
        $objUsuario->__SET('idUsuario',$row->idUsuario);
        $objUsuario->__SET('Persona_id',$row->Persona_id);
        $objUsuario->__SET('Login',$row->Login);
        $objUsuario->__SET('Password',$row->Password);
        $objUsuario->__SET('Password_Digital',$row->Password_Digital);
        $objUsuario->__SET('Perfil_id',$row->Perfil_id);
        $objUsuario->__SET('Estado',$row->Estado);      

        
        return $objUsuario;
    }

    public function Actualizar(Usuario $usuario)
    {
       
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("UPDATE usuario SET  Login = :Login, Password=:Password, Password_Digital=:Password_Digital, Perfil_id=:Perfil_id, Estado=:Estado, Modificado_por=:Modificado_por, Estado=:Estado WHERE idUsuario = :idUsuario");

        $stmt->bindValue(':idUsuario',$usuario->__GET('idUsuario'));
        $stmt->bindValue(':Login',$usuario->__GET('Login'));
        $stmt->bindValue(':Password',$usuario->__GET('Password'));
        $stmt->bindValue(':Password_Digital',$usuario->__GET('Password_Digital'));
        $stmt->bindValue(':Perfil_id',$usuario->__GET('Perfil_id'));
        $stmt->bindValue(':Estado',$usuario->__GET('Estado'));      
        $stmt->bindValue(':Modificado_por',$usuario->__GET('Modificado_por'));
    
        if (!$stmt->execute()) {
            //print_r($stmt->errorInfo());
            return 'error';
        }else{
            
            return 'exito';
        }
    }    

    public function Registrar(Usuario $usuario)
    {
        $this->bd = new Conexion();
 
        $stmt = $this->bd->prepare("INSERT INTO usuario(Persona_id,Login,Password,Password_Digital,Perfil_id,Ingresado_por) VALUES(:Persona_id,:Login,:Password,:PasswordEquipo,:Perfil_id,:Ingresado_por)");
        $stmt->bindValue(':Persona_id', $usuario->__GET('Persona_id'));
        $stmt->bindValue(':Login', $usuario->__GET('Login'));
        $stmt->bindValue(':Password', $usuario->__GET('Password'));
        $stmt->bindValue(':PasswordEquipo', $usuario->__GET('PasswordEquipo'));
        $stmt->bindValue(':Perfil_id', $usuario->__GET('Perfil_id'));
        $stmt->bindValue(':Ingresado_por', $usuario->__GET('Ingresado_por'));
        if (!$stmt->execute()) {
            $errors = $stmt->errorInfo();
            print_r($errors[2]);
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

        $stmt->bindValue(':idUsuario',$usuario->__GET('idUsuario'));         
        $stmt->bindValue(':modificado_por',$usuario->__GET('modificado_por'));
        $stmt->bindValue(':eliminado',$usuario->__GET('eliminado'));    
        if (!$stmt->execute()) {
            return 'error';
        //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
         
    }
    

    public function Validar_Sesion($parametro)
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT LoggedIn FROM log_sesion 
        INNER JOIN usuario ON usuario.Login = log_sesion.Login
        INNER JOIN equipo ON usuario.idUsuario = equipo.idUsuario AND equipo.idLog_Sesion =log_sesion.idLog_Sesion 
        WHERE usuario.idUsuario = :idUsuario
        AND  IdEstadoKanBanDetalle = 1 
        AND  equipo.Equipo = :Equipo
       ORDER BY log_sesion.idLog_Sesion DESC LIMIT 1;");
        $stmt->bindValue(':idUsuario',$parametro);
        $stmt->bindValue(':Equipo', $_COOKIE['Equipo']);
        
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        $valor = $row->LoggedIn;
        if ($valor == 'No') 
        {
            return FALSE;
        }else{
            return TRUE;
        }

    }

    public function ObtenerSesion($parametro)
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT MAX(idLog_Sesion) as idLog_Sesion FROM log_sesion WHERE Login = :Login");
        $stmt->bindValue(':Login',$parametro);
        if (!$stmt->execute()) {
            return 'error';
        //print_r($stmt->errorInfo());
        }else{
            $row = $stmt->fetch(PDO::FETCH_OBJ);
            return $row->idLog_Sesion;
        }

    }

    public function EliminarSesion(Usuario $usuario)
    {
       
        $this->bd = new Conexion();

        //$idsesion = $this->ObtenerSesion($usuario->__GET('Login'));
        $stmt = $this->bd->prepare("UPDATE log_sesion SET  LoggedIn=:LoggedIn, Fecha_Cierre=sysdate() WHERE Login = :Login AND Fecha_Cierre IS NULL; ");
        $stmt->bindValue(':Login',$usuario->__GET('Login'));    
        $stmt->bindValue(':LoggedIn',$usuario->__GET('LoggedIn'));    
        if (!$stmt->execute()) {
            return 'error';
        //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
         
    }

    public function DesbloquearUsuario(Usuario $usuario)
    {
       
        $this->bd = new Conexion();

        //$idsesion = $this->ObtenerSesion($usuario->__GET('Login'));
        $stmt = $this->bd->prepare("UPDATE usuario SET  Estado=1 WHERE idUsuario = :idUsuario; ");
        $stmt->bindValue(':idUsuario',$usuario->__GET('idUsuario'));    
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
        {   
            $digital = $usuario->__GET('digital');
            $_SESSION['Estado_usuario'] = 1;
        	//instanciamos a la clase conexion 
            $this->bd = new Conexion();
            //preparamos la consulta sql para verificar si el usuario existe en la BD
            $stmt = $this->bd->prepare("SELECT * FROM usuario WHERE login=:Login and eliminado=0");
            $stmt->bindValue(':Login', $usuario->__GET('login'));
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
                 
                  if( isset($digital))
                  {
                    if(strtolower($usuario->__GET('digital'))==strtolower($usuario_registrado['Password_Digital']))
                    {  

                       
 
                        $this->bd = new Conexion();

                        //$idsesion = $this->ObtenerSesion($usuario->__GET('Login'));
                        $stmt = $this->bd->prepare("UPDATE log_sesion SET  LoggedIn='No', Fecha_Cierre=sysdate() WHERE Login = :Login AND Fecha_Cierre IS NULL; ");
                        $stmt->bindValue(':Login',$usuario->__GET('login'));    
                        $stmt->execute();




                        if($usuario_registrado['Estado'] == 1 )
                        {   
                            
                            //devolvemos los datos del  usuario
                            return $usuario_registrado;
                        }    
                        else
                        {    // usuario bloqueado
                            $_SESSION['Estado_usuario'] = 0;
                            return FALSE;
                            
                        }	 
                    }

                  }
                  else{
                        //validamos que el usuario este activo en la BD Z
                    if($usuario_registrado['Estado'] == 1 )
                    {   
                        
                        //devolvemos los datos del  usuario
                        return $usuario_registrado;
                    }    
                    else
                    {    // usuario bloqueado
                        $_SESSION['Estado_usuario'] = 0;
                        return FALSE;
                        
                    }		
                  }
                }
                else
                {
                    //$_SESSION['Estado_usuario'] = 3;
                    $_SESSION['Estado_usuario'] = 0;
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
 
            $stmt = $this->bd->prepare( "CALL procInsertLogSesion(:Login,:Password,:LoggedIn,:IP,:Dispositivo,:NombreDispositivo, :Equipo)"  );
 
            $stmt->bindValue(':Login', $loginiciosesion->__GET('login'));
            $stmt->bindValue(':Password', $loginiciosesion->__GET('password'));
            $stmt->bindValue(':LoggedIn', $loginiciosesion->__GET('loggedin'));
            $stmt->bindValue(':IP', $loginiciosesion->__GET('ip_usuario'));
            $stmt->bindValue(':Dispositivo', $loginiciosesion->__GET('dispositivo'));
            $stmt->bindValue(':NombreDispositivo', $loginiciosesion->__GET('nombredispositivo'));
 
            $stmt->bindValue(':Equipo', $_COOKIE['Equipo']);
 
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
                $_SESSION['Estado_usuario'] = 0;
                $_SESSION['Nota_sesion'] = $login_registro['Nota'];
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
            $Equipo = $_COOKIE['Equipo'] ;

            //instanciamos a la clase conexion 
            $this->bd = new Conexion();
            //preparamos la consulta sql para verificar si el usuario existe en la BD
            $stmt = $this->bd->prepare( "CALL ProcUpdateLogSesion(:Login,'','',:IP,:Dispositivo,:NombreDispositivo,:Equipo)"     );
            $stmt->bindValue(':Login', $Login);
            $stmt->bindValue(':IP', $ip_usuario);
            $stmt->bindValue(':Dispositivo', $dispositivo);
            $stmt->bindValue(':NombreDispositivo', $NombreDispositivo);
            $stmt->bindValue(':Equipo', $Equipo);
            //ejecutamos la consulta sql        
            $stmt->execute();
        
 
            
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }


 


}