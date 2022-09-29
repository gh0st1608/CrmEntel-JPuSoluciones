 <!-- Content Header (Page header) -->
<section class="content-header">  
	<h1>
		Modulo Administracion
	</h1>
	<ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="index.php?c=Persona">Persona</a></li>
            <li class="active">Actualizar</li>
          </ol>
</section>
<?php



 if (!isset($_REQUEST['idPersona'])==''){

	require_once 'controller/subcategoria.controller.php';
	
	$subcategoria = new SubCategoriaController;
	$generos = $subcategoria -> Listar_por_categoria(59);
	$cargos = $subcategoria -> Listar_por_categoria(56);

	$persona= $this->Consultar($_REQUEST['idPersona']);

	$cargo = $subcategoria->Consultar($persona->Cargo_id_SubCategoria);
;

  ?>
<section class="content">
	<div class="row">
		<div class="col-sm-12 col-md-8 col-md-offset-2">
	  		<div class="box">
	    		<div class='box-header with-border'>
	      			<h3 class='box-title'><i class="fa fa-briefcase"></i> Actualizar Persona</h3>
	    		</div>
	    		<div class="box-body">
	    			<form id="frmActualizarPersona" action="?c=Persona&a=Actualizar" method="post" enctype="multipart/form-data" role="form">
	    				<input type="hidden" name="idPersona" value="<?php echo $persona->__GET('idPersona'); ?>" />
						<div class="form-group col-md-6">
					        <label>Tipo Documento</label>
					        <input type="text" name="Tipo_Documento" value="<?php echo $persona->__GET('Tipo_Documento'); ?>" class="form-control" placeholder="" readonly  required />
					    </div>
					    <div class="form-group col-md-6">
					        <label>Documento</label>
					        <input type="text" name="Documento" value="<?php echo $persona->__GET('Documento'); ?>" class="form-control" placeholder="" readonly required />
					    </div> 
					    <div class="form-group col-md-6">
					        <label>Primer Nombre</label>
					        <input type="text" name="Primer_Nombre" value="<?php echo $persona->__GET('Primer_Nombre'); ?>" class="form-control" placeholder=""  required />
					    </div>
					    <div class="form-group col-md-6">
					        <label>Segundo Nombre</label>
					        <input type="text" name="Segundo_Nombre" value="<?php echo $persona->__GET('Segundo_Nombre'); ?>" class="form-control" placeholder=""  required />
					    </div>					   
					    <div class="form-group col-md-6">
					        <label>Apellido Paterno</label>
					        <input type="text" name="Apellido_Paterno" value="<?php echo $persona->__GET('Apellido_Paterno'); ?>" class="form-control" placeholder=""  required />
					    </div>
					    <div class="form-group col-md-6">
					        <label>Apellido Materno</label>
					        <input type="text" name="Apellido_Materno" value="<?php echo $persona->__GET('Apellido_Materno'); ?>" class="form-control" placeholder=""  required />
					    </div>
						
					    <div class="form-group col-md-6">
					        <label>Fecha de Nacimiento</label>
					        <input type="date" name="Fecha_Nacimiento" value="<?php echo $persona->__GET('Fecha_Nacimiento'); ?>" class="form-control" placeholder=""  required />
					    </div>
					    <div class="form-group col-md-6">
					        <label>Sexo</label>
					        <select name="Sexo" id="Sexo" class="form-control" required >
							<option value="0">-- Seleccionar Genero--</option>
								<?php foreach ($generos as $genero): ?>                
									<option value="<?php echo $genero['Nombre']; ?>"><?php echo $genero['Nombre']; ?></option>                      
								<?php endforeach; ?>                                    
							</select>
					    </div>
					    <div class="form-group col-md-6">
					        <label>Celular</label>
					        <input type="text" name="Celular" value="<?php echo $persona->__GET('Celular'); ?>" class="form-control" placeholder=""  required />
					    </div>
						<div class="form-group col-md-6">
					        <label>Correo</label>
					        <input type="text" name="Correo" value="<?php echo $persona->__GET('Correo'); ?>" class="form-control" placeholder=""  required />
					    </div>
					    <div class="form-group col-md-6">
					        <label>Cargo</label>
					        <select name="Cargo" id="Cargo" class="form-control" >
							<option value="0">-- Seleccionar Cargo--</option> 
									<?php foreach ($cargos as $cargo): ?>                
										<option value="<?php echo $cargo['Nombre']; ?>"><?php echo $cargo['Nombre']; ?></option>                      
									<?php endforeach; ?>                                    
							</select>
					    </div>
						<div class="form-group col-md-12">
					      <label>Activo</label>
						</div>
						<div class="form-group col-md-6">
							<label class="radio-inline">
								<input type="radio" name="Estado" id="Estado" value="1" <?php if ($persona->__GET('Estado')==1) { echo 'checked';  } ?>> SI
							</label>
						</div>
						<div class="form-group col-md-6">
							<label class="radio-inline">
								<input type="radio" name="Estado" id="Estado" value="0" <?php if ($persona->__GET('Estado')==0) { echo 'checked'; }  ?>> NO
							</label>	
						</div>

					  	<div class="col-md-12" style="margin-top:2em;">
					    <div class="col-md-6 col-sm-12">
					        
					        <button type="button" id="btnSubmit" class="btn btn-primary col-md-12 col-xs-12"><i class="fa fa-save"></i> Actualizar</button>    
					      
					    </div>
					     <div class="col-md-6 col-sm-12">

					       
					    
					        <a href="index.php?c=Persona" class="btn btn-danger col-md-12 col-xs-12 "><i class="fa fa-times-circle"></i> Cancelar</a>
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
		$('#Cargo').val("<?php echo $cargo['Nombre']; ?>");
		$('#Sexo').val("<?php echo $persona->__GET('Sexo');?>");
		$("#btnSubmit").click(function(event) {
			bootbox.dialog({
	            message: "¿Estas seguro de actualizar?",
	            title: "Actualizar Persona",
	            buttons: {
	                main: {
	                    label: "Actualizar",
	                    className: "btn-primary",
	                    callback: function() {
	                        //console.log('Eliminado al usuario');
	                        
	                              $( "#frmActualizarPersona" ).submit();
	                         

	                       
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
</script>
<?php }/*--- END REQUESt*/ ?>