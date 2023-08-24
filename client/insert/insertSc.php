<?php

if (!empty($_POST['boton_reg'])){

    // VERIFICAR QUE NO HAYAN CAMPOS VACIOS
    if (empty($_POST['cedula']) ||empty($_POST['usuario']) || empty($_POST['clave']) || empty($_POST['clave2'])){
    
        ?>
        <div class= "alerta">No deben haber campos vacios</div>
        <?php
    }
    else{
        //DATOS DEL FORMULARIO DE REGISTRO
        $cedula = $_POST['cedula'];
        $usuario = $_POST['usuario'];
        $clave = $_POST['clave'];
        $clave_confirm = $_POST['clave2'];

        // VERIFICAR QUE EL USUARIO CON LA CÉDULA INGRESADA SE ENCUENTRE REGISTRADO
        include '../client/connection.php'; //Conexión con base de datos

        $consulta = "SELECT * FROM usuarios WHERE cedula = '$cedula'";
        $query = mysqli_query($conexion, $consulta);

        $resultado= mysqli_num_rows($query);

        if ($resultado == 0){
            ?>
            <div class= "alerta">Usuario no existe</div>
            <div class= "alerta"><a href= "registrarse.php">Regístrate aquí</a></div>
            <?php
        }
        else{
            $respuesta = mysqli_fetch_array($query);
            $id_usuario = $respuesta['id_usuario'];
            $status_cuenta = $respuesta['id_status_usuario'];

            if($status_cuenta == 3){
                // VERIFICAR QUE AMBAS CONTRASEÑAS SEAN IGUALES
                if ($clave != $clave_confirm){
                    ?>
                    <div class= "alerta">Las contraseñas deben coincidir</div>
                    <div class= "alerta">Por favor verificar</div>
                    <?php
                }
                else{                
                    // HACER REGISTRO EN BASE DE DATOS    
                    $clave= md5($clave);
    
                    $consulta = "UPDATE usuarios SET usuario = '$usuario', clave = '$clave', id_status_usuario = 1 WHERE id_usuario = '$id_usuario'";
                    $query = mysqli_query($conexion, $consulta);
    
                    if($query){
                        ?>
                        <div class= "mensaje"><a href= "login.php">Usuario regitrado correctamente</a></div>
                        <?php
                    }
                    else{
                        ?>
                        <div class= "alerta">No se pudo realizar el registro</div>
                        <?php
                    }
                }
            }
            else{
                ?>
                <div class= "alerta">Este usuario ya tiene una cuenta</div>
                <div class= "alerta"><a href= "login.php">Inicia Sesión</a></div>
                <?php
            }
        }
    }
}

?>