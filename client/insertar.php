<?php

include 'conexion.php';

/* datos del formulario de registro */

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$cedula = $_POST['cedula'];
$edad = $_POST['edad'];
$correo = $_POST['correo'];
$numero = $_POST['numero'];
$clave = $_POST['password'];

$clave = md5($contra);

$peticion = "INSERT INTO paciente1 (id_paciente, nombre, apellido, cedula, edad, correo, numero, clave, fecha) VALUE (NULL, '$nombre', '$apellido', '$cedula', '$edad', '$correo', '$numero', '$clave', now())";

$insertar = ($conexion->query($peticion));

session_start();
ob_start();
$sesion = $_SESSION['sesion'];
$admin = $_SESSION['admin'];

if($insertar == 1 && $sesion == 1 && $admin == 1){
    mysqli_close($conexion);
    header('location: ../admin/pacientes.php');
}else if($insertar == 1 && $sesion != 1 || $admin != 1){
    mysqli_close($conexion);
    header('location: ../index.php');
}

?>