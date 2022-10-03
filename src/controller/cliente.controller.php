<?php
require_once 'model/cliente.model.php';
require_once 'entity/cliente.entity.php';
require_once 'includes.controller.php'; 

class ClienteController  extends IncludesController{    
  
    private $model;
    
    public function __CONSTRUCT()
    {
        $this->model = new ClienteModel();
    }

    /**=======================================================================*/   
    public function RegistrarCliente($TipoDocumento,$Documento,$Nombre_Cliente,$Apellido_Paterno,$Apellido_Materno,$Nacionalidad,$Lugar_Nacimiento,$Fecha_Nacimiento,$Nombre_Padre,$Nombre_Madre){
        $cliente = new Cliente();

        $cliente->__SET('TipoDocumento',$TipoDocumento);
        $cliente->__SET('Documento',$Documento);
        $cliente->__SET('Nombre_Cliente',$Nombre_Cliente);
        $cliente->__SET('Apellido_Paterno',$Apellido_Paterno);
        $cliente->__SET('Apellido_Materno',$Apellido_Materno);
        $cliente->__SET('Nacionalidad',$Nacionalidad);
        $cliente->__SET('Lugar_Nacimiento',$Lugar_Nacimiento);
        $cliente->__SET('Fecha_Nacimiento',$Fecha_Nacimiento);
        $cliente->__SET('Nombre_Padre',$Nombre_Padre);
        $cliente->__SET('Nombre_Madre',$Nombre_Madre);
        $cliente->__SET('Ingresado_por',$_SESSION['Usuario_Actual']);

        $registrar_cliente=$this->model->Registrar($cliente);
        return $registrar_cliente;    
    }

    public function ActualizarCliente($idCliente,$TipoDocumento,$Documento,$Nombre_Cliente,$Apellido_Paterno,$Apellido_Materno,$Nacionalidad,$Lugar_Nacimiento,$Fecha_Nacimiento,$Nombre_Padre,$Nombre_Madre){
        $cliente = new Cliente();

        $cliente->__SET('idCliente',$idCliente);
        $cliente->__SET('TipoDocumento',$TipoDocumento);
        $cliente->__SET('Documento',$Documento);
        $cliente->__SET('Nombre_Cliente',$Nombre_Cliente);
        $cliente->__SET('Apellido_Paterno',$Apellido_Paterno);
        $cliente->__SET('Apellido_Materno',$Apellido_Materno);
        $cliente->__SET('Nacionalidad',$Nacionalidad);
        $cliente->__SET('Lugar_Nacimiento',$Lugar_Nacimiento);
        $cliente->__SET('Fecha_Nacimiento',$Fecha_Nacimiento);
        $cliente->__SET('Nombre_Padre',$Nombre_Padre);
        $cliente->__SET('Nombre_Madre',$Nombre_Madre);

        $actualizar_cliente=$this->model->Actualizar($cliente);
        return $actualizar_cliente;    
    }


    public function Consultar_Documento($TipoDocumento,$Documento)
    {
        $cliente = new Cliente();
        $cliente->__SET('TipoDocumento',$TipoDocumento);
        $cliente->__SET('Documento',$Documento);

        $consulta = $this->model->Consultar_Documento($cliente);
        return $consulta;
    }

    public function AjaxBuscarxDocumento()
    {   

        $cliente = new Cliente();
        $cliente->__SET('TipoDocumento',$_REQUEST['TipoDocumento']);
        $cliente->__SET('Documento',$_REQUEST['Documento']);

        $consulta = $this->model->AjaxConsultar_Documento($cliente);

       
        if ($consulta['idCliente']==NULL) {
           $arrayJson = array(
                'Resultado' =>FALSE
            );
        }else{            
            $arrayJson = array(
                'Resultado' =>TRUE,
                'Cliente' => array (
                    'idCliente'=>$consulta['idCliente'],
                    'TipoDocumento'=>$consulta['TipoDocumento'],
                    'Documento'=>$consulta['Documento'],
                    'Nombre_Cliente'=>$consulta['Nombre_Cliente'],
                    'Apellido_Paterno'=>$consulta['Apellido_Paterno'],
                    'Apellido_Materno'=>$consulta['Apellido_Materno'],
                    'Nacionalidad'=>$consulta['Nacionalidad'],
                    'Lugar_Nacimiento'=>$consulta['Lugar_Nacimiento'],
                    'Fecha_Nacimiento'=>$consulta['Fecha_Nacimiento'],
                    'Nombre_Padre'=>$consulta['Nombre_Padre'],
                    'Nombre_Madre'=>$consulta['Nombre_Madre']
                )
            );
        }


        echo  json_encode($arrayJson);

       
    }




}