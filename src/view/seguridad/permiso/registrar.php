<?php
require_once 'controller/interfaz.controller.php';
$interfaz = new InterfazController;
$interfazes = $interfaz -> Listar();


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
					        <input type="text" name="idPerfil" id="idPerfil" value="<?php echo $perfil->__GET('idPerfil'); ?>" class="form-control" placeholder=""  required />
					    </div>
						<div class="form-group col-md-12">
							<label>Modulo Principal</label>
							<select name="modulo" id="modulo" class="form-control">
								<option value="0">-- Seleccionar Modulo--</option>      
							<?php foreach ($interfazes as $interfaz): ?>                
								<option value="<?php echo $interfaz['idInterfaz']; ?>"><?php echo $interfaz['Nombre']; ?></option>                      
							<?php endforeach; ?>    
				        	</select> 
				    	</div>
						<!--<div class="form-group col-md-12">
							<label>Modulo Secundario</label>
							<select name="modulosecundario" id="modulosecundario" class="form-control">
								<div class="form-group col-md-12" id="modulosecundario"></div>
				        	</select> 
				    	</div>-->
						
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
                            		<a href="?c=Perfil&a=v_Actualizar&idPerfil=<?php echo $perfil['idPerfil']; ?>" class="btn btn-primary btn-xs ">
                                   		<i class="fa fa-pencil"></i>   
                               		</a>
                               		<a class="btn btn-danger btn-xs EliminarPerfil" data-id="<?php echo $perfil['idPerfil']; ?>" data-nombre="<?php echo $perfil['Nombre']; ?>">
                                   		<i class="fa fa-trash"></i>   
                               		</a>
									<a href="?c=Permiso&a=v_Actualizar&idPermiso" class="btn btn-info btn-xs VerPermisos" data-id="<?php echo $perfil['idPerfil']; ?>" data-nombre="<?php echo $perfil['Nombre']; ?>">
                                   		<i class="fa fa-trash"></i>   
                               		</a>                             		
                               	</td>
	                    	</tr>
	                    	<?php endforeach; ?>
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



	$(document).ready(function () {
		$('#btnSubmit').attr("disabled", true);
			$('#Nombre').keyup(function () {
				var buttonDisabled = $('#Nombre').val().length == 0;
				$('#btnSubmit').attr("disabled", buttonDisabled);
			});
		});
 
	$(document).ready(function () { 
		$("#modulo").change(function(){
	 		var modulo= $("#modulo").val();
			console.log(modulo);
			$.ajax({ 
				type:"POST",
				data:"idInterfaz="+ modulo,
                url:"?c=Interfaz&a=ComboModuloSecundario",
   
                success:  function (response) {                	
                    $("#modulosecundario").html(response);
					 
                },
                error:function(){
                	alert("error")
                }
            });
			nivel_modulo = localStorage.getItem("modulo_nivel");
			if(nivel_modulo== 2){
				var idInterfaz_superior= $("#modulo").val();
				console.log(idInterfaz_superior);
				$.ajax({ 
						type:"POST",
						data:"idInterfaz_superior="+idInterfaz_superior,
						url:"?c=Interfaz&a=ComboOrden",
		
						success:  function (response) {                	
							$("#orden").html(response);
							console.log(nivel);
						},
							error:function(){
								alert("error")
							}
						}); 
			}
			




	 	})

		
	});	


	
	$(document).ready(function () { 
		$("#nivel").change(function(){
	 		var nivel= $("#nivel").val();
			console.log(nivel);
			$("#modulo").prop("disabled",true);
			if( nivel ==1)
			{
				$("#modulo").prop("disabled",true);
				$("#modulosecundario").prop("disabled",true);
 
			 
				var idInterfaz_superior= 0;
				console.log(idInterfaz_superior);
				$.ajax({ 
						type:"POST",
						data:"idInterfaz_superior="+idInterfaz_superior,
						url:"?c=Interfaz&a=ComboOrden",
		
						success:  function (response) {                	
							$("#orden").html(response);
							console.log(nivel);
						},
							error:function(){
								alert("error")
							}
						});
						
 
			}
			else if( nivel ==2)
			{   $("#modulo").prop("disabled",false);
				$("#modulosecundario").prop("disabled",true);
			    
				
				var idInterfaz_superior= 99;
				console.log(idInterfaz_superior);
				$.ajax({ 
						type:"POST",
						data:"idInterfaz_superior="+idInterfaz_superior,
						url:"?c=Interfaz&a=ComboOrden",
		
						success:  function (response) {                	
							$("#orden").html(response);
							console.log(nivel);
						},
							error:function(){
								alert("error")
							}
						}); 




			}
			else if( nivel ==3)
			{   $("#modulo").prop("disabled",false);
				$("#modulosecundario").prop("disabled",false);
				

				var idInterfaz_superior= 99;
				console.log(idInterfaz_superior);
				$.ajax({ 
						type:"POST",
						data:"idInterfaz_superior="+idInterfaz_superior,
						url:"?c=Interfaz&a=ComboOrden",
		
						success:  function (response) {                	
							$("#orden").html(response);
							console.log(nivel);
						},
							error:function(){
								alert("error")
							}
						}); 

			}
			localStorage.setItem("modulo_nivel",nivel);

			


		});

	});	
 
	
 

</script>
