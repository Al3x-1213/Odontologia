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

$dato = $_POST['paciente'];

$consulta="SELECT * FROM usuarios WHERE cedula = '$dato' AND id_tipo_usuario = 2";
$query = mysqli_query($conexion, $consulta);

$respuesta = mysqli_fetch_array($query);

?>