<?php

session_start();

include '../connection.php';

$idFechaBloqueada = $_GET['id'];

$consulta = "DELETE FROM fechas_bloqueadas WHERE id_fecha_bloqueada = '$idFechaBloqueada'";
$query = mysqli_query($conexion, $consulta);

if($query){
    $_SESSION['mensaje'] = "Se ha desbloqueado la fecha";
    $_SESSION['error'] = 3;
    header("location: ../../admin/blockDate.php");
}else{
    $_SESSION['mensaje'] = "No se ha realizado este proceso";
    $_SESSION['error'] = 1;
    header("location: ../../admin/blockDate.php");
}

?>