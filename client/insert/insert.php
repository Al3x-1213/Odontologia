<?php

if (!empty($_POST['boton_reg'])){
    // VERIFICAR QUE NO HAYAN CAMPOS VACIOS
    if (empty($_POST['usuario']) || empty($_POST['clave']) || empty($_POST['clave2'])
    || empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['cedula'])
    || empty($_POST['nacimiento']) || empty($_POST['telefono1']) || empty($_POST['correo']) || empty($_POST['discapacidad']) || empty($_POST['alergia'])){
        ?>
        <div class= "alerta">No deben haber campos vacios</div>
        <?php
    }else{
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

        // VERIFICAR QUE AMBAS CONTRASEÑAS SEAN IGUALES
        if ($clave != $claveConfirm){
            ?>
            <div class= "alerta">Las contraseñas deben coincidir</div>
            <div class= "alerta">Por favor verificar</div>
            <?php
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
            '$edad', '$nacimiento', '$telefono_1', '$telefono_2', '$correo', '$discapacidad', '$alergia', now())";
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

                if($query){
                    $_SESSION['mensaje'] = 1;
                    header ("location: login.php");
                }else{
                    $_SESSION['mensaje'] = 2;
                    header ("location: login.php");
                }
            }
            else{
                ?>
                <div class= "alerta">No se pudo realizar el registro</div> 
                <?php
            }
        }
    }
}

?>