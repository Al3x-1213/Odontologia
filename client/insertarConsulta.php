<?php

session_start();
ob_start();
$sesion = $_SESSION['sesion'];
$tipo_usuario = $_SESSION['tipo_usuario'];

include 'conexion.php';

/* datos del formulario de registro */

$nombre = $_POST['nombre_promocion'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];

$peticion = "INSERT INTO promociones (id, nombre_promo, descripcion, precio) VALUE (NULL, '$nombre', '$descripcion', '$precio')";

$insertar = ($conexion->query($peticion));

if($insertar == 1){
    mysqli_close($conexion);
    header ("location:../admin/index.php");
}

?>