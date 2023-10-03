<?php 

session_start();
error_reporting(0);

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
        case "Periapical o Bite Wing Individual":
            $minutes += 15;
        break;
        case "RX Coronal Derecha e Izquierda":
            $minutes += 15;
        break;
        case "Consulta Diagnóstica Odontología General":
            $minutes += 15;
        break;
        case "Obturación de Caries Clase I y/o Compleja con Amalgama":
            $minutes += 45;
        break;
        case "Obturación de Caries Clase II, Clase V, y/o Compleja con Amalgama":
            $minutes += 45;
        break;
        case "Obturación de Caries Clase VI y/o Compleja con Amalgama":
            $minutes += 45;
        break;
        case "Obturación de Caries Clase I, III y V con Resina Fotocurada":
            $minutes += 45;
        break;
        case "Obturación de Caries Clase II y IV con Resina Fotocurada":
            $minutes += 45;
        break;
        case "Fisuras Simples con Resina":
            $minutes += 30;
        break;
        case "Obturación con Vidrio Ionomerico para Clase V, o como Material de Base para Restauraciones":
            $minutes += 45;
        break;
        case "Restauración Carilla de Resina Fotocurada":
            $minutes += 40;
        break;
        case "Emergencias":
            $minutes += 60;
        break;
        case "Obturación de Caries Clase VI con Resina Fotocurada":
            $minutes += 45;
        break;
        case "Pulpotomía":
            $minutes += 45;
        break;
        case "Técnica de Cepillado":
            $minutes += 15;
        break;
        case "Tartrectomía":
            $minutes += 30;
        break;
        case "Profilaxis y Fluor":
            $minutes += 30;
        break;
        case "Sellante de Fisuras":
            $minutes += 30;
        break;
        case "Aplicación de Fluor en Cualquier Presentación para Sensibilidad Dentaria":
            $minutes += 30;
        break;
        case "Carillas Dentales":
            $minutes += 75;
        break;
        case "Blanqueamiento Dental":
            $minutes += 30;
        break;
    }
    $numIteration = $numIteration-1;
}

if($minutes >= 240){
    $_SESSION['mensaje']= "no hay disponibilidad para la fecha seleccionada";
    $_SESSION['error']= 1;
    header ('location: ../paciente/index.php');
}else{
    include 'insert/registerCita.php';
}

?>