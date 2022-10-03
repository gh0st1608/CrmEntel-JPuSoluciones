<?php
include_once 'conexion.php';
class Ficha_VentaModel 
{
	
    private $bd;
    public function Registrar(Ficha_Venta $ficha_venta)
    {

           
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("INSERT INTO ficha_venta (DE_Telf_Llamada_Venta,DE_Base_Llamada,DE_Campana_Netcall,DE_Sub_Campana,DE_Detalle_Sub_Campana,DE_CF_Max_Linea_Movil,DE_Tipo_Etiqueta,DE_CF_Max_Linea_Pack,DE_Monto_Disp_Finan_Equipos,DE_Cant_Meses_Finan_Equipos,DE_Cliente_Entel,DE_Cliente_Promo_Dscto,Cliente_id,DF_Email_Facturacion_Otros,DF_Ubigeo_Facturacion,DF_Domicilio_Facturacion,RE_Tipo_Despacho,RE_Rango_Entrega_Despacho,RE_Rango_Horario_Despacho,RE_Tienda_Retiro,RE_Retail_Retiro,RE_Fecha_Entrega,RE_Venta_Entrega_para,RE_Venta_Destino_para,RE_Ubigeo_Entrega,RE_Tipo_Direccion_Entrega,RE_Direccion_Entrega,RE_Referencia_Principales,RE_Referencias_Adicionales,RE_Coordenadas_Direccion_Entrega,RE_Telefono_Contacto1,RE_Telefono_Contacto2,RE_Tipo_Contacto_Ol,RV_Tipo_Ofrecimiento,RV_Tipo_Venta,RV_Operador_Cedente,RV_Origen,RV_Linea_Portar,RV_Plan_Tarifario,RV_Cargo_Fijo_Plan,RV_Tipo_Producto,RV_Accesorio_Regalo,RV_SKU_Accesorio_Regalo1,RV_SKU_Accesorio_Regalo2,RV_SKU_Pack,RV_Precio_Equipo_Inicial_Total,RV_Cuota_Equipo_Mensual,RV_Cant_Accesorios,RV_SKU_Accesorio1,RV_Precio_Accesorio1,RV_SKU_Accesorio2,RV_Precio_Accesorio2,RV_SKU_Accesorio3,RV_Precio_Accesorio3,RV_SKU_Accesorio4,RV_Precio_Accesorio4,RV_SKU_Accesorio5,RV_Precio_Accesorio5,RV_Tipo_Pago,RV_Promociones_Bancos,Supervisor_Vendedor,Comentarios_Vendedor,Ingresado_por_Vendedor) VALUES(:DE_Telf_Llamada_Venta,:DE_Base_Llamada,:DE_Campana_Netcall,:DE_Sub_Campana,:DE_Detalle_Sub_Campana,:DE_CF_Max_Linea_Movil,:DE_Tipo_Etiqueta,:DE_CF_Max_Linea_Pack,:DE_Monto_Disp_Finan_Equipos,:DE_Cant_Meses_Finan_Equipos,:DE_Cliente_Entel,:DE_Cliente_Promo_Dscto,:Cliente_id,:DF_Email_Facturacion_Otros,:DF_Ubigeo_Facturacion,:DF_Domicilio_Facturacion,:RE_Tipo_Despacho,:RE_Rango_Entrega_Despacho,:RE_Rango_Horario_Despacho,:RE_Tienda_Retiro,:RE_Retail_Retiro,:RE_Fecha_Entrega,:RE_Venta_Entrega_para,:RE_Venta_Destino_para,:RE_Ubigeo_Entrega,:RE_Tipo_Direccion_Entrega,:RE_Direccion_Entrega,:RE_Referencia_Principales,:RE_Referencias_Adicionales,:RE_Coordenadas_Direccion_Entrega,:RE_Telefono_Contacto1,:RE_Telefono_Contacto2,:RE_Tipo_Contacto_Ol,:RV_Tipo_Ofrecimiento,:RV_Tipo_Venta,:RV_Operador_Cedente,:RV_Origen,:RV_Linea_Portar,:RV_Plan_Tarifario,:RV_Cargo_Fijo_Plan,:RV_Tipo_Producto,:RV_Accesorio_Regalo,:RV_SKU_Accesorio_Regalo1,:RV_SKU_Accesorio_Regalo2,:RV_SKU_Pack,:RV_Precio_Equipo_Inicial_Total,:RV_Cuota_Equipo_Mensual,:RV_Cant_Accesorios,:RV_SKU_Accesorio1,:RV_Precio_Accesorio1,:RV_SKU_Accesorio2,:RV_Precio_Accesorio2,:RV_SKU_Accesorio3,:RV_Precio_Accesorio3,:RV_SKU_Accesorio4,:RV_Precio_Accesorio4,:RV_SKU_Accesorio5,:RV_Precio_Accesorio5,:RV_Tipo_Pago,:RV_Promociones_Bancos,:Supervisor_Vendedor,:Comentarios_Vendedor,:Ingresado_por_Vendedor)");  

                $stmt->bindParam(':DE_Telf_Llamada_Venta',$ficha_venta->__GET('DE_Telf_Llamada_Venta'));
                $stmt->bindParam(':DE_Base_Llamada',$ficha_venta->__GET('DE_Base_Llamada'));
                $stmt->bindParam(':DE_Campana_Netcall',$ficha_venta->__GET('DE_Campana_Netcall'));
                $stmt->bindParam(':DE_Sub_Campana',$ficha_venta->__GET('DE_Sub_Campana'));
                $stmt->bindParam(':DE_Detalle_Sub_Campana',$ficha_venta->__GET('DE_Detalle_Sub_Campana'));
                $stmt->bindParam(':DE_CF_Max_Linea_Movil',$ficha_venta->__GET('DE_CF_Max_Linea_Movil'));
                $stmt->bindParam(':DE_Tipo_Etiqueta',$ficha_venta->__GET('DE_Tipo_Etiqueta'));
                $stmt->bindParam(':DE_CF_Max_Linea_Pack',$ficha_venta->__GET('DE_CF_Max_Linea_Pack'));
                $stmt->bindParam(':DE_Monto_Disp_Finan_Equipos',$ficha_venta->__GET('DE_Monto_Disp_Finan_Equipos'));
                $stmt->bindParam(':DE_Cant_Meses_Finan_Equipos',$ficha_venta->__GET('DE_Cant_Meses_Finan_Equipos'));
                $stmt->bindParam(':DE_Cliente_Entel',$ficha_venta->__GET('DE_Cliente_Entel'));
                $stmt->bindParam(':DE_Cliente_Promo_Dscto',$ficha_venta->__GET('DE_Cliente_Promo_Dscto'));
                $stmt->bindParam(':Cliente_id',$ficha_venta->__GET('Cliente_id'));
                $stmt->bindParam(':DF_Email_Facturacion_Otros',$ficha_venta->__GET('DF_Email_Facturacion_Otros'));
                $stmt->bindParam(':DF_Ubigeo_Facturacion',$ficha_venta->__GET('DF_Ubigeo_Facturacion'));
                $stmt->bindParam(':DF_Domicilio_Facturacion',$ficha_venta->__GET('DF_Domicilio_Facturacion'));
                $stmt->bindParam(':RE_Tipo_Despacho',$ficha_venta->__GET('RE_Tipo_Despacho'));
                $stmt->bindParam(':RE_Rango_Entrega_Despacho',$ficha_venta->__GET('RE_Rango_Entrega_Despacho'));
                $stmt->bindParam(':RE_Rango_Horario_Despacho',$ficha_venta->__GET('RE_Rango_Horario_Despacho'));
                $stmt->bindParam(':RE_Tienda_Retiro',$ficha_venta->__GET('RE_Tienda_Retiro'));
                $stmt->bindParam(':RE_Retail_Retiro',$ficha_venta->__GET('RE_Retail_Retiro'));
                $stmt->bindParam(':RE_Fecha_Entrega',$ficha_venta->__GET('RE_Fecha_Entrega'));
                $stmt->bindParam(':RE_Venta_Entrega_para',$ficha_venta->__GET('RE_Venta_Entrega_para'));
                $stmt->bindParam(':RE_Venta_Destino_para',$ficha_venta->__GET('RE_Venta_Destino_para'));
                $stmt->bindParam(':RE_Ubigeo_Entrega',$ficha_venta->__GET('RE_Ubigeo_Entrega'));
                $stmt->bindParam(':RE_Tipo_Direccion_Entrega',$ficha_venta->__GET('RE_Tipo_Direccion_Entrega'));
                $stmt->bindParam(':RE_Direccion_Entrega',$ficha_venta->__GET('RE_Direccion_Entrega'));
                $stmt->bindParam(':RE_Referencia_Principales',$ficha_venta->__GET('RE_Referencia_Principales'));
                $stmt->bindParam(':RE_Referencias_Adicionales',$ficha_venta->__GET('RE_Referencias_Adicionales'));
                $stmt->bindParam(':RE_Coordenadas_Direccion_Entrega',$ficha_venta->__GET('RE_Coordenadas_Direccion_Entrega'));
                $stmt->bindParam(':RE_Telefono_Contacto1',$ficha_venta->__GET('RE_Telefono_Contacto1'));
                $stmt->bindParam(':RE_Telefono_Contacto2',$ficha_venta->__GET('RE_Telefono_Contacto2'));
                $stmt->bindParam(':RE_Tipo_Contacto_Ol',$ficha_venta->__GET('RE_Tipo_Contacto_Ol'));
                $stmt->bindParam(':RV_Tipo_Ofrecimiento',$ficha_venta->__GET('RV_Tipo_Ofrecimiento'));
                $stmt->bindParam(':RV_Tipo_Venta',$ficha_venta->__GET('RV_Tipo_Venta'));
                $stmt->bindParam(':RV_Operador_Cedente',$ficha_venta->__GET('RV_Operador_Cedente'));
                $stmt->bindParam(':RV_Origen',$ficha_venta->__GET('RV_Origen'));
                $stmt->bindParam(':RV_Linea_Portar',$ficha_venta->__GET('RV_Linea_Portar'));
                $stmt->bindParam(':RV_Plan_Tarifario',$ficha_venta->__GET('RV_Plan_Tarifario'));
                $stmt->bindParam(':RV_Cargo_Fijo_Plan',$ficha_venta->__GET('RV_Cargo_Fijo_Plan'));
                $stmt->bindParam(':RV_Tipo_Producto',$ficha_venta->__GET('RV_Tipo_Producto'));
                $stmt->bindParam(':RV_Accesorio_Regalo',$ficha_venta->__GET('RV_Accesorio_Regalo'));
                $stmt->bindParam(':RV_SKU_Accesorio_Regalo1',$ficha_venta->__GET('RV_SKU_Accesorio_Regalo1'));
                $stmt->bindParam(':RV_SKU_Accesorio_Regalo2',$ficha_venta->__GET('RV_SKU_Accesorio_Regalo2'));
                $stmt->bindParam(':RV_SKU_Pack',$ficha_venta->__GET('RV_SKU_Pack'));
                $stmt->bindParam(':RV_Precio_Equipo_Inicial_Total',$ficha_venta->__GET('RV_Precio_Equipo_Inicial_Total'));
                $stmt->bindParam(':RV_Cuota_Equipo_Mensual',$ficha_venta->__GET('RV_Cuota_Equipo_Mensual'));
                $stmt->bindParam(':RV_Cant_Accesorios',$ficha_venta->__GET('RV_Cant_Accesorios'));
                $stmt->bindParam(':RV_SKU_Accesorio1',$ficha_venta->__GET('RV_SKU_Accesorio1'));
                $stmt->bindParam(':RV_Precio_Accesorio1',$ficha_venta->__GET('RV_Precio_Accesorio1'));
                $stmt->bindParam(':RV_SKU_Accesorio2',$ficha_venta->__GET('RV_SKU_Accesorio2'));
                $stmt->bindParam(':RV_Precio_Accesorio2',$ficha_venta->__GET('RV_Precio_Accesorio2'));
                $stmt->bindParam(':RV_SKU_Accesorio3',$ficha_venta->__GET('RV_SKU_Accesorio3'));
                $stmt->bindParam(':RV_Precio_Accesorio3',$ficha_venta->__GET('RV_Precio_Accesorio3'));
                $stmt->bindParam(':RV_SKU_Accesorio4',$ficha_venta->__GET('RV_SKU_Accesorio4'));
                $stmt->bindParam(':RV_Precio_Accesorio4',$ficha_venta->__GET('RV_Precio_Accesorio4'));
                $stmt->bindParam(':RV_SKU_Accesorio5',$ficha_venta->__GET('RV_SKU_Accesorio5'));
                $stmt->bindParam(':RV_Precio_Accesorio5',$ficha_venta->__GET('RV_Precio_Accesorio5'));
                $stmt->bindParam(':RV_Tipo_Pago',$ficha_venta->__GET('RV_Tipo_Pago'));
                $stmt->bindParam(':RV_Promociones_Bancos',$ficha_venta->__GET('RV_Promociones_Bancos'));
                $stmt->bindParam(':Supervisor_Vendedor',$ficha_venta->__GET('Supervisor_Vendedor'));
                $stmt->bindParam(':Comentarios_Vendedor',$ficha_venta->__GET('Comentarios_Vendedor'));
                $stmt->bindParam(':Ingresado_por_Vendedor',$ficha_venta->__GET('Ingresado_por_Vendedor'));

                if (!$stmt->execute()) {
                    $errors = $stmt->errorInfo();
                    //echo ($errors[2]);
                   return $errors[2];          
                    //print_r($stmt->errorInfo());
                }else{
                    $idFicha_Venta=$this->bd->lastInsertId();
                    $ficha_venta->__SET('idFicha_Venta',$idFicha_Venta);
                    $this->Registrar_RH($ficha_venta);
                    return $idFicha_Venta;
                    
                }
    }

