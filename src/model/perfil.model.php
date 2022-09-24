<?php
include_once 'conexion.php';
class PerfilModel 
{
	
 private $bd;

   

    public function Listar()
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT * FROM perfil where eliminado=0" );
        $stmt->execute();

        if (!$stmt->execute()) {
            return 'error';
            print_r($stmt->errorInfo());
        }else{            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function Consultar(Perfil $pefil)
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT * FROM perfil WHERE idPerfil = :idPerfil");
        $stmt->bindParam(':idPerfil', $pefil->__GET('idPerfil'));
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);      

        $objPerfil = new Perfil();     
        $objPerfil->__SET('idPerfil',$row->idPerfil);
        $objPerfil->__SET('Nombre',$row->Nombre);
        $objPerfil->__SET('Estado',$row->Estado);  

        
        return $objPerfil;
    }

    public function Actualizar(Perfil $perfil)
    {
       
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("UPDATE perfil SET  Nombre = :Nombre,Modificado_por=:Modificado_por,Estado=:Estado WHERE idPerfil = :idPerfil");

        $stmt->bindParam(':idPerfil',$pefil->__GET('idPerfil'));
        $stmt->bindParam(':Nombre',$pefil->__GET('Nombre'));
        $stmt->bindParam(':Estado',$pefil->__GET('Estado'));          
        $stmt->bindParam(':Modificado_por',$pefil->__GET('Modificado_por'));    
        if (!$stmt->execute()) {
            return 'error';
        //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
    }    

    public function Registrar(Perfil $perfil)
    {
       
       
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("INSERT INTO perfil(Nombre,Estado,Ingresado_por) VALUES(:Nombre,:Estado,:Ingresado_por)");
        $stmt->bindValue(':Nombre', $perfil->__GET('Nombre'),PDO::PARAM_STR);
        $stmt->bindValue(':Estado', $perfil->__GET('Estado'),PDO::PARAM_INT);  
        $stmt->bindValue(':Ingresado_por', $perfil->__GET('Ingresado_por'),PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $errors = $stmt->errorInfo();
            // echo($errors[2]);
           return $errors[2];          
            //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
    }


    public function Eliminar(Perfil $perfil)
    {
       
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("UPDATE perfil SET  Modificado_por=:Modificado_por,Eliminado=:Eliminado WHERE idPerfil = :idPerfil");

        $stmt->bindParam(':idPerfil',$perfil->__GET('idPerfil'));         
        $stmt->bindParam(':Modificado_por',$perfil->__GET('Modificado_por'));
        $stmt->bindParam(':Eliminado',$perfil->__GET('Eliminado'));    
        if (!$stmt->execute()) {
            return 'error';
        //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
         
    }
}