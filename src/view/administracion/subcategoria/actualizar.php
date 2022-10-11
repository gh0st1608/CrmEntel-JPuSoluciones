
<?php 
error_reporting(E_ALL);
ini_set('display_errors','1');

?>
<!-- Content Header (Page header) -->
<section class="content-header">  
	<h1>
		Modulo Administracion
	</h1>
	<ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="index.php?c=SubCategoria">Categoria</a></li>
            <li class="active">Actualizar</li>
          </ol>
</section>

<?php 

require_once 'controller/categoria.controller.php';
$categoria = new CategoriaController;

if (!isset($_REQUEST['idSubCategoria'])==''){
$subcategoria = $this->Consultar($_REQUEST['idSubCategoria']);

$categoria = $categoria -> Consultar($subcategoria->Categoria_id);



?>
<section class="content">
	<div class="row">
		<div class="col-sm-12 col-md-8 col-md-offset-2">
	  		<div class="box">
	    		<div class='box-header with-border'>
	      			<h3 class='box-title'><i class="fa fa-briefcase"></i> Actualizar SubCategoria</h3>
	    		</div>
	    		<div class="box-body">
					<form id="frmActualizarSubCategoria" action="?c=SubCategoria&a=Actualizar" method="post" enctype="multipart/form-data" role="form">
	    				<input type="hidden" name="idSubCategoria" value="<?php echo $subcategoria->__GET('idSubCategoria'); ?>" />    					    
					    <div class="form-group col-md-12">
							<label>Categoria</label>
							<input type="text" name="Categoria_id" id="Categoria_id" value="<?php echo $categoria-> Nombre ?>" class="form-control" readonly="true" ></input>  
				    	</div>
						<div class="form-group col-md-12">
					        <label>Nombre SubCategoria</label>
					        <input type="text" name="Nombre" id="Nombre" value="<?php echo $subcategoria->__GET('Nombre'); ?>" class="form-control" placeholder=""  required />
					    </div> 
					    <div class="form-group col-md-12">
					        <label>Aplicar Lógica</label>
					        <select name="Logica" id="Logica" class="form-control">
							<?php if ($subcategoria->__GET('Aplicar_Logica') == 0){?>
								<option value="0" >No</option>
								<option value="1" >Si</option>  
								<?php }else{?>
								<option value="0" >No</option>
								<option value="1" >Si</option> 
								<?php
								} 
								?>
					        </select>
					    </div>
						<div class="form-group col-md-4">
					      <label>Activo</label>
						</div>
						<div class="form-group col-md-4">
							<label class="radio-inline">
								<input type="radio" name="Estado" id="Estado" value="1" <?php if ($subcategoria->__GET('Estado')==1) { echo 'checked';  } ?>> SI
							</label>
						</div>
						<div class="form-group col-md-4">
							<label class="radio-inline">
								<input type="radio" name="Estado" id="Estado" value="0" <?php if ($subcategoria->__GET('Estado')==0) { echo 'checked'; }  ?>> NO
							</label>	
						</div>
					  	<div class="col-md-12" style="margin-top:2em;">
							<div class="col-md-6 col-sm-12"> 
								<button type="button" id="btnSubmit" class="btn btn-primary col-md-12 col-xs-12"><i class="fa fa-save"></i> Actualizar</button>    
							</div>
							<div class="col-md-6 col-sm-12">
								<a href="index.php?c=SubCategoria" class="btn btn-danger col-md-12 col-xs-12 "><i class="fa fa-times-circle"></i> Cancelar</a>
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
		$('#Logica').val("<?php echo $subcategoria->__GET('Aplicar_Logica'); ?>");
		$("#btnSubmit").click(function(event) {
			bootbox.dialog({
	            message: "¿Estas seguro de actualizar?",
	            title: "Actualizar SubCategoria",
	            buttons: {
	                main: {
	                    label: "Actualizar",
	                    className: "btn-primary",
	                    callback: function() {
	                              $( "#frmActualizarSubCategoria" ).submit();	                     
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
<?php }/*--- END REQUESt*/ ?>