<?php

include 'conexion.php';

$select = "SELECT * FROM consultas WHERE id_status_consulta = 2";
$consulta = $conexion->query($select);

while ($resultado = mysqli_fetch_array($consulta)) {
    $fecha_cita = explode("-", $resultado['fecha_atencion']);

    if ($dia > $fecha_cita[2] || $mes > $fecha_cita[1]) {
        $update = "UPDATE consultas SET id_status_consulta = 4 WHERE id_consulta = '$resultado[id_consulta]'";
        $consulta = $conexion->query($update);
    } else {
        continue;
    }
}
