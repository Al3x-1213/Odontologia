<?php

/* DATOS RECIBIDOS DEL LOGUEO PARA SER VALIDADOS DENTRO DE LA BASE DE DATOS */
$correo=$_POST['correo'];
$clave=$_POST['clave'];

/* ESTO ES PARA VARIABLES GLOBALES  */
session_start();
ob_start();
$_SESSION['sesion'] = 0;

/* VALIDAR QUE LOS DATOS NO ESTÉN VACIOS  */
if($correo == '' || $clave == ''){
    header('Location:../index.php');
}else{
    $clave=md5($clave);

    include 'conexion.php';

    $validar = "SELECT * FROM paciente1 WHERE correo='$correo'";
    $validando = $conexion->query($validar);

    $respuesta = mysqli_fetch_array($validando);

    if($respuesta['clave'] != $clave){
        mysqli_close($conexion);
        ?> <script> alert("Correo o contraseña equivocado") </script> <?php
        header('Location:../parts/login.html');
    }else{
        $validar = "SELECT * FROM paciente1 WHERE correo='$correo' AND clave='$clave'";
        $validando = $conexion->query($validar);
        if($validando->num_rows > 0){
            /* CONSULTA A LA BASE DE DATOS PARA VER SI EL USUARIO ESTÁ AHÍ */
            $_SESSION['sesion'] = 1;
    
            /* CERRAR LA CONSULTA DE LA BASE DE DATOS */
            mysqli_close($conexion);
            header('Location:../paciente/index.php');
        }else{
            mysqli_close($conexion);
            header('Location:../index.php');
        }
    }
}

?>