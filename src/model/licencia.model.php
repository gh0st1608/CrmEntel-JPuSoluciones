<?php
include_once 'conexion.php';
class LicenciaModel 
{
	
 private $bd;

   

    public function Listar()
    {
        $this->bd = new Conexion();
        //$stmt = $this->bd->prepare("SELECT * FROM Licencia where Estado = 1 AND Eliminado=0" );
        $stmt = $this->bd->prepare("SELECT * FROM Licencia where Eliminado=0" );
        $stmt->execute();

        if (!$stmt->execute()) {
            return 'error';
            print_r($stmt->errorInfo());
        }else{            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    /*
    public function Consultar(Licencia $Licencia)
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT * FROM Licencia WHERE idLicencia = :idLicencia");
        $stmt->bindValue(':idLicencia', $Licencia->__GET('idLicencia'));
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);      

        $objLicencia = new Licencia();     
        $objLicencia->__SET('idLicencia',$row->idLicencia);
        $objLicencia->__SET('Nombre',$row->Nombre);
        $objLicencia->__SET('Estado',$row->Estado);  

        
        return $objLicencia;
    }
    
    public function Actualizar(Licencia $Licencia)
    {
       
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("UPDATE Licencia SET  Nombre = :Nombre,Modificado_por=:Modificado_por,Estado=:Estado WHERE idLicencia = :idLicencia");

        $stmt->bindValue(':idLicencia',$Licencia->__GET('idLicencia'));
        $stmt->bindValue(':Nombre',$Licencia->__GET('Nombre'));
        $stmt->bindValue(':Estado',$Licencia->__GET('Estado'));          
        $stmt->bindValue(':Modificado_por',$Licencia->__GET('Modificado_por'));    
        if (!$stmt->execute()) {
            return 'error';
        //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
    }
    */

    public function Registrar(Licencia $licencia)
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("INSERT INTO licencia(Usuario_id,Periodo,Fecha_Inicio,Fecha_Fin,Estado,Ingresado_por) VALUES(:Usuario_id,:Periodo,:Fecha_Inicio,:Fecha_Fin,:Estado,:Ingresado_por)");
        $stmt->bindValue(':Usuario_id', $licencia->__GET('Usuario_id'));
        $stmt->bindValue(':Periodo', $licencia->__GET('Periodo'));  
        $stmt->bindValue(':Fecha_Inicio', $licencia->__GET('Fecha_Inicio'));
        $stmt->bindValue(':Fecha_Fin', $licencia->__GET('Fecha_Fin'));
        $stmt->bindValue(':Estado', $licencia->__GET('Estado'));
        $stmt->bindValue(':Ingresado_por', $licencia->__GET('Ingresado_por'));
        if (!$stmt->execute()) {
            $errors = $stmt->errorInfo();
            // echo($errors[2]);
           return $errors[2];          
            //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
    }

    /*
    public function Eliminar(Licencia $Licencia)
    {
       
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("UPDATE Licencia SET  Modificado_por=:Modificado_por,Eliminado=:Eliminado WHERE idLicencia = :idLicencia");

        $stmt->bindValue(':idLicencia',$Licencia->__GET('idLicencia'));         
        $stmt->bindValue(':Modificado_por',$Licencia->__GET('Modificado_por'));
        $stmt->bindValue(':Eliminado',$Licencia->__GET('Eliminado'));    
        if (!$stmt->execute()) {
            return 'error';
        //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
         
    }*/
}