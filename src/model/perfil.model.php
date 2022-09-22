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

        $objPerfil = new Usuario();     
        $objPerfil->__SET('idPerfil',$row->idPerfil);
        $objPerfil->__SET('nombre',$row->nombre);
        $objPerfil->__SET('activo',$row->activo);  

        
        return $objPerfil;
    }

    public function Actualizar(Perfil $pefil)
    {
       
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("UPDATE perfil SET  nombre = :nombre,modificado_por=:modificado_por,activo=:activo WHERE idPerfil = :idPerfil");

        $stmt->bindParam(':idPerfil',$pefil->__GET('idPerfil'));
        $stmt->bindParam(':nombre',$pefil->__GET('nombre'));          
        $stmt->bindParam(':modificado_por',$pefil->__GET('modificado_por'));
        $stmt->bindParam(':activo',$pefil->__GET('activo'));    
        if (!$stmt->execute()) {
            return 'error';
        //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
    }    

    public function Registrar(Perfil $pefil)
    {
       
       
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("INSERT INTO perfil(nombre,ingresado_por) VALUES(:nombre,:ingresado_por)");
        $stmt->bindValue(':nombre', $pefil->__GET('nombre'),PDO::PARAM_STR);       
        $stmt->bindValue(':ingresado_por', $pefil->__GET('ingresado_por'),PDO::PARAM_INT);
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
        $stmt = $this->bd->prepare("UPDATE perfil SET  modificado_por=:modificado_por,eliminado=:eliminado WHERE idPerfil = :idPerfil");

        $stmt->bindParam(':idPerfil',$perfil->__GET('idPerfil'));         
        $stmt->bindParam(':modificado_por',$perfil->__GET('modificado_por'));
        $stmt->bindParam(':eliminado',$perfil->__GET('eliminado'));    
        if (!$stmt->execute()) {
            return 'error';
        //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
         
    }
}