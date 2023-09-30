<?php

if (!empty($_POST['button_rec'])) {
    // VERIFICAR QUE NO HAYAN CAMPOS VACIOS
    if (empty($_POST['clave']) || empty($_POST['clave2'])){
        ?>
        <!-- <div class="alerta">No deben haber campos vacios</div> -->
        <?php
        $_SESSION['mensaje'] = "No deben haber campos vacios";
        $_SESSION['error'] = 1;
        header("location: ../../recover.php");
    }
    else{
        // //DATOS DEL FORMULARIO
        $idDatoPersonal = $_POST['id_dato_personal'];
        $clave = $_POST['clave'];
        $claveConfirm = $_POST['clave2'];

        // VERIFICAR QUE AMBAS CONTRASEÑAS SEAN IGUALES
        if ($clave != $claveConfirm){
            session_start();
            $_SESSION['mensaje'] = "Las contraseñas no coinciden";
            $_SESSION['error'] = 4;
            header("location: recover.php?id=". $idDatoPersonal);
        }
        else{
            // OBTENER EL ID DE LA CUENTA
            include 'client/connection.php'; //Conexión con base de datos        

            $consulta = "SELECT id_cuenta FROM cuentas WHERE id_dato_personal = '$idDatoPersonal'";
            $query = mysqli_query($conexion, $consulta);

            $respuesta = mysqli_fetch_array($query);
            $idCuenta = $respuesta['id_cuenta'];

            $clave = md5($clave);

            // HACER CAMBIO DE CONTRASEÑA
            $consulta = "UPDATE cuentas SET clave = '$clave' WHERE id_cuenta = '$idCuenta'";
            $query = mysqli_query($conexion, $consulta);

            if ($query){
                session_start();
                $_SESSION['mensaje'] = "Contraseña restablecida";
                $_SESSION['error'] = 3;
                header("location: parts/login.php");
            }
            else{
                session_start();
                $_SESSION['mensaje'] = "No se pudo restablecer la contraseña";
                $_SESSION['error'] = 4;
                header("location: ../../parts/recover.php");
            }
        }
    }
}

?>