<?php

session_start();
error_reporting(0);
$sesion = $_SESSION['usuario'];
$tipo_usuario = $_SESSION['tipo_usuario'];

if($sesion == null || $sesion == '' || $tipo_usuario != 1){ //Verificar que hay un acceso
    header("location: ../index.php");
    die();
}

?>