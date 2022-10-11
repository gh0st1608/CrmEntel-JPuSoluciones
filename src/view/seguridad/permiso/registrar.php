<?php 
error_reporting(E_ALL);
ini_set('display_errors','1');

?>
<?php
require_once 'controller/interfaz.controller.php';
$interfaz = new InterfazController;
$modulosprincipales = $interfaz -> ConsultaModuloPrincipal();


if (!isset($_REQUEST['idPerfil'])==''){

?>
<!-- Content Header (Page header) -->
<section class="content-header">  
	<h1>
		Modulo Seguridad
	</h1>
	<ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="index.php?c=Permiso">Permiso</a></li>
            <li class="active">Registrar</li>
          </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-sm-12 col-md-6 col-md-offset-3">
	  		<div class="box">
	    		<div class='box-header with-border'>
	      			<h3 class='box-title'><i class="fa fa-users"></i> Registrar Permiso</h3>
	    		</div>
	    		<div class="box-body">
	    			<form id="frmRegistrarPermiso" action="?c=Permiso&a=Registrar" method="post" enctype="multipart/form-data" role="form">
					    <div class="form-group col-md-12">
					        <label>idPerfil</label>
					        <input type="text" name="idPerfil" id="idPerfil"  value="<?php echo $_REQUEST['idPerfil']; ?>" class="form-control" placeholder="" disabled  required />
					    </div>
						<div class="form-group col-md-12">
							<label>Modulo Principal</label>
							<select name="ModuloPrincipal" id="ModuloPrincipal" class="form-control">
								<option value="0">-- Seleccionar Modulo Principal--</option>      
							<?php foreach ($modulosprincipales as $modulo): ?>                
								<option value="<?php echo $modulo['idInterfaz']; ?>"><?php echo $modulo['Nombre']; ?></option>                      
							<?php endforeach; ?>    
				        	</select> 
				    	</div>
						<div class="form-group col-md-12">
							<label>Modulo Secundario</label>
							<select name="ModuloSecundario" id="ModuloSecundario" disabled class="form-control"></select> 
				    	</div>
						<div class="form-group col-md-12">
							<label>Acciones</label>
							<select name="Acciones" id="Acciones" disabled class="form-control"></select> 				
				    	</div>
						
					  	<div class="col-md-12" style="margin-top:2em;">
							<div class="col-md-6 col-sm-12">
								<button type="button" name="AgregarPermiso" id="AgregarPermiso" class="btn btn-success col-md-12 col-xs-12"><i class="fa fa-save"></i> Registrar</button>    
							</div>
					  	</div>

						<div class="box-body box-body_table">
								<?php  $permisos = $this->Listar();  ?>
		
							<table id="TablaPermiso" class="table table-bordered table-hover dataTable no-footer" width="100%">
								<thead>
									<tr>                      
										<th>ID</th>                    
										<th style="vertical-align: middle;">Modulo</th>			                   
										<th style="vertical-align: middle;">Interface</th>
										<th style="vertical-align: middle;">Acceder</th>
										<th style="vertical-align: middle;">Acciones</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><?php echo $perfil['idPerfil']; ?></td>
										<td><?php echo $perfil['Nombre']; ?></td>
										<?php if ($perfil['Estado']==1): ?>
										<td class=""><span class="label label-success"><i class="fa fa-check-square-o" aria-hidden="true"></i> Activo</span></td>
										<?php else: ?>
										<td class=""><span class="label label-danger"><i class="fa fa-square-o" aria-hidden="true"></i> Inactivo</span></td>
										<?php endif ?>
										<td class="a_center">
											<a class="btn btn-danger btn-xs EliminarPermiso" data-id="<?php echo $permiso['idPermiso']; ?>" data-nombre="<?php echo $permiso['Nombre']; ?>">
												<i class="fa fa-trash"></i>   
											</a>                       		
										</td>
									</tr>
								</tbody>
							</table>                    
						</div>

					</form>
                    
                    


                	</div>
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
<script>
	
	$(document).ready(function() {
		$("#btnSubmit").click(function(event) {

			bootbox.dialog({
	            message: "¿Estas seguro de registrar esta interfaz?",
	            title: "Registrar Interfaz",
	            buttons: {
	                main: {
	                    label: "Registrar",
	                    className: "btn-primary",
	                    callback: function() {
	                        //console.log('Eliminado al usuario');
	                        
	                              $( "#frmRegistrarInterfaz" ).submit();
	                         

	                       
	                    }
	                },
	                danger: {
	                    label: "Cancelar",
	                    className: "btn-danger",
	                    callback: function() {
	                        bootbox.hideAll();
	                    }
	                }
	            }
        	}); 
		});

		
	});

	$("#ModuloPrincipal").change(function(){
	 		var parametros= "id_moduloprincipal="+$("#ModuloPrincipal").val();
			console.log(parametros);
	 		$.ajax({
                data:  parametros,
                url:   'utils/auxiliares.php',
                type:  'post',
                beforeSend: function () { },
                success:  function (response) {             	
                    $("#ModuloSecundario").html(response);
                },
                error:function(){
                	alert("error")
                }
            });
	})

	$("#ModuloSecundario").change(function(){
	 		var parametros= "id_moduloprincipal="+$("#ModuloPrincipal").val()+"&"+"id_modulosecundario="+$("#ModuloSecundario").val();
			 console.log(parametros);
	 		$.ajax({
                data:  parametros,
                url:   'utils/auxiliares.php',
                type:  'post',
                beforeSend: function () { },
                success:  function (response) {        	
                    $("#Acciones").html(response);
                },
                error:function(){
                	alert("error")
                }
            });
	})



	$(document).ready(function () {
		$('#btnSubmit').attr("disabled", true);
			$('#Nombre').keyup(function () {
				var buttonDisabled = $('#Nombre').val().length == 0;
				$('#btnSubmit').attr("disabled", buttonDisabled);
			});
		});
 

	
	
	$(document).ready(function () { 
		$("#ModuloPrincipal").change(function(){
	 		var ModuloPrincipal= $("#ModuloPrincipal").val() == 0;
			console.log(ModuloPrincipal);
			if(!ModuloPrincipal)
			{
				console.log(ModuloPrincipal);
				$("#ModuloSecundario").prop("disabled",false);
			}
		});
	});

	$(document).ready(function () { 
		$("#ModuloSecundario").change(function(){
	 		var ModuloSecundario= $("#ModuloSecundario").val() == 0;
			if(!ModuloSecundario)
			{
				$("#Acciones").prop("disabled",false);
			}
		});
	});
			 
				

</script>
<?php }/*--- END REQUESt*/ ?>