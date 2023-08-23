<?php

if (!empty($_POST['boton_log'])){
    // VALIDAR QUE LOS CAMPOS NO ESTÉN VACIOS
    if (empty($_POST['usuario']) || empty($_POST['clave'])){
        ?>
        <div class= "alerta">No deben haber campos vacios</div>
        <?php
    }
    else{
        // DATOS RECIBIDOS DEL LOGUEO PARA SER VALIDADOS DENTRO DE LA BASE DE DATOS
        $usuario = $_POST['usuario'];
        $clave = $_POST['clave'];
        $clave = md5($clave);

        session_start(); // Inicia una sesión
        ob_start();

        include 'connection.php'; // Conexión con base de datos

        $consulta = "SELECT * FROM usuarios WHERE usuario = '$usuario' and clave = '$clave'";

        // VARIABLES GLOBALES
        $id = mysqli_fetch_array(mysqli_query($conexion, $consulta))['id_usuario'];
        $usuario = mysqli_fetch_array(mysqli_query($conexion, $consulta))['usuario'];
        $tipo_usuario = mysqli_fetch_array(mysqli_query($conexion, $consulta))['id_tipo_usuario'];

        $_SESSION['id'] = $id;
        $_SESSION['usuario'] = $usuario;
        $_SESSION['tipo_usuario'] = $tipo_usuario;

        // VALIDACIÓN DEL USUARIO INGRESADO
        if(mysqli_fetch_array(mysqli_query($conexion, $consulta))['id_tipo_usuario'] == 1){ // Administrador / Doctor
            if(mysqli_fetch_array(mysqli_query($conexion, $consulta))['id_status_usuario'] == 1){
                header("location: ../admin/index.php");
            }
            else{
                ?>
                <div class= "alerta">Usuario inactivo</div>
                <?php
            }
        }
        elseif(mysqli_fetch_array(mysqli_query($conexion, $consulta))['id_tipo_usuario'] == 2){ // Paciente
            if(mysqli_fetch_array(mysqli_query($conexion, $consulta))['id_status_usuario'] == 1){
                header("location: ../paciente/index.php");
            }
            else{
                ?>
                <div class= "alerta">Usuario inactivo</div>
                <?php
            }
        }
        else{
            ?>
            <div class= "alerta">Usuario / Contraseña</div>
            <div class= "alerta">Incorrecto</div>
            <?php
        }
        mysqli_close($conexion); //Cerrar la conexion con la base de datos
    }
}

?>