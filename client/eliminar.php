<?php

session_start();
ob_start();
$sesion = $_SESSION['sesion'];

// POR CORREGIR

include 'connection.php';

/* datos del formulario de registro */

$id = $_GET['id'];

$peticion = "DELETE FROM usuarios WHERE id_usuario = '$id'";
$eliminar = ($conexion->query($peticion));

if($eliminar == 1){
    mysqli_close($conexion);
    header("location:../admin/registeredUser.php");
}

?>