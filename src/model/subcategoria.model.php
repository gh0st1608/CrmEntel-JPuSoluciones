<?php
include_once 'conexion.php';
class SubCategoriaModel 
{
	
 private $bd;

   

    public function Listar()
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT * FROM subcategoria where eliminado=0;" );
        $stmt->execute();

        if (!$stmt->execute()) {
            return 'error';
            //print_r($stmt->errorInfo());
        }else{            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        

    }
    public function Consultar(SubCategoria $subcategoria)
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT * FROM subcategoria WHERE idSubCategoria = :idSubCategoria;");
        $stmt->bindParam(':idSubCategoria', $contacto->__GET('idSubCategoria'));
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);      

        $objSubCategoria = new Contacto();     
        $objSubCategoria->__SET('idSubCategoria',$row->idSubCategoria);
        $objSubCategoria->__SET('Categoria_id',$row->Categoria_id);
        $objSubCategoria->__SET('Nombre',$row->Nombre);
        $objSubCategoria->__SET('Estado',$row->Estado); 
        return $objSubCategoria;
    }

    public function Actualizar(SubCategoria $subcategoria)
    {
      
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("UPDATE subcategoria SET  Categoria_id=:Categoria_id,Nombre=:Nombre,Estado=:Estado,Ingresado_por=:Ingresado_por WHERE idSubCategoria = :idSubCategoria;");
        $stmt->bindParam(':idSubCategoria',$contacto->__GET('idSubCategoria'));
        $stmt->bindParam(':Categoria_id',$contacto->__GET('Categoria_id'));
        $stmt->bindParam(':Nombre',$contacto->__GET('Nombre'));         
        $stmt->bindParam(':Estado',$contacto->__GET('Estado')); 
        if (!$stmt->execute()) {
          return 'error';
      // print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
    }    

    public function Registrar(SubCategoria $subcategoria)
    {
       
  
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("INSERT INTO subcategoria(Categoria_id,Nombre,Estado,Ingresado_por) VALUES(:Categoria_id,:Nombre,:Estado,:Ingresado_por)");
        $stmt->bindValue(':Categoria_id', $contacto->__GET('Categoria_id'),PDO::PARAM_INT); 
        $stmt->bindValue(':Nombre', $contacto->__GET('Nombre'),PDO::PARAM_STR);
        $stmt->bindValue(':Estado', $contacto->__GET('Estado'),PDO::PARAM_STR);
        $stmt->bindValue(':Ingresado_por', $contacto->__GET('Ingresado_por'),PDO::PARAM_INT);     

        if (!$stmt->execute()) {
            $errors = $stmt->errorInfo();
             //echo($errors[2]);
           return $errors[2];          
            //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
    }

    public function Eliminar(Contacto $contacto)
    {
       
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("UPDATE subcategoria SET  Ingresado_por=:Ingresado_por,Eliminado=:Eliminado WHERE idSubCategoria = :idSubCategoria");

        $stmt->bindParam(':idSubCategoria',$contacto->__GET('idSubCategoria'));         
        $stmt->bindParam(':Ingresado_por',$contacto->__GET('Ingresado_por'));
        $stmt->bindParam(':Eliminado',$contacto->__GET('Eliminado'));    
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
        $stmt = $this->bd->prepare("SELECT * FROM subcategoria where Eliminado=0 and Estado=1 order by orden asc;" );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
 
}