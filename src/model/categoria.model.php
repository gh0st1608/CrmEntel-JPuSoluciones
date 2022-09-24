<?php
include_once 'conexion.php';
class CategoriaModel 
{
	
 private $bd;

   

    public function Listar()
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT * FROM categoria where eliminado=0;" );
        $stmt->execute();

        if (!$stmt->execute()) {
            return 'error';
            //print_r($stmt->errorInfo());
        }else{            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        

    }
    public function Consultar(Categoria $categoria)
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT * FROM contacto WHERE idCategoria = :idCategoria;");
        $stmt->bindParam(':idCategoria', $contacto->__GET('idCategoria'));
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);      

        $objCategoria = new Contacto();     
        $objCategoria->__SET('idCategoria',$row->idCategoria);
        $objCategoria->__SET('Nombre',$row->Nombre);
        $objCategoria->__SET('Estado',$row->Estado); 
        return $objCategoria;
    }

    public function Actualizar(Categoria $categoria)
    {
      
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("UPDATE categoria SET  Nombre=:Nombre,Estado=:Estado,Ingresado_por=:Ingresado_por WHERE idCategoria = :idCategoria;");

        $stmt->bindParam(':idCategoria',$categoria->__GET('idCategoria'));
        $stmt->bindParam(':Nombre',$categoria->__GET('Nombre'));
        $stmt->bindParam(':Estado',$categoria->__GET('Estado'));          
        $stmt->bindParam(':Ingresado_por',$categoria->__GET('Ingresado_por')); 
        if (!$stmt->execute()) {
          return 'error';
      // print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
    }    

    public function Registrar(Categoria $categoria)
    {
       
  
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("INSERT INTO categoria(Nombre,Estado,Ingresado_por) VALUES(:Nombre,:Estado,:Ingresado_por)");
        $stmt->bindValue(':Nombre', $categoria->__GET('Nombre'),PDO::PARAM_STR);
        $stmt->bindValue(':Estado', $categoria->__GET('Estado'),PDO::PARAM_STR);
        $stmt->bindValue(':Ingresado_por', $categoria->__GET('Ingresado_por'),PDO::PARAM_INT);     

        if (!$stmt->execute()) {
            $errors = $stmt->errorInfo();
             //echo($errors[2]);
           return $errors[2];          
            //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
    }

    public function Eliminar(Categoria $categoria)
    {
       
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("UPDATE categoria SET  Eliminado=:Eliminado WHERE idCategoria = :idCategoria");

        $stmt->bindParam(':idCategoria',$categoria->__GET('idCategoria'));         
        $stmt->bindParam(':Ingresado_por',$categoria->__GET('Ingresado_por'));
        $stmt->bindParam(':Eliminado',$categoria->__GET('Eliminado'));    
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
        $stmt = $this->bd->prepare("SELECT * FROM categoria where eliminado=0 and Estado=1 order by orden asc;" );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
 
}