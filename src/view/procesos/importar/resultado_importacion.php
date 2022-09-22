<?php 
//creando el objeto


//creando el objeto

$objCampana = new ImportarController(); 
?>

<html>
    <head>
        <meta charset="utf-8" />
        <style type="text/css">
            .td_ceros{ mso-number-format:"\@";}
            
        </style>
    </head>
    <body>

        <?php if ($informacion=="TELEFONO"): ?>
            
       
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>DOCUMENTO</th>
                    <th>TIPO</th>
                    <th>NUMERO</th>
                    <th>ORIGEN</th>
                    <th>OBSERVACION</th>
                    <th>REGISTRADO</th>
                    <th>MOTIVO</th>
                    <th>HORA_PROCESO</th>
                </tr>
            </thead>

           
            <?php foreach($registros as $registro): ?>
                <tr>
                    <td> <?php echo $registro['contador']; ?> </td>
                    <td class="td_ceros"> <?php echo $registro['documento']; ?> </td>
                    <td> <?php echo $registro['tipo']; ?> </td>
                    <td class="td_ceros"> <?php echo $registro['numero']; ?> </td>
                    <td> <?php echo $registro['origen']; ?> </td>
                    <td> <?php echo $registro['observacion']; ?> </td>
                    <td> <?php  if($registro['registrado']==1){	echo "SI";}else{echo "NO";} ?></td>
                    <td> <?php echo $registro['motivo']; ?> </td>
                    <td> <?php echo $registro['hora']; ?> </td>                  
                </tr>
            <?php endforeach; ?>
        </table> 
        <?php elseif($informacion=="CORREO"): ?>
            <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>DOCUMENTO</th>
                    <th>CORREO</th>
                    <th>TIPO</th>
                    <th>ORIGEN</th>
                    <th>REGISTRADO</th>
                    <th>MOTIVO</th>
                    <th>HORA_PROCESO</th>
                </tr>
            </thead>

           
            <?php foreach($registros as $registro): ?>
                <tr>
                    <td> <?php echo $registro['contador']; ?> </td>
                    <td class="td_ceros"> <?php echo $registro['documento']; ?> </td>
                    <td > <?php echo $registro['correo']; ?> </td>
                    <td> <?php echo $registro['tipo']; ?> </td>
                    <td> <?php echo $registro['origen']; ?> </td>
                    <td> <?php  if($registro['registrado']==1){ echo "SI";}else{echo "NO";} ?></td>
                    <td> <?php echo $registro['motivo']; ?> </td>
                    <td> <?php echo $registro['hora']; ?> </td>                  
                </tr>
            <?php endforeach; ?>
        <?php elseif($informacion=="DEUDOR"): ?>
            <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>TIPO_DOC</th>
                    <th>DOCUMENTO</th>
                    <th>NOMBRE O RAZON SOCIAL</th>
                    <th>RUC</th>
                    <th>APELLIDO_PATERNO</th>
                    <th>APELLIDO_MATERNO</th>
                    <th>PRIMER_NOMBRE</th>
                    <th>SEGUNDO_NOMBRE</th>                  
                    <th>SEXO</th>
                    <th>FECHA_NACIMIENTO</th>
                    <th>TIPO_DEUDOR</th>
                    <th>EMPRESA_TRABAJO</th>
                    <th>SUELDO</th>
                    <th>CARGO_TRABAJO</th>
                    <th>CONYUGE</th>
                    <th>FALLECIDO</th>
                    <th>ACTUALIZADO</th>
                    <th>MOTIVO</th>
                    <th>HORA_PROCESO</th>
                </tr>
            </thead>           
            <?php foreach($registros as $registro): ?>
                <tr>
                    <td> <?php echo $registro['contador']; ?> </td>
                    <td> <?php echo $registro['tipo']; ?> </td>
                    <td class="td_ceros"> <?php echo $registro['documento']; ?> </td>
                    <td > <?php echo $registro['razon_social']; ?> </td>
                    <td > <?php echo $registro['ruc']; ?> </td>
                    <td > <?php echo $registro['ApellidoPaterno']; ?> </td>
                    <td > <?php echo $registro['ApellidoMaterno']; ?> </td>
                    <td > <?php echo $registro['PrimerNombre']; ?> </td>
                    <td > <?php echo $registro['SegundoNombre']; ?> </td>
                    <td> <?php echo $registro['sexo']; ?> </td>
                    <td> <?php echo $registro['fecha_nacimiento']; ?> </td>
                    <td> <?php echo $registro['tipo_deudor']; ?> </td>
                    <td> <?php echo $registro['empresa_trab']; ?> </td>
                    <td> <?php echo $registro['sueldo']; ?> </td>
                    <td> <?php echo $registro['cargo']; ?> </td>
                    <td> <?php echo $registro['conyuge']; ?> </td>
                    <td> <?php echo $registro['fallecido']; ?> </td>
                    <td> <?php  if($registro['actualizado']==1){ echo "SI";}else{echo "NO";} ?></td>
                    <td> <?php echo $registro['motivo']; ?> </td>
                    <td> <?php echo $registro['hora']; ?> </td>                  
                </tr>
            <?php endforeach; ?>
    <?php elseif($informacion=="DIRECCION"): ?>
            <table>
            <thead>               

                <tr>
                    <th>ID</th>
                    <th>DOCUMENTO</th>
                    <th>DIRECCION</th>
                    <th>DISTRITO</th>
                    <th>PROVINCIA</th>
                    <th>DEPARTAMENTO</th>
                    <th>TIPO_DIRECCION</th>
                    <th>ORIGEN</th>
                    <th>REGISTRADO</th>
                    <th>MOTIVO</th>
                    <th>HORA_PROCESO</th>
                </tr>
            </thead>

           
            <?php foreach($registros as $registro): ?>

                <tr>
                    <td> <?php echo $registro['contador']; ?> </td>
                    <td class="td_ceros"> <?php echo $registro['documento']; ?> </td>
                    <td > <?php echo $registro['direccion']; ?> </td>
                    <td > <?php echo $registro['distrito']; ?> </td>
                    <td > <?php echo $registro['provincia']; ?> </td>
                    <td > <?php echo $registro['departamento']; ?> </td>
                    <td> <?php echo $registro['tipo_direccion']; ?> </td>
                    <td> <?php echo $registro['origen']; ?> </td>
                    <td> <?php  if($registro['registrado']==1){ echo "SI";}else{echo "NO";} ?></td>
                    <td> <?php echo $registro['motivo']; ?> </td>
                    <td> <?php echo $registro['hora']; ?> </td>                  
                </tr>
            <?php endforeach; ?>
        </table> 
    <?php elseif($informacion=="OBLIGACION"): ?>
            <table>
            <thead>
            <tr>               
                <th>CONTADOR</th>
                <th>NROOPERACION</th>
                <th>OPERACION</th>
                <th>DOCUMENTO</th>
                <th>CLIENTE</th>
                <th>PRODUCTO</th>
                <th>MONEDA</th>
                <th>CAPITAL</th>
                <th>DEUDA_TOTAL</th>
                <th>DEUDA_VENCIDA</th>
                <th>MONTO_CAMPANA</th>
                <th>DESC_CAMPANA</th>
                <th>DIAS_MORA</th>
                <th>FECHA_VENCIMIENTO</th>
                <th>NRO_CUOTA</th>
                <th>PLAZO</th>
                <th>SEGMENTO</th>
                <th>FECHA_ASIGNACION</th>
                <th>ESTADO_REGISTRO</th>
                <th>DEUDOR_REGISTRADO</th>
                <th>MOTIVO_1</th>
                <th>OBLIGACION_REGISTRADA</th>
                <th>MOTIVO_2</th>
                <th>HORA_PROCESO</th>                    
            </tr>
            </thead>

           
            <?php foreach($registros as $registro): ?>

                <tr>
                    <td ><?php echo $registro['contador']; ?></td>  
                    <td class="td_ceros"><?php echo $registro['nrooperacion']; ?></td>  
                    <td class="td_ceros"><?php echo $registro['operacion']; ?></td>  
                    <td class="td_ceros"><?php echo $registro['documento']; ?></td>  
                    <td><?php echo $registro['cliente']; ?></td>  
                    <td><?php echo $registro['producto']; ?></td>  
                    <td><?php echo $registro['moneda']; ?></td>  
                    <td><?php echo $registro['capital']; ?></td>  
                    <td><?php echo $registro['deuda_total']; ?></td>  
                    <td><?php echo $registro['deuda_vencida']; ?></td>  
                    <td><?php echo $registro['monto_campania']; ?></td>  
                    <td><?php echo $registro['desc_campania']; ?></td>  
                    <td><?php echo $registro['dias_mora']; ?></td>  
                    <td><?php echo $registro['fecha_vencimiento']; ?></td>  
                    <td><?php echo $registro['nro_cuota']; ?></td>  
                    <td><?php echo $registro['plazo']; ?></td>  
                    <td><?php echo $registro['segmento']; ?></td>  
                    <td><?php echo $registro['fecha_asignacion']; ?></td>
                    <td> <?php  if(($registro['registrado_deudor']+$registro['registrado_obligacion'])>0){ echo "registrado correctamente";}else{echo "error al registrar";} ?></td> 
                    <td> <?php  if($registro['registrado_deudor']==1){ echo "SI";}else{echo "NO";} ?></td>  
                    <td><?php echo $registro['motivo_deudor']; ?></td>
                    <td> <?php  if($registro['registrado_obligacion']==1){ echo "SI";}else{echo "NO";} ?></td>  
                    <td><?php echo $registro['motivo_obligacion']; ?></td>  
                    <td><?php echo $registro['hora']; ?></td>      
                </tr>
            <?php endforeach; ?>
        </table> 
    <?php elseif($informacion=="ACT_OBLIGACION"): ?>
            <table>
            <thead>
            <tr>               
                <th>ID</th>
                <th>NROOPERACION</th>
                <th>OPERACION</th>
                <th>PRODUCTO</th>
                <th>MONEDA</th>
                <th>CAPITAL</th>
                <th>DEUDA_TOTAL</th>
                <th>DEUDA_VENCIDA</th>
                <th>MONTO_CAMPANA</th>
                <th>DESC_CAMPANA</th>
                <th>MONTO_CAMP_MIN</th>
                <th>DESC_CAMP_MIN</th>
                <th>DIAS_MORA</th>
                <th>FECHA_VENCIMIENTO</th>
                <th>NROCUOTA</th>
                <th>PLAZO</th>
                <th>ORIGEN</th>
                <th>SEGMENTO</th>
                <th>PRIORIDAD</th>
                <th>ESTRATEGIA1</th>
                <th>ESTRATEGIA2</th>
                <th>ESTRATEGIA3</th>
                <th>FECH_ASIGNACION</th>
                <th>OPERADOR_ID</th>
                <th>ACTIVO</th>
                <th>RETIRADO</th>
                <th>MONTO_ESTUDIO</th>
                <th>TIENE_PAGO</th>
                <th>FECHA_PAGO</th>
                <th>MONTO_PAGO</th>
                <th>ACTUALIZADO</th>
                <th>MOTIVO</th>
                <th>HORA_PROCESO</th>                    
            </tr>
            </thead>

           
            <?php foreach($registros as $registro): ?>

                <tr>
                        <td><?php echo $registro['contador']; ?></td> 
                        <td class="td_ceros"><?php echo $registro['nrooperacion']; ?></td> 
                        <td class="td_ceros"><?php echo $registro['operacion']; ?></td> 
                        <td><?php echo $registro['producto']; ?></td> 
                        <td><?php echo $registro['moneda']; ?></td> 
                        <td><?php echo $registro['capital']; ?></td> 
                        <td><?php echo $registro['deuda_total']; ?></td> 
                        <td><?php echo $registro['deuda_vencida']; ?></td> 
                        <td><?php echo $registro['monto_campania']; ?></td> 
                        <td><?php echo $registro['desc_campania']; ?></td>
                        <td><?php echo $registro['monto_camp_min']; ?></td>
                        <td><?php echo $registro['desc_camp_min']; ?></td>  
                        <td><?php echo $registro['dias_mora']; ?></td> 
                        <td><?php echo $registro['fecha_vencimiento']; ?></td> 
                        <td><?php echo $registro['nrocuota']; ?></td> 
                        <td><?php echo $registro['plazo']; ?></td>
                        <td><?php echo $registro['origen']; ?></td> 
                        <td><?php echo $registro['segmento']; ?></td>
                        <td><?php echo $registro['prioridad']; ?></td>
                        <td><?php echo $registro['estrategia1']; ?></td>
                        <td><?php echo $registro['estrategia2']; ?></td>
                        <td><?php echo $registro['estrategia3']; ?></td>
                        <td><?php echo $registro['fecha_asignacion']; ?></td> 
                        <td><?php echo $registro['Operador_id']; ?></td> 
                        <td><?php echo $registro['activo']; ?></td> 
                        <td><?php echo $registro['retirado']; ?></td> 
                        <td><?php echo $registro['monto_asignado']; ?></td> 
                        <td><?php echo $registro['tiene_pago']; ?></td> 
                        <td><?php echo $registro['fecha_pago']; ?></td> 
                        <td><?php echo $registro['monto_pago']; ?></td> 
                        <td> <?php  if($registro['actualizado']==1){ echo "SI";}else{echo "NO";} ?></td>  
                        <td><?php echo $registro['motivo_obligacion']; ?></td>  
                        <td><?php echo $registro['hora']; ?></td>      
                </tr>
            <?php endforeach; ?>
        </table>
         <?php elseif ($informacion=="PAGO"): ?>
            
       
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NROOPERACION</th>
                    <th>TIPO_PAGO</th>
                    <th>FECHA_PAGO</th>
                    <th>MONEDA</th>
                    <th>MONTO_PAGO</th>
                </tr>
            </thead>

           
            <?php foreach($registros as $registro): ?>
                <tr>
                    <td> <?php echo $registro['contador']; ?> </td>
                    <td class="td_ceros"> <?php echo $registro['nrooperacion']; ?> </td>
                    <td> <?php echo $registro['tipo_pago']; ?> </td>
                    <td> <?php echo $registro['fecha_pago']; ?> </td>
                    <td> <?php echo $registro['moneda']; ?> </td>
                    <td> <?php echo $registro['monto']; ?> </td>
                    <td> <?php  if($registro['registrado']==1){ echo "SI";}else{echo "NO";} ?></td>
                    <td> <?php echo $registro['motivo']; ?> </td>
                    <td> <?php echo $registro['hora']; ?> </td>                  
                </tr>
            <?php endforeach; ?>
        </table>
    <?php elseif ($informacion=="GESTIONES"): ?>          
       
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>CAMPANA</th>
                    <th>CODIGO_GESTOR</th>
                    <th>OPERADOR</th>
                    <th>DOCUMENTO</th>
                    <th>TIPO_GESTION</th>
                    <th>TELEFONO</th>
                    <th>TIPO_TEL</th>
                    <th>FECHA_GESTION</th>
                    <th>HORA_INICIO</th>
                    <th>HORA_FIN</th>
                    <th>CODIGO_RESULTADO</th>
                    <th>MOTIVO</th>
                    <th>NROOPERACION</th>
                    <th>FECHA_COMP</th>
                    <th>MONTO_COMP</th>
                    <th>MONEDA_COMP</th>
                    <th>OBSERVACIONES</th>
                    <th>REGISTRADO</th>
                    <th>MOTIVO</th>
                    <th>HORA_PROCESO</th>
                </tr>
            </thead>

           
            <?php foreach($registros as $registro): ?>
                <tr>
                    <td><?php echo $registro['id']; ?></td>
                    <td><?php echo $registro['campana']; ?></td>
                    <td><?php echo $registro['codigo_persona']; ?></td>
                    <td><?php echo $registro['operador']; ?></td>
                    <td class="td_ceros"><?php echo $registro['documento']; ?></td>
                    <td><?php echo $registro['tipo_gestion']; ?></td>
                    <td class="td_ceros"><?php echo $registro['telefono']; ?></td>
                    <td><?php echo $registro['tipo_tel']; ?></td>
                    <td><?php echo $registro['fecha_gestion']; ?></td>
                    <td><?php echo $registro['hora_inicio']; ?></td>
                    <td><?php echo $registro['hora_fin']; ?></td>
                    <td><?php echo $registro['codigo_resultado']; ?></td>
                    <td><?php echo $registro['motivo']; ?></td>
                    <td class="td_ceros"><?php echo $registro['nrooperacion']; ?></td>
                    <td><?php echo $registro['fecha_comp']; ?></td>
                    <td><?php echo $registro['monto_comp']; ?></td>
                    <td><?php echo $registro['moneda_comp']; ?></td>
                    <td><?php echo $registro['observaciones']; ?></td>                   
                    <td> <?php  if($registro['registrado']==1){ echo "SI";}else{echo "NO";} ?></td>
                    <td> <?php echo $registro['motivo']; ?> </td>
                    <td> <?php echo $registro['hora']; ?> </td>                  
                </tr>
            <?php endforeach; ?>
        </table> 
    <?php elseif ($informacion=="SOLICITUD_VISITAS"): ?>          
       
        <table>
            <thead>
                <tr>                   
                    <th>ID</th>
                    <th>DOCUMENTO</th>
                    <th>DIRECCION_ID</th>
                    <th>ID_HOJARUTA</th>
                    <th>CODIGO_GESTOR</th>
                    <th>FECHA_ENTREGA</th>
                    <th>FECHA_ENTREGA</th>
                    <th>ID_VISITA</th>
                    <th>REGISTRADO</th>
                    <th>MOTIVO</th>
                    <th>HORA_PROCESO</th>
                </tr>
            </thead>

           
            <?php foreach($registros as $registro): ?>
                <tr>                    
                    <td><?php echo $registro['id']; ?></td>
                    <td class="td_ceros"><?php echo $registro['documento']; ?></td>
                    <td><?php echo $registro['direccion_id']; ?></td>
                    <td><?php echo $registro['idhojaruta']; ?></td>
                    <td><?php echo $registro['codigo_gestor']; ?></td>
                    <td><?php echo $registro['fecha_entrega']; ?></td>
                    <td><?php echo $registro['fecha_limite']; ?></td>
                    <td><?php echo $registro['idVisita']; ?></td>                    
                    <td> <?php  if($registro['registrado']==1){ echo "SI";}else{echo "NO";} ?></td>
                    <td> <?php echo $registro['motivo']; ?> </td>
                    <td> <?php echo $registro['hora']; ?> </td>                  
                </tr>
            <?php endforeach; ?>
        </table> 
    <?php elseif ($informacion=="REGISTRAR_VISITAS"): ?>          
       
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>COD_VISITA</th>
                    <th>CODIGO_GESTOR</th>
                    <th>DOCUMENTO</th>
                    <th>TIPO_GESTION</th>
                    <th>FECHA_GESTION</th>
                    <th>HORA_GESTION</th>
                    <th>CODIGO_RESULTADO</th>
                    <th>MOTIVO</th>
                    <th>CONTACTO</th>
                    <th>NROOPERACION</th>
                    <th>FECHA_COMP</th>
                    <th>MONTO_COMP</th>
                    <th>MONEDA_COMP</th>
                    <th>DESCRIPCION</th>
                    <th>OBSERVACION</th>
                    <th>REGISTRADO</th>
                    <th>MOTIVO</th>
                    <th>HORA_PROCESO</th>
                </tr>
            </thead>

            <?php foreach($registros as $registro): ?>
                <tr>
                    <td><?php echo $registro['id']; ?></td>
                    <td><?php echo $registro['cod_visita']; ?></td>
                    <td><?php echo $registro['codigo_gestor']; ?></td>
                    <td class="td_ceros"><?php echo $registro['documento']; ?></td>
                    <td><?php echo $registro['tipo_gestion']; ?></td>
                    <td><?php echo $registro['fecha_gestion']; ?></td>
                    <td><?php echo $registro['hora_gestion']; ?></td>
                    <td><?php echo $registro['codigo_resultado']; ?></td>
                    <td><?php echo $registro['motivo']; ?></td>
                    <td><?php echo $registro['contacto']; ?></td>
                    <td class="td_ceros"><?php echo $registro['nrooperacion']; ?></td>
                    <td><?php echo $registro['fecha_comp']; ?></td> 
                    <td><?php echo $registro['monto_comp']; ?></td> 
                    <td><?php echo $registro['moneda_comp']; ?></td> 
                    <td><?php echo $registro['descripcion']; ?></td> 
                    <td><?php echo $registro['observacion']; ?></td> 

                    <td> <?php  if($registro['registrado']==1){ echo "SI";}else{echo "NO";} ?></td>
                    <td> <?php echo $registro['motivo']; ?> </td>
                    <td> <?php echo $registro['hora']; ?> </td>                  
                </tr>
            <?php endforeach; ?>
        </table> 
    <?php elseif ($informacion=="GESTIONES_SMS"): ?>          
       
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>DOCUMENTO</th>
                    <th>NUMERO</th>
                    <th>FECHA_GESTION</th>
                    <th>HORA_ENVIO</th>
                    <th>RESULTADO</th>                  
                    <th>REGISTRADO</th>
                    <th>MOTIVO</th>
                    <th>HORA_PROCESO</th>
                </tr>
            </thead>

            <?php foreach($registros as $registro): ?>
                <tr>
                    <td><?php echo $registro['id']; ?></td>
                    <td class="td_ceros"><?php echo $registro['documento']; ?></td>
                   <td class="td_ceros"><?php echo $registro['numero']; ?></td>
                    <td><?php echo $registro['fecha_gestion']; ?></td>
                    <td><?php echo $registro['hora_envio']; ?></td>
                    <td><?php echo $registro['resultado']; ?></td>
                    <td> <?php  if($registro['registrado']==1){ echo "SI";}else{echo "NO";} ?></td>
                    <td> <?php echo $registro['motivo_registro']; ?> </td>
                    <td> <?php echo $registro['hora']; ?> </td>                  
                </tr>
            <?php endforeach; ?>
        </table>
    <?php elseif ($informacion=="GESTIONES_IVR"): ?>          
       
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>DOCUMENTO</th>
                    <th>NUMERO</th>
                    <th>FECHA_GESTION</th>
                    <th>HORA_ENVIO</th>
                    <th>RESULTADO</th>                  
                    <th>REGISTRADO</th>
                    <th>MOTIVO</th>
                    <th>HORA_PROCESO</th>
                </tr>
            </thead>

            <?php foreach($registros as $registro): ?>
                <tr>
                    <td><?php echo $registro['id']; ?></td>
                    <td class="td_ceros"><?php echo $registro['documento']; ?></td>
                   <td class="td_ceros"><?php echo $registro['numero']; ?></td>
                    <td><?php echo $registro['fecha_gestion']; ?></td>
                    <td><?php echo $registro['hora_envio']; ?></td>
                    <td><?php echo $registro['resultado']; ?></td>
                    <td> <?php  if($registro['registrado']==1){ echo "SI";}else{echo "NO";} ?></td>
                    <td> <?php echo $registro['motivo_registro']; ?> </td>
                    <td> <?php echo $registro['hora']; ?> </td>                  
                </tr>
            <?php endforeach; ?>
        </table>
    <?php elseif ($informacion=="GESTIONES_CORREO"): ?>          
       
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>DOCUMENTO</th>
                    <th>CORREO</th>
                    <th>FECHA_GESTION</th>
                    <th>HORA_ENVIO</th>
                    <th>RESULTADO</th>
                    <th>OBSERVACION</th>                
                    <th>REGISTRADO</th>
                    <th>MOTIVO</th>
                    <th>HORA_PROCESO</th>
                </tr>
            </thead>

            <?php foreach($registros as $registro): ?>
                <tr>
                    <td><?php echo $registro['id']; ?></td>
                    <td class="td_ceros"><?php echo $registro['documento']; ?></td>
                   <td class="td_ceros"><?php echo $registro['correo']; ?></td>
                    <td><?php echo $registro['fecha_gestion']; ?></td>
                    <td><?php echo $registro['hora_envio']; ?></td>
                    <td><?php echo $registro['resultado']; ?></td>
                    <td><?php echo $registro['observaciones']; ?></td>
                    <td> <?php  if($registro['registrado']==1){ echo "SI";}else{echo "NO";} ?></td>
                    <td> <?php echo $registro['motivo_registro']; ?> </td>
                    <td> <?php echo $registro['hora']; ?> </td>                  
                </tr>
            <?php endforeach; ?>
        </table>
    <?php elseif ($informacion=="OBLIGACION_CARTERA"): ?>          
       
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NROOPERACION</th>
                    <th>NROCUENTA</th>
                    <th>TIPO_DOC</th>
                    <th>DOCUMENTO</th>
                    <th>NOMBRES</th>
                    <th>MONEDA</th>                
                    <th>CAPITAL_INICIAL</th>
                    <th>DEUDA_TOTAL_INICIAL</th>
                    <th>FECHA_ASIGNACION</th>
                    <th>ESTADO_REGISTRO</th>
                    <th>DEUDOR_REGISTRADO</th>
                    <th>MOTIVO_1</th>
                    <th>OBLIGACION_REGISTRADA</th>
                    <th>MOTIVO_2</th>
                    <th>HORA_PROCESO</th>
                </tr>
            </thead>

            <?php foreach($registros as $registro): ?>
                <tr>
                    <td><?php echo $registro['contador']; ?></td>
                    <td class="td_ceros"><?php echo $registro['nrooperacion']; ?></td>
                   <td class="td_ceros"><?php echo $registro['nrocuenta']; ?></td>
                   <td><?php echo $registro['tipo_doc']; ?></td>
                   <td class="td_ceros"><?php echo $registro['documento']; ?></td>
                    <td><?php echo $registro['cliente']; ?></td>
                    <td><?php echo $registro['moneda']; ?></td>
                    <td><?php echo $registro['capital_inicial']; ?></td>
                    <td><?php echo $registro['deuda_total_inicial']; ?></td>
                    <td><?php echo $registro['fecha_asignacion']; ?></td>
                    <td> <?php  if(($registro['registrado_deudor']+$registro['registrado_obligacion'])>0){ echo "registrado correctamente";}else{echo "error al registrar";} ?></td> 
                    <td> <?php  if($registro['registrado_deudor']==1){ echo "SI";}else{echo "NO";} ?></td>  
                    <td><?php echo $registro['motivo_deudor']; ?></td>
                    <td> <?php  if($registro['registrado_obligacion']==1){ echo "SI";}else{echo "NO";} ?></td>  
                    <td><?php echo $registro['motivo_obligacion']; ?></td>  
                    <td><?php echo $registro['hora']; ?></td>                  
                </tr>
            <?php endforeach; ?>
        </table>
    <?php elseif ($informacion=="ACT_OBLIGACION_CARTERA"): ?>          
       
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NROOPERACION</th>
                    <th>NROCUENTA</th>
                    <th>MONEDA</th>
                    <th>CAPITAL_INICIAL</th>
                    <th>DEUDATOTAL_INICIAL</th>
                    <th>TOTAL_INTERESES</th>
                    <th>TASA_INTERES</th>
                    <th>TOTAL_PAGOS</th>
                    <th>CAPITAL_ACTUAL</th>
                    <th>DEUDATOTAL_ACTUAL</th>
                    <th>PRODUCTO</th>
                    <th>CAT_PRODUCTO</th>
                    <th>FECHVENC</th>
                    <th>FECHCAST</th>
                    <th>SITUACION</th>
                    <th>SEGURO</th>
                    <th>ULTFECHPAGO</th>
                    <th>MONTULTPAGO</th>
                    <th>PLAZO</th>
                    <th>NROCUOTAS</th>
                    <th>CUOTASPAG</th>
                    <th>CUOTASVENC</th>
                    <th>AGENCIA</th>
                    <th>FECHCOMP</th>
                    <th>COSECHA</th>
                    <th>ENTIDAD</th>
                    <th>PORTAFOLIO</th>
                    <th>DOCAVAL</th>
                    <th>NOMAVAL</th>
                    <th>DOCCONYUGE</th>
                    <th>NOMCONYUGE</th>
                    <th>FECHASIG</th>
                    <th>IDDIR_LEGAL</th>
                    <th>MEJORGEST_CALL</th>
                    <th>ULTGEST_CALL</th>
                    <th>MEJORGEST_CAMPO</th>
                    <th>ULTGEST_CAMPO</th>
                    <th>MEJORGEST_COURIER</th>
                    <th>NROGEST_CALL</th>
                    <th>NROGESTCALL_CD</th>
                    <th>NROGESTCALL_CI</th>
                    <th>NROGESTCALL_CNE</th>
                    <th>NROGEST_CAMPO</th>
                    <th>NROGEST_COURIER</th>
                    <th>NROGEST_SMS</th>
                    <th>NROGEST_EMAIL</th>
                    <th>ESTADO_TEL</th>
                    <th>NROTEL</th>
                    <th>NROTEL_ACTIVO</th>
                    <th>NROTEL_INACTIVO</th>
                    <th>ACTIVO</th>
                    <th>MOTIVO_RETIRO</th>
                    <th>OBSERVACION_RETIRO</th>
                    <th>ELIMINADO</th>
                    <th>ACTUALIZADO</th>
                    <th>MOTIVO</th>
                    <th>HORA_PROCESO</th>

                </tr>
            </thead>

            <?php foreach($registros as $registro): ?>
                <tr>
                    <td><?php echo $registro['contador']; ?></td>
                    <td class="td_ceros"><?php echo $registro['NroOperacion']; ?></td>
                    <td class="td_ceros"><?php echo $registro['NroCuenta']; ?></td>
                    <td><?php echo $registro['Moneda']; ?></td>
                    <td><?php echo $registro['Capital_Inicial']; ?></td>
                    <td><?php echo $registro['DeudaTotal_Inicial']; ?></td>
                    <td><?php echo $registro['Total_Intereses']; ?></td>
                    <td><?php echo $registro['Tasa_Interes']; ?></td>
                    <td><?php echo $registro['Total_Pagos']; ?></td>
                    <td><?php echo $registro['Capital_Actual']; ?></td>
                    <td><?php echo $registro['DeudaTotal_Actual']; ?></td>
                    <td><?php echo $registro['Producto']; ?></td>
                    <td><?php echo $registro['Cat_Producto']; ?></td>
                    <td><?php echo $registro['FechVenc']; ?></td>
                    <td><?php echo $registro['FechCast']; ?></td>
                    <td><?php echo $registro['Situacion']; ?></td>
                    <td><?php echo $registro['Seguro']; ?></td>
                    <td><?php echo $registro['UltFechPago']; ?></td>
                    <td><?php echo $registro['MontUltPago']; ?></td>
                    <td><?php echo $registro['Plazo']; ?></td>
                    <td><?php echo $registro['NroCuotas']; ?></td>
                    <td><?php echo $registro['CuotasPag']; ?></td>
                    <td><?php echo $registro['CuotasVenc']; ?></td>
                    <td><?php echo $registro['Agencia']; ?></td>
                    <td><?php echo $registro['FechComp']; ?></td>
                    <td><?php echo $registro['Cosecha']; ?></td>
                    <td><?php echo $registro['Entidad']; ?></td>
                    <td><?php echo $registro['Portafolio']; ?></td>
                    <td class="td_ceros"><?php echo $registro['DocAval']; ?></td>
                    <td><?php echo $registro['NomAval']; ?></td>
                    <td class="td_ceros"><?php echo $registro['DocConyuge']; ?></td>
                    <td><?php echo $registro['NomConyuge']; ?></td>
                    <td><?php echo $registro['FechAsig']; ?></td>
                    <td><?php echo $registro['idDir_Legal']; ?></td>
                    <td><?php echo $registro['MejorGest_Call']; ?></td>
                    <td><?php echo $registro['UltGest_Call']; ?></td>
                    <td><?php echo $registro['MejorGest_Campo']; ?></td>
                    <td><?php echo $registro['UltGest_Campo']; ?></td>
                    <td><?php echo $registro['MejorGest_Courier']; ?></td>
                    <td><?php echo $registro['NroGest_Call']; ?></td>
                    <td><?php echo $registro['NroGestCall_CD']; ?></td>
                    <td><?php echo $registro['NroGestCall_CI']; ?></td>
                    <td><?php echo $registro['NroGestCall_CNE']; ?></td>
                    <td><?php echo $registro['NroGest_Campo']; ?></td>
                    <td><?php echo $registro['NroGest_Courier']; ?></td>
                    <td><?php echo $registro['NroGest_Sms']; ?></td>
                    <td><?php echo $registro['NroGest_Email']; ?></td>
                    <td><?php echo $registro['Estado_Tel']; ?></td>
                    <td><?php echo $registro['NroTel']; ?></td>
                    <td><?php echo $registro['NroTel_Activo']; ?></td>
                    <td><?php echo $registro['NroTel_Inactivo']; ?></td>
                    <td><?php echo $registro['Activo']; ?></td>
                    <td><?php echo $registro['Motivo_Retiro']; ?></td>
                    <td><?php echo $registro['Observacion_Retiro']; ?></td>
                    <td><?php echo $registro['Eliminado']; ?></td>
                    <td> <?php  if($registro['actualizado']==1){ echo "SI";}else{echo "NO";} ?></td>  
                    <td><?php echo $registro['motivo_obligacion']; ?></td>  
                    <td><?php echo $registro['hora']; ?></td>                  
                </tr>
            <?php endforeach; ?>
        </table> 
        <?php endif ?>
    </body>
</html>