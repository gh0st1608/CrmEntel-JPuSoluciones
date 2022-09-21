 <!-- Content Header (Page header) -->
<section class="content-header">  
    <h1>
        Reporte <small>Exportar Gestiones </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>           
        <li class="active">Exportar Reporte Gestiones</li>
    </ol>
</section>
<?php 
        $ListaCarteras = $this->Consultas("select * from cartera where activo=1 and eliminado=0 order by Entidad_id;");
        $ListaCanalGestion = $this->Consultas("select * from tipogestion where activo=1 and eliminado=0;");
         ?>
<section class="content">
    <div class="row">
            
        <div class="col-xs-12">


            <form action="" method="post" name="form">

            
            <div class="box">               
                <div class="box-body box-body_table">
                    <div class="form-group col-md-2">   
                        <label class="" for="">Carteras</label>
                        <div class="input-group">
                            <select multiple class="form-control " id="ListaCartera" name="ListaCartera[]">
                                <?php foreach ($ListaCarteras as $cartera): ?>
                                    <option value="<?php echo $cartera['idCartera']; ?>"><?php echo $cartera['nombre']; ?></option>
                                <?php endforeach ?>
                              
                            </select>
                        </div>  
                    </div>

                    <div class="form-group col-md-2">   
                        <label class="" for="">Canal Gestíon</label>
                        <div class="input-group">
                            <select multiple class="form-control " id="ListaCanalGestion" name="ListaCanalGestion[]">
                                <?php foreach ($ListaCanalGestion as $canal): ?>
                                    <option value="<?php echo $canal['idTipoGestion']; ?>"><?php echo $canal['descripcion']; ?></option>
                                <?php endforeach ?>
                              
                            </select>
                        </div>  
                    </div>
                    <div class="form-group col-md-2 rango_fechas">

                        <label for="">Fecha Inicio</label>
                        <input type="date" class="form-control input-sm " name="FechaInicioGestion" id="FechaInicioGestion" value="" />         
                    </div>
                    <div class="form-group col-md-2 rango_fechas">
                        <label for="">Fecha Fin</label>
                        <input type="date" class="form-control input-sm " name="FechaFinGestion" id="FechaFinGestion" value="" />  
                               
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

    </div><!-- /.row -->
</section><!-- /.content -->


<script>
    function buscar(){
        var ListaCartera=$("#ListaCartera").val();
        var ListaCanalGestion=$("#ListaCanalGestion").val();
        var FechaInicioGestion=$("#FechaInicioGestion").val();
        var FechaFinGestion=$("#FechaFinGestion").val();
      window.open("index.php?c=Reportes&a=v_Exportar_Gestiones&FechInic="+FechaInicioGestion+"&FechFin="+FechaFinGestion+"&Carteras="+ListaCartera+"&Canales="+ListaCanalGestion+"", '_blank');
        
    }

</script>