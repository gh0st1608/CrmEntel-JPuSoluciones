<?php
include_once 'conexion.php';
class ClienteModel 
{
	
    private $bd;

    public function Registrar(Cliente $cliente)
    {   
        try {
            $this->bd = new Conexion();
            $stmt = $this->bd->prepare('INSERT INTO cliente(TipoDocumento,Documento,Nombre_Cliente,Apellido_Paterno,Apellido_Materno,Nacionalidad,Lugar_Nacimiento,Fecha_Nacimiento,Nombre_Padre,Nombre_Madre,Ingresado_por) VALUES(:TipoDocumento,:Documento,:Nombre_Cliente,:Apellido_Paterno,:Apellido_Materno,:Nacionalidad,:Lugar_Nacimiento,:Fecha_Nacimiento,:Nombre_Padre,:Nombre_Madre,:Ingresado_por)');

            $stmt->bindValue(':TipoDocumento',$cliente->__GET('TipoDocumento'));
            $stmt->bindValue(':Documento',$cliente->__GET('Documento'));
            $stmt->bindValue(':Nombre_Cliente',$cliente->__GET('Nombre_Cliente'));
            $stmt->bindValue(':Apellido_Paterno',$cliente->__GET('Apellido_Paterno'));
            $stmt->bindValue(':Apellido_Materno',$cliente->__GET('Apellido_Materno'));
            $stmt->bindValue(':Nacionalidad',$cliente->__GET('Nacionalidad'));
            $stmt->bindValue(':Lugar_Nacimiento',$cliente->__GET('Lugar_Nacimiento'));
            $stmt->bindValue(':Fecha_Nacimiento',$cliente->__GET('Fecha_Nacimiento'));
            $stmt->bindValue(':Nombre_Padre',$cliente->__GET('Nombre_Padre'));
            $stmt->bindValue(':Nombre_Madre',$cliente->__GET('Nombre_Madre'));
            $stmt->bindValue(':Ingresado_por',$cliente->__GET('Ingresado_por'));
            $stmt->execute();
            return $this->bd->lastInsertId();
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function Actualizar(Cliente $cliente)
    {
      
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("UPDATE cliente SET  TipoDocumento=:TipoDocumento,Documento=:Documento,Nombre_Cliente=:Nombre_Cliente,Apellido_Paterno=:Apellido_Paterno,Apellido_Materno=:Apellido_Materno,Nacionalidad=:Nacionalidad,Lugar_Nacimiento=:Lugar_Nacimiento,Fecha_Nacimiento=:Fecha_Nacimiento,Nombre_Padre=:Nombre_Padre,Nombre_Madre=:Nombre_Madre WHERE idCliente=:idCliente");

        $stmt->bindValue(':idCliente',$cliente->__GET('idCliente'));
        $stmt->bindValue(':TipoDocumento',$cliente->__GET('TipoDocumento'));
        $stmt->bindValue(':Documento',$cliente->__GET('Documento'));
        $stmt->bindValue(':Nombre_Cliente',$cliente->__GET('Nombre_Cliente'));
        $stmt->bindValue(':Apellido_Paterno',$cliente->__GET('Apellido_Paterno'));
        $stmt->bindValue(':Apellido_Materno',$cliente->__GET('Apellido_Materno'));
        $stmt->bindValue(':Nacionalidad',$cliente->__GET('Nacionalidad'));
        $stmt->bindValue(':Lugar_Nacimiento',$cliente->__GET('Lugar_Nacimiento'));
        $stmt->bindValue(':Fecha_Nacimiento',$cliente->__GET('Fecha_Nacimiento'));
        $stmt->bindValue(':Nombre_Padre',$cliente->__GET('Nombre_Padre'));
        $stmt->bindValue(':Nombre_Madre',$cliente->__GET('Nombre_Madre'));

        if (!$stmt->execute()) {
            return 'error';
        //print_r($stmt->errorInfo());
        }else{            
            return 'exito';
        }
    }


    public function Consultar_Documento(Cliente $cliente)
    {
      
            $this->bd = new Conexion();
            $stmt = $this->bd->prepare("SELECT * FROM cliente WHERE TipoDocumento=:TipoDocumento and Documento = :Documento;");
            $stmt->bindValue(':TipoDocumento', $cliente->__GET('TipoDocumento'));
            $stmt->bindValue(':Documento', $cliente->__GET('Documento'));
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_OBJ);
            if ($stmt->rowCount() > 0) {
                $objCliente = new Cliente();
                $objCliente->__SET('idCliente',$row->idCliente);
                $objCliente->__SET('TipoDocumento',$row->TipoDocumento);
                $objCliente->__SET('Documento',$row->Documento);
                $objCliente->__SET('Nombre_Cliente',$row->Nombre_Cliente);
                $objCliente->__SET('Apellido_Paterno',$row->Apellido_Paterno);
                $objCliente->__SET('Apellido_Materno',$row->Apellido_Materno);
                $objCliente->__SET('Nacionalidad',$row->Nacionalidad);
                $objCliente->__SET('Lugar_Nacimiento',$row->Lugar_Nacimiento);
                $objCliente->__SET('Fecha_Nacimiento',$row->Fecha_Nacimiento);
                $objCliente->__SET('Nombre_Padre',$row->Nombre_Padre);
                $objCliente->__SET('Nombre_Madre',$row->Nombre_Madre);
                $objCliente->__SET('Estado',$row->Estado);        
               return $objCliente;    
            }else{
                $objCliente = new Cliente();     
                $objCliente->__SET('idCliente',0);
                 return $objCliente; 
            }

            
    }    

    public function AjaxConsultar_Documento(Cliente $cliente)
    {
      
            $this->bd = new Conexion();
            $stmt = $this->bd->prepare("SELECT * FROM cliente WHERE TipoDocumento=:TipoDocumento and Documento = :Documento;");
            $stmt->bindParam(':TipoDocumento', $cliente->__GET('TipoDocumento'));
            $stmt->bindParam(':Documento', $cliente->__GET('Documento'));
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
    }



}