    public function Actualizar(Ficha_Venta $ficha_venta)
    {
      
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("UPDATE ficha_venta SET  DE_Telf_Llamada_Venta=:DE_Telf_Llamada_Venta,DE_Base_Llamada=:DE_Base_Llamada,DE_Campana_Netcall=:DE_Campana_Netcall,DE_Sub_Campana=:DE_Sub_Campana,DE_Detalle_Sub_Campana=:DE_Detalle_Sub_Campana,DE_CF_Max_Linea_Movil=:DE_CF_Max_Linea_Movil,DE_Tipo_Etiqueta=:DE_Tipo_Etiqueta,DE_CF_Max_Linea_Pack=:DE_CF_Max_Linea_Pack,DE_Monto_Disp_Finan_Equipos=:DE_Monto_Disp_Finan_Equipos,DE_Cant_Meses_Finan_Equipos=:DE_Cant_Meses_Finan_Equipos,DE_Cliente_Entel=:DE_Cliente_Entel,DE_Cliente_Promo_Dscto=:DE_Cliente_Promo_Dscto,Cliente_id=:Cliente_id,DF_Email_Facturacion_Otros=:DF_Email_Facturacion_Otros,DF_Ubigeo_Facturacion=:DF_Ubigeo_Facturacion,DF_Domicilio_Facturacion=:DF_Domicilio_Facturacion,RE_Tipo_Despacho=:RE_Tipo_Despacho,RE_Rango_Entrega_Despacho=:RE_Rango_Entrega_Despacho,RE_Rango_Horario_Despacho=:RE_Rango_Horario_Despacho,RE_Tienda_Retiro=:RE_Tienda_Retiro,RE_Retail_Retiro=:RE_Retail_Retiro,RE_Fecha_Entrega=:RE_Fecha_Entrega,RE_Venta_Entrega_para=:RE_Venta_Entrega_para,RE_Venta_Destino_para=:RE_Venta_Destino_para,RE_Ubigeo_Entrega=:RE_Ubigeo_Entrega,RE_Tipo_Direccion_Entrega=:RE_Tipo_Direccion_Entrega,RE_Direccion_Entrega=:RE_Direccion_Entrega,RE_Referencia_Principales=:RE_Referencia_Principales,RE_Referencias_Adicionales=:RE_Referencias_Adicionales,RE_Coordenadas_Direccion_Entrega=:RE_Coordenadas_Direccion_Entrega,RE_Telefono_Contacto1=:RE_Telefono_Contacto1,RE_Telefono_Contacto2=:RE_Telefono_Contacto2,RE_Tipo_Contacto_Ol=:RE_Tipo_Contacto_Ol,RV_Tipo_Ofrecimiento=:RV_Tipo_Ofrecimiento,RV_Tipo_Venta=:RV_Tipo_Venta,RV_Operador_Cedente=:RV_Operador_Cedente,RV_Origen=:RV_Origen,RV_Linea_Portar=:RV_Linea_Portar,RV_Plan_Tarifario=:RV_Plan_Tarifario,RV_Cargo_Fijo_Plan=:RV_Cargo_Fijo_Plan,RV_Tipo_Producto=:RV_Tipo_Producto,RV_Accesorio_Regalo=:RV_Accesorio_Regalo,RV_SKU_Accesorio_Regalo1=:RV_SKU_Accesorio_Regalo1,RV_SKU_Accesorio_Regalo2=:RV_SKU_Accesorio_Regalo2,RV_SKU_Pack=:RV_SKU_Pack,RV_Precio_Equipo_Inicial_Total=:RV_Precio_Equipo_Inicial_Total,RV_Cuota_Equipo_Mensual=:RV_Cuota_Equipo_Mensual,RV_Cant_Accesorios=:RV_Cant_Accesorios,RV_SKU_Accesorio1=:RV_SKU_Accesorio1,RV_Precio_Accesorio1=:RV_Precio_Accesorio1,RV_SKU_Accesorio2=:RV_SKU_Accesorio2,RV_Precio_Accesorio2=:RV_Precio_Accesorio2,RV_SKU_Accesorio3=:RV_SKU_Accesorio3,RV_Precio_Accesorio3=:RV_Precio_Accesorio3,RV_SKU_Accesorio4=:RV_SKU_Accesorio4,RV_Precio_Accesorio4=:RV_Precio_Accesorio4,RV_SKU_Accesorio5=:RV_SKU_Accesorio5,RV_Precio_Accesorio5=:RV_Precio_Accesorio5,RV_Tipo_Pago=:RV_Tipo_Pago,RV_Promociones_Bancos=:RV_Promociones_Bancos,Supervisor_Vendedor=:Supervisor_Vendedor,Comentarios_Vendedor=:Comentarios_Vendedor,VBO_Estado_Venta_BO=:VBO_Estado_Venta_BO,VBO_Sub_Estado_Venta_BO=:VBO_Sub_Estado_Venta_BO,RBO_Cantidad_Ordenes_Ficha=:RBO_Cantidad_Ordenes_Ficha,RBO_Orden_One_Click1=:RBO_Orden_One_Click1,RBO_Orden_One_Click2=:RBO_Orden_One_Click2,RBO_Orden_One_Click3=:RBO_Orden_One_Click3,FBO_Ficha_Limpia=:FBO_Ficha_Limpia,FBO_Errores_Comunes_Ficha=:FBO_Errores_Comunes_Ficha,DGBO_Tipo_Atencion_Final=:DGBO_Tipo_Atencion_Final,DGBO_BO_Validador_Gestor=:DGBO_BO_Validador_Gestor,DGBO_BO_Recupero_Repro_Gestor=:DGBO_BO_Recupero_Repro_Gestor,Comentarios_BackOffice=:Comentarios_BackOffice,Modificado_por_BackOffice=:Modificado_por_BackOffice WHERE idFicha_Venta=:idFicha_Venta");

                $stmt->bindParam(':idFicha_Venta',$ficha_venta->__GET('idFicha_Venta'));
                $stmt->bindParam(':DE_Telf_Llamada_Venta',$ficha_venta->__GET('DE_Telf_Llamada_Venta'));
                $stmt->bindParam(':DE_Base_Llamada',$ficha_venta->__GET('DE_Base_Llamada'));
                $stmt->bindParam(':DE_Campana_Netcall',$ficha_venta->__GET('DE_Campana_Netcall'));
                $stmt->bindParam(':DE_Sub_Campana',$ficha_venta->__GET('DE_Sub_Campana'));
                $stmt->bindParam(':DE_Detalle_Sub_Campana',$ficha_venta->__GET('DE_Detalle_Sub_Campana'));
                $stmt->bindParam(':DE_CF_Max_Linea_Movil',$ficha_venta->__GET('DE_CF_Max_Linea_Movil'));
                $stmt->bindParam(':DE_Tipo_Etiqueta',$ficha_venta->__GET('DE_Tipo_Etiqueta'));
                $stmt->bindParam(':DE_CF_Max_Linea_Pack',$ficha_venta->__GET('DE_CF_Max_Linea_Pack'));
                $stmt->bindParam(':DE_Monto_Disp_Finan_Equipos',$ficha_venta->__GET('DE_Monto_Disp_Finan_Equipos'));
                $stmt->bindParam(':DE_Cant_Meses_Finan_Equipos',$ficha_venta->__GET('DE_Cant_Meses_Finan_Equipos'));
                $stmt->bindParam(':DE_Cliente_Entel',$ficha_venta->__GET('DE_Cliente_Entel'));
                $stmt->bindParam(':DE_Cliente_Promo_Dscto',$ficha_venta->__GET('DE_Cliente_Promo_Dscto'));
                $stmt->bindParam(':Cliente_id',$ficha_venta->__GET('Cliente_id'));
                $stmt->bindParam(':DF_Email_Facturacion_Otros',$ficha_venta->__GET('DF_Email_Facturacion_Otros'));
                $stmt->bindParam(':DF_Ubigeo_Facturacion',$ficha_venta->__GET('DF_Ubigeo_Facturacion'));
                $stmt->bindParam(':DF_Domicilio_Facturacion',$ficha_venta->__GET('DF_Domicilio_Facturacion'));
                $stmt->bindParam(':RE_Tipo_Despacho',$ficha_venta->__GET('RE_Tipo_Despacho'));
                $stmt->bindParam(':RE_Rango_Entrega_Despacho',$ficha_venta->__GET('RE_Rango_Entrega_Despacho'));
                $stmt->bindParam(':RE_Rango_Horario_Despacho',$ficha_venta->__GET('RE_Rango_Horario_Despacho'));
                $stmt->bindParam(':RE_Tienda_Retiro',$ficha_venta->__GET('RE_Tienda_Retiro'));
                $stmt->bindParam(':RE_Retail_Retiro',$ficha_venta->__GET('RE_Retail_Retiro'));
                $stmt->bindParam(':RE_Fecha_Entrega',$ficha_venta->__GET('RE_Fecha_Entrega'));
                $stmt->bindParam(':RE_Venta_Entrega_para',$ficha_venta->__GET('RE_Venta_Entrega_para'));
                $stmt->bindParam(':RE_Venta_Destino_para',$ficha_venta->__GET('RE_Venta_Destino_para'));
                $stmt->bindParam(':RE_Ubigeo_Entrega',$ficha_venta->__GET('RE_Ubigeo_Entrega'));
                $stmt->bindParam(':RE_Tipo_Direccion_Entrega',$ficha_venta->__GET('RE_Tipo_Direccion_Entrega'));
                $stmt->bindParam(':RE_Direccion_Entrega',$ficha_venta->__GET('RE_Direccion_Entrega'));
                $stmt->bindParam(':RE_Referencia_Principales',$ficha_venta->__GET('RE_Referencia_Principales'));
                $stmt->bindParam(':RE_Referencias_Adicionales',$ficha_venta->__GET('RE_Referencias_Adicionales'));
                $stmt->bindParam(':RE_Coordenadas_Direccion_Entrega',$ficha_venta->__GET('RE_Coordenadas_Direccion_Entrega'));
                $stmt->bindParam(':RE_Telefono_Contacto1',$ficha_venta->__GET('RE_Telefono_Contacto1'));
                $stmt->bindParam(':RE_Telefono_Contacto2',$ficha_venta->__GET('RE_Telefono_Contacto2'));
                $stmt->bindParam(':RE_Tipo_Contacto_Ol',$ficha_venta->__GET('RE_Tipo_Contacto_Ol'));
                $stmt->bindParam(':RV_Tipo_Ofrecimiento',$ficha_venta->__GET('RV_Tipo_Ofrecimiento'));
                $stmt->bindParam(':RV_Tipo_Venta',$ficha_venta->__GET('RV_Tipo_Venta'));
                $stmt->bindParam(':RV_Operador_Cedente',$ficha_venta->__GET('RV_Operador_Cedente'));
                $stmt->bindParam(':RV_Origen',$ficha_venta->__GET('RV_Origen'));
                $stmt->bindParam(':RV_Linea_Portar',$ficha_venta->__GET('RV_Linea_Portar'));
                $stmt->bindParam(':RV_Plan_Tarifario',$ficha_venta->__GET('RV_Plan_Tarifario'));
                $stmt->bindParam(':RV_Cargo_Fijo_Plan',$ficha_venta->__GET('RV_Cargo_Fijo_Plan'));
                $stmt->bindParam(':RV_Tipo_Producto',$ficha_venta->__GET('RV_Tipo_Producto'));
                $stmt->bindParam(':RV_Accesorio_Regalo',$ficha_venta->__GET('RV_Accesorio_Regalo'));
                $stmt->bindParam(':RV_SKU_Accesorio_Regalo1',$ficha_venta->__GET('RV_SKU_Accesorio_Regalo1'));
                $stmt->bindParam(':RV_SKU_Accesorio_Regalo2',$ficha_venta->__GET('RV_SKU_Accesorio_Regalo2'));
                $stmt->bindParam(':RV_SKU_Pack',$ficha_venta->__GET('RV_SKU_Pack'));
                $stmt->bindParam(':RV_Precio_Equipo_Inicial_Total',$ficha_venta->__GET('RV_Precio_Equipo_Inicial_Total'));
                $stmt->bindParam(':RV_Cuota_Equipo_Mensual',$ficha_venta->__GET('RV_Cuota_Equipo_Mensual'));
                $stmt->bindParam(':RV_Cant_Accesorios',$ficha_venta->__GET('RV_Cant_Accesorios'));
                $stmt->bindParam(':RV_SKU_Accesorio1',$ficha_venta->__GET('RV_SKU_Accesorio1'));
                $stmt->bindParam(':RV_Precio_Accesorio1',$ficha_venta->__GET('RV_Precio_Accesorio1'));
                $stmt->bindParam(':RV_SKU_Accesorio2',$ficha_venta->__GET('RV_SKU_Accesorio2'));
                $stmt->bindParam(':RV_Precio_Accesorio2',$ficha_venta->__GET('RV_Precio_Accesorio2'));
                $stmt->bindParam(':RV_SKU_Accesorio3',$ficha_venta->__GET('RV_SKU_Accesorio3'));
                $stmt->bindParam(':RV_Precio_Accesorio3',$ficha_venta->__GET('RV_Precio_Accesorio3'));
                $stmt->bindParam(':RV_SKU_Accesorio4',$ficha_venta->__GET('RV_SKU_Accesorio4'));
                $stmt->bindParam(':RV_Precio_Accesorio4',$ficha_venta->__GET('RV_Precio_Accesorio4'));
                $stmt->bindParam(':RV_SKU_Accesorio5',$ficha_venta->__GET('RV_SKU_Accesorio5'));
                $stmt->bindParam(':RV_Precio_Accesorio5',$ficha_venta->__GET('RV_Precio_Accesorio5'));
                $stmt->bindParam(':RV_Tipo_Pago',$ficha_venta->__GET('RV_Tipo_Pago'));
                $stmt->bindParam(':RV_Promociones_Bancos',$ficha_venta->__GET('RV_Promociones_Bancos'));
                $stmt->bindParam(':Supervisor_Vendedor',$ficha_venta->__GET('Supervisor_Vendedor'));
                $stmt->bindParam(':Comentarios_Vendedor',$ficha_venta->__GET('Comentarios_Vendedor'));
                $stmt->bindParam(':VBO_Estado_Venta_BO',$ficha_venta->__GET('VBO_Estado_Venta_BO'));
                $stmt->bindParam(':VBO_Sub_Estado_Venta_BO',$ficha_venta->__GET('VBO_Sub_Estado_Venta_BO'));
                $stmt->bindParam(':RBO_Cantidad_Ordenes_Ficha',$ficha_venta->__GET('RBO_Cantidad_Ordenes_Ficha'));
                $stmt->bindParam(':RBO_Orden_One_Click1',$ficha_venta->__GET('RBO_Orden_One_Click1'));
                $stmt->bindParam(':RBO_Orden_One_Click2',$ficha_venta->__GET('RBO_Orden_One_Click2'));
                $stmt->bindParam(':RBO_Orden_One_Click3',$ficha_venta->__GET('RBO_Orden_One_Click3'));
                $stmt->bindParam(':FBO_Ficha_Limpia',$ficha_venta->__GET('FBO_Ficha_Limpia'));
                $stmt->bindParam(':FBO_Errores_Comunes_Ficha',$ficha_venta->__GET('FBO_Errores_Comunes_Ficha'));
                $stmt->bindParam(':DGBO_Tipo_Atencion_Final',$ficha_venta->__GET('DGBO_Tipo_Atencion_Final'));
                $stmt->bindParam(':DGBO_BO_Validador_Gestor',$ficha_venta->__GET('DGBO_BO_Validador_Gestor'));
                $stmt->bindParam(':DGBO_BO_Recupero_Repro_Gestor',$ficha_venta->__GET('DGBO_BO_Recupero_Repro_Gestor'));
                $stmt->bindParam(':Comentarios_BackOffice',$ficha_venta->__GET('Comentarios_BackOffice'));
                $stmt->bindParam(':Modificado_por_BackOffice',$ficha_venta->__GET('Modificado_por_BackOffice'));

        if (!$stmt->execute()) {
            return 'error';
        //print_r($stmt->errorInfo());
        }else{
            $this->Registrar_RH($ficha_venta);
            return 'exito';
        }
    }

