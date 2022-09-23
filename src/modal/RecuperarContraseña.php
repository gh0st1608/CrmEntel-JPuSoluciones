<?php
require_once 'model/conexion.model.php';

//Traer contenido de la base de datos
$stm = $this->pdo->prepare("SELECT * FROM Usuario");
$stm->execute();
$registro = $stm->fetchAll();  

if($registro->num_rows > 0)
{
    echo '<p>'.$registro['idUsuario'].'</p>';
}
else
{
    echo 'No hay correo...';
}

?>