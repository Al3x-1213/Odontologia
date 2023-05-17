<?php

include 'conexion.php';

/* datos del formulario de registro */

$id = $_GET['id'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$cedula = $_POST['cedula'];
$edad = $_POST['edad'];
$correo = $_POST['correo'];
$numero = $_POST['numero'];
$clave = $_POST['clave'];

$select = "SELECT clave FROM paciente1 WHERE id_paciente = '$id'";
$consulta = $conexion->query($select);
$respuesta = mysqli_fetch_array($consulta);

if($respuesta['clave'] != $clave){
    $clave = md5($clave);
}

$peticion = "UPDATE paciente1 SET  nombre = '$nombre', apellido = '$apellido', cedula = '$cedula', edad = '$edad', correo = '$correo', numero = '$numero', clave = '$clave' WHERE id_paciente = '$id'";

$insertar = ($conexion->query($peticion));

session_start();
ob_start();
$sesion = $_SESSION['sesion'];

if($insertar == 1 && $sesion == 1){
    mysqli_close($conexion);
    header("location:../admin/pacientes.php");
}

?>