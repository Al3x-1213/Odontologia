<?php 

session_start();
error_reporting(0);
$_SESSION['mensaje']= 0;

include 'connection.php';

$fecha_seleccionada = $_POST['fecha'];
$id_turno = $_POST['turno'];
$id_doctor = $_POST['dcotor'];

$consulta = "SELECT causa_consulta FROM causa_consulta INNER JOIN consultas ON consultas.id_causa_consulta = causa_consulta.id_causa_consulta WHERE consultas.id_turno_consulta = '$id_turno' AND consultas.fecha_atencion = '$fecha_seleccionada' AND consultas.id_status_consulta = 2 AND consulta.id_doctor = '$id_doctor'";
$query = ($conexion->query($consulta));

$numIteration = $query->num_rows;
$minutes = 0;

$respuesta = mysqli_fetch_array($query)['causa_consulta'];

while($numIteration != 0){
    switch ($respuesta){
        case "Consulta Diagnóstica":
            $minutes += 15;
        break;
        case "Limpieza Bucal":
            $minutes += 25;
        break;
        case "Blanqueamiento Dental":
            $minutes += 30;
        break;
        case "Extracción de Dientes":
            $minutes += 20;
        break;
        case "Obturación de Caries":
            $minutes += 30;
        break;
        case "Dientes Artificiales / Dentadura Postiza":
            $minutes += 60;
        break;
        case "Tratamiento para Alineación Dental":
            $minutes += 20;
        break;
        case "Estética":
            $minutes += 30;
        break;
    }
    $numIteration = $numIteration-1;
}

if($minutes >= 240){
    $_SESSION['mensaje']= 2;
    header ('location: ../paciente/index.php');
}else{
    include 'insert/registerCita.php';
}

?>