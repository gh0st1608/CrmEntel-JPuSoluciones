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
            $FVenta_Interfaz="FichaVenta_Registrar";
            require_once 'view/header.php';
            require_once 'view/ventas/Registrar_Ficha.php';
            require_once 'view/footer.php'; 
        }
               
    }

    public function v_Actualizar_Ficha(){
        if (isset($_REQUEST['idFicha_Venta']) && $_REQUEST['idFicha_Venta']!=''){
            $FVenta_Interfaz="FichaVenta_Actualizar";
            require_once 'view/header.php';
            require_once 'view/ventas/Registrar_Ficha.php';
            require_once 'view/footer.php'; 
        }else{
            header('Location: index.php?c=Ficha_Venta');
        }
    }    

    public function v_Visualizar_Ficha(){
        if (isset($_REQUEST['idFicha_Venta']) && $_REQUEST['idFicha_Venta']!=''){
            $FVenta_Interfaz="disabled";
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
        $ficha_venta->__SET('VBO_Estado_Venta_BO',154);


        $idFecha_Venta=$registrar_ficha_venta = $this->model->Registrar($ficha_venta);
        

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
        
        if ($ObjCliente->__GET('idCliente')==0) {
            $Cliente_id=$cliente->RegistrarCliente($DP_TipoDocumento,$DP_Documento,$DP_Nombre_Cliente,$DP_Apellido_Paterno,$DP_Apellido_Materno,$DP_Nacionalidad,$DP_Lugar_Nacimiento,$DP_Fecha_Nacimiento,$DP_Nombre_Padre,$DP_Nombre_Madre);
        }else{
            $Cliente_id=$ObjCliente->__GET('idCliente');
            $cliente->ActualizarCliente($Cliente_id,$DP_TipoDocumento,$DP_Documento,$DP_Nombre_Cliente,$DP_Apellido_Paterno,$DP_Apellido_Materno,$DP_Nacionalidad,$DP_Lugar_Nacimiento,$DP_Fecha_Nacimiento,$DP_Nombre_Padre,$DP_Nombre_Madre);
        }
        

      
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
        $ficha_venta->__SET('Ingresado_por_Vendedor',$_REQUEST['Ingresado_por_Vendedor']);
        $ficha_venta->__SET('Fecha_Registro_Vendedor',$_REQUEST['Fecha_Registro_Vendedor']);
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
        

        echo  json_encode($idFecha_Venta);
    }

        public function validarPermiso ($idPerfil = 0,$idInterfaz=0){

              try
                {
                     ini_set('memory_limit', -1); 
                $this->pdo = new Conexion();
                    $result = array();

                    $stm = $this->pdo->prepare("SELECT acceder     FROM Permiso
                        WHERE Interfaz_id = $idInterfaz
                        AND Perfil_id=$idPerfil");
                    $stm->execute();
                           
                    return $stm->fetch(PDO::FETCH_ASSOC);
                }
                catch(Exception $e)
                {
                    die($e->getMessage());
                }

          }


    public function ListarFichaVentas()
    {   
        ini_set('memory_limit', '-1');

        $SubCategorias=$this->Consultas("SELECT * from subcategoria");
            $arraySubCat = array();
            foreach ($SubCategorias as $item ) {
                $arraySubCat[$item['idSubCategoria']]['idSubCategoria']=$item['idSubCategoria'];
                $arraySubCat[$item['idSubCategoria']]['Nombre']=$item['Nombre'];
            }

            $Personas=$this->Consultas("SELECT idPersona,Documento,CONCAT(persona.Primer_Nombre,' ',persona.Segundo_Nombre,' ',persona.Apellido_Paterno,' ',persona.Apellido_Materno) as 'NombrePersona' from persona");
            $arrayPersona = array();
            $arrayPersona[0]['idPersona']="";
            $arrayPersona[0]['NombrePersona']="";
            $arrayPersona[0]['Documento']="";
            foreach ($Personas as $item ) {
                $arrayPersona[$item['idPersona']]['idPersona']=$item['idPersona'];
                $arrayPersona[$item['idPersona']]['NombrePersona']=$item['NombrePersona'];
                $arrayPersona[$item['idPersona']]['Documento']=$item['Documento'];
            }
            $Ubigeos=$this->Consultas("SELECT * from Ubigeo");
            $arrayDist  = array();
            $arrayProv = array();
            $arrayDpto  = array(); 
            foreach ($Ubigeos as $item ) {
                $arrayDist[$item['idUbigeo']]['Cod_Dist']=$item['idUbigeo'];
                $arrayDist[$item['idUbigeo']]['Descripcion']=$item['Descripcion'];
                if ($item['Tipo_Ubigeo']=='DPTO') {
                    $arrayDpto[$item['Cod_Dpto']]['Cod_Dpto']=$item['Cod_Prov'];
                    $arrayDpto[$item['Cod_Dpto']]['Descripcion']=$item['Descripcion'];
                }

                if ($item['Tipo_Ubigeo']=='PROV') {
                    $arrayProv[$item['Cod_Prov']]['Cod_Prov']=$item['Cod_Prov'];
                    $arrayProv[$item['Cod_Prov']]['Descripcion']=$item['Descripcion'];
                }

            }

            //Fecha Inicio
            if (isset($_REQUEST['Busc_Fecha_Inicio']) && $_REQUEST['Busc_Fecha_Inicio']<>"" && isset($_REQUEST['Busc_Fecha_Fin']) && $_REQUEST['Busc_Fecha_Fin']<>"" ) { 
                       
               $RangoFechas=" and DATE(ficha_venta.Fecha_Registro_Vendedor)>='".$_REQUEST['Busc_Fecha_Inicio']."' and DATE(ficha_venta.Fecha_Registro_Vendedor)<='".$_REQUEST['Busc_Fecha_Fin']."'";
            }else{
                 $RangoFechas="";
            }

            //Documento
            if (isset($_REQUEST['DP_Documento']) && $_REQUEST['DP_Documento']<>"" ) { 
                
                $DP_Documento = htmlspecialchars($_REQUEST['DP_Documento'], ENT_QUOTES);         
               $DP_Documento=" and cliente.Documento='".$DP_Documento."'";
            }else{
                 $DP_Documento="";
            }

           //RE_Tipo_Despacho
            if (isset($_REQUEST['RE_Tipo_Despacho']) && $_REQUEST['RE_Tipo_Despacho']<>0 ) { 
                $RE_Tipo_Despacho=" and RE_Tipo_Despacho=".$_REQUEST['RE_Tipo_Despacho']."";
            }else{
                 $RE_Tipo_Despacho="";
            }
            //RE_Rango_Entrega_Despacho
            if (isset($_REQUEST['RE_Rango_Entrega_Despacho']) && $_REQUEST['RE_Rango_Entrega_Despacho']<>0 ) { 
                $RE_Rango_Entrega_Despacho=" and RE_Rango_Entrega_Despacho=".$_REQUEST['RE_Rango_Entrega_Despacho']."";
            }else{
                 $RE_Rango_Entrega_Despacho="";
            }            

            //RV_Tipo_Ofrecimiento
            if (isset($_REQUEST['RV_Tipo_Ofrecimiento']) && $_REQUEST['RV_Tipo_Ofrecimiento']<>0 ) { 
                $RV_Tipo_Ofrecimiento=" and RV_Tipo_Ofrecimiento=".$_REQUEST['RV_Tipo_Ofrecimiento']."";
            }else{
                 $RV_Tipo_Ofrecimiento="";
            }            

            //RV_Tipo_Venta
            if (isset($_REQUEST['RV_Tipo_Venta']) && $_REQUEST['RV_Tipo_Venta']<>0 ) { 
                $RV_Tipo_Venta=" and RV_Tipo_Venta=".$_REQUEST['RV_Tipo_Venta']."";
            }else{
                 $RV_Tipo_Venta="";
            }            

            //RV_Linea_Portar
            if (isset($_REQUEST['RV_Linea_Portar']) && $_REQUEST['RV_Linea_Portar']<>"" ) { 
                
                $RV_Linea_Portar = htmlspecialchars($_REQUEST['RV_Linea_Portar'], ENT_QUOTES);         
               $RV_Linea_Portar=" and RV_Linea_Portar='".$RV_Linea_Portar."'";
            }else{
                 $RV_Linea_Portar="";
            }            

            //RV_Tipo_Producto
            if (isset($_REQUEST['RV_Tipo_Producto']) && $_REQUEST['RV_Tipo_Producto']<>0 ) { 
                $RV_Tipo_Producto=" and RV_Tipo_Producto=".$_REQUEST['RV_Tipo_Producto']."";
            }else{
                 $RV_Tipo_Producto="";
            }             

            //VBO_Estado_Venta_BO
            if (isset($_REQUEST['VBO_Estado_Venta_BO']) && $_REQUEST['VBO_Estado_Venta_BO']<>0 ) { 
                $VBO_Estado_Venta_BO=" and VBO_Estado_Venta_BO=".$_REQUEST['VBO_Estado_Venta_BO']."";
            }else{
                 $VBO_Estado_Venta_BO="";
            }           

            //RV_Tipo_Producto
            if (isset($_REQUEST['Supervisor_Vendedor']) && $_REQUEST['Supervisor_Vendedor']<>0 ) { 
                $Supervisor_Vendedor=" and Supervisor_Vendedor=".$_REQUEST['Supervisor_Vendedor']."";
            }else{
                 $Supervisor_Vendedor="";
            }            

            //RV_Linea_Portar
            if (isset($_REQUEST['Documento_Vendedor']) && $_REQUEST['Documento_Vendedor']<>"" ) { 
                
                $Documento_Vendedor = htmlspecialchars($_REQUEST['Documento_Vendedor'], ENT_QUOTES);         
               $Documento_Vendedor=" and vendedor.Documento='".$Documento_Vendedor."'";
            }else{
                 $Documento_Vendedor="";
            }

            if($_SESSION['Perfil_Actual']==4){
                $vendedor_id=" and ficha_venta.Ingresado_por_Vendedor=".$_SESSION['Usuario_Actual']."";
                //$vendedor_id="";
            }else{
                $vendedor_id="";
            }         
  


            $requestData= $_REQUEST;
            $totalFichas = $this->consultar_row("SELECT count(idFicha_Venta) as Nro_Fichas FROM ficha_venta
            inner join cliente on cliente.idCliente=ficha_venta.Cliente_id
            left join usuario as usuario on usuario.idUsuario=ficha_venta.Ingresado_por_Vendedor
            left join persona as vendedor on vendedor.idPersona=usuario.Persona_id
             where ficha_venta.Eliminado=0 $RangoFechas $DP_Documento $RE_Tipo_Despacho $RE_Rango_Entrega_Despacho $RV_Tipo_Ofrecimiento  $RV_Tipo_Venta $RV_Linea_Portar  $RV_Tipo_Producto $VBO_Estado_Venta_BO $Supervisor_Vendedor $Documento_Vendedor  $vendedor_id order by Fecha_Registro_Vendedor");

            $Fichas_Venta=$this->Consultas("SELECT idFicha_Venta
            ,DATE(ficha_venta.Fecha_Registro_Vendedor) as Fecha_Venta
            ,TIME(ficha_venta.Fecha_Registro_Vendedor) as Hora_Venta
            ,cliente.Documento as 'DP_Documento'
            ,RE_Tipo_Despacho
            ,RE_Rango_Entrega_Despacho
            ,RE_Rango_Horario_Despacho
            ,RE_Ubigeo_Entrega as 'RE_Dist_Entrega_Producto'
            ,DATEDIFF(RE_Fecha_Entrega,Fecha_Registro_Vendedor) as 'SLA_Entrega'
            ,RV_Tipo_Ofrecimiento
            ,RV_Tipo_Venta
            ,RV_Linea_Portar
            ,RV_Tipo_Producto
            ,Supervisor_Vendedor
            ,VBO_Estado_Venta_BO
            ,VBO_Sub_Estado_Venta_BO
            ,DGBO_Tipo_Atencion_Final
            ,DGBO_BO_Validador_Gestor
            ,DGBO_BO_Recupero_Repro_Gestor
             FROM ficha_venta
            inner join cliente on cliente.idCliente=ficha_venta.Cliente_id
            left join usuario as usuario on usuario.idUsuario=ficha_venta.Ingresado_por_Vendedor
            left join persona as vendedor on vendedor.idPersona=usuario.Persona_id
             where ficha_venta.Eliminado=0 $RangoFechas $DP_Documento $RE_Tipo_Despacho $RE_Rango_Entrega_Despacho $RV_Tipo_Ofrecimiento  $RV_Tipo_Venta $RV_Linea_Portar $RV_Tipo_Producto $VBO_Estado_Venta_BO $Supervisor_Vendedor $Documento_Vendedor  $vendedor_id  order by Fecha_Registro_Vendedor LIMIT ".$requestData['start']." ,".$requestData['length'].""); 



            $permiso=$this->validarPermiso($_SESSION['Perfil_Actual'],23);
            if ($permiso['acceder']==1) {
                $BloquearAct="";
            }else{
                
                $BloquearAct="hidden";
            }

            $totalData = $totalFichas['Nro_Fichas'];
            $totalFiltered = $totalData;

            $data = array();
            $nro_registros=$requestData['start']+1;
            foreach ($Fichas_Venta as $Ficha) {
                $nestedData=array();
                $nestedData['Nro'] = $nro_registros;
                $nestedData['idFicha_Venta'] = $Ficha["idFicha_Venta"];
                $nestedData['Fecha_Venta'] = $Ficha["Fecha_Venta"];
                $nestedData['Hora_Venta'] = $Ficha["Hora_Venta"];
                $nestedData['DP_Documento'] = $Ficha["DP_Documento"];
                $nestedData['RE_Tipo_Despacho'] = $arraySubCat[$Ficha['RE_Tipo_Despacho']]['Nombre'];
                $nestedData['RE_Rango_Entrega_Despacho'] = $arraySubCat[$Ficha['RE_Rango_Entrega_Despacho']]['Nombre'];
                $nestedData['RE_Rango_Horario_Despacho'] = $arraySubCat[$Ficha['RE_Rango_Horario_Despacho']]['Nombre'];
                $RE_Dist_Entrega=str_pad($Ficha['RE_Dist_Entrega_Producto'],6,"0", STR_PAD_LEFT); 
                $RE_Prov_Entrega=substr($RE_Dist_Entrega,0,4);
                $RE_Dpto_Entrega=substr($RE_Dist_Entrega,0,2);
                $nestedData['RE_Dpto_Entrega_Producto'] = $arrayDpto[$RE_Dpto_Entrega]['Descripcion'];
                $nestedData['RE_Prov_Entrega_Producto'] = $arrayProv[$RE_Prov_Entrega]['Descripcion'];
                $nestedData['RE_Dist_Entrega_Producto'] = $arrayDist[$Ficha['RE_Dist_Entrega_Producto']]['Descripcion'];
                $nestedData['SLA_Entrega'] = $Ficha["SLA_Entrega"];
                $nestedData['RV_Tipo_Ofrecimiento'] = $arraySubCat[$Ficha['RV_Tipo_Ofrecimiento']]['Nombre'];
                $nestedData['RV_Tipo_Venta'] = $arraySubCat[$Ficha['RV_Tipo_Venta']]['Nombre'];
                $nestedData['RV_Linea_Portar'] = $Ficha["RV_Linea_Portar"];
                $nestedData['RV_Tipo_Producto'] = $arraySubCat[$Ficha['RV_Tipo_Producto']]['Nombre'];
                $nestedData['Supervisor_Vendedor'] = $arrayPersona[$Ficha['Supervisor_Vendedor']]['NombrePersona'];
                $nestedData['VBO_Estado_Venta_BO'] = $arraySubCat[$Ficha['VBO_Estado_Venta_BO']]['Nombre'];
                $nestedData['VBO_Sub_Estado_Venta_BO'] = $arraySubCat[$Ficha['VBO_Sub_Estado_Venta_BO']]['Nombre'];
                $nestedData['DGBO_Tipo_Atencion_Final'] = $arraySubCat[$Ficha['DGBO_Tipo_Atencion_Final']]['Nombre'];
                $nestedData['DGBO_BO_Validador_Gestor'] = $arrayPersona[$Ficha['DGBO_BO_Validador_Gestor']]['NombrePersona'];
                $nestedData['DGBO_BO_Recupero_Repro_Gestor'] = $arrayPersona[$Ficha['DGBO_BO_Recupero_Repro_Gestor']]['NombrePersona'];
                $nestedData['BloquearAct'] = $BloquearAct;
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
 
          
        $ficha_venta = $this->consultar_row("SELECT ficha_venta.*,cliente.*,vendedor.Documento as Documento_Vendedor,CONCAT(vendedor.Primer_Nombre,' ',vendedor.Segundo_Nombre,' ',vendedor.Apellido_Paterno,' ',vendedor.Apellido_Materno) as Nombre_Vendedor FROM ficha_venta 
            inner join cliente on cliente.idCliente=ficha_venta.Cliente_id
            left join usuario as usuario on usuario.idUsuario=ficha_venta.Ingresado_por_Vendedor
            left join persona as vendedor on vendedor.idPersona=usuario.Persona_id
            where idFicha_Venta=$idFicha_Venta");
        echo json_encode($ficha_venta);
    }

    public function ConsultarSubCategoria()
    {   
  
        $idSubCategoria = $_POST['idSubCategoria'];
        $NomVariable = $_POST['NomVariable'];
        $NumAccion = $_POST['NumAccion'];
        $NomAccion = $_POST['NomAccion']; 
        $consulta = $this->model->ConsultarSubCategoria($idSubCategoria,$NomVariable,$NumAccion,$NomAccion);
        echo  json_encode($consulta);
      
    }


}