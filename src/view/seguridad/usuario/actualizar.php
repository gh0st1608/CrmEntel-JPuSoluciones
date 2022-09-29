 <!-- Content Header (Page header) -->
<section class="content-header">  
	<h1>
		Modulo Seguridad
	</h1>
	<ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="index.php?c=Usuario">Usuario</a></li>
            <li class="active">Actualizar</li>
          </ol>
</section>
<?php



 if (!isset($_REQUEST['idUsuario'])=='' && !isset($_REQUEST['Persona_id'])==''){

require_once 'controller/persona.controller.php'; 
require_once 'controller/perfil.controller.php';
require_once 'controller/subcategoria.controller.php';

$persona = new PersonaController;
$perfil  = new PerfilController;
$subcategoria = new SubCategoriaController;
$usuario = $this->Consultar($_REQUEST['idUsuario']);
$persona = $persona->Consultar($_REQUEST['Persona_id']);

$perfiles = $perfil->Listar();
$listatipodocumento = $subcategoria -> Listar_por_categoria(58);




?>
<section class="content">
	<div class="row">
		<div class="col-sm-12 col-md-6 col-md-offset-3">
	  		<div class="box">
	    		<div class='box-header with-border'>
	      			<h3 class='box-title'><i class="fa fa-user"></i> Actualizar Usuario</h3>
	    		</div>
	    		<div class="box-body">
	    			<form id="frmActualizarUsuario" action="?c=Usuario&a=Actualizar" method="post" enctype="multipart/form-data" role="form">
	    				<input type="hidden" name="idUsuario" value="<?php echo $usuario->__GET('idUsuario'); ?>" />
					    <div class="form-group col-md-12">
							<div class="form-group col-md-12">
								<label>Nombres y Apellidos</label>
								<input type="text" name="NombresApellidos" id="NombresApellidos" value="<?php echo $persona->Apellido_Paterno.' '.$persona->Apellido_Materno.' '.$persona->Primer_Nombre.' '.$persona->Segundo_Nombre; ?>" class="form-control"  placeholder=""  readonly />
							</div>
							<div class="form-group col-md-6">
								<label>Tipo Documento</label>
								<select name="Tipo_Documento" id="Tipo_Documento" class="form-control" disabled="true" readonly>
									<?php foreach ($listatipodocumento as $lista): ?>                
										<option value="<?php echo $lista['Nombre']; ?>"><?php echo $lista['Nombre']; ?></option>                      
									<?php endforeach; ?>                                    
								</select>
							</div>
							<div class="form-group col-md-6">
								<label>Perfil</label>
								<select name="Perfil" id="Perfil" class="form-control">
								<option value="0">-- Seleccionar Perfil--</option>      
								<?php foreach ($perfiles as $perfil): ?>                
									<option value="<?php echo $perfil['idPerfil']; ?>"><?php echo $perfil['Nombre']; ?></option>                      
								<?php endforeach; ?> 
								</select>
							</div>
							<div class="form-group col-md-6">
								<label>Login</label>
								<input type="text" name="Documento" id="Documento" value="<?php echo $usuario->Login; ?>" class="form-control" placeholder=""  readonly />
							</div>    
							<div class="form-group col-md-6">
								<label>Clave</label>
								<input type="text" name="Clave" id="Clave" value="<?php echo $usuario->__GET('Password');?>" class="form-control" placeholder=""  required />
							</div>
							<div class="form-group col-md-4">
					      		<label>Activo</label>
							</div>
							<div class="form-group col-md-4">
								<label class="radio-inline">
									<input type="radio" name="Estado" id="Estado" value="1" <?php if ($usuario->__GET('Estado')==1) { echo 'checked';  } ?>> SI
								</label>
							</div>
							<div class="form-group col-md-4">
								<label class="radio-inline">
									<input type="radio" name="Estado" id="Estado" value="0" <?php if ($usuario->__GET('Estado')==0) { echo 'checked'; }  ?>> NO
								</label>	
							</div>
					    </div> 
					  

					  <div class="col-md-12" style="margin-top:2em;">
					    <div class="col-md-6 col-sm-12">
					        
					        <button type="button" id="btnSubmit" class="btn btn-primary col-md-12 col-xs-12"><i class="fa fa-save"></i> Actualizar</button>    
					      
					    </div>
					     <div class="col-md-6 col-sm-12">

					       
					    
					        <a href="index.php?c=Usuario" class="btn btn-danger col-md-12 col-xs-12 "><i class="fa fa-times-circle"></i> Cancelar</a>
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
		$('#Perfil').val("<?php echo $usuario->__GET('Perfil_id'); ?>");
		$('#Tipo_Documento').val("<?php echo $persona->__GET('Tipo_Documento'); ?>");
		$('#Persona_id').val("<?php echo $usuario->__GET('Persona_id'); ?>");
		$("#btnSubmit").click(function(event) {

			bootbox.dialog({
	            message: "¿Estas seguro de actualizar al usuario?",
	            title: "Actualizar Usuario",
	            buttons: {
	                main: {
	                    label: "Actualizar",
	                    className: "btn-primary",
	                    callback: function() {
	                        //console.log('Eliminado al usuario');
	                        
	                              $( "#frmActualizarUsuario" ).submit();
	                         

	                       
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