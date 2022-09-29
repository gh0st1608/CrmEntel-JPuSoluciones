<?php

include_once 'conexion.php';

private $bd;


$documento = $_POST['Documento'];
$tipo_documento = $_POST['Tipo_Documento'];

$this->bd = new Conexion();
$stmt = $this->bd->prepare("SELECT * FROM persona WHERE Documento = :Documento; AND Tipo_Documento=:Tipo_Documento");
$stmt->bindParam(':Documento', $documento);
$stmt->bindParam(':Tipo_Documento', $tipo_documento);


if(!$stmt->execute()){
    return 0

}else{
    return 1
}





?>