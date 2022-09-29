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

         $stmt->bindParam(':codigo', $persona->__GET('codigo'));

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
        $stmt->bindParam(':idPersona', $persona->__GET('idPersona'));
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);      
        $objPersona = new Persona(); 
        $objPersona->__SET('idPersona',$row->idPersona);
        //$objPersona->__SET('codigo',$row->codigo);
        $objPersona->__SET('Tipo_Documento',$row->Tipo_Documento);
        $objPersona->__SET('Documento',$row->Documento);
        $objPersona->__SET('Primer_Nombre',$row->Primer_Nombre);
        $objPersona->__SET('Segundo_Nombre',$row->Segundo_Nombre);
        $objPersona->__SET('Apellido_Paterno',$row->Apellido_Paterno);
        $objPersona->__SET('Apellido_Materno',$row->Apellido_Materno);
        $objPersona->__SET('Fecha_nacimiento',$row->Fecha_nacimiento);
        $objPersona->__SET('Sexo',$row->Sexo);
        $objPersona->__SET('Celular',$row->Celular);
        $objPersona->__SET('Cargo_id_SubCategoria',$row->Cargo_id_SubCategoria);
        $objPersona->__SET('Estado',$row->Estado);
        $objPersona->__SET('Ingresado_por',$row->Ingresado_por);
        $objPersona->__SET('Fecha_Registro',$row->Fecha_Registro);
        $objPersona->__SET('Modificado_por',$row->Modificado_por);
        $objPersona->__SET('Fecha_Modificacion',$row->Fecha_Modificacion);
        $objPersona->__SET('Fecha_Ingreso',$row->Fecha_Ingreso);
        $objPersona->__SET('Eliminado',$row->Eliminado);

        
        return $objPersona;
    }

    public function Consultar_persona_dia($fecha_ingreso)
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT count(idPersona)+1 as nro_persona FROM  persona WHERE fecha_ingreso=:fecha_ingreso;");
        $stmt->bindParam(':fecha_ingreso', $fecha_ingreso);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);      
        $nro_persona= $row->nro_persona;
       
              
        return $nro_persona;
    }

    public function Actualizar(Persona $persona)
    {
      
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("UPDATE persona SET  codigo=:codigo,dni=:dni,primer_nombre=:primer_nombre,segundo_nombre=:segundo_nombre,apellido_paterno=:apellido_paterno,apellido_materno=:apellido_materno,fecha_nacimiento=:fecha_nacimiento,sexo=:sexo,celular=:celular,fecha_ingreso=:fecha_ingreso,tipo_horario=:tipo_horario,horario_entrada=:horario_entrada,horario_salida=:horario_salida,sueldo=:sueldo,correo=:correo,anexo=:anexo,Area_id=:Area_id,Cargo_id=:Cargo_id,Sede_id=:Sede_id,fecha_salida=:fecha_salida,activo=:activo,modificado_por=:modificado_por WHERE idPersona=:idPersona;");

        $stmt->bindParam(':idPersona',$persona->__GET('idPersona'));
        $stmt->bindParam(':codigo',$persona->__GET('codigo'));
        $stmt->bindParam(':dni',$persona->__GET('dni'));
        $stmt->bindParam(':primer_nombre',$persona->__GET('primer_nombre'));
        $stmt->bindParam(':segundo_nombre',$persona->__GET('segundo_nombre'));
        $stmt->bindParam(':apellido_paterno',$persona->__GET('apellido_paterno'));
        $stmt->bindParam(':apellido_materno',$persona->__GET('apellido_materno'));
        $stmt->bindParam(':fecha_nacimiento',$persona->__GET('fecha_nacimiento'));
        $stmt->bindParam(':sexo',$persona->__GET('sexo'));
        $stmt->bindParam(':celular',$persona->__GET('celular'));
        $stmt->bindParam(':fecha_ingreso',$persona->__GET('fecha_ingreso'));
        $stmt->bindParam(':tipo_horario',$persona->__GET('tipo_horario'));
        $stmt->bindParam(':horario_entrada',$persona->__GET('horario_entrada'));
        $stmt->bindParam(':horario_salida',$persona->__GET('horario_salida'));
        $stmt->bindParam(':sueldo',$persona->__GET('sueldo'));
        $stmt->bindParam(':correo',$persona->__GET('correo'));
        $stmt->bindParam(':anexo',$persona->__GET('anexo'));
        $stmt->bindParam(':Area_id',$persona->__GET('Area_id'));
        $stmt->bindParam(':Cargo_id',$persona->__GET('Cargo_id'));
        $stmt->bindParam(':Sede_id',$persona->__GET('Sede_id'));
        $stmt->bindParam(':fecha_salida',$persona->__GET('fecha_salida'));
        $stmt->bindParam(':activo',$persona->__GET('activo'));
        $stmt->bindParam(':modificado_por',$persona->__GET('modificado_por'));

           
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


        $stmt = $this->bd->prepare("INSERT INTO persona(Tipo_Documento,Documento,Primer_Nombre,Segundo_Nombre,Apellido_Paterno,Apellido_Materno) VALUES
                                                (:Tipo_Documento,:Documento,:Primer_Nombre,:Segundo_Nombre,:Apellido_Paterno,:Apellido_Materno)");

        $stmt->bindParam(':Tipo_Documento',$persona->__GET('Tipo_Documento'));
        $stmt->bindParam(':Documento',$persona->__GET('Documento'));
        $stmt->bindParam(':Primer_Nombre',$persona->__GET('Primer_Nombre'));
        $stmt->bindParam(':Segundo_Nombre',$persona->__GET('Segundo_Nombre'));
        $stmt->bindParam(':Apellido_Paterno',$persona->__GET('Apellido_Paterno'));
        $stmt->bindParam(':Apellido_Materno',$persona->__GET('Apellido_Materno'));        

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

        $stmt->bindParam(':idPersona',$persona->__GET('idPersona'));         
        $stmt->bindParam(':modificado_por',$persona->__GET('modificado_por'));
        $stmt->bindParam(':eliminado',$persona->__GET('eliminado'));    
        if (!$stmt->execute()) {
            return 'error';
        //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
         
    }
 
}