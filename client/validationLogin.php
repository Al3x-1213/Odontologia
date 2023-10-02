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

        session_start();
        ob_start();

        include 'connection.php'; // Conexión con base de datos

        $consulta = "SELECT * FROM cuentas INNER JOIN datos_personales
        ON cuentas.id_dato_personal = datos_personales.id_dato_personal
        WHERE usuario = '$usuario' and clave = '$clave'";
        $query = mysqli_query($conexion, $consulta);

        $respuesta = mysqli_fetch_array($query);

        $idUsuario = $respuesta['id_cuenta'];
        $usuario = $respuesta['usuario'];
        $tipoUsuario = $respuesta['id_tipo_usuario'];
        $statusUsuario = $respuesta['id_status_usuario'];

        $nombre = $respuesta['nombre'];
        $apellido = $respuesta['apellido'];

        // VARIABLES GLOBALES
        $_SESSION['id'] = $idUsuario;
        $_SESSION['usuario'] = $usuario;
        $_SESSION['tipo_usuario'] = $tipoUsuario;

        // VALIDACIÓN DEL USUARIO INGRESADO
        if($tipoUsuario == 1){ // Administrador - Doctor
            if($statusUsuario == 1){
                $_SESSION['mensaje'] = "Bienvenido/a ". $nombre. " ". $apellido;
                $_SESSION['error'] = 3;
                header ("location: ../admin/index.php");
            }
            else{
                $_SESSION['mensaje'] = "El usuario: ". $usuario. " actualmente se encuentra inactivo";
                $_SESSION['error'] = 3;
                header ("location: ../parts/login.php");
            }
        }
        else if($tipoUsuario == 2){ // Paciente
            if($statusUsuario == 1){
                $_SESSION['mensaje'] = "Bienvenido/a ". $nombre. " ". $apellido;
                $_SESSION['error'] = 3;
                header ("location: ../paciente/index.php");
            }
            else{
                $_SESSION['mensaje'] = "El usuario: ". $usuario. " actualmente se encuentra inactivo";
                $_SESSION['error'] = 3;
                header ("location: ../parts/login.php");
            }
        }
        else{
            $_SESSION['mensaje'] = "usuario o contraseña incorrecto";
            $_SESSION['error'] = 1;
            header ("location: ../parts/login.php");
        }
        mysqli_close($conexion); //Cerrar la conexion con la base de datos
    }
}

?>