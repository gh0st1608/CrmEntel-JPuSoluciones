 <!-- Content Header (Page header) -->
<section class="content-header">  
	<h1>
		Modulo Seguridad
	</h1>
	<ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="index.php?c=Perfil">Perfil</a></li>
            <li class="active">Registrar</li>
          </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-sm-12 col-md-6 col-md-offset-3">
	  		<div class="box">
	    		<div class='box-header with-border'>
	      			<h3 class='box-title'><i class="fa fa-users"></i> Registrar Perfil</h3>
	    		</div>
	    		<div class="box-body">
	    			<form id="frmRegistrarPerfil" action="?c=Perfil&a=Registrar" method="post" enctype="multipart/form-data" role="form">
					    <div class="form-group col-md-12">
					        <label>Interfaz</label>
					        <input type="text" name="Nombre" id="Nombre" value="" class="form-control" placeholder=""  required />
					    </div>
						<div class="form-group col-md-12">
					        <label>URL</label>
					        <input type="text" name="Url" id="Url" value="" class="form-control" placeholder=""  required />
					    </div>
						<div class="form-group col-md-3">
					        <label>Nivel</label>
					        <select name="Nivel" id="Nivel" class="form-control">
					            <option value="0">Activo</option> 
					            <option value="1">Inactivo</option> 
					        </select>
					    </div>
						<div class="form-group col-md-12">
					        <label>Modulo Principal</label>
					        <select name="ModPrincipal" id="ModPrincipal" class="form-control">
					            <option value="0">Activo</option> 
					            <option value="1">Inactivo</option> 
					        </select>
					    </div>
						<div class="form-group col-md-12">
					        <label>Modulo Superior</label>
					        <select name="ModSuperior" id="ModSuperior" class="form-control">
					            <option value="0">Activo</option> 
					            <option value="1">Inactivo</option> 
					        </select>
					    </div>
						<div class="form-group col-md-3">
					        <label>Orden</label>
					        <input type="number" min="0" max="1000" step="1" name="Orden" id="Orden" class="form-control"></number>
					    </div>
						<div class="form-group col-md-12">
					        <label>Icono</label>
					        <input type="text" name="Icono" id="Icono" value="" class="form-control" placeholder=""  required />
					    </div>
					  	<div class="col-md-12" style="margin-top:2em;">
					    <div class="col-md-6 col-sm-12">
					        <button type="button" id="btnSubmit" class="btn btn-primary col-md-12 col-xs-12"><i class="fa fa-save"></i> Registrar</button>    
					    </div>
					     <div class="col-md-6 col-sm-12">
					        <a href="index.php?c=Perfil" class="btn btn-danger col-md-12 col-xs-12 "><i class="fa fa-times-circle"></i> Cancelar</a>
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
	            message: "¿Estas seguro de registrar el perfil?",
	            title: "Registrar Perfil",
	            buttons: {
	                main: {
	                    label: "Registrar",
	                    className: "btn-primary",
	                    callback: function() {
	                        //console.log('Eliminado al usuario');
	                        
	                              $( "#frmRegistrarPerfil" ).submit();
	                         

	                       
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
</script>
