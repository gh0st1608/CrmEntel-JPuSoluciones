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

    public function Listar_por_categoria(SubCategoria $subcategoria)
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT subcategoria.idSubCategoria as idSubCategoria, subcategoria.Categoria_id as Categoria_id, subcategoria.Nombre as Nombre, subcategoria.Aplicar_Logica as Aplicar_Logica, subcategoria.Estado as Estado FROM subcategoria
        INNER JOIN categoria ON categoria.idCategoria = subcategoria.Categoria_id
        WHERE subcategoria.eliminado=0 AND Categoria_id=:Categoria_id order by idCategoria desc ");
        $stmt->bindParam(':Categoria_id', $subcategoria->__GET('Categoria_id'));
        $stmt->execute();
        
        if (!$stmt->execute()) {
            return 'error';
            print_r($stmt->errorInfo());
        }else{            
             return $stmt->fetchAll(PDO::FETCH_ASSOC);;
        }
    }

    public function Consultar(SubCategoria $subcategoria)
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT * FROM subcategoria WHERE idSubCategoria = :idSubCategoria;");
        $stmt->bindParam(':idSubCategoria', $subcategoria->__GET('idSubCategoria'));
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);      


        $objSubCategoria = new SubCategoria();     
        $objSubCategoria->__SET('Categoria_id',$row->Categoria_id);
        $objSubCategoria->__SET('Nombre',$row->Nombre);
        $objSubCategoria->__SET('Aplicar_Logica',$row->Aplicar_Logica);
        $objSubCategoria->__SET('Logica_Json',$row->Logica_Json);
        $objSubCategoria->__SET('Estado',$row->Estado);
        return $objSubCategoria;

    }

    

    public function Actualizar(SubCategoria $subcategoria)
    {
      
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("UPDATE subcategoria SET  Categoria_id=:Categoria_id,Nombre=:Nombre,Estado=:Estado,Ingresado_por=:Ingresado_por WHERE idSubCategoria = :idSubCategoria;");
        $stmt->bindParam(':idSubCategoria',$subcategoria->__GET('idSubCategoria'));
        $stmt->bindParam(':Categoria_id',$subcategoria->__GET('Categoria_id'));
        $stmt->bindParam(':Nombre',$subcategoria->__GET('Nombre')); 
        $stmt->bindParam('Aplicar_Logica',$subcategoria->__GET('Aplicar_Logica'));
        $stmt->bindParam(':Estado',$subcategoria->__GET('Estado')); 
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
        $stmt = $this->bd->prepare("INSERT INTO subcategoria(Categoria_id,Nombre,Aplicar_Logica,Logica_Json,Estado,Ingresado_por) VALUES(:Categoria_id,:Nombre,:Aplicar_Logica,:Logica_Json,:Estado,:Ingresado_por)");
        $stmt->bindValue(':Categoria_id', $subcategoria->__GET('Categoria_id'),PDO::PARAM_INT); 
        $stmt->bindValue(':Nombre', $subcategoria->__GET('Nombre'),PDO::PARAM_STR);
        $stmt->bindValue(':Aplicar_Logica', $subcategoria->__GET('Aplicar_Logica'),PDO::PARAM_STR);
        $stmt->bindValue(':Logica_Json', $subcategoria->__GET('Logica_Json'),PDO::PARAM_STR);
        $stmt->bindValue(':Estado', $subcategoria->__GET('Estado'),PDO::PARAM_STR);
        $stmt->bindValue(':Ingresado_por', $subcategoria->__GET('Ingresado_por'),PDO::PARAM_INT);     

        if (!$stmt->execute()) {
            $errors = $stmt->errorInfo();
             //echo($errors[2]);
           return $errors[2];          
            //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
    }

    public function Eliminar(SubCategoria $subcategoria)
    {
       
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("UPDATE subcategoria SET  Ingresado_por=:Ingresado_por,Eliminado=:Eliminado WHERE idSubCategoria = :idSubCategoria");

        $stmt->bindParam(':idSubCategoria',$subcategoria->__GET('idSubCategoria'));         
        $stmt->bindParam(':Ingresado_por',$subcategoria->__GET('Ingresado_por'));
        $stmt->bindParam(':Eliminado',$subcategoria->__GET('Eliminado'));    
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