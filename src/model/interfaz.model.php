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
        $stmt = $this->bd->prepare("SELECT *  FROM interfaz where eliminado= 0 and  IdInterfaz_superior = 0 ORDER BY Orden " );
        $stmt->execute();

        if (!$stmt->execute()) {
            return 'error';
            //print_r($stmt->errorInfo());
        }else{            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        

    }
    public function ConsultaModuloSecundario(Interfaz $Interfaz)
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT *  FROM interfaz where eliminado= 0 and  IdInterfaz_superior = :idInterfaz_superior ORDER BY Orden DESC " );
        $stmt->bindParam(':idInterfaz_superior', $Interfaz->__GET('idInterfaz_superior'));
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
 
    public function ComboModuloSecundario(  $idInterfaz)
    {
        
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT idInterfaz, Nombre FROM interfaz
                                     WHERE IdInterfaz_superior = :IdInterfaz_superior; " );
        $stmt->bindParam(':IdInterfaz_superior', $idInterfaz );
        $stmt->execute();

        if (!$stmt->execute()) {
            return 'error';
            //print_r($stmt->errorInfo());
        }else{            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        

    }

    public function ComboOrden( $IdInterfaz_superior)
    {
        
        
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare(" SELECT Orden FROM interfaz
        WHERE IdInterfaz_superior = :IdInterfaz_superior
        GROUP BY Orden
        UNION
        SELECT MAX(Orden)+1 AS Orden FROM interfaz
        WHERE IdInterfaz_superior = :IdInterfaz_superior
        GROUP BY Orden  ; " );
        $stmt->bindParam(':IdInterfaz_superior', $IdInterfaz_superior);
        $stmt->execute();

        if (!$stmt->execute()) {
            return 'error';
            //print_r($stmt->errorInfo());
        }else{     
          //  print_r(count($stmt))   ; 
         //  var_dump($stmt ) ;  
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        

    }

    
 

    public function Consultar(Interfaz $Interfaz)
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT I1.* ,   
        CASE WHEN I1.Nivel = 1 THEN 0  
             WHEN I1.Nivel = 2 THEN I2.IdInterfaz
             WHEN I1.Nivel = 3 THEN I3.IdInterfaz  
             END AS IdInterfaz_nivel1,
             
        CASE WHEN I1.Nivel = 1 THEN ''    
             WHEN I1.Nivel = 2 THEN I2.Nombre
             WHEN I1.Nivel = 3 THEN I3.Nombre  
             END AS Nombre_nivel1,
             
        CASE WHEN I1.Nivel = 1 THEN 0   
             WHEN I1.Nivel = 2 THEN 0
             WHEN I1.Nivel = 3 THEN I2.IdInterfaz  
             END AS IdInterfaz_nivel2,
        CASE WHEN I1.Nivel = 1 THEN ''    
             WHEN I1.Nivel = 2 THEN ''
             WHEN I1.Nivel = 3 THEN I2.Nombre  
             END AS Nombre_nivel2, 
        CASE WHEN I1.Nivel = 1 THEN 0    
             WHEN I1.Nivel = 2 THEN 0
             WHEN I1.Nivel = 3 THEN 0 
             END AS IdInterfaz_nivel3, 
        CASE WHEN I1.Nivel = 1 THEN ''   
             WHEN I1.Nivel = 2 THEN ''
             WHEN I1.Nivel = 3 THEN ''
             END AS Nombre_nivel3  
                FROM interfaz I1 LEFT JOIN  interfaz I2
                ON I1.IdInterfaz_superior = I2.IdInterfaz LEFT JOIN  interfaz I3
                ON I2.IdInterfaz_superior = I3.IdInterfaz 
                WHERE I1.idInterfaz = :idInterfaz;"); 
        $stmt->bindParam(':idInterfaz', $Interfaz->__GET('idInterfaz'));
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ); 
        
        


        $objInterfaz = new Interfaz();     
        $objInterfaz->__SET('IdInterfaz',$row->IdInterfaz_nivel1); 
        $objInterfaz->__SET('IdInterfaz_nivel1',$row->IdInterfaz_nivel1); 
        $objInterfaz->__SET('Nombre_nivel1',$row->Nombre_nivel1); 
        $objInterfaz->__SET('IdInterfaz_nivel2',$row->IdInterfaz_nivel2); 
        $objInterfaz->__SET('Nombre_nivel2',$row->Nombre_nivel2); 
        $objInterfaz->__SET('IdInterfaz_nivel3',$row->IdInterfaz_nivel3); 
        $objInterfaz->__SET('Nombre_nivel3',$row->Nombre_nivel3); 
        $objInterfaz->__SET('Nombre',$row->Nombre);
        $objInterfaz->__SET('Url',$row->Url);
        $objInterfaz->__SET('Nivel',$row->Nivel);
        $objInterfaz->__SET('Orden',$row->Orden);
        $objInterfaz->__SET('Icono',$row->Icono);
        return $objInterfaz;
    }

    public function Actualizar(Interfaz $Interfaz)
    {
      
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("CALL ProcUpdateInterfaz(:idInterfaz,:Nombre,:Url,:Nivel,0,:IdInterfaz_superior,:Orden,:Icono, 0,0,NULL,:Modificado_por,NULL)");

 
        $stmt->bindParam(':idInterfaz',$Interfaz->__GET('idInterfaz'));
        $stmt->bindParam(':Nombre',$Interfaz->__GET('Nombre'));
        $stmt->bindParam(':Url',$Interfaz->__GET('Url'));          
        $stmt->bindParam(':Nivel',$Interfaz->__GET('Nivel')); 
        $stmt->bindParam(':Orden',$Interfaz->__GET('Orden')); 
        $stmt->bindParam(':Icono',$Interfaz->__GET('Icono')); 
        $stmt->bindParam(':IdInterfaz_superior',$Interfaz->__GET('IdInterfaz_superior')); 
        $stmt->bindParam(':Modificado_por',$Interfaz->__GET('Ingresado_por')); 
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
        $stmt = $this->bd->prepare( "CALL ProcInsertInterfaz(:Nombre,:Url,:Nivel,:Modulo_Principal,:IdInterfaz_Superior,:Orden,:Icono,:Estado,:Ingresado_por,NULL,0,NULL)");
        $stmt->bindValue(':Nombre', $Interfaz->__GET('Nombre'));
        $stmt->bindValue(':Url', $Interfaz->__GET('Url'));
        $stmt->bindValue(':Nivel', $Interfaz->__GET('Nivel'));
        $stmt->bindValue(':Modulo_Principal', $Interfaz->__GET('Modulo_Principal'));
        $stmt->bindValue(':IdInterfaz_Superior', $Interfaz->__GET('IdInterfaz_Superior'));
        $stmt->bindValue(':Orden', $Interfaz->__GET('Orden') );
        $stmt->bindValue(':Icono', $Interfaz->__GET('Icono'));
        $stmt->bindValue(':Estado', $Interfaz->__GET('Estado'));
        $stmt->bindValue(':Ingresado_por', $Interfaz->__GET('Ingresado_por') );   

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