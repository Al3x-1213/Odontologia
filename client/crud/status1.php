<?php

$id = $_GET['id'];

include '../conexion.php';

$update = "UPDATE consulta SET fecha_atencion = now(), status = 1 WHERE id_consulta = '$id'";

$consulta = $conexion->query($update);

if($consulta == 1){
    mysqli_close($conexion);
    header("location: ../../admin/index.php");
}

?>