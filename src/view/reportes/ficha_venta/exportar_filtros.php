 <!-- Content Header (Page header) -->
<section class="content-header">  
    <h1>
        Reporte <small>Exportar Fichas de Venta</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>           
        <li class="active">Exportar Fichas de Venta</li>
    </ol>
</section>
<?php 
        $VBO_Estado_Venta_BO = $this->Consultas("select * from subcategoria where estado=1 and eliminado=0 and Categoria_id=31 order by Orden;");
         ?>
<section class="content">
    <div class="row">
            
        <div class="col-xs-12">


            <form action="" method="post" name="form">

            
            <div class="box">               
                <div class="box-body box-body_table">
                    <div class="form-group col-md-2">   
                        <label class="" for="">Estado Venta BO</label>
                        <div class="input-group">
                            <select multiple class="form-control " id="VBO_Estado_Venta_BO" name="VBO_Estado_Venta_BO[]" style="min-height: 170px;">
                                <?php foreach ($VBO_Estado_Venta_BO as $item): ?>
                                    <option value="<?php echo $item['idSubCategoria']; ?>"><?php echo $item['Nombre']; ?></option>
                                <?php endforeach ?>
                              
                            </select>
                        </div>  
                    </div>
                    <div class="form-group col-md-2 rango_fechas">

                        <label for="">Fecha Inicio</label>
                        <input type="date" class="form-control input-sm " name="FechaInicio" id="FechaInicio" value="" />         
                    </div>
                    <div class="form-group col-md-2 rango_fechas">
                        <label for="">Fecha Fin</label>
                        <input type="date" class="form-control input-sm " name="FechaFin" id="FechaFin" value="" />  
                               
                    </div>


                    <div class="form-group col-md-1">
                        <label for="" style="color:transparent;">a</label><br>
                        <button type="button" class="btn btn-primary col-md-8" onclick="buscar()"><i class="fa fa-search"></i></button>         
                    </div>
                    <div class="form-group col-md-1">
                        <label for="" style="color:transparent;">a</label><br>
                        <button type="button" class="btn btn-danger col-md-8" onclick="borrar()"><i class="fa fa-trash-o"></i> </button>         
                    </div>        
                    
                </div>
            </div><!-- /.box -->
        </form>
        </div><!-- /.col -->        

        <div class="col-xs-12">


            <form action="" method="post" name="form">

            
            <div class="box">               
                <div class="box-body box-body_table">
                    <div class="form-group col-md-12">   
                      <h3>Exportar Historico de Actualizaciones - Fichas de Venta </h1>
                    </div>
                    <div class="form-group col-md-2 rango_fechas">

                        <label for="">Fecha Inicio</label>
                        <input type="date" class="form-control input-sm " name="FechaInicio_RH" id="FechaInicio_RH" value="" />         
                    </div>
                    <div class="form-group col-md-2 rango_fechas">
                        <label for="">Fecha Fin</label>
                        <input type="date" class="form-control input-sm " name="FechaFin_RH" id="FechaFin_RH" value="" />  
                               
                    </div>


                    <div class="form-group col-md-1">
                        <label for="" style="color:transparent;">a</label><br>
                        <button type="button" class="btn btn-primary col-md-8" onclick="buscar_rh()"><i class="fa fa-search"></i></button>         
                    </div>
                    <div class="form-group col-md-1">
                        <label for="" style="color:transparent;">a</label><br>
                        <button type="button" class="btn btn-danger col-md-8" onclick="borrar()"><i class="fa fa-trash-o"></i> </button>         
                    </div>        
                    
                </div>
            </div><!-- /.box -->
        </form>
        </div><!-- /.col -->

    </div><!-- /.row -->
</section><!-- /.content -->


<script>
    function buscar(){
        var VBO_Estado_Venta_BO=$("#VBO_Estado_Venta_BO").val();
        var FechaInicio=$("#FechaInicio").val();
        var FechaFin=$("#FechaFin").val();
      window.open("index.php?c=Reportes&a=Excel_Fichas_Venta&FechaInicio="+FechaInicio+"&FechaFin="+FechaFin+"&VBO_Estado_Venta_BO="+VBO_Estado_Venta_BO+"", '_blank');
        
    }

    function buscar_rh(){
    
        var FechaInicio=$("#FechaInicio_RH").val();
        var FechaFin=$("#FechaFin_RH").val();
      window.open("index.php?c=Reportes&a=Excel_RH_Fichas_Venta&FechaInicio="+FechaInicio+"&FechaFin="+FechaFin+"", '_blank');
        
    }

</script>