<?php require_once 'controller/categoria.controller.php'; 
$categoria = new CategoriaController;


?>
 <!-- Content Header (Page header) -->
<section class="content-header">  
	<h1>
		Modulo Administracion
	</h1>
	<ol class="breadcrumb">
		<li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>           
	    <li class="active">SubCategoria</li>
	</ol>
</section>

<section class="content">
	<div class="row">
		<div class="col-xs-12">
	  		<div class="box">
	    		<div class='box-header with-border'>
	      			 <h3 class='box-title'><i class="fa fa-briefcase"></i> Lista de SubCategorias</h3> <?php if ($_SESSION['Perfil_Actual']==1): ?><a class="btn btn-sm btn-primary pull-right" href="?c=SubCategoria&a=v_Registrar">Registrar Subcategoria</a><?php endif; ?>
	    		</div>
	    		<div class="box-body box-body_table">
	    		 <?php  $subcategorias = $this->Listar();  ?>
 
                  	<table id="TablaEntidad" class="table table-bordered table-hover dataTable no-footer" width="100%">
	                    <thead>
	                      	<tr>                      
		                    	<th>ID</th>                    
			                    <th style="vertical-align: middle;">Nombre</th>
								<th style="vertical-align: middle;">Categoria</th>
			                    <th style="vertical-align: middle;">Estado</th>
								<th style="vertical-align: middle;">Acciones</th>
	                     	</tr>
	                    </thead>
	                    <tbody>
	                    	<?php foreach ($subcategorias as $subcategoria): ?>
					 
	                    	<tr>
	                    		<td><?php echo $subcategoria['idSubCategoria']; ?></td>
	                    		<td><?php echo $subcategoria['Nombre']; ?></td>
								<?php $nombre = $categoria -> Consultar($subcategoria['Categoria_id']);?>
								<td><?php   echo $nombre -> Nombre;?></td> 
	                    	 	<?php if ($subcategoria['Estado']=1):?>
                                <td class=""><span class="label label-success"><i class="fa fa-check-square-o" aria-hidden="true"></i> Activo</span></td>
                                <?php else: ?>
                                <td class=""><span class="label label-danger"><i class="fa fa-square-o" aria-hidden="true"></i> Inactivo</span></td>
                                <?php endif ?>
								<td class="a_center">                            		
                            		<a href="?c=SubCategoria&a=v_Actualizar&idSubCategoria=<?php echo $subcategoria['idSubCategoria']; ?>" class="btn btn-primary btn-xs ">
                                   		<i class="fa fa-pencil"></i>   
                               		</a>
                               		<?php if ($_SESSION['Perfil_Actual']==1): ?>
                               		<a class="btn btn-danger btn-xs EliminarSubCategoria" data-id="<?php echo $subcategoria['idSubCategoria']; ?>" data-subcategoria="<?php echo $subcategoria['Nombre']; ?>">
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
		$(".EliminarSubCategoria").click(function(event) {
			idSubCategoria=$(this).attr('data-id');
			bootbox.dialog({
            message: "¿Estas seguro de eliminar a <b>"+$(this).attr('data-subcategoria')+"</b>?",
            title: "Eliminar SubCategoria",
            buttons: {
                main: {
                    label: "Eliminar",
                    className: "btn-primary",
                    callback: function() {
                        //console.log('Eliminado al usuario');
                        window.location.href = "?c=SubCategoria&a=Eliminar&idSubCategoria="+idSubCategoria;
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

