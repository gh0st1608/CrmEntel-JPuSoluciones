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
        $stmt->bindValue(':Categoria_id', $subcategoria->__GET('Categoria_id'));
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
        $stmt->bindValue(':idSubCategoria', $subcategoria->__GET('idSubCategoria'));
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);      

        $objSubCategoria = new SubCategoria();
        if ($stmt->rowCount() > 0) {
            
            $objSubCategoria->__SET('idSubCategoria',$row->idSubCategoria);    
            $objSubCategoria->__SET('Categoria_id',$row->Categoria_id);
            $objSubCategoria->__SET('Nombre',$row->Nombre);
            $objSubCategoria->__SET('Aplicar_Logica',$row->Aplicar_Logica);
            $objSubCategoria->__SET('Logica_Json',$row->Logica_Json);
            $objSubCategoria->__SET('Estado',$row->Estado);
            return $objSubCategoria;
        }else{
            $objSubCategoria->__SET('idSubCategoria',0);
            return $objSubCategoria;
        }
        

    }

    

    public function Actualizar(SubCategoria $subcategoria)
    {
      
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("UPDATE subcategoria SET Nombre=:Nombre,Aplicar_Logica=:Aplicar_Logica,Logica_Json=:Logica_Json,Estado=:Estado,Ingresado_por=:Ingresado_por WHERE idSubCategoria = :idSubCategoria;");
        $stmt->bindValue(':idSubCategoria',$subcategoria->__GET('idSubCategoria'));
        //$stmt->bindValue(':Categoria_id',$subcategoria->__GET('Categoria_id'));
        $stmt->bindValue(':Nombre',$subcategoria->__GET('Nombre')); 
        $stmt->bindValue(':Aplicar_Logica',$subcategoria->__GET('Aplicar_Logica')); 
        $stmt->bindValue(':Logica_Json',$subcategoria->__GET('Logica_Json'));
        $stmt->bindValue(':Estado',$subcategoria->__GET('Estado')); 
        $stmt->bindValue(':Ingresado_por',$subcategoria->__GET('Ingresado_por'));
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

        $stmt->bindValue(':idSubCategoria',$subcategoria->__GET('idSubCategoria'));         
        $stmt->bindValue(':Ingresado_por',$subcategoria->__GET('Ingresado_por'));
        $stmt->bindValue(':Eliminado',$subcategoria->__GET('Eliminado'));    
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
 
    public function ListarSubCategorias()
    {
        $this->pdo = new Conexion();
        $stmt = $this->pdo->prepare("SELECT * FROM subcategoria where Eliminado=0 and Estado=1  ORDER BY Orden " );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

 
    public function ConsultarSubCategoriaAccion()
    {
        $this->pdo = new Conexion();
        $stmt = $this->pdo->prepare("SELECT  Desc_SubCategoria_Accion FROM subcategoria_accion 
                                     GROUP BY Desc_SubCategoria_Accion" );
        $stmt->execute(); 
        return $stmt->fetchAll(PDO::FETCH_ASSOC);  
 

    }
 
    public function ConsultarLogicaAccion()
    {
        $this->pdo = new Conexion();
        $stmt = $this->pdo->prepare("SELECT idAccion, Nom_Accion FROM acciones_logica 
                                     ORDER BY idAccion  ASC;" );
        $stmt->execute(); 
        return $stmt->fetchAll(PDO::FETCH_ASSOC);  
 
    }

    public function ConsultarAccion()
    {
        $this->pdo = new Conexion();
        $stmt = $this->pdo->prepare("SELECT Desc_SubCategoria_Accion FROM subcategoria_accion
                                    where Desc_SubCategoria_Accion <> 'NroAcciones'
                                     GROUP BY Desc_SubCategoria_Accion ;" );
        $stmt->execute(); 
        return $stmt->fetchAll(PDO::FETCH_ASSOC);  
 
    }

    public function ConsultarLogicaAccionDetalle($idsubcategoria)
    {
        $this->pdo = new Conexion();
        $stmt = $this->pdo->prepare("SELECT sa.idSubCategoria, sa.Desc_SubCategoria_Accion Acciones ,
        (
        SELECT  max(Num_Accion) 
        from acciones_logica_detalle lod INNER JOIN subcategoria_accion sac 
        on lod.idSubCategoria_Accion =sac.idSubCategoria_Accion
        WHERE sac.Desc_SubCategoria_Accion ='Acciones' and sac.idSubCategoria = sa.idSubCategoria  
        and lod.Estado = 1
        ) NroAcciones,
        ld.Num_Accion, al.Nom_Accion,  ld.Desc_Accion ,
        ld.id_AccionDetalle ,
        ld.id_Accion
        from acciones_logica_detalle ld INNER JOIN acciones_logica al
        on ld.id_Accion = al.idAccion INNER JOIN subcategoria_accion sa 
        on sa.idSubCategoria_Accion = ld.idSubCategoria_Accion
        WHERE sa.idSubCategoria= :idSubCategoria
        and ld.Estado = 1
        order by sa.Desc_SubCategoria_Accion ASC , ld.Num_Accion ASC, al.idAccion ASC" );
        $stmt->bindValue(':idSubCategoria',$idsubcategoria);   
        $stmt->execute(); 
        return $stmt->fetchAll(PDO::FETCH_ASSOC);  
 
    }

    public function EliminarAccion(SubCategoria $subcategoria)
    {
       
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("UPDATE acciones_logica_detalle SET Estado=:Eliminado WHERE id_AccionDetalle = :id_AccionDetalle and Estado = 1;");

        $stmt->bindValue(':id_AccionDetalle',$subcategoria->__GET('id_AccionDetalle'));         
 
        $stmt->bindValue(':Eliminado',$subcategoria->__GET('Eliminado'));   
        if (!$stmt->execute()) {
            return 'error';
        //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
         
    }
    public function ActualizaAccion(SubCategoria $subcategoria)
    {
       
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("UPDATE acciones_logica_detalle SET  Num_Accion= :Num_Accion , id_Accion= :id_Accion , Desc_Accion=:Desc_Accion  WHERE  id_AccionDetalle =:id_AccionDetalle AND Estado= 1;");
        $stmt->bindValue(':id_AccionDetalle',$subcategoria->__GET('id_AccionDetalle'));  
        $stmt->bindValue(':Num_Accion',$subcategoria->__GET('Num_Accion'));
        $stmt->bindValue(':id_Accion',$subcategoria->__GET('id_Accion'));   
        $stmt->bindValue(':Desc_Accion',$subcategoria->__GET('Desc_Accion'));  
        if (!$stmt->execute()) {
            return 'error';
        //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
         
    }
    public function RegistraAccion(SubCategoria $subcategoria)
    {
       
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare(" SELECT COUNT(1) CANT FROM  subcategoria_accion WHERE Desc_SubCategoria_Accion= :Desc_SubCategoria_Accion AND 	idSubCategoria =:idSubCategoria");
         $stmt->bindValue(':Desc_SubCategoria_Accion',$subcategoria->__GET('Desc_SubCategoria_Accion'));  
         $stmt->bindValue(':idSubCategoria',$subcategoria->__GET('idSubCategoria'));  
         $stmt->execute();
         
        $row = $stmt->fetch(PDO::FETCH_OBJ);      
 
        $cant = $row->CANT;  

      
        if (intval($cant) >0){
           
            $stmt = $this->bd->prepare(" SELECT  * FROM  subcategoria_accion WHERE Desc_SubCategoria_Accion= :Desc_SubCategoria_Accion AND 	idSubCategoria =:idSubCategoria");
            $stmt->bindValue(':Desc_SubCategoria_Accion',$subcategoria->__GET('Desc_SubCategoria_Accion'));  
            $stmt->bindValue(':idSubCategoria',$subcategoria->__GET('idSubCategoria'));  
            $stmt->execute();
             

           $row2 = $stmt->fetch(PDO::FETCH_OBJ);   
           $idsubcategoriaaccion = $row2->idSubCategoria_Accion;   
         
           
        }
        else {
         
            $stmt = $this->bd->prepare("INSERT INTO  subcategoria_accion ( idSubCategoria , Desc_SubCategoria_Accion) VALUES (:Desc_SubCategoria_Accion , :idSubCategoria)");
            $stmt->bindValue(':Desc_SubCategoria_Accion',$subcategoria->__GET('Desc_SubCategoria_Accion'));  
            $stmt->bindValue(':idSubCategoria',$subcategoria->__GET('idSubCategoria'));  
            $stmt->execute();
   
            $stmt = $this->bd->prepare(" SELECT  * FROM  subcategoria_accion WHERE Desc_SubCategoria_Accion= :Desc_SubCategoria_Accion AND 	idSubCategoria =:idSubCategoria");
            $stmt->bindValue(':Desc_SubCategoria_Accion',$subcategoria->__GET('Desc_SubCategoria_Accion'));  
            $stmt->bindValue(':idSubCategoria',$subcategoria->__GET('idSubCategoria'));  
            $stmt->execute();
            
           $row2 = $stmt->fetch(PDO::FETCH_OBJ);   
           $idsubcategoriaaccion = $row2->idSubCategoria_Accion;    
        }
        $stmt = $this->bd->prepare(" INSERT INTO  acciones_logica_detalle(idSubCategoria_Accion, Num_Accion, id_Accion, Desc_Accion) VALUES(:idSubCategoria_Accion, :Num_Accion, :id_Accion, :Desc_Accion);");
        $stmt->bindValue(':idSubCategoria_Accion',$idsubcategoriaaccion);
        $stmt->bindValue(':Num_Accion',$subcategoria->__GET('Num_Accion'));
        $stmt->bindValue(':id_Accion',$subcategoria->__GET('id_Accion'));   
        $stmt->bindValue(':Desc_Accion',$subcategoria->__GET('Desc_Accion'));  
        
        if (!$stmt->execute()) {
            return 'error';
        //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
         
    }


}