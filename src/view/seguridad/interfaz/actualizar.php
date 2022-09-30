 <!-- Content Header (Page header) -->
 <section class="content-header">  
	<h1>
		Modulo Administracion
	</h1>
	<ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="index.php?c=Interfaz">Cartera</a></li>
            <li class="active">Actualizar</li>
          </ol>
</section>
<?php

   $modulos = $this->ConsultaModulo();  

if (!isset($_REQUEST['idInterfaz'])==''){

$interfaz= $this->Consultar($_REQUEST['idInterfaz']);

?>
<section class="content">
	<div class="row">
		<div class="col-sm-12 col-md-8 col-md-offset-2">
	  		<div class="box">
	    		<div class='box-header with-border'>
	      			<h3 class='box-title'><i class="fa fa-briefcase"></i> Actualizar Interfaz</h3>
	    		</div>
	    		<div class="box-body">
	    			<form id="frmActualizarInterfaz" action="?c=Interfaz&a=Actualizar" method="post" enctype="multipart/form-data" role="form">
	    				<input type="hidden" name="idInterfaz" id="idInterfaz" value="<?php echo $interfaz->__GET('idInterfaz'); ?>" /> 
					    <div class="form-group col-md-12">
					        <label>Interfaz</label>
					        <input type="text" name="Nombre" id="Nombre" value="<?php echo $interfaz->__GET('Nombre'); ?>" class="form-control" placeholder=""  required />
					    </div>
						<div class="form-group col-md-12">
					        <label>Url</label>
					        <input type="text" name="Url" id="Url" value="<?php echo $interfaz->__GET('Url'); ?>" class="form-control" placeholder=""  required />
					    </div>
 
						<div class="form-group col-md-3">
							<label>Nivel</label>
							<select name="Nivel" id="Nivel" class="form-control">
								<option value="<?php echo $interfaz->__GET('Nivel'); ?>"><?php echo $interfaz->__GET('Nivel'); ?></option>      
								<option value="1">1</option> 
					            <option value="2">2</option> 
								<option value="3">3</option>         
				        	</select>
				    	</div>	

 
						<div class="form-group col-md-12">
							<label>Modulo Principal</label>
							<select name="IdInterfaz_nivel1" id="IdInterfaz_nivel1" class="form-control"> 
								<option value="<?php echo $interfaz->__GET('IdInterfaz_nivel1'); ?>"><?php echo $interfaz->__GET('Nombre_nivel1'); ?></option>    
							<?php foreach ($modulos as $modulo): ?>                
								<option value="<?php echo $modulo['idInterfaz']; ?>"><?php echo $modulo['Nombre']; ?></option>                      
							<?php endforeach; ?>    
				        	</select> 
				    	</div>
						<?php	 
								$idInterfaz_modulo =    $interfaz->__GET('IdInterfaz_nivel1');
								$interfaces_nivel2 =   $this->ListarNivel($idInterfaz_modulo );
						?>
           	 			 <div class="form-group col-md-12">
							<label>Modulo Secundario</label>
							<select name="IdInterfaz_nivel2" id="IdInterfaz_nivel2" class="form-control"> 
								<option value="<?php echo $interfaz->__GET('IdInterfaz_nivel2'); ?>"><?php echo $interfaz->__GET('Nombre_nivel2'); ?></option>    
							<?php foreach ($interfaces_nivel2 as $nivel): ?>                
								<option value="<?php echo $nivel['idInterfaz']; ?>"><?php echo $nivel['Nombre']; ?></option>                      
							<?php endforeach; ?>    
				        	</select> 
				    	 </div>
  
						<div class="form-group col-md-12">
					        <label>Orden</label>
					        <input type="text" name="Orden" id="Orden" value="<?php echo $interfaz->__GET('Orden'); ?>" class="form-control" placeholder=""  required />
					    </div>	
						<div class="form-group col-md-12">
					        <label>Icono</label>
					        <input type="text" name="Icono" id="Icono" value="<?php echo $interfaz->__GET('Icono'); ?>" class="form-control" placeholder=""  required />
					    </div>			    
					    
						 
						 
						
					  	<div class="col-md-12" style="margin-top:2em;">
							<div class="col-md-6 col-sm-12"> 
								<button type="button" id="btnSubmit" class="btn btn-primary col-md-12 col-xs-12"><i class="fa fa-save"></i> Actualizar</button>    
							</div>
							<div class="col-md-6 col-sm-12">
								<a href="index.php?c=Interfaz" class="btn btn-danger col-md-12 col-xs-12 "><i class="fa fa-times-circle"></i> Cancelar</a>
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
	            title: "Actualizar Interfaz",
	            buttons: {
	                main: {
	                    label: "Actualizar",
	                    className: "btn-primary",
	                    callback: function() {
	                        //console.log('Eliminado al usuario');
	                              $( "#frmActualizarInterfaz" ).submit();                  
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