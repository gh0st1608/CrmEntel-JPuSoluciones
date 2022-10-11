<?php

class Ficha_Venta
{


private $idFicha_Venta;
private $DE_Telf_Llamada_Venta;
private $DE_Base_Llamada;
private $DE_Campana_Netcall;
private $DE_Sub_Campana;
private $DE_Detalle_Sub_Campana;
private $DE_CF_Max_Linea_Movil;
private $DE_Tipo_Etiqueta;
private $DE_CF_Max_Linea_Pack;
private $DE_Monto_Disp_Finan_Equipos;
private $DE_Cant_Meses_Finan_Equipos;
private $DE_Cliente_Entel;
private $DE_Cliente_Promo_Dscto;
private $Cliente_id;
private $DF_Email_Facturacion_Otros;
private $DF_Ubigeo_Facturacion;
private $DF_Domicilio_Facturacion;
private $RE_Tipo_Despacho;
private $RE_Rango_Entrega_Despacho;
private $RE_Rango_Horario_Despacho;
private $RE_Tienda_Retiro;
private $RE_Retail_Retiro;
private $RE_Fecha_Entrega;
private $RE_Venta_Entrega_para;
private $RE_Venta_Destino_para;
private $RE_Ubigeo_Entrega;
private $RE_Tipo_Direccion_Entrega;
private $RE_Direccion_Entrega;
private $RE_Referencia_Principales;
private $RE_Referencias_Adicionales;
private $RE_Coordenadas_Direccion_Entrega;
private $RE_Telefono_Contacto1;
private $RE_Telefono_Contacto2;
private $RE_Tipo_Contacto_Ol;
private $RV_Tipo_Ofrecimiento;
private $RV_Tipo_Venta;
private $RV_Operador_Cedente;
private $RV_Origen;
private $RV_Linea_Portar;
private $RV_Plan_Tarifario;
private $RV_Cargo_Fijo_Plan;
private $RV_Tipo_Producto;
private $RV_Accesorio_Regalo;
private $RV_SKU_Accesorio_Regalo1;
private $RV_SKU_Accesorio_Regalo2;
private $RV_SKU_Pack;
private $RV_Precio_Equipo_Inicial_Total;
private $RV_Cuota_Equipo_Mensual;
private $RV_Cant_Accesorios;
private $RV_SKU_Accesorio1;
private $RV_Precio_Accesorio1;
private $RV_SKU_Accesorio2;
private $RV_Precio_Accesorio2;
private $RV_SKU_Accesorio3;
private $RV_Precio_Accesorio3;
private $RV_SKU_Accesorio4;
private $RV_Precio_Accesorio4;
private $RV_SKU_Accesorio5;
private $RV_Precio_Accesorio5;
private $RV_Tipo_Pago;
private $RV_Promociones_Bancos;
private $Supervisor_Vendedor;
private $Comentarios_Vendedor;
private $Ingresado_por_Vendedor;
private $Fecha_Registro_Vendedor;
private $VBO_Estado_Venta_BO=0;
private $VBO_Sub_Estado_Venta_BO=0;
private $RBO_Cantidad_Ordenes_Ficha=0;
private $RBO_Orden_One_Click1;
private $RBO_Orden_One_Click2;
private $RBO_Orden_One_Click3;
private $FBO_Ficha_Limpia=0;
private $FBO_Errores_Comunes_Ficha=0;
private $DGBO_Tipo_Atencion_Final=0;
private $DGBO_BO_Validador_Gestor=0;
private $DGBO_BO_Recupero_Repro_Gestor=0;
private $Comentarios_BackOffice;
private $Modificado_por_BackOffice=0;
private $Fecha_Modificacion_BackOffice;
private $Eliminado;

    public function __GET($atributo){ 

      return $this->$atributo; 
      
    }

    public function __SET($atributo, $variable){

      return $this->$atributo = $variable; 

    }


   

}
