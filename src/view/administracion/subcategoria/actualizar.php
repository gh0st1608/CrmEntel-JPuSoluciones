
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
            <li><a href="index.php?c=SubCategoria&a=ListarxCategoria&idCategoria=<?php echo $_REQUEST['Categoria_id'] ?>">Categoría</a></li>
            <li class="active">Actualizar Subcategoría</li>
          </ol>
</section>

<?php 

require_once 'controller/categoria.controller.php';
$categoria = new CategoriaController;

if (!isset($_REQUEST['idSubCategoria'])==''){
$subcategoria = $this->Consultar($_REQUEST['idSubCategoria']);

$categoria = $categoria -> Consultar($subcategoria->Categoria_id);

$subcategoriaaccion = $this->ConsultarSubCategoriaAccion();
$consultaracciones = $this-> ConsultarAccion();
$LogicaAcciones = $this->ConsultarLogicaAccion();
$LogicaAccionesdetalles = $this->ConsultarLogicaAccionDetalle($_REQUEST['idSubCategoria']);
$id_subcategoria =$_REQUEST['idSubCategoria'];
$id_categoria= $categoria-> idCategoria;
 
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
							<input type="text" name="Categoria_id" id="Categoria_id" value="<?php echo $categoria-> idCategoria ;?>" class="form-control hidden" placeholder=""  readonly="true" />
							<input type="text" name="NombreCategoria" id="NombreCategoria" value="<?php echo $categoria-> Nombre ?>" class="form-control" readonly="true" ></input>  
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
					 
						<div class='box-header with-border'>
							<h3 class='box-title'><i class="fa fa-rocket"></i> Acciones</h3>
							<div>
							<div class="form-group col-md-5"> 
								<?php foreach ($subcategoriaaccion as $scatacciones): ?> 
								 <label><?php  echo $scatacciones['Desc_SubCategoria_Accion']  ; ?></label>
									<div>
										 
									<div class='box-header with-border'>
									<?php if ($scatacciones['Desc_SubCategoria_Accion']  <> "NroAcciones") { ?>
									<?php foreach ($LogicaAccionesdetalles as $LogicaAccionesdetalle): ?> 
										<?php     if ($LogicaAccionesdetalle['Acciones'] ==  $scatacciones['Desc_SubCategoria_Accion'] ) {  ?> 
									 <table class="default">
									 	<tr>
										 <td><input type="number" name="Num_Accion" id="Num_Accion" value="<?php echo $LogicaAccionesdetalle['Num_Accion'] ;?>" placeholder=""  required /></td>	
										 <td class="a_center">
										 
											<select  type="text" style="text-align:center" name="id_Accion" id="id_Accion" required >
											<option text-align: center value="<?php echo $LogicaAccionesdetalle["id_Accion"]?>"><?php echo $LogicaAccionesdetalle["Nom_Accion"]?></option>
	
											<?php foreach ($LogicaAcciones as $LogicaAccion): ?> 
											<option text-align: center value="<?php echo $LogicaAccion["idAccion"]?>"><?php echo $LogicaAccion["Nom_Accion"]?></option>
											 
											<?php endforeach; ?> 
										 </td>	
										 
										 <td><input type="text" name="Desc_Accion" id="Desc_Accion" value="<?php echo $LogicaAccionesdetalle['Desc_Accion'] ;?>"  placeholder=""  required /></td>
										
										 <td class="a_center">                            		
											 <a class="btn btn-primary btn-xs ActualizaAccion" data-toggle="tooltip" data-placement="top" title="" data-original-title="Actualizar Accion"  
												sub-cat-id="<?php echo $id_subcategoria; ?>" 
												cat-id="<?php echo $id_categoria; ?>" 
												data-id="<?php echo $LogicaAccionesdetalle['id_AccionDetalle']; ?>" 
											  > 	 
										 		<i id="save" class="fa fa-floppy-o"></i>   
											</a>
										 </td>
										 <td class="a_center">  
											<a class="btn btn-danger btn-xs EliminarAccion" 
												sub-cat-id="<?php echo $id_subcategoria; ?>" 
												cat-id="<?php echo $id_categoria; ?>" 
												data-id="<?php echo $LogicaAccionesdetalle['id_AccionDetalle']; ?>" 
											  >
										        <i class="fa fa-trash"></i> 
											</a>
										</td>
										</tr>
										<?php $NroAcciones = $LogicaAccionesdetalle['NroAcciones'] ;  } ?> 		
									</table>
									<?php endforeach; ?> 
									<?php   }else {?> 

										<input type="text" name="NroAcciones" id="NroAcciones" value="<?php echo $NroAcciones ;?>" placeholder=""  required />

									<?php } ;?> 	
									</div>	
									</div>	
								<?php endforeach; ?> 
							</div> 
							</div> 
						</div> 

						<div class='box-header with-border'>
							<h3 class='box-title'><i class="fa fa-plus-square-o"></i> Añadir Acciones</h3>			

 							<table class="default">
							<tr>
								<td class="a_center">
										 
									<select  type="text" style="text-align:center" name="Accion2" id="Accion2" required >
									<option text-align: center value="0">-- Seleccionar Accion --</option>

									<?php foreach ($consultaracciones as $consultaraccion): ?> 
										<option text-align: center value="<?php echo $consultaraccion["Desc_SubCategoria_Accion"]?>"><?php echo $consultaraccion["Desc_SubCategoria_Accion"]?></option>
									<?php endforeach; ?> 
							    </td>		
										
								<td><input type="number" name="Num_Accion2" id="Num_Accion2" value="0" placeholder=""  required /></td>	
								<td class="a_center">
								
									<select  type="text" style="text-align:center" name="id_Accion2" id="id_Accion2" required >
									<option text-align: center value="0">Seleccion</option>

									<?php foreach ($LogicaAcciones as $LogicaAccion): ?> 
									<option text-align: center value="<?php echo $LogicaAccion["idAccion"];?>"><?php echo $LogicaAccion["Nom_Accion"];?></option>
										
									<?php endforeach; ?> 
								</td>	
								
								<td><input type="text" name="Desc_Accion2" id="Desc_Accion2" value=""  placeholder=""  required /></td>
							
								<td class="a_center">                            		
									<a class="btn btn-primary btn-xs RegistrarAccion" data-toggle="tooltip" data-placement="top" title="" data-original-title="Actualizar Accion"  
									sub-cat-id="<?php echo $id_subcategoria; ?>" 
									cat-id="<?php echo $id_categoria; ?>" 
								 
									> 	 
									<i id="save" class="fa fa-floppy-o"></i>   
								</a>
								</td>
									
							</tr>
						 
							</table>
				 
					    </div>

						<div class="form-group col-md-12 Data">
					        <label>Comentarios</label>
					        <textarea name="Data" id="Data" rows="5" cols="40" id="Data" value="" class="form-control" placeholder=""  required><?php echo $subcategoria->__GET('Logica_Json'); ?>
							</textarea>
					    </div>
					    <div class="form-group col-md-12">
					      <label>Activo</label>
					      <label class="radio-inline">
					          <input type="radio" name="Estado" id="Estado" value="1" <?php if ($subcategoria->__GET('Estado')==1) { echo 'checked';  } ?>> SI
					      </label>
					      <label class="radio-inline">
					          <input type="radio" name="Estado" id="Estado" value="0" <?php if ($subcategoria->__GET('Estado')==0) { echo 'checked'; }  ?>> NO
					      </label>					    
					    </div>
					  	<div class="col-md-12" style="margin-top:2em;">
							<div class="col-md-6 col-sm-12"> 
								<button type="button" id="btnSubmit" class="btn btn-primary col-md-12 col-xs-12"><i class="fa fa-save"></i> Actualizar</button>    
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


	$(document).ready(function() {
		$(".EliminarAccion").click(function(event) {
			idSubCategoria=$(this).attr('sub-cat-id'); 
			idCategoria=$(this).attr('cat-id'); 
			id_AccionDetalle=$(this).attr('data-id'); 
		 

 
		 
			bootbox.dialog({
            message: "¿Estas seguro de eliminar a <b>"+$(this).attr('data-subcategoria')+"</b>?",
            title: "Eliminar SubCategoria",
            buttons: {
                main: {
                    label: "EliminarAccion",
                    className: "btn-primary",
                    callback: function() {
                        //console.log('Eliminado al usuario');
                        window.location.href = "?c=SubCategoria&a=EliminarAccion&id_AccionDetalle="+id_AccionDetalle+"&idSubCategoria="+idSubCategoria+"&idCategoria="+idCategoria;
						$('#trus').attr('disabled', false);
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


		$(".ActualizaAccion").click(function(event) {
			idSubCategoria=$(this).attr('sub-cat-id'); 
			idCategoria=$(this).attr('cat-id'); 
			id_AccionDetalle=$(this).attr('data-id'); 
			Num_Accion =$('#Num_Accion').val();
			id_Accion =$('#id_Accion').val();
			Desc_Accion =$('#Desc_Accion').val();

		
			
		 
			bootbox.dialog({
            message: "¿Estas seguro de eliminar a <b>"+$(this).attr('data-subcategoria')+"</b>?",
            title: "Actualizar Accion",
            buttons: {
                main: {
                    label: "ActualizaAccion",
                    className: "btn-primary",
                    callback: function() {
                        //console.log('Eliminado al usuario');
                        window.location.href = "?c=SubCategoria&a=ActualizaAccion&id_AccionDetalle="+id_AccionDetalle+"&Num_Accion="+Num_Accion+"&id_Accion="+id_Accion+"&Desc_Accion="+Desc_Accion+"&idSubCategoria="+idSubCategoria+"&idCategoria="+idCategoria;
					 
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

		$(".RegistrarAccion").click(function(event) {
			idSubCategoria=$(this).attr('sub-cat-id'); 
			idCategoria=$(this).attr('cat-id');  
			Num_Accion =$('#Num_Accion2').val();
			id_Accion =$('#id_Accion2').val();
			Desc_Accion =$('#Desc_Accion2').val();
			Desc_SubCategoria_Accion =$('#Accion2').val(); 
			

			console.log(idSubCategoria);
			console.log(idCategoria); 
			console.log(Num_Accion);
			console.log(id_Accion);
			console.log(Desc_Accion);
			console.log(Desc_SubCategoria_Accion);
 


			bootbox.dialog({
            message: "¿Estas seguro de registrar una nueva accion?",
            title: "Registrar Accion",
            buttons: {
                main: {
                    label: "RegistrarAccion",
                    className: "btn-primary",
                    callback: function() {
                        //console.log('Eliminado al usuario');
                        window.location.href = "?c=SubCategoria&a=RegistraAccion&Desc_SubCategoria_Accion="+Desc_SubCategoria_Accion+"&Num_Accion="+Num_Accion+"&id_Accion="+id_Accion+"&Desc_Accion="+Desc_Accion+"&idSubCategoria="+idSubCategoria+"&idCategoria="+idCategoria;
					 
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