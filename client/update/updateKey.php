<?php
session_start();
ob_start();

if (!empty($_POST['button_upd'])){
    // VERIFICAR QUE NO HAYAN CAMPOS VACIOS
    if (empty($_POST['claveAnt']) || empty($_POST['clave']) || empty($_POST['clave2'])){
        // session_start();
        $_SESSION['mensaje'] = "No deben haber campos vacios";
        $_SESSION['error'] = 1;
        header("location: ../../paciente/editarPerfil/editarClave.php");
    }
    else{
        // VARIABLE GLOBAL: ID DEL USUARIO LOGUEADO
        $id= $_SESSION['id'];

        // DATOS DEL FORMULARIO DE REGISTRO
        $claveAnt = $_POST['claveAnt'];
        $clave = $_POST['clave'];
        $claveConfirm = $_POST['clave2'];

        // echo $claveAnt. "<br>";
        // echo $clave. "<br>";
        // echo $claveConfirm. "<br>";

        // CONFIRMAR QUE LA CONTRASEÑA ANTERIOR SEA CORRECTA
        include '../connection.php'; //Conexión con base de datos

        $consulta = "SELECT clave FROM cuentas WHERE id_cuenta = '$id'";
        // echo $consulta;
        $query = mysqli_query($conexion, $consulta);

        $resultado = mysqli_fetch_array($query);
        $claveDB = $resultado['clave'];
        $claveAnt= md5($claveAnt);

        if($claveDB != $claveAnt){
            $_SESSION['mensaje'] = "La contraseña no es correcta";
            $_SESSION['error'] = 1;
            header("location: ../../paciente/editarPerfil/editarClave.php");
        }
        else{
            // echo "si";
            // VERIFICAR QUE AMBAS CONTRASEÑAS SEAN IGUALES
            if ($clave != $claveConfirm){
                $_SESSION['mensaje'] = "Las contraseñas deben coincidir";
                $_SESSION['error'] = 1;
                header("location: ../../paciente/editarPerfil/editarClave.php");
            }
            else{
                // echo "si";
                // //HACER REGISTRO EN BASE DE DATOS
                // include 'conexion.php'; //Conexión con base de datos

                $clave= md5($clave);

                $consulta = "UPDATE cuentas SET clave = '$clave' WHERE id_cuenta = '$id'";
                // echo $consulta;
                $query = mysqli_query($conexion, $consulta);

                if ($query){
                    $_SESSION['mensaje'] = "Contraseña actualizada correctamente";
                    $_SESSION['error'] = 2;
                    header("location: ../../paciente/perfilPaciente.php");
                }
                else{
                    $_SESSION['mensaje'] = "No se pudo actualizar";
                    $_SESSION['error'] = 1;
                    header("location: ../../paciente/editarPerfil/editarClave.php");
                }
            }
        }
    }
}

?>