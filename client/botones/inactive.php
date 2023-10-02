<?php

include '../connection.php';

$idDatoPersonal = $_GET['id'];

$consulta = "SELECT id_cuenta, usuario FROM cuentas WHERE id_dato_personal = '$idDatoPersonal'";
$query = mysqli_query($conexion, $consulta);

$respuesta = mysqli_fetch_array($query);
$idCuenta = $respuesta['id_cuenta'];
$usuario = $respuesta['usuario'];

$consulta = "UPDATE cuentas SET id_status_usuario = 2 WHERE id_cuenta = '$idCuenta'";
$query = mysqli_query($conexion, $consulta);

if ($query){
    $_SESSION['mensaje'] = "El usuario: ".$usuario." ha sido desactivado";
    $_SESSION['error'] = 3;
    mysqli_close($conexion);
    header("location: ../../admin/registeredUser.php");
}else{
    $_SESSION['mensaje'] = "No se pudo realizar el proceso";
    $_SESSION['error'] = 1;
    mysqli_close($conexion);
    header("location: ../../admin/registeredUser.php");
}

?>