<?php

$idPaciente = $_POST['id_dato_personal'];

if (!empty($_POST['button_upd'])){
    // VERIFICAR QUE NO HAYAN CAMPOS VACIOS
    if (empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['cedula'])
    || empty($_POST['nacimiento']) || empty($_POST['telefono1']) || empty($_POST['correo'])){
        session_start();
        $_SESSION['mensaje'] = "No deben haber campos vacios";
        $_SESSION['error'] = 1;
        header("location: ../../admin/updateInformationUser.php?id=". $idPaciente);
    }
    else{
        //DATOS DEL FORMULARIO

        // $idPaciente = $_POST['id_dato_personal'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $cedula = $_POST['cedula'];
        $nacimiento = $_POST['nacimiento'];
        $telefono_1 = $_POST['telefono1'];
        $telefono_2 = $_POST['telefono2'];
        $correo = $_POST['correo'];

        // CALCULAR EDAD
        include '../calcularEdad.php';

        //HACER REGISTRO EN BASE DE DATOS
        include '../connection.php'; //Conexión con base de datos

        $consulta = "UPDATE datos_personales SET nombre = '$nombre', apellido = '$apellido', cedula = '$cedula', edad = '$edad',
        fecha_nacimiento = '$nacimiento', telefono_1 = '$telefono_1', telefono_2 = '$telefono_2', correo = '$correo' WHERE id_dato_personal = '$idPaciente'";
        $query = mysqli_query($conexion, $consulta);

        if ($query){
            session_start();
            $_SESSION['mensaje'] = "Usuario actualizado correctamente";
            $_SESSION['error'] = 2;
            header("location: ../../admin/registeredUser.php");
        }
        else{
            session_start();
            $_SESSION['mensaje'] = "No deben haber campos vacios";
            $_SESSION['error'] = 1;
            header("location: ../../admin/registeredUser.php");
        }
    }
}

?>