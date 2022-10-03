<?php
require_once 'model/ficha_venta.model.php';
require_once 'entity/ficha_venta.entity.php';
require_once 'controller/cliente.controller.php';
require_once 'includes.controller.php'; 

class Ficha_VentaController  extends IncludesController{    
  
    private $model;
    
    public function __CONSTRUCT()
    {
        $this->model = new Ficha_VentaModel();
    }
    /**==========================Vistas=======================================*/
    public function Index(){        
        require_once 'view/header.php';
        require_once 'view/ventas/listar_fichas_venta.php';
        require_once 'view/footer.php';       
    }

    public function v_Registrar_Ficha(){        

        if (isset($_REQUEST['idFicha_Venta']) && $_REQUEST['idFicha_Venta']!=''){
           header('Location: index.php?c=Ficha_Venta&a=v_Registrar_Ficha');
        }else{
            require_once 'view/header.php';
            require_once 'view/ventas/Registrar_Ficha.php';
            require_once 'view/footer.php'; 
        }
               
    }

    public function v_Actualizar_Ficha(){
        if (isset($_REQUEST['idFicha_Venta']) && $_REQUEST['idFicha_Venta']!=''){
            require_once 'view/header.php';
            require_once 'view/ventas/Registrar_Ficha.php';
            require_once 'view/footer.php'; 
        }else{
            header('Location: index.php?c=Ficha_Venta');
        }
      
      
    }

    public function v_Registrar(){        
        require_once 'view/header.php';
        require_once 'view/administracion/persona/registrar.php';
        require_once 'view/footer.php';       
    }

    public function ListarSupervisoresVentaAjax()
    {
        $supervisores = $this->model->ListarSupervisoresVenta();

        echo  json_encode($supervisores);
    }

    /**==========================FUNCIONES AJAX UBIGEO=======================================*/
        public function ListarDepartamentosAjax()
    {
        $departamentos = $this->model->ListarDepartamentos();

        echo  json_encode($departamentos);
    }

    public function ListarProvinciasAjax()
    {
        $Cod_Dpto = $_POST['Cod_Dpto'];
        $provincias = $this->model->ListarProvincias($Cod_Dpto);
        echo  json_encode($provincias);
    }

    public function ListarDistritosAjax()
    {   
        $Cod_Dpto = $_POST['Cod_Dpto'];
        $Cod_Prov = $_POST['Cod_Prov'];
        $distritos = $this->model->ListarDistritos($Cod_Dpto,$Cod_Prov);
        echo  json_encode($distritos);
    }

    /**==========================FUNCIONES AJAX CATEGORIA Y SUBCATEGORIA=======================================*/
    public function ListarSubCategoriasAjax()
    {
        $Categoria_id = $_POST['Categoria_id'];
        $SubCategorias = $this->model->ListarSubCategorias($Categoria_id);
        echo  json_encode($SubCategorias);
    }

    public function ListarSubCategoriasxIds_Ajax()
    {
        $idSubCategoria = $_POST['idSubCategoria'];
        $SubCategorias = $this->model->ListarSubCategoriasxIds($idSubCategoria);
        echo  json_encode($SubCategorias);
    }

