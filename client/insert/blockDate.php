<?php

session_start();

// VERIFICAR QUE NO HAYAN CAMPOS VACIOS
if (empty($_POST['bloquear'])) {
    $_SESSION['mensaje'] = "No deben haber campos vacios";
    $_SESSION['error'] = 1;
    header("location: ../../admin/blockDate.php");
} else {
    // DATOS DEL FORMULARIO
    $bloquearFecha = $_POST['bloquear'];

    // CONSULTA A BASE DE DATOS
    include '../connection.php';

    $consulta = "SELECT id_fecha_bloqueada FROM fechas_bloqueadas WHERE fecha_bloqueada = '$bloquearFecha'";
    // echo $consulta;
    $query = mysqli_query($conexion, $consulta);

    $resultado = mysqli_num_rows($query);

    if ($resultado > 0) {
        $_SESSION['mensaje'] = "Esta fecha se encuentra actualmente bloqueada";
        $_SESSION['error'] = 1;
        header("location: ../../admin/blockDate.php");
    } else {
        $consulta = "INSERT INTO fechas_bloqueadas (id_fecha_bloqueada, fecha_bloqueada) VALUES (NULL, '$bloquearFecha')";
        $query = mysqli_query($conexion, $consulta);
        if ($query) {
            $_SESSION['mensaje'] = "Fecha bloqueada correctamente";
            $_SESSION['error'] = 2;
            header("location: ../../admin/blockDate.php");
        } else {
            $_SESSION['mensaje'] = "No se ha podido bloquear esta fecha";
            $_SESSION['error'] = 1;
            header("location: ../../admin/blockDate.php");
        }
    }
}

?>