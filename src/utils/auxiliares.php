<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/model/conexion.php');

$bd = new Conexion();

print_r($_POST['id_moduloprincipal']);
print_r("separador");
print_r($_POST['id_modulosecundario']);
if(isset($_POST['id_moduloprincipal']) && isset($_POST['id_modulosecundario']))
{
    print_r('2 parametros');
    $id_moduloprincipal = $_POST['id_moduloprincipal'];
    $id_modulosecundario = $_POST['id_modulosecundario']; 
    $stmt = $bd->prepare("SELECT * FROM interfaz WHERE Nivel = 3 AND Modulo_Principal = :Modulo_Principal AND IdInterfaz_superior = :Modulo_Secundario;");
    $stmt->bindParam(':Modulo_Principal', $id_moduloprincipal);
    $stmt->bindParam(':Modulo_Secundario', $id_modulosecundario);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    print_r($rows);
    $html="";
	foreach ($rows as $value)
		$html.="<option value='".$value['idInterfaz']."'>".$value['Nombre']."</option>";
	echo $html;
}else
{   
    print_r('1 parametro');
    $id_moduloprincipal = $_POST['id_moduloprincipal'];
    $stmt = $bd->prepare("SELECT * FROM interfaz WHERE Modulo_Principal = :Modulo_Principal AND IdInterfaz_superior = :Modulo_Principal");
    $stmt->bindParam(':Modulo_Principal', $id_moduloprincipal);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $html="";
	foreach ($rows as $value)
		$html.="<option value='".$value['idInterfaz']."'>".$value['Nombre']."</option>";
	echo $html;
   
}
?>
