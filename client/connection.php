<?php 

$host = 'localhost';
$user = 'root';
$password = '';
$dataBase = 'odontologia';
$conexion = new mysqli($host, $user, $password, $dataBase);

if($conexion->connect_error){
    die('Error de conexión: ' . $conexion->connect_error);
}
if (!$conexion->set_charset("utf8")) {
    printf("Error cargando el conjunto de caracteres utf8: %s\n", $conexion->error);
    exit();
}

?>