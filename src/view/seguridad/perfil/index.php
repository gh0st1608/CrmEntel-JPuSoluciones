 <!-- Content Header (Page header) -->
<section class="content-header">  
	<h1>
		Modulo Seguridad
	</h1>
	<ol class="breadcrumb">
		<li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>           
	    <li class="active">Perfil</li>
	</ol>
</section>

<section class="content">
	<div class="row">
		<div class="col-xs-12">
	  		<div class="box">
	    		<div class='box-header with-border'>
	      			<h3 class='box-title'><i class="fa fa-users"></i> Lista de Perfiles</h3> <a class="btn btn-sm btn-primary pull-right" href="?c=Perfil&a=v_Registrar"> Nuevo Perfil</a>
	    		</div>
	    		<div class="box-body box-body_table">
	    		 <?php  $perfiles = $this->Listar();  ?>
 
                  	<table id="TablaEntidad" class="table table-bordered table-hover dataTable no-footer" width="100%">
	                    <thead>
	                      	<tr>                      
		                    	<th>ID</th>                    
			                    <th style="vertical-align: middle;">Perfil</th>			                   
			                    <th style="vertical-align: middle;">Estado</th>
			                    <th style="vertical-align: middle;">Acciones</th>
	                     	</tr>
	                    </thead>
	                    <tbody>
	                    	<?php foreach ($perfiles as $perfil): ?>
	                    	<tr>
	                    		<td><?php echo $perfil['idPerfil']; ?></td>
	                    		<td><?php echo $perfil['Nombre']; ?></td>
	                    		<?php if ($perfil['Estado']==0): ?>
                                <td class=""><span class="label label-success"><i class="fa fa-check-square-o" aria-hidden="true"></i> Activo</span></td>
                                <?php else: ?>
                                <td class=""><span class="label label-danger"><i class="fa fa-square-o" aria-hidden="true"></i> Inactivo</span></td>
                                <?php endif ?>
                            	<td class="a_center">
                            		<a href="?c=Perfil&a=v_Actualizar&idPerfil=<?php echo $perfil['idPerfil']; ?>" class="btn btn-primary btn-xs ">
                                   		<i class="fa fa-pencil"></i>   
                               		</a>
                               		<a class="btn btn-danger btn-xs EliminarPerfil" data-id="<?php echo $perfil['idPerfil']; ?>" data-nombre="<?php echo $perfil['Nombre']; ?>">
                                   		<i class="fa fa-trash"></i>   
                               		</a>                             		
                               	</td>
	                    	</tr>
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
		$(".EliminarPerfil").click(function(event) {
			idPerfil=$(this).attr('data-id');
			bootbox.dialog({
            message: "¿Estas seguro de eliminar el perfil  "+$(this).attr('data-nombre')+"?",
            title: "Eliminar Perfil",
            buttons: {
                main: {
                    label: "Eliminar",
                    className: "btn-primary",
                    callback: function() {
                        //console.log('Eliminado al usuario');
                        
                              window.location.href = "?c=Perfil&a=Eliminar&idPerfil="+idPerfil;
                         

                       
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

