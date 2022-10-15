<?php 
error_reporting(E_ALL);
ini_set('display_errors','1');

?>
<?php
require_once 'controller/categoria.controller.php';

$categoria = new CategoriaController;

$categorias = $categoria->Listar(); 

?>
<!-- Content Header (Page header) -->
<section class="content-header">  
	<h1>
		Modulo Administracion
	</h1>
	<ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="index.php?c=SubCategoria&a=ListarxCategoria&idCategoria=<?php echo $_REQUEST['Categoria_id'] ?>">Categoría</a></li>
            <li class="active">Registrar SubCategoría</li>
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
					    <div class="form-group col-md-12">
					        <label>SubCategoria</label>
					        <input type="text" name="Nombre" id="Nombre" value="" class="form-control" placeholder=""  required />
					    </div>
					    <div class="form-group col-md-12">
					        <label>Categoria</label>
					        <input type="text" name="Categoria_id" id="Categoria_id" value="<?php echo  $_REQUEST['Categoria_id'];?>" class="form-control hidden" placeholder=""  readonly="true" />
					        <input type="text" name="NombreCategoria" id="NombreCategoria" value="<?php echo  $_REQUEST['NombreCategoria'];?>" class="form-control" placeholder=""  readonly="true"/>
					    </div>
					    <div class="form-group col-md-12">
					        <label>Aplicar Lógica</label>
					        <select name="Logica" id="Logica" class="form-control">
							    <option value="">¿Aplicar Logica?</option>
								<option value="1">Si</option>
					            <option value="0">No</option> 
					        </select>
					    </div>
						<div class="form-group col-md-12 Data">
					        <label>Comentarios</label>
					        <textarea name="Data" id="Data" rows="10" cols="40" id="Data" value="" class="form-control" placeholder=""  required></textarea>
					    </div>					   
					  <div class="col-md-12" style="margin-top:2em;">
					    <div class="col-md-6 col-sm-12">
					        <button type="button" id="btnSubmit" class="btn btn-primary col-md-12 col-xs-12"><i class="fa fa-save"></i> Registrar</button>    
					    </div>
					     <div class="col-md-6 col-sm-12">
					        <a href="index.php?c=SubCategoria&a=ListarxCategoria&idCategoria=<?php echo $_REQUEST['Categoria_id']; ?>" class="btn btn-danger col-md-12 col-xs-12 "><i class="fa fa-times-circle"></i> Cancelar</a>
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


	$(document).ready(function () {
		$('#btnSubmit').attr("disabled", true);
			$('#Nombre').keyup(function () {
				var buttonDisabled = $('#Nombre').val().length == 0;
				$('#btnSubmit').attr("disabled", buttonDisabled);
			});
		});

	$(document).ready(function () {
		$('#btnSubmit').attr("disabled", true);
			$('#Data').keyup(function () {
				var buttonDisabled = $('#Data').val().length == 0;
				$('#btnSubmit').attr("disabled", buttonDisabled);
			});
		});


</script>
