<?php

session_start();
error_reporting(0);
$sesion = $_SESSION['usuario'];

if($sesion == null || $sesion = ''){ //Verificar que hay un acceso
    header("location: ../index.php");
    die();
}

?>