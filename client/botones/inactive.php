<?php

include '../connection.php';

$idDatoPersonal = $_GET['id'];

$consulta = "SELECT id_cuenta FROM cuentas WHERE id_dato_personal = '$idDatoPersonal'";
$query = mysqli_query($conexion, $consulta);

$respuesta = mysqli_fetch_array($query);
$idCuenta = $respuesta['id_cuenta'];

$consulta = "UPDATE cuentas SET id_status_usuario = 2 WHERE id_cuenta = '$idCuenta'";
$query = mysqli_query($conexion, $consulta);

if($query){
    mysqli_close($conexion);
    header("location:../../admin/registeredUser.php");
}

?>