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
                    <th>idLicencia</th>
                    <th>Perfil</th>
                    <th>Usuario</th>
                    <th>Nombres y Apellidos</th>
                    <th>Estado Usuario</th>
                    <th>Periodo</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Estado Licencia</th>
                </tr>
            </thead>

<?php 

$Reporte_Licencias=$this->Consultas("SELECT licencia.idLicencia as idLicencia,perfil.Nombre as NombrePerfil,persona.Documento as Documento,persona.Primer_Nombre as Primer_Nombre,persona.Segundo_Nombre as Segundo_Nombre,persona.Apellido_Materno as Apellido_Materno,persona.Apellido_Paterno as Apellido_Paterno,usuario.Estado as Estado_Usuario,licencia.Periodo as Periodo,licencia.Fecha_Inicio as Fecha_Inicio,licencia.Fecha_Fin as Fecha_Fin,licencia.Estado as Estado_Licencia 
FROM licencia 
INNER JOIN usuario ON usuario.idUsuario = licencia.Usuario_id
INNER JOIN perfil on perfil.idPerfil=usuario.perfil_id
INNER JOIN persona on persona.idPersona=usuario.Persona_id
where licencia.Eliminado=0 $sqlVBO_Periodo"); 
?>


            <?php foreach($Reporte_Licencias as $item): ?>
                <tr>
                    <td><?php echo $item ['idLicencia'];?></td>                    
                    <td><?php echo $item['NombrePerfil'];?></td>
                    <td><?php echo $item['Documento'];?></td>
                    <td><?php  echo $item['Primer_Nombre'].' '.$item['Segundo_Nombre'].' '.$item['Apellido_Paterno'].' '.$item['Apellido_Materno'];?></td>
                    <?php if ($item['Estado_Usuario']==1): ?>
                    <td><?php echo 'Activo'?></td>
                    <?php endif ?>
                    <?php if ($item['Estado_Usuario']==0): ?>
                    <td><?php echo 'Inactivo'?></td>
                    <?php endif ?>
                    <?php if ($item['Estado_Usuario']==2): ?>
                    <td><?php echo 'Bloqueado'?></td>
                    <?php endif ?>
                    <td><?php echo $item['Periodo']; ?></td>
                    <?php date_default_timezone_set('UTC'); ?>
                    <td><?php echo date("d-M",strtotime($item['Fecha_Inicio'])); ?></td>
                    <td><?php echo date("d-M",strtotime($item['Fecha_Fin'])); ?></td>
                    <?php if ($item['Estado_Licencia']==1): ?>
                    <td><?php echo 'Activo'?></td>
                    <?php endif ?>
                    <?php if ($item['Estado_Licencia']==0): ?>
                    <td><?php echo 'Inactivo'?></td>
                    <?php endif ?>
                </tr>
            <?php endforeach; ?>
        </table>

    </body>
</html>