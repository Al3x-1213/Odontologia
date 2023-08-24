<?php

include 'connection.php';

/* datos del formulario de registro */

$id = $_GET['id'];

$peticion = "DELETE FROM consulta WHERE id_consulta = '$id'";
$eliminar = ($conexion->query($peticion));

session_start();
ob_start();
$sesion = $_SESSION['sesion'];

if($eliminar == 1 && $sesion == 1){
    mysqli_close($conexion);
    header("location:../admin/consultasatendidas.php");
}

?>