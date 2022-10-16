<?php 
error_reporting(E_ALL);
ini_set('display_errors','1');

?>
<?php
require_once 'controller/interfaz.controller.php';
require_once 'controller/permiso.controller.php';
$interfaz = new InterfazController;
$permiso = new PermisoController;
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
					        <input type="text" name="idPerfil" id="idPerfil"  value="<?php echo $_REQUEST['idPerfil']; ?>" class="form-control" placeholder="" readonly  required />
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
						
                        <div class="form-group col-md-12" style="display:none;">
							<label>Acciones</label>
							<select name="Acciones" id="Acciones" disabled class="form-control"></select> 				
				    	</div>
						
					  	<div class="col-md-12" style="margin-top:2em;">
							<div class="col-md-6 col-sm-12">
								<button type="btnSubmit" name="AgregarPermiso" id="AgregarPermiso" class="btn btn-success col-md-12 col-xs-12"><i class="fa fa-save"></i> Registrar</button>    
							</div>
					  	</div>

						<div class="box-body box-body_table">
								<?php  $permisos = $this->Listar_por_perfil($_REQUEST['idPerfil']);  ?>

							<table id="TablaPermiso" class="table table-bordered table-hover dataTable no-footer" width="100%">
								<thead>
									<tr>                      
										<th>ID</th>                    
										<th style="vertical-align: middle;">Modulo Principal</th>
										<th style="vertical-align: middle;">Modulo Secundario</th>
										<th style="vertical-align: middle;">Tipo Permiso</th>			                   
										<th style="vertical-align: middle;">Acceder</th>
										<th style="vertical-align: middle;">Accion</th>

									</tr>
								</thead>
								<tbody>
									<tr>
                                        <?php foreach ($permisos as $permiso): ?>
										<td><?php echo $permiso['idPermiso']; ?></td>
                                        <?php $interfaz_obj = $interfaz->ConsultarInterfaz($permiso['Interfaz_id']);?>
                                        <td><?php echo $interfaz_obj->Nombre; ?></td>
                                        <?php $modprincipal = $interfaz->ConsultarInterfaz($interfaz_obj->Modulo_Principal);?>
										<td><?php echo $modprincipal->Nombre ?></td>
                                        <td><?php echo "Por Definir"?></td>
                                        <?php if ($permiso['Acceder']==1): ?>
                                        <td> Si</td>
                                        <?php else: ?>
                                        <td> No</td>
                                        <?php endif ?>
                                        <td class="a_center">
                                            <a class="btn btn-danger btn-xs EliminarPermiso" data-perfil_id="<?php echo $permiso['Perfil_id']; ?>" data-id="<?php echo $permiso['idPermiso']; ?>" data-nombre="<?php echo $permiso['idPermiso']; ?>">
                                            <i class="fa fa-trash"></i>   
                                            </a>
											<a class="btn btn-default btn-xs InhabilitarPermiso" data-perfil_id="<?php echo $permiso['Perfil_id']; ?>" data-id="<?php echo $permiso['idPermiso']; ?>" data-nombre="<?php echo $interfaz_obj -> Nombre; ?>">
                                            <i class="fa fa-ban" aria-hidden="true"></i> 
                                            </a>
                                        </td>   
									</tr>
                                    <?php endforeach; ?>
								</tbody>
							</table>
                            <div class="col-md-12" style="margin-top:2em;">
							<div class="col-md-6 col-sm-12">
								<button type="btnSubmit" name="Cancelar" id="Cancelar" class="btn btn-danger col-md-12 col-xs-12"><i class="fa fa-save"></i> Cancelar</button>    
							</div>
					  	</div>
                            
						</div>

					</form>
                    
                    


                	</div>
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
<script>
	
	$(document).ready(function() {
		$(".EliminarPermiso").click(function(event) {
			idPermiso=$(this).attr('data-id');
			Perfil_id=$(this).attr('data-perfil_id');

			bootbox.dialog({
            message: "¿Estas seguro de eliminar el permiso  "+$(this).attr('data-nombre')+"?",
            title: "Eliminar Permiso",
            buttons: {
                main: {
                    label: "Eliminar",
                    className: "btn-primary",
                    callback: function() {
                              window.location.href = "?c=Permiso&a=Eliminar&idPermiso="+idPermiso+"&Perfil_id="+Perfil_id;             
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


	$(document).ready(function() {
		$(".InhabilitarPermiso").click(function(event) {
			idPermiso=$(this).attr('data-id');
			Perfil_id=$(this).attr('data-perfil_id');

			bootbox.dialog({
            message: "¿Estas seguro de inhabilitar el permiso  "+$(this).attr('data-nombre')+"?",
            title: "Inhabilitar Permiso",
            buttons: {
                main: {
                    label: "Inhabilitar",
                    className: "btn-primary",
                    callback: function() {
                              window.location.href = "?c=Permiso&a=Inhabilitar&idPermiso="+idPermiso+"&Perfil_id="+Perfil_id;             
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


    $(document).ready(function() {
			$("#AgregarPermiso").click(function(event) {
					bootbox.dialog({
						message: "¿Estas seguro de Registrar?",
						title: "Registrar Permiso",
						buttons: {
							main: {
								label: "Registrar",
								className: "btn-primary",
								callback: function() {
									//console.log('Eliminado al usuario');
									
										$( "#frmRegistrarPermiso" ).submit();
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
				})
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