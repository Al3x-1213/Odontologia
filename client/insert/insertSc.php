<?php

if (!empty($_POST['boton_reg'])) {
    // VERIFICAR QUE NO HAYAN CAMPOS VACIOS
    if (empty($_POST['cedula']) || empty($_POST['usuario']) || empty($_POST['clave']) || empty($_POST['clave2'])){
        session_start();
        $_SESSION['mensaje'] = "No deben haber campos vacios";
        $_SESSION['error'] = 1;
        header("location: ../../parts/registerSc.php");
    } else {
        //DATOS DEL FORMULARIO DE REGISTRO
        $cedula = $_POST['cedula'];
        $usuario = $_POST['usuario'];
        $clave = $_POST['clave'];
        $claveConfirm = $_POST['clave2'];
        $tipoUsuario = "2";
        $statusUsuario = "1";

        // VERIFICAR QUE LA PERSONA CON LA CÉDULA INGRESADA SE ENCUENTRE REGISTRADO
        include '../connection.php'; //Conexión con base de datos

        $consulta = "SELECT * FROM datos_personales WHERE cedula = '$cedula'";
        $query = mysqli_query($conexion, $consulta);

        $resultado = mysqli_num_rows($query);

        if ($resultado == 0){
            session_start();
            $_SESSION['mensaje'] = "Este usuario no existe <br> <a href='../parts/register.php'>Registrate aquí</a>";
            $_SESSION['error'] = 3;
            header("location: ../../parts/registerSc.php");
        }
        else{
            $respuesta = mysqli_fetch_array($query);
            $idDatoPersonal = $respuesta['id_dato_personal'];

            $consulta = "SELECT * FROM cuentas WHERE id_dato_personal = '$idDatoPersonal'";
            $query = mysqli_query($conexion, $consulta);

            $resultado = mysqli_num_rows($query);

            if ($resultado != 0) {
                session_start();
                $_SESSION['mensaje'] = "Este usuario ya tiene una cuenta <br> <a href='../parts/login.php'>Inicia Sesión</a>";
                $_SESSION['error'] = 2;
                header("location: ../../parts/registerSc.php");
            } else {
                // VERIFICAR QUE AMBAS CONTRASEÑAS SEAN IGUALES
                if ($clave != $claveConfirm) {
                    session_start();
                    $_SESSION['mensaje'] = "Las contraseñas deben coincidir";
                    $_SESSION['error'] = 1;
                    header("location: ../../parts/registerSc.php");
                } else {
                    // HACER REGISTRO EN BASE DE DATOS    
                    $clave = md5($clave);

                    $consulta = "INSERT INTO cuentas (id_cuenta, usuario, clave, id_dato_personal, id_tipo_usuario, id_status_usuario)
                    VALUES (NULL, '$usuario', '$clave', '$idDatoPersonal', '$tipoUsuario', '$statusUsuario')";
                    $query = mysqli_query($conexion, $consulta);

                    if ($query) {
                        session_start();
                        $_SESSION['mensaje'] = "Usuario registrado exitosamente";
                        $_SESSION['error'] = 2;
                        header("location: ../../parts/login.php");
                    } else {
                        session_start();
                        $_SESSION['mensaje'] = "Error al registrar usuario";
                        $_SESSION['error'] = 1;
                        header("location: ../../parts/registerSc.php");
                    }
                }
            }
        }
    }
}

?>