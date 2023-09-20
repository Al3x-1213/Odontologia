<?php

session_start();
ob_start();
$sesion = $_SESSION['sesion'];

// POR CORREGIR

include 'connection.php';

/* datos del formulario de registro */

$id = $_GET['id'];

$peticion = "UPDATE SET id_status_usuario = 2 FROM cuentas WHERE id_datos_personales = '$id'";
$eliminar = ($conexion->query($peticion));

if($eliminar == 1){
    mysqli_close($conexion);
    header("location:../admin/registeredUser.php");
}

?>