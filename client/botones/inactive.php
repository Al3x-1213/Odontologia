<?php

include '../connection.php';

$id = $_GET['id'];

$consulta = "UPDATE SET id_status_usuario = 2 FROM cuentas WHERE id_datos_personales = '$id'";
$query = ($conexion->query($consulta));

if($query){
    mysqli_close($conexion);
    header("location:../../admin/registeredUser.php");
}

?>