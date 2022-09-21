 <!-- Content Header (Page header) -->
<section class="content-header">  
	<h1>
		Modulo Administracion
	</h1>
	<ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="index.php?c=Cartera">Cartera</a></li>
            <li class="active">Actualizar</li>
          </ol>
</section>
<?php



 if (!isset($_REQUEST['idPersona'])==''){

$Persona= $this->Consultar($_REQUEST['idPersona']);

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
	    				<input type="hidden" name="idPersona" value="<?php echo $Persona->__GET('idPersona'); ?>" /> 
					    <div class="form-group col-md-3">
					        <label>Primer Nombre</label>
					        <input type="text" name="primer_nombre" value="<?php echo $Persona->__GET('primer_nombre'); ?>" class="form-control" placeholder=""  required />
					    </div>
					    <div class="form-group col-md-3">
					        <label>Segundo Nombre</label>
					        <input type="text" name="segundo_nombre" value="<?php echo $Persona->__GET('segundo_nombre'); ?>" class="form-control" placeholder=""  required />
					    </div>					   
					    <div class="form-group col-md-3">
					        <label>Apellido Paterno</label>
					        <input type="text" name="apellido_paterno" value="<?php echo $Persona->__GET('apellido_paterno'); ?>" class="form-control" placeholder=""  required />
					    </div>
					    <div class="form-group col-md-3">
					        <label>Apellido Materno</label>
					        <input type="text" name="apellido_materno" value="<?php echo $Persona->__GET('apellido_materno'); ?>" class="form-control" placeholder=""  required />
					    </div>
					    <div class="form-group col-md-3">
					        <label>DNI</label>
					        <input type="text" name="dni" value="<?php echo $Persona->__GET('dni'); ?>" class="form-control" placeholder=""  required />
					    </div>
					    <div class="form-group col-md-3">
					        <label>Codigo</label>
					        <input type="text" name="codigo" value="<?php echo $Persona->__GET('codigo'); ?>" class="form-control" placeholder=""  required />
					    </div>
					    <div class="form-group col-md-3">
					        <label>Celular</label>
					        <input type="text" name="celular" value="<?php echo $Persona->__GET('celular'); ?>" class="form-control" placeholder=""  required />
					    </div>
					    <div class="form-group col-md-3">
					        <label>Fecha Ingreso</label>
					        <input type="date" name="fecha_ingreso" value="<?php echo $Persona->__GET('fecha_ingreso'); ?>" class="form-control" placeholder=""  required />
					    </div>
					    <div class="form-group col-md-3">
					        <label>Sexo</label>
					        <input type="text" name="sexo" value="<?php echo $Persona->__GET('sexo'); ?>" class="form-control" placeholder=""  required />
					    </div>
					    <div class="form-group col-md-3">
					        <label>Fecha Nacimiento</label>
					        <input type="date" name="fecha_nacimiento" value="<?php echo $Persona->__GET('fecha_nacimiento'); ?>" class="form-control" placeholder=""  required />
					    </div>
					    <div class="form-group col-md-3">
					        <label>Tipo Horario</label>
					        <input type="text" name="tipo_horario" value="<?php echo $Persona->__GET('tipo_horario'); ?>" class="form-control" placeholder=""  required />
					    </div>
					    <div class="form-group col-md-3">
					        <label>Hora Entrada</label>
					        <input type="time" name="horario_entrada" value="<?php echo $Persona->__GET('horario_entrada'); ?>" class="form-control" placeholder=""  required />
					    </div>
					    <div class="form-group col-md-3">
					        <label>Horario Salida</label>
					        <input type="time" name="horario_salida" value="<?php echo $Persona->__GET('horario_salida'); ?>" class="form-control" placeholder=""  required />
					    </div>
					    <div class="form-group col-md-3">
					        <label>Sueldo</label>
					        <input type="text" name="sueldo" value="<?php echo $Persona->__GET('sueldo'); ?>" class="form-control" placeholder=""  required />
					    </div>
					    <div class="form-group col-md-3">
					        <label>Correo</label>
					        <input type="text" name="correo" value="<?php echo $Persona->__GET('correo'); ?>" class="form-control" placeholder=""  required />
					    </div>
					    <div class="form-group col-md-3">
					        <label>Anexo</label>
					        <input type="text" name="anexo" value="<?php echo $Persona->__GET('anexo'); ?>" class="form-control" placeholder=""  required />
					    </div>
					    <div class="form-group col-md-3">
					        <label>Area</label>
					        <input type="text" name="Area_id" value="<?php echo $Persona->__GET('Area_id'); ?>" class="form-control" placeholder=""  required />
					    </div>
					    <div class="form-group col-md-3">
					        <label>Cargo</label>
					        <input type="text" name="Cargo_id" value="<?php echo $Persona->__GET('Cargo_id'); ?>" class="form-control" placeholder=""  required />
					    </div>
					    <div class="form-group col-md-3">
					        <label>sede</label>
					        <input type="text" name="Sede_id" value="<?php echo $Persona->__GET('Sede_id'); ?>" class="form-control" placeholder=""  required />
					    </div>
					    <div class="form-group col-md-3">
					        <label>Fecha Salida</label>
					        <input type="date" name="fecha_salida" value="<?php echo $Persona->__GET('fecha_salida'); ?>" class="form-control" placeholder=""  required />
					    </div>
					    					    
					    <div class="form-group col-md-12">
					      <label>Activo</label>
					      <label class="radio-inline">
					          <input type="radio" name="activo" id="estado_activo" value="1" <?php if ($Persona->__GET('activo')==1) { echo 'checked';  } ?>> SI
					      </label>
					      <label class="radio-inline">
					          <input type="radio" name="activo" id="estado_inactivo" value="0" <?php if ($Persona->__GET('activo')==0) { echo 'checked'; }  ?>> NO
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