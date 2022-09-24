 <!-- Content Header (Page header) -->
<section class="content-header">  
	<h1>
		Modulo Administracion
	</h1>
	<ol class="breadcrumb">
		<li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>           
	    <li class="active">Categoria</li>
	</ol>
</section>

<section class="content">
	<div class="row">
		<div class="col-xs-12">
	  		<div class="box">
	    		<div class='box-header with-border'>
	      			 <h3 class='box-title'><i class="fa fa-briefcase"></i> Lista de Categorias</h3> <?php if ($_SESSION['Perfil_Actual']==1): ?><a class="btn btn-sm btn-primary pull-right" href="?c=Categoria&a=v_Registrar">Nueva Categoria</a><?php endif; ?>
	    		</div>
	    		<div class="box-body box-body_table">
	    		 <?php  $categorias = $this->Listar();  ?>
 
                  	<table id="TablaEntidad" class="table table-bordered table-hover dataTable no-footer" width="100%">
	                    <thead>
	                      	<tr>                      
		                    	<th>ID</th>                    
			                    <th style="vertical-align: middle;">Nombre</th>
								<th style="vertical-align: middle;">Estado</th>
	                     	</tr>
	                    </thead>
	                    <tbody>
	                    	<?php foreach ($categorias as $categoria): ?>
	                    	<tr>
	                    		<td><?php echo $categoria['idCategoria']; ?></td>
	                    		<td><?php echo $categoria['Nombre']; ?></td>
								<td><?php echo $categoria['Estado']; ?></td>
								<td class="a_center">                            		
                            		<a href="?c=Categoria&a=v_Actualizar&idCategoria=<?php echo $categoria['idCategoria']; ?>" class="btn btn-primary btn-xs ">
                                   		<i class="fa fa-pencil"></i>   
                               		</a>
                               		<?php if ($_SESSION['Perfil_Actual']==1): ?>
                               		<a class="btn btn-danger btn-xs EliminarCategoria" data-id="<?php echo $categoria['idCategoria']; ?>" data-categoria="<?php echo $categoria['Nombre']; ?>">
                                   		<i class="fa fa-trash"></i>   
                               		</a>
                               		<?php endif; ?>
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
		$(".EliminarCategoria").click(function(event) {
			idCategoria=$(this).attr('data-id');
			bootbox.dialog({
            message: "¿Estas seguro de eliminar a <b>"+$(this).attr('data-categoria')+"</b>?",
            title: "Eliminar Categoria",
            buttons: {
                main: {
                    label: "Eliminar",
                    className: "btn-primary",
                    callback: function() {
                        //console.log('Eliminado al usuario');
                        window.location.href = "?c=Categoria&a=Eliminar&idCategoria="+idCategoria;
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

