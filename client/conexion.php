<?php 

$host = 'localhost';
$user = 'root';
$passwd = '';
$nameDB = 'odontologia';
$conexion = new mysqli($host, $user, $passwd, $nameDB);

if($conexion->connect_error){
    die("no se ha conectado");
}

?>