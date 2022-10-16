<?php
include_once 'conexion.php';
class PermisoModel 
{
	
 private $bd;

   

    public function Listar()
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT * FROM permiso where Eliminado=0;" );
        $stmt->execute();

        if (!$stmt->execute()) {
            return 'error';
            //print_r($stmt->errorInfo());
        }else{            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        

    }

    public function Listar_por_perfil(Permiso $permiso)
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT * FROM permiso where Perfil_id = :Perfil_id AND Eliminado=0;" );
        $stmt->bindValue(':Perfil_id', $permiso->__GET('Perfil_id'));
        $stmt->execute();
        
        if (!$stmt->execute()) {
            return 'error';
            print_r($stmt->errorInfo());
        }else{            
             return $stmt->fetchAll(PDO::FETCH_ASSOC);;
        }
    }

    public function Consultar(Permiso $permiso)
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT * FROM permiso WHERE idPermiso = :idPermiso;");
        $stmt->bindValue(':idPermiso', $Permiso->__GET('idPermiso'));
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);      

        $objPermiso = new Permiso();     
        $objPermiso->__SET('idPermiso',$row->idPermiso);
        $objPermiso->__SET('Perfil_id',$row->Perfil_id);
        $objPermiso->__SET('Interfaz_id',$row->Interfaz_id);
        $objPermiso->__SET('Acceder',$row->Acceder);
        $objPermiso->__SET('Estado',$row->Estado);
        return $objPermiso;
    }

    

    public function Actualizar(Permiso $permiso)
    {
      
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("UPDATE permiso SET  Perfil_id=:Perfil_id,Interfaz_id=:Interfaz_id,Acceder=:Acceder,Ingresado_por=:Ingresado_por WHERE idPermiso = :idPermiso;");

        $stmt->bindValue(':idPermiso',$permiso->__GET('idPermiso'));
        $stmt->bindValue(':Perfil_id',$permiso->__GET('Perfil_id'));
        $stmt->bindValue(':Interfaz_id',$permiso->__GET('Interfaz_id'));
        $stmt->bindValue(':Acceder',$permiso->__GET('Acceder'));           
        $stmt->bindValue(':Ingresado_por',$permiso->__GET('Ingresado_por')); 
        if (!$stmt->execute()) {
          return 'error';
      // print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
    }    

    public function Registrar(Permiso $permiso)
    {
       

        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("INSERT INTO permiso(Perfil_id,Interfaz_id,Acceder,Ingresado_por) VALUES(:Perfil_id,:Interfaz_id,:Acceder,:Estado)");
        $stmt->bindValue(':Perfil_id', $permiso->__GET('Perfil_id'));
        $stmt->bindValue(':Interfaz_id', $permiso->__GET('Interfaz_id'));
        $stmt->bindValue(':Acceder', $permiso->__GET('Acceder'));
        $stmt->bindValue(':Estado', $permiso->__GET('Estado'));      

        if (!$stmt->execute()) {
            $errors = $stmt->errorInfo();
             //echo($errors[2]);
           return $errors[2];          
            //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
    }

    public function Eliminar(Permiso $permiso)
    {
       
        $this->bd = new Conexion();
 
        $stmt = $this->bd->prepare("UPDATE permiso SET  Eliminado=:Eliminado,Ingresado_por=:Ingresado_por WHERE idPermiso = :idPermiso");
 

        $stmt->bindValue(':idPermiso',$permiso->__GET('idPermiso'));         
        $stmt->bindValue(':Ingresado_por',$permiso->__GET('Ingresado_por'));
        $stmt->bindValue(':Eliminado',$permiso->__GET('Eliminado'));    
        if (!$stmt->execute()) {
            return 'error';
        //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
         
    }

    public function Inhabilitar(Permiso $permiso)
    {
       
        $this->bd = new Conexion();
 
        $stmt = $this->bd->prepare("UPDATE permiso SET  Acceder=:Acceder,Ingresado_por=:Ingresado_por WHERE idPermiso = :idPermiso");
 

        $stmt->bindValue(':idPermiso',$permiso->__GET('idPermiso'));         
        $stmt->bindValue(':Ingresado_por',$permiso->__GET('Ingresado_por'));
        $stmt->bindValue(':Acceder',$permiso->__GET('Acceder'));    
        if (!$stmt->execute()) {
            return 'error';
        //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
         
    }

    public function ListarxTipo($Tipo)
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT * FROM Permiso where eliminado=0 and Estado=1 order by orden asc;" );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
 
}