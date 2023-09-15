<?php

// VARIABLE GLOBAL: ID DEL USUARIO LOGUEADO
$idUsuario= $_SESSION['id'];

// OBTENER EL ID_DOCTOR según el ID_USUARIO
include 'connection.php'; // Conexión con base de datos

$consulta = "SELECT id_doctor FROM doctores WHERE id_usuario = '$idUsuario'";
$query = mysqli_query($conexion, $consulta);

$respuesta = mysqli_fetch_array($query);
$idDoctor = $respuesta['id_doctor'];

?>