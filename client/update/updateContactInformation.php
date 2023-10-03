<?php
session_start();
ob_start();

$tipoUsuario = $_SESSION['tipo_usuario'];

if (!empty($_POST['button_upd'])) {
    // VERIFICAR QUE NO HAYAN CAMPOS VACIOS
    if (empty($_POST['prefNumber1']) || empty($_POST['telefono1']) || empty($_POST['correo'])){
        session_start();
        $_SESSION['mensaje'] = "No deben haber campos vacios";
        $_SESSION['error'] = 1;
        if ($tipoUsuario == 1){
            header("location: ../../admin/userProfile.php");
        }
        elseif ($tipoUsuario == 2){
            header("location: ../../paciente/perfilPaciente.php");
        }
    }
    else{
        // VARIABLE GLOBAL: ID DEL USUARIO LOGUEADO
        $idUsuario = $_SESSION['id'];

        //DATOS DEL FORMULARIO
        $prefijo1 = $_POST['prefNumber1'];
        $telefono_1 = $_POST['telefono1'];
        $prefijo2 = $_POST['prefNumber2'];
        $telefono_2 = $_POST['telefono2'];
        $correo = $_POST['correo'];

        $telefonoCP_1 = $prefijo1.$telefono_1;
        $telefonoCP_2 = $prefijo2.$telefono_2;

        if (strlen($telefonoCP_1) != 11){
            session_start();
            $_SESSION['mensaje'] = "Número de teléfono no permitido";
            $_SESSION['error'] = 1;
            if ($tipoUsuario == 1){
                header("location: ../../admin/userProfile.php");
            }
            elseif ($tipoUsuario == 2){
                header("location: ../../paciente/perfilPaciente.php");
            }
        }
        else{
            if(strlen($telefonoCP_2) == 11 || $telefonoCP_2 == 0){
                if ($telefonoCP_2 == 0){
                    $telefonoCP_2 = "";
                }
                //HACER REGISTRO EN BASE DE DATOS
                include '../connection.php'; //Conexión con base de datos

                $consulta = "SELECT id_dato_personal FROM cuentas WHERE id_cuenta = '$idUsuario'";
                $query = mysqli_query($conexion, $consulta);

                $resultado = mysqli_fetch_array($query);
                $idDatoPersonal = $resultado['id_dato_personal'];

                $consulta = "UPDATE datos_personales SET telefono_1 = '$telefonoCP_1', telefono_2 = '$telefonoCP_2', correo = '$correo'
                WHERE id_dato_personal = '$idDatoPersonal'";
                $query = mysqli_query($conexion, $consulta);

                if ($query){
                    session_start();
                    $_SESSION['mensaje'] = "Información de contacto actualizada correctamente";
                    $_SESSION['error'] = 2;
                    if ($tipoUsuario == 1){
                        header("location: ../../admin/userProfile.php");
                    }
                    elseif ($tipoUsuario == 2){
                        header("location: ../../paciente/perfilPaciente.php");
                    }
                }
                else{
                    session_start();
                    $_SESSION['mensaje'] = "No se pudo actualizar";
                    $_SESSION['error'] = 1;
                    if ($tipoUsuario == 1){
                        header("location: ../../admin/userProfile.php");
                    }
                    elseif ($tipoUsuario == 2){
                        header("location: ../../paciente/perfilPaciente.php");
                    }
                }
            }else{
                session_start();
                $_SESSION['mensaje'] = "No deben haber campos vacios";
                $_SESSION['error'] = 1;
                if ($tipoUsuario == 1){
                    header("location: ../../admin/userProfile.php");
                }
                elseif ($tipoUsuario == 2){
                    header("location: ../../paciente/perfilPaciente.php");
                }
            }
        }
    }
}

?>