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



 if (!isset($_REQUEST['idUsuario'])==''){

require_once 'controller/persona.controller.php'; 
require_once 'controller/perfil.controller.php'; 
$persona = new PersonaController;
$perfil = new PerfilController;
$Usuario= $this->Consultar($_REQUEST['idUsuario']);

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
	    				<input type="hidden" name="idUsuario" value="<?php echo $Usuario->__GET('idUsuario'); ?>" />
					    <div class="form-group col-md-12">
					        <label>Persona</label>
					        <select name="Persona_id" id="Persona_id" class="form-control" disabled="true">
					        	<option value="">-- Seleccionar Persona --</option>       
					          	<?php $personas = $persona->Listar(); ?>
					          	<?php foreach ($personas as $persona): ?>                     
					            <option value="<?php echo $persona['idPersona']; ?>" data-codigo="<?php echo $persona['codigo']; ?>"><?php echo $persona['apellido_paterno'].' '.$persona['apellido_materno'].' '.$persona['primer_nombre'].' '.$persona['segundo_nombre']; ?></option>                      
					          <?php endforeach; ?>           
					        </select>
					    </div>
					    <div class="form-group col-md-12">
					        <label>Perfil</label>
					        <select name="Perfil_id" id="Perfil" class="form-control">       
					          <?php $perfiles = $perfil->Listar(); ?>
					          <?php foreach ($perfiles as $perfil): ?>                     
					            <option value="<?php echo $perfil['idPerfil']; ?>"><?php echo $perfil['nombre']; ?></option>                      
					          <?php endforeach; ?>           
					        </select>
					    </div>
					    <div class="form-group col-md-12">
					        <label>Usuario</label>
					        <input type="text" name="login" value="<?php echo $Usuario->__GET('login'); ?>" class="form-control" placeholder=""  required readonly="true"/>
					    </div>				    

					    <div class="form-group col-md-12">
					        <label>Contraseña</label>
					        <input type="password" name="password" value="<?php echo $Usuario->__GET('password'); ?>" class="form-control" placeholder="" />
					    </div>
					    <div class="form-group col-md-12">
					        <label>Repita Contraseña</label>
					        <input type="password" name="password2" value="<?php echo $Usuario->__GET('password'); ?>" class="form-control" placeholder=""  />
					    </div> 
					    <div class="form-group col-md-12">
					      <label>Activo</label>
					      <label class="radio-inline">
					          <input type="radio" name="activo" id="estado_activo" value="1" <?php if ($Usuario->__GET('activo')==1) { echo 'checked';  } ?>> SI
					      </label>
					      <label class="radio-inline">
					          <input type="radio" name="activo" id="estado_inactivo" value="0" <?php if ($Usuario->__GET('activo')==0) { echo 'checked'; }  ?>> NO
					      </label>					    
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
		$('#Perfil').val("<?php echo $Usuario->__GET('Perfil_id'); ?>");
		$('#Persona_id').val("<?php echo $Usuario->__GET('Persona_id'); ?>");
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