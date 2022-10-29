
<?php
$periodos = $this->ListarPeriodos();
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
        <form action="" method="post" name="form">            
            <div class="box">               
                <div class="box-body box-body_table">
                    <div class="form-group col-md-12">   
                    <h3>Exportar Historico de Licencias </h1>
                    </div>
                    <div class="form-group col-md-2 rango_fechas">

                        <label for="">Periodo</label>
                        <template id="listaTemplate"> 
                        <?php foreach ($periodos as $periodo): ?>          
							<option value="<?php echo $periodo['Periodo']; ?>">                      
						<?php endforeach; ?>
                        </template>
                        <input type="text" class="form-control input-sm " name="Periodo" id="Periodo" list="listaPeriodo">
                        <datalist id="listaPeriodo"></datalist>
                                 
                    </div>
                    <div class="form-group col-md-1">
                        <label for="" style="color:transparent;">a</label><br>
						<button type="button" name="ExportarLicencias" id="ExportarLicencias" onclick="buscar()" class="btn btn-primary col-md-16"><i class="fa fa-save"></i> Exportar Excel</button>           
                    </div>      
                    
                </div>
            </div><!-- /.box -->
        </form>
	  		<div class="box">
	    		<div class='box-header with-border'>
	      			<h3 class='box-title'><i class="fa fa-user"></i> Lista de Licencias</h3>
	    		</div>
	    		<div class="box-body box-body_table">
	    		 <?php  $licencias = $this->Listar();  ?>
 
                  	<table id="TablaEntidad" class="table table-bordered table-hover dataTable no-footer" width="100%">
	                    <thead>
	                      	<tr>                      
		                    	<th style="text-align: center;">Item</th>
								<th style="text-align: center;">Perfil</th>   
								<th style="text-align: center;">Usuario</th>
								<th style="text-align: center;">Nombres y Apellidos</th>                 
								<th style="text-align: center;">Estado Usuario</th>
			                    <th style="text-align: center;">Periodo</th>
                                <th style="text-align: center;">Fecha Inicio</th>
                                <th style="text-align: center;">Fecha Fin</th>
                                <th style="text-align: center;">Estado Licencia</th>
	                     	</tr>
	                    </thead>
	                    <tbody>
							<?php foreach ($licencias as $licencia): ?>
	                    	<tr>
								<td style="text-align: center;"><?php echo $licencia['idLicencia']; ?></td>
								<td style="text-align: center;"><?php  echo $licencia['NombrePerfil'];?></td>
								<td style="text-align: center;"><?php echo $licencia['Documento']; ?></td>
                                <td style="text-align: center;"><?php  echo $licencia['Primer_Nombre'].' '.$licencia['Segundo_Nombre'].' '.$licencia['Apellido_Paterno'].' '.$licencia['Apellido_Materno'];?></td>
								<?php if ($licencia['Estado_Usuario']==1): ?>
                                <td style="text-align: center;" class=""><span class="label label-success"><i class="fa fa-check-square-o" aria-hidden="true"></i> Activo</span></td>
                                <?php endif ?>
								<?php if ($licencia['Estado_Usuario']==0): ?>
                                <td style="text-align: center;" class=""><span class="label label-danger"><i class="fa fa-square-o" aria-hidden="true"></i> Inactivo</span></td>
                                <?php endif ?>
								<?php if ($licencia['Estado_Usuario']==2): ?>
								<td style="text-align: center;" class=""><span class="label label-default"><i class="fa fa-square-o" aria-hidden="true"></i> Bloqueado</span></td>
                                <?php endif ?>
                                <td style="text-align: center;"><?php echo $licencia['Periodo']; ?></td>
                                <?php date_default_timezone_set('UTC'); ?>
                                <td style="text-align: center;"><?php echo date("d-M",strtotime($licencia['Fecha_Inicio'])); ?></td>
                                <td style="text-align: center;"><?php echo date("d-M",strtotime($licencia['Fecha_Fin'])); ?></td>
                                <!--<td style="text-align: center;"></td>-->
								<?php if ($licencia['Estado_Licencia']==1): ?>
                                <td style="text-align: center;" class=""><span class="label label-success"><i class="fa fa-check-square-o" aria-hidden="true"></i> Activo</span></td>
                                <?php endif ?>
								<?php if ($licencia['Estado_Licencia']==0): ?>
                                <td style="text-align: center;" class=""><span class="label label-danger"><i class="fa fa-square-o" aria-hidden="true"></i> Inactivo</span></td>
                                <?php endif ?>
								<?php if ($licencia['Estado_Licencia']==2): ?>
								<td style="text-align: center;"><span class="label label-default"><i class="fa fa-square-o" aria-hidden="true"></i> Bloqueado</span></td>
                                <?php endif ?>
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
	var search = document.querySelector('#Periodo');
    var results = document.querySelector('#listaPeriodo');
    var templateContent = document.querySelector('#listaTemplate').content;
    search.addEventListener('keyup', function handler(event) {
        while (results.children.length) results.removeChild(results.firstChild);
        var inputVal = new RegExp(search.value.trim(), 'i');
        var set = Array.prototype.reduce.call(templateContent.cloneNode(true).children, function searchFilter(frag, item, i) {
            if (inputVal.test(item.value) && frag.children.length < 6) frag.appendChild(item);
            return frag;
        }, document.createDocumentFragment());
        results.appendChild(set);
    });

    function buscar(){
        var Periodo=$("#Periodo").val();
        console.log(Periodo);
        window.open("index.php?c=Licencia&a=Reporte_Excel_Licencia&Periodo="+Periodo+"", '_blank');
        
    }


</script>

