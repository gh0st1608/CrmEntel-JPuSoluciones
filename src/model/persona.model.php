<?php
include_once 'conexion.php';
class PersonaModel 
{
	
 private $bd;

   

    public function Listar()
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT * FROM persona where eliminado=0;" );
        $stmt->execute();

        if (!$stmt->execute()) {
            return 'error';
            //print_r($stmt->errorInfo());
        }else{            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }       

    }

    public function ObtenerIndice()
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT idPersona FROM persona order by idPersona DESC LIMIT 1;");
        $stmt->execute();

        if (!$stmt->execute()) {
            return 'error';
            //print_r($stmt->errorInfo());
        }else{            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }       
    }

    public function Listar_Sin_Usuario()
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT * FROM persona 
        LEFT JOIN usuario on usuario.Persona_id=persona.idPersona
        where persona.eliminado=0 and idUsuario is NULL" );
        $stmt->execute();

        if (!$stmt->execute()) {
            return 'error';
            //print_r($stmt->errorInfo());
        }else{            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function consultar_codigo(Persona $persona)
    {       


        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT * FROM persona WHERE codigo=:codigo and eliminado=0 and activo=1;" );

         $stmt->bindValue(':codigo', $persona->__GET('codigo'));

        if (!$stmt->execute()) {
            return 'error';
            //print_r($stmt->errorInfo());
        }else{            
            return $stmt->fetch(PDO::FETCH_ASSOC);       
        }
        

    }

    public function Consultar(Persona $persona)
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT * FROM persona WHERE idPersona = :idPersona;");
        $stmt->bindValue(':idPersona', $persona->__GET('idPersona'));
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);      
        $objPersona = new Persona(); 
        $objPersona->__SET('idPersona',$row->idPersona);
        $objPersona->__SET('Tipo_Documento',$row->Tipo_Documento);
        $objPersona->__SET('Documento',$row->Documento);
        $objPersona->__SET('Primer_Nombre',$row->Primer_Nombre);
        $objPersona->__SET('Segundo_Nombre',$row->Segundo_Nombre);
        $objPersona->__SET('Apellido_Paterno',$row->Apellido_Paterno);
        $objPersona->__SET('Apellido_Materno',$row->Apellido_Materno);
        $objPersona->__SET('Fecha_Nacimiento',$row->Fecha_Nacimiento);
        $objPersona->__SET('Sexo',$row->Sexo);
        $objPersona->__SET('Correo',$row->Correo);
        $objPersona->__SET('Celular',$row->Celular);
        $objPersona->__SET('Cargo_id_SubCategoria',$row->Cargo_id_SubCategoria);
        $objPersona->__SET('Estado',$row->Estado);
        $objPersona->__SET('Funcion',$row->Funcion);
        $objPersona->__SET('Ingresado_por',$row->Ingresado_por);
        $objPersona->__SET('Fecha_Registro',$row->Fecha_Registro);
        $objPersona->__SET('Modificado_por',$row->Modificado_por);
        $objPersona->__SET('Fecha_Modificacion',$row->Fecha_Modificacion);
        $objPersona->__SET('Fecha_Registro',$row->Fecha_Registro);
        $objPersona->__SET('Eliminado',$row->Eliminado);

        
        return $objPersona;
    }

    public function Consultar_persona_dia($fecha_ingreso)
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT count(idPersona)+1 as nro_persona FROM  persona WHERE fecha_ingreso=:fecha_ingreso;");
        $stmt->bindValue(':fecha_ingreso', $fecha_ingreso);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);      
        $nro_persona= $row->nro_persona;
       
              
        return $nro_persona;
    }

    public function Actualizar(Persona $persona)
    {
      
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("UPDATE persona SET  Tipo_Documento=:Tipo_Documento,Documento=:Documento,Primer_Nombre=:Primer_Nombre,Segundo_Nombre=:Segundo_Nombre,Apellido_Paterno=:Apellido_Paterno,Apellido_Materno=:Apellido_Materno,Fecha_Nacimiento=:Fecha_Nacimiento,Sexo=:Sexo,Celular=:Celular,Correo=:Correo,Cargo_id_SubCategoria=:Cargo_id_SubCategoria,Estado=:Estado,Funcion=:Funcion,Modificado_por=:Modificado_por WHERE idPersona=:idPersona;");

        $stmt->bindValue(':idPersona',$persona->__GET('idPersona'));
        $stmt->bindValue(':Tipo_Documento',$persona->__GET('Tipo_Documento'));
        $stmt->bindValue(':Documento',$persona->__GET('Documento'));
        $stmt->bindValue(':Primer_Nombre',$persona->__GET('Primer_Nombre'));
        $stmt->bindValue(':Segundo_Nombre',$persona->__GET('Segundo_Nombre'));
        $stmt->bindValue(':Apellido_Paterno',$persona->__GET('Apellido_Paterno'));
        $stmt->bindValue(':Apellido_Materno',$persona->__GET('Apellido_Materno'));
        $stmt->bindValue(':Fecha_Nacimiento',$persona->__GET('Fecha_Nacimiento'));
        $stmt->bindValue(':Sexo',$persona->__GET('Sexo'));
        $stmt->bindValue(':Celular',$persona->__GET('Celular'));
        $stmt->bindValue(':Correo',$persona->__GET('Correo'));
        $stmt->bindValue(':Cargo_id_SubCategoria',$persona->__GET('Cargo_id_SubCategoria'));
        $stmt->bindValue(':Estado',$persona->__GET('Estado'));
        $stmt->bindValue(':Funcion',$persona->__GET('Funcion'));
        $stmt->bindValue(':Modificado_por',$persona->__GET('Modificado_por'));

           
        if (!$stmt->execute()) {
          return 'error';
            //$errors = $stmt->errorInfo();
             //print_r($errors);
           //return $errors[2];  
        }else{
            
            return 'exito';
        }
    }    

    public function Registrar(Persona $persona)
    {
       
  
        $this->bd = new Conexion();


        $stmt = $this->bd->prepare("INSERT INTO persona(Tipo_Documento,Documento,Primer_Nombre,Segundo_Nombre,Apellido_Paterno,Apellido_Materno,Ingresado_por) VALUES
                                                (:Tipo_Documento,:Documento,:Primer_Nombre,:Segundo_Nombre,:Apellido_Paterno,:Apellido_Materno,:Ingresado_por)");

        $stmt->bindValue(':Tipo_Documento',$persona->__GET('Tipo_Documento'));
        $stmt->bindValue(':Documento',$persona->__GET('Documento'));
        $stmt->bindValue(':Primer_Nombre',$persona->__GET('Primer_Nombre'));
        $stmt->bindValue(':Segundo_Nombre',$persona->__GET('Segundo_Nombre'));
        $stmt->bindValue(':Apellido_Paterno',$persona->__GET('Apellido_Paterno'));
        $stmt->bindValue(':Apellido_Materno',$persona->__GET('Apellido_Materno')); 
        $stmt->bindValue(':Ingresado_por',$persona->__GET('Ingresado_por'));        

        if (!$stmt->execute()) {
           return 'error';          

        }else{
            
            return 'exito';
        }
    }

    public function Eliminar(Persona $persona)
    {
       
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("UPDATE persona SET  modificado_por=:modificado_por, eliminado=:eliminado WHERE idPersona = :idPersona");

        $stmt->bindValue(':idPersona',$persona->__GET('idPersona'));         
        $stmt->bindValue(':modificado_por',$persona->__GET('modificado_por'));
        $stmt->bindValue(':eliminado',$persona->__GET('eliminado'));    
        if (!$stmt->execute()) {
            return 'error';
        //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
         
    }
 
}