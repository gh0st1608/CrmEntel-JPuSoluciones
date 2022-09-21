 <!-- Content Header (Page header) -->
<section class="content-header">  
	<h1>
		Modulo Seguridad
	</h1>
	<ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="index.php?c=Usuario">Usuario</a></li>
            <li class="active">Registrar</li>
          </ol>
</section>
<?php 
require_once 'controller/persona.controller.php'; 
require_once 'controller/perfil.controller.php'; 
$persona = new PersonaController;
$perfil = new PerfilController;

 ?>
<section class="content">
	<div class="row">
		<div class="col-sm-12 col-md-6 col-md-offset-3">
	  		<div class="box">
	    		<div class='box-header with-border'>
	      			<h3 class='box-title'><i class="fa fa-user"></i> Registrar Usuario</h3>
	    		</div>
	    		<div class="box-body">
	    			<form id="frmRegistrarUsuario" action="?c=Usuario&a=Registrar" method="post" enctype="multipart/form-data" role="form">	    				
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
					        <label>Persona</label>
					        <select name="Persona_id" id="Persona_id" class="form-control">
					        	<option value="">-- Seleccionar Persona --</option>       
					          	<?php $personas = $persona->Listar_Sin_Usuario(); ?>
					          	<?php foreach ($personas as $persona): ?>                     
					            <option value="<?php echo $persona['idPersona']; ?>" data-codigo="<?php echo $persona['codigo']; ?>"><?php echo $persona['apellido_paterno'].' '.$persona['apellido_materno'].' '.$persona['primer_nombre'].' '.$persona['segundo_nombre']; ?></option>                      
					          <?php endforeach; ?>           
					        </select>
					    </div>
					    <div class="form-group col-md-12">
					        <label>Usuario</label>
					        <input type="text" id="login" name="login" value="" class="form-control" placeholder=""  readonly="true" required />
					    </div>
					    <div class="form-group col-md-12">
					        <label>Contraseña</label>
					        <input type="password" id="password" name="password" value="" class="form-control" placeholder="" />
					    </div>
					    <div class="form-group col-md-12">
					        <label>Repita Contraseña</label>
					        <input type="password" id="password2" name="password2" value="" class="form-control" placeholder=""  />
					    </div> 					    
					  

					  <div class="col-md-12" style="margin-top:2em;">
					    <div class="col-md-6 col-sm-12">
					        
					        <button type="button" id="btnSubmit" class="btn btn-primary col-md-12 col-xs-12"><i class="fa fa-save"></i> Registrar</button>    
					      
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
		$( "#Persona_id" ).change(function ()
	{ 			
		var Persona_id=$("#Persona_id").val();
		var codigo=$("#Persona_id option[value='"+Persona_id+"']").attr('data-codigo');
		$("#login").val(codigo);
		$("#password").val(codigo);
		$("#password2").val(codigo);	
	});

		$("#btnSubmit").click(function(event) {

			bootbox.dialog({
	            message: "¿Estas seguro de registrar al usuario?",
	            title: "Registrar Usuario",
	            buttons: {
	                main: {
	                    label: "Registrar",
	                    className: "btn-primary",
	                    callback: function() {
	                        //console.log('Eliminado al usuario');
	                        
	                              $( "#frmRegistrarUsuario" ).submit();
	                         

	                       
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