    public function Registrar(){


        /*Datos del Cliente*/
        $DP_TipoDocumento=$_REQUEST['DP_TipoDocumento'];
        $DP_Documento=$_REQUEST['DP_Documento'];
        $DP_Nombre_Cliente=$_REQUEST['DP_Nombre_Cliente'];
        $DP_Apellido_Paterno=$_REQUEST['DP_Apellido_Paterno'];
        $DP_Apellido_Materno=$_REQUEST['DP_Apellido_Materno'];
        $DP_Nacionalidad=$_REQUEST['DP_Nacionalidad'];
        $DP_Lugar_Nacimiento=$_REQUEST['DP_Lugar_Nacimiento'];
        $DP_Fecha_Nacimiento=$_REQUEST['DP_Fecha_Nacimiento'];
        $DP_Nombre_Padre=$_REQUEST['DP_Nombre_Padre'];
        $DP_Nombre_Madre=$_REQUEST['DP_Nombre_Madre'];

        $cliente = new ClienteController;
        $ObjCliente=$cliente->Consultar_Documento($DP_TipoDocumento,$DP_Documento);
        
        if ($ObjCliente->__GET('idCliente')==0) {
            $Cliente_id=$cliente->RegistrarCliente($DP_TipoDocumento,$DP_Documento,$DP_Nombre_Cliente,$DP_Apellido_Paterno,$DP_Apellido_Materno,$DP_Nacionalidad,$DP_Lugar_Nacimiento,$DP_Fecha_Nacimiento,$DP_Nombre_Padre,$DP_Nombre_Madre);
        }else{
            $Cliente_id=$ObjCliente->__GET('idCliente');
            $cliente->ActualizarCliente($Cliente_id,$DP_TipoDocumento,$DP_Documento,$DP_Nombre_Cliente,$DP_Apellido_Paterno,$DP_Apellido_Materno,$DP_Nacionalidad,$DP_Lugar_Nacimiento,$DP_Fecha_Nacimiento,$DP_Nombre_Padre,$DP_Nombre_Madre);
        }
        

      
        /*Fin Datos Cliente*/    

        $ficha_venta = new Ficha_Venta();
        $ficha_venta->__SET('DE_Telf_Llamada_Venta',$_REQUEST['DE_Telf_Llamada_Venta']);
        $ficha_venta->__SET('DE_Base_Llamada',$_REQUEST['DE_Base_Llamada']);
        $ficha_venta->__SET('DE_Campana_Netcall',$_REQUEST['DE_Campana_Netcall']);
        $ficha_venta->__SET('DE_Sub_Campana',$_REQUEST['DE_Sub_Campana']);
        $ficha_venta->__SET('DE_Detalle_Sub_Campana',$_REQUEST['DE_Detalle_Sub_Campana']);
        $ficha_venta->__SET('DE_CF_Max_Linea_Movil',$_REQUEST['DE_CF_Max_Linea_Movil']);
        $ficha_venta->__SET('DE_Tipo_Etiqueta',$_REQUEST['DE_Tipo_Etiqueta']);
        $ficha_venta->__SET('DE_CF_Max_Linea_Pack',$_REQUEST['DE_CF_Max_Linea_Pack']);
        $ficha_venta->__SET('DE_Monto_Disp_Finan_Equipos',$_REQUEST['DE_Monto_Disp_Finan_Equipos']);
        $ficha_venta->__SET('DE_Cant_Meses_Finan_Equipos',$_REQUEST['DE_Cant_Meses_Finan_Equipos']);
        $ficha_venta->__SET('DE_Cliente_Entel',$_REQUEST['DE_Cliente_Entel']);
        $ficha_venta->__SET('DE_Cliente_Promo_Dscto',$_REQUEST['DE_Cliente_Promo_Dscto']);
        $ficha_venta->__SET('Cliente_id',$Cliente_id);
        $ficha_venta->__SET('DF_Email_Facturacion_Otros',$_REQUEST['DF_Email_Facturacion_Otros']);
        $ficha_venta->__SET('DF_Ubigeo_Facturacion',$_REQUEST['DF_Dist_Facturacion']);
        $ficha_venta->__SET('DF_Domicilio_Facturacion',$_REQUEST['DF_Domicilio_Facturacion']);
        $ficha_venta->__SET('RE_Tipo_Despacho',$_REQUEST['RE_Tipo_Despacho']);
        $ficha_venta->__SET('RE_Rango_Entrega_Despacho',$_REQUEST['RE_Rango_Entrega_Despacho']);
        $ficha_venta->__SET('RE_Rango_Horario_Despacho',$_REQUEST['RE_Rango_Horario_Despacho']);
        $ficha_venta->__SET('RE_Tienda_Retiro',$_REQUEST['RE_Tienda_Retiro']);
        $ficha_venta->__SET('RE_Retail_Retiro',$_REQUEST['RE_Retail_Retiro']);
        $ficha_venta->__SET('RE_Fecha_Entrega',$_REQUEST['RE_Fecha_Entrega']);
        $ficha_venta->__SET('RE_Venta_Entrega_para',$_REQUEST['RE_Venta_Entrega_para']);
        $ficha_venta->__SET('RE_Venta_Destino_para',$_REQUEST['RE_Venta_Destino_para']);
        $ficha_venta->__SET('RE_Ubigeo_Entrega',$_REQUEST['RE_Dist_Entrega_Producto']);
        $ficha_venta->__SET('RE_Tipo_Direccion_Entrega',$_REQUEST['RE_Tipo_Direccion_Entrega']);
        $ficha_venta->__SET('RE_Direccion_Entrega',$_REQUEST['RE_Direccion_Entrega']);
        $ficha_venta->__SET('RE_Referencia_Principales',$_REQUEST['RE_Referencia_Principales']);
        $ficha_venta->__SET('RE_Referencias_Adicionales',$_REQUEST['RE_Referencias_Adicionales']);
        $ficha_venta->__SET('RE_Coordenadas_Direccion_Entrega',$_REQUEST['RE_Coordenadas_Direccion_Entrega']);
        $ficha_venta->__SET('RE_Telefono_Contacto1',$_REQUEST['RE_Telefono_Contacto1']);
        $ficha_venta->__SET('RE_Telefono_Contacto2',$_REQUEST['RE_Telefono_Contacto2']);
        $ficha_venta->__SET('RE_Tipo_Contacto_Ol',$_REQUEST['RE_Tipo_Contacto_Ol']);
        $ficha_venta->__SET('RV_Tipo_Ofrecimiento',$_REQUEST['RV_Tipo_Ofrecimiento']);
        $ficha_venta->__SET('RV_Tipo_Venta',$_REQUEST['RV_Tipo_Venta']);
        $ficha_venta->__SET('RV_Operador_Cedente',$_REQUEST['RV_Operador_Cedente']);
        $ficha_venta->__SET('RV_Origen',$_REQUEST['RV_Origen']);
        $ficha_venta->__SET('RV_Linea_Portar',$_REQUEST['RV_Linea_Portar']);
        $ficha_venta->__SET('RV_Plan_Tarifario',$_REQUEST['RV_Plan_Tarifario']);
        $ficha_venta->__SET('RV_Cargo_Fijo_Plan',$_REQUEST['RV_Cargo_Fijo_Plan']);
        $ficha_venta->__SET('RV_Tipo_Producto',$_REQUEST['RV_Tipo_Producto']);
        $ficha_venta->__SET('RV_Accesorio_Regalo',$_REQUEST['RV_Accesorio_Regalo']);
        $ficha_venta->__SET('RV_SKU_Accesorio_Regalo1',$_REQUEST['RV_SKU_Accesorio_Regalo1']);
        $ficha_venta->__SET('RV_SKU_Accesorio_Regalo2',$_REQUEST['RV_SKU_Accesorio_Regalo2']);
        $ficha_venta->__SET('RV_SKU_Pack',$_REQUEST['RV_SKU_Pack']);
        $ficha_venta->__SET('RV_Precio_Equipo_Inicial_Total',$_REQUEST['RV_Precio_Equipo_Inicial_Total']);
        $ficha_venta->__SET('RV_Cuota_Equipo_Mensual',$_REQUEST['RV_Cuota_Equipo_Mensual']);
        $ficha_venta->__SET('RV_Cant_Accesorios',$_REQUEST['RV_Cant_Accesorios']);
        $ficha_venta->__SET('RV_SKU_Accesorio1',$_REQUEST['RV_SKU_Accesorio1']);
        $ficha_venta->__SET('RV_Precio_Accesorio1',$_REQUEST['RV_Precio_Accesorio1']);
        $ficha_venta->__SET('RV_SKU_Accesorio2',$_REQUEST['RV_SKU_Accesorio2']);
        $ficha_venta->__SET('RV_Precio_Accesorio2',$_REQUEST['RV_Precio_Accesorio2']);
        $ficha_venta->__SET('RV_SKU_Accesorio3',$_REQUEST['RV_SKU_Accesorio3']);
        $ficha_venta->__SET('RV_Precio_Accesorio3',$_REQUEST['RV_Precio_Accesorio3']);
        $ficha_venta->__SET('RV_SKU_Accesorio4',$_REQUEST['RV_SKU_Accesorio4']);
        $ficha_venta->__SET('RV_Precio_Accesorio4',$_REQUEST['RV_Precio_Accesorio4']);
        $ficha_venta->__SET('RV_SKU_Accesorio5',$_REQUEST['RV_SKU_Accesorio5']);
        $ficha_venta->__SET('RV_Precio_Accesorio5',$_REQUEST['RV_Precio_Accesorio5']);
        $ficha_venta->__SET('RV_Tipo_Pago',$_REQUEST['RV_Tipo_Pago']);
        $ficha_venta->__SET('RV_Promociones_Bancos',$_REQUEST['RV_Promociones_Bancos']);
        $ficha_venta->__SET('Supervisor_Vendedor',$_REQUEST['Supervisor_Vendedor']);
        $ficha_venta->__SET('Comentarios_Vendedor',$_REQUEST['Comentarios_Vendedor']);
        $ficha_venta->__SET('Ingresado_por_Vendedor',$_SESSION['Usuario_Actual']);


        $idFecha_Venta=$registrar_ficha_venta = $this->model->Registrar($ficha_venta);
        

         //$Gestion_id=$this->RegistrarGestion($Negociacion_id,$_REQUEST['Deudor_id'],$_REQUEST['ObligacionCartera_id'],$_REQUEST['Campana_id'],$FechaPagoCtaInicial,$_REQUEST['TipoNegociacion'],$_SESSION['Persona_Actual'],$_REQUEST['Operador_id'],$TipoGestion_id,$_REQUEST['Telefono_idTitular'],$_REQUEST['Direccion_id'],$_REQUEST['Correo_id'],$observaciones_gestion);

        //$this->ActualizarGestionidCompromiso($Negociacion_id,$Gestion_id);

        echo  json_encode($idFecha_Venta);
    }

