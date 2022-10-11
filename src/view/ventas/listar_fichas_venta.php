 
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
 ?>
 <!-- Content Header (Page header) -->
<section class="content-header">  
	<h1>
		Ficha de Venta <small>Listar </small>
	</h1>
	<ol class="breadcrumb">
	    <li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Listar Fichas de Venta</li>
	</ol>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-danger_dark">
				<div class="panel-heading"> 
					<h3 class="panel-title">Fichas de Venta</h3>
				</div>
				<div class="panel-body">	    			
					<div class="form-group col-md-2" id="div-Busc_Fecha_Inicio">
						<label class="" for="Busc_Fecha_Inicio">Fecha Inicio</label>
						<input type="date" class="form-control input-sm" id="Busc_Fecha_Inicio" name="Busc_Fecha_Inicio"  value="<?php if($Busc_Fecha_Inicio<>""){echo $Busc_Fecha_Inicio;}else{echo Date("Y-m-d");} ?>">
					</div>	    			
					<div class="form-group col-md-2" id="div-Busc_Fecha_Fin">
						<label class="" for="Busc_Fecha_Fin">Fecha Fin</label>
						<input type="date" class="form-control input-sm" id="Busc_Fecha_Fin" name="Busc_Fecha_Fin"  value="<?php if($Busc_Fecha_Fin<>""){echo $Busc_Fecha_Fin;}else{echo Date("Y-m-d");} ?>">
					</div>
                    <div class="form-group col-md-2" id="div-DP_Documento">
						<label class="" for="DP_Documento">Documento</label>
						<input type="text" class="form-control input-sm validar_txt" id="DP_Documento" name="DP_Documento" value="<?php if($DP_Documento<>""){echo $DP_Documento;} ?>">
					</div>	    			
					<div class="form-group col-md-2" id="div-RE_Tipo_Despacho">  
                        <label class="" for="RE_Tipo_Despacho">Tipo Despacho</label>
                        <select class="form-control input-sm" id="RE_Tipo_Despacho" name="RE_Tipo_Despacho" idcategoria="11" data-reload="<?php echo $RE_Tipo_Despacho;?>">
                        	<option value="0">-- Seleccionar --</option>                     
                        </select>
                    </div>
                    <div class="form-group col-md-2" id="div-RE_Rango_Entrega_Despacho">  
                        <label class="" for="RE_Rango_Entrega_Despacho">Rango Entrega Despacho</label>
                        <select class="form-control input-sm" id="RE_Rango_Entrega_Despacho" name="RE_Rango_Entrega_Despacho" idcategoria="12" data-reload="<?php echo $RE_Rango_Entrega_Despacho;?>">
                        	<option value="0">-- Seleccionar --</option>                     
                        </select>
                    </div>
                    <div class="form-group col-md-2" id="div-RV_Tipo_Ofrecimiento">  
                        <label class="" for="RV_Tipo_Ofrecimiento">Tipo Ofrecimiento</label>
                        <select class="form-control input-sm" id="RV_Tipo_Ofrecimiento" name="RV_Tipo_Ofrecimiento" idcategoria="20"  data-reload="<?php echo $RV_Tipo_Ofrecimiento;?>">
                        	<option value="0">-- Seleccionar --</option>                     
                        </select>
                    </div>
                    <div class="form-group col-md-2" id="div-RV_Tipo_Venta">  
                        <label class="" for="RV_Tipo_Venta">Tipo Venta</label>
                        <select class="form-control input-sm" id="RV_Tipo_Venta" name="RV_Tipo_Venta" idcategoria="21" data-reload="<?php echo $RV_Tipo_Venta;?>">
                        	<option value="0">-- Seleccionar --</option>                     
                        </select>
                    </div>
                    <div class="form-group col-md-2" id="div-RV_Linea_Portar">
						<label class="" for="RV_Linea_Portar">Linea a portar</label>
						<input type="text" class="form-control input-sm validar_txt" id="RV_Linea_Portar" name="RV_Linea_Portar" value="<?php if($RV_Linea_Portar<>""){echo $RV_Linea_Portar;}?>">
					</div>
					<div class="form-group col-md-2" id="div-RV_Tipo_Producto">  
                        <label class="" for="RV_Tipo_Producto">Tipo de Producto</label>
                        <select class="form-control input-sm" id="RV_Tipo_Producto" name="RV_Tipo_Producto" idcategoria="26" data-reload="<?php echo $RV_Tipo_Producto;?>">
                        	<option value="0">-- Seleccionar --</option>                     
                        </select>
                    </div>
                    <div class="form-group col-md-2" id="div-VBO_Estado_Venta_BO">  
                        <label class="" for="VBO_Estado_Venta_BO">Estado Venta BO</label>
                        <select class="form-control input-sm" id="VBO_Estado_Venta_BO" name="VBO_Estado_Venta_BO" idcategoria="31" data-reload="<?php echo $VBO_Estado_Venta_BO;?>">
                        	<option value="0">-- Seleccionar --</option>                     
                        </select>
                    </div>                    
                    <div class="form-group  col-md-4 <?php if ($_SESSION['Perfil_Actual']==4): ?> hidden <?php endif ?>" id="div-Supervisor_Vendedor">   
                        <label class="" for="Supervisor_Vendedor">Supervisor</label>
                        <select class="form-control input-sm" id="Supervisor_Vendedor" name="Supervisor_Vendedor" data-reload="<?php echo $Supervisor_Vendedor;?>">
                        	<option value="0">-- Seleccionar --</option>                     
                        </select>
                    </div>

                    	
                   
                    <div class="form-group col-md-2 <?php if ($_SESSION['Perfil_Actual']==4): ?> hidden <?php endif ?>" id="div-Documento_Vendedor" >
						<label class="" for="Documento_Vendedor">Documento Vendedor</label>
						<input type="text" class="form-control input-sm validar_txt" id="Documento_Vendedor" name="Documento_Vendedor" value="<?php if($Documento_Vendedor<>""){echo $Documento_Vendedor;} ?>">
					</div>
                    <div class="form-group col-md-1">
                        <label for="" style="color:transparent;">a</label><br>
                        <button type="button" class="btn btn-primary col-md-12" onclick="buscar()"><i class="fa fa-search"></i></button>         
                    </div>
                    <div class="form-group col-md-1">
                        <label for="" style="color:transparent;">a</label><br>
                        <button type="button" class="btn btn-danger col-md-12" onclick="borrar()"><i class="fa fa-trash-o"></i> </button>        
                    </div>
				</div>
				<div class="panel-body">
					<table id="TableFichas" class="table cell-border table-hover dataTable no-footer" width="100%" style="font-size: 10px;text-align: center;">
	                    <thead>
	                      	<tr style="background-color: gainsboro;border:;"> 	
	                      		<th style="vertical-align: middle;border 1px solid !important,text-align:center;">N°</th>
			                    <th style="vertical-align: middle;border 1px solid !important,text-align:center;min-width: 40px;">FECHA VENTA</th>
			                    <th style="vertical-align: middle;border 1px solid !important,text-align:center;">HORA VENTA</th>
			                    <th style="vertical-align: middle;border 1px solid !important,text-align:center;">NRO DOCUMENTO</th>
			                    <th style="vertical-align: middle;border 1px solid !important,text-align:center;">TIPO DESPACHO</th>
			                    <th style="vertical-align: middle;border 1px solid !important,text-align:center;">RANGO ENTREGA DESPACHO</th>
			                    <th style="vertical-align: middle;border 1px solid !important,text-align:center;">RANGO HORARIO DESPACHO</th>
			                    <th style="vertical-align: middle;border 1px solid !important,text-align:center;">DEPARTAMENTO ENTREGA PRODUCTO</th>
			                    <th style="vertical-align: middle;border 1px solid !important,text-align:center;">PROVINCIA ENTREGA PRODUCTO</th>
			                    <th style="vertical-align: middle;border 1px solid !important,text-align:center;">DISTRITO ENTREGA PRODUCTO</th>
			                    <th style="vertical-align: middle;border 1px solid !important,text-align:center;">SLA ENTREGA</th>
			                    <th style="vertical-align: middle;border 1px solid !important,text-align:center;">TIPO OFRECIMIENTO</th>
			                    <th style="vertical-align: middle;border 1px solid !important,text-align:center;">TIPO VENTA</th>
			                    <th style="vertical-align: middle;border 1px solid !important,text-align:center;">LINEA PORTAR</th>
			                    <th style="vertical-align: middle;border 1px solid !important,text-align:center;">TIPO DE PRODUCTO</th>
			                    <th style="vertical-align: middle;border 1px solid !important,text-align:center;">SUPERVISOR</th>
			                    <th style="vertical-align: middle;border 1px solid !important,text-align:center;">ESTADO VENTA BO</th>
			                    <th style="vertical-align: middle;border 1px solid !important,text-align:center;">SUB ESTADO BO</th>
			                    <th style="vertical-align: middle;border 1px solid !important,text-align:center;">TIPO DE ATENCION FINAL</th>
			                    <th style="vertical-align: middle;border 1px solid !important,text-align:center;min-width: 75px;">BACK OFFICE - VALIDADOR GESTOR</th>
			                    <th style="vertical-align: middle;border 1px solid !important,text-align:center;min-width: 75px;">BACK OFFICE - RECUPERO / REPRO GESTOR </th>
			                    <th style="vertical-align: middle;border 1px solid !important,text-align:center;min-width: 40px;">ACCIÓN</th>
	                     	</tr>
	                    </thead>	                    
	                    <tbody>

	                    
	                    </tbody>
                	</table>
				</div>
			</div>
		</div>

    </div><!-- /.row -->
</section><!-- /.content -->
<script type="text/javascript" language="javascript" >
	function ActualizarFicha(idFicha_Venta){

		var Busc_Fecha_Inicio=$("#Busc_Fecha_Inicio").val();
		var Busc_Fecha_Fin=$("#Busc_Fecha_Fin").val();
		var DP_Documento=$("#DP_Documento").val();
		var RE_Tipo_Despacho=$("#RE_Tipo_Despacho").val();
		var RE_Rango_Entrega_Despacho=$("#RE_Rango_Entrega_Despacho").val();
		var RV_Tipo_Ofrecimiento=$("#RV_Tipo_Ofrecimiento").val();
		var RV_Tipo_Venta=$("#RV_Tipo_Venta").val();
		var RV_Linea_Portar=$("#RV_Linea_Portar").val();
		var RV_Tipo_Producto=$("#RV_Tipo_Producto").val();
		var VBO_Estado_Venta_BO=$("#VBO_Estado_Venta_BO").val();
		var Supervisor_Vendedor=$("#Supervisor_Vendedor").val();
		var Documento_Vendedor=$("#Documento_Vendedor").val();

		window.location="index.php?c=Ficha_Venta&a=v_Actualizar_Ficha&idFicha_Venta="+idFicha_Venta+"&Busc_Fecha_Inicio="+Busc_Fecha_Inicio+"&Busc_Fecha_Fin="+Busc_Fecha_Fin+"&DP_Documento="+DP_Documento+"&RE_Tipo_Despacho="+RE_Tipo_Despacho+"&RE_Rango_Entrega_Despacho="+RE_Rango_Entrega_Despacho+"&RV_Tipo_Ofrecimiento="+RV_Tipo_Ofrecimiento+"&RV_Tipo_Venta="+RV_Tipo_Venta+"&RV_Linea_Portar="+RV_Linea_Portar+"&RV_Tipo_Producto="+RV_Tipo_Producto+"&VBO_Estado_Venta_BO="+VBO_Estado_Venta_BO+"&Supervisor_Vendedor="+Supervisor_Vendedor+"&Documento_Vendedor="+Documento_Vendedor+"";
	}

	function VisualizarFicha(idFicha_Venta){
		var Busc_Fecha_Inicio=$("#Busc_Fecha_Inicio").val();
		var Busc_Fecha_Fin=$("#Busc_Fecha_Fin").val();
		var DP_Documento=$("#DP_Documento").val();
		var RE_Tipo_Despacho=$("#RE_Tipo_Despacho").val();
		var RE_Rango_Entrega_Despacho=$("#RE_Rango_Entrega_Despacho").val();
		var RV_Tipo_Ofrecimiento=$("#RV_Tipo_Ofrecimiento").val();
		var RV_Tipo_Venta=$("#RV_Tipo_Venta").val();
		var RV_Linea_Portar=$("#RV_Linea_Portar").val();
		var RV_Tipo_Producto=$("#RV_Tipo_Producto").val();
		var VBO_Estado_Venta_BO=$("#VBO_Estado_Venta_BO").val();
		var Supervisor_Vendedor=$("#Supervisor_Vendedor").val();
		var Documento_Vendedor=$("#Documento_Vendedor").val();
		window.location="index.php?c=Ficha_Venta&a=v_Visualizar_Ficha&idFicha_Venta="+idFicha_Venta+"&Busc_Fecha_Inicio="+Busc_Fecha_Inicio+"&Busc_Fecha_Fin="+Busc_Fecha_Fin+"&DP_Documento="+DP_Documento+"&RE_Tipo_Despacho="+RE_Tipo_Despacho+"&RE_Rango_Entrega_Despacho="+RE_Rango_Entrega_Despacho+"&RV_Tipo_Ofrecimiento="+RV_Tipo_Ofrecimiento+"&RV_Tipo_Venta="+RV_Tipo_Venta+"&RV_Linea_Portar="+RV_Linea_Portar+"&RV_Tipo_Producto="+RV_Tipo_Producto+"&VBO_Estado_Venta_BO="+VBO_Estado_Venta_BO+"&Supervisor_Vendedor="+Supervisor_Vendedor+"&Documento_Vendedor="+Documento_Vendedor+"";
	}

	function ListarSubCategorias()
	{
		
	    $.ajax({
	      	type: "POST",
	      	url: 'index.php?c=SubCategoria&a=ListarSubCategoriasAjax',
	      	//sync:false,        
	      	success: function(data) {

				const Categorias = [
					{idCategoria:11,NombreSelect:'RE_Tipo_Despacho'},
					{idCategoria:12,NombreSelect:'RE_Rango_Entrega_Despacho'},
					{idCategoria:20,NombreSelect:'RV_Tipo_Ofrecimiento'},
					{idCategoria:21,NombreSelect:'RV_Tipo_Venta'},
					{idCategoria:26,NombreSelect:'RV_Tipo_Producto'},
					{idCategoria:31,NombreSelect:'VBO_Estado_Venta_BO'}
				
				];

				
				Categorias.forEach(function(index,idCategoria,NombreSelect) {
					let FilterCat_id = data.filter(data => data.Categoria_id == index.idCategoria )
					RellenarSelect_SubCategorias(FilterCat_id,index.NombreSelect)
				});  
				$("#RE_Tipo_Despacho").val($("#RE_Tipo_Despacho").attr('data-reload'));
				$("#RE_Rango_Entrega_Despacho").val($("#RE_Rango_Entrega_Despacho").attr('data-reload'));
				$("#RV_Tipo_Ofrecimiento").val($("#RV_Tipo_Ofrecimiento").attr('data-reload'));
				$("#RV_Tipo_Venta").val($("#RV_Tipo_Venta").attr('data-reload'));
				$("#RV_Tipo_Producto").val($("#RV_Tipo_Producto").attr('data-reload'));
				$("#VBO_Estado_Venta_BO").val($("#VBO_Estado_Venta_BO").attr('data-reload')); 
				$("#Supervisor_Vendedor").val($("#Supervisor_Vendedor").attr('data-reload'));
				buscar();

	        	               
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
function borrar(){	
	
$("#Busc_Fecha_Inicio").val(<?php echo "'".Date("Y-m-d")."'";?>);
$("#Busc_Fecha_Fin").val(<?php echo "'".Date("Y-m-d")."'";?>);
$("#DP_Documento").val("");
$("#RE_Tipo_Despacho").val(0);
$("#RE_Rango_Entrega_Despacho").val(0);
$("#RV_Tipo_Ofrecimiento").val(0);
$("#RV_Tipo_Venta").val(0);
$("#RV_Linea_Portar").val("");
$("#RV_Tipo_Producto").val(0);
$("#VBO_Estado_Venta_BO").val(0);
$("#Supervisor_Vendedor").val(0);
$("#Documento_Vendedor").val("");
	buscar();
}

function buscar(){
	var table = $('#TableFichas').dataTable().api();
	
	table.destroy();

	var Busc_Fecha_Inicio=$("#Busc_Fecha_Inicio").val();
	var Busc_Fecha_Fin=$("#Busc_Fecha_Fin").val();
	var DP_Documento=$("#DP_Documento").val();
	var RE_Tipo_Despacho=$("#RE_Tipo_Despacho").val();
	var RE_Rango_Entrega_Despacho=$("#RE_Rango_Entrega_Despacho").val();
	var RV_Tipo_Ofrecimiento=$("#RV_Tipo_Ofrecimiento").val();
	var RV_Tipo_Venta=$("#RV_Tipo_Venta").val();
	var RV_Linea_Portar=$("#RV_Linea_Portar").val();
	var RV_Tipo_Producto=$("#RV_Tipo_Producto").val();
	var VBO_Estado_Venta_BO=$("#VBO_Estado_Venta_BO").val();
	var Supervisor_Vendedor=$("#Supervisor_Vendedor").val();
	var Documento_Vendedor=$("#Documento_Vendedor").val();

		$('#TableFichas').DataTable({
			"language": {
		    url: '<?php echo RUTA_HTTP; ?>/assets/plugins/datatables/json/Spanish.json'
			},			
			"aLengthMenu": [[10, 20, 30, 50, 100], [10, 20, 30, 50, 100]],
			"ordering": false,
			 scrollX: true,
			"bFilter": false,
			"processing": true,
			"serverSide": true,
			 stateSave: true,
			"ajax": "index.php?c=Ficha_Venta&a=ListarFichaVentas&Busc_Fecha_Inicio="+Busc_Fecha_Inicio+"&Busc_Fecha_Fin="+Busc_Fecha_Fin+"&DP_Documento="+DP_Documento+"&RE_Tipo_Despacho="+RE_Tipo_Despacho+"&RE_Rango_Entrega_Despacho="+RE_Rango_Entrega_Despacho+"&RV_Tipo_Ofrecimiento="+RV_Tipo_Ofrecimiento+"&RV_Tipo_Venta="+RV_Tipo_Venta+"&RV_Linea_Portar="+RV_Linea_Portar+"&RV_Tipo_Producto="+RV_Tipo_Producto+"&VBO_Estado_Venta_BO="+VBO_Estado_Venta_BO+"&Supervisor_Vendedor="+Supervisor_Vendedor+"&Documento_Vendedor="+Documento_Vendedor+"",
	        "columns": [
	            { "data": 'Nro' },
	            { "data": 'Fecha_Venta' },
	            { "data": 'Hora_Venta' },
	            { "data": 'DP_Documento' },
	            { "data": 'RE_Tipo_Despacho' },
	            { "data": 'RE_Rango_Entrega_Despacho' },
	            { "data": 'RE_Rango_Horario_Despacho' },
	            { "data": 'RE_Dpto_Entrega_Producto' },
	            { "data": 'RE_Prov_Entrega_Producto' },
	            { "data": 'RE_Dist_Entrega_Producto' },
	            { "data": 'SLA_Entrega' },
	            { "data": 'RV_Tipo_Ofrecimiento' },
	            { "data": 'RV_Tipo_Venta' },
	            { "data": 'RV_Linea_Portar' },
	            { "data": 'RV_Tipo_Producto' },
	            { "data": 'Supervisor_Vendedor' },
	            { "data": 'VBO_Estado_Venta_BO' },
	            { "data": 'VBO_Sub_Estado_Venta_BO' },
	            { "data": 'DGBO_Tipo_Atencion_Final' },
	            { "data": 'DGBO_BO_Validador_Gestor' },
	            { "data": 'DGBO_BO_Recupero_Repro_Gestor' },
	            {
		        	"mData": null,
		        	"bSortable": false,
		        	"bFilterable": false,
		        	"mRender": function (data, type, row){               
		      			return ' <a href="#" onclick="ActualizarFicha('+row.idFicha_Venta+')" class="btn btn-warning btn-xs '+row.BloquearAct+'" data-toggle="tooltip" data-placement="top" title="Actualizar Ficha de Venta"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> <a href="#" onclick="VisualizarFicha('+row.idFicha_Venta+')" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Visualizar Ficha de Venta"><i class="fa fa-eye" aria-hidden="true"></i></a>';
		    		}	
	    		}
	        ]
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


	$(document).ready(function() {
		
		ListarSubCategorias();
		ListarSupervisoresVenta("Supervisor_Vendedor");



	} );


</script>