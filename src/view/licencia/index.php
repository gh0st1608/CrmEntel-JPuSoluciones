<?php
require_once 'controller/perfil.controller.php'; 
require_once 'controller/persona.controller.php'; 
$perfil = new PerfilController;
$persona = new PersonaController;

?>
<!-- Content Header (Page header) -->
<section class="content-header">  
	<h1>
		Modulo Licencias
	</h1>
	<ol class="breadcrumb">
		<li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>           
	    <li class="active">Licencia</li>
	</ol>
</section>

<section class="content">
	<div class="row">
		<div class="col-xs-12">
	  		<div class="box">
	    		<div class='box-header with-border'>
	      			<h3 class='box-title'><i class="fa fa-user"></i> Lista de Licencia</h3> <a class="btn btn-sm btn-primary pull-right" href="?c=Usuario&a=v_Registrar"> Registrar Usuario</a>
	    		</div>
	    		<div class="box-body box-body_table">
	    		 <?php  $usuarios = $this->Listar();  ?>
 
                  	<table id="TablaEntidad" class="table table-bordered table-hover dataTable no-footer" width="100%">
	                    <thead>
	                      	<tr>                      
		                    	<th>ID</th>
								<th style="vertical-align: middle;">Perfil</th>   
								<th style="vertical-align: middle;">Usuario</th>
								<th style="vertical-align: middle;">Documento</th>
								<th style="vertical-align: middle;">Clave Digital</th>
								<th style="vertical-align: middle;">Nombres y Apellidos</th>                 
								<th style="vertical-align: middle;">Estado Usuario</th>
			                    <th style="vertical-align: middle;">Periodo</th>
                                <th style="vertical-align: middle;">Fecha_Inicio</th>
                                <th style="vertical-align: middle;">Fecha_Fin</th>
                                <th style="vertical-align: middle;">Estado_Licencia</th>
	                     	</tr>
	                    </thead>
	                    <tbody>
							<?php foreach ($usuarios as $usuario): ?>
	                    	<tr>
								<td><?php echo $usuario['idUsuario']; ?></td>
								<td><?php  echo $usuario['Nombre_Perfil'];?></td>
								<td><?php echo $usuario['Login']; ?></td>
								<td><?php  echo $usuario['Documento']; ?>
								<td><?php echo $usuario['Password_Digital']; ?></td>
								<td><?php  echo $usuario['Primer_Nombre'].' '.$usuario['Segundo_Nombre'].' '.$usuario['Apellido_Paterno'].' '.$usuario['Apellido_Materno'];?></td>
								<?php if ($usuario['Estado']==1): ?>
                                <td class=""><span class="label label-success"><i class="fa fa-check-square-o" aria-hidden="true"></i> Activo</span></td>
                                <?php endif ?>
								<?php if ($usuario['Estado']==0): ?>
                                <td class=""><span class="label label-danger"><i class="fa fa-square-o" aria-hidden="true"></i> Inactivo</span></td>
                                <?php endif ?>
								<?php if ($usuario['Estado']==2): ?>
								<td class=""><span class="label label-default"><i class="fa fa-square-o" aria-hidden="true"></i> Bloqueado</span></td>
                                <?php endif ?>
                            	<td class="a_center">
                            		<a href="?c=Usuario&a=v_Actualizar&idUsuario=<?php echo $usuario['idUsuario']; ?>&Persona_id=<?php echo $usuario['Persona_id'];?>" class="btn btn-primary btn-xs ">
                                   		<i class="fa fa-pencil"></i>   
                               		</a>
									<a class="btn btn-danger btn-xs DesbloquearyEliminarSesion" data-id="<?php echo $usuario['idUsuario']; ?>" data-usuario="<?php echo $usuario['Login']; ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Desbloquear Usuario y Cerrar Sesiones Activas">
									<i class="fa fa-unlock" aria-hidden="true"></i>
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
		$(".DesbloquearyEliminarSesion").click(function(event) {
			idUsuario=$(this).attr('data-id');
			Login=$(this).attr('data-usuario');
			bootbox.dialog({
            message: "¿Estas seguro de desbloquear al usuario "+$(this).attr('data-usuario')+" y cerrar las sesiones activas?",
            title: "Desbloquear Usuario y Cerrar Sesión",
            buttons: {
                main: {
                    label: "Aceptar",
                    className: "btn-primary",
                    callback: function() {
                        //console.log('Eliminado al usuario');
                        
                              window.location.href = "?c=Usuario&a=DesbloquearEliminarSesion&idUsuario="+idUsuario+"&Login="+Login;
                         
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