    public function Actualizar(){


        /*Datos del Cliente*/
        $DP_TipoDocumento=$_REQUEST['DP_TipoDocumento'];
        $DP_Documento=$_REQUEST['DP_Documento'];
        $DP_Nombre_Cliente=$_REQUEST['DP_Nombre_Cliente'];
        $DP_Apellido_Paterno=$_REQUEST['DP_Apellido_Paterno'];
        $DP_Apellido_Materno=$_REQUEST['DP_Apellido_Materno'];
        $DP_Nacionalidad=$_REQUEST['DP_Nacionalidad'];
        $DP_Lugar_Nacimiento=$_REQUEST['DP_Lugar_Nacimiento'];
        $DP_Fecha_Nacimiento=$_REQUEST['DP_Fecha_Nacimiento'];
        $DP_Nombre_Padre=$_REQUEST['DP_Nombre_Padre'];
        $DP_Nombre_Madre=$_REQUEST['DP_Nombre_Madre'];

        $cliente = new ClienteController;
        $ObjCliente=$cliente->Consultar_Documento($DP_TipoDocumento,$DP_Documento);
        

            $Cliente_id=$ObjCliente->__GET('idCliente');
            $cliente->ActualizarCliente($Cliente_id,$DP_TipoDocumento,$DP_Documento,$DP_Nombre_Cliente,$DP_Apellido_Paterno,$DP_Apellido_Materno,$DP_Nacionalidad,$DP_Lugar_Nacimiento,$DP_Fecha_Nacimiento,$DP_Nombre_Padre,$DP_Nombre_Madre);

      
        /*Fin Datos Cliente*/    

        $ficha_venta = new Ficha_Venta();
        $ficha_venta->__SET('idFicha_Venta',$_REQUEST['idFicha_Venta']);
        $ficha_venta->__SET('DE_Telf_Llamada_Venta',$_REQUEST['DE_Telf_Llamada_Venta']);
        $ficha_venta->__SET('DE_Base_Llamada',$_REQUEST['DE_Base_Llamada']);
        $ficha_venta->__SET('DE_Campana_Netcall',$_REQUEST['DE_Campana_Netcall']);
        $ficha_venta->__SET('DE_Sub_Campana',$_REQUEST['DE_Sub_Campana']);
        $ficha_venta->__SET('DE_Detalle_Sub_Campana',$_REQUEST['DE_Detalle_Sub_Campana']);
        $ficha_venta->__SET('DE_CF_Max_Linea_Movil',$_REQUEST['DE_CF_Max_Linea_Movil']);
        $ficha_venta->__SET('DE_Tipo_Etiqueta',$_REQUEST['DE_Tipo_Etiqueta']);
        $ficha_venta->__SET('DE_CF_Max_Linea_Pack',$_REQUEST['DE_CF_Max_Linea_Pack']);
        $ficha_venta->__SET('DE_Monto_Disp_Finan_Equipos',$_REQUEST['DE_Monto_Disp_Finan_Equipos']);
        $ficha_venta->__SET('DE_Cant_Meses_Finan_Equipos',$_REQUEST['DE_Cant_Meses_Finan_Equipos']);
        $ficha_venta->__SET('DE_Cliente_Entel',$_REQUEST['DE_Cliente_Entel']);
        $ficha_venta->__SET('DE_Cliente_Promo_Dscto',$_REQUEST['DE_Cliente_Promo_Dscto']);
        $ficha_venta->__SET('Cliente_id',$Cliente_id);
        $ficha_venta->__SET('DF_Email_Facturacion_Otros',$_REQUEST['DF_Email_Facturacion_Otros']);
        $ficha_venta->__SET('DF_Ubigeo_Facturacion',$_REQUEST['DF_Dist_Facturacion']);
        $ficha_venta->__SET('DF_Domicilio_Facturacion',$_REQUEST['DF_Domicilio_Facturacion']);
        $ficha_venta->__SET('RE_Tipo_Despacho',$_REQUEST['RE_Tipo_Despacho']);
        $ficha_venta->__SET('RE_Rango_Entrega_Despacho',$_REQUEST['RE_Rango_Entrega_Despacho']);
        $ficha_venta->__SET('RE_Rango_Horario_Despacho',$_REQUEST['RE_Rango_Horario_Despacho']);
        $ficha_venta->__SET('RE_Tienda_Retiro',$_REQUEST['RE_Tienda_Retiro']);
        $ficha_venta->__SET('RE_Retail_Retiro',$_REQUEST['RE_Retail_Retiro']);
        $ficha_venta->__SET('RE_Fecha_Entrega',$_REQUEST['RE_Fecha_Entrega']);
        $ficha_venta->__SET('RE_Venta_Entrega_para',$_REQUEST['RE_Venta_Entrega_para']);
        $ficha_venta->__SET('RE_Venta_Destino_para',$_REQUEST['RE_Venta_Destino_para']);
        $ficha_venta->__SET('RE_Ubigeo_Entrega',$_REQUEST['RE_Dist_Entrega_Producto']);
        $ficha_venta->__SET('RE_Tipo_Direccion_Entrega',$_REQUEST['RE_Tipo_Direccion_Entrega']);
        $ficha_venta->__SET('RE_Direccion_Entrega',$_REQUEST['RE_Direccion_Entrega']);
        $ficha_venta->__SET('RE_Referencia_Principales',$_REQUEST['RE_Referencia_Principales']);
        $ficha_venta->__SET('RE_Referencias_Adicionales',$_REQUEST['RE_Referencias_Adicionales']);
        $ficha_venta->__SET('RE_Coordenadas_Direccion_Entrega',$_REQUEST['RE_Coordenadas_Direccion_Entrega']);
        $ficha_venta->__SET('RE_Telefono_Contacto1',$_REQUEST['RE_Telefono_Contacto1']);
        $ficha_venta->__SET('RE_Telefono_Contacto2',$_REQUEST['RE_Telefono_Contacto2']);
        $ficha_venta->__SET('RE_Tipo_Contacto_Ol',$_REQUEST['RE_Tipo_Contacto_Ol']);
        $ficha_venta->__SET('RV_Tipo_Ofrecimiento',$_REQUEST['RV_Tipo_Ofrecimiento']);
        $ficha_venta->__SET('RV_Tipo_Venta',$_REQUEST['RV_Tipo_Venta']);
        $ficha_venta->__SET('RV_Operador_Cedente',$_REQUEST['RV_Operador_Cedente']);
        $ficha_venta->__SET('RV_Origen',$_REQUEST['RV_Origen']);
        $ficha_venta->__SET('RV_Linea_Portar',$_REQUEST['RV_Linea_Portar']);
        $ficha_venta->__SET('RV_Plan_Tarifario',$_REQUEST['RV_Plan_Tarifario']);
        $ficha_venta->__SET('RV_Cargo_Fijo_Plan',$_REQUEST['RV_Cargo_Fijo_Plan']);
        $ficha_venta->__SET('RV_Tipo_Producto',$_REQUEST['RV_Tipo_Producto']);
        $ficha_venta->__SET('RV_Accesorio_Regalo',$_REQUEST['RV_Accesorio_Regalo']);
        $ficha_venta->__SET('RV_SKU_Accesorio_Regalo1',$_REQUEST['RV_SKU_Accesorio_Regalo1']);
        $ficha_venta->__SET('RV_SKU_Accesorio_Regalo2',$_REQUEST['RV_SKU_Accesorio_Regalo2']);
        $ficha_venta->__SET('RV_SKU_Pack',$_REQUEST['RV_SKU_Pack']);
        $ficha_venta->__SET('RV_Precio_Equipo_Inicial_Total',$_REQUEST['RV_Precio_Equipo_Inicial_Total']);
        $ficha_venta->__SET('RV_Cuota_Equipo_Mensual',$_REQUEST['RV_Cuota_Equipo_Mensual']);
        $ficha_venta->__SET('RV_Cant_Accesorios',$_REQUEST['RV_Cant_Accesorios']);
        $ficha_venta->__SET('RV_SKU_Accesorio1',$_REQUEST['RV_SKU_Accesorio1']);
        $ficha_venta->__SET('RV_Precio_Accesorio1',$_REQUEST['RV_Precio_Accesorio1']);
        $ficha_venta->__SET('RV_SKU_Accesorio2',$_REQUEST['RV_SKU_Accesorio2']);
        $ficha_venta->__SET('RV_Precio_Accesorio2',$_REQUEST['RV_Precio_Accesorio2']);
        $ficha_venta->__SET('RV_SKU_Accesorio3',$_REQUEST['RV_SKU_Accesorio3']);
        $ficha_venta->__SET('RV_Precio_Accesorio3',$_REQUEST['RV_Precio_Accesorio3']);
        $ficha_venta->__SET('RV_SKU_Accesorio4',$_REQUEST['RV_SKU_Accesorio4']);
        $ficha_venta->__SET('RV_Precio_Accesorio4',$_REQUEST['RV_Precio_Accesorio4']);
        $ficha_venta->__SET('RV_SKU_Accesorio5',$_REQUEST['RV_SKU_Accesorio5']);
        $ficha_venta->__SET('RV_Precio_Accesorio5',$_REQUEST['RV_Precio_Accesorio5']);
        $ficha_venta->__SET('RV_Tipo_Pago',$_REQUEST['RV_Tipo_Pago']);
        $ficha_venta->__SET('RV_Promociones_Bancos',$_REQUEST['RV_Promociones_Bancos']);
        $ficha_venta->__SET('Supervisor_Vendedor',$_REQUEST['Supervisor_Vendedor']);
        $ficha_venta->__SET('Comentarios_Vendedor',$_REQUEST['Comentarios_Vendedor']);
        $ficha_venta->__SET('VBO_Estado_Venta_BO',$_REQUEST['VBO_Estado_Venta_BO']);
        $ficha_venta->__SET('VBO_Sub_Estado_Venta_BO',$_REQUEST['VBO_Sub_Estado_Venta_BO']);
        $ficha_venta->__SET('RBO_Cantidad_Ordenes_Ficha',$_REQUEST['RBO_Cantidad_Ordenes_Ficha']);
        $ficha_venta->__SET('RBO_Orden_One_Click1',$_REQUEST['RBO_Orden_One_Click1']);
        $ficha_venta->__SET('RBO_Orden_One_Click2',$_REQUEST['RBO_Orden_One_Click2']);
        $ficha_venta->__SET('RBO_Orden_One_Click3',$_REQUEST['RBO_Orden_One_Click3']);
        $ficha_venta->__SET('FBO_Ficha_Limpia',$_REQUEST['FBO_Ficha_Limpia']);
        $ficha_venta->__SET('FBO_Errores_Comunes_Ficha',$_REQUEST['FBO_Errores_Comunes_Ficha']);
        $ficha_venta->__SET('DGBO_Tipo_Atencion_Final',$_REQUEST['DGBO_Tipo_Atencion_Final']);
        $ficha_venta->__SET('Comentarios_BackOffice',$_REQUEST['Comentarios_BackOffice']);
        $ficha_venta->__SET('Modificado_por_BackOffice',$_SESSION['Usuario_Actual']);
        $tipo_actualizacion=$_REQUEST['tipo_actualizacion'];
        if ($tipo_actualizacion=="Validacion_BO") {
            $ficha_venta->__SET('DGBO_BO_Validador_Gestor',$_SESSION['Usuario_Actual']);
            $ficha_venta->__SET('DGBO_BO_Recupero_Repro_Gestor',$_REQUEST['DGBO_BO_Recupero_Repro_Gestor']);
        }else if($tipo_actualizacion=="Recup_Repro_BO"){
            $ficha_venta->__SET('DGBO_BO_Validador_Gestor',$_REQUEST['DGBO_BO_Validador_Gestor']);
            $ficha_venta->__SET('DGBO_BO_Recupero_Repro_Gestor',$_SESSION['Usuario_Actual']);
        }else{
            $ficha_venta->__SET('DGBO_BO_Validador_Gestor',$_SESSION['Usuario_Actual']);
            $ficha_venta->__SET('DGBO_BO_Recupero_Repro_Gestor',$_SESSION['Usuario_Actual']);
        }
     


        $idFecha_Venta=$this->model->Actualizar($ficha_venta);
        

         //$Gestion_id=$this->RegistrarGestion($Negociacion_id,$_REQUEST['Deudor_id'],$_REQUEST['ObligacionCartera_id'],$_REQUEST['Campana_id'],$FechaPagoCtaInicial,$_REQUEST['TipoNegociacion'],$_SESSION['Persona_Actual'],$_REQUEST['Operador_id'],$TipoGestion_id,$_REQUEST['Telefono_idTitular'],$_REQUEST['Direccion_id'],$_REQUEST['Correo_id'],$observaciones_gestion);

        //$this->ActualizarGestionidCompromiso($Negociacion_id,$Gestion_id);

        echo  json_encode($idFecha_Venta);
    }


