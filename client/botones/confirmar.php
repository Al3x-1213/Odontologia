<?php 

$id = $_POST['id_consulta'];
$hora_inicio = $_POST['hora_inicio'];
$hora_fin = $_POST['hora_fin'];

include '../connection.php';

$update = "UPDATE consultas SET id_status_consulta = 2, hora_inicio = '$hora_inicio', hora_fin = '$hora_fin' WHERE id_consulta = '$id'";

$consulta = $conexion->query($update);

if($consulta == 1){
    header('location: ../../admin/porConfirmar.php');
}

?>