    public function Registrar_RH(Ficha_Venta $ficha_venta)
    {
        
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("INSERT INTO ficha_venta_rh (Ficha_Venta_id,DE_Telf_Llamada_Venta,DE_Base_Llamada,DE_Campana_Netcall,DE_Sub_Campana,DE_Detalle_Sub_Campana,DE_CF_Max_Linea_Movil,DE_Tipo_Etiqueta,DE_CF_Max_Linea_Pack,DE_Monto_Disp_Finan_Equipos,DE_Cant_Meses_Finan_Equipos,DE_Cliente_Entel,DE_Cliente_Promo_Dscto,Cliente_id,DF_Email_Facturacion_Otros,DF_Ubigeo_Facturacion,DF_Domicilio_Facturacion,RE_Tipo_Despacho,RE_Rango_Entrega_Despacho,RE_Rango_Horario_Despacho,RE_Tienda_Retiro,RE_Retail_Retiro,RE_Fecha_Entrega,RE_Venta_Entrega_para,RE_Venta_Destino_para,RE_Ubigeo_Entrega,RE_Tipo_Direccion_Entrega,RE_Direccion_Entrega,RE_Referencia_Principales,RE_Referencias_Adicionales,RE_Coordenadas_Direccion_Entrega,RE_Telefono_Contacto1,RE_Telefono_Contacto2,RE_Tipo_Contacto_Ol,RV_Tipo_Ofrecimiento,RV_Tipo_Venta,RV_Operador_Cedente,RV_Origen,RV_Linea_Portar,RV_Plan_Tarifario,RV_Cargo_Fijo_Plan,RV_Tipo_Producto,RV_Accesorio_Regalo,RV_SKU_Accesorio_Regalo1,RV_SKU_Accesorio_Regalo2,RV_SKU_Pack,RV_Precio_Equipo_Inicial_Total,RV_Cuota_Equipo_Mensual,RV_Cant_Accesorios,RV_SKU_Accesorio1,RV_Precio_Accesorio1,RV_SKU_Accesorio2,RV_Precio_Accesorio2,RV_SKU_Accesorio3,RV_Precio_Accesorio3,RV_SKU_Accesorio4,RV_Precio_Accesorio4,RV_SKU_Accesorio5,RV_Precio_Accesorio5,RV_Tipo_Pago,RV_Promociones_Bancos,Supervisor_Vendedor,Comentarios_Vendedor,VBO_Estado_Venta_BO,VBO_Sub_Estado_Venta_BO,RBO_Cantidad_Ordenes_Ficha,RBO_Orden_One_Click1,RBO_Orden_One_Click2,RBO_Orden_One_Click3,FBO_Ficha_Limpia,FBO_Errores_Comunes_Ficha,DGBO_Tipo_Atencion_Final,DGBO_BO_Validador_Gestor,DGBO_BO_Recupero_Repro_Gestor,Comentarios_BackOffice,Modificado_por_BackOffice) VALUES(:Ficha_Venta_id,:DE_Telf_Llamada_Venta,:DE_Base_Llamada,:DE_Campana_Netcall,:DE_Sub_Campana,:DE_Detalle_Sub_Campana,:DE_CF_Max_Linea_Movil,:DE_Tipo_Etiqueta,:DE_CF_Max_Linea_Pack,:DE_Monto_Disp_Finan_Equipos,:DE_Cant_Meses_Finan_Equipos,:DE_Cliente_Entel,:DE_Cliente_Promo_Dscto,:Cliente_id,:DF_Email_Facturacion_Otros,:DF_Ubigeo_Facturacion,:DF_Domicilio_Facturacion,:RE_Tipo_Despacho,:RE_Rango_Entrega_Despacho,:RE_Rango_Horario_Despacho,:RE_Tienda_Retiro,:RE_Retail_Retiro,:RE_Fecha_Entrega,:RE_Venta_Entrega_para,:RE_Venta_Destino_para,:RE_Ubigeo_Entrega,:RE_Tipo_Direccion_Entrega,:RE_Direccion_Entrega,:RE_Referencia_Principales,:RE_Referencias_Adicionales,:RE_Coordenadas_Direccion_Entrega,:RE_Telefono_Contacto1,:RE_Telefono_Contacto2,:RE_Tipo_Contacto_Ol,:RV_Tipo_Ofrecimiento,:RV_Tipo_Venta,:RV_Operador_Cedente,:RV_Origen,:RV_Linea_Portar,:RV_Plan_Tarifario,:RV_Cargo_Fijo_Plan,:RV_Tipo_Producto,:RV_Accesorio_Regalo,:RV_SKU_Accesorio_Regalo1,:RV_SKU_Accesorio_Regalo2,:RV_SKU_Pack,:RV_Precio_Equipo_Inicial_Total,:RV_Cuota_Equipo_Mensual,:RV_Cant_Accesorios,:RV_SKU_Accesorio1,:RV_Precio_Accesorio1,:RV_SKU_Accesorio2,:RV_Precio_Accesorio2,:RV_SKU_Accesorio3,:RV_Precio_Accesorio3,:RV_SKU_Accesorio4,:RV_Precio_Accesorio4,:RV_SKU_Accesorio5,:RV_Precio_Accesorio5,:RV_Tipo_Pago,:RV_Promociones_Bancos,:Supervisor_Vendedor,:Comentarios_Vendedor,:VBO_Estado_Venta_BO,:VBO_Sub_Estado_Venta_BO,:RBO_Cantidad_Ordenes_Ficha,:RBO_Orden_One_Click1,:RBO_Orden_One_Click2,:RBO_Orden_One_Click3,:FBO_Ficha_Limpia,:FBO_Errores_Comunes_Ficha,:DGBO_Tipo_Atencion_Final,:DGBO_BO_Validador_Gestor,:DGBO_BO_Recupero_Repro_Gestor,:Comentarios_BackOffice,:Modificado_por_BackOffice)");

                $stmt->bindParam(':Ficha_Venta_id',$ficha_venta->__GET('idFicha_Venta'));
                $stmt->bindParam(':DE_Telf_Llamada_Venta',$ficha_venta->__GET('DE_Telf_Llamada_Venta'));
                $stmt->bindParam(':DE_Base_Llamada',$ficha_venta->__GET('DE_Base_Llamada'));
                $stmt->bindParam(':DE_Campana_Netcall',$ficha_venta->__GET('DE_Campana_Netcall'));
                $stmt->bindParam(':DE_Sub_Campana',$ficha_venta->__GET('DE_Sub_Campana'));
                $stmt->bindParam(':DE_Detalle_Sub_Campana',$ficha_venta->__GET('DE_Detalle_Sub_Campana'));
                $stmt->bindParam(':DE_CF_Max_Linea_Movil',$ficha_venta->__GET('DE_CF_Max_Linea_Movil'));
                $stmt->bindParam(':DE_Tipo_Etiqueta',$ficha_venta->__GET('DE_Tipo_Etiqueta'));
                $stmt->bindParam(':DE_CF_Max_Linea_Pack',$ficha_venta->__GET('DE_CF_Max_Linea_Pack'));
                $stmt->bindParam(':DE_Monto_Disp_Finan_Equipos',$ficha_venta->__GET('DE_Monto_Disp_Finan_Equipos'));
                $stmt->bindParam(':DE_Cant_Meses_Finan_Equipos',$ficha_venta->__GET('DE_Cant_Meses_Finan_Equipos'));
                $stmt->bindParam(':DE_Cliente_Entel',$ficha_venta->__GET('DE_Cliente_Entel'));
                $stmt->bindParam(':DE_Cliente_Promo_Dscto',$ficha_venta->__GET('DE_Cliente_Promo_Dscto'));
                $stmt->bindParam(':Cliente_id',$ficha_venta->__GET('Cliente_id'));
                $stmt->bindParam(':DF_Email_Facturacion_Otros',$ficha_venta->__GET('DF_Email_Facturacion_Otros'));
                $stmt->bindParam(':DF_Ubigeo_Facturacion',$ficha_venta->__GET('DF_Ubigeo_Facturacion'));
                $stmt->bindParam(':DF_Domicilio_Facturacion',$ficha_venta->__GET('DF_Domicilio_Facturacion'));
                $stmt->bindParam(':RE_Tipo_Despacho',$ficha_venta->__GET('RE_Tipo_Despacho'));
                $stmt->bindParam(':RE_Rango_Entrega_Despacho',$ficha_venta->__GET('RE_Rango_Entrega_Despacho'));
                $stmt->bindParam(':RE_Rango_Horario_Despacho',$ficha_venta->__GET('RE_Rango_Horario_Despacho'));
                $stmt->bindParam(':RE_Tienda_Retiro',$ficha_venta->__GET('RE_Tienda_Retiro'));
                $stmt->bindParam(':RE_Retail_Retiro',$ficha_venta->__GET('RE_Retail_Retiro'));
                $stmt->bindParam(':RE_Fecha_Entrega',$ficha_venta->__GET('RE_Fecha_Entrega'));
                $stmt->bindParam(':RE_Venta_Entrega_para',$ficha_venta->__GET('RE_Venta_Entrega_para'));
                $stmt->bindParam(':RE_Venta_Destino_para',$ficha_venta->__GET('RE_Venta_Destino_para'));
                $stmt->bindParam(':RE_Ubigeo_Entrega',$ficha_venta->__GET('RE_Ubigeo_Entrega'));
                $stmt->bindParam(':RE_Tipo_Direccion_Entrega',$ficha_venta->__GET('RE_Tipo_Direccion_Entrega'));
                $stmt->bindParam(':RE_Direccion_Entrega',$ficha_venta->__GET('RE_Direccion_Entrega'));
                $stmt->bindParam(':RE_Referencia_Principales',$ficha_venta->__GET('RE_Referencia_Principales'));
                $stmt->bindParam(':RE_Referencias_Adicionales',$ficha_venta->__GET('RE_Referencias_Adicionales'));
                $stmt->bindParam(':RE_Coordenadas_Direccion_Entrega',$ficha_venta->__GET('RE_Coordenadas_Direccion_Entrega'));
                $stmt->bindParam(':RE_Telefono_Contacto1',$ficha_venta->__GET('RE_Telefono_Contacto1'));
                $stmt->bindParam(':RE_Telefono_Contacto2',$ficha_venta->__GET('RE_Telefono_Contacto2'));
                $stmt->bindParam(':RE_Tipo_Contacto_Ol',$ficha_venta->__GET('RE_Tipo_Contacto_Ol'));
                $stmt->bindParam(':RV_Tipo_Ofrecimiento',$ficha_venta->__GET('RV_Tipo_Ofrecimiento'));
                $stmt->bindParam(':RV_Tipo_Venta',$ficha_venta->__GET('RV_Tipo_Venta'));
                $stmt->bindParam(':RV_Operador_Cedente',$ficha_venta->__GET('RV_Operador_Cedente'));
                $stmt->bindParam(':RV_Origen',$ficha_venta->__GET('RV_Origen'));
                $stmt->bindParam(':RV_Linea_Portar',$ficha_venta->__GET('RV_Linea_Portar'));
                $stmt->bindParam(':RV_Plan_Tarifario',$ficha_venta->__GET('RV_Plan_Tarifario'));
                $stmt->bindParam(':RV_Cargo_Fijo_Plan',$ficha_venta->__GET('RV_Cargo_Fijo_Plan'));
                $stmt->bindParam(':RV_Tipo_Producto',$ficha_venta->__GET('RV_Tipo_Producto'));
                $stmt->bindParam(':RV_Accesorio_Regalo',$ficha_venta->__GET('RV_Accesorio_Regalo'));
                $stmt->bindParam(':RV_SKU_Accesorio_Regalo1',$ficha_venta->__GET('RV_SKU_Accesorio_Regalo1'));
                $stmt->bindParam(':RV_SKU_Accesorio_Regalo2',$ficha_venta->__GET('RV_SKU_Accesorio_Regalo2'));
                $stmt->bindParam(':RV_SKU_Pack',$ficha_venta->__GET('RV_SKU_Pack'));
                $stmt->bindParam(':RV_Precio_Equipo_Inicial_Total',$ficha_venta->__GET('RV_Precio_Equipo_Inicial_Total'));
                $stmt->bindParam(':RV_Cuota_Equipo_Mensual',$ficha_venta->__GET('RV_Cuota_Equipo_Mensual'));
                $stmt->bindParam(':RV_Cant_Accesorios',$ficha_venta->__GET('RV_Cant_Accesorios'));
                $stmt->bindParam(':RV_SKU_Accesorio1',$ficha_venta->__GET('RV_SKU_Accesorio1'));
                $stmt->bindParam(':RV_Precio_Accesorio1',$ficha_venta->__GET('RV_Precio_Accesorio1'));
                $stmt->bindParam(':RV_SKU_Accesorio2',$ficha_venta->__GET('RV_SKU_Accesorio2'));
                $stmt->bindParam(':RV_Precio_Accesorio2',$ficha_venta->__GET('RV_Precio_Accesorio2'));
                $stmt->bindParam(':RV_SKU_Accesorio3',$ficha_venta->__GET('RV_SKU_Accesorio3'));
                $stmt->bindParam(':RV_Precio_Accesorio3',$ficha_venta->__GET('RV_Precio_Accesorio3'));
                $stmt->bindParam(':RV_SKU_Accesorio4',$ficha_venta->__GET('RV_SKU_Accesorio4'));
                $stmt->bindParam(':RV_Precio_Accesorio4',$ficha_venta->__GET('RV_Precio_Accesorio4'));
                $stmt->bindParam(':RV_SKU_Accesorio5',$ficha_venta->__GET('RV_SKU_Accesorio5'));
                $stmt->bindParam(':RV_Precio_Accesorio5',$ficha_venta->__GET('RV_Precio_Accesorio5'));
                $stmt->bindParam(':RV_Tipo_Pago',$ficha_venta->__GET('RV_Tipo_Pago'));
                $stmt->bindParam(':RV_Promociones_Bancos',$ficha_venta->__GET('RV_Promociones_Bancos'));
                $stmt->bindParam(':Supervisor_Vendedor',$ficha_venta->__GET('Supervisor_Vendedor'));
                $stmt->bindParam(':Comentarios_Vendedor',$ficha_venta->__GET('Comentarios_Vendedor'));
                $stmt->bindParam(':VBO_Estado_Venta_BO',$ficha_venta->__GET('VBO_Estado_Venta_BO'));
                $stmt->bindParam(':VBO_Sub_Estado_Venta_BO',$ficha_venta->__GET('VBO_Sub_Estado_Venta_BO'));
                $stmt->bindParam(':RBO_Cantidad_Ordenes_Ficha',$ficha_venta->__GET('RBO_Cantidad_Ordenes_Ficha'));
                $stmt->bindParam(':RBO_Orden_One_Click1',$ficha_venta->__GET('RBO_Orden_One_Click1'));
                $stmt->bindParam(':RBO_Orden_One_Click2',$ficha_venta->__GET('RBO_Orden_One_Click2'));
                $stmt->bindParam(':RBO_Orden_One_Click3',$ficha_venta->__GET('RBO_Orden_One_Click3'));
                $stmt->bindParam(':FBO_Ficha_Limpia',$ficha_venta->__GET('FBO_Ficha_Limpia'));
                $stmt->bindParam(':FBO_Errores_Comunes_Ficha',$ficha_venta->__GET('FBO_Errores_Comunes_Ficha'));
                $stmt->bindParam(':DGBO_Tipo_Atencion_Final',$ficha_venta->__GET('DGBO_Tipo_Atencion_Final'));
                $stmt->bindParam(':DGBO_BO_Validador_Gestor',$ficha_venta->__GET('DGBO_BO_Validador_Gestor'));
                $stmt->bindParam(':DGBO_BO_Recupero_Repro_Gestor',$ficha_venta->__GET('DGBO_BO_Recupero_Repro_Gestor'));
                $stmt->bindParam(':Comentarios_BackOffice',$ficha_venta->__GET('Comentarios_BackOffice'));
                $stmt->bindParam(':Modificado_por_BackOffice',$ficha_venta->__GET('Modificado_por_BackOffice'));

                $stmt->execute();
                print_r($stmt->errorInfo());
    }