    public function ListarFichaVentas()
    {   



        ini_set('memory_limit', '-1');
 
            $requestData= $_REQUEST;
            $totalFichas = $this->consultar_row("SELECT count(idFicha_Venta) as Nro_Fichas from ficha_venta inner join cliente on cliente.idCliente=ficha_venta.Cliente_id where ficha_venta.Eliminado=0");
        
            $Fichas_Venta = $this->Consultas("SELECT * FROM ficha_venta inner join cliente on cliente.idCliente=ficha_venta.Cliente_id where ficha_venta.Eliminado=0 order by  RAND() LIMIT ".$requestData['start']." ,".$requestData['length']." ");


            $totalData = $totalFichas['Nro_Fichas'];
            $totalFiltered = $totalData;

            $data = array();
            $nro_registros=$requestData['start']+1;
            foreach ($Fichas_Venta as $Ficha) {
                $nestedData=array();
                $nestedData['Nro'] = $nro_registros;
                $nestedData['idFicha_Venta'] = $Ficha["idFicha_Venta"];
                $nestedData['Cliente_id'] = $Ficha["Documento"];                
                $nestedData['DE_Campana_Netcall'] = $Ficha["Nombre_Cliente"].' '.$Ficha["Apellido_Paterno"].' '.$Ficha["Apellido_Materno"];
                $idSubCategoria=$Ficha["VBO_Estado_Venta_BO"];
                $VBO_Estado_Venta_BO = $this->consultar_row("SELECT * from subcategoria where idSubcategoria=$idSubCategoria");
                $nestedData['VBO_Estado_Venta_BO'] = $VBO_Estado_Venta_BO["Nombre"];
                $data[] = $nestedData;
                 $nro_registros++;
            }
            $json_data = array(
                "draw"            => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
                "recordsTotal"    => intval( $totalData ),  // total number of records
                "recordsFiltered" => intval( $totalData ), // total number of records after searching, if there is no searching then totalFiltered = totalData
                "data"            => $data   // total data array
            );

            echo  json_encode($json_data);
        }    

    public function ConsultarxIdFicha_Venta()
    {   


        $idFicha_Venta=$_REQUEST['idFicha_Venta'];
 
          
        $ficha_venta = $this->consultar_row("SELECT * FROM ficha_venta inner join cliente on cliente.idCliente=ficha_venta.Cliente_id where idFicha_Venta=$idFicha_Venta");
        echo json_encode($ficha_venta);
    }


}