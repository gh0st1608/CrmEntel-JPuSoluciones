 <!-- Content Header (Page header) -->
<section class="content-header">  
	<h1>
		Modulo Seguridad
	</h1>
	<ol class="breadcrumb">
		<li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>           
	    <li class="active">Interfaz</li>
	</ol>
</section>

<section class="content">
	<div class="row">
		<div class="col-xs-12">
	  		<div class="box">
	    		<div class='box-header with-border'>
	      			<h3 class='box-title'><i class="fa fa-users"></i> Lista de Interfaces</h3> <a class="btn btn-sm btn-primary pull-right" href="?c=Interfaz&a=v_Registrar"> Registrar Interfaz</a>
	    		</div>
	    		<div class="box-body box-body_table">
	    		 <?php  $modulos = $this->ConsultaModulo();  ?>
 
                  	<table id="TablaEntidad" class="table table-bordered table-hover dataTable no-footer" width="100%">
	                    <thead>
	                      	<tr>                      
		                    	<th>ID</th>                    
			                    <th style="vertical-align: middle;">Interfaz</th>			                   
			                    <th style="vertical-align: middle;">Modulo</th>
			                    <th style="vertical-align: middle;">Nivel</th>
								<th style="vertical-align: middle;">Orden</th>
								<th style="vertical-align: middle;">Estado</th>
	                     	</tr>
	                    </thead>
	                    <tbody>
						<?php $id = 0 ?>
	                    	<?php foreach ($modulos as $modulo): ?>
	                    	<tr><td><?php $id = $id +1 ; echo $id ?></td>
	                    		<td><?php echo $modulo['Nombre']; ?></td>
	                    		<td><?php echo "--" ?></td>
								<td><?php echo $modulo['Nivel']; ?></td>
								<td><?php echo $modulo['Orden']; ?></td>
	                    		<?php if ($modulo['Estado']==1): ?>
                                <td class=""><span class="label label-success"><i class="fa fa-check-square-o" aria-hidden="true"></i> Activo</span></td>
                                <?php else: ?>
                                <td class=""><span class="label label-danger"><i class="fa fa-square-o" aria-hidden="true"></i> Inactivo</span></td>
                                <?php endif ?>
                            	<td class="a_center">
                            		<a href="?c=Interfaz&a=v_Actualizar&idInterfaz=<?php echo $modulo['idInterfaz']; ?>" class="btn btn-primary btn-xs ">
                                   		<i class="fa fa-pencil"></i>   
                               		</a>
                               		<a class="btn btn-danger btn-xs EliminarInterfaz" data-id="<?php echo $modulo['idInterfaz']; ?>" data-nombre="<?php echo $modulo['Nombre']; ?>">
                                   		<i class="fa fa-trash"></i>   
                               		</a>                             		
                               	</td>
	                    	</tr>
							<?php  $niveles = $this->ListarNivel($modulo['idInterfaz']);  ?>
							<?php foreach ($niveles as $nivel): ?>
							<tr><td><?php $id = $id +1 ; echo $id ?></td>
								<td><?php echo $nivel['Nombre']; ?></td>
								<td><?php echo $nivel['NombreModulo'];?></td>
								<td><?php echo $nivel['Nivel']; ?></td>
								<td><?php echo $nivel['Orden']; ?></td>
								<?php if ($nivel['Estado']==1): ?>
								<td class=""><span class="label label-success"><i class="fa fa-check-square-o" aria-hidden="true"></i> Activo</span></td>
								<?php else: ?>
								<td class=""><span class="label label-danger"><i class="fa fa-square-o" aria-hidden="true"></i> Inactivo</span></td>
								<?php endif ?>
								<td class="a_center">
									<a href="?c=Interfaz&a=v_Actualizar&idInterfaz=<?php echo $nivel['idInterfaz']; ?>" class="btn btn-primary btn-xs ">
										<i class="fa fa-pencil"></i>   
									</a>
									<a class="btn btn-danger btn-xs EliminarInterfaz" data-id="<?php echo $nivel['idInterfaz']; ?>" data-nombre="<?php echo $nivel['Nombre']; ?>">
										<i class="fa fa-trash"></i>   
									</a>                             		
								</td>
							</tr>
							<?php endforeach; ?>			
 
	                    	<?php endforeach; ?>
	                    </tbody>
                	</table>                    
                </div>
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->

<script>
	
	$(document).ready(function() {
		$(".EliminarInterfaz").click(function(event) {
			idInterfaz=$(this).attr('data-id');
			bootbox.dialog({
            message: "¿Estas seguro de eliminar el interfaz  "+$(this).attr('data-nombre')+"?",
            title: "Eliminar Interfaz",
            buttons: {
                main: {
                    label: "Eliminar",
                    className: "btn-primary",
                    callback: function() {
                        //console.log('Eliminado al usuario');
                        
                              window.location.href = "?c=Inrterfaz&a=Eliminar&idInterfaz="+idInterfaz;
                         

                       
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

