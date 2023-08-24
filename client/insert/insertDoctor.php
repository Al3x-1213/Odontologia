<?php

if (!empty($_POST['boton_reg'])){

    // VERIFICAR QUE NO HAYAN CAMPOS VACIOS
    if (empty($_POST['usuario']) || empty($_POST['clave']) || empty($_POST['clave2']) || empty($_POST['tipoUser']) || empty($_POST['nombre'])
    || empty($_POST['apellido']) || empty($_POST['cedula']) || empty($_POST['nacimiento']) || empty($_POST['telefono1']) || empty($_POST['correo'])){
    
        ?>
        <div class= "alerta">No deben haber campos vacios</div>
        <?php
    }
    else{
        //DATOS DEL FORMULARIO DE REGISTRO
        $usuario = $_POST['usuario'];
        $clave = $_POST['clave'];
        $clave_confirm = $_POST['clave2'];
        $tipo_usuario = $_POST['tipoUser'];;
        $status_usuario = "1";

        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $cedula = $_POST['cedula'];
        $nacimiento = $_POST['nacimiento'];
        $telefono_1 = $_POST['telefono1'];
        $telefono_2 = $_POST['telefono2'];
        $correo = $_POST['correo'];

        // VERIFICAR QUE AMBAS CONTRASEÑAS SEAN IGUALES
        if ($clave != $clave_confirm){
            ?>
            <div class= "alerta">Las contraseñas deben coincidir</div>
            <div class= "alerta">Por favor verificar</div>
            <?php
        }
        else{            
            // CALCULAR EDAD
            include 'calcularEdad.php';

            // HACER EL REGISTRO SEGÚN EL TIPO DE USUARIO QUE SE ESTÉ REGISTRANDO
            include 'connection.php'; //Conexión con base de datos

            if($tipo_usuario == 1){
                // HACER REGISTRO EN BASE DE DATOS - TABLA USUARIOS
                $clave= md5($clave);

                $consulta = "INSERT INTO usuarios VALUES(NULL, '$usuario', '$clave', '$tipo_usuario', '$status_usuario',
                '$nombre', '$apellido', '$cedula', '$edad', '$nacimiento', '$telefono_1', '$telefono_2',  '$correo', '$id_discapacidad', '$id_discapacidad', now())";
                $query = mysqli_query($conexion, $consulta);

                if($query){
                    ?>
                    <!-- <div class= "mensaje"><a href= "login.php">Usuario regitrado correctamente</a></div> -->
                    <?php
                    $consulta = "SELECT id_usuario FROM usuarios WHERE cedula = '$cedula'";
                    $query = mysqli_query($conexion, $consulta);
        
                    $respuesta = mysqli_fetch_array($query);
                    $id_usuario = $respuesta['id_usuario'];

                    // HACER REGISTRO EN BASE DE DATOS - TABLA DOCTORES
                    $consulta = "INSERT INTO doctores VALUES(NULL, '$id_usuario')";
                    $query = mysqli_query($conexion, $consulta);

                    if($query){
                        ?>
                        <div class= "mensaje"><a href= "#">Usuario regitrado correctamente</a></div>
                        <?php
                    }
                    else{
                        ?>
                        <div class= "alerta">No se pudo realizar el registro</div>
                        <?php
                    }
                }
                else{
                    ?>
                    <div class= "alerta">No se pudo realizar el registro</div>
                    <?php
                }
            }
            else{
                // HACER REGISTRO EN BASE DE DATOS - TABLA USUARIOS
                $clave= md5($clave);

                $consulta = "INSERT INTO usuarios VALUES(NULL, '$usuario', '$clave', '$tipo_usuario', '$status_usuario',
                '$nombre', '$apellido', '$cedula', '$edad', '$nacimiento', '$telefono_1', '$telefono_2',  '$correo', '$id_discapacidad', '$id_discapacidad', now())";
                $query = mysqli_query($conexion, $consulta);

                if($query){
                    ?>
                    <div class= "mensaje"><a href= "#">Usuario regitrado correctamente</a></div>
                    <?php
                }
                else{
                    ?>
                    <div class= "alerta">No se pudo realizar el registro</div>
                    <?php
                }
            }
            mysqli_close($conexion);
        }
    }
}


?>