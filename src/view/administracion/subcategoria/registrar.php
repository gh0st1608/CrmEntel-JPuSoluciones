<?php
require_once 'controller/categoria.controller.php';

$categoria = new CarteraController;

$categorias = $categoria->Listar(); 

?>
<!-- Content Header (Page header) -->
<section class="content-header">  
	<h1>
		Modulo Administracion
	</h1>
	<ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="index.php?c=SubCategoria">Origen de Información</a></li>
            <li class="active">Registrar</li>
          </ol>
</section>

<section class="content">
	<div class="row">
		<div class="col-sm-12 col-md-8 col-md-offset-2">
	  		<div class="box">
	    		<div class='box-header with-border'>
	      			<h3 class='box-title'><i class="fa fa-briefcase"></i> Registrar SubCategoria</h3>
	    		</div>
	    		<div class="box-body">
	    			<form id="frmRegistrarSubCategoria" action="?c=SubCategoria&a=Registrar" method="post" enctype="multipart/form-data" role="form">	   				
					    <div class="form-group col-md-3">
					        <label>SubCategoria</label>
					        <input type="text" name="Nombre" value="" class="form-control" placeholder=""  required />
					    </div>
						<div class="form-group col-md-3">
							<select name="cboListarCategorias" id="cboListarCategorias" class="form-control">
								<option value="0">-- Seleccionar Categoría--</option>      
							<?php foreach ($categorias as $categoria): ?>                
								<option value="<?php echo $categoria['idCategoria']; ?>"><?php echo $categoria['Nombre']; ?></option>                      
							<?php endforeach; ?>           
				        	</select>
				    	</div>
					    <div class="form-group col-md-3">
					        <label>Estado</label>
					        <select name="Estado" id="Estado" class="form-control">
					            <option value="0">Activo</option> 
					            <option value="1">Inactivo</option> 
					        </select>
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
	            title: "Registrar SubCategoria",
	            buttons: {
	                main: {
	                    label: "Registrar",
	                    className: "btn-primary",
	                    callback: function() {
	                        //console.log('Eliminado al usuario');
	                        
	                              $( "#frmRegistrarSubCategoria" ).submit();
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
