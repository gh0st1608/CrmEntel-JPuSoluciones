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
require_once 'controller/categoria.controller.php'; 
require_once 'controller/subcategoria.controller.php'; 

$persona = new PersonaController;
$perfil = new PerfilController;
$categoria = new CategoriaController;
$subcategoria = new SubCategoriaController;

$listatipodocumento = $subcategoria -> Listar_por_categoria(58);

$perfiles = $perfil->Listar();

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
							<div class="form-group col-md-6">
								<label>Tipo Documento</label>
								<select name="Tipo_Documento" id="Tipo_Documento" class="form-control" onchange="ValidarInputs()">
								<option value="0">-- Seleccionar Tipo Documento--</option>      
								<?php foreach ($listatipodocumento as $lista): ?>                
									<option value="<?php echo $lista['Nombre']; ?>"><?php echo $lista['Nombre']; ?></option>                      
								<?php endforeach; ?> 
								</select>
							</div>
							<div class="form-group col-md-6">
								<label>Documento</label>
								<input type="text" name="Documento" id="Documento" value="" class="form-control" placeholder="" onchange="ValidarInputs()"  required />
							</div>    
							<div class="form-group col-md-6">
								<label>Primer Nombre</label>
								<input type="text" name="Primer_Nombre" id="Primer_Nombre" value="" class="form-control" placeholder="" onchange="ValidarInputs()" required />
							</div>
							<div class="form-group col-md-6">
								<label>Segundo Nombre</label>
								<input type="text" name="Segundo_Nombre" id="Segundo_Nombre" value="" class="form-control" placeholder=""  required />
							</div>					   
							<div class="form-group col-md-6">
								<label>Apellido Paterno</label>
								<input type="text" name="Apellido_Paterno" id="Apellido_Paterno" value="" class="form-control" placeholder="" onchange="ValidarInputs()" required />
							</div>
							<div class="form-group col-md-6">
								<label>Apellido Materno</label>
								<input type="text" name="Apellido_Materno" id="Apellido_Materno" value="" class="form-control" placeholder="" onchange="ValidarInputs()" required />
							</div>
							<div class="form-group col-md-6">
								<label>Perfil</label>
								<select name="Perfil" id="Perfil" class="form-control" onchange="ValidarInputs()">
								<option value="0">-- Seleccionar Perfil--</option>      
								<?php foreach ($perfiles as $perfil): ?>                
									<option value="<?php echo $perfil['idPerfil']; ?>"><?php echo $perfil['Nombre']; ?></option>                      
								<?php endforeach; ?> 
								</select>
							</div>
							<div class="form-group col-md-6">
								<label>Clave</label>
								<input type="text" name="Clave" id="Clave" value="" class="form-control" placeholder="" onchange="ValidarInputs()" required />
							</div>
					    </div> 
					  
					  <div class="col-md-12" style="margin-top:2em;">
					    <div class="col-md-6 col-sm-12">
					        
					        <button type="button" id="btnSubmit" disabled class="btn btn-primary col-md-12 col-xs-12"><i class="fa fa-save"></i> Registrar</button>    
					      
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

	function ValidarInputs() 
	{
		var Documento = $('#Documento').val();
		var Tipo_Documento = $('#Tipo_Documento').val();
		var Perfil = $('#Perfil').val();
		var Clave = $('#Clave').val();
		var Primer_Nombre = $('#Primer_Nombre').val();
		var Apellido_Paterno = $('#Apellido_Paterno').val();
		var Apellido_Materno = $('#Apellido_Materno').val();

		if (Documento && Tipo_Documento && Perfil && Clave && Primer_Nombre && Apellido_Paterno && Apellido_Materno)
		{
			$('#btnSubmit').attr("disabled", false);
		}
	}

	/* Validar DNI y TipoDoc
	$(document).ready(function() {
		$('#btnSubmit').on('click',function(e){
			e.preventDefault();

			var Documento = $('#Documento').val();
			var Tipo_Documento = $('#Tipo_Documento').val();

			$.ajax({
				type: "POST",
				url: "ajax/validaridentidad.php",
				data: (
					'Documento='+Documento+'&Tipo_Documento='Tipo_Documento
					)
				success: function(respuesta){
					alert(respuesta);
				}

			})

		})
	}
	*/



</script>
