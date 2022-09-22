<html>
    <head>
        <meta charset="utf-8" />
        <style type="text/css">
            .td_ceros{ mso-number-format:"\@";}
            
        </style>
    </head>
    <body>
        <table>
            <thead>
                <tr style="background:#eee;">
                    <th>IdGestion</th>
                    <th>Cartera</th>
                    <th>Campana</th>
                    <th>Operado</th>
                    <th>CodGestor</th>
                    <th>Gestor</th>
                    <th>Documento</th>
                    <th>Deudor</th>
                    <th>Tipo_Gestion</th>
                    <th>IdTelefono</th>
                    <th>Estado_Telefono</th>                    
                    <th>Telefono</th>
                    <th>Correo</th>
                    <th>IdDireccion</th>
                    <th>Direccion</th>
                    <th>Distrito</th>
                    <th>Provincia</th>
                    <th>Departamento</th>
                    <th>Fecha_Gestion</th>
                    <th>Hora_Inicio</th>
                    <th>Hora_Fin</th>
                    <th>Contacto</th> 
                    <th>Observaciones</th>
                    <th>Codigo_Resultado</th>
                    <th>Detalle_Resultado</th>
                    <th>Estado_Contactabilidad</th>
                    <th>Tipo_Contacto</th>
                    <th>Motivo</th>
                </tr>
            </thead>

<?php 


$gestiones=$this->Consultas("SELECT idGestion,campana.idCampana,cartera.nombre as Cartera,campana.nombre as Campana,operador.nombre as Operador,
CONCAT(primer_nombre,' ',segundo_nombre,' ',apellido_paterno,' ',apellido_materno) as Persona,persona.codigo as CodPersona,deudor.idDeudor,deudor.Documento,deudor.razon_social,
tipogestion.descripcion as TipoGestion,
telefono.idTelefono,telefono.numero,telefono.activo,direccion.idDireccion,direccion.direccion,direccion.distrito,direccion.provincia,direccion.departamento,correo.direccion_correo,
gestion.fecha_gestion,gestion.hora_inicio,gestion.hora_fin,gestion.observaciones,contacto.descripcion as contacto,
resultado.idResultado,resultado.codigo as codigo_resultado,resultado.desc_abreviado as detalle_resultado,resultado.ranking ,contactabilidad.descripcion as Estado_contabilidad,motivo.descripcion as motivo_gest,contactabilidad.tipo_contacto  FROM gestion
inner join campana on campana.idCampana=gestion.Campana_id
inner join cartera on cartera.idCartera=campana.Cartera_id
inner join deudor on deudor.idDeudor=gestion.Deudor_id
inner join tipogestion on tipogestion.idtipogestion=gestion.tipogestion_id
left join contacto on contacto.idContacto=gestion.Contacto_id
left join telefono on telefono.idTelefono=gestion.Telefono_id
left join direccion on direccion.idDireccion=gestion.Direccion_id
left join correo on correo.idCorreo=gestion.Correo_id
inner join resultado on resultado.idResultado=gestion.Resultado_id
inner join contactabilidad on contactabilidad.idContactabilidad=resultado.Contactabilidad_id
LEFT JOIN persona ON persona.idPersona=gestion.gestor_id
LEFT JOIN operador ON operador.idOperador=gestion.Operador_id
LEFT JOIN motivo ON idMotivo=gestion.motivo_id
 where gestion.eliminado=0 $sqlCarteras $sqlCanales and gestion.fecha_gestion>='".$FechInic."' and gestion.fecha_gestion<='".$FechFin."' order by gestion.fecha_gestion,gestion.hora_inicio
"); 


?>


            <?php foreach($gestiones as $gestion): ?>
                <tr>
                    <td><?php echo $gestion['idGestion']; ?></td>
                     <td><?php echo $gestion['Cartera']; ?></td>
                    <td class="td_ceros"><?php echo $gestion['Campana']; ?></td>                    
                    <td><?php echo $gestion['Operador']; ?></td>
                     <td><?php echo $gestion['Persona']; ?></td>
                    <td><?php echo $gestion['CodPersona']; ?></td>
                    <td class="td_ceros"><?php echo $gestion['Documento']; ?></td>
                    <td><?php echo $gestion['razon_social']; ?></td>
                    <td><?php echo $gestion['TipoGestion']; ?></td>
                    <td><?php echo $gestion['idTelefono']; ?></td>
                    <td><?php echo $gestion['activo']; ?></td>
                    <td class="td_ceros"><?php echo $gestion['numero']; ?></td>
                    <td><?php echo $gestion['direccion_correo']; ?></td>
                    <td><?php echo $gestion['idDireccion']; ?></td>
                    <td><?php echo $gestion['direccion']; ?></td>
                    <td><?php echo $gestion['distrito']; ?></td>
                    <td><?php echo $gestion['provincia']; ?></td>
                    <td><?php echo $gestion['departamento']; ?></td>
                    <td><?php echo $gestion['fecha_gestion']; ?></td>
                    <td><?php echo $gestion['hora_inicio']; ?></td>
                    <td><?php echo $gestion['hora_fin']; ?></td>
                    <td><?php echo $gestion['contacto']; ?></td>
                    <td><?php echo $gestion['observaciones']; ?></td>
                    <td><?php echo $gestion['codigo_resultado']; ?></td>
                    <td><?php echo $gestion['detalle_resultado']; ?></td>
                    <td><?php echo $gestion['Estado_contabilidad']; ?></td>
                    <td><?php echo $gestion['tipo_contacto']; ?></td>
                    <td><?php echo $gestion['motivo_gest']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

    </body>
</html>