
<!-- Content Header (Page header) -->
<section class="content-header">  
  <h1>
    Procesos <small>Importar Gestiones</small>
  </h1>
  <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Importar Gestiones</li>
          </ol>
</section>
<section class="content">
  <!-- Info boxes -->

  <div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="box">
          <div class='box-header with-border'>
              <h3 class='box-title'>Importar Gestión Telefonica
                <a href="<?php echo RUTA_HTTP; ?>/uploads/files/templates/Plantilla_importar_gestiones_call.xlsx" class="btn btn-success btn-xs " data-toggle="tooltip" data-placement="top" title="Descargar Plantilla">
                  <i class="fa fa-file-excel-o" aria-hidden="true"></i>
                </a>
              </h3>
          </div>
          <form role="form" action="?c=Importar&a=Imp_Gest_Call" method="post" enctype="multipart/form-data" id="Form_Imp_GestionCall">
            <div class="box-body">              
              <div class="form-group">
                <label for="DataGestionesCall">Ingrese archivo .csv</label>
                <input name="DataGestionesCall" id="DataGestionesCall" class="form-control" type="file" size="35" />
                <div class="msg_file" style="    margin-top: 1em;"></div>           
              </div>
            </div><!-- /.box-body -->
            <div class="box-footer">
              <div class="col-md-6">
                <button type="submit" class="col-md-12 btn btn-default btn_submit_file" id="btn_submit_gestiones"  disabled="true">Procesar</button>
              </div>
              <div class="col-md-6">
                <button type="button" class="col-md-12 btn btn-danger btn_reset_files" id="btn_reset">Cancelar</button>
              </div>
              
              
            </div>
          </form>
        </div><!-- /.box -->
      </div><!-- /.col -->
   </div><!-- /.row -->
   <div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="box">
          <div class='box-header with-border'>
              <h3 class='box-title'>Importar Gestión Campo
                <a href="<?php echo RUTA_HTTP; ?>/uploads/files/templates/Plantilla_importar_gestiones_call.xlsx" class="btn btn-success btn-xs " data-toggle="tooltip" data-placement="top" title="Descargar Plantilla">
                  <i class="fa fa-file-excel-o" aria-hidden="true"></i>
                </a>
              </h3>
          </div>
          <form role="form" action="?c=Importar&a=Imp_Gest_Campo" method="post" enctype="multipart/form-data" id="Form_Imp_GestionCampo">
            <div class="box-body">              
              <div class="form-group">
                <label for="DataGestionesCall">Ingrese archivo .csv</label>
                <input name="DataGestionesCampo" id="DataGestionesCampo" class="form-control" type="file" size="35" />
                <div class="msg_file" style="    margin-top: 1em;"></div>           
              </div>
            </div><!-- /.box-body -->
            <div class="box-footer">
              <div class="col-md-6">
                <button type="submit" class="col-md-12 btn btn-default btn_submit_file" id="btn_submit_gestiones"  disabled="true">Procesar</button>
              </div>
              <div class="col-md-6">
                <button type="button" class="col-md-12 btn btn-danger btn_reset_files" id="btn_reset">Cancelar</button>
              </div>
              
              
            </div>
          </form>
        </div><!-- /.box -->
      </div><!-- /.col -->
   </div><!-- /.row -->
   <div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="box">
          <div class='box-header with-border'>
              <h3 class='box-title'>Importar Gestión Courier
                <a href="<?php echo RUTA_HTTP; ?>/uploads/files/templates/Plantilla_importar_gestiones_call.xlsx" class="btn btn-success btn-xs " data-toggle="tooltip" data-placement="top" title="Descargar Plantilla">
                  <i class="fa fa-file-excel-o" aria-hidden="true"></i>
                </a>
              </h3>
          </div>
          <form role="form" action="?c=Importar&a=Imp_Gest_Call" method="post" enctype="multipart/form-data" id="Form_Imp_GestionCourier">
            <div class="box-body">              
              <div class="form-group">
                <label for="DataGestionesCall">Ingrese archivo .csv</label>
                <input name="DataGestionesCall" id="DataGestionesCall" class="form-control" type="file" size="35" />
                <div class="msg_file" style="    margin-top: 1em;"></div>           
              </div>
            </div><!-- /.box-body -->
            <div class="box-footer">
              <div class="col-md-6">
                <button type="submit" class="col-md-12 btn btn-default btn_submit_file" id="btn_submit_gestiones"  disabled="true">Procesar</button>
              </div>
              <div class="col-md-6">
                <button type="button" class="col-md-12 btn btn-danger btn_reset_files" id="btn_reset">Cancelar</button>
              </div>
              
              
            </div>
          </form>
        </div><!-- /.box -->
      </div><!-- /.col -->
   </div><!-- /.row -->
   <div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="box">
          <div class='box-header with-border'>
              <h3 class='box-title'>Importar Gestión SMS
                <a href="<?php echo RUTA_HTTP; ?>/uploads/files/templates/Plantilla_importar_gestiones_call.xlsx" class="btn btn-success btn-xs " data-toggle="tooltip" data-placement="top" title="Descargar Plantilla">
                  <i class="fa fa-file-excel-o" aria-hidden="true"></i>
                </a>
              </h3>
          </div>
          <form role="form" action="?c=Importar&a=Imp_Gest_Call" method="post" enctype="multipart/form-data" id="Form_Imp_GestionSMS">
            <div class="box-body">              
              <div class="form-group">
                <label for="DataGestionesCall">Ingrese archivo .csv</label>
                <input name="DataGestionesCall" id="DataGestionesCall" class="form-control" type="file" size="35" />
                <div class="msg_file" style="    margin-top: 1em;"></div>           
              </div>
            </div><!-- /.box-body -->
            <div class="box-footer">
              <div class="col-md-6">
                <button type="submit" class="col-md-12 btn btn-default btn_submit_file" id="btn_submit_gestiones"  disabled="true">Procesar</button>
              </div>
              <div class="col-md-6">
                <button type="button" class="col-md-12 btn btn-danger btn_reset_files" id="btn_reset">Cancelar</button>
              </div>
              
              
            </div>
          </form>
        </div><!-- /.box -->
      </div><!-- /.col -->
   </div><!-- /.row -->
   <div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="box">
          <div class='box-header with-border'>
              <h3 class='box-title'>Importar Gestión E-MAIL
                <a href="<?php echo RUTA_HTTP; ?>/uploads/files/templates/Plantilla_importar_gestiones_call.xlsx" class="btn btn-success btn-xs " data-toggle="tooltip" data-placement="top" title="Descargar Plantilla">
                  <i class="fa fa-file-excel-o" aria-hidden="true"></i>
                </a>
              </h3>
          </div>
          <form role="form" action="?c=Importar&a=Imp_Gest_Call" method="post" enctype="multipart/form-data" id="Form_Imp_GestionEmail">
            <div class="box-body">              
              <div class="form-group">
                <label for="DataGestionesCall">Ingrese archivo .csv</label>
                <input name="DataGestionesCall" id="DataGestionesCall" class="form-control" type="file" size="35" />
                <div class="msg_file" style="    margin-top: 1em;"></div>           
              </div>
            </div><!-- /.box-body -->
            <div class="box-footer">
              <div class="col-md-6">
                <button type="submit" class="col-md-12 btn btn-default btn_submit_file" id="btn_submit_gestiones"  disabled="true">Procesar</button>
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

$("#DataGestionesCall").change(function(e) {
  var file_event = e.target; 
  var encabezado_array=["ID", "CAMPANA",  "CODIGO_GESTOR",  "OPERADOR", "DOCUMENTO",  "TIPO_GESTION", "TELEFONO", "TIPO_TEL", "FECHA_GESTION",  "HORA_INICIO",  "HORA_FIN", "CODIGO_RESULTADO", "CONTACTO", "MOTIVO", "NROOPERACION", "FECHA_COMP", "MONTO_COMP", "MONEDA_COMP",  "OBSERVACION"];
  validar_informacion_csv(encabezado_array,'DataGestionesCall',file_event,"Form_Imp_GestionCall");
});
</script>

