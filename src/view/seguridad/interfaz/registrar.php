<?php 
error_reporting(E_ALL);
ini_set('display_errors','1');

?>
<?php  $modulos = $this->ConsultaModulo();  ?>



 <!-- Content Header (Page header) -->
<section class="content-header">  
	<h1>
		Modulo Seguridad
	</h1>
	<ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="index.php?c=Interfaz">Interfaz</a></li>
            <li class="active">Registrar</li>
          </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-sm-12 col-md-6 col-md-offset-3">
	  		<div class="box">
	    		<div class='box-header with-border'>
	      			<h3 class='box-title'><i class="fa fa-users"></i> Registrar Interfaz</h3>
	    		</div>
	    		<div class="box-body">
	    			<form id="frmRegistrarInterfaz" action="?c=Interfaz&a=Registrar" method="post" enctype="multipart/form-data" role="form">
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
							<select name="nivel" id="nivel" class="form-control">
								<option value="0">-- Seleccionar Nivel--</option>      
								<option value="1">1</option> 
					            <option value="2">2</option> 
								<option value="3">3</option>         
				        	</select>
				    	</div>

						<div class="form-group col-md-12">
							<label>Modulo Principal</label>
							<select name="modulo" id="modulo" class="form-control">
								<option value="0">-- Seleccionar Modulo--</option>      
							<?php foreach ($modulos as $modulo): ?>                
								<option value="<?php echo $modulo['idInterfaz']; ?>"><?php echo $modulo['Nombre']; ?></option>                      
							<?php endforeach; ?>    
				        	</select> 
				    	</div>
						

						<div class="form-group col-md-12">
							<label>Modulo Secundario</label>
							<select name="modulosecundario" id="modulosecundario" class="form-control">
								<div class="form-group col-md-12" id="modulosecundario"></div>
				        	</select> 
				    	</div>
						
						<?php  $orden  = $this->ComboOrden();  ?>
						<div class="form-group col-md-3">
							<label>Orden </label>
							<select name="orden" id="orden" class="form-control">
								<div class="form-group col-md-12" id="orden"></div>
				        	</select> 
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
	            message: "¿Estas seguro de registrar esta interfaz?",
	            title: "Registrar Interfaz",
	            buttons: {
	                main: {
	                    label: "Registrar",
	                    className: "btn-primary",
	                    callback: function() {
	                        //console.log('Eliminado al usuario');
	                        
	                              $( "#frmRegistrarInterfaz" ).submit();
	                         

	                       
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
		$("#modulo").change(function(){
	 		var modulo= $("#modulo").val();
			console.log(modulo);
			$.ajax({ 
				type:"POST",
				data:"idInterfaz="+ modulo,
                url:"?c=Interfaz&a=ComboModuloSecundario",
   
                success:  function (response) {                	
                    $("#modulosecundario").html(response);
					 
                },
                error:function(){
                	alert("error")
                }
            });
			nivel_modulo = localStorage.getItem("modulo_nivel");
			if(nivel_modulo== 2){
				var idInterfaz_superior= $("#modulo").val();
				console.log(idInterfaz_superior);
				$.ajax({ 
						type:"POST",
						data:"idInterfaz_superior="+idInterfaz_superior,
						url:"?c=Interfaz&a=ComboOrden",
		
						success:  function (response) {                	
							$("#orden").html(response);
							console.log(nivel);
						},
							error:function(){
								alert("error")
							}
						}); 
			}
			




	 	})

		
	});	


	
	$(document).ready(function () { 
		$("#nivel").change(function(){
	 		var nivel= $("#nivel").val();
			console.log(nivel);
			$("#modulo").prop("disabled",true);
			if( nivel ==1)
			{
				$("#modulo").prop("disabled",true);
				$("#modulosecundario").prop("disabled",true);
 
			 
				var idInterfaz_superior= 0;
				console.log(idInterfaz_superior);
				$.ajax({ 
						type:"POST",
						data:"idInterfaz_superior="+idInterfaz_superior,
						url:"?c=Interfaz&a=ComboOrden",
		
						success:  function (response) {                	
							$("#orden").html(response);
							console.log(nivel);
						},
							error:function(){
								alert("error")
							}
						});
						
 
			}
			else if( nivel ==2)
			{   $("#modulo").prop("disabled",false);
				$("#modulosecundario").prop("disabled",true);
			    
				
				var idInterfaz_superior= 99;
				console.log(idInterfaz_superior);
				$.ajax({ 
						type:"POST",
						data:"idInterfaz_superior="+idInterfaz_superior,
						url:"?c=Interfaz&a=ComboOrden",
		
						success:  function (response) {                	
							$("#orden").html(response);
							console.log(nivel);
						},
							error:function(){
								alert("error")
							}
						}); 




			}
			else if( nivel ==3)
			{   $("#modulo").prop("disabled",false);
				$("#modulosecundario").prop("disabled",false);
				

				var idInterfaz_superior= 99;
				console.log(idInterfaz_superior);
				$.ajax({ 
						type:"POST",
						data:"idInterfaz_superior="+idInterfaz_superior,
						url:"?c=Interfaz&a=ComboOrden",
		
						success:  function (response) {                	
							$("#orden").html(response);
							console.log(nivel);
						},
							error:function(){
								alert("error")
							}
						}); 

			}
			localStorage.setItem("modulo_nivel",nivel);

			


		});

	});	
 
	
 

</script>