    public function ListarSubCategorias($Categoria_id)
    {
        $this->pdo = new Conexion();
        $stmt = $this->pdo->prepare("SELECT * FROM subcategoria WHERE Categoria_id=:Categoria_id AND eliminado=0 and Estado=1 ORDER BY Orden " );
        $stmt->bindParam(':Categoria_id', $Categoria_id, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ListarSubCategoriasxIds($idSubCategoria)
    {
        $this->pdo = new Conexion();
        $stmt = $this->pdo->prepare("SELECT * FROM subcategoria WHERE idSubCategoria in($idSubCategoria) ORDER BY Orden " );
        #$stmt->bindParam(':idSubcategorias', $idSubCategoria, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }    



    public function ListarSupervisoresVenta()
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT idPersona,CONCAT(persona.Primer_Nombre,' ',persona.Segundo_Nombre,' ',persona.Apellido_Paterno,' ',persona.Apellido_Materno) as NombreSupervisor FROM persona where Cargo_id_SubCategoria=379 and Estado=1 and Eliminado=0" );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ListarDepartamentos()
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT * FROM ubigeo where Tipo_Ubigeo='DPTO'" );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ListarProvincias($Cod_Dpto)
    {
        $this->pdo = new Conexion();
        $stmt = $this->pdo->prepare("SELECT * FROM ubigeo WHERE Tipo_Ubigeo='PROV' and Cod_Dpto=:Cod_Dpto " );
        $stmt->bindParam(':Cod_Dpto', $Cod_Dpto, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ListarDistritos($Cod_Dpto,$Cod_Prov)
    {
        $this->pdo = new Conexion();
        $stmt = $this->pdo->prepare("SELECT * FROM ubigeo where Tipo_Ubigeo='DIST' and Cod_Dpto=:Cod_Dpto and Cod_Prov=:Cod_Prov " );
        $stmt->bindParam(':Cod_Dpto', $Cod_Dpto, PDO::PARAM_STR);
        $stmt->bindParam(':Cod_Prov', $Cod_Prov, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
 
}