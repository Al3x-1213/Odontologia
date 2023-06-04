<?php 

include '../verificacion_sesion.php';

include '../conexion.php';

$id = $_GET['id'];

$consulta = "UPDATE consultas SET id_status_consulta = 3 WHERE id_consulta = '$id'";
$update = $conexion->query($consulta);

if($update == 1){
    header("location:../../admin/");
}

?>