
<!-- Content Header (Page header) -->
<section class="content-header">  
	<h1>
		Modulo Administracion
	</h1>
	<ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="index.php?c=Origen">Origen de Información</a></li>
            <li class="active">Registrar</li>
          </ol>
</section>

<section class="content">
	<div class="row">
		<div class="col-sm-12 col-md-8 col-md-offset-2">
	  		<div class="box">
	    		<div class='box-header with-border'>
	      			<h3 class='box-title'><i class="fa fa-briefcase"></i> Registrar Persona</h3>
	    		</div>
	    		<div class="box-body">
	    			<form id="frmRegistrarPersona" action="?c=Persona&a=Registrar" method="post" enctype="multipart/form-data" role="form">	   				
					    
					    
	    				 
					    <div class="form-group col-md-3">
					        <label>Primer Nombre</label>
					        <input type="text" name="primer_nombre" value="" class="form-control" placeholder=""  required />
					    </div>
					    <div class="form-group col-md-3">
					        <label>Segundo Nombre</label>
					        <input type="text" name="segundo_nombre" value="" class="form-control" placeholder=""  required />
					    </div>					   
					    <div class="form-group col-md-3">
					        <label>Apellido Paterno</label>
					        <input type="text" name="apellido_paterno" value="" class="form-control" placeholder=""  required />
					    </div>
					    <div class="form-group col-md-3">
					        <label>Apellido Materno</label>
					        <input type="text" name="apellido_materno" value="" class="form-control" placeholder=""  required />
					    </div>
					    <div class="form-group col-md-3">
					        <label>DNI</label>
					        <input type="text" name="dni" value="" class="form-control" placeholder=""  required />
					    </div>
					    
					    <div class="form-group col-md-3">
					        <label>Celular</label>
					        <input type="text" name="celular" value="" class="form-control" placeholder=""  required />
					    </div>
					    <div class="form-group col-md-3">
					        <label>Fecha Ingreso</label>
					        <input type="date" name="fecha_ingreso" value="" class="form-control" placeholder=""  required />
					    </div>
					    <div class="form-group col-md-3">
					        <label>Fecha Nacimiento</label>
					        <input type="date" name="fecha_nacimiento" value="" class="form-control" placeholder=""  required />
					    </div>
					    <div class="form-group col-md-3">
					        <label>Sexo</label>
					        <input type="text" name="sexo" value="" class="form-control" placeholder=""  required />
					    </div>
					    <div class="form-group col-md-3">
					        <label>Tipo Horario</label>
					        <input type="text" name="tipo_horario" value="" class="form-control" placeholder=""  required />
					    </div>
					    <div class="form-group col-md-3">
					        <label>Hora Entrada</label>
					        <input type="time" name="horario_entrada" value="" class="form-control" placeholder=""  required />
					    </div>
					    <div class="form-group col-md-3">
					        <label>Horario Salida</label>
					        <input type="time" name="horario_salida" value="" class="form-control" placeholder=""  required />
					    </div>
					    <div class="form-group col-md-3">
					        <label>Sueldo</label>
					        <input type="text" name="sueldo" value="" class="form-control" placeholder=""  required />
					    </div>
					    <div class="form-group col-md-3">
					        <label>Correo</label>
					        <input type="text" name="correo" value="" class="form-control" placeholder=""  required />
					    </div>
					    <div class="form-group col-md-3">
					        <label>Anexo</label>
					        <input type="text" name="anexo" value="" class="form-control" placeholder=""  required />
					    </div>
					    <div class="form-group col-md-3">
					        <label>Area</label>
					        <input type="text" name="Area_id" value="" class="form-control" placeholder=""  required />
					    </div>
					    <div class="form-group col-md-3">
					        <label>Cargo</label>
					        <input type="text" name="Cargo_id" value="" class="form-control" placeholder=""  required />
					    </div>
					    <div class="form-group col-md-3">
					        <label>sede</label>
					        <input type="text" name="Sede_id" value="" class="form-control" placeholder=""  required />
					    </div>				

					  <div class="col-md-12" style="margin-top:2em;">
					    <div class="col-md-6 col-sm-12">
					        
					        <button type="button" id="btnSubmit" class="btn btn-primary col-md-12 col-xs-12"><i class="fa fa-save"></i> Registrar</button>    
					      
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
	            message: "¿Estas seguro de Registrar?",
	            title: "Registrar Persona",
	            buttons: {
	                main: {
	                    label: "Registrar",
	                    className: "btn-primary",
	                    callback: function() {
	                        //console.log('Eliminado al usuario');
	                        
	                              $( "#frmRegistrarPersona" ).submit();
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
