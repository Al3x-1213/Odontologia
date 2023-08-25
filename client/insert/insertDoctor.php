<?php

if (!empty($_POST['boton_reg'])){

    // VERIFICAR QUE NO HAYAN CAMPOS VACIOS
    if (empty($_POST['usuario']) || empty($_POST['clave']) || empty($_POST['clave2']) || empty($_POST['tipoUser'])
    || empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['cedula']) || empty($_POST['nacimiento'])
    || empty($_POST['telefono1']) || empty($_POST['correo']) || empty($_POST['discapacidad']) || empty($_POST['alergia'])){
    
        ?>
        <!-- <div class= "alerta">No deben haber campos vacios</div> -->
        <?php
    }
    else{
        //DATOS DEL FORMULARIO DE REGISTRO
        $usuario = $_POST['usuario'];
        $clave = $_POST['clave'];
        $claveConfirm = $_POST['clave2'];
        $tipoUsuario = $_POST['tipoUser'];;
        $statusUsuario = "1";

        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $cedula = $_POST['cedula'];
        $nacimiento = $_POST['nacimiento'];
        $telefono_1 = $_POST['telefono1'];
        $telefono_2 = $_POST['telefono2'];
        $correo = $_POST['correo'];
        $discapacidad = $_POST['discapacidad'];
        $alergia = $_POST['alergia'];

        // echo $usuario. "<br>";
        // echo $clave. "<br>";
        // echo $claveConfirm. "<br>";
        // echo $tipoUsuario. "<br>";
        // echo $statusUsuario. "<br>";
        // echo $nombre. "<br>";
        // echo $apellido. "<br>";
        // echo $cedula. "<br>";
        // echo $nacimiento. "<br>";
        // echo $telefono_1. "<br>";
        // echo $telefono_2. "<br>";
        // echo $correo. "<br>";
        // echo $discapacidad. "<br>";
        // echo $alergia. "<br>";

        // VERIFICAR QUE AMBAS CONTRASEÑAS SEAN IGUALES
        if ($clave != $claveConfirm){
            echo "Mal";
            ?>
            <!-- <div class= "alerta">Las contraseñas deben coincidir</div> -->
            <!-- <div class= "alerta">Por favor verificar</div> -->
            <?php
        }
        else{  
            // CALCULAR EDAD
            include '../client/calcularEdad.php';
            // echo $edad;

            // HACER EL REGISTRO SEGÚN EL TIPO DE USUARIO QUE SE ESTÉ REGISTRANDO
            include '../connection.php'; //Conexión con base de datos

            if($tipoUsuario == 1){
                // echo "registrar como doctor";
                // HACER REGISTRO EN BASE DE DATOS - TABLA USUARIOS
                $clave= md5($clave);

                $consulta = "INSERT INTO usuarios VALUES(NULL, '$usuario', '$clave', '$tipoUsuario', '$statusUsuario', '$nombre', '$apellido',
                '$cedula', '$edad', '$nacimiento', '$telefono_1', '$telefono_2', '$correo', '$discapacidad', '$alergia', now())";
                // echo $consulta;
                $query = mysqli_query($conexion, $consulta);

                if($query){
                    echo "hecho";
                    ?>
                    <!-- <div class= "mensaje"><a href= "login.php">Usuario regitrado correctamente</a></div> -->
                    <?php
                    // $consulta = "SELECT id_usuario FROM usuarios WHERE cedula = '$cedula'";
                    // $query = mysqli_query($conexion, $consulta);
        
                    // $respuesta = mysqli_fetch_array($query);
                    // $id_usuario = $respuesta['id_usuario'];

                    // // HACER REGISTRO EN BASE DE DATOS - TABLA DOCTORES
                    // $consulta = "INSERT INTO doctores VALUES(NULL, '$id_usuario')";
                    // $query = mysqli_query($conexion, $consulta);

                    // if($query){
                    //     ?>
                    //     <!-- <div class= "mensaje"><a href= "#">Usuario regitrado correctamente</a></div> -->
                    //     <?php
                    // }
                    // else{
                    //     ?>
                    //     <!-- <div class= "alerta">No se pudo realizar el registro</div> -->
                    //     <?php
                    // }
                }
                else{
                    echo "NO";
                    ?>
                    <!-- <div class= "alerta">No se pudo realizar el registro</div> -->
                    <?php
                }
            }
            else{
                echo "registrar como paciente";
                // // HACER REGISTRO EN BASE DE DATOS - TABLA USUARIOS
                // $clave= md5($clave);

                // $consulta = "INSERT INTO usuarios VALUES(NULL, '$usuario', '$clave', '$tipoUsuario', '$status_usuario',
                // '$nombre', '$apellido', '$cedula', '$edad', '$nacimiento', '$telefono_1', '$telefono_2',  '$correo', '$id_discapacidad', '$id_discapacidad', now())";
                // $query = mysqli_query($conexion, $consulta);

                // if($query){
                //     ?>
                //     <!-- <div class= "mensaje"><a href= "#">Usuario regitrado correctamente</a></div> -->
                //     <?php
                // }
                // else{
                //     ?>
                //     <!-- <div class= "alerta">No se pudo realizar el registro</div> -->
                //     <?php
                // }
            }
            mysqli_close($conexion);
        }
    }
}

?>