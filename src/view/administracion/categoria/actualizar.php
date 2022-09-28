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



if (!isset($_REQUEST['idCategoria'])==''){

$categoria= $this->Consultar($_REQUEST['idCategoria']);

  ?>
<section class="content">
	<div class="row">
		<div class="col-sm-12 col-md-8 col-md-offset-2">
	  		<div class="box">
	    		<div class='box-header with-border'>
	      			<h3 class='box-title'><i class="fa fa-briefcase"></i> Actualizar Categoria</h3>
	    		</div>
	    		<div class="box-body">
	    			<form id="frmActualizarCategoria" action="?c=Categoria&a=Actualizar" method="post" enctype="multipart/form-data" role="form">
	    				<input type="hidden" name="idCategoria" value="<?php echo $categoria->__GET('idCategoria'); ?>" /> 
					    <div class="form-group col-md-12">
					        <label>Categoria</label>
					        <input type="text" name="Nombre" value="<?php echo $categoria->__GET('Nombre'); ?>" class="form-control" placeholder=""  required />
					    </div>				    
					    <div class="form-group col-md-4">
					      <label>Estado</label>
						</div>
						<div class="form-group col-md-4">
							<label class="radio-inline">
								<input type="radio" name="Estado" id="Estado" value="1" <?php if ($categoria->__GET('Estado')==1) { echo 'checked';  } ?>> SI
							</label>
						</div>
						<div class="form-group col-md-4">
							<label class="radio-inline">
								<input type="radio" name="Estado" id="Estado" value="0" <?php if ($categoria->__GET('Estado')==0) { echo 'checked'; }  ?>> NO
							</label>	
						</div>	
						
					  <div class="col-md-12" style="margin-top:2em;">
					    <div class="col-md-6 col-sm-12"> 
					        <button type="button" id="btnSubmit" class="btn btn-primary col-md-12 col-xs-12"><i class="fa fa-save"></i> Actualizar</button>    
					    </div>
					     <div class="col-md-6 col-sm-12">
					        <a href="index.php?c=Categoria" class="btn btn-danger col-md-12 col-xs-12 "><i class="fa fa-times-circle"></i> Cancelar</a>
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
	            title: "Actualizar Categoria",
	            buttons: {
	                main: {
	                    label: "Actualizar",
	                    className: "btn-primary",
	                    callback: function() {
	                        //console.log('Eliminado al usuario');
	                        
	                              $( "#frmActualizarCategoria" ).submit();
	                         

	                       
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