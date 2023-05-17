<?php 

$host = 'localhost';
$user = 'root';
$passwd = '';
$nameDB = 'consultorio_riccio';
$conexion = new mysqli($host, $user, $passwd, $nameDB);

if($conexion->connect_error){
    die("no se ha conectado");
}

?>