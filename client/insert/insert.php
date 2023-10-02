<?php

if (!empty($_POST['boton_reg'])) {
    // VERIFICAR QUE NO HAYAN CAMPOS VACIOS
    if (empty($_POST['usuario']) || empty($_POST['clave']) || empty($_POST['clave2']) || empty($_POST['nombre'])
        || empty($_POST['apellido']) || empty($_POST['cedula']) || empty($_POST['nacimiento']) || empty($_POST['prefNumber1'])
        || empty($_POST['telefono1']) || empty($_POST['correo']) || empty($_POST['discapacidad']) || empty($_POST['alergia'])){
        session_start();
        $_SESSION['mensaje'] = "No deben haber campos vacios";
        $_SESSION['error'] = 1;
        header("location: login.php");
    }
    else{
        // if ((!empty($_POST['telefono2']) && empty($_POST['prefNumber2'])) || (!empty($_POST['prefNumber2']) && empty($_POST['telefono2']))){
        //     session_start();
        //     $_SESSION['mensaje'] = "No deben haber campos vacios";
        //     $_SESSION['error'] = 1;
        //     header("location: login.php");
        // }

        //DATOS DEL FORMULARIO DE REGISTRO
        $usuario = $_POST['usuario'];
        $clave = $_POST['clave'];
        $claveConfirm = $_POST['clave2'];
        $tipoUsuario = "2";
        $statusUsuario = "1";

        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $cedula = $_POST['cedula'];
        $nacimiento = $_POST['nacimiento'];
        $prefijo1 = $_POST['prefNumber1'];
        $telefono_1 = $_POST['telefono1'];
        $prefijo2 = $_POST['prefNumber2'];
        $telefono_2 = $_POST['telefono2'];
        $correo = $_POST['correo'];
        $discapacidad = $_POST['discapacidad'];
        $alergia = $_POST['alergia'];

        $telefonoCP_1 = $prefijo1.$telefono_1;
        $telefonoCP_2 = $prefijo2.$telefono_2;


        if(strlen($telefonoCP_2) != 11 || strlen($telefonoCP_2) != 0){
            session_start();
            $_SESSION['mensaje'] = "No deben haber campos vacios";
            $_SESSION['error'] = 1;
            header("location: register.php");
        }
        else{
            // VERIFICAR QUE AMBAS CONTRASEÑAS SEAN IGUALES
            if ($clave != $claveConfirm){
                session_start();
                $_SESSION['mensaje'] = "Las contraseñas deben coincidir";
                $_SESSION['error'] = 1;
                header("location: login.php");
            }
            else{
                // CALCULAR EDAD
                // include '../calcularEdad.php';
                include '../client/calcularEdad.php';

                //HACER REGISTRO EN BASE DE DATOS
                // include '../connection.php'; //Conexión con base de datos
                include '../client/connection.php'; //Conexión con base de datos

                $consulta = "INSERT INTO datos_personales (id_dato_personal, nombre, apellido, cedula, edad, fecha_nacimiento, telefono_1,
                telefono_2, correo, id_discapacidad, id_alergia, fecha_registro) VALUES (NULL, '$nombre', '$apellido', '$cedula',
                '$edad', '$nacimiento', '$telefonoCP_1', '$telefonoCP_2', '$correo', '$discapacidad', '$alergia', now())";
                $query = mysqli_query($conexion, $consulta);

                if ($query){
                    $consulta = "SELECT id_dato_personal FROM datos_personales WHERE cedula = '$cedula'";
                    $query = mysqli_query($conexion, $consulta);

                    $respuesta = mysqli_fetch_array($query);
                    $idDatoPersonal = $respuesta['id_dato_personal'];

                    $clave = md5($clave);

                    // HACER REGISTRO EN BASE DE DATOS - TABLA CUENTAS
                    $consulta = "INSERT INTO cuentas (id_cuenta, usuario, clave, id_dato_personal, id_tipo_usuario, id_status_usuario)
                    VALUES (NULL, '$usuario', '$clave', '$idDatoPersonal', '$tipoUsuario', '$statusUsuario')";
                    $query = mysqli_query($conexion, $consulta);

                    if ($query){
                        session_start();
                        $_SESSION['mensaje'] = "Usuario Registrado Exitosamente";
                        $_SESSION['error'] = 2;
                        header("location: login.php");
                    }
                    else{
                        session_start();
                        $_SESSION['mensaje'] = "Error al Intentar registrar usuario";
                        $_SESSION['error'] = 1;
                        header("location: login.php");
                    }
                }
                else{
                    session_start();
                    $_SESSION['mensaje'] = "No se pudo registrar usuario";
                    $_SESSION['error'] = 1;
                    header("location: login.php");
                }
            }
        }
    }
}

?>