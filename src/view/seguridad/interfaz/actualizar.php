 <!-- Content Header (Page header) -->
<section class="content-header">  
	<h1>
		Modulo Seguridad
	</h1>
	<ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="index.php?c=Perfil">Perfil</a></li>
            <li class="active">Actualizar</li>
          </ol>
</section>
<?php



 if (!isset($_REQUEST['idPerfil'])==''){

$Perfil= $this->Consultar($_REQUEST['idPerfil']);

  ?>
<section class="content">
	<div class="row">
		<div class="col-sm-12 col-md-6 col-md-offset-3">
	  		<div class="box">
	    		<div class='box-header with-border'>
	      			<h3 class='box-title'><i class="fa fa-users"></i> Actualizar Perfil</h3>
	    		</div>
	    		<div class="box-body">
	    			<form id="frmActualizarPerfil" action="?c=Perfil&a=Actualizar" method="post" enctype="multipart/form-data" role="form">
	    				<input type="hidden" name="idPerfil" value="<?php echo $Perfil->__GET('idPerfil'); ?>" />
					    <div class="form-group col-md-12">
					        <label>Perfil</label>
					        <input type="text" name="Nombre" value="<?php echo $Perfil->__GET('Nombre'); ?>" class="form-control" placeholder="" />
					    </div>						    
					    <div class="form-group col-md-12">
					      <label>Activo</label>
					      <label class="radio-inline">
					          <input type="radio" name="Estado" id="Estado" value="0" <?php if ($Perfil->__GET('Estado')==0) { echo 'checked';  } ?>> SI
					      </label>
					      <label class="radio-inline">
					          <input type="radio" name="Estado" id="Estado" value="1" <?php if ($Perfil->__GET('Estado')==1) { echo 'checked'; }  ?>> NO
					      </label>					    
					    </div> 
					  <div class="col-md-12" style="margin-top:2em;">
					    <div class="col-md-6 col-sm-12" style="margin-bottom:1em;">
					        <button type="button" id="btnSubmit" class="btn btn-primary col-md-12 col-xs-12"><i class="fa fa-save"></i> Actualizar</button>    
					    </div>
					     <div class="col-md-6 col-sm-12" style="margin-bottom:1em;">
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
	            message: "¿Estas seguro de actualizar el perfil?",
	            title: "Actualizar Perfil",
	            buttons: {
	                main: {
	                    label: "Actualizar",
	                    className: "btn-primary",
	                    callback: function() {
	                        //console.log('Eliminado al usuario');  
	                              $( "#frmActualizarPerfil" ).submit();                     
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