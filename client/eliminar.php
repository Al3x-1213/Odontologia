<?php

include 'conexion.php';

/* datos del formulario de registro */

$id = $_GET['id'];

$peticion = "DELETE FROM paciente1 WHERE id_paciente = '$id'";
$eliminar = ($conexion->query($peticion));

session_start();
ob_start();
$sesion = $_SESSION['sesion'];

if($eliminar == 1 && $sesion == 1){
    mysqli_close($conexion);
    header("location:../admin/pacientes.php");
}

?>