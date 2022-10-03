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

        <div class="col-xs-12">
	  		<div class="box">
	    		
	    		<div class="box-body box-body_table">
 
                  	<table id="TableFichas" class="table table-bordered table-hover dataTable no-footer" width="100%" style="font-size: 12px;">
	                    <thead>
	                      	<tr>                 
			                    <th style="vertical-align: middle;">ID</th>
			                    <th style="vertical-align: middle;">Codigo Ficha</th>
			                    <th style="vertical-align: middle;">Documento</th>
			                    <th style="vertical-align: middle;">Nombre Cliente</th>
			                    <th style="vertical-align: middle;">Estado de Venta</th>
			                    <th style="vertical-align: middle;">Acción</th>
	                     	</tr>
	                    </thead>	                    
	                    <tbody>

	                    
	                    </tbody>
                	</table>                    
                </div>
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
<script type="text/javascript" language="javascript" >
	function ActualizarFicha(idFicha_Venta){
		window.location="index.php?c=Ficha_Venta&a=v_Actualizar_Ficha&idFicha_Venta="+idFicha_Venta;
	}

	$(document).ready(function() {
		$('#TableFichas').DataTable({
			"language": {
		    url: '<?php echo RUTA_HTTP; ?>/assets/plugins/datatables/json/Spanish.json'
			},			
			"aLengthMenu": [[10, 20, 30, 50, 100], [10, 20, 30, 50, 100]],
			"ordering": false,
			"bFilter": false,
			"processing": true,
			"serverSide": true,
			 stateSave: true,
			"ajax": "index.php?c=Ficha_Venta&a=ListarFichaVentas",
	        "columns": [
	            { "data": 'Nro' },
	            { "data": 'idFicha_Venta' },
	            { "data": 'Cliente_id' },
	            { "data": 'DE_Campana_Netcall' },
	            { "data": 'VBO_Estado_Venta_BO' },
	            {
		        	"mData": null,
		        	"bSortable": false,
		        	"bFilterable": false,
		        	"mRender": function (data, type, row){               
		      			return ' <a href="#" onclick="ActualizarFicha('+row.idFicha_Venta+')" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Actualizar Ficha de Venta"><i class="fa fa-list-ol" aria-hidden="true"></i></a>';
		    		}	
	    		}
	        ]
		});


	} );


</script>