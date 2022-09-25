<?php
require_once 'controller/perfil.controller.php'; 

$perfil = new PerfilController;

?>
<!-- Content Header (Page header) -->
<section class="content-header">  
	<h1>
		Modulo Seguridad
	</h1>
	<ol class="breadcrumb">
		<li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>           
	    <li class="active">Usuario</li>
	</ol>
</section>

<section class="content">
	<div class="row">
		<div class="col-xs-12">
	  		<div class="box">
	    		<div class='box-header with-border'>
	      			<h3 class='box-title'><i class="fa fa-user"></i> Lista de Usuario</h3> <a class="btn btn-sm btn-primary pull-right" href="?c=Usuario&a=v_Registrar"> Nuevo Usuario</a>
	    		</div>
	    		<div class="box-body box-body_table">
	    		 <?php  $usuarios = $this->Listar();  ?>
 
                  	<table id="TablaEntidad" class="table table-bordered table-hover dataTable no-footer" width="100%">
	                    <thead>
	                      	<tr>                      
		                    	<th>ID</th>   
								<th style="vertical-align: middle;">Usuario</th>                 
			                    <th style="vertical-align: middle;">Perfil</th>
								<th style="vertical-align: middle;">Estado</th>
			                    <th style="vertical-align: middle;">Acciones</th>
	                     	</tr>
	                    </thead>
	                    <tbody>
							<?php foreach ($usuarios as $usuario): ?>
	                    	<tr>
								<td><?php echo $usuario['idUsuario']; ?></td>
								<td><?php echo $usuario['Login']; ?></td>
								<?php  $nombre = $perfil -> Consultar($usuario['Perfil_id']);?>
								<td><?php  echo $nombre -> Nombre;?></td> 
								<?php if ($usuario['Estado']==0): ?>
                                <td class=""><span class="label label-success"><i class="fa fa-check-square-o" aria-hidden="true"></i> Activo</span></td>
                                <?php else: ?>
                                <td class=""><span class="label label-danger"><i class="fa fa-square-o" aria-hidden="true"></i> Inactivo</span></td>
                                <?php endif ?>
                            	<td class="a_center">
                            		<a href="?c=Usuario&a=v_Actualizar&idUsuario=<?php echo $usuario['idUsuario']; ?>" class="btn btn-primary btn-xs ">
                                   		<i class="fa fa-pencil"></i>   
                               		</a>
                               		<a class="btn btn-danger btn-xs EliminarUsuario" data-id="<?php echo $usuario['idUsuario']; ?>" data-usuario="<?php echo $usuario['Login']; ?>">
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
		$(".EliminarUsuario").click(function(event) {
			idUsuario=$(this).attr('data-id');
			bootbox.dialog({
            message: "¿Estas seguro de eliminar al usuario "+$(this).attr('data-usuario')+"?",
            title: "Eliminar Usuario",
            buttons: {
                main: {
                    label: "Eliminar",
                    className: "btn-primary",
                    callback: function() {
                        //console.log('Eliminado al usuario');
                        
                              window.location.href = "?c=Usuario&a=Eliminar&idUsuario="+idUsuario;
                         

                       
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

