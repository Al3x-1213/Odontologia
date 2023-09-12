<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Marisol Díaz - ADMINISTRADOR</title>
</head>

</html>
<form method="post">
    <label> Paciente: </label>
    <input type="text" name="paciente">

    <input type="submit" value="enviar">
</form>

<?php

include 'client/connection.php';
include 'client/calcularEdad.php';

$usuario = $_POST['usuario'];
$clave = $_POST['clave'];
$claveConfirm = $_POST['clave2'];
$tipoUsuario = $_POST['tipoUser'];;
$statusUsuario = "1";

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$cedula = $_POST['cedula'];
$nacimiento = $_POST['nacimiento'];
$telefono_1 = $_POST['telefono1'];
$telefono_2 = $_POST['telefono2'];
$correo = $_POST['correo'];
$discapacidad = $_POST['discapacidad'];
$alergia = $_POST['alergia'];

echo "<br><br>";
echo $usuario;
echo "<br><br>";
echo $clave;
echo "<br><br>";
echo $claveConfirm;
echo "<br><br>";
echo $tipoUsuario;
echo "<br><br>";
echo $statusUsuario;
echo "<br><br>";

echo $nombre;
echo "<br><br>";
echo $apellido;
echo "<br><br>";
echo $cedula;
echo "<br><br>";
echo $edad;
echo "<br><br>";
echo $nacimiento;
echo "<br><br>";
echo $telefono_1;
echo "<br><br>";
echo $telefono_2;
echo "<br><br>";
echo $correo;
echo "<br><br>";
echo $discapacidad;
echo "<br><br>";
echo $alergia;
echo "<br><br>";

?>