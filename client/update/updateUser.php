<?php
session_start();
ob_start();

$tipoUsuario = $_SESSION['tipo_usuario'];

if (!empty($_POST['button_upd'])){
    // VERIFICAR QUE NO HAYAN CAMPOS VACIOS
    if (empty($_POST['usuario'])){
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
        $idUsuario= $_SESSION['id'];

        //DATOS DEL FORMULARIO
        $usuario = $_POST['usuario'];

        //HACER REGISTRO EN BASE DE DATOS
        include '../connection.php'; //Conexión con base de datos

        $consulta = "UPDATE cuentas SET usuario = '$usuario' WHERE id_cuenta = '$idUsuario'";
        $query = mysqli_query($conexion, $consulta);

        if ($query){
            session_start();
            $_SESSION['mensaje'] = "Usuario actualizado correctamente";
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
    }
}

?>