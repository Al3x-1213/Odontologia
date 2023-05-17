<?php

/* DATOS RECIBIDOS DEL LOGUEO PARA SER VALIDADOS DENTRO DE LA BASE DE DATOS */
$nombre_usuario=$_POST['nombre_usuario'];
$clave=$_POST['clave'];

/* ESTO ES PARA VARIABLES GLOBALES  */
session_start();
ob_start();
$_SESSION['sesion'] = 0;

/* VALIDAR QUE LOS DATOS NO ESTÉN VACIOS  */
if($nombre_usuario == '' || $clave == ''){
    header('Location:../index.php');
}else{
    $clave=md5($clave);

    include 'conexion.php';

    $validar = "SELECT * FROM admin WHERE nombre_usuario='$nombre_usuario'";
    $validando = $conexion->query($validar);

    $respuesta = mysqli_fetch_array($validando);

    if($respuesta['clave'] != $clave){
        mysqli_close($conexion);
        ?> <script> alert("nombre_usuario o contraseña equivocado") </script> <?php
        header('Location:../parts/login.html');
    }else{
        $validar = "SELECT * FROM admin WHERE nombre_usuario='$nombre_usuario' AND clave='$clave'";
        $validando = $conexion->query($validar);
        if($validando->num_rows > 0){
            /* CONSULTA A LA BASE DE DATOS PARA VER SI EL USUARIO ESTÁ AHÍ */
            $_SESSION['sesion'] = 1;
    
            /* CERRAR LA CONSULTA DE LA BASE DE DATOS */
            mysqli_close($conexion);
            header('Location:../admin/index.php');
        }else{
            mysqli_close($conexion);
            header('Location:../index.php');
        }
    }
}

?>