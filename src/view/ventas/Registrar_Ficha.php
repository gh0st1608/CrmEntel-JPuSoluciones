
<?php 

 
 
 	

		if(isset($_REQUEST['Busc_Fecha_Inicio'])){$Busc_Fecha_Inicio=$_REQUEST['Busc_Fecha_Inicio'];}else{$Busc_Fecha_Inicio="";} 
		if(isset($_REQUEST['Busc_Fecha_Fin'])){$Busc_Fecha_Fin=$_REQUEST['Busc_Fecha_Fin'];}else{$Busc_Fecha_Fin="";}
		if(isset($_REQUEST['DP_Documento'])){$DP_Documento=$_REQUEST['DP_Documento'];}else{$DP_Documento="";}
		if(isset($_REQUEST['RE_Tipo_Despacho'])){$RE_Tipo_Despacho=$_REQUEST['RE_Tipo_Despacho'];}else{$RE_Tipo_Despacho=0;}
		if(isset($_REQUEST['RE_Rango_Entrega_Despacho'])){$RE_Rango_Entrega_Despacho=$_REQUEST['RE_Rango_Entrega_Despacho'];}else{$RE_Rango_Entrega_Despacho=0;}
		if(isset($_REQUEST['RV_Tipo_Ofrecimiento'])){$RV_Tipo_Ofrecimiento=$_REQUEST['RV_Tipo_Ofrecimiento'];}else{$RV_Tipo_Ofrecimiento=0;}
		if(isset($_REQUEST['RV_Tipo_Venta'])){$RV_Tipo_Venta=$_REQUEST['RV_Tipo_Venta'];}else{$RV_Tipo_Venta=0;}
		if(isset($_REQUEST['RV_Linea_Portar'])){$RV_Linea_Portar=$_REQUEST['RV_Linea_Portar'];}else{$RV_Linea_Portar="";}
		if(isset($_REQUEST['RV_Tipo_Producto'])){$RV_Tipo_Producto=$_REQUEST['RV_Tipo_Producto'];}else{$RV_Tipo_Producto=0;}
		if(isset($_REQUEST['VBO_Estado_Venta_BO'])){$VBO_Estado_Venta_BO=$_REQUEST['VBO_Estado_Venta_BO'];}else{$VBO_Estado_Venta_BO=0;}
		if(isset($_REQUEST['Supervisor_Vendedor'])){$Supervisor_Vendedor=$_REQUEST['Supervisor_Vendedor'];}else{$Supervisor_Vendedor=0;}
		if(isset($_REQUEST['Documento_Vendedor'])){$Documento_Vendedor=$_REQUEST['Documento_Vendedor'];}else{$Documento_Vendedor="";}

		$urlRetorno="index.php?c=Ficha_Venta&Busc_Fecha_Inicio=$Busc_Fecha_Inicio&Busc_Fecha_Fin=$Busc_Fecha_Fin&DP_Documento=$DP_Documento&RE_Tipo_Despacho=$RE_Tipo_Despacho&RE_Rango_Entrega_Despacho=$RE_Rango_Entrega_Despacho&RV_Tipo_Ofrecimiento=$RV_Tipo_Ofrecimiento&RV_Tipo_Venta=$RV_Tipo_Venta&RV_Linea_Portar=$RV_Linea_Portar&RV_Tipo_Producto=$RV_Tipo_Producto&VBO_Estado_Venta_BO=$VBO_Estado_Venta_BO&Supervisor_Vendedor=$Supervisor_Vendedor&Documento_Vendedor=$Documento_Vendedor";

		

        

?>
 <!-- Content Header (Page header) -->
<section class="content-header">  
	<h1>
		Ficha Venta <small>Registrar </small>
	</h1>
	<ol class="breadcrumb">
	    <li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Registrar Ficha Venta</li>
	</ol>
</section>
<section class="content">
	<div class="row">

		<div class="col-md-12">
			<style>
				  .loader-page {
    position: fixed;
    z-index: 25000;
    background: rgb(0, 0, 0,0.5);
    left: 0px;
    top: 0px;
    height: 100%;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition:all .3s ease;
  }
  .loader-page::before {
    content: "";
    position: absolute;
    border: 2px solid rgb(255, 255, 255);
    width: 60px;
    height: 60px;
    border-radius: 50%;
    box-sizing: border-box;
    border-left: 2px solid rgba(255, 255, 255,0);
    border-top: 2px solid rgba(255, 255, 255,0);
    animation: rotarload 1s linear infinite;
    transform: rotate(0deg);
  }
  @keyframes rotarload {
      0%   {transform: rotate(0deg)}
      100% {transform: rotate(360deg)}
  }
  .loader-page::after {
    content: "";
    position: absolute;
    border: 2px solid rgba(255, 255, 255,.5);
    width: 60px;
    height: 60px;
    border-radius: 50%;
    box-sizing: border-box;
    border-left: 2px solid rgba(255, 255, 255, 0);
    border-top: 2px solid rgba(255, 255, 255, 0);
    animation: rotarload 1s ease-out infinite;
    transform: rotate(0deg);
  }

  #loader-text{
  	    margin-top: 100px;
    	font-size: 25px;
    	color: white;
  }
			</style>
			<div class="loader-page"><span id="loader-text">Cargando Información</span></div>
			<?php if (isset($_REQUEST['idFicha_Venta']) && $_REQUEST['idFicha_Venta']!=''){
				$idFicha_Venta=$_REQUEST['idFicha_Venta'];
				$urlRetornoAct="index.php?c=Ficha_Venta&a=v_Actualizar_Ficha&idFicha_Venta=$idFicha_Venta&Busc_Fecha_Inicio=$Busc_Fecha_Inicio&Busc_Fecha_Fin=$Busc_Fecha_Fin&DP_Documento=$DP_Documento&RE_Tipo_Despacho=$RE_Tipo_Despacho&RE_Rango_Entrega_Despacho=$RE_Rango_Entrega_Despacho&RV_Tipo_Ofrecimiento=$RV_Tipo_Ofrecimiento&RV_Tipo_Venta=$RV_Tipo_Venta&RV_Linea_Portar=$RV_Linea_Portar&RV_Tipo_Producto=$RV_Tipo_Producto&VBO_Estado_Venta_BO=$VBO_Estado_Venta_BO&Supervisor_Vendedor=$Supervisor_Vendedor&Documento_Vendedor=$Documento_Vendedor";
			}else{
				$idFicha_Venta=0;
				$urlRetornoAct="index.php?c=Ficha_Venta";
			}
			?>
	

			<div class="panel panel-danger_dark <?php if ($idFicha_Venta==0): ?>hide<?php endif ?>" id="DatosFicha">
				<div class="panel-heading"> 
					<h3 class='panel-title'>0.- Datos Ficha</h3>
				</div>
				<div class="panel-body">
                    <div class="form-group  col-md-2" id="div-idFicha_Venta">
                    	<label class="" for="idFicha_Venta">Cod Ficha</label>
                        <input type="text" class="form-control input-sm" id="idFicha_Venta" name="idFicha_Venta" readonly="TRUE"  value="<?php echo $idFicha_Venta; ?>" DGBO_BO_Validador_Gestor="" DGBO_BO_Recupero_Repro_Gestor="" tipo_actualizacion="">
                    </div>
                    <div class="form-group  col-md-2" id="div-Fecha_Registro_Vendedor">
                    	<label class="" for="Fecha_Registro_Vendedor">Fecha Registro</label>
                        <input type="text" class="form-control input-sm" id="Fecha_Registro_Vendedor" name="Fecha_Registro_Vendedor" readonly="TRUE" value="">
                    </div>
                    <div class="form-group  col-md-4" id="div-Ingresado_por_Vendedor">
                    	<label class="" for="Ingresado_por_Vendedor">Registrado Por</label>
                        <input type="text" class="form-control input-sm " id="Ingresado_por_Vendedor" name="Ingresado_por_Vendedor" idVendedor="" readonly="TRUE" value="">
                    </div>
				</div>
			</div>
			<div class="panel panel-danger_dark">
				<div class="panel-heading"> 
					<h3 class='panel-title'>1.- Datos Entel</h3>
				</div>
				<div class="panel-body">	    			
					<div class="form-group col-md-2" id="div-DE_Telf_Llamada_Venta">
						<label class="" for="DE_Telf_Llamada_Venta">Telefono Llamada Venta : </label>
						<input type="text" class="form-control input-sm validar_txt" id="DE_Telf_Llamada_Venta" name="DE_Telf_Llamada_Venta"  onkeyup="var pattern = /[^0-9]/g;this.value = this.value.replace(pattern, '');" maxlength="9" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" obligatorio="SI" value="" <?php echo  $FVenta_Interfaz; ?>>
					</div>
					<div class="form-group  col-md-2" id="div-DE_Base_Llamada">   
                        <label class="" for="DE_Base_Llamada">Base Llamada</label>
                        <select class="form-control input-sm validar_cbo" id="DE_Base_Llamada" name="DE_Base_Llamada" idcategoria="1" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
                        	<option value="0">-- Seleccionar --</option>                     
                        </select>
                    </div>
                    <div class="form-group col-md-2" id="div-DE_Campana_Netcall">  
                        <label class="" for="DE_Campana_Netcall">Campaña NetCall</label>
                        <select class="form-control input-sm validar_cbo" id="DE_Campana_Netcall" name="DE_Campana_Netcall" idcategoria="2" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
                        	<option value="0">-- Seleccionar --</option>                     
                        </select>
                    </div>
                    <div class="form-group col-md-2" id="div-DE_Sub_Campana">  
                        <label class="" for="DE_Sub_Campana">Sub Campaña</label>
                        <select class="form-control input-sm validar_cbo" id="DE_Sub_Campana" name="DE_Sub_Campana" idcategoria="3" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
                        	<option value="0">-- Seleccionar --</option>                     
                        </select>
                    </div>
                    <div class="form-group col-md-2 hide" id="div-DE_Detalle_Sub_Campana">  
                        <label class="" for="DE_Detalle_Sub_Campana">Detalle Sub Campaña</label>
                        <select class="form-control input-sm validar_cbo" id="DE_Detalle_Sub_Campana" name="DE_Detalle_Sub_Campana" idcategoria="4" obligatorio="NO" <?php echo  $FVenta_Interfaz; ?>>
                        	<option value="0">-- Seleccionar --</option>                     
                        </select>
                    </div>
                    <div class="form-group col-md-2" id="div-DE_CF_Max_Linea_Movil">  
                        <label class="" for="DE_CF_Max_Linea_Movil">CF Max Linea(Móvil)</label>
                        <select class="form-control input-sm validar_cbo" id="DE_CF_Max_Linea_Movil" name="DE_CF_Max_Linea_Movil" idcategoria="5" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
                        	<option value="0">-- Seleccionar --</option>                     
                        </select>
                    </div>
                    <div class="form-group col-md-2" id="div-DE_Tipo_Etiqueta">  
                        <label class="" for="DE_Tipo_Etiqueta">Tipo Etiqueta</label>
                        <select class="form-control input-sm validar_cbo" id="DE_Tipo_Etiqueta" name="DE_Tipo_Etiqueta" idcategoria="6" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
                        	<option value="0">-- Seleccionar --</option>                     
                        </select>
                    </div>
                    <div class="form-group col-md-2" id="div-DE_CF_Max_Linea_Pack">
						<label class="" for="DE_CF_Max_Linea_Pack">CF Max Linea/Pack</label>
						<input type="text" class="form-control input-sm validar_txt" id="DE_CF_Max_Linea_Pack" name="DE_CF_Max_Linea_Pack"  value="" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
					</div>
                    <div class="form-group col-md-2" id="div-DE_Monto_Disp_Finan_Equipos">
						<label class="" for="DE_Monto_Disp_Finan_Equipos">Monto Disponible para Financiar</label>
						<input type="text" class="form-control input-sm validar_txt" id="DE_Monto_Disp_Finan_Equipos" name="DE_Monto_Disp_Finan_Equipos"  onkeyup="var pattern = /[^0-9\.]/g;this.value = this.value.replace(pattern, '');" value="" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
					</div>
                    <div class="form-group col-md-3" id="div-DE_Cant_Meses_Finan_Equipos">  
                        <label class="" for="DE_Cant_Meses_Finan_Equipos">Cant. Meses para Financiar Equipos</label>
                        <select class="form-control input-sm validar_cbo" id="DE_Cant_Meses_Finan_Equipos" name="DE_Cant_Meses_Finan_Equipos" idcategoria="7" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
                        	<option value="0">-- Seleccionar --</option>                     
                        </select>
                    </div>
                    <div class="form-group col-md-1" id="div-DE_Cliente_Entel">  
                        <label class="" for="DE_Cliente_Entel">Cliente Entel</label>
                        <select class="form-control input-sm validar_cbo" id="DE_Cliente_Entel" name="DE_Cliente_Entel" idcategoria="8" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
                        	<option value="0">-- Seleccionar --</option>                     
                        </select>
                    </div>
                    <div class="form-group col-md-2" id="div-DE_Cliente_Promo_Dscto">  
                        <label class="" for="DE_Cliente_Promo_Dscto">Cliente Promo/Dscto</label>
                        <select class="form-control input-sm validar_cbo" id="DE_Cliente_Promo_Dscto" name="DE_Cliente_Promo_Dscto" idcategoria="9" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
                        	<option value="0">-- Seleccionar --</option>                     
                        </select>
                    </div>
				</div>
			</div>
			<div class="panel panel-danger_dark">
				<div class="panel-heading"> 
					<h3 class='panel-title'>2.- Datos Personales</h3>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="form-group col-md-2" id="div-DP_TipoDocumento">  
	                        <label class="" for="DP_TipoDocumento">Tipo Documento</label>
	                        <select class="form-control input-sm validar_cbo" id="DP_TipoDocumento" name="DP_TipoDocumento" idcategoria="10" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
	                        	<option value="0">-- Seleccionar --</option>                     
	                        </select>
	                    </div>
						<div class="form-group col-md-2" id="div-DP_Documento">
							<label class="" for="DP_Documento">Nro. Documento <span id="span_cliente_nuevo" class="text-red hide">Cliente Nuevo</span></label>
							<div class="input-group">
							<input type="text" class="form-control validar_txt" id="DP_Documento" name="DP_Documento"  value="" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
					      	<span class="input-group-btn">
					        	<button class="btn btn-default" type="button" id="btnBuscarDocumento">Buscar <i class="fa fa-search fa-lg" aria-hidden="true" <?php echo  $FVenta_Interfaz; ?>></i></button>
					      	</span>
					      	 </div><!-- /input-group -->
					  	</div>    			
						<div class="form-group col-md-2" id="div-DP_Nombre_Cliente">
							<label class="" for="DP_Nombre_Cliente">Nombre Cliente</label>
							<input type="text" class="form-control input-sm validar_txt" id="DP_Nombre_Cliente" name="DP_Nombre_Cliente"  value="" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
						</div>	    			
						<div class="form-group col-md-2" id="div-DP_Apellido_Paterno">
							<label class="" for="DP_Apellido_Paterno">Apellido Paterno</label>
							<input type="text" class="form-control input-sm validar_txt" id="DP_Apellido_Paterno" name="DP_Apellido_Paterno"  value="" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
						</div>	    			
						<div class="form-group col-md-2" id="div-DP_Apellido_Materno">
							<label class="" for="DP_Apellido_Materno ">Apellido Materno</label>
							<input type="text" class="form-control input-sm validar_txt" id="DP_Apellido_Materno" name="DP_Apellido_Materno"  value="" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
						</div>
					</div>    			
					<div class="form-group col-md-2" id="div-DP_Nacionalidad">
						<label class="" for="DP_Nacionalidad">Nacionalidad</label>
						<input type="text" class="form-control input-sm validar_txt" id="DP_Nacionalidad" name="DP_Nacionalidad"  value="" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
					</div>	    			
					<div class="form-group col-md-2" id="div-DP_Lugar_Nacimiento">
						<label class="" for="DP_Lugar_Nacimiento">Lugar Nacimiento</label>
						<input type="text" class="form-control input-sm validar_txt" id="DP_Lugar_Nacimiento" name="DP_Lugar_Nacimiento"  value="" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
					</div>	    			
					<div class="form-group col-md-2" id="div-DP_Fecha_Nacimiento">
						<label class="" for="DP_Fecha_Nacimiento">Fecha Nacimiento</label>
						<input type="date" class="form-control input-sm validar_txt" id="DP_Fecha_Nacimiento" name="DP_Fecha_Nacimiento"  value="" oninput="elog('input',this);return false;" onchange="elog('change',this);return false;"onblur="elog('blur',this);return false;"onfocus="elog('focus',this);return false;"onkeyup="elog('keyup-'+event.keyCode,this);return false;"onkeypress="elog('keypress-'+event.keyCode,this);if(event.keyCode==13){this.onchange();return false;}" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
					</div>	    			
					<div class="form-group col-md-2" id="div-DP_Edad_Actual">
						<label class="" for="DP_Edad_Actual">Edad Actual</label>
						<input type="text" class="form-control input-sm" id="DP_Edad_Actual" name="DP_Edad_Actual" readonly="True" value="" <?php echo  $FVenta_Interfaz; ?>>
					</div>	    			
					<div class="form-group col-md-2" id="div-DP_Nombre_Padre">
						<label class="" for="DP_Nombre_Padre">Nombre Padre</label>
						<input type="text" class="form-control input-sm validar_txt" id="DP_Nombre_Padre" name="DP_Nombre_Padre"  value="" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
					</div>	    			
					<div class="form-group col-md-2" id="div-DP_Nombre_Madre">
						<label class="" for="DP_Nombre_Madre">Nombre Madre</label>
						<input type="text" class="form-control input-sm validar_txt" id="DP_Nombre_Madre" name="DP_Nombre_Madre"  value="" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
					</div>
				</div>
			</div>
			<div class="panel panel-danger_dark">
				<div class="panel-heading"> 
					<h3 class='panel-title'>3.- Registro de Venta</h3>
				</div>
				<div class="panel-body">
                    <div class="form-group col-md-2" id="div-RV_Tipo_Ofrecimiento">  
                        <label class="" for="RV_Tipo_Ofrecimiento">Tipo Ofrecimiento</label>
                        <select class="form-control input-sm filter_logica validar_cbo" id="RV_Tipo_Ofrecimiento" name="RV_Tipo_Ofrecimiento" idcategoria="20" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
                        	<option value="0">-- Seleccionar --</option>                     
                        </select>
                    </div>
                    <div class="form-group col-md-2" id="div-RV_Tipo_Venta">  
                        <label class="" for="RV_Tipo_Venta">Tipo Venta</label>
                        <select class="form-control input-sm filter_logica validar_cbo" id="RV_Tipo_Venta" name="RV_Tipo_Venta" idcategoria="21" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
                        	<option value="0">-- Seleccionar --</option>                     
                        </select>
                    </div>
                    <div class="form-group col-md-2" id="div-RV_Operador_Cedente">  
                        <label class="" for="RV_Operador_Cedente">Operador Cedente</label>
                        <select class="form-control input-sm validar_cbo" id="RV_Operador_Cedente" name="RV_Operador_Cedente" idcategoria="22" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
                        	<option value="0">-- Seleccionar --</option>                     
                        </select>
                    </div>
                    <div class="form-group col-md-2" id="div-RV_Origen">  
                        <label class="" for="RV_Origen">Origen</label>
                        <select class="form-control input-sm validar_cbo" id="RV_Origen" name="RV_Origen" idcategoria="23" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
                        	<option value="0">-- Seleccionar --</option>                     
                        </select>
                    </div>
                    <div class="form-group col-md-2" id="div-RV_Linea_Portar">
						<label class="" for="RV_Linea_Portar">Linea a portar</label>
						<input type="text" class="form-control input-sm validar_txt" id="RV_Linea_Portar" name="RV_Linea_Portar"   onkeyup="var pattern = /[^0-9]/g;this.value = this.value.replace(pattern, '');" maxlength="9" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  value="" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
					</div>
                    <div class="form-group col-md-2" id="div-RV_Plan_Tarifario">  
                        <label class="" for="RV_Plan_Tarifario">Plan Tarifario</label>
                        <select class="form-control input-sm filter_logica validar_cbo" id="RV_Plan_Tarifario" name="RV_Plan_Tarifario" idcategoria="24" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
                        	<option value="0">-- Seleccionar --</option>                     
                        </select>
                    </div>	
                    <div class="form-group col-md-2" id="div-RV_Cargo_Fijo_Plan">  
                        <label class="" for="RV_Cargo_Fijo_Plan">Cargo Fijo Plan</label>
                        <select class="form-control input-sm validar_cbo" id="RV_Cargo_Fijo_Plan" name="RV_Cargo_Fijo_Plan" idcategoria="25" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
                        	<option value="0">-- Seleccionar --</option>                     
                        </select>
                    </div>		
                    <div class="form-group col-md-2" id="div-RV_Tipo_Producto">  
                        <label class="" for="RV_Tipo_Producto">Tipo de Producto</label>
                        <select class="form-control input-sm filter_logica validar_cbo" id="RV_Tipo_Producto" name="RV_Tipo_Producto" idcategoria="26" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
                        	<option value="0">-- Seleccionar --</option>                     
                        </select>
                    </div>		
                    <div class="form-group col-md-2 hidden" id="div-RV_Accesorio_Regalo">  
                        <label class="" for="RV_Accesorio_Regalo">Accesorio de Regalo</label>
                        <select class="form-control input-sm filter_logica validar_cbo" id="RV_Accesorio_Regalo" name="RV_Accesorio_Regalo" idcategoria="27" obligatorio="NO" <?php echo  $FVenta_Interfaz; ?>>
                        	<option value="0">-- Seleccionar --</option>                     
                        </select>
                    </div>
                    <div class="form-group col-md-2 hidden" id="div-RV_SKU_Accesorio_Regalo1">
						<label class="" for="RV_SKU_Accesorio_Regalo1">SKU Accesorio de Regalo 1</label>
						<input type="text" class="form-control input-sm validar_txt" id="RV_SKU_Accesorio_Regalo1" name="RV_SKU_Accesorio_Regalo1"  value="" obligatorio="NO" <?php echo  $FVenta_Interfaz; ?>>
					</div>
                    <div class="form-group col-md-2 hidden" id="div-RV_SKU_Accesorio_Regalo2">
						<label class="" for="RV_SKU_Accesorio_Regalo2">SKU Accesorio de Regalo 2</label>
						<input type="text" class="form-control input-sm validar_txt" id="RV_SKU_Accesorio_Regalo2" name="RV_SKU_Accesorio_Regalo2"  value="" obligatorio="NO" <?php echo  $FVenta_Interfaz; ?>>
					</div>
                    <div class="form-group col-md-2" id="div-RV_SKU_Pack">
						<label class="" for="RV_SKU_Pack">SKU Pack</label>
						<input type="text" class="form-control input-sm validar_txt" id="RV_SKU_Pack" name="RV_SKU_Pack"  value="" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
					</div>
                    <div class="form-group col-md-2" id="div-RV_Precio_Equipo_Inicial_Total">
						<label class="" for="RV_Precio_Equipo_Inicial_Total">Precio Equipo Inicial/Total</label>
						<input type="text" class="form-control input-sm validar_txt" id="RV_Precio_Equipo_Inicial_Total" name="RV_Precio_Equipo_Inicial_Total"  onkeyup="var pattern = /[^0-9\.]/g;this.value = this.value.replace(pattern, '');" value="" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
					</div>
                    <div class="form-group col-md-2" id="div-RV_Cuota_Equipo_Mensual">
						<label class="" for="RV_Cuota_Equipo_Mensual">Cuota Equipo Mensual</label>
						<input type="text" class="form-control input-sm validar_txt" id="RV_Cuota_Equipo_Mensual" name="RV_Cuota_Equipo_Mensual" onkeyup="var pattern = /[^0-9\.]/g;this.value = this.value.replace(pattern, '');" value="" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
					</div>
                    <div class="form-group col-md-2" id="div-RV_Cant_Accesorios">  
                        <label class="" for="RV_Cant_Accesorios">Cant. Accesorios</label>
                        <select class="form-control input-sm filter_logica validar_cbo" id="RV_Cant_Accesorios" name="RV_Cant_Accesorios" idcategoria="28" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
                        	<option value="0">-- Seleccionar --</option>                     
                        </select>
                    </div>
                    <div class="form-group col-md-2" id="div-RV_SKU_Accesorio1">
						<label class="" for="RV_SKU_Accesorio1">SKU Accesorio 1</label>
						<input type="text" class="form-control input-sm validar_txt" id="RV_SKU_Accesorio1" name="RV_SKU_Accesorio1"  value="" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
					</div>
                    <div class="form-group col-md-2" id="div-RV_Precio_Accesorio1">
						<label class="" for="RV_Precio_Accesorio1">Precio Accesorio 1</label>
						<input type="text" class="form-control input-sm validar_txt" id="RV_Precio_Accesorio1" name="RV_Precio_Accesorio1"  onkeyup="var pattern = /[^0-9\.]/g;this.value = this.value.replace(pattern, '');" value="" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
					</div>
                    <div class="form-group col-md-2" id="div-RV_SKU_Accesorio2">
						<label class="" for="RV_SKU_Accesorio2">SKU Accesorio 2</label>
						<input type="text" class="form-control input-sm validar_txt" id="RV_SKU_Accesorio2" name="RV_SKU_Accesorio2"  value="" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
					</div>
                    <div class="form-group col-md-2" id="div-RV_Precio_Accesorio2">
						<label class="" for="RV_Precio_Accesorio2">Precio Accesorio 2</label>
						<input type="text" class="form-control input-sm validar_txt" id="RV_Precio_Accesorio2" name="RV_Precio_Accesorio2"  onkeyup="var pattern = /[^0-9\.]/g;this.value = this.value.replace(pattern, '');" value="" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
					</div>
                    <div class="form-group col-md-2" id="div-RV_SKU_Accesorio3">
						<label class="" for="RV_SKU_Accesorio3">SKU Accesorio 3</label>
						<input type="text" class="form-control input-sm validar_txt" id="RV_SKU_Accesorio3" name="RV_SKU_Accesorio3"  value="" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
					</div>
                    <div class="form-group col-md-2" id="div-RV_Precio_Accesorio3">
						<label class="" for="RV_Precio_Accesorio3">Precio Accesorio 3</label>
						<input type="text" class="form-control input-sm validar_txt" id="RV_Precio_Accesorio3" name="RV_Precio_Accesorio3"  onkeyup="var pattern = /[^0-9\.]/g;this.value = this.value.replace(pattern, '');" value="" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
					</div>
                    <div class="form-group col-md-2" id="div-RV_SKU_Accesorio4">
						<label class="" for="RV_SKU_Accesorio4">SKU Accesorio 4</label>
						<input type="text" class="form-control input-sm validar_txt" id="RV_SKU_Accesorio4" name="RV_SKU_Accesorio4"  value="" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
					</div>
                    <div class="form-group col-md-2" id="div-RV_Precio_Accesorio4">
						<label class="" for="RV_Precio_Accesorio4">Precio Accesorio 4</label>
						<input type="text" class="form-control input-sm validar_txt" id="RV_Precio_Accesorio4" name="RV_Precio_Accesorio4"  onkeyup="var pattern = /[^0-9\.]/g;this.value = this.value.replace(pattern, '');" value="" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
					</div>
                    <div class="form-group col-md-2" id="div-RV_SKU_Accesorio5">
						<label class="" for="RV_SKU_Accesorio5">SKU Accesorio 5</label>
						<input type="text" class="form-control input-sm validar_txt" id="RV_SKU_Accesorio5" name="RV_SKU_Accesorio5"  value="" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
					</div>
                    <div class="form-group col-md-2" id="div-RV_Precio_Accesorio5">
						<label class="" for="RV_Precio_Accesorio5">Precio Accesorio 5</label>
						<input type="text" class="form-control input-sm validar_txt" id="RV_Precio_Accesorio5" name="RV_Precio_Accesorio5"  onkeyup="var pattern = /[^0-9\.]/g;this.value = this.value.replace(pattern, '');" value="" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
					</div>
                    <div class="form-group col-md-2" id="div-RV_Tipo_Pago">  
                        <label class="" for="RV_Tipo_Pago">Tipo Pago</label>
                        <select class="form-control input-sm filter_logica validar_cbo" id="RV_Tipo_Pago" name="RV_Tipo_Pago" idcategoria="29" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
                        	<option value="0">-- Seleccionar --</option>                     
                        </select>
                    </div>
                    <div class="form-group col-md-2" id="div-RV_Promociones_Bancos">  
                        <label class="" for="RV_Promociones_Bancos">Promociones Bancos</label>
                        <select class="form-control input-sm validar_cbo" id="RV_Promociones_Bancos" name="RV_Promociones_Bancos" idcategoria="30" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
                        	<option value="0">-- Seleccionar --</option>                     
                        </select>
                    </div>
				</div>
			</div>
			<div class="panel panel-danger_dark">
				<div class="panel-heading"> 
					<h3 class='panel-title'>4.- Datos Facturación</h3>
				</div>
				<div class="panel-body">    			
					<div class="form-group col-md-2" id="div-DF_Email_Facturacion_Otros">
						<label class="" for="DF_Email_Facturacion_Otros">Email Facturación/Otros</label>
						<input type="text" class="form-control input-sm validar_txt" id="DF_Email_Facturacion_Otros" name="DF_Email_Facturacion_Otros"  value="" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
					</div>
                    <div class="form-group col-md-2" id="div-DF_Dpto_Facturacion">  
                        <label class="" for="DF_Dpto_Facturacion">Departamento Facturación</label>
                        <select class="form-control input-sm validar_cbo" id="DF_Dpto_Facturacion" name="DF_Dpto_Facturacion" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
                        	<option value="0">-- Seleccionar --</option>                     
                        </select>
                    </div>
                    <div class="form-group col-md-2" id="div-DF_Prov_Facturacion">  
                        <label class="" for="DF_Prov_Facturacion">Provincia Facturación</label>
                        <select class="form-control input-sm validar_cbo" id="DF_Prov_Facturacion" name="DF_Prov_Facturacion" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
                        	<option value="0">-- Seleccionar --</option>                     
                        </select>
                    </div>
                    <div class="form-group col-md-2" id="div-DF_Dist_Facturacion">  
                        <label class="" for="DF_Dist_Facturacion">Distrito Facturación</label>
                        <select class="form-control input-sm validar_cbo" id="DF_Dist_Facturacion" name="DF_Dist_Facturacion" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
                        	<option value="0">-- Seleccionar --</option>                     
                        </select>
                    </div>	    			
					<div class="form-group col-md-4" id="div-DF_Domicilio_Facturacion">
						<label class="" for="DF_Domicilio_Facturacion">Domicilio Facturación</label>
						<input type="text" class="form-control input-sm validar_txt" id="DF_Domicilio_Facturacion" name="DF_Domicilio_Facturacion"  value="" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
					</div>
				</div>
			</div>

			<div class="panel panel-danger_dark">
				<div class="panel-heading"> 
					<h3 class='panel-title'>5.- Registro para Entrega</h3>
				</div>
				<div class="panel-body">
                    <div class="form-group col-md-2" id="div-RE_Tipo_Despacho">  
                        <label class="" for="RE_Tipo_Despacho">Tipo Despacho</label>
                        <select class="form-control input-sm filter_logica validar_cbo" id="RE_Tipo_Despacho" name="RE_Tipo_Despacho" idcategoria="11" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
                        	<option value="0">-- Seleccionar --</option>                     
                        </select>
                    </div>
                    <div class="form-group col-md-2" id="div-RE_Rango_Entrega_Despacho">  
                        <label class="" for="RE_Rango_Entrega_Despacho">Rango Entrega Despacho</label>
                        <select class="form-control input-sm filter_logica validar_cbo" id="RE_Rango_Entrega_Despacho" name="RE_Rango_Entrega_Despacho" idcategoria="12" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
                        	<option value="0">-- Seleccionar --</option>                     
                        </select>
                    </div>
                    <div class="form-group col-md-2" id="div-RE_Rango_Horario_Despacho">  
                        <label class="" for="RE_Rango_Horario_Despacho">Rango Horario Despacho</label>
                        <select class="form-control input-sm filter_logica validar_cbo" id="RE_Rango_Horario_Despacho" name="RE_Rango_Horario_Despacho" idcategoria="13" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
                        	<option value="0">-- Seleccionar --</option>                     
                        </select>
                    </div>
                    <div class="form-group col-md-2" id="div-RE_Tienda_Retiro">  
                        <label class="" for="RE_Tienda_Retiro ">Tienda Retiro</label>
                        <select class="form-control input-sm validar_cbo" id="RE_Tienda_Retiro" name="RE_Tienda_Retiro" idcategoria="14" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
                        	<option value="0">-- Seleccionar --</option>                     
                        </select>
                    </div>
                    <div class="form-group col-md-2" id="div-RE_Retail_Retiro">  
                        <label class="" for="RE_Retail_Retiro">Retail Retiro</label>
                        <select class="form-control input-sm validar_cbo" id="RE_Retail_Retiro" name="RE_Retail_Retiro" idcategoria="15" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
                        	<option value="0">-- Seleccionar --</option>                     
                        </select>
                    </div>	    			
					<div class="form-group col-md-2" id="div-RE_Fecha_Entrega">
						<label class="" for="RE_Fecha_Entrega">Fecha de Entrega</label>
						<input type="date" class="form-control input-sm validar_txt" id="RE_Fecha_Entrega" name="RE_Fecha_Entrega"  value="" oninput="difsla('input',this);return false;" onchange="difsla('change',this);return false;"onblur="difsla('blur',this);return false;"onfocus="difsla('focus',this);return false;"onkeyup="difsla('keyup-'+event.keyCode,this);return false;"onkeypress="difsla('keypress-'+event.keyCode,this);if(event.keyCode==13){this.onchange();return false;}" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
					</div>	    			
					<div class="form-group col-md-1" id="div-RE_SLA_Entrega">
						<label class="" for="RE_SLA_Entrega">SLA Entrega</label>
						<input type="text" class="form-control input-sm" id="RE_SLA_Entrega" name="RE_SLA_Entrega" readonly="True" value="" <?php echo  $FVenta_Interfaz; ?>>
					</div>
                    <div class="form-group col-md-2" id="div-RE_Venta_Entrega_para">  
                        <label class="" for="RE_Venta_Entrega_para">Venta Entrega Para</label>
                        <select class="form-control input-sm validar_cbo" id="RE_Venta_Entrega_para" name="RE_Venta_Entrega_para" idcategoria="16" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
                        	<option value="0">-- Seleccionar --</option>                     
                        </select>
                    </div>
                    <div class="form-group col-md-2" id="div-RE_Venta_Destino_para">  
                        <label class="" for="RE_Venta_Destino_para">Venta Destino Para</label>
                        <select class="form-control input-sm validar_cbo" id="RE_Venta_Destino_para" name="RE_Venta_Destino_para" idcategoria="17" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
                        	<option value="0">-- Seleccionar --</option>                     
                        </select>
                    </div>
                    <div class="form-group col-md-3" id="div-RE_Dpto_Entrega_Producto">  
                        <label class="" for="RE_Dpto_Entrega_Producto">Departamento Entrega Producto</label>
                        <select class="form-control input-sm validar_cbo" id="RE_Dpto_Entrega_Producto" name="RE_Dpto_Entrega_Producto" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
                        	<option value="0">-- Seleccionar --</option>                     
                        </select>
                    </div>
                    <div class="form-group col-md-2" id="div-RE_Prov_Entrega_Producto">  
                        <label class="" for="RE_Prov_Entrega_Producto">Provincia Entrega Producto</label>
                        <select class="form-control input-sm validar_cbo" id="RE_Prov_Entrega_Producto" name="RE_Prov_Entrega_Producto" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
                        	<option value="0">-- Seleccionar --</option>                     
                        </select>
                    </div>
                    <div class="form-group col-md-2" id="div-RE_Dist_Entrega_Producto">  
                        <label class="" for="RE_Dist_Entrega_Producto">Distrito Entrega Producto</label>
                        <select class="form-control input-sm validar_cbo" id="RE_Dist_Entrega_Producto" name="RE_Dist_Entrega_Producto" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
                        	<option value="0">-- Seleccionar --</option>                     
                        </select>
                    </div>
                    <div class="form-group col-md-2" id="div-RE_Tipo_Direccion_Entrega">  
                        <label class="" for="RE_Tipo_Direccion_Entrega">Tipo Dirección Entrega</label>
                        <select class="form-control input-sm validar_cbo" id="RE_Tipo_Direccion_Entrega" name="RE_Tipo_Direccion_Entrega" idcategoria="18" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
                        	<option value="0">-- Seleccionar --</option>                     
                        </select>
                    </div>
                    <div class="form-group col-md-4" id="div-RE_Direccion_Entrega">
						<label class="" for="RE_Direccion_Entrega">Dirección Entrega</label>
						<input type="text" class="form-control input-sm validar_txt" id="RE_Direccion_Entrega" name="RE_Direccion_Entrega"  value="" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
					</div>
                    <div class="form-group col-md-3" id="div-RE_Referencia_Principales">
						<label class="" for="RE_Referencia_Principales">Referencias Principales</label>
						<input type="text" class="form-control input-sm validar_txt" id="RE_Referencia_Principales" name="RE_Referencia_Principales"  value="" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
					</div>
                    <div class="form-group col-md-3" id="div-RE_Referencias_Adicionales">
						<label class="" for="RE_Referencias_Adicionales">Referencias Adicionales</label>
						<input type="text" class="form-control input-sm validar_txt" id="RE_Referencias_Adicionales" name="RE_Referencias_Adicionales"  value="" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
					</div>
                    <div class="form-group col-md-2" id="div-RE_Coordenadas_Direccion_Entrega">
						<label class="" for="RE_Coordenadas_Direccion_Entrega">Coordenadas Dirección Entrega</label>
						<input type="text" class="form-control input-sm validar_txt" id="RE_Coordenadas_Direccion_Entrega" name="RE_Coordenadas_Direccion_Entrega"  value="" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
					</div>
                    <div class="form-group col-md-2" id="div-RE_Telefono_Contacto1">
						<label class="" for="RE_Telefono_Contacto1">Telf. Contacto 1</label>
						<input type="text" class="form-control input-sm validar_txt" id="RE_Telefono_Contacto1" name="RE_Telefono_Contacto1"   onkeyup="var pattern = /[^0-9]/g;this.value = this.value.replace(pattern, '');" maxlength="9" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  value="" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
					</div>
                    <div class="form-group col-md-2" id="div-RE_Telefono_Contacto2">
						<label class="" for="RE_Telefono_Contacto2">Telf. Contacto 2</label>
						<input type="text" class="form-control input-sm validar_txt" id="RE_Telefono_Contacto2"  onkeyup="var pattern = /[^0-9]/g;this.value = this.value.replace(pattern, '');" maxlength="9" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  name="RE_Telefono_Contacto2"  value="" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
					</div>
                    <div class="form-group col-md-2" id="div-RE_Tipo_Contacto_Ol">  
                        <label class="" for="RE_Tipo_Contacto_Ol">Tipo de Contacto OL</label>
                        <select class="form-control input-sm validar_cbo" id="RE_Tipo_Contacto_Ol" name="RE_Tipo_Contacto_Ol" idcategoria="19" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
                        	<option value="0">-- Seleccionar --</option>                     
                        </select>
                    </div>
				</div>
			</div>

			
			<div class="panel panel-danger_dark">
				<div class="panel-heading"> 
					<h3 class='panel-title'>6.- A Cargo de</h3>
				</div>
				<div class="panel-body">
                    <div class="form-group  col-md-4" id="div-Supervisor_Vendedor">   
                        <label class="" for="Supervisor_Vendedor">Supervisor</label>
                        <select class="form-control input-sm validar_cbo" id="Supervisor_Vendedor" name="Supervisor_Vendedor" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
                        	<option value="0">-- Seleccionar --</option>                     
                        </select>
                    </div>
				</div>
			</div>			
			<div class="panel panel-danger_dark">
				<div class="panel-heading"> 
					<h3 class='panel-title'>7.- Comentarios</h3>
				</div>
				<div class="panel-body">
                    <div class="form-group  col-md-12" id="div-Comentarios_Vendedor">
                    	<label class="" for="Comentarios_Vendedor">Comentarios</label>
                        <textarea class="form-control input-sm validar_txt" id="Comentarios_Vendedor" name="Comentarios_Vendedor" cols="30" rows="6" obligatorio="SI" <?php if ($idFicha_Venta<>0): ?>readonly="true"<?php endif ?> <?php echo  $FVenta_Interfaz; ?>></textarea>
                    </div>
				</div>
			</div>

			<div class="panel panel-danger_dark <?php if ($idFicha_Venta!=0): ?>hide<?php endif ?>">
				<div class="panel-body">
		    		<div class="panel-body">
		    			<div class="col-md-6 col-sm-12">
					        
					        <button type="button" id="btnRegistrarFichaVenta" class="btn btn-primary col-md-12 col-xs-12" <?php echo  $FVenta_Interfaz; ?>><i class="fa fa-save"></i> Registrar Ficha de Venta</button>   
					      
					    </div>
					    <div class="col-md-6 col-sm-12">					    
					        <a href="index.php?c=Ficha_Venta&a=v_Registrar_Ficha" class="btn btn-danger col-md-12 col-xs-12 "><i class="fa fa-times-circle" <?php echo  $FVenta_Interfaz; ?>></i> Cancelar</a>
					    </div>
		    		</div>
				</div>
			</div>			
			<div class="panel panel-danger_dark <?php if ($idFicha_Venta==0): ?>hide<?php endif ?>">
				<div class="panel-heading"> 
					<h3 class='panel-title'>8.- Validación Back Office</h3>
				</div>
				<div class="panel-body">
                    <div class="form-group col-md-2" id="div-VBO_Estado_Venta_BO">  
                        <label class="" for="VBO_Estado_Venta_BO">Estado Venta BO</label>
                        <select class="form-control input-sm filter_logica validar_cbo" id="VBO_Estado_Venta_BO" name="VBO_Estado_Venta_BO" idcategoria="31" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
                        	<option value="0">-- Seleccionar --</option>                     
                        </select>
                    </div>
                    <div class="form-group col-md-2" id="div-VBO_Sub_Estado_Venta_BO">  
                        <label class="" for="VBO_Sub_Estado_Venta_BO">Sub Estado Venta BO</label>
                        <select class="form-control input-sm validar_cbo" id="VBO_Sub_Estado_Venta_BO" name="VBO_Sub_Estado_Venta_BO" idcategoria="32" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
                        	<option value="0">-- Seleccionar --</option>                     
                        </select>
                    </div>
				</div>
			</div>			
			<div class="panel panel-danger_dark <?php if ($idFicha_Venta==0): ?>hide<?php endif ?>">
				<div class="panel-heading"> 
					<h3 class='panel-title'>9.- Resultado Back Office</h3>
				</div>
				<div class="panel-body">
                    <div class="form-group col-md-2" id="div-RBO_Cantidad_Ordenes_Ficha">  
                        <label class="" for="RBO_Cantidad_Ordenes_Ficha">Cantidad Ordenes Ficha</label>
                        <select class="form-control input-sm filter_logica validar_cbo" id="RBO_Cantidad_Ordenes_Ficha" name="RBO_Cantidad_Ordenes_Ficha" idcategoria="33" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
                        	<option value="0">-- Seleccionar --</option>                     
                        </select>
                    </div>
                    <div class="form-group col-md-2" id="div-RBO_Orden_One_Click1">
						<label class="" for="RBO_Orden_One_Click1">Orden One Click 1</label>
						<input type="text" class="form-control input-sm validar_txt" id="RBO_Orden_One_Click1" name="RBO_Orden_One_Click1"  value="" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
					</div>
                    <div class="form-group col-md-2" id="div-RBO_Orden_One_Click2">
						<label class="" for="RBO_Orden_One_Click2">Orden One Click 2</label>
						<input type="text" class="form-control input-sm validar_txt" id="RBO_Orden_One_Click2" name="RBO_Orden_One_Click2"  value="" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
					</div>
                    <div class="form-group col-md-2" id="div-RBO_Orden_One_Click3">
						<label class="" for="RBO_Orden_One_Click3">Orden One Click 3</label>
						<input type="text" class="form-control input-sm validar_txt" id="RBO_Orden_One_Click3" name="RBO_Orden_One_Click3"  value="" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
					</div>
				</div>
			</div>			
			<div class="panel panel-danger_dark <?php if ($idFicha_Venta==0): ?>hide<?php endif ?>">
				<div class="panel-heading"> 
					<h3 class='panel-title'>10.- FeedBack Back Office</h3>
				</div>
				<div class="panel-body">
                    <div class="form-group col-md-2" id="div-FBO_Ficha_Limpia">  
                        <label class="" for="FBO_Ficha_Limpia">Ficha Limpia</label>
                        <select class="form-control input-sm filter_logica validar_cbo" id="FBO_Ficha_Limpia" name="FBO_Ficha_Limpia" idcategoria="34" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
                        	<option value="0">-- Seleccionar --</option>                     
                        </select>
                    </div>
                    <div class="form-group  col-md-4" id="div-FBO_Errores_Comunes_Ficha">   
                        <label class="" for="FBO_Errores_Comunes_Ficha">Errores Comunes en la Ficha</label>
                        <select class="form-control input-sm validar_cbo" id="FBO_Errores_Comunes_Ficha" name="FBO_Errores_Comunes_Ficha" idcategoria="35" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
                        	<option value="0">-- Seleccionar --</option>                     
                        </select>
                    </div>
				</div>
			</div>			
			<div class="panel panel-danger_dark <?php if ($idFicha_Venta==0): ?>hide<?php endif ?>">
				<div class="panel-heading"> 
					<h3 class='panel-title'>11.- Datos Gestor Back Office</h3>
				</div>
				<div class="panel-body">
                    <div class="form-group col-md-2" id="div-DGBO_Tipo_Atencion_Final">  
                        <label class="" for="DGBO_Tipo_Atencion_Final">Tipo Atencion Final</label>
                        <select class="form-control input-sm validar_cbo" id="DGBO_Tipo_Atencion_Final" name="DGBO_Tipo_Atencion_Final" idcategoria="36" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>>
                        	<option value="0">-- Seleccionar --</option>                     
                        </select>
                    </div>
				</div>
			</div>			
			<div class="panel panel-danger_dark <?php if ($idFicha_Venta==0): ?>hide<?php endif ?>">
				<div class="panel-heading"> 
					<h3 class='panel-title'>12.- Comentarios Back Office</h3>
				</div>
				<div class="panel-body">
                    <div class="form-group  col-md-12" id="div-Comentarios_BackOffice">
                    	<label class="" for="Comentarios_BackOffice">Comentarios Finales</label>
                        <textarea class="form-control input-sm validar_txt" id="Comentarios_BackOffice" name="Comentarios_BackOffice" cols="30" rows="6" obligatorio="SI" <?php echo  $FVenta_Interfaz; ?>></textarea>
                    </div>
				</div>
			</div>
			<div class="panel panel-danger_dark <?php if ($idFicha_Venta==0): ?>hide<?php endif ?>">
				<div class="panel-body">
		    		<div class="panel-body">
		    			<div class="col-md-4 col-sm-12">
					        <button type="button" id="btnActualizarFichaVenta_VBO" class="btn btn-success col-md-12 col-xs-12" style="height: auto;" <?php echo  $FVenta_Interfaz; ?>><i class="fa fa-check-square-o fa-3x" aria-hidden="true" style="display: list-item;"></i> GUARDAR VALIDACIÓN BACK OFFICE</button>   
					    </div>
					    <div class="col-md-4 col-sm-12">        
					        <button type="button" id="btnActualizarFichaVenta_RRBO" class="btn btn-primary col-md-12 col-xs-12" style="height: auto;" <?php echo  $FVenta_Interfaz; ?>><i class="fa fa-calendar-plus-o fa-3x" aria-hidden="true" style="display: list-item;"></i> GUARDAR RECUPERO O REPROGRAMACIÓN BACK OFFICE</button>   
					    </div>

					    <div class="col-md-4 col-sm-12">					        
					        <button type="button" id="btnRetornarFichaVenta" class="btn btn-danger col-md-12 col-xs-12" style="height: auto;"><i class="fa fa-arrow-circle-o-left fa-3x" aria-hidden="true" style="display: list-item;"></i> RETORNAR LISTADO DE FICHAS </button>					      
					    </div>
		    		</div>
				</div>
			</div>


        </div><!-- /.col -->
    </div><!-- /.row -->

</section><!-- /.content -->
<div class="modal fade" id="confirmar-registrar-ficha" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Registrar Ficha de Venta</h4>
            </div>
            <div class="modal-body">
                <label>¿Estás seguro de Registrar la Ficha de Ventas?</label>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-ok-RegistrarFichaVenta" id="btn-ok-RegistrarFichaVenta" data-dismiss="modal">Sí</button>
                <a class="btn btn-danger" data-dismiss="modal">No
                </a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="confirmar-actualizar-ficha" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Actualizar Ficha de Venta</h4>
            </div>
            <div class="modal-body">
                <label>¿Estás seguro de Actualizar la Ficha de Ventas?</label>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-ok-ActualizarFichaVenta" id="btn-ok-ActualizarFichaVenta" data-dismiss="modal">Sí</button>
                <a class="btn btn-danger" data-dismiss="modal">No
                </a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="confirmar-validacion_datos" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content ">
            <div class="modal-header bg-red">
                <h4 class="modal-title" id="title_moda_validacion">Error al Registrar Ficha de Venta</h4>
            </div>
            <div class="modal-body">
                <label id="label_moda_validacion">Completar los campos sombreados de rojo para poder registrar la ficha de ventas</label>
            </div>
            <div class="modal-footer bg-red">
                
                <a class="btn btn-default" data-dismiss="modal">Cerrar</a>
            </div>
        </div>
    </div>
</div>



<script>
	function elog(ev, object) {
		var DiaActual = new Date();
    	var DP_Fecha_Nacimiento = new Date($("#DP_Fecha_Nacimiento").val());
    	var DP_Edad_Actual=calcular_diferencia_fechas(DP_Fecha_Nacimiento,DiaActual,'Year')
    	$("#DP_Edad_Actual").val(DP_Edad_Actual);
	}	

	function difsla(ev, object) {
		var DiaActual = new Date();
    	var RE_Fecha_Entrega = new Date($("#RE_Fecha_Entrega").val());
    	var RE_SLA_Entrega=calcular_diferencia_fechas(DiaActual,RE_Fecha_Entrega,'Days')
    	$("#RE_SLA_Entrega").val(RE_SLA_Entrega);
	}

	function ValidarDatosRegistrar(){
	


		/*INICIO Cargar SubCategorias*/
			const Campos = [					
					{tipo_campo:'textbox',NombreCampo:'DE_Telf_Llamada_Venta',NombreInputGroup:'div-DE_Telf_Llamada_Venta'},
					{tipo_campo:'select',NombreCampo:'DE_Base_Llamada',NombreInputGroup:'div-DE_Base_Llamada'},
					{tipo_campo:'select',NombreCampo:'DE_Campana_Netcall',NombreInputGroup:'div-DE_Campana_Netcall'},
					{tipo_campo:'select',NombreCampo:'DE_Sub_Campana',NombreInputGroup:'div-DE_Sub_Campana'},
					{tipo_campo:'select',NombreCampo:'DE_Detalle_Sub_Campana',NombreInputGroup:'div-DE_Detalle_Sub_Campana'},
					{tipo_campo:'select',NombreCampo:'DE_CF_Max_Linea_Movil',NombreInputGroup:'div-DE_CF_Max_Linea_Movil'},
					{tipo_campo:'select',NombreCampo:'DE_Tipo_Etiqueta',NombreInputGroup:'div-DE_Tipo_Etiqueta'},
					{tipo_campo:'textbox',NombreCampo:'DE_CF_Max_Linea_Pack',NombreInputGroup:'div-DE_CF_Max_Linea_Pack'},
					{tipo_campo:'textbox',NombreCampo:'DE_Monto_Disp_Finan_Equipos',NombreInputGroup:'div-DE_Monto_Disp_Finan_Equipos'},
					{tipo_campo:'select',NombreCampo:'DE_Cant_Meses_Finan_Equipos',NombreInputGroup:'div-DE_Cant_Meses_Finan_Equipos'},
					{tipo_campo:'select',NombreCampo:'DE_Cliente_Entel',NombreInputGroup:'div-DE_Cliente_Entel'},
					{tipo_campo:'select',NombreCampo:'DE_Cliente_Promo_Dscto',NombreInputGroup:'div-DE_Cliente_Promo_Dscto'},
					{tipo_campo:'select',NombreCampo:'DP_TipoDocumento',NombreInputGroup:'div-DP_TipoDocumento'},
					{tipo_campo:'textbox',NombreCampo:'DP_Documento',NombreInputGroup:'div-DP_Documento'},
					{tipo_campo:'textbox',NombreCampo:'DP_Nombre_Cliente',NombreInputGroup:'div-DP_Nombre_Cliente'},
					{tipo_campo:'textbox',NombreCampo:'DP_Apellido_Paterno',NombreInputGroup:'div-DP_Apellido_Paterno'},
					{tipo_campo:'textbox',NombreCampo:'DP_Apellido_Materno',NombreInputGroup:'div-DP_Apellido_Materno'},
					{tipo_campo:'textbox',NombreCampo:'DP_Nacionalidad',NombreInputGroup:'div-DP_Nacionalidad'},
					{tipo_campo:'textbox',NombreCampo:'DP_Lugar_Nacimiento',NombreInputGroup:'div-DP_Lugar_Nacimiento'},
					{tipo_campo:'textbox',NombreCampo:'DP_Fecha_Nacimiento',NombreInputGroup:'div-DP_Fecha_Nacimiento'},
					{tipo_campo:'textbox',NombreCampo:'DP_Nombre_Padre',NombreInputGroup:'div-DP_Nombre_Padre'},
					{tipo_campo:'textbox',NombreCampo:'DP_Nombre_Madre',NombreInputGroup:'div-DP_Nombre_Madre'},
					{tipo_campo:'textbox',NombreCampo:'DF_Email_Facturacion_Otros',NombreInputGroup:'div-DF_Email_Facturacion_Otros'},
					{tipo_campo:'select',NombreCampo:'DF_Dpto_Facturacion',NombreInputGroup:'div-DF_Dpto_Facturacion'},
					{tipo_campo:'select',NombreCampo:'DF_Prov_Facturacion',NombreInputGroup:'div-DF_Prov_Facturacion'},
					{tipo_campo:'select',NombreCampo:'DF_Dist_Facturacion',NombreInputGroup:'div-DF_Dist_Facturacion'},
					{tipo_campo:'textbox',NombreCampo:'DF_Domicilio_Facturacion',NombreInputGroup:'div-DF_Domicilio_Facturacion'},
					{tipo_campo:'select',NombreCampo:'RE_Tipo_Despacho',NombreInputGroup:'div-RE_Tipo_Despacho'},
					{tipo_campo:'select',NombreCampo:'RE_Rango_Entrega_Despacho',NombreInputGroup:'div-RE_Rango_Entrega_Despacho'},
					{tipo_campo:'select',NombreCampo:'RE_Rango_Horario_Despacho',NombreInputGroup:'div-RE_Rango_Horario_Despacho'},
					{tipo_campo:'select',NombreCampo:'RE_Tienda_Retiro',NombreInputGroup:'div-RE_Tienda_Retiro'},
					{tipo_campo:'select',NombreCampo:'RE_Retail_Retiro',NombreInputGroup:'div-RE_Retail_Retiro'},
					{tipo_campo:'select',NombreCampo:'RE_Fecha_Entrega',NombreInputGroup:'div-RE_Fecha_Entrega'},
					{tipo_campo:'select',NombreCampo:'RE_Venta_Entrega_para',NombreInputGroup:'div-RE_Venta_Entrega_para'},
					{tipo_campo:'select',NombreCampo:'RE_Venta_Destino_para',NombreInputGroup:'div-RE_Venta_Destino_para'},
					{tipo_campo:'select',NombreCampo:'RE_Dpto_Entrega_Producto',NombreInputGroup:'div-RE_Dpto_Entrega_Producto'},
					{tipo_campo:'select',NombreCampo:'RE_Prov_Entrega_Producto',NombreInputGroup:'div-RE_Prov_Entrega_Producto'},
					{tipo_campo:'select',NombreCampo:'RE_Dist_Entrega_Producto',NombreInputGroup:'div-RE_Dist_Entrega_Producto'},
					{tipo_campo:'select',NombreCampo:'RE_Tipo_Direccion_Entrega',NombreInputGroup:'div-RE_Tipo_Direccion_Entrega'},
					{tipo_campo:'textbox',NombreCampo:'RE_Direccion_Entrega',NombreInputGroup:'div-RE_Direccion_Entrega'},
					{tipo_campo:'textbox',NombreCampo:'RE_Referencia_Principales',NombreInputGroup:'div-RE_Referencia_Principales'},
					{tipo_campo:'textbox',NombreCampo:'RE_Referencias_Adicionales',NombreInputGroup:'div-RE_Referencias_Adicionales'},
					{tipo_campo:'textbox',NombreCampo:'RE_Coordenadas_Direccion_Entrega',NombreInputGroup:'div-RE_Coordenadas_Direccion_Entrega'},
					{tipo_campo:'textbox',NombreCampo:'RE_Telefono_Contacto1',NombreInputGroup:'div-RE_Telefono_Contacto1'},
					{tipo_campo:'textbox',NombreCampo:'RE_Telefono_Contacto2',NombreInputGroup:'div-RE_Telefono_Contacto2'},
					{tipo_campo:'select',NombreCampo:'RE_Tipo_Contacto_Ol',NombreInputGroup:'div-RE_Tipo_Contacto_Ol'},
					{tipo_campo:'select',NombreCampo:'RV_Tipo_Ofrecimiento',NombreInputGroup:'div-RV_Tipo_Ofrecimiento'},
					{tipo_campo:'select',NombreCampo:'RV_Tipo_Venta',NombreInputGroup:'div-RV_Tipo_Venta'},
					{tipo_campo:'select',NombreCampo:'RV_Operador_Cedente',NombreInputGroup:'div-RV_Operador_Cedente'},
					{tipo_campo:'select',NombreCampo:'RV_Origen',NombreInputGroup:'div-RV_Origen'},
					{tipo_campo:'textbox',NombreCampo:'RV_Linea_Portar',NombreInputGroup:'div-RV_Linea_Portar'},
					{tipo_campo:'select',NombreCampo:'RV_Plan_Tarifario',NombreInputGroup:'div-RV_Plan_Tarifario'},
					{tipo_campo:'select',NombreCampo:'RV_Cargo_Fijo_Plan',NombreInputGroup:'div-RV_Cargo_Fijo_Plan'},
					{tipo_campo:'select',NombreCampo:'RV_Tipo_Producto',NombreInputGroup:'div-RV_Tipo_Producto'},
					{tipo_campo:'select',NombreCampo:'RV_Accesorio_Regalo',NombreInputGroup:'div-RV_Accesorio_Regalo'},
					{tipo_campo:'textbox',NombreCampo:'RV_SKU_Accesorio_Regalo1',NombreInputGroup:'div-RV_SKU_Accesorio_Regalo1'},
					{tipo_campo:'textbox',NombreCampo:'RV_SKU_Accesorio_Regalo2',NombreInputGroup:'div-RV_SKU_Accesorio_Regalo2'},
					{tipo_campo:'textbox',NombreCampo:'RV_SKU_Pack',NombreInputGroup:'div-RV_SKU_Pack'},
					{tipo_campo:'textbox',NombreCampo:'RV_Precio_Equipo_Inicial_Total',NombreInputGroup:'div-RV_Precio_Equipo_Inicial_Total'},
					{tipo_campo:'textbox',NombreCampo:'RV_Cuota_Equipo_Mensual',NombreInputGroup:'div-RV_Cuota_Equipo_Mensual'},
					{tipo_campo:'select',NombreCampo:'RV_Cant_Accesorios',NombreInputGroup:'div-RV_Cant_Accesorios'},
					{tipo_campo:'textbox',NombreCampo:'RV_SKU_Accesorio1',NombreInputGroup:'div-RV_SKU_Accesorio1'},
					{tipo_campo:'textbox',NombreCampo:'RV_Precio_Accesorio1',NombreInputGroup:'div-RV_Precio_Accesorio1'},
					{tipo_campo:'textbox',NombreCampo:'RV_SKU_Accesorio2',NombreInputGroup:'div-RV_SKU_Accesorio2'},
					{tipo_campo:'textbox',NombreCampo:'RV_Precio_Accesorio2',NombreInputGroup:'div-RV_Precio_Accesorio2'},
					{tipo_campo:'textbox',NombreCampo:'RV_SKU_Accesorio3',NombreInputGroup:'div-RV_SKU_Accesorio3'},
					{tipo_campo:'textbox',NombreCampo:'RV_Precio_Accesorio3',NombreInputGroup:'div-RV_Precio_Accesorio3'},
					{tipo_campo:'textbox',NombreCampo:'RV_SKU_Accesorio4',NombreInputGroup:'div-RV_SKU_Accesorio4'},
					{tipo_campo:'textbox',NombreCampo:'RV_Precio_Accesorio4',NombreInputGroup:'div-RV_Precio_Accesorio4'},
					{tipo_campo:'textbox',NombreCampo:'RV_SKU_Accesorio5',NombreInputGroup:'div-RV_SKU_Accesorio5'},
					{tipo_campo:'textbox',NombreCampo:'RV_Precio_Accesorio5',NombreInputGroup:'div-RV_Precio_Accesorio5'},
					{tipo_campo:'select',NombreCampo:'RV_Tipo_Pago',NombreInputGroup:'div-RV_Tipo_Pago'},
					{tipo_campo:'select',NombreCampo:'RV_Promociones_Bancos',NombreInputGroup:'div-RV_Promociones_Bancos'},
					{tipo_campo:'select',NombreCampo:'Supervisor_Vendedor',NombreInputGroup:'div-Supervisor_Vendedor'},
					{tipo_campo:'textbox',NombreCampo:'Comentarios_Vendedor',NombreInputGroup:'div-Comentarios_Vendedor'},
					{tipo_campo:'select',NombreCampo:'Ingresado_por_Vendedor',NombreInputGroup:'div-Ingresado_por_Vendedor'},
					{tipo_campo:'select',NombreCampo:'Fecha_Registro_Vendedor',NombreInputGroup:'div-Fecha_Registro_Vendedor'},
				
			
			];
			
			var Resultado="Completo";
			var campo_vacio=1;
			Campos.forEach(function(index) {
				
				var obligatorio=$("#"+index.NombreCampo).attr('obligatorio');
				var valor=$("#"+index.NombreCampo).val();
				var tipo_campo=index.tipo_campo;
				var NombreInputGroup=index.NombreInputGroup;


				if(obligatorio=="SI"){

					if(tipo_campo=='select' && valor==0){
						$("#"+NombreInputGroup).removeClass('has-success').removeClass('has-error').addClass('has-error');
						Resultado="Incompleto";
						if(campo_vacio==1){$("#"+index.NombreCampo).focus();}
						campo_vacio++;
					}

					if(tipo_campo=='textbox' && valor==""){
						$("#"+NombreInputGroup).removeClass('has-success').removeClass('has-error').addClass('has-error');
						Resultado="Incompleto";
						if(campo_vacio==1){$("#"+index.NombreCampo).focus();}
						campo_vacio++;
					}

				}
			});

			return Resultado;
	}	


	function ValidarDatosActualizar(){
	


		/*INICIO Cargar SubCategorias*/
			const Campos = [					
					{tipo_campo:'textbox',NombreCampo:'DE_Telf_Llamada_Venta',NombreInputGroup:'div-DE_Telf_Llamada_Venta'},
					{tipo_campo:'select',NombreCampo:'DE_Base_Llamada',NombreInputGroup:'div-DE_Base_Llamada'},
					{tipo_campo:'select',NombreCampo:'DE_Campana_Netcall',NombreInputGroup:'div-DE_Campana_Netcall'},
					{tipo_campo:'select',NombreCampo:'DE_Sub_Campana',NombreInputGroup:'div-DE_Sub_Campana'},
					{tipo_campo:'select',NombreCampo:'DE_Detalle_Sub_Campana',NombreInputGroup:'div-DE_Detalle_Sub_Campana'},
					{tipo_campo:'select',NombreCampo:'DE_CF_Max_Linea_Movil',NombreInputGroup:'div-DE_CF_Max_Linea_Movil'},
					{tipo_campo:'select',NombreCampo:'DE_Tipo_Etiqueta',NombreInputGroup:'div-DE_Tipo_Etiqueta'},
					{tipo_campo:'textbox',NombreCampo:'DE_CF_Max_Linea_Pack',NombreInputGroup:'div-DE_CF_Max_Linea_Pack'},
					{tipo_campo:'textbox',NombreCampo:'DE_Monto_Disp_Finan_Equipos',NombreInputGroup:'div-DE_Monto_Disp_Finan_Equipos'},
					{tipo_campo:'select',NombreCampo:'DE_Cant_Meses_Finan_Equipos',NombreInputGroup:'div-DE_Cant_Meses_Finan_Equipos'},
					{tipo_campo:'select',NombreCampo:'DE_Cliente_Entel',NombreInputGroup:'div-DE_Cliente_Entel'},
					{tipo_campo:'select',NombreCampo:'DE_Cliente_Promo_Dscto',NombreInputGroup:'div-DE_Cliente_Promo_Dscto'},
					{tipo_campo:'select',NombreCampo:'DP_TipoDocumento',NombreInputGroup:'div-DP_TipoDocumento'},
					{tipo_campo:'textbox',NombreCampo:'DP_Documento',NombreInputGroup:'div-DP_Documento'},
					{tipo_campo:'textbox',NombreCampo:'DP_Nombre_Cliente',NombreInputGroup:'div-DP_Nombre_Cliente'},
					{tipo_campo:'textbox',NombreCampo:'DP_Apellido_Paterno',NombreInputGroup:'div-DP_Apellido_Paterno'},
					{tipo_campo:'textbox',NombreCampo:'DP_Apellido_Materno',NombreInputGroup:'div-DP_Apellido_Materno'},
					{tipo_campo:'textbox',NombreCampo:'DP_Nacionalidad',NombreInputGroup:'div-DP_Nacionalidad'},
					{tipo_campo:'textbox',NombreCampo:'DP_Lugar_Nacimiento',NombreInputGroup:'div-DP_Lugar_Nacimiento'},
					{tipo_campo:'textbox',NombreCampo:'DP_Fecha_Nacimiento',NombreInputGroup:'div-DP_Fecha_Nacimiento'},
					{tipo_campo:'textbox',NombreCampo:'DP_Nombre_Padre',NombreInputGroup:'div-DP_Nombre_Padre'},
					{tipo_campo:'textbox',NombreCampo:'DP_Nombre_Madre',NombreInputGroup:'div-DP_Nombre_Madre'},
					{tipo_campo:'textbox',NombreCampo:'DF_Email_Facturacion_Otros',NombreInputGroup:'div-DF_Email_Facturacion_Otros'},
					{tipo_campo:'select',NombreCampo:'DF_Dpto_Facturacion',NombreInputGroup:'div-DF_Dpto_Facturacion'},
					{tipo_campo:'select',NombreCampo:'DF_Prov_Facturacion',NombreInputGroup:'div-DF_Prov_Facturacion'},
					{tipo_campo:'select',NombreCampo:'DF_Dist_Facturacion',NombreInputGroup:'div-DF_Dist_Facturacion'},
					{tipo_campo:'textbox',NombreCampo:'DF_Domicilio_Facturacion',NombreInputGroup:'div-DF_Domicilio_Facturacion'},
					{tipo_campo:'select',NombreCampo:'RE_Tipo_Despacho',NombreInputGroup:'div-RE_Tipo_Despacho'},
					{tipo_campo:'select',NombreCampo:'RE_Rango_Entrega_Despacho',NombreInputGroup:'div-RE_Rango_Entrega_Despacho'},
					{tipo_campo:'select',NombreCampo:'RE_Rango_Horario_Despacho',NombreInputGroup:'div-RE_Rango_Horario_Despacho'},
					{tipo_campo:'select',NombreCampo:'RE_Tienda_Retiro',NombreInputGroup:'div-RE_Tienda_Retiro'},
					{tipo_campo:'select',NombreCampo:'RE_Retail_Retiro',NombreInputGroup:'div-RE_Retail_Retiro'},
					{tipo_campo:'select',NombreCampo:'RE_Fecha_Entrega',NombreInputGroup:'div-RE_Fecha_Entrega'},
					{tipo_campo:'select',NombreCampo:'RE_Venta_Entrega_para',NombreInputGroup:'div-RE_Venta_Entrega_para'},
					{tipo_campo:'select',NombreCampo:'RE_Venta_Destino_para',NombreInputGroup:'div-RE_Venta_Destino_para'},
					{tipo_campo:'select',NombreCampo:'RE_Dpto_Entrega_Producto',NombreInputGroup:'div-RE_Dpto_Entrega_Producto'},
					{tipo_campo:'select',NombreCampo:'RE_Prov_Entrega_Producto',NombreInputGroup:'div-RE_Prov_Entrega_Producto'},
					{tipo_campo:'select',NombreCampo:'RE_Dist_Entrega_Producto',NombreInputGroup:'div-RE_Dist_Entrega_Producto'},
					{tipo_campo:'select',NombreCampo:'RE_Tipo_Direccion_Entrega',NombreInputGroup:'div-RE_Tipo_Direccion_Entrega'},
					{tipo_campo:'textbox',NombreCampo:'RE_Direccion_Entrega',NombreInputGroup:'div-RE_Direccion_Entrega'},
					{tipo_campo:'textbox',NombreCampo:'RE_Referencia_Principales',NombreInputGroup:'div-RE_Referencia_Principales'},
					{tipo_campo:'textbox',NombreCampo:'RE_Referencias_Adicionales',NombreInputGroup:'div-RE_Referencias_Adicionales'},
					{tipo_campo:'textbox',NombreCampo:'RE_Coordenadas_Direccion_Entrega',NombreInputGroup:'div-RE_Coordenadas_Direccion_Entrega'},
					{tipo_campo:'textbox',NombreCampo:'RE_Telefono_Contacto1',NombreInputGroup:'div-RE_Telefono_Contacto1'},
					{tipo_campo:'textbox',NombreCampo:'RE_Telefono_Contacto2',NombreInputGroup:'div-RE_Telefono_Contacto2'},
					{tipo_campo:'select',NombreCampo:'RE_Tipo_Contacto_Ol',NombreInputGroup:'div-RE_Tipo_Contacto_Ol'},
					{tipo_campo:'select',NombreCampo:'RV_Tipo_Ofrecimiento',NombreInputGroup:'div-RV_Tipo_Ofrecimiento'},
					{tipo_campo:'select',NombreCampo:'RV_Tipo_Venta',NombreInputGroup:'div-RV_Tipo_Venta'},
					{tipo_campo:'select',NombreCampo:'RV_Operador_Cedente',NombreInputGroup:'div-RV_Operador_Cedente'},
					{tipo_campo:'select',NombreCampo:'RV_Origen',NombreInputGroup:'div-RV_Origen'},
					{tipo_campo:'textbox',NombreCampo:'RV_Linea_Portar',NombreInputGroup:'div-RV_Linea_Portar'},
					{tipo_campo:'select',NombreCampo:'RV_Plan_Tarifario',NombreInputGroup:'div-RV_Plan_Tarifario'},
					{tipo_campo:'select',NombreCampo:'RV_Cargo_Fijo_Plan',NombreInputGroup:'div-RV_Cargo_Fijo_Plan'},
					{tipo_campo:'select',NombreCampo:'RV_Tipo_Producto',NombreInputGroup:'div-RV_Tipo_Producto'},
					{tipo_campo:'select',NombreCampo:'RV_Accesorio_Regalo',NombreInputGroup:'div-RV_Accesorio_Regalo'},
					{tipo_campo:'textbox',NombreCampo:'RV_SKU_Accesorio_Regalo1',NombreInputGroup:'div-RV_SKU_Accesorio_Regalo1'},
					{tipo_campo:'textbox',NombreCampo:'RV_SKU_Accesorio_Regalo2',NombreInputGroup:'div-RV_SKU_Accesorio_Regalo2'},
					{tipo_campo:'textbox',NombreCampo:'RV_SKU_Pack',NombreInputGroup:'div-RV_SKU_Pack'},
					{tipo_campo:'textbox',NombreCampo:'RV_Precio_Equipo_Inicial_Total',NombreInputGroup:'div-RV_Precio_Equipo_Inicial_Total'},
					{tipo_campo:'textbox',NombreCampo:'RV_Cuota_Equipo_Mensual',NombreInputGroup:'div-RV_Cuota_Equipo_Mensual'},
					{tipo_campo:'select',NombreCampo:'RV_Cant_Accesorios',NombreInputGroup:'div-RV_Cant_Accesorios'},
					{tipo_campo:'textbox',NombreCampo:'RV_SKU_Accesorio1',NombreInputGroup:'div-RV_SKU_Accesorio1'},
					{tipo_campo:'textbox',NombreCampo:'RV_Precio_Accesorio1',NombreInputGroup:'div-RV_Precio_Accesorio1'},
					{tipo_campo:'textbox',NombreCampo:'RV_SKU_Accesorio2',NombreInputGroup:'div-RV_SKU_Accesorio2'},
					{tipo_campo:'textbox',NombreCampo:'RV_Precio_Accesorio2',NombreInputGroup:'div-RV_Precio_Accesorio2'},
					{tipo_campo:'textbox',NombreCampo:'RV_SKU_Accesorio3',NombreInputGroup:'div-RV_SKU_Accesorio3'},
					{tipo_campo:'textbox',NombreCampo:'RV_Precio_Accesorio3',NombreInputGroup:'div-RV_Precio_Accesorio3'},
					{tipo_campo:'textbox',NombreCampo:'RV_SKU_Accesorio4',NombreInputGroup:'div-RV_SKU_Accesorio4'},
					{tipo_campo:'textbox',NombreCampo:'RV_Precio_Accesorio4',NombreInputGroup:'div-RV_Precio_Accesorio4'},
					{tipo_campo:'textbox',NombreCampo:'RV_SKU_Accesorio5',NombreInputGroup:'div-RV_SKU_Accesorio5'},
					{tipo_campo:'textbox',NombreCampo:'RV_Precio_Accesorio5',NombreInputGroup:'div-RV_Precio_Accesorio5'},
					{tipo_campo:'select',NombreCampo:'RV_Tipo_Pago',NombreInputGroup:'div-RV_Tipo_Pago'},
					{tipo_campo:'select',NombreCampo:'RV_Promociones_Bancos',NombreInputGroup:'div-RV_Promociones_Bancos'},
					{tipo_campo:'select',NombreCampo:'Supervisor_Vendedor',NombreInputGroup:'div-Supervisor_Vendedor'},
					{tipo_campo:'textbox',NombreCampo:'Comentarios_Vendedor',NombreInputGroup:'div-Comentarios_Vendedor'},
					{tipo_campo:'select',NombreCampo:'Ingresado_por_Vendedor',NombreInputGroup:'div-Ingresado_por_Vendedor'},
					{tipo_campo:'select',NombreCampo:'Fecha_Registro_Vendedor',NombreInputGroup:'div-Fecha_Registro_Vendedor'},
					{tipo_campo:'select',NombreCampo:'VBO_Estado_Venta_BO',NombreInputGroup:'div-VBO_Estado_Venta_BO'},
					{tipo_campo:'select',NombreCampo:'VBO_Sub_Estado_Venta_BO',NombreInputGroup:'div-VBO_Sub_Estado_Venta_BO'},
					{tipo_campo:'select',NombreCampo:'RBO_Cantidad_Ordenes_Ficha',NombreInputGroup:'div-RBO_Cantidad_Ordenes_Ficha'},
					{tipo_campo:'select',NombreCampo:'RBO_Orden_One_Click1',NombreInputGroup:'div-RBO_Orden_One_Click1'},
					{tipo_campo:'select',NombreCampo:'RBO_Orden_One_Click2',NombreInputGroup:'div-RBO_Orden_One_Click2'},
					{tipo_campo:'select',NombreCampo:'RBO_Orden_One_Click3',NombreInputGroup:'div-RBO_Orden_One_Click3'},
					{tipo_campo:'select',NombreCampo:'FBO_Ficha_Limpia',NombreInputGroup:'div-FBO_Ficha_Limpia'},
					{tipo_campo:'select',NombreCampo:'FBO_Errores_Comunes_Ficha',NombreInputGroup:'div-FBO_Errores_Comunes_Ficha'},
					{tipo_campo:'select',NombreCampo:'DGBO_Tipo_Atencion_Final',NombreInputGroup:'div-DGBO_Tipo_Atencion_Final'},
					{tipo_campo:'select',NombreCampo:'Comentarios_BackOffice',NombreInputGroup:'div-Comentarios_BackOffice'}
				
			
			];
			
			var Resultado="Completo";
			var campo_vacio=1;
			Campos.forEach(function(index) {
				
				var obligatorio=$("#"+index.NombreCampo).attr('obligatorio');
				var valor=$("#"+index.NombreCampo).val();
				var tipo_campo=index.tipo_campo;
				var NombreInputGroup=index.NombreInputGroup;


				if(obligatorio=="SI"){

					if(tipo_campo=='select' && valor==0){
						$("#"+NombreInputGroup).removeClass('has-success').removeClass('has-error').addClass('has-error');
						Resultado="Incompleto";
						if(campo_vacio==1){$("#"+index.NombreCampo).focus();}
						campo_vacio++;
					}

					if(tipo_campo=='textbox' && valor==""){
						$("#"+NombreInputGroup).removeClass('has-success').removeClass('has-error').addClass('has-error');
						Resultado="Incompleto";
						if(campo_vacio==1){$("#"+index.NombreCampo).focus();}
						campo_vacio++;
					}

				}
			});

			return Resultado;
	}

	function BloquearMultiRegistro(){
	


		/*INICIO Cargar SubCategorias*/
			const Campos = [					
					{tipo_campo:'textbox',NombreCampo:'DE_Telf_Llamada_Venta',NombreInputGroup:'div-DE_Telf_Llamada_Venta'},
					{tipo_campo:'select',NombreCampo:'DE_Base_Llamada',NombreInputGroup:'div-DE_Base_Llamada'},
					{tipo_campo:'select',NombreCampo:'DE_Campana_Netcall',NombreInputGroup:'div-DE_Campana_Netcall'},
					{tipo_campo:'select',NombreCampo:'DE_Sub_Campana',NombreInputGroup:'div-DE_Sub_Campana'},
					{tipo_campo:'select',NombreCampo:'DE_Detalle_Sub_Campana',NombreInputGroup:'div-DE_Detalle_Sub_Campana'},
					{tipo_campo:'select',NombreCampo:'DE_CF_Max_Linea_Movil',NombreInputGroup:'div-DE_CF_Max_Linea_Movil'},
					{tipo_campo:'select',NombreCampo:'DE_Tipo_Etiqueta',NombreInputGroup:'div-DE_Tipo_Etiqueta'},
					{tipo_campo:'textbox',NombreCampo:'DE_CF_Max_Linea_Pack',NombreInputGroup:'div-DE_CF_Max_Linea_Pack'},
					{tipo_campo:'textbox',NombreCampo:'DE_Monto_Disp_Finan_Equipos',NombreInputGroup:'div-DE_Monto_Disp_Finan_Equipos'},
					{tipo_campo:'select',NombreCampo:'DE_Cant_Meses_Finan_Equipos',NombreInputGroup:'div-DE_Cant_Meses_Finan_Equipos'},
					{tipo_campo:'select',NombreCampo:'DE_Cliente_Entel',NombreInputGroup:'div-DE_Cliente_Entel'},
					{tipo_campo:'select',NombreCampo:'DE_Cliente_Promo_Dscto',NombreInputGroup:'div-DE_Cliente_Promo_Dscto'},
					{tipo_campo:'select',NombreCampo:'DP_TipoDocumento',NombreInputGroup:'div-DP_TipoDocumento'},
					{tipo_campo:'textbox',NombreCampo:'DP_Documento',NombreInputGroup:'div-DP_Documento'},
					{tipo_campo:'textbox',NombreCampo:'DP_Nombre_Cliente',NombreInputGroup:'div-DP_Nombre_Cliente'},
					{tipo_campo:'textbox',NombreCampo:'DP_Apellido_Paterno',NombreInputGroup:'div-DP_Apellido_Paterno'},
					{tipo_campo:'textbox',NombreCampo:'DP_Apellido_Materno',NombreInputGroup:'div-DP_Apellido_Materno'},
					{tipo_campo:'textbox',NombreCampo:'DP_Nacionalidad',NombreInputGroup:'div-DP_Nacionalidad'},
					{tipo_campo:'textbox',NombreCampo:'DP_Lugar_Nacimiento',NombreInputGroup:'div-DP_Lugar_Nacimiento'},
					{tipo_campo:'textbox',NombreCampo:'DP_Fecha_Nacimiento',NombreInputGroup:'div-DP_Fecha_Nacimiento'},
					{tipo_campo:'textbox',NombreCampo:'DP_Nombre_Padre',NombreInputGroup:'div-DP_Nombre_Padre'},
					{tipo_campo:'textbox',NombreCampo:'DP_Nombre_Madre',NombreInputGroup:'div-DP_Nombre_Madre'},
					{tipo_campo:'textbox',NombreCampo:'DF_Email_Facturacion_Otros',NombreInputGroup:'div-DF_Email_Facturacion_Otros'},
					{tipo_campo:'select',NombreCampo:'DF_Dpto_Facturacion',NombreInputGroup:'div-DF_Dpto_Facturacion'},
					{tipo_campo:'select',NombreCampo:'DF_Prov_Facturacion',NombreInputGroup:'div-DF_Prov_Facturacion'},
					{tipo_campo:'select',NombreCampo:'DF_Dist_Facturacion',NombreInputGroup:'div-DF_Dist_Facturacion'},
					{tipo_campo:'textbox',NombreCampo:'DF_Domicilio_Facturacion',NombreInputGroup:'div-DF_Domicilio_Facturacion'},
					{tipo_campo:'select',NombreCampo:'RE_Tipo_Despacho',NombreInputGroup:'div-RE_Tipo_Despacho'},
					{tipo_campo:'select',NombreCampo:'RE_Rango_Entrega_Despacho',NombreInputGroup:'div-RE_Rango_Entrega_Despacho'},
					{tipo_campo:'select',NombreCampo:'RE_Rango_Horario_Despacho',NombreInputGroup:'div-RE_Rango_Horario_Despacho'},
					{tipo_campo:'select',NombreCampo:'RE_Tienda_Retiro',NombreInputGroup:'div-RE_Tienda_Retiro'},
					{tipo_campo:'select',NombreCampo:'RE_Retail_Retiro',NombreInputGroup:'div-RE_Retail_Retiro'},
					{tipo_campo:'select',NombreCampo:'RE_Fecha_Entrega',NombreInputGroup:'div-RE_Fecha_Entrega'},
					{tipo_campo:'select',NombreCampo:'RE_Venta_Entrega_para',NombreInputGroup:'div-RE_Venta_Entrega_para'},
					{tipo_campo:'select',NombreCampo:'RE_Venta_Destino_para',NombreInputGroup:'div-RE_Venta_Destino_para'},
					{tipo_campo:'select',NombreCampo:'RE_Dpto_Entrega_Producto',NombreInputGroup:'div-RE_Dpto_Entrega_Producto'},
					{tipo_campo:'select',NombreCampo:'RE_Prov_Entrega_Producto',NombreInputGroup:'div-RE_Prov_Entrega_Producto'},
					{tipo_campo:'select',NombreCampo:'RE_Dist_Entrega_Producto',NombreInputGroup:'div-RE_Dist_Entrega_Producto'},
					{tipo_campo:'select',NombreCampo:'RE_Tipo_Direccion_Entrega',NombreInputGroup:'div-RE_Tipo_Direccion_Entrega'},
					{tipo_campo:'textbox',NombreCampo:'RE_Direccion_Entrega',NombreInputGroup:'div-RE_Direccion_Entrega'},
					{tipo_campo:'textbox',NombreCampo:'RE_Referencia_Principales',NombreInputGroup:'div-RE_Referencia_Principales'},
					{tipo_campo:'textbox',NombreCampo:'RE_Referencias_Adicionales',NombreInputGroup:'div-RE_Referencias_Adicionales'},
					{tipo_campo:'textbox',NombreCampo:'RE_Coordenadas_Direccion_Entrega',NombreInputGroup:'div-RE_Coordenadas_Direccion_Entrega'},
					{tipo_campo:'textbox',NombreCampo:'RE_Telefono_Contacto1',NombreInputGroup:'div-RE_Telefono_Contacto1'},
					{tipo_campo:'textbox',NombreCampo:'RE_Telefono_Contacto2',NombreInputGroup:'div-RE_Telefono_Contacto2'},
					{tipo_campo:'select',NombreCampo:'RE_Tipo_Contacto_Ol',NombreInputGroup:'div-RE_Tipo_Contacto_Ol'},
					{tipo_campo:'select',NombreCampo:'RV_Tipo_Ofrecimiento',NombreInputGroup:'div-RV_Tipo_Ofrecimiento'},
					{tipo_campo:'select',NombreCampo:'Supervisor_Vendedor',NombreInputGroup:'div-Supervisor_Vendedor'}
				
			
			];
			
			var Resultado="Completo";
			var campo_vacio=1;
			Campos.forEach(function(index) {
				
				$("#"+index.NombreCampo).attr('disabled',true);
			
			});

			return Resultado;
	}	

	function ListarSubCategorias(idFrmCategoria,Categoria_id)
	{
	    $.ajax({
	      	type: "POST",
	      	url: 'index.php?c=Ficha_Venta&a=ListarSubCategoriasAjax',
	      	data:{
	      		Categoria_id:Categoria_id
	      	},
	      	//sync:false,        
	      	success: function(data) {
	        	//console.log(data);
	        	var html = "";
	        	//$(".listaProveedores").find("option").remove();                 
	        	$.each(data, function(index, value) { 
	          		html += '<option value="'+value.idSubCategoria+'" aplicar_logica="'+value.Aplicar_Logica+'">'+value.Nombre+'</option>';
	        	});                          
	        	$("#"+idFrmCategoria+"").append(html);                 
	      	},
	      	dataType: 'json'
	    });
  	}
  		function RellenarSelect_SubCategorias(data,idFrmCategoria)
	{

	        	var html = "";
	        	//$(".listaProveedores").find("option").remove();                 
	        	$.each(data, function(index, value) { 
	          		html += '<option value="'+value.idSubCategoria+'" aplicar_logica="'+value.Aplicar_Logica+'">'+value.Nombre+'</option>';
	        	});                          
	        	$("#"+idFrmCategoria+"").append(html);  
  	}


  	function ListarAllSubCategorias()
	{
		ListarDepartamentos("DF_Dpto_Facturacion");
		ListarDepartamentos("RE_Dpto_Entrega_Producto");
		ListarSupervisoresVenta("Supervisor_Vendedor");
	    $.ajax({
	      	type: "POST",
	      	url: 'index.php?c=SubCategoria&a=ListarSubCategoriasAjax',
	      	//sync:false,        
	      	success: function(data) {
	        	
	        	
	       	 
							/*INICIO Cargar SubCategorias*/
				const Categorias = [
					{idCategoria:1,NombreSelect:'DE_Base_Llamada'},
					{idCategoria:2,NombreSelect:'DE_Campana_Netcall'},
					{idCategoria:3,NombreSelect:'DE_Sub_Campana'},
					{idCategoria:4,NombreSelect:'DE_Detalle_Sub_Campana'},
					{idCategoria:5,NombreSelect:'DE_CF_Max_Linea_Movil'},
					{idCategoria:6,NombreSelect:'DE_Tipo_Etiqueta'},
					{idCategoria:7,NombreSelect:'DE_Cant_Meses_Finan_Equipos'},
					{idCategoria:8,NombreSelect:'DE_Cliente_Entel'},
					{idCategoria:9,NombreSelect:'DE_Cliente_Promo_Dscto'},
					{idCategoria:10,NombreSelect:'DP_TipoDocumento'},
					{idCategoria:11,NombreSelect:'RE_Tipo_Despacho'},
					{idCategoria:12,NombreSelect:'RE_Rango_Entrega_Despacho'},
					{idCategoria:13,NombreSelect:'RE_Rango_Horario_Despacho'},
					{idCategoria:14,NombreSelect:'RE_Tienda_Retiro'},
					{idCategoria:15,NombreSelect:'RE_Retail_Retiro'},
					{idCategoria:16,NombreSelect:'RE_Venta_Entrega_para'},
					{idCategoria:17,NombreSelect:'RE_Venta_Destino_para'},
					{idCategoria:18,NombreSelect:'RE_Tipo_Direccion_Entrega'},
					{idCategoria:19,NombreSelect:'RE_Tipo_Contacto_Ol'},
					{idCategoria:20,NombreSelect:'RV_Tipo_Ofrecimiento'},
					{idCategoria:21,NombreSelect:'RV_Tipo_Venta'},
					{idCategoria:22,NombreSelect:'RV_Operador_Cedente'},
					{idCategoria:23,NombreSelect:'RV_Origen'},
					{idCategoria:24,NombreSelect:'RV_Plan_Tarifario'},
					{idCategoria:25,NombreSelect:'RV_Cargo_Fijo_Plan'},
					{idCategoria:26,NombreSelect:'RV_Tipo_Producto'},
					{idCategoria:27,NombreSelect:'RV_Accesorio_Regalo'},
					{idCategoria:28,NombreSelect:'RV_Cant_Accesorios'},
					{idCategoria:29,NombreSelect:'RV_Tipo_Pago'},
					{idCategoria:30,NombreSelect:'RV_Promociones_Bancos'},
					{idCategoria:31,NombreSelect:'VBO_Estado_Venta_BO'},
					{idCategoria:32,NombreSelect:'VBO_Sub_Estado_Venta_BO'},
					{idCategoria:33,NombreSelect:'RBO_Cantidad_Ordenes_Ficha'},
					{idCategoria:34,NombreSelect:'FBO_Ficha_Limpia'},
					{idCategoria:35,NombreSelect:'FBO_Errores_Comunes_Ficha'},
					{idCategoria:36,NombreSelect:'DGBO_Tipo_Atencion_Final'},
				];

				
				Categorias.forEach(function(index,idCategoria,NombreSelect) {
					let FilterCat_id = data.filter(data => data.Categoria_id == index.idCategoria )
					RellenarSelect_SubCategorias(FilterCat_id,index.NombreSelect)
				});


				var idFicha_Venta=$("#idFicha_Venta").val();

				if(idFicha_Venta!=0){
					ConsultarxIdFicha_Venta(idFicha_Venta);
				}else{
					$(".loader-page").css({visibility:"hidden",opacity:"0"});
				}       
			        	               
	      	},
	      	dataType: 'json'
	    });

	    //let SubCategoria_FiltaraxId = SubCategorias.filter(SubCategorias => SubCategorias.Categoria_id == 11)

		
  	}



  	function limpiar_campos(){
  			$("#DP_Nombre_Cliente").val('');
			$("#DP_Apellido_Paterno").val('');
			$("#DP_Apellido_Materno").val('');
			$("#DP_Nacionalidad").val('');
			$("#DP_Lugar_Nacimiento").val('');
			$("#DP_Fecha_Nacimiento").val('');
			$("#DP_Nombre_Padre").val('');
			$("#DP_Nombre_Madre").val('');
			$("#DP_Edad_Actual").val('');
			$("#div-DP_Nombre_Cliente,#div-DP_Apellido_Paterno,#div-DP_Apellido_Materno,#div-DP_Nacionalidad,#div-DP_Lugar_Nacimiento,#div-DP_Fecha_Nacimiento,#div-DP_Nombre_Padre,#div-DP_Nombre_Madre").removeClass('has-success').addClass('has-error');
		
  	}

  	function campo_success(){
		$("#div-DP_Nombre_Cliente,#div-DP_Apellido_Paterno,#div-DP_Apellido_Materno,#div-DP_Nacionalidad,#div-DP_Lugar_Nacimiento,#div-DP_Fecha_Nacimiento,#div-DP_Nombre_Padre,#div-DP_Nombre_Madre").removeClass('has-error').addClass('has-success');
	}


  	function buscar_ClientexDocumento(DP_TipoDocumento,DP_Documento)
	{
	    $.ajax({
	      	type: "POST",
	      	url: 'index.php?c=Cliente&a=AjaxBuscarxDocumento',
	      	data:{
	      		TipoDocumento:DP_TipoDocumento,
	      		Documento:DP_Documento
	      	},
	      	//sync:false,        
	      	success: function(data) {
	      		
	      		if(data['Resultado']==true){
		      		$("#DP_Nombre_Cliente").val(data['Cliente']['Nombre_Cliente']);
					$("#DP_Apellido_Paterno").val(data['Cliente']['Apellido_Paterno']);
					$("#DP_Apellido_Materno").val(data['Cliente']['Apellido_Materno']);
					$("#DP_Nacionalidad").val(data['Cliente']['Nacionalidad']);
					$("#DP_Lugar_Nacimiento").val(data['Cliente']['Lugar_Nacimiento']);
					$("#DP_Fecha_Nacimiento").val(data['Cliente']['Fecha_Nacimiento']);
					$("#DP_Nombre_Padre").val(data['Cliente']['Nombre_Padre']);
					$("#DP_Nombre_Madre").val(data['Cliente']['Nombre_Madre']);	
	                var DiaActual = new Date();
	    			var DP_Fecha_Nacimiento = new Date(data['Cliente']['Fecha_Nacimiento']);
	    			var DP_Edad_Actual=calcular_diferencia_fechas(DP_Fecha_Nacimiento,DiaActual,'Year')
	    			$("#DP_Edad_Actual").val(DP_Edad_Actual);
	    			$("#span_cliente_nuevo").addClass('hide');
	    			campo_success();
    			}else{
    				$("#span_cliente_nuevo").removeClass('hide');
    				limpiar_campos();
    			}

	      	},
	      	dataType: 'json'
	    });
  	}

  	function calcular_diferencia_fechas(FechaInicio,FechaFin,Tipo){
  	
	  	var diff=0;
		if(Tipo=="Year"){
		  	var diff = FechaFin.getFullYear() - FechaInicio.getFullYear();
		    var m = FechaFin.getMonth() - FechaInicio.getMonth();
		    if (m < 0 || (m === 0 && FechaFin.getDate() < FechaInicio.getDate())){
		    	diff--;
		    }
	  	}else if(Tipo=="Days"){
	  		const diffInDays = Math.floor((FechaFin - FechaInicio) / (1000 * 60 * 60 * 24));
	  		diff=diffInDays+1;
	  	}

	  	return diff;
	}

	function ListarSubCategoriasxIds(idFrmCategoria,idSubCategoria)
	{
	    $.ajax({
	      	type: "POST",
	      	url: 'index.php?c=Ficha_Venta&a=ListarSubCategoriasxIds_Ajax',
	      	data:{
	      		idSubCategoria:idSubCategoria
	      	},
	      	//sync:false,        
	      	success: function(data) {
	        	//console.log(data);
	        	var html = "";
	        	$("#"+idFrmCategoria+"").find("option").remove();                 
	        	$.each(data, function(index, value) { 
	          		html += '<option value="'+value.idSubCategoria+'" aplicar_logica="'+value.Aplicar_Logica+'">'+value.Nombre+'</option>';
	        	});
	        	$("#"+idFrmCategoria+"").append('<option value="0">-- Seleccionar --</option>');                         
	        	$("#"+idFrmCategoria+"").append(html);                 
	      	},
	      	dataType: 'json'
	    });
  	}	

  	function ListarDepartamentos(idFrmDpto)
	{
	    $.ajax({
	      type: "POST",
	      url: 'index.php?c=Ficha_Venta&a=ListarDepartamentosAjax',        
	      success: function(data) {
	        //console.log(data);
	        var html = "";
	        //$(".listaProveedores").find("option").remove();                 
	        $.each(data, function(index, value) { 
	          html += '<option value="'+value.Cod_Dpto+'">'+value.Descripcion+'</option>';
	        });                          
	        $("#"+idFrmDpto+"").append(html);                 
	      },
	      dataType: 'json'
	    });
  	}

	function ListarSupervisoresVenta(idFrmCbo)
	{
	    $.ajax({
	      type: "POST",
	      url: 'index.php?c=Ficha_Venta&a=ListarSupervisoresVentaAjax',        
	      success: function(data) {
	        //console.log(data);
	        var html = "";
	        //$(".listaProveedores").find("option").remove();                 
	        $.each(data, function(index, value) { 
	          html += '<option value="'+value.idPersona+'">'+value.Cargo+' - '+value.NombreSupervisor+'</option>';
	        });                          
	        $("#"+idFrmCbo+"").append(html);                 
	      },
	      dataType: 'json'
	    });
	}
  	function ListarProvincias(dpto,idFrmProv){
	    $.ajax({
	      	type: "POST",
	      	url: 'index.php?c=Ficha_Venta&a=ListarProvinciasAjax',
	      	data:{
	      		Cod_Dpto:dpto
	      	},
	      	//sync:false,           
	      	success: function(data) {
	        	//console.log(data);
	          	var html = "";
	          	$("#"+idFrmProv+"").find("option").remove();                 
	          	$.each(data, function(index, value) { 
	            	html += '<option value="'+value.Cod_Prov+'">'+value.Descripcion+'</option>';
	          	});
	        	$("#"+idFrmProv+"").append('<option value="0">-- Seleccionar --</option>');           
	          	$("#"+idFrmProv+"").append(html);  
	        },
	      	dataType: 'json'
	  	});
	}

	function ListarDistritos(dpto,prov,idFrmDist){
    	$.ajax({
            type: "POST",
            url: 'index.php?c=Ficha_Venta&a=ListarDistritosAjax',
            data:{
              Cod_Dpto:dpto,
              Cod_Prov:prov              
            },
            //sync:false,           
            success: function(data) {
              //console.log(data);
                var html = "";
                $("#"+idFrmDist+"").find("option").remove();                 
                $.each(data, function(index, value) { 
                                                
                     html += '<option value="'+value.idUbigeo+'">'+value.Descripcion+'</option>';

                });      
                $("#"+idFrmDist+"").append('<option value="0">-- Seleccionar --</option>');    
                $("#"+idFrmDist+"").append(html);  
               
            },
            dataType: 'json'

        });

	}

	function ConsultarxIdFicha_Venta(idFicha_Venta){
    	$.ajax({
            type: "POST",
            url: 'index.php?c=Ficha_Venta&a=ConsultarxIdFicha_Venta',
            data:{
              idFicha_Venta:idFicha_Venta             
            },
            //sync:false,           
            success: function(data) {
              //console.log(data);
             	$("#DE_Telf_Llamada_Venta").val(data['DE_Telf_Llamada_Venta']);
				$("#DE_Base_Llamada").val(data['DE_Base_Llamada']);
				$("#DE_Campana_Netcall").val(data['DE_Campana_Netcall']);
				$("#DE_Sub_Campana").val(data['DE_Sub_Campana']);
				$("#DE_Detalle_Sub_Campana").val(data['DE_Detalle_Sub_Campana']);
				$("#DE_CF_Max_Linea_Movil").val(data['DE_CF_Max_Linea_Movil']);
				$("#DE_Tipo_Etiqueta").val(data['DE_Tipo_Etiqueta']);
				$("#DE_CF_Max_Linea_Pack").val(data['DE_CF_Max_Linea_Pack']);
				$("#DE_Monto_Disp_Finan_Equipos").val(data['DE_Monto_Disp_Finan_Equipos']);
				$("#DE_Cant_Meses_Finan_Equipos").val(data['DE_Cant_Meses_Finan_Equipos']);
				$("#DE_Cliente_Entel").val(data['DE_Cliente_Entel']);
				$("#DE_Cliente_Promo_Dscto").val(data['DE_Cliente_Promo_Dscto']);
				$("#DP_TipoDocumento").val(data['TipoDocumento']);
				$("#DP_Documento").val(data['Documento']);
				$("#DP_Nombre_Cliente").val(data['Nombre_Cliente']);
				$("#DP_Apellido_Paterno").val(data['Apellido_Paterno']);
				$("#DP_Apellido_Materno").val(data['Apellido_Materno']);
				$("#DP_Nacionalidad").val(data['Nacionalidad']);
				$("#DP_Lugar_Nacimiento").val(data['Lugar_Nacimiento']);
				$("#DP_Fecha_Nacimiento").val(data['Fecha_Nacimiento']);
				$("#DP_Nombre_Padre").val(data['Nombre_Padre']);
				$("#DP_Nombre_Madre").val(data['Nombre_Madre']);
				$("#DF_Email_Facturacion_Otros").val(data['DF_Email_Facturacion_Otros']);

				
				let  Cod_Dist_Fact=data['DF_Ubigeo_Facturacion'];

				if(Cod_Dist_Fact.length==5){Cod_Dist_Fact="0"+Cod_Dist_Fact;}
				let Cod_Dpto_Fact=Cod_Dist_Fact.substr(0,2);
				let Cod_Prov_Fact=Cod_Dist_Fact.substr(0,4);			
				
				ListarProvincias(Cod_Dpto_Fact,"DF_Prov_Facturacion");
				ListarDistritos(Cod_Dpto_Fact,Cod_Prov_Fact,"DF_Dist_Facturacion");
				

				$("#DF_Domicilio_Facturacion").val(data['DF_Domicilio_Facturacion']);
				/*Fin 5.- Registro para Entrega*/
				$("#RE_Tipo_Despacho").val(data['RE_Tipo_Despacho']).trigger('change');
				setTimeout(function () {
				 
				 $("#RE_Rango_Entrega_Despacho").val(data['RE_Rango_Entrega_Despacho']).trigger('change');
				 
				 setTimeout(function () {
					 
				 	$("#RE_Rango_Horario_Despacho").val(data['RE_Rango_Horario_Despacho']).trigger('change');
				 		setTimeout(function () {
							 
					 		$("#RE_Tienda_Retiro").val(data['RE_Tienda_Retiro']);
							$("#RE_Retail_Retiro").val(data['RE_Retail_Retiro']);
							$("#RE_Venta_Entrega_para").val(data['RE_Venta_Entrega_para']);
							$("#RE_Venta_Destino_para").val(data['RE_Venta_Destino_para']);
								setTimeout(function () {
									$("#RE_Tipo_Direccion_Entrega").val(data['RE_Tipo_Direccion_Entrega']);
									$("#RE_Direccion_Entrega").val(data['RE_Direccion_Entrega']);
									$("#RE_Referencia_Principales").val(data['RE_Referencia_Principales']);
									$("#RE_Referencias_Adicionales").val(data['RE_Referencias_Adicionales']);
									$("#RE_Coordenadas_Direccion_Entrega").val(data['RE_Coordenadas_Direccion_Entrega']);
									$("#RE_Telefono_Contacto1").val(data['RE_Telefono_Contacto1']);
									$("#RE_Telefono_Contacto2").val(data['RE_Telefono_Contacto2']);
									$("#RE_Tipo_Contacto_Ol").val(data['RE_Tipo_Contacto_Ol']);
									$("#RE_Fecha_Entrega").val(data['RE_Fecha_Entrega']);
									var DiaRegistroVenta = new Date($("#Fecha_Registro_Vendedor").val());
					    			var RE_Fecha_Entrega = new Date(data['RE_Fecha_Entrega']);
					    			var RE_SLA_Entrega=calcular_diferencia_fechas(DiaRegistroVenta,RE_Fecha_Entrega,'Days');
					    			$("#RE_SLA_Entrega").val(RE_SLA_Entrega);					    			
							}, 2000);
						}, 2000);
					}, 2000);

				}, 4000);


				
				let  Cod_Dist_Ent=data['RE_Ubigeo_Entrega'];

				if(Cod_Dist_Ent.length==5){Cod_Dist_Ent="0"+Cod_Dist_Ent;}
				let Cod_Dpto_Ent=Cod_Dist_Ent.substr(0,2);
				let Cod_Prov_Ent=Cod_Dist_Ent.substr(0,4);				
				ListarProvincias(Cod_Dpto_Ent,"RE_Prov_Entrega_Producto");
				ListarDistritos(Cod_Dpto_Ent,Cod_Prov_Ent,"RE_Dist_Entrega_Producto");




				/*Fin 5.- Registro para Entrega*/

				/*INICIO 3.- Registro de Venta*/
				$("#RV_Tipo_Ofrecimiento").val(data['RV_Tipo_Ofrecimiento']);
				$("#RV_Tipo_Venta").val(data['RV_Tipo_Venta']).trigger('change');
				setTimeout(function () {
				 	
					$("#RV_Plan_Tarifario").val(data['RV_Plan_Tarifario']).trigger('change');
					setTimeout(function () {
						$("#RV_Operador_Cedente").val(data['RV_Operador_Cedente']);
						$("#RV_Origen").val(data['RV_Origen']);
						$("#RV_Linea_Portar").val(data['RV_Linea_Portar']).trigger('change');
				 		$("#RV_Cargo_Fijo_Plan").val(data['RV_Cargo_Fijo_Plan']);
				 		$("#RV_Tipo_Producto").val(data['RV_Tipo_Producto']).trigger('change');
						$("#RV_Accesorio_Regalo").val(data['RV_Accesorio_Regalo']).trigger('change');
						$("#RV_SKU_Accesorio_Regalo1").val(data['RV_SKU_Accesorio_Regalo1']);
						$("#RV_SKU_Accesorio_Regalo2").val(data['RV_SKU_Accesorio_Regalo2']);
						$("#RV_SKU_Pack").val(data['RV_SKU_Pack']);
						$("#RV_Precio_Equipo_Inicial_Total").val(data['RV_Precio_Equipo_Inicial_Total']);
						$("#RV_Cuota_Equipo_Mensual").val(data['RV_Cuota_Equipo_Mensual']);
						$("#RV_Cant_Accesorios").val(data['RV_Cant_Accesorios']).trigger('change');
						$("#RV_SKU_Accesorio1").val(data['RV_SKU_Accesorio1']);
						$("#RV_Precio_Accesorio1").val(data['RV_Precio_Accesorio1']);
						$("#RV_SKU_Accesorio2").val(data['RV_SKU_Accesorio2']);
						$("#RV_Precio_Accesorio2").val(data['RV_Precio_Accesorio2']);
						$("#RV_SKU_Accesorio3").val(data['RV_SKU_Accesorio3']);
						$("#RV_Precio_Accesorio3").val(data['RV_Precio_Accesorio3']);
						$("#RV_SKU_Accesorio4").val(data['RV_SKU_Accesorio4']);
						$("#RV_Precio_Accesorio4").val(data['RV_Precio_Accesorio4']);
						$("#RV_SKU_Accesorio5").val(data['RV_SKU_Accesorio5']);
						$("#RV_Precio_Accesorio5").val(data['RV_Precio_Accesorio5']);
						$("#RV_Tipo_Pago").val(data['RV_Tipo_Pago']).trigger('change');
						$("#RV_Promociones_Bancos").val(data['RV_Promociones_Bancos']);

					}, 2000);
					

				}, 1000);

		
				/*INICIO 3.- Registro de Venta*/


				$("#Supervisor_Vendedor").val(data['Supervisor_Vendedor']).trigger('change');
				$("#Comentarios_Vendedor").val(data['Comentarios_Vendedor']).trigger('change');
				$("#Ingresado_por_Vendedor").attr("idVendedor",data['Ingresado_por_Vendedor']);
				$("#Ingresado_por_Vendedor").val(data['Documento_Vendedor']+" - "+data['Nombre_Vendedor']);
				$("#Fecha_Registro_Vendedor").val(data['Fecha_Registro_Vendedor']).trigger('change');
				$("#VBO_Estado_Venta_BO").val(data['VBO_Estado_Venta_BO']).trigger('change');

				$("#VBO_Sub_Estado_Venta_BO").val(data['VBO_Sub_Estado_Venta_BO']).trigger('change');
				$("#RBO_Cantidad_Ordenes_Ficha").val(data['RBO_Cantidad_Ordenes_Ficha']).trigger('change');
				$("#RBO_Orden_One_Click1").val(data['RBO_Orden_One_Click1']).trigger('change');
				$("#RBO_Orden_One_Click2").val(data['RBO_Orden_One_Click2']).trigger('change');
				$("#RBO_Orden_One_Click3").val(data['RBO_Orden_One_Click3']).trigger('change');
				$("#FBO_Ficha_Limpia").val(data['FBO_Ficha_Limpia']).trigger('change');
				$("#FBO_Errores_Comunes_Ficha").val(data['FBO_Errores_Comunes_Ficha']).trigger('change');
				$("#DGBO_Tipo_Atencion_Final").val(data['DGBO_Tipo_Atencion_Final']).trigger('change');
				$("#idFicha_Venta").attr('DGBO_BO_Validador_Gestor',data['DGBO_BO_Validador_Gestor']);
				$("#idFicha_Venta").attr('DGBO_BO_Recupero_Repro_Gestor',data['DGBO_BO_Recupero_Repro_Gestor']);
				$("#Comentarios_BackOffice").val(data['Comentarios_BackOffice']).trigger('change');
            	$(".loader-page").css({visibility:"hidden",opacity:"0"})
               	var DiaActual = new Date();
    			var DP_Fecha_Nacimiento = new Date(data['Fecha_Nacimiento']);
    			var DP_Edad_Actual=calcular_diferencia_fechas(DP_Fecha_Nacimiento,DiaActual,'Year');
    			$("#DP_Edad_Actual").val(DP_Edad_Actual);

    

    			setTimeout(function() {
					$("#DF_Dpto_Facturacion").val(Cod_Dpto_Fact);
					$("#DF_Prov_Facturacion").val(Cod_Prov_Fact);
					$("#DF_Dist_Facturacion").val(data['DF_Ubigeo_Facturacion']);

					$("#RE_Dpto_Entrega_Producto").val(Cod_Dpto_Ent);
					$("#RE_Prov_Entrega_Producto").val(Cod_Prov_Ent);
					$("#RE_Dist_Entrega_Producto").val(data['RE_Ubigeo_Entrega']);
				}, 3000);
         	
    			

            },
            dataType: 'json'

        });

	}
 
 


	function ConsultarSubCategoria(idSubCategoria, NomVariable,NumAccion,NomAccion ){
	 
    	 m = $.ajax({
            type: "POST",
            url: 'index.php?c=Ficha_Venta&a=ConsultarSubCategoria',
            data:{
				idSubCategoria:idSubCategoria,
				NomVariable:NomVariable, 
				NumAccion:NumAccion,
				NomAccion:NomAccion
            },
			dataType: "json",
			async: false,           
            success: function(response) {
              
			   
			     valor =  response   ;
			     
			   
            } 
             
 
        } ) ;
		return readData(valor);

	} 
	function readData(data) {
     //   console.log(data)
        return data;
    }
	 


	$(document).ready(function() {

		/*INICIO Cargar SubCategorias*/
		ListarAllSubCategorias();


		/*FIN Cargar Sub Categorias*/

		/*INICIO APLICAR LOGICA DE FILTROS*/
		var LogicaRE = 
			{
				36:{
					NroAcciones:4,
					Acciones:{
						1:{
							Accion:'Filtrar_Items',
							Tipo:'Select',
							Nombre:'RE_Rango_Entrega_Despacho',
							ItemsFilter:'42,43,44,45'
						},
						2:{
							Accion:'Filtrar_Items',
							Tipo:'Select',
							Nombre:'RE_Venta_Entrega_para',
							ItemsFilter:'63,64,65'
						},
						3:{
							Accion:'Filtrar_Items',
							Tipo:'Select',
							Nombre:'RE_Venta_Destino_para',
							ItemsFilter:'67'
						},
						4:{	
							Accion:'Mostrar_Campos',
							Ocultar:'RE_Tienda_Retiro,RE_Retail_Retiro',
							Mostrar:'RE_Rango_Entrega_Despacho,RE_Rango_Horario_Despacho,RE_Venta_Entrega_para,RE_Venta_Destino_para,RE_Tipo_Direccion_Entrega,RE_Direccion_Entrega,RE_Referencia_Principales,RE_Referencias_Adicionales,RE_Coordenadas_Direccion_Entrega,RE_Coordenadas_Direccion_Entrega,RE_Tipo_Contacto_Ol'
						}
					},
					RE_Rango_Entrega_Despacho:{
						42:{
							Nombre:'RE_Rango_Horario_Despacho',
							ItemsFilter:'48'
						},
						43:{
							Nombre:'RE_Rango_Horario_Despacho',
							ItemsFilter:'50,52,53,54,55,56'
						},
						44:{
							Nombre:'RE_Rango_Horario_Despacho',
							ItemsFilter:'57'
						},
						45:{
							Nombre:'RE_Rango_Horario_Despacho',
							ItemsFilter:'58'
						}
					}
				},
				37:{
					NroAcciones:4,
					Acciones:{
						1:{
							Accion:'Filtrar_Items',
							Tipo:'Select',
							Nombre:'RE_Rango_Entrega_Despacho',
							ItemsFilter:'42,43,44,45'
						},
						2:{
							Accion:'Filtrar_Items',
							Tipo:'Select',
							Nombre:'RE_Venta_Entrega_para',
							ItemsFilter:'63,64,65'
						},
						3:{
							Accion:'Filtrar_Items',
							Tipo:'Select',
							Nombre:'RE_Venta_Destino_para',
							ItemsFilter:'68'
						},						
						4:{	
							Accion:'Mostrar_Campos',
							Ocultar:'RE_Tienda_Retiro,RE_Retail_Retiro',
							Mostrar:'RE_Rango_Entrega_Despacho,RE_Rango_Horario_Despacho,RE_Venta_Entrega_para,RE_Venta_Destino_para,RE_Tipo_Direccion_Entrega,RE_Direccion_Entrega,RE_Referencia_Principales,RE_Referencias_Adicionales,RE_Coordenadas_Direccion_Entrega,RE_Coordenadas_Direccion_Entrega,RE_Tipo_Contacto_Ol'
						}
					},
					RE_Rango_Entrega_Despacho:{
						42:{
							Nombre:'RE_Rango_Horario_Despacho',
							ItemsFilter:'49'
						},
						43:{
							Nombre:'RE_Rango_Horario_Despacho',
							ItemsFilter:'51'
						},
						44:{
							Nombre:'RE_Rango_Horario_Despacho',
							ItemsFilter:'57'
						},
						45:{
							Nombre:'RE_Rango_Horario_Despacho',
							ItemsFilter:'59'
						}
					}
				},
				38:{
					NroAcciones:4,
					Acciones:{
						1:{
							Accion:'Filtrar_Items',
							Tipo:'Select',
							Nombre:'RE_Rango_Entrega_Despacho',
							ItemsFilter:'42,45'
						},
						2:{
							Accion:'Filtrar_Items',
							Tipo:'Select',
							Nombre:'RE_Venta_Entrega_para',
							ItemsFilter:'63,64'
						},
						3:{
							Accion:'Filtrar_Items',
							Tipo:'Select',
							Nombre:'RE_Venta_Destino_para',
							ItemsFilter:'68'
						},						
						4:{	
							Accion:'Mostrar_Campos',
							Ocultar:'RE_Tienda_Retiro,RE_Retail_Retiro',
							Mostrar:'RE_Rango_Entrega_Despacho,RE_Rango_Horario_Despacho,RE_Venta_Entrega_para,RE_Venta_Destino_para,RE_Tipo_Direccion_Entrega,RE_Direccion_Entrega,RE_Referencia_Principales,RE_Referencias_Adicionales,RE_Coordenadas_Direccion_Entrega,RE_Coordenadas_Direccion_Entrega,RE_Tipo_Contacto_Ol'
						}
					},
					RE_Rango_Entrega_Despacho:{
						42:{
							Nombre:'RE_Rango_Horario_Despacho',
							ItemsFilter:'61'
						},
						45:{
							Nombre:'RE_Rango_Horario_Despacho',
							ItemsFilter:'60'
						}
					}
				},
				39:{
					NroAcciones:4,
					Acciones:{
						1:{
							Accion:'Filtrar_Items',
							Tipo:'Select',
							Nombre:'RE_Rango_Entrega_Despacho',
							ItemsFilter:'45'
						},
						2:{
							Accion:'Filtrar_Items',
							Tipo:'Select',
							Nombre:'RE_Venta_Entrega_para',
							ItemsFilter:'63,64'
						},
						3:{
							Accion:'Filtrar_Items',
							Tipo:'Select',
							Nombre:'RE_Venta_Destino_para',
							ItemsFilter:'67'
						},						
						4:{	
							Accion:'Mostrar_Campos',
							Ocultar:'RE_Tienda_Retiro,RE_Retail_Retiro',
							Mostrar:'RE_Rango_Entrega_Despacho,RE_Rango_Horario_Despacho,RE_Venta_Entrega_para,RE_Venta_Destino_para,RE_Tipo_Direccion_Entrega,RE_Direccion_Entrega,RE_Referencia_Principales,RE_Referencias_Adicionales,RE_Coordenadas_Direccion_Entrega,RE_Coordenadas_Direccion_Entrega,RE_Tipo_Contacto_Ol'
						}
					},
					RE_Rango_Entrega_Despacho:{
						42:{
							Nombre:'RE_Rango_Horario_Despacho',
							ItemsFilter:'61'
						},
						45:{
							Nombre:'RE_Rango_Horario_Despacho',
							ItemsFilter:'60'
						}
					}
				},
				40:{
					NroAcciones:4,
					Acciones:{
						1:{
							Accion:'Filtrar_Items',
							Tipo:'Select',
							Nombre:'RE_Rango_Entrega_Despacho',
							ItemsFilter:'46'
						},
						2:{
							Accion:'Filtrar_Items',
							Tipo:'Select',
							Nombre:'RE_Venta_Entrega_para',
							ItemsFilter:'66'
						},
						3:{
							Accion:'Filtrar_Items',
							Tipo:'Select',
							Nombre:'RE_Venta_Destino_para',
							ItemsFilter:'67,68'
						},
						4:{	
							Accion:'Mostrar_Campos',
							Ocultar:'RE_Retail_Retiro,RE_Tipo_Direccion_Entrega,RE_Referencia_Principales,RE_Referencias_Adicionales,RE_Coordenadas_Direccion_Entrega,RE_Coordenadas_Direccion_Entrega,RE_Tipo_Contacto_Ol',
							Mostrar:'RE_Rango_Entrega_Despacho,RE_Rango_Horario_Despacho,RE_Tienda_Retiro,RE_Venta_Entrega_para,RE_Venta_Destino_para,RE_Direccion_Entrega'
						}
					},
					RE_Rango_Entrega_Despacho:{
						46:{
							Nombre:'RE_Rango_Horario_Despacho',
							ItemsFilter:'62'
						}
					}
				},
				41:{
					NroAcciones:4,
					Acciones:{
						1:{
							Accion:'Filtrar_Items',
							Tipo:'Select',
							Nombre:'RE_Rango_Entrega_Despacho',
							ItemsFilter:'47'
						},
						2:{
							Accion:'Filtrar_Items',
							Tipo:'Select',
							Nombre:'RE_Venta_Entrega_para',
							ItemsFilter:'66'
						},
						3:{
							Accion:'Filtrar_Items',
							Tipo:'Select',
							Nombre:'RE_Venta_Destino_para',
							ItemsFilter:'67,68'
						},
						4:{	
							Accion:'Mostrar_Campos',
							Ocultar:'RE_Tienda_Retiro,RE_Tipo_Direccion_Entrega,RE_Referencia_Principales,RE_Referencias_Adicionales,RE_Coordenadas_Direccion_Entrega,RE_Coordenadas_Direccion_Entrega,RE_Tipo_Contacto_Ol',
							Mostrar:'RE_Rango_Entrega_Despacho,RE_Rango_Horario_Despacho,RE_Retail_Retiro,RE_Venta_Entrega_para,RE_Venta_Destino_para,RE_Direccion_Entrega'
						}
					},
					RE_Rango_Entrega_Despacho:{
						47:{
							Nombre:'RE_Rango_Horario_Despacho',
							ItemsFilter:'62'
						}
					}
				},
				42:{
					NroAcciones:1,
					Acciones:{
						1:{
							Accion:'Filtro_Superior',
							Nombre:'RE_Tipo_Despacho',
							Nombre_Key:'RE_Rango_Entrega_Despacho'
						}
						
					}					
				},
				43:{
					NroAcciones:1,
					Acciones:{
						1:{
							Accion:'Filtro_Superior',
							Nombre:'RE_Tipo_Despacho',
							Nombre_Key:'RE_Rango_Entrega_Despacho'
						}
						
					}					
				},
				44:{
					NroAcciones:1,
					Acciones:{
						1:{
							Accion:'Filtro_Superior',
							Nombre:'RE_Tipo_Despacho',
							Nombre_Key:'RE_Rango_Entrega_Despacho'
						}
						
					}					
				},
				45:{
					NroAcciones:1,
					Acciones:{
						1:{
							Accion:'Filtro_Superior',
							Nombre:'RE_Tipo_Despacho',
							Nombre_Key:'RE_Rango_Entrega_Despacho'
						}
						
					}					
				},
				46:{
					NroAcciones:1,
					Acciones:{
						1:{
							Accion:'Filtro_Superior',
							Nombre:'RE_Tipo_Despacho',
							Nombre_Key:'RE_Rango_Entrega_Despacho'
						}
						
					}					
				},
				47:{
					NroAcciones:1,
					Acciones:{
						1:{
							Accion:'Filtro_Superior',
							Nombre:'RE_Tipo_Despacho',
							Nombre_Key:'RE_Rango_Entrega_Despacho'
						}
						
					}					
				},
				79:{
					NroAcciones:1,
					Acciones:{
						1:{
							Accion:'MultiRegistro',
							NroRegistrosPermitidos:1
						}
					}
				},
				80:{
					NroAcciones:1,
					Acciones:{
						1:{
							Accion:'MultiRegistro',
							NroRegistrosPermitidos:2
						}
					}
				},
				81:{
					NroAcciones:1,
					Acciones:{
						1:{
							Accion:'MultiRegistro',
							NroRegistrosPermitidos:3
						}
					}
				},
				82:{
					NroAcciones:3,
					Acciones:{
						1:{
							Accion:'Filtrar_Items',
							Tipo:'Select',
							Nombre:'RV_Operador_Cedente',
							ItemsFilter:'85,86,87,88'
						},
						2:{
							Accion:'Filtrar_Items',
							Tipo:'Select',
							Nombre:'RV_Tipo_Producto',
							ItemsFilter:'122,123,125,126,127,128,129,130,131,132,133,134,135,136'
						},
						3:{	
							Accion:'Mostrar_Campos',
							Ocultar:'',
							Mostrar:'RV_Operador_Cedente,RV_Origen,RV_Linea_Portar,RV_Plan_Tarifario,RV_Cargo_Fijo_Plan,RV_Tipo_Producto'
						}
					}
				},
				83:{
					NroAcciones:2,
					Acciones:{
						1:{
							Accion:'Filtrar_Items',
							Tipo:'Select',
							Nombre:'RV_Tipo_Producto',
							ItemsFilter:'122,123,125,126,127,128,129,130,131,132,133,134,135,136'
						},
						2:{	
							Accion:'Mostrar_Campos',
							Ocultar:'RV_Operador_Cedente,RV_Origen,RV_Linea_Portar',
							Mostrar:'RV_Plan_Tarifario,RV_Cargo_Fijo_Plan,RV_Tipo_Producto'
						}
					}
				},
				84:{
					NroAcciones:2,
					Acciones:{
						1:{
							Accion:'Filtrar_Items',
							Tipo:'Select',
							Nombre:'RV_Tipo_Producto',
							ItemsFilter:'124'
						},
						2:{	
							Accion:'Mostrar_Campos',
							Ocultar:'RV_Operador_Cedente,RV_Origen,RV_Linea_Portar,RV_Plan_Tarifario,RV_Cargo_Fijo_Plan',
							Mostrar:'RV_Tipo_Producto'
						}
					}
				},
				91:{
					NroAcciones:1,
					Acciones:{
						1:{
							Accion:'Filtrar_Items',
							Tipo:'Select',
							Nombre:'RV_Cargo_Fijo_Plan',
							ItemsFilter:'111'
						}
					}
				},
				92:{
					NroAcciones:1,
					Acciones:{
						1:{
							Accion:'Filtrar_Items',
							Tipo:'Select',
							Nombre:'RV_Cargo_Fijo_Plan',
							ItemsFilter:'112'
						}
					}
				},
				93:{
					NroAcciones:1,
					Acciones:{
						1:{
							Accion:'Filtrar_Items',
							Tipo:'Select',
							Nombre:'RV_Cargo_Fijo_Plan',
							ItemsFilter:'113'
						}
					}
				},
				94:{
					NroAcciones:1,
					Acciones:{
						1:{
							Accion:'Filtrar_Items',
							Tipo:'Select',
							Nombre:'RV_Cargo_Fijo_Plan',
							ItemsFilter:'114'
						}
					}
				},
				95:{
					NroAcciones:1,
					Acciones:{
						1:{
							Accion:'Filtrar_Items',
							Tipo:'Select',
							Nombre:'RV_Cargo_Fijo_Plan',
							ItemsFilter:'115'
						}
					}
				},
				96:{
					NroAcciones:1,
					Acciones:{
						1:{
							Accion:'Filtrar_Items',
							Tipo:'Select',
							Nombre:'RV_Cargo_Fijo_Plan',
							ItemsFilter:'116'
						}
					}
				},
				97:{
					NroAcciones:1,
					Acciones:{
						1:{
							Accion:'Filtrar_Items',
							Tipo:'Select',
							Nombre:'RV_Cargo_Fijo_Plan',
							ItemsFilter:'117'
						}
					}
				},
				98:{
					NroAcciones:1,
					Acciones:{
						1:{
							Accion:'Filtrar_Items',
							Tipo:'Select',
							Nombre:'RV_Cargo_Fijo_Plan',
							ItemsFilter:'118'
						}
					}
				},
				99:{
					NroAcciones:1,
					Acciones:{
						1:{
							Accion:'Filtrar_Items',
							Tipo:'Select',
							Nombre:'RV_Cargo_Fijo_Plan',
							ItemsFilter:'119'
						}
					}
				},
				100:{
					NroAcciones:1,
					Acciones:{
						1:{
							Accion:'Filtrar_Items',
							Tipo:'Select',
							Nombre:'RV_Cargo_Fijo_Plan',
							ItemsFilter:'120'
						}
					}
				},
				101:{
					NroAcciones:1,
					Acciones:{
						1:{
							Accion:'Filtrar_Items',
							Tipo:'Select',
							Nombre:'RV_Cargo_Fijo_Plan',
							ItemsFilter:'112'
						}
					}
				},
				102:{
					NroAcciones:1,
					Acciones:{
						1:{
							Accion:'Filtrar_Items',
							Tipo:'Select',
							Nombre:'RV_Cargo_Fijo_Plan',
							ItemsFilter:'113'
						}
					}
				},
				103:{
					NroAcciones:1,
					Acciones:{
						1:{
							Accion:'Filtrar_Items',
							Tipo:'Select',
							Nombre:'RV_Cargo_Fijo_Plan',
							ItemsFilter:'114'
						}
					}
				},
				104:{
					NroAcciones:1,
					Acciones:{
						1:{
							Accion:'Filtrar_Items',
							Tipo:'Select',
							Nombre:'RV_Cargo_Fijo_Plan',
							ItemsFilter:'115'
						}
					}
				},
				105:{
					NroAcciones:1,
					Acciones:{
						1:{
							Accion:'Filtrar_Items',
							Tipo:'Select',
							Nombre:'RV_Cargo_Fijo_Plan',
							ItemsFilter:'116'
						}
					}
				},
				106:{
					NroAcciones:1,
					Acciones:{
						1:{
							Accion:'Filtrar_Items',
							Tipo:'Select',
							Nombre:'RV_Cargo_Fijo_Plan',
							ItemsFilter:'117'
						}
					}
				},
				107:{
					NroAcciones:1,
					Acciones:{
						1:{
							Accion:'Filtrar_Items',
							Tipo:'Select',
							Nombre:'RV_Cargo_Fijo_Plan',
							ItemsFilter:'118'
						}
					}
				},
				108:{
					NroAcciones:1,
					Acciones:{
						1:{
							Accion:'Filtrar_Items',
							Tipo:'Select',
							Nombre:'RV_Cargo_Fijo_Plan',
							ItemsFilter:'119'
						}
					}
				},
				109:{
					NroAcciones:1,
					Acciones:{
						1:{
							Accion:'Filtrar_Items',
							Tipo:'Select',
							Nombre:'RV_Cargo_Fijo_Plan',
							ItemsFilter:'120'
						}
					}
				},
				110:{
					NroAcciones:1,
					Acciones:{
						1:{
							Accion:'Filtrar_Items',
							Tipo:'Select',
							Nombre:'RV_Cargo_Fijo_Plan',
							ItemsFilter:'121'
						}
					}
				},
				137:{
					NroAcciones:1,
					Acciones:{
						1:{	
							Accion:'Mostrar_Campos',
							Ocultar:'',
							Mostrar:'RV_SKU_Accesorio_Regalo1,RV_SKU_Accesorio_Regalo2'
						}
					}
				},
				138:{
					NroAcciones:1,
					Acciones:{
						1:{	
							Accion:'Mostrar_Campos',
							Ocultar:'RV_SKU_Accesorio_Regalo1,RV_SKU_Accesorio_Regalo2',
							Mostrar:''
						}
					}
				},
				122:{
					NroAcciones:1,
					Acciones:{
						1:{	
							Accion:'Mostrar_Campos',
							Ocultar:'RV_SKU_Pack,RV_Precio_Equipo_Inicial_Total,RV_Cuota_Equipo_Mensual,RV_Cant_Accesorios,RV_SKU_Accesorio1,RV_Precio_Accesorio1,RV_SKU_Accesorio2,RV_Precio_Accesorio2,RV_SKU_Accesorio3,RV_Precio_Accesorio3,RV_SKU_Accesorio4,RV_Precio_Accesorio4,RV_SKU_Accesorio5,RV_Precio_Accesorio5',
							Mostrar:''
						}
					}
				},
				123:{
					NroAcciones:1,
					Acciones:{
						1:{	
							Accion:'Mostrar_Campos',
							Ocultar:'RV_SKU_Pack,RV_Precio_Equipo_Inicial_Total,RV_Cuota_Equipo_Mensual',
							Mostrar:'RV_Cant_Accesorios,RV_SKU_Accesorio1,RV_Precio_Accesorio1,RV_SKU_Accesorio2,RV_Precio_Accesorio2,RV_SKU_Accesorio3,RV_Precio_Accesorio3,RV_SKU_Accesorio4,RV_Precio_Accesorio4,RV_SKU_Accesorio5,RV_Precio_Accesorio5'
						}
					}
				},
				124:{
					NroAcciones:1,
					Acciones:{
						1:{	
							Accion:'Mostrar_Campos',
							Ocultar:'RV_SKU_Pack,RV_Precio_Equipo_Inicial_Total,RV_Cuota_Equipo_Mensual',
							Mostrar:'RV_Cant_Accesorios,RV_SKU_Accesorio1,RV_Precio_Accesorio1,RV_SKU_Accesorio2,RV_Precio_Accesorio2,RV_SKU_Accesorio3,RV_Precio_Accesorio3,RV_SKU_Accesorio4,RV_Precio_Accesorio4,RV_SKU_Accesorio5,RV_Precio_Accesorio5'
						}
					}
				},
				125:{
					NroAcciones:1,
					Acciones:{
						1:{	
							Accion:'Mostrar_Campos',
							Ocultar:'RV_Cant_Accesorios,RV_SKU_Accesorio1,RV_Precio_Accesorio1,RV_SKU_Accesorio2,RV_Precio_Accesorio2,RV_SKU_Accesorio3,RV_Precio_Accesorio3,RV_SKU_Accesorio4,RV_Precio_Accesorio4,RV_SKU_Accesorio5,RV_Precio_Accesorio5',
							Mostrar:'RV_SKU_Pack,RV_Precio_Equipo_Inicial_Total,RV_Cuota_Equipo_Mensual,'
						}
					}
				},
				126:{
					NroAcciones:1,
					Acciones:{
						1:{	
							Accion:'Mostrar_Campos',
							Ocultar:'',
							Mostrar:'RV_SKU_Pack,RV_Precio_Equipo_Inicial_Total,RV_Cuota_Equipo_Mensual,RV_Cant_Accesorios,RV_SKU_Accesorio1,RV_Precio_Accesorio1,RV_SKU_Accesorio2,RV_Precio_Accesorio2,RV_SKU_Accesorio3,RV_Precio_Accesorio3,RV_SKU_Accesorio4,RV_Precio_Accesorio4,RV_SKU_Accesorio5,RV_Precio_Accesorio5'
						}
					}
				},
				127:{
					NroAcciones:1,
					Acciones:{
						1:{	
							Accion:'Mostrar_Campos',
							Ocultar:'RV_Cant_Accesorios,RV_SKU_Accesorio1,RV_Precio_Accesorio1,RV_SKU_Accesorio2,RV_Precio_Accesorio2,RV_SKU_Accesorio3,RV_Precio_Accesorio3,RV_SKU_Accesorio4,RV_Precio_Accesorio4,RV_SKU_Accesorio5,RV_Precio_Accesorio5',
							Mostrar:'RV_SKU_Pack,RV_Precio_Equipo_Inicial_Total,RV_Cuota_Equipo_Mensual,'
						}
					}
				},
				128:{
					NroAcciones:1,
					Acciones:{
						1:{	
							Accion:'Mostrar_Campos',
							Ocultar:'',
							Mostrar:'RV_SKU_Pack,RV_Precio_Equipo_Inicial_Total,RV_Cuota_Equipo_Mensual,RV_Cant_Accesorios,RV_SKU_Accesorio1,RV_Precio_Accesorio1,RV_SKU_Accesorio2,RV_Precio_Accesorio2,RV_SKU_Accesorio3,RV_Precio_Accesorio3,RV_SKU_Accesorio4,RV_Precio_Accesorio4,RV_SKU_Accesorio5,RV_Precio_Accesorio5'
						}
					}
				},
				129:{
					NroAcciones:1,
					Acciones:{
						1:{	
							Accion:'Mostrar_Campos',
							Ocultar:'RV_Cant_Accesorios,RV_SKU_Accesorio1,RV_Precio_Accesorio1,RV_SKU_Accesorio2,RV_Precio_Accesorio2,RV_SKU_Accesorio3,RV_Precio_Accesorio3,RV_SKU_Accesorio4,RV_Precio_Accesorio4,RV_SKU_Accesorio5,RV_Precio_Accesorio5',
							Mostrar:'RV_SKU_Pack,RV_Precio_Equipo_Inicial_Total,RV_Cuota_Equipo_Mensual,'
						}
					}
				},
				130:{
					NroAcciones:1,
					Acciones:{
						1:{	
							Accion:'Mostrar_Campos',
							Ocultar:'',
							Mostrar:'RV_SKU_Pack,RV_Precio_Equipo_Inicial_Total,RV_Cuota_Equipo_Mensual,RV_Cant_Accesorios,RV_SKU_Accesorio1,RV_Precio_Accesorio1,RV_SKU_Accesorio2,RV_Precio_Accesorio2,RV_SKU_Accesorio3,RV_Precio_Accesorio3,RV_SKU_Accesorio4,RV_Precio_Accesorio4,RV_SKU_Accesorio5,RV_Precio_Accesorio5'
						}
					}
				},
				131:{
					NroAcciones:1,
					Acciones:{
						1:{	
							Accion:'Mostrar_Campos',
							Ocultar:'RV_Cant_Accesorios,RV_SKU_Accesorio1,RV_Precio_Accesorio1,RV_SKU_Accesorio2,RV_Precio_Accesorio2,RV_SKU_Accesorio3,RV_Precio_Accesorio3,RV_SKU_Accesorio4,RV_Precio_Accesorio4,RV_SKU_Accesorio5,RV_Precio_Accesorio5',
							Mostrar:'RV_SKU_Pack,RV_Precio_Equipo_Inicial_Total,RV_Cuota_Equipo_Mensual,'
						}
					}
				},
				132:{
					NroAcciones:1,
					Acciones:{
						1:{	
							Accion:'Mostrar_Campos',
							Ocultar:'',
							Mostrar:'RV_SKU_Pack,RV_Precio_Equipo_Inicial_Total,RV_Cuota_Equipo_Mensual,RV_Cant_Accesorios,RV_SKU_Accesorio1,RV_Precio_Accesorio1,RV_SKU_Accesorio2,RV_Precio_Accesorio2,RV_SKU_Accesorio3,RV_Precio_Accesorio3,RV_SKU_Accesorio4,RV_Precio_Accesorio4,RV_SKU_Accesorio5,RV_Precio_Accesorio5'
						}
					}
				},
				133:{
					NroAcciones:1,
					Acciones:{
						1:{	
							Accion:'Mostrar_Campos',
							Ocultar:'RV_Cant_Accesorios,RV_SKU_Accesorio1,RV_Precio_Accesorio1,RV_SKU_Accesorio2,RV_Precio_Accesorio2,RV_SKU_Accesorio3,RV_Precio_Accesorio3,RV_SKU_Accesorio4,RV_Precio_Accesorio4,RV_SKU_Accesorio5,RV_Precio_Accesorio5',
							Mostrar:'RV_SKU_Pack,RV_Precio_Equipo_Inicial_Total,RV_Cuota_Equipo_Mensual,'
						}
					}
				},
				134:{
					NroAcciones:1,
					Acciones:{
						1:{	
							Accion:'Mostrar_Campos',
							Ocultar:'',
							Mostrar:'RV_SKU_Pack,RV_Precio_Equipo_Inicial_Total,RV_Cuota_Equipo_Mensual,RV_Cant_Accesorios,RV_SKU_Accesorio1,RV_Precio_Accesorio1,RV_SKU_Accesorio2,RV_Precio_Accesorio2,RV_SKU_Accesorio3,RV_Precio_Accesorio3,RV_SKU_Accesorio4,RV_Precio_Accesorio4,RV_SKU_Accesorio5,RV_Precio_Accesorio5'
						}
					}
				},
				135:{
					NroAcciones:1,
					Acciones:{
						1:{	
							Accion:'Mostrar_Campos',
							Ocultar:'RV_Cant_Accesorios,RV_SKU_Accesorio1,RV_Precio_Accesorio1,RV_SKU_Accesorio2,RV_Precio_Accesorio2,RV_SKU_Accesorio3,RV_Precio_Accesorio3,RV_SKU_Accesorio4,RV_Precio_Accesorio4,RV_SKU_Accesorio5,RV_Precio_Accesorio5',
							Mostrar:'RV_SKU_Pack,RV_Precio_Equipo_Inicial_Total,RV_Cuota_Equipo_Mensual,'
						}
					}
				},
				136:{
					NroAcciones:1,
					Acciones:{
						1:{	
							Accion:'Mostrar_Campos',
							Ocultar:'',
							Mostrar:'RV_SKU_Pack,RV_Precio_Equipo_Inicial_Total,RV_Cuota_Equipo_Mensual,RV_Cant_Accesorios,RV_SKU_Accesorio1,RV_Precio_Accesorio1,RV_SKU_Accesorio2,RV_Precio_Accesorio2,RV_SKU_Accesorio3,RV_Precio_Accesorio3,RV_SKU_Accesorio4,RV_Precio_Accesorio4,RV_SKU_Accesorio5,RV_Precio_Accesorio5'
						}
					}
				},
				139:{
					NroAcciones:1,
					Acciones:{
						1:{	
							Accion:'Mostrar_Campos',
							Ocultar:'RV_SKU_Accesorio2,RV_Precio_Accesorio2,RV_SKU_Accesorio3,RV_Precio_Accesorio3,RV_SKU_Accesorio4,RV_Precio_Accesorio4,RV_SKU_Accesorio5,RV_Precio_Accesorio5',
							Mostrar:'RV_SKU_Accesorio1,RV_Precio_Accesorio1'
						}
					}
				},
				140:{
					NroAcciones:1,
					Acciones:{
						1:{	
							Accion:'Mostrar_Campos',
							Ocultar:'RV_SKU_Accesorio3,RV_Precio_Accesorio3,RV_SKU_Accesorio4,RV_Precio_Accesorio4,RV_SKU_Accesorio5,RV_Precio_Accesorio5',
							Mostrar:'RV_SKU_Accesorio1,RV_Precio_Accesorio1,RV_SKU_Accesorio2,RV_Precio_Accesorio2'
						}
					}
				},
				141:{
					NroAcciones:1,
					Acciones:{
						1:{	
							Accion:'Mostrar_Campos',
							Ocultar:'RV_SKU_Accesorio4,RV_Precio_Accesorio4,RV_SKU_Accesorio5,RV_Precio_Accesorio5',
							Mostrar:'RV_SKU_Accesorio1,RV_Precio_Accesorio1,RV_SKU_Accesorio2,RV_Precio_Accesorio2,RV_SKU_Accesorio3,RV_Precio_Accesorio3'
						}
					}
				},
				142:{
					NroAcciones:1,
					Acciones:{
						1:{	
							Accion:'Mostrar_Campos',
							Ocultar:'RV_SKU_Accesorio5,RV_Precio_Accesorio5',
							Mostrar:'RV_SKU_Accesorio1,RV_Precio_Accesorio1,RV_SKU_Accesorio2,RV_Precio_Accesorio2,RV_SKU_Accesorio3,RV_Precio_Accesorio3,RV_SKU_Accesorio4,RV_Precio_Accesorio4'
						}
					}
				},
				143:{
					NroAcciones:1,
					Acciones:{
						1:{	
							Accion:'Mostrar_Campos',
							Ocultar:'',
							Mostrar:'RV_SKU_Accesorio1,RV_Precio_Accesorio1,RV_SKU_Accesorio2,RV_Precio_Accesorio2,RV_SKU_Accesorio3,RV_Precio_Accesorio3,RV_SKU_Accesorio4,RV_Precio_Accesorio4,RV_SKU_Accesorio5,RV_Precio_Accesorio5'
						}
					}
				},
				144:{
					NroAcciones:1,
					Acciones:{
						1:{	
							Accion:'Mostrar_Campos',
							Ocultar:'RV_Promociones_Bancos',
							Mostrar:''
						}
					}
				},
				145:{
					NroAcciones:1,
					Acciones:{
						1:{	
							Accion:'Mostrar_Campos',
							Ocultar:'RV_Promociones_Bancos',
							Mostrar:''
						}
					}
				},
				146:{
					NroAcciones:1,
					Acciones:{
						1:{	
							Accion:'Mostrar_Campos',
							Ocultar:'',
							Mostrar:'RV_Promociones_Bancos'
						}
					}
				},
				149:{
					NroAcciones:1,
					Acciones:{
						1:{	
							Accion:'Mostrar_Campos',
							Ocultar:'VBO_Sub_Estado_Venta_BO',
							Mostrar:'RBO_Cantidad_Ordenes_Ficha,RBO_Orden_One_Click1,RBO_Orden_One_Click2,RBO_Orden_One_Click3,FBO_Ficha_Limpia,FBO_Errores_Comunes_Ficha,DGBO_Tipo_Atencion_Final'
						}
					}
				},
				151:{
					NroAcciones:1,
					Acciones:{
						1:{	
							Accion:'Mostrar_Campos',
							Ocultar:'VBO_Sub_Estado_Venta_BO',
							Mostrar:'RBO_Cantidad_Ordenes_Ficha,RBO_Orden_One_Click1,RBO_Orden_One_Click2,RBO_Orden_One_Click3,FBO_Ficha_Limpia,FBO_Errores_Comunes_Ficha,DGBO_Tipo_Atencion_Final'
						}
					}
				},
				152:{
					NroAcciones:1,
					Acciones:{
						1:{	
							Accion:'Mostrar_Campos',
							Ocultar:'VBO_Sub_Estado_Venta_BO',
							Mostrar:'RBO_Cantidad_Ordenes_Ficha,RBO_Orden_One_Click1,RBO_Orden_One_Click2,RBO_Orden_One_Click3,FBO_Ficha_Limpia,FBO_Errores_Comunes_Ficha,DGBO_Tipo_Atencion_Final'
						}
					}
				},
				153:{
					NroAcciones:1,
					Acciones:{
						1:{	
							Accion:'Mostrar_Campos',
							Ocultar:'VBO_Sub_Estado_Venta_BO',
							Mostrar:'RBO_Cantidad_Ordenes_Ficha,RBO_Orden_One_Click1,RBO_Orden_One_Click2,RBO_Orden_One_Click3,FBO_Ficha_Limpia,FBO_Errores_Comunes_Ficha,DGBO_Tipo_Atencion_Final'
						}
					}
				},
				150:{
					NroAcciones:1,
					Acciones:{
						1:{	
							Accion:'Mostrar_Campos',
							Ocultar:'RBO_Cantidad_Ordenes_Ficha,RBO_Orden_One_Click1,RBO_Orden_One_Click2,RBO_Orden_One_Click3',
							Mostrar:'VBO_Sub_Estado_Venta_BO,FBO_Ficha_Limpia,FBO_Errores_Comunes_Ficha,DGBO_Tipo_Atencion_Final'
						}
					}
				},
				154:{
					NroAcciones:1,
					Acciones:{
						1:{	
							Accion:'Mostrar_Campos',
							Ocultar:'VBO_Sub_Estado_Venta_BO,RBO_Cantidad_Ordenes_Ficha,RBO_Orden_One_Click1,RBO_Orden_One_Click2,RBO_Orden_One_Click3,FBO_Ficha_Limpia,FBO_Errores_Comunes_Ficha,DGBO_Tipo_Atencion_Final,',
							Mostrar:''
						}
					}
				},
				155:{
					NroAcciones:1,
					Acciones:{
						1:{	
							Accion:'Mostrar_Campos',
							Ocultar:'VBO_Sub_Estado_Venta_BO,RBO_Cantidad_Ordenes_Ficha,RBO_Orden_One_Click1,RBO_Orden_One_Click2,RBO_Orden_One_Click3,FBO_Ficha_Limpia,FBO_Errores_Comunes_Ficha,DGBO_Tipo_Atencion_Final',
							Mostrar:''
						}
					}
				},
				224:{
					NroAcciones:1,
					Acciones:{
						1:{	
							Accion:'Mostrar_Campos',
							Ocultar:'RBO_Orden_One_Click2,RBO_Orden_One_Click3',
							Mostrar:'RBO_Orden_One_Click1'
						}
					}
				},
				225:{
					NroAcciones:1,
					Acciones:{
						1:{	
							Accion:'Mostrar_Campos',
							Ocultar:'RBO_Orden_One_Click3',
							Mostrar:'RBO_Orden_One_Click1,RBO_Orden_One_Click2'
						}
					}
				},
				226:{
					NroAcciones:1,
					Acciones:{
						1:{	
							Accion:'Mostrar_Campos',
							Ocultar:'',
							Mostrar:'RBO_Orden_One_Click1,RBO_Orden_One_Click2,RBO_Orden_One_Click3'
						}
					}
				},
				227:{
					NroAcciones:1,
					Acciones:{
						1:{	
							Accion:'Mostrar_Campos',
							Ocultar:'FBO_Errores_Comunes_Ficha',
							Mostrar:''
						}
					}
				},
				228:{
					NroAcciones:1,
					Acciones:{
						1:{	
							Accion:'Mostrar_Campos',
							Ocultar:'',
							Mostrar:'FBO_Errores_Comunes_Ficha'
						}
					}
				}
			}

		
		/*FIN APLICAR LOGICA DE FILTROS*/
		json_logica =  ConsultarSubCategoria(0,'',0,'') ;
		localStorage.setItem("json_logica", JSON.stringify(json_logica) );
		json_acciones = JSON.stringify(json_logica);
		
 
	 
		$( ".filter_logica" ).change(function()
		{
				
			V_json_logica = localStorage.getItem("json_logica");	
			A_json_logica = JSON.parse(V_json_logica);
			id=$(this).attr('id');
			
        	var idSubCategoria=$("#"+id).val();
        	
			var Aplicar_Logica=$("#"+id+" option[value='"+idSubCategoria+"']").attr('aplicar_logica');

  
			A_sub_categoria = [];
			j=0;
			for ( i = 0; i < A_json_logica.length; i++) {
				if (A_json_logica[i].idSubCategoria == idSubCategoria) {
					A_sub_categoria[j]  = A_json_logica[i];
					j=j+1;
				}
				 
			}
			 
		 
 
		 
			A_sub_categorias = JSON.parse(JSON.stringify(A_sub_categoria));	
 
			//
			J_Accion = [];
			j=0;
			for ( i = 0; i < A_sub_categorias.length; i++) {
				 
				if (A_sub_categorias[i].Nom_Accion == "Accion" ) { 
					J_Accion[j]  = A_sub_categorias[i];
					j=j+1;
				}
				 
			}
	 
			A_Acciones = JSON.parse(JSON.stringify(J_Accion));	
			//
			J_Nombre = [];
			j=0;
			for ( i = 0; i < A_sub_categorias.length; i++) {
				if (A_sub_categorias[i].Nom_Accion == "Nombre" && A_sub_categorias[i].Acciones == "Acciones"   )  {
					J_Nombre[j]  = A_sub_categorias[i];
					j=j+1;
				}
				 
			}
			A_Nombre = JSON.parse(JSON.stringify(J_Nombre));	
			//
			J_ItemsFilter = [];
			j=0;
			for ( i = 0; i < A_sub_categorias.length; i++) {
				if (A_sub_categorias[i].Nom_Accion == "ItemsFilter" &&  A_sub_categorias[i].Acciones == "Acciones") {
					J_ItemsFilter[j]  = A_sub_categorias[i];
					j=j+1;
				}
				 
			}
			A_ItemsFilter = JSON.parse(JSON.stringify(J_ItemsFilter));	
			//
			J_Ocultar = [];
			j=0;
			for ( i = 0; i < A_sub_categorias.length; i++) {
				if (A_sub_categorias[i].Nom_Accion == "Ocultar"  &&  A_sub_categorias[i].Acciones == "Acciones") {
					J_Ocultar[j]  = A_sub_categorias[i];
					j=j+1;
				}
				 
			}
			A_Ocultar = JSON.parse(JSON.stringify(J_Ocultar));	
			//
			J_NroRegistrosPermitidos = [];
			j=0;
			for ( i = 0; i < A_sub_categorias.length; i++) {
				if (A_sub_categorias[i].Nom_Accion == "NroRegistrosPermitidos"  &&  A_sub_categorias[i].Acciones == "Acciones") {
					J_NroRegistrosPermitidos[j]  = A_sub_categorias[i];
					j=j+1;
				}
				 
			}
			A_NroRegistrosPermitidos = JSON.parse(JSON.stringify(J_NroRegistrosPermitidos));	
			//
			J_Mostrar = [];
			j=0;
			for ( i = 0; i < A_sub_categorias.length; i++) {
				if (A_sub_categorias[i].Nom_Accion == "Mostrar"  &&  A_sub_categorias[i].Acciones == "Acciones") {
					J_Mostrar[j]  = A_sub_categorias[i];
					j=j+1;
				}
				 
			}
			A_Mostrar = JSON.parse(JSON.stringify(J_Mostrar));	
			//
			J_Nombre_Key = [];
			j=0;
			for ( i = 0; i < A_sub_categoria.length; i++) {
				if (A_sub_categoria[i].Nom_Accion == "Nombre_Key"  &&  A_sub_categorias[i].Acciones == "Acciones") {
					J_Nombre_Key[j]  = A_sub_categoria[i];
					j=j+1;
				}
				 
			}
			A_Nombre_Key = JSON.parse(JSON.stringify(J_Nombre_Key));	
 
				 
 
			
			 b =  ConsultarSubCategoria(idSubCategoria,'Acciones',1,'')   ;
 
			if(Aplicar_Logica==1){
			 	//var NroIteraciones = LogicaRE[idSubCategoria]['NroAcciones'];  
				 var NroIteraciones =  b[0].NroAcciones;
				var SubCat_LogicaRE=LogicaRE[idSubCategoria]['Acciones'];
				 
				 
				for (var i = 1; i <= NroIteraciones; i++) {
				    
					/*if(LogicaRE[idSubCategoria]['Acciones'][i]['Accion']=='MultiRegistro'){
						$("#"+id).attr('NroRegistrosPermitidos', LogicaRE[idSubCategoria]['Acciones'][i]['NroRegistrosPermitidos']);
					}*/
					V_Acciones ='';
					V_Nombre ='';
					V_ItemsFilter='';
					V_Ocultar='';
					V_NroRegistrosPermitidos='';
					V_Mostrar='';
					V_Nombre_Key='';
					if (A_Acciones.length >0) {
						for (var j = 0; j < A_Acciones.length; j++) {
				
							if(i== Number(A_Acciones[j].Num_Accion) ) {

								V_Acciones = A_Acciones[j].Desc_Accion;

							}
						}
					}
					 
					
					if (A_Nombre.length >0) {
					 
						for (var j = 0; j < A_Nombre.length; j++) {
							
							if(i== Number(A_Nombre[j].Num_Accion) ) {

								V_Nombre = A_Nombre[j].Desc_Accion;

							}
						}
					}
					if (A_ItemsFilter.length >0) {
						for (var j = 0; j < A_ItemsFilter.length; j++) {
						
							if(i== Number(A_ItemsFilter[j].Num_Accion) ) {

								V_ItemsFilter = A_ItemsFilter[j].Desc_Accion;

							}
						}


					}
					if (A_Ocultar.length >0) {
						 
						for (var j = 0; j < A_Ocultar.length; j++) {
						 
							if(i== Number(A_Ocultar[j].Num_Accion) ) {

								V_Ocultar = A_Ocultar[j].Desc_Accion;

							}
						}


					}
					if (A_NroRegistrosPermitidos.length >0) {

						for (var j = 0; j <  A_NroRegistrosPermitidos.length; j++) {
							if(i== Number(A_NroRegistrosPermitidos[j].Num_Accion) ) {

								V_NroRegistrosPermitidos = A_NroRegistrosPermitidos[j].Desc_Accion;

						   }
						}
	
					}
					if (A_Mostrar.length >0) {

						for (var j = 0; j <  A_Mostrar.length; j++) {
							if(i== Number(A_Mostrar[j].Num_Accion) ) {

								V_Mostrar = A_Mostrar[j].Desc_Accion;

						   }
						}
	
					}
				 
					if (A_Nombre_Key.length >0) {

						for (var j = 0; j <  A_Nombre_Key.length; j++) {
							if(i== Number(A_Nombre_Key[j].Num_Accion) ) {

								V_Nombre_Key = A_Nombre_Key[j].Desc_Accion;

						   }
						}
	
					}
					
					 
				


					if(V_Acciones =='MultiRegistro'){
						$("#"+id).attr('NroRegistrosPermitidos', V_NroRegistrosPermitidos );
					}
 
					/*if(LogicaRE[idSubCategoria]['Acciones'][i]['Accion']=='Filtrar_Items'){
						ListarSubCategoriasxIds(LogicaRE[idSubCategoria]['Acciones'][i]['Nombre'],LogicaRE[idSubCategoria]['Acciones'][i]['ItemsFilter'])
					}
					*/
				 

					if(V_Acciones=='Filtrar_Items'){
						ListarSubCategoriasxIds(V_Nombre,V_ItemsFilter  );
					}

					if(V_Acciones=='Mostrar_Campos'){
				  //  if(LogicaRE[idSubCategoria]['Acciones'][i]['Accion']=='Mostrar_Campos'){	
				 	 	NombreCampos_Ocultar = V_Ocultar ; 
						//  console.log(NombreCampos_Ocultar);
					    //NombreCampos_Ocultar=LogicaRE[idSubCategoria]['Acciones'][i]['Ocultar'];	
						//console.log(NombreCampos_Ocultar);
				 		 
						var NombreCampos_Ocultar = NombreCampos_Ocultar.split(",");
						for (var j = 0 ; j <= NombreCampos_Ocultar.length-1; j++) {
							$("#div-"+NombreCampos_Ocultar[j]).addClass('hide');
							$("#"+NombreCampos_Ocultar[j]).attr('obligatorio',"NO");

							var typeCampo=$("#"+NombreCampos_Ocultar[j]).attr('type');
							if(typeCampo=="text" || typeCampo=="date" ){
								$("#"+NombreCampos_Ocultar[j]).val("");
							}else{
								$("#"+NombreCampos_Ocultar[j]).val(0);
							}


							$("#div-"+NombreCampos_Ocultar[j]).removeClass('has-error').removeClass('has-success');
						}
						NombreCampos_Mostrar=V_Mostrar;
						//NombreCampos_Mostrar=LogicaRE[idSubCategoria]['Acciones'][i]['Mostrar'];
						var NombreCampos_Mostrar = NombreCampos_Mostrar.split(",");
						for (var k = 0 ; k <= NombreCampos_Mostrar.length-1; k++) {
							$("#div-"+NombreCampos_Mostrar[k]).removeClass('hide');
							$("#"+NombreCampos_Mostrar[k]).attr('obligatorio',"SI");
						}
					}
				 	if(V_Acciones=='Filtro_Superior'){

				 
					// if(LogicaRE[idSubCategoria]['Acciones'][i]['Accion']=='Filtro_Superior'){
					     var NombreFiltroSuperior=V_Nombre;
					 	 var NombreKey=V_Nombre_Key;
						// var NombreFiltroSuperior=LogicaRE[idSubCategoria]['Acciones'][i]['Nombre'];
						// var NombreKey=LogicaRE[idSubCategoria]['Acciones'][i]['Nombre_Key'];
						 
 
						  idSubCategoriaSuperior=$("#"+NombreFiltroSuperior).val();
					 
						 var SubCat_Logica=LogicaRE[idSubCategoriaSuperior][NombreKey];
						 A_SubCat_Logica  =  ConsultarSubCategoria(idSubCategoriaSuperior,NombreKey,0,''); 
						
						 for (var j = 0; j <  A_SubCat_Logica.length; j++) {
							if(idSubCategoria == Number(A_SubCat_Logica[j].Num_Accion) ) {

								if  (A_SubCat_Logica[j].Nom_Accion == 'Nombre'){
									V_SubCat_Logica_Nombre = A_SubCat_Logica[j].Desc_Accion;
								}	
								if  (A_SubCat_Logica[j].Nom_Accion == 'ItemsFilter'){
									V_SubCat_Logica_ItemsFilter = A_SubCat_Logica[j].Desc_Accion;
								}
						   }
						}
	 
						var SubCat_Logica=LogicaRE[idSubCategoriaSuperior][NombreKey];
					    ListarSubCategoriasxIds(V_SubCat_Logica_Nombre ,  V_SubCat_Logica_ItemsFilter)
						//ListarSubCategoriasxIds(SubCat_Logica[idSubCategoria]['Nombre'],SubCat_Logica[idSubCategoria]['ItemsFilter'])
					}

				}

			}

    	});
		/*FIN APLICAR LOGICA DE FILTROS*/

		/*INICIO 3.- Datos Facturación*/
		
		
		$( "#DF_Dpto_Facturacion" ).change(function()
		{
        	var departamento=$("#DF_Dpto_Facturacion").val();  
        	ListarProvincias(departamento,"DF_Prov_Facturacion");
        	$("#DF_Dist_Facturacion").find("option").remove();
         	$("#DF_Dist_Facturacion").append('<option value="0">-- Seleccionar --</option>');
         	$("#DF_Prov_Facturacion").focus();
    	});

	    $( "#DF_Prov_Facturacion" ).change(function ()
	    {
	        var departamento=$("#DF_Dpto_Facturacion").val();  
	        var provincia=$("#DF_Prov_Facturacion").val(); 
	        ListarDistritos(departamento,provincia,"DF_Dist_Facturacion");
	        $("#DF_Dist_Facturacion").focus();        
	    });
	    /*FIN 3.- Datos Facturación*/		

	    /*INICIO 4.- Registro para Entrega*/
		
		
		$( "#RE_Dpto_Entrega_Producto" ).change(function()
		{
        	var departamento=$("#RE_Dpto_Entrega_Producto").val();  
        	ListarProvincias(departamento,"RE_Prov_Entrega_Producto");
        	$("#RE_Dist_Entrega_Producto").find("option").remove();
         	$("#RE_Dist_Entrega_Producto").append('<option value="0">-- Seleccionar --</option>');
         	$("#RE_Prov_Entrega_Producto").focus();
    	});

	    $( "#RE_Prov_Entrega_Producto" ).change(function ()
	    {
	        var departamento=$("#RE_Dpto_Entrega_Producto").val();  
	        var provincia=$("#RE_Prov_Entrega_Producto").val(); 
	        ListarDistritos(departamento,provincia,"RE_Dist_Entrega_Producto");
	        $("#RE_Dist_Entrega_Producto").focus();        
	    });
	    /*FIN 4.- Registro para Entrega*/


	    var count_actualizar=0;
	   	$('#confirmar-actualizar-ficha').on('show.bs.modal',function(){
	  		
	    	$('.btn-ok-ActualizarFichaVenta').click(function(){
	    		count_actualizar++;

	    		if(count_actualizar==1){
	    			$("#loader-text").html("Actualizando..");
	    			$(".loader-page").css({visibility:"inherit",opacity:"1"});
		    		var idFicha_Venta=$("#idFicha_Venta").val();
					var DE_Telf_Llamada_Venta=$("#DE_Telf_Llamada_Venta").val();
					var DE_Base_Llamada=$("#DE_Base_Llamada").val();
					var DE_Campana_Netcall=$("#DE_Campana_Netcall").val();
					var DE_Sub_Campana=$("#DE_Sub_Campana").val();
					var DE_Detalle_Sub_Campana=$("#DE_Detalle_Sub_Campana").val();
					var DE_CF_Max_Linea_Movil=$("#DE_CF_Max_Linea_Movil").val();
					var DE_Tipo_Etiqueta=$("#DE_Tipo_Etiqueta").val();
					var DE_CF_Max_Linea_Pack=$("#DE_CF_Max_Linea_Pack").val();
					var DE_Monto_Disp_Finan_Equipos=$("#DE_Monto_Disp_Finan_Equipos").val();
					var DE_Cant_Meses_Finan_Equipos=$("#DE_Cant_Meses_Finan_Equipos").val();
					var DE_Cliente_Entel=$("#DE_Cliente_Entel").val();
					var DE_Cliente_Promo_Dscto=$("#DE_Cliente_Promo_Dscto").val();
					var DP_TipoDocumento=$("#DP_TipoDocumento").val();
					var DP_Documento=$("#DP_Documento").val().trim();
					var DP_Nombre_Cliente=$("#DP_Nombre_Cliente").val();
					var DP_Apellido_Paterno=$("#DP_Apellido_Paterno").val();
					var DP_Apellido_Materno=$("#DP_Apellido_Materno").val();
					var DP_Nacionalidad=$("#DP_Nacionalidad").val();
					var DP_Lugar_Nacimiento=$("#DP_Lugar_Nacimiento").val();
					var DP_Fecha_Nacimiento=$("#DP_Fecha_Nacimiento").val();
					var DP_Nombre_Padre=$("#DP_Nombre_Padre").val();
					var DP_Nombre_Madre=$("#DP_Nombre_Madre").val();
					var DF_Email_Facturacion_Otros=$("#DF_Email_Facturacion_Otros").val();
					var DF_Dist_Facturacion=$("#DF_Dist_Facturacion").val();
					var DF_Domicilio_Facturacion=$("#DF_Domicilio_Facturacion").val();
					var RE_Tipo_Despacho=$("#RE_Tipo_Despacho").val();
					var RE_Rango_Entrega_Despacho=$("#RE_Rango_Entrega_Despacho").val();
					var RE_Rango_Horario_Despacho=$("#RE_Rango_Horario_Despacho").val();
					var RE_Tienda_Retiro=$("#RE_Tienda_Retiro").val();
					var RE_Retail_Retiro=$("#RE_Retail_Retiro").val();
					var RE_Fecha_Entrega=$("#RE_Fecha_Entrega").val();
					var RE_Venta_Entrega_para=$("#RE_Venta_Entrega_para").val();
					var RE_Venta_Destino_para=$("#RE_Venta_Destino_para").val();
					var RE_Dist_Entrega_Producto=$("#RE_Dist_Entrega_Producto").val();
					var RE_Tipo_Direccion_Entrega=$("#RE_Tipo_Direccion_Entrega").val();
					var RE_Direccion_Entrega=$("#RE_Direccion_Entrega").val();
					var RE_Referencia_Principales=$("#RE_Referencia_Principales").val();
					var RE_Referencias_Adicionales=$("#RE_Referencias_Adicionales").val();
					var RE_Coordenadas_Direccion_Entrega=$("#RE_Coordenadas_Direccion_Entrega").val();
					var RE_Telefono_Contacto1=$("#RE_Telefono_Contacto1").val();
					var RE_Telefono_Contacto2=$("#RE_Telefono_Contacto2").val();
					var RE_Tipo_Contacto_Ol=$("#RE_Tipo_Contacto_Ol").val();
					var RV_Tipo_Ofrecimiento=$("#RV_Tipo_Ofrecimiento").val();
					var RV_Tipo_Venta=$("#RV_Tipo_Venta").val();
					var RV_Operador_Cedente=$("#RV_Operador_Cedente").val();
					var RV_Origen=$("#RV_Origen").val();
					var RV_Linea_Portar=$("#RV_Linea_Portar").val();
					var RV_Plan_Tarifario=$("#RV_Plan_Tarifario").val();
					var RV_Cargo_Fijo_Plan=$("#RV_Cargo_Fijo_Plan").val();
					var RV_Tipo_Producto=$("#RV_Tipo_Producto").val();
					var RV_Accesorio_Regalo=$("#RV_Accesorio_Regalo").val();
					var RV_SKU_Accesorio_Regalo1=$("#RV_SKU_Accesorio_Regalo1").val();
					var RV_SKU_Accesorio_Regalo2=$("#RV_SKU_Accesorio_Regalo2").val();
					var RV_SKU_Pack=$("#RV_SKU_Pack").val();
					var RV_Precio_Equipo_Inicial_Total=$("#RV_Precio_Equipo_Inicial_Total").val();
					var RV_Cuota_Equipo_Mensual=$("#RV_Cuota_Equipo_Mensual").val();
					var RV_Cant_Accesorios=$("#RV_Cant_Accesorios").val();
					var RV_SKU_Accesorio1=$("#RV_SKU_Accesorio1").val();
					var RV_Precio_Accesorio1=$("#RV_Precio_Accesorio1").val();
					var RV_SKU_Accesorio2=$("#RV_SKU_Accesorio2").val();
					var RV_Precio_Accesorio2=$("#RV_Precio_Accesorio2").val();
					var RV_SKU_Accesorio3=$("#RV_SKU_Accesorio3").val();
					var RV_Precio_Accesorio3=$("#RV_Precio_Accesorio3").val();
					var RV_SKU_Accesorio4=$("#RV_SKU_Accesorio4").val();
					var RV_Precio_Accesorio4=$("#RV_Precio_Accesorio4").val();
					var RV_SKU_Accesorio5=$("#RV_SKU_Accesorio5").val();
					var RV_Precio_Accesorio5=$("#RV_Precio_Accesorio5").val();
					var RV_Tipo_Pago=$("#RV_Tipo_Pago").val();
					var RV_Promociones_Bancos=$("#RV_Promociones_Bancos").val();
					var Supervisor_Vendedor=$("#Supervisor_Vendedor").val();
					var Comentarios_Vendedor=$("#Comentarios_Vendedor").val();
					var Ingresado_por_Vendedor=$("#Ingresado_por_Vendedor").attr('idVendedor');
					var Fecha_Registro_Vendedor=$("#Fecha_Registro_Vendedor").val();
					var VBO_Estado_Venta_BO=$("#VBO_Estado_Venta_BO").val();
					var VBO_Sub_Estado_Venta_BO=$("#VBO_Sub_Estado_Venta_BO").val();
					var RBO_Cantidad_Ordenes_Ficha=$("#RBO_Cantidad_Ordenes_Ficha").val();
					var RBO_Orden_One_Click1=$("#RBO_Orden_One_Click1").val();
					var RBO_Orden_One_Click2=$("#RBO_Orden_One_Click2").val();
					var RBO_Orden_One_Click3=$("#RBO_Orden_One_Click3").val();
					var FBO_Ficha_Limpia=$("#FBO_Ficha_Limpia").val();
					var FBO_Errores_Comunes_Ficha=$("#FBO_Errores_Comunes_Ficha").val();
					var DGBO_Tipo_Atencion_Final=$("#DGBO_Tipo_Atencion_Final").val();
					var DGBO_BO_Validador_Gestor=$("#idFicha_Venta").attr('DGBO_BO_Validador_Gestor');
					var DGBO_BO_Recupero_Repro_Gestor=$("#idFicha_Venta").attr('DGBO_BO_Recupero_Repro_Gestor');
					var Comentarios_BackOffice=$("#Comentarios_BackOffice").val();
					var tipo_actualizacion=$("#idFicha_Venta").attr('tipo_actualizacion');

					 $.ajax({
				      	type: "POST",
				      	url: 'index.php?c=Ficha_Venta&a=Actualizar',
				      	data: {
					        idFicha_Venta:idFicha_Venta,
					        DE_Telf_Llamada_Venta:DE_Telf_Llamada_Venta,
					        DE_Base_Llamada:DE_Base_Llamada,
					        DE_Campana_Netcall:DE_Campana_Netcall,
					        DE_Sub_Campana:DE_Sub_Campana,
					        DE_Detalle_Sub_Campana:DE_Detalle_Sub_Campana,
					        DE_CF_Max_Linea_Movil:DE_CF_Max_Linea_Movil,
					        DE_Tipo_Etiqueta:DE_Tipo_Etiqueta,
					        DE_CF_Max_Linea_Pack:DE_CF_Max_Linea_Pack,
					        DE_Monto_Disp_Finan_Equipos:DE_Monto_Disp_Finan_Equipos,
					        DE_Cant_Meses_Finan_Equipos:DE_Cant_Meses_Finan_Equipos,
					        DE_Cliente_Entel:DE_Cliente_Entel,
					        DE_Cliente_Promo_Dscto:DE_Cliente_Promo_Dscto,
					        DP_TipoDocumento:DP_TipoDocumento,
					        DP_Documento:DP_Documento,
					        DP_Nombre_Cliente:DP_Nombre_Cliente,
					        DP_Apellido_Paterno:DP_Apellido_Paterno,
					        DP_Apellido_Materno:DP_Apellido_Materno,
					        DP_Nacionalidad:DP_Nacionalidad,
					        DP_Lugar_Nacimiento:DP_Lugar_Nacimiento,
					        DP_Fecha_Nacimiento:DP_Fecha_Nacimiento,
					        DP_Nombre_Padre:DP_Nombre_Padre,
					        DP_Nombre_Madre:DP_Nombre_Madre,
					        DF_Email_Facturacion_Otros,
					        DF_Dist_Facturacion:DF_Dist_Facturacion,
					        DF_Domicilio_Facturacion:DF_Domicilio_Facturacion,
					       	RE_Tipo_Despacho:RE_Tipo_Despacho,
					       	RE_Rango_Entrega_Despacho:RE_Rango_Entrega_Despacho,
					       	RE_Rango_Horario_Despacho:RE_Rango_Horario_Despacho,
					       	RE_Tienda_Retiro:RE_Tienda_Retiro,
					       	RE_Retail_Retiro:RE_Retail_Retiro,
					       	RE_Fecha_Entrega:RE_Fecha_Entrega,
					       	RE_Venta_Entrega_para:RE_Venta_Entrega_para,
					       	RE_Venta_Destino_para:RE_Venta_Destino_para,
					       	RE_Dist_Entrega_Producto:RE_Dist_Entrega_Producto,
					       	RE_Tipo_Direccion_Entrega:RE_Tipo_Direccion_Entrega,
					       	RE_Direccion_Entrega:RE_Direccion_Entrega,
					       	RE_Referencia_Principales:RE_Referencia_Principales,
					       	RE_Referencias_Adicionales:RE_Referencias_Adicionales,
					       	RE_Coordenadas_Direccion_Entrega:RE_Coordenadas_Direccion_Entrega,
					       	RE_Telefono_Contacto1:RE_Telefono_Contacto1,
					       	RE_Telefono_Contacto2:RE_Telefono_Contacto2,
					       	RE_Tipo_Contacto_Ol:RE_Tipo_Contacto_Ol,
					       	RV_Tipo_Ofrecimiento:RV_Tipo_Ofrecimiento,
							RV_Tipo_Venta:RV_Tipo_Venta,
							RV_Operador_Cedente:RV_Operador_Cedente,
							RV_Origen:RV_Origen,
							RV_Linea_Portar:RV_Linea_Portar,
							RV_Plan_Tarifario:RV_Plan_Tarifario,
							RV_Cargo_Fijo_Plan:RV_Cargo_Fijo_Plan,
							RV_Tipo_Producto:RV_Tipo_Producto,
							RV_Accesorio_Regalo:RV_Accesorio_Regalo,
							RV_SKU_Accesorio_Regalo1:RV_SKU_Accesorio_Regalo1,
							RV_SKU_Accesorio_Regalo2:RV_SKU_Accesorio_Regalo2,
							RV_SKU_Pack:RV_SKU_Pack,
							RV_Precio_Equipo_Inicial_Total:RV_Precio_Equipo_Inicial_Total,
							RV_Cuota_Equipo_Mensual:RV_Cuota_Equipo_Mensual,
							RV_Cant_Accesorios:RV_Cant_Accesorios,
							RV_SKU_Accesorio1:RV_SKU_Accesorio1,
							RV_Precio_Accesorio1:RV_Precio_Accesorio1,
							RV_SKU_Accesorio2:RV_SKU_Accesorio2,
							RV_Precio_Accesorio2:RV_Precio_Accesorio2,
							RV_SKU_Accesorio3:RV_SKU_Accesorio3,
							RV_Precio_Accesorio3:RV_Precio_Accesorio3,
							RV_SKU_Accesorio4:RV_SKU_Accesorio4,
							RV_Precio_Accesorio4:RV_Precio_Accesorio4,
							RV_SKU_Accesorio5:RV_SKU_Accesorio5,
							RV_Precio_Accesorio5:RV_Precio_Accesorio5,
							RV_Tipo_Pago:RV_Tipo_Pago,
							RV_Promociones_Bancos:RV_Promociones_Bancos,
							Supervisor_Vendedor:Supervisor_Vendedor,
							Comentarios_Vendedor:Comentarios_Vendedor,
							Ingresado_por_Vendedor:Ingresado_por_Vendedor,
							Fecha_Registro_Vendedor:Fecha_Registro_Vendedor,
							VBO_Estado_Venta_BO:VBO_Estado_Venta_BO,
							VBO_Sub_Estado_Venta_BO:VBO_Sub_Estado_Venta_BO,
							RBO_Cantidad_Ordenes_Ficha:RBO_Cantidad_Ordenes_Ficha,
							RBO_Orden_One_Click1:RBO_Orden_One_Click1,
							RBO_Orden_One_Click2:RBO_Orden_One_Click2,
							RBO_Orden_One_Click3:RBO_Orden_One_Click3,
							FBO_Ficha_Limpia:FBO_Ficha_Limpia,
							FBO_Errores_Comunes_Ficha:FBO_Errores_Comunes_Ficha,
							DGBO_Tipo_Atencion_Final:DGBO_Tipo_Atencion_Final,
							DGBO_BO_Validador_Gestor:DGBO_BO_Validador_Gestor,
							DGBO_BO_Recupero_Repro_Gestor:DGBO_BO_Recupero_Repro_Gestor,
							Comentarios_BackOffice:Comentarios_BackOffice,
							tipo_actualizacion:tipo_actualizacion
					    },
				      	success: function(data) {
				        	$("#loader-text").html("Ficha de venta actualizada");

				        	setTimeout(function() {
								window.location=<?php echo "'".$urlRetornoAct."'"; ?>;
							}, 1000);
								
				        	

				      	},
				      	dataType: 'json'
				    });
 				}
	        });
	    });


 		var count_registrar=0;

	   $('#confirmar-registrar-ficha').on('show.bs.modal',function(){
	    	$('.btn-ok-RegistrarFichaVenta').click(function(){

	    		count_registrar++;
	    		if(count_registrar==1){
	    			$("#loader-text").html("Registrando...");
	    			$(".loader-page").css({visibility:"inherit",opacity:"1"});
	    			var NroRegistrosPermitidos=$("#RV_Tipo_Ofrecimiento").attr("NroRegistrosPermitidos");
					var DE_Telf_Llamada_Venta=$("#DE_Telf_Llamada_Venta").val();
					var DE_Base_Llamada=$("#DE_Base_Llamada").val();
					var DE_Campana_Netcall=$("#DE_Campana_Netcall").val();
					var DE_Sub_Campana=$("#DE_Sub_Campana").val();
					var DE_Detalle_Sub_Campana=$("#DE_Detalle_Sub_Campana").val();
					var DE_CF_Max_Linea_Movil=$("#DE_CF_Max_Linea_Movil").val();
					var DE_Tipo_Etiqueta=$("#DE_Tipo_Etiqueta").val();
					var DE_CF_Max_Linea_Pack=$("#DE_CF_Max_Linea_Pack").val();
					var DE_Monto_Disp_Finan_Equipos=$("#DE_Monto_Disp_Finan_Equipos").val();
					var DE_Cant_Meses_Finan_Equipos=$("#DE_Cant_Meses_Finan_Equipos").val();
					var DE_Cliente_Entel=$("#DE_Cliente_Entel").val();
					var DE_Cliente_Promo_Dscto=$("#DE_Cliente_Promo_Dscto").val();
					var DP_TipoDocumento=$("#DP_TipoDocumento").val();
					var DP_Documento=$("#DP_Documento").val().trim();
					var DP_Nombre_Cliente=$("#DP_Nombre_Cliente").val();
					var DP_Apellido_Paterno=$("#DP_Apellido_Paterno").val();
					var DP_Apellido_Materno=$("#DP_Apellido_Materno").val();
					var DP_Nacionalidad=$("#DP_Nacionalidad").val();
					var DP_Lugar_Nacimiento=$("#DP_Lugar_Nacimiento").val();
					var DP_Fecha_Nacimiento=$("#DP_Fecha_Nacimiento").val();
					var DP_Nombre_Padre=$("#DP_Nombre_Padre").val();
					var DP_Nombre_Madre=$("#DP_Nombre_Madre").val();
					var DF_Email_Facturacion_Otros=$("#DF_Email_Facturacion_Otros").val();
					var DF_Dist_Facturacion=$("#DF_Dist_Facturacion").val();
					var DF_Domicilio_Facturacion=$("#DF_Domicilio_Facturacion").val();
					var RE_Tipo_Despacho=$("#RE_Tipo_Despacho").val();
					var RE_Rango_Entrega_Despacho=$("#RE_Rango_Entrega_Despacho").val();
					var RE_Rango_Horario_Despacho=$("#RE_Rango_Horario_Despacho").val();
					var RE_Tienda_Retiro=$("#RE_Tienda_Retiro").val();
					var RE_Retail_Retiro=$("#RE_Retail_Retiro").val();
					var RE_Fecha_Entrega=$("#RE_Fecha_Entrega").val();
					var RE_Venta_Entrega_para=$("#RE_Venta_Entrega_para").val();
					var RE_Venta_Destino_para=$("#RE_Venta_Destino_para").val();
					var RE_Dist_Entrega_Producto=$("#RE_Dist_Entrega_Producto").val();
					var RE_Tipo_Direccion_Entrega=$("#RE_Tipo_Direccion_Entrega").val();
					var RE_Direccion_Entrega=$("#RE_Direccion_Entrega").val();
					var RE_Referencia_Principales=$("#RE_Referencia_Principales").val();
					var RE_Referencias_Adicionales=$("#RE_Referencias_Adicionales").val();
					var RE_Coordenadas_Direccion_Entrega=$("#RE_Coordenadas_Direccion_Entrega").val();
					var RE_Telefono_Contacto1=$("#RE_Telefono_Contacto1").val();
					var RE_Telefono_Contacto2=$("#RE_Telefono_Contacto2").val();
					var RE_Tipo_Contacto_Ol=$("#RE_Tipo_Contacto_Ol").val();
					var RV_Tipo_Ofrecimiento=$("#RV_Tipo_Ofrecimiento").val();
					var RV_Tipo_Venta=$("#RV_Tipo_Venta").val();
					var RV_Operador_Cedente=$("#RV_Operador_Cedente").val();
					var RV_Origen=$("#RV_Origen").val();
					var RV_Linea_Portar=$("#RV_Linea_Portar").val();
					var RV_Plan_Tarifario=$("#RV_Plan_Tarifario").val();
					var RV_Cargo_Fijo_Plan=$("#RV_Cargo_Fijo_Plan").val();
					var RV_Tipo_Producto=$("#RV_Tipo_Producto").val();
					var RV_Accesorio_Regalo=$("#RV_Accesorio_Regalo").val();
					var RV_SKU_Accesorio_Regalo1=$("#RV_SKU_Accesorio_Regalo1").val();
					var RV_SKU_Accesorio_Regalo2=$("#RV_SKU_Accesorio_Regalo2").val();
					var RV_SKU_Pack=$("#RV_SKU_Pack").val();
					var RV_Precio_Equipo_Inicial_Total=$("#RV_Precio_Equipo_Inicial_Total").val();
					var RV_Cuota_Equipo_Mensual=$("#RV_Cuota_Equipo_Mensual").val();
					var RV_Cant_Accesorios=$("#RV_Cant_Accesorios").val();
					var RV_SKU_Accesorio1=$("#RV_SKU_Accesorio1").val();
					var RV_Precio_Accesorio1=$("#RV_Precio_Accesorio1").val();
					var RV_SKU_Accesorio2=$("#RV_SKU_Accesorio2").val();
					var RV_Precio_Accesorio2=$("#RV_Precio_Accesorio2").val();
					var RV_SKU_Accesorio3=$("#RV_SKU_Accesorio3").val();
					var RV_Precio_Accesorio3=$("#RV_Precio_Accesorio3").val();
					var RV_SKU_Accesorio4=$("#RV_SKU_Accesorio4").val();
					var RV_Precio_Accesorio4=$("#RV_Precio_Accesorio4").val();
					var RV_SKU_Accesorio5=$("#RV_SKU_Accesorio5").val();
					var RV_Precio_Accesorio5=$("#RV_Precio_Accesorio5").val();
					var RV_Tipo_Pago=$("#RV_Tipo_Pago").val();
					var RV_Promociones_Bancos=$("#RV_Promociones_Bancos").val();
					var Supervisor_Vendedor=$("#Supervisor_Vendedor").val();
					var Comentarios_Vendedor=$("#Comentarios_Vendedor").val();

					 $.ajax({
				      	type: "POST",
				      	url: 'index.php?c=Ficha_Venta&a=Registrar',
				      	data: {
					        DE_Telf_Llamada_Venta:DE_Telf_Llamada_Venta,
					        DE_Base_Llamada:DE_Base_Llamada,
					        DE_Campana_Netcall:DE_Campana_Netcall,
					        DE_Sub_Campana:DE_Sub_Campana,
					        DE_Detalle_Sub_Campana:DE_Detalle_Sub_Campana,
					        DE_CF_Max_Linea_Movil:DE_CF_Max_Linea_Movil,
					        DE_Tipo_Etiqueta:DE_Tipo_Etiqueta,
					        DE_CF_Max_Linea_Pack:DE_CF_Max_Linea_Pack,
					        DE_Monto_Disp_Finan_Equipos:DE_Monto_Disp_Finan_Equipos,
					        DE_Cant_Meses_Finan_Equipos:DE_Cant_Meses_Finan_Equipos,
					        DE_Cliente_Entel:DE_Cliente_Entel,
					        DE_Cliente_Promo_Dscto:DE_Cliente_Promo_Dscto,
					        DP_TipoDocumento:DP_TipoDocumento,
					        DP_Documento:DP_Documento,
					        DP_Nombre_Cliente:DP_Nombre_Cliente,
					        DP_Apellido_Paterno:DP_Apellido_Paterno,
					        DP_Apellido_Materno:DP_Apellido_Materno,
					        DP_Nacionalidad:DP_Nacionalidad,
					        DP_Lugar_Nacimiento:DP_Lugar_Nacimiento,
					        DP_Fecha_Nacimiento:DP_Fecha_Nacimiento,
					        DP_Nombre_Padre:DP_Nombre_Padre,
					        DP_Nombre_Madre:DP_Nombre_Madre,
					        DF_Email_Facturacion_Otros,
					        DF_Dist_Facturacion:DF_Dist_Facturacion,
					        DF_Domicilio_Facturacion:DF_Domicilio_Facturacion,
					       	RE_Tipo_Despacho:RE_Tipo_Despacho,
					       	RE_Rango_Entrega_Despacho:RE_Rango_Entrega_Despacho,
					       	RE_Rango_Horario_Despacho:RE_Rango_Horario_Despacho,
					       	RE_Tienda_Retiro:RE_Tienda_Retiro,
					       	RE_Retail_Retiro:RE_Retail_Retiro,
					       	RE_Fecha_Entrega:RE_Fecha_Entrega,
					       	RE_Venta_Entrega_para:RE_Venta_Entrega_para,
					       	RE_Venta_Destino_para:RE_Venta_Destino_para,
					       	RE_Dist_Entrega_Producto:RE_Dist_Entrega_Producto,
					       	RE_Tipo_Direccion_Entrega:RE_Tipo_Direccion_Entrega,
					       	RE_Direccion_Entrega:RE_Direccion_Entrega,
					       	RE_Referencia_Principales:RE_Referencia_Principales,
					       	RE_Referencias_Adicionales:RE_Referencias_Adicionales,
					       	RE_Coordenadas_Direccion_Entrega:RE_Coordenadas_Direccion_Entrega,
					       	RE_Telefono_Contacto1:RE_Telefono_Contacto1,
					       	RE_Telefono_Contacto2:RE_Telefono_Contacto2,
					       	RE_Tipo_Contacto_Ol:RE_Tipo_Contacto_Ol,
					       	RV_Tipo_Ofrecimiento:RV_Tipo_Ofrecimiento,
							RV_Tipo_Venta:RV_Tipo_Venta,
							RV_Operador_Cedente:RV_Operador_Cedente,
							RV_Origen:RV_Origen,
							RV_Linea_Portar:RV_Linea_Portar,
							RV_Plan_Tarifario:RV_Plan_Tarifario,
							RV_Cargo_Fijo_Plan:RV_Cargo_Fijo_Plan,
							RV_Tipo_Producto:RV_Tipo_Producto,
							RV_Accesorio_Regalo:RV_Accesorio_Regalo,
							RV_SKU_Accesorio_Regalo1:RV_SKU_Accesorio_Regalo1,
							RV_SKU_Accesorio_Regalo2:RV_SKU_Accesorio_Regalo2,
							RV_SKU_Pack:RV_SKU_Pack,
							RV_Precio_Equipo_Inicial_Total:RV_Precio_Equipo_Inicial_Total,
							RV_Cuota_Equipo_Mensual:RV_Cuota_Equipo_Mensual,
							RV_Cant_Accesorios:RV_Cant_Accesorios,
							RV_SKU_Accesorio1:RV_SKU_Accesorio1,
							RV_Precio_Accesorio1:RV_Precio_Accesorio1,
							RV_SKU_Accesorio2:RV_SKU_Accesorio2,
							RV_Precio_Accesorio2:RV_Precio_Accesorio2,
							RV_SKU_Accesorio3:RV_SKU_Accesorio3,
							RV_Precio_Accesorio3:RV_Precio_Accesorio3,
							RV_SKU_Accesorio4:RV_SKU_Accesorio4,
							RV_Precio_Accesorio4:RV_Precio_Accesorio4,
							RV_SKU_Accesorio5:RV_SKU_Accesorio5,
							RV_Precio_Accesorio5:RV_Precio_Accesorio5,
							RV_Tipo_Pago:RV_Tipo_Pago,
							RV_Promociones_Bancos:RV_Promociones_Bancos,
							Supervisor_Vendedor:Supervisor_Vendedor,
							Comentarios_Vendedor:Comentarios_Vendedor
					    },
				      	//sync:false,        
				      	success: function(data) {
				      		$("#loader-text").html("Ficha de venta registrada");
							
							if (NroRegistrosPermitidos>1) {

								
								setTimeout(function() {
									$("#loader-text").html("Continue registrando la siguiente ficha");
									$("#RV_Tipo_Venta").val(0).trigger('change');
								}, 1000);
								setTimeout(function() {
									$(".loader-page").css({visibility:"hidden",opacity:"0"});
								}, 2000);	
							}
							

							NroRegistrosPermitidos--;
							$("#RV_Tipo_Ofrecimiento").attr('NroRegistrosPermitidos',NroRegistrosPermitidos);
							BloquearMultiRegistro();	
								
							if(NroRegistrosPermitidos==0){
								setTimeout(function() {
								window.location="index.php?c=Ficha_Venta&a=v_Registrar_Ficha";
								}, 1000);
								
							}else{
								
								
							}
							
							count_registrar=0;
				        	       
				      	},
				      	dataType: 'json'
				    });
				}
	        });
	    });
    		
        $('#btnRegistrarFichaVenta').click(function()
        {	
        	
        	var valido=ValidarDatosRegistrar();
        	//var valido="Completo";
        	if(valido=="Completo"){
            	$('#confirmar-registrar-ficha').modal('show');
           	}else{
           		//alert(valido);
           		$("#title_moda_validacion").text("ERROR AL REGISTRAR LA FICHA");
				$("#label_moda_validacion").text("Completar los campos sombreados de rojo para poder registrar la ficha de ventas");
           		$('#confirmar-validacion_datos').modal('show');
           		
           	}
           	
        })

        $('#btnBuscarDocumento').click(function()
        {
        	DP_Documento=$("#DP_Documento").val().trim();
        	$("#DP_Documento").val(DP_Documento);
        	DP_TipoDocumento=$("#DP_TipoDocumento").val();

        	if(DP_TipoDocumento==0){
        		$("#DP_TipoDocumento").focus();

        	}
            buscar_ClientexDocumento(DP_TipoDocumento,DP_Documento);
           
        })

        $('#btnActualizarFichaVenta_VBO').click(function()
        {
        	var valido=ValidarDatosActualizar();
        	if(valido=="Completo"){
        		$("#idFicha_Venta").attr("tipo_actualizacion","Validacion_BO");
            	$('#confirmar-actualizar-ficha').modal('show');
           	}else{
           		//alert(valido);
           		$("#title_moda_validacion").text("ERROR AL GUARDAR VALIDACIÓN DE LA FICHA");
				$("#label_moda_validacion").text("Completar los campos sombreados de rojo");
           		$('#confirmar-validacion_datos').modal('show');
           		
           	}           
           
        });

 


        $('#btnActualizarFichaVenta_RRBO').click(function()
        {
        	var valido=ValidarDatosActualizar();
        
        	if(valido=="Completo"){
        		$("#idFicha_Venta").attr("tipo_actualizacion","Recup_Repro_BO");
            	$('#confirmar-actualizar-ficha').modal('show');
           	}else{
           		//alert(valido);
           		$("#title_moda_validacion").text("ERROR AL GUARDAR RECUPERO O REPROGRAMACIÓN DE LA FICHA");
				$("#label_moda_validacion").text("Completar los campos sombreados de rojo");
           		$('#confirmar-validacion_datos').modal('show');
           	}           
        });

        $('#btnRetornarFichaVenta').click(function()
        {
        	window.location=<?php echo "'".$urlRetorno."'"; ?>;
        })

        $(".validar_txt").keypress(function() {
        	id=$(this).attr('id');


        });

        $(".validar_txt").on('change keyup blur', function() { 
        	id=$(this).attr('id');
        	value=$(this).val();
        	
        	if(value!=""){
        		$("#div-"+id).removeClass('has-error').addClass('has-success');
        	}else{
        		$("#div-"+id).removeClass('has-success').addClass('has-error');	
        	}
       	});

       	$(".validar_cbo").on('change blur', function() { 
        	id=$(this).attr('id');
        	value=$(this).val();
        	obligatorio=$(this).attr('obligatorio');
        	if(value!=0){

        		$("#div-"+id).removeClass('has-error').addClass('has-success');
        	}else{

        		if (obligatorio=="NO") {
        			$("#div-"+id).removeClass('has-success').removeClass('has-error');
        		}else{
        			$("#div-"+id).removeClass('has-success').addClass('has-error');
        		}
        	}
       	});






	});


</script>

