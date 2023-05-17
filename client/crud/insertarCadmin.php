<?php 

$nombre_paciente = $_POST['nombre'];
$apellido_paciente = $_POST['apellido'];
$numero = $_POST['numero'];
$cedula = $_POST['cedula'];
$causa = $_POST['causa'];
$dia = $_POST['dia'];
$nombre_doctor = $_POST['nombre_doctor'];

include '../conexion.php';

$insertar = "INSERT INTO consulta (id_consulta, nombre, apellido, numero, cedula, causa, dia, fecha_solicitud, fecha_atencion, nombre_doctora, status) VALUES (NULL, '$nombre_paciente', '$apellido_paciente', '$numero', '$cedula', '$causa', '$dia', now(), NULL, '$nombre_doctor', 0)";

$consulta = $conexion->query($insertar);

session_start();
ob_start();
$admin = $_SESSION['admin'];

if($consulta == 1 && $admin == 1){
    mysqli_close($conexion);
    header('location:../../admin/index.php');
}else if($consulta == 1 && $admin != 1){
    mysqli_close($conexion);
    header('location:../../paciente/index.php');
}

?>