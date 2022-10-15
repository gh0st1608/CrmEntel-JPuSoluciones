
<?php 
error_reporting(E_ALL);
ini_set('display_errors','1');

?>
<?php 

require_once 'controller/subcategoria.controller.php';
require_once 'controller/categoria.controller.php';  
$subcategoria = new SubCategoriaController;
$categoria = new CategoriaController;
$infocategoria = $categoria->Consultar($_REQUEST['idCategoria']);



?>

<!-- Content Header (Page header) -->
<section class="content-header">  
<h1>
    Administracion <small>Subcategorías</small>
</h1>
<ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
     <li><a href="index.php?c=Categoria">Categoría</a></li>     
    <li class="active">SubCategoría</li>
</ol>
</section>

<section class="content">
	<div class="row">
		<div class="col-xs-12">
	  		<div class="box">
	    		<div class='box-header with-border'>
                    <h3 class='box-title' >Lista de SubCategorias de la categoría <b> <?php echo $infocategoria->__GET('Nombre');  ?></b></h3> 
	      			<a class="btn btn-sm btn-primary pull-right" href="?c=SubCategoria&a=v_Registrar&Categoria_id=<?php echo $infocategoria->__GET('idCategoria'); ?>&NombreCategoria=<?php echo $infocategoria->__GET('Nombre'); ?>"> Registrar SubCategoría</a>
	    		</div>
	    		<div class="box-body box-body_table">
                <?php  $subcategorias = $subcategoria->Listar_por_categoria($_REQUEST['idCategoria']);?>
                  	<table id="TablaEntidad" class="table table-bordered table-hover dataTable no-footer" width="100%">
	                    <thead>
	                      	<tr>                      
		                    	<th>ID</th>                    
			                    <th style="vertical-align: middle;">Nombre</th>
								<th style="vertical-align: middle;">Aplicar_Logica</th>
			                    <th style="vertical-align: middle;">Estado</th>
								<th style="vertical-align: middle;">Acciones</th>
	                     	</tr>
	                    </thead>
	                    <tbody>
	                    	<?php foreach ($subcategorias as $subcategoria): ?>
	                    	<tr>
	                    		<td><?php echo $subcategoria['idSubCategoria']; ?></td>
	                    		<td><?php echo $subcategoria['Nombre']; ?></td>
                                <td><?php if ($subcategoria['Aplicar_Logica'] == '1' ){ echo 'SI'; } else { echo 'NO'; }; ?></td>
								<?php $nombre = $categoria -> Consultar($subcategoria['Categoria_id']);?>
	                    	 	<?php if ($subcategoria['Estado']=1):?>
                                <td class=""><span class="label label-success"><i class="fa fa-check-square-o" aria-hidden="true"></i> Activo</span></td>
                                <?php else: ?>
                                <td class=""><span class="label label-danger"><i class="fa fa-square-o" aria-hidden="true"></i> Inactivo</span></td>
                                <?php endif ?>
								<td class="a_center">                            		
                            		<a href="?c=SubCategoria&a=v_Actualizar&idSubCategoria=<?php echo $subcategoria['idSubCategoria']; ?>&Categoria_id=<?php echo $subcategoria['Categoria_id']; ?>" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="Actualizar Subcategoría">
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

<script>

$(document).ready(function() {
    $(".EliminarCampana").click(function(event) {
        idCampana=$(this).attr('data-id');
        bootbox.dialog({
        message: "¿Estas seguro de eliminar la campaña <b>"+$(this).attr('data-campana')+"</b>?",
        title: "Eliminar Campaña",
        buttons: {
            main: {
                label: "Eliminar",
                className: "btn-primary",
                callback: function() {
                    //console.log('Eliminado al usuario');
                    window.location.href = "?c=Campana&a=Eliminar&idCampana="+idCampana;
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