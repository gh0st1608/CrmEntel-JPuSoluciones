<?php
include_once 'conexion.php';
class InterfazModel 
{
	
 private $bd;

   

    public function Listar()
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT * FROM interfaz where eliminado=0;" );
        $stmt->execute();

        if (!$stmt->execute()) {
            return 'error';
            //print_r($stmt->errorInfo());
        }else{            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        

    }
 

    public function ConsultaModulo()
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT *  FROM interfaz where eliminado= 0 and  IdInterfaz_superior = 0 " );
        $stmt->execute();

        if (!$stmt->execute()) {
            return 'error';
            //print_r($stmt->errorInfo());
        }else{            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        

    }
 

    public function ListarNivel(Interfaz $Interfaz)
    {
        
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT I2.*, I1.Nombre NombreModulo
        FROM interfaz I1 INNER JOIN  interfaz I2
        ON I1.idInterfaz = I2.IdInterfaz_superior
        WHERE I2.IdInterfaz_superior = :idInterfaz_superior and  I2.Eliminado =0; " );
        $stmt->bindParam(':idInterfaz_superior', $Interfaz->__GET('idInterfaz_superior'));
        $stmt->execute();

        if (!$stmt->execute()) {
            return 'error';
            //print_r($stmt->errorInfo());
        }else{            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        

    }
 

    public function Consultar(Interfaz $Interfaz)
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT * FROM Interfaz WHERE idInterfaz = :idInterfaz;");
        $stmt->bindParam(':idInterfaz', $Interfaz->__GET('idInterfaz'));
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);      

        $objInterfaz = new Interfaz();     
        $objInterfaz->__SET('idInterfaz',$row->idInterfaz);
        $objInterfaz->__SET('Interfaz_id',$row->Interfaz_id);
        $objInterfaz->__SET('Nombre',$row->Nombre);
        $objInterfaz->__SET('Estado',$row->Estado); 
        return $objInterfaz;
    }

    public function Actualizar(Interfaz $Interfaz)
    {
      
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("UPDATE Interfaz SET  Nombre=:Nombre,Estado=:Estado,Ingresado_por=:Ingresado_por WHERE idInterfaz = :idInterfaz;");

        $stmt->bindParam(':idInterfaz',$Interfaz->__GET('idInterfaz'));
        $stmt->bindParam(':Nombre',$Interfaz->__GET('Nombre'));
        $stmt->bindParam(':Estado',$Interfaz->__GET('Estado'));          
        $stmt->bindParam(':Ingresado_por',$Interfaz->__GET('Ingresado_por')); 
        if (!$stmt->execute()) {
          return 'error';
      // print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
    }    

    public function Registrar(Interfaz $Interfaz)
    {
       
  
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("INSERT INTO Interfaz(Nombre,Estado,Ingresado_por) VALUES(:Nombre,:Estado,:Ingresado_por)");
        $stmt->bindValue(':Nombre', $Interfaz->__GET('Nombre'),PDO::PARAM_STR);
        $stmt->bindValue(':Url', $Interfaz->__GET('Url'),PDO::PARAM_STR);
        $stmt->bindValue(':Nivel', $Interfaz->__GET('Nivel'),PDO::PARAM_STR);
        $stmt->bindValue(':Modulo_Principal', $Interfaz->__GET('Modulo_Principal'),PDO::PARAM_STR);
        $stmt->bindValue(':IdInterfaz_Superior', $Interfaz->__GET('IdInterfaz_Superior'),PDO::PARAM_STR);
        $stmt->bindValue(':Orden', $Interfaz->__GET('Orden'),PDO::PARAM_INT);
        $stmt->bindValue(':Icono', $Interfaz->__GET('Icono'),PDO::PARAM_STR);
        $stmt->bindValue(':Estado', $Interfaz->__GET('Estado'),PDO::PARAM_STR);
        $stmt->bindValue(':Ingresado_por', $Interfaz->__GET('Ingresado_por'),PDO::PARAM_INT);   

        if (!$stmt->execute()) {
            $errors = $stmt->errorInfo();
             //echo($errors[2]);
           return $errors[2];          
            //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
    }

    public function Eliminar(Interfaz $Interfaz)
    {
       
        $this->bd = new Conexion();
 
        $stmt = $this->bd->prepare("UPDATE Interfaz SET  Eliminado=:Eliminado, Ingresado_por=:Ingresado_por WHERE idInterfaz = :idInterfaz");
 

        $stmt->bindParam(':idInterfaz',$Interfaz->__GET('idInterfaz'));         
        $stmt->bindParam(':Ingresado_por',$Interfaz->__GET('Ingresado_por'));
        $stmt->bindParam(':Eliminado',$Interfaz->__GET('Eliminado'));    
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
        $stmt = $this->bd->prepare("SELECT * FROM Interfaz where eliminado=0 and Estado=1 order by orden asc;" );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
 
}