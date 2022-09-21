
<!-- Content Header (Page header) -->
<section class="content-header">  
  <h1>
    Procesos <small>Importar información del Deudor</small>
  </h1>
  <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Importar información</li>
          </ol>
</section>
<section class="content">
  <!-- Info boxes -->
  <div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="box">
          <div class='box-header with-border'>
              <h3 class='box-title'>Actualizar Información del Cliente
                <a href="<?php echo RUTA_HTTP; ?>/uploads/files/templates/Plantilla_Actualizar_Info_Cliente.xlsx" class="btn btn-success btn-xs " data-toggle="tooltip" data-placement="top" title="Descargar Plantilla">
                  <i class="fa fa-file-excel-o" aria-hidden="true"></i>
                </a>
              </h3>
          </div>
          <form role="form" action="?c=Importar&a=Act_Info_Deudor" method="post" enctype="multipart/form-data" id="Form_Act_Deudor">
            <div class="box-body">              
              <div class="form-group">
                <label for="DataDeudores">Ingrese archivo .csv</label>
                <input name="DataDeudores" id="DataDeudores" class="form-control" type="file" size="35" />
                <div class="msg_file" style="    margin-top: 1em;"></div>           
              </div>
            </div><!-- /.box-body -->
            <div class="box-footer">
              <div class="col-md-6">
                <button type="submit" class="col-md-12 btn btn-default btn_submit_file" id="btn_submit_clientes"  disabled="true">Procesar</button>
              </div>
              <div class="col-md-6">
                <button type="button" class="col-md-12 btn btn-danger btn_reset_files" id="btn_reset">Cancelar</button>
              </div>
              
              
            </div>
          </form>
        </div><!-- /.box -->
      </div><!-- /.col -->
   </div><!-- /.row -->
</section><!-- /.content -->



<section class="content">
  <div class="row">    
    <div class="col-sm-12 col-md-12">
        <div class="box">
          <div class='box-header with-border'>
              <h3 class='box-title'> Importar Teléfonos 
                <a href="<?php echo RUTA_HTTP; ?>/uploads/files/templates/Plantilla_importar_telefonos.xlsx" class="btn btn-success btn-xs " data-toggle="tooltip" data-placement="top" title="Descargar Plantilla">
                  <i class="fa fa-file-excel-o" aria-hidden="true"></i>
                </a>
                <a href="index.php?c=Procesos&a=ActualizarFiltroTelefono" class="btn btn-default btn-xs " data-toggle="tooltip" data-placement="top" title="Actualizar Filtro">
                  <i class="fa fa-mobile" aria-hidden="true"></i> Actualizar Filtro Tiene Telefono
                </a>
              </h3> 
          </div>
          <form role="form" action="?c=Importar&a=Imp_Telefono" method="post" enctype="multipart/form-data" id="Form_Imp_Telefonos">
          <div class="box-body">
            
            <div class="form-group">
              <label for="DataTelefonos">Ingrese archivo .csv</label>
              <input name="DataTelefonos" id="DataTelefonos" class="form-control" type="file" size="100" />
              <div class="msg_file"></div>
             
            </div>
           
            </div><!-- /.box-body -->


        <div class="box-footer">
          <div class="col-md-6">
            <button type="submit" class="col-md-12 btn btn-default btn_submit_file" id="btn_submit" disabled="true" >Procesar Archivo</button>
          </div>
          <div class="col-md-6">
            <button type="button" class="col-md-12 btn btn-danger btn_reset_files" id="btn_reset">Cancelar</button>
          </div>
        
        
      </div>
        </form>
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->

<section class="content">
  <div class="row">    
    <div class="col-sm-12 col-md-12">
        <div class="box">
          <div class='box-header with-border'>
              <h3 class='box-title'>Importar Direcciones
                <a href="<?php echo RUTA_HTTP; ?>/uploads/files/templates/Plantilla_importar_direcciones.xlsx" class="btn btn-success btn-xs " data-toggle="tooltip" data-placement="top" title="Descargar Plantilla">
                  <i class="fa fa-file-excel-o" aria-hidden="true"></i>
                </a>
              </h3>

          </div>
          <form role="form" action="?c=Importar&a=Imp_Direccion" method="post" enctype="multipart/form-data" id="Form_Imp_Direcciones">
          <div class="box-body">
            
            <div class="form-group">
              <label for="DataDirecciones">Ingrese archivo .csv</label>
              <input name="DataDirecciones" id="DataDirecciones" class="form-control" type="file" size="100" />
              <div class="msg_file"></div>
             
            </div>
           
            </div><!-- /.box-body -->


        <div class="box-footer">
          <div class="col-md-6">
            <button type="submit" class="col-md-12 btn btn-default btn_submit_file" id="btn_submit_direccion" disabled="true" >Procesar Archivo</button>
          </div>
          <div class="col-md-6">
            <button type="button" class="col-md-12 btn btn-danger btn_reset_files" id="btn_reset">Cancelar</button>
          </div>
        
          
        </div>
        </form>
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->

<section class="content">
  <div class="row">    
    <div class="col-sm-12 col-md-12">
        <div class="box">
          <div class='box-header with-border'>
              <h3 class='box-title'>Importar Correos
                <a href="<?php echo RUTA_HTTP; ?>/uploads/files/templates/Plantilla_importar_correos.xlsx" class="btn btn-success btn-xs " data-toggle="tooltip" data-placement="top" title="Descargar Plantilla">
                  <i class="fa fa-file-excel-o" aria-hidden="true"></i>
                </a>
              </h3>
          </div>
          <form role="form" action="?c=Importar&a=Imp_Correo" method="post" enctype="multipart/form-data" id="Form_Imp_Correos">
          <div class="box-body">            
            <div class="form-group">
              <label for="DataCorreos">Ingrese archivo .csv</label>
              <input name="DataCorreos" id="DataCorreos" type="file" class="form-control" size="100" />
              <div class="msg_file"></div>
             
            </div>
           
            </div><!-- /.box-body -->


        <div class="box-footer">
          <div class="col-md-6">
            <button type="submit" class="col-md-12 btn btn-default btn_submit_file" id="btn_submit_correos" disabled="true" >Procesar Archivo</button>
          </div>
          <div class="col-md-6">
            <button type="button" class="col-md-12 btn btn-danger btn_reset_files" id="btn_reset">Cancelar</button>
          </div>        
      </div>
        </form>
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
<script>
  
function validar_informacion_csv(encabezado_array,archivo,file_event,idForm)
{
  $("#"+idForm+" .btn_submit_file").prop('disabled', true);
  $( "#"+idForm+" .msg_file" ).empty();  
  var ext = $("input#"+archivo+"").val().split(".").pop().toLowerCase();
  if($.inArray(ext, ["csv"]) == -1) {
     $("#"+idForm+" .msg_file").append("<div class='alert alert-danger' role='alert'>La extención del archivo tiene que ser .csv</div>");
    return false;
  }
  var nro_errores=0;
  if (file_event.files != undefined) {
    var reader = new FileReader();
    reader.onload = function(e)
    {
      var csvval=e.target.result.split("\n");
      var encabezado_csv = [];
      for(var f=0;f<1;f++)
      {  
        csvvalue=csvval[f].split(",");
        for(var c=0;c<csvvalue.length;c++)
        {
          encabezado_csv[c] = csvvalue[c];   
        }         
      }
      var array_compara = [];
      for(var c=0;c<encabezado_array.length;c++)
      {
        var v1 = String(encabezado_array[c]);
        var v2 = String(encabezado_csv[c]).trim();
        if(v1!=v2){
           
          nro_errores=1;
         
          $("#"+idForm+" .msg_file").append("<div class='alert alert-danger' role='alert'>El archivo .csv tiene que tener los siguientes encabezados :<br>"+encabezado_array+"</div>");
          return false;
        }     
      }

      if (nro_errores==0) {
        $("#"+idForm+" .btn_submit_file").prop('disabled', false);
        $("#"+idForm+" .msg_file").append("<div class='alert alert-success' role='alert'>Archivo csv correcto</div>");
          setTimeout(function() {
            $( "#"+idForm+" .msg_file" ).empty(); 
          }, 5000);
      }
    };
    
    reader.readAsText(file_event.files.item(0));
   
  }
  
  return true;
}

$(".btn_reset_files").click(function(e) {

location.reload();
});
$("#DataTelefonos").change(function(e){
    var file_event = e.target; 
    var encabezado_array=["ID","DOCUMENTO","TIPO","NUMERO","CONTACTO","ORIGEN","ANIO_ORIGEN","OBSERVACION"];
    validar_informacion_csv(encabezado_array,'DataTelefonos',file_event,"Form_Imp_Telefonos");
});
$("#DataDirecciones").change(function(e){
  var file_event = e.target; 
  var encabezado_array=["ID","DOCUMENTO","DIRECCION","DISTRITO","PROVINCIA","DEPARTAMENTO","TIPO_DIRECCION","ORIGEN"];
  validar_informacion_csv(encabezado_array,'DataDirecciones',file_event,"Form_Imp_Direcciones");

});
$("#DataCorreos").change(function(e){
  var file_event = e.target; 
  var encabezado_array=["ID","DOCUMENTO","CORREO","TIPO_CORREO","ORIGEN"];
  validar_informacion_csv(encabezado_array,'DataCorreos',file_event,"Form_Imp_Correos");

});

$("#DataDeudores").change(function(e) {
  var file_event = e.target; 
  var encabezado_array=["ID","TIPO_DOC","DOCUMENTO","RAZON_SOCIAL","RUC","APELLIDO_PATERNO","APELLIDO_MATERNO","PRIMER_NOMBRE","SEGUNDO_NOMBRE","SEXO","FECHA_NACIMIENTO","TIPO_DEUDOR","EMPRESA_TRABAJO","SUELDO","CARGO_TRABAJO","CONYUGE","FALLECIDO"];
  validar_informacion_csv(encabezado_array,'DataDeudores',file_event,"Form_Act_Deudor");
});
</script>

