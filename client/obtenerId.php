<?php

// VARIABLE GLOBAL: ID DEL USUARIO LOGUEADO
$id= $_SESSION['id'];

// OBTENER EL ID_DOCTOR según el ID_USUARIO
include '../client/conexion.php'; //Conexión con base de datos

$consulta = "SELECT id_doctor FROM doctores WHERE id_usuario = '$id'";
$query = mysqli_query($conexion, $consulta);

$respuesta = mysqli_fetch_array($query);
$id_doctor = $respuesta['id_doctor'];

?>