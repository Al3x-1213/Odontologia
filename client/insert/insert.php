<!DOCTYPE html>
<html lang="es">

<head>
    <!-- META ETIQUETAS -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ESTILOS CSS -->
    <link rel="stylesheet" href="../../styles/normalize.css">
    <link rel="stylesheet" href="../../styles/insert.css">

    <!-- LETRAS UTILIZADAS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">

    <title>Marisol Díaz - REGISTRARSE</title>
</head>

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
        $tipo_usuario = "2";
        $status_usuario = "1";

        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $cedula = $_POST['cedula'];
        $nacimiento = $_POST['nacimiento'];
        $telefono_1 = $_POST['telefono1'];
        $telefono_2 = $_POST['telefono2'];
        $correo = $_POST['correo'];
        $discapacidad = $_POST['discapacidad'];
        $alergia = $_POST['alergia'];

        // VERIFICAR QUE AMBAS CONTRASEÑAS SEAN IGUALES
        if ($clave != $claveConfirm){
            ?>
               <div class= "alerta">Las contraseñas deben coincidir</div>
               <div class= "alerta">Por favor verificar</div>
//          <?php
        }
        else{
            // CALCULAR EDAD
            include '../calcularEdad.php';

            //HACER REGISTRO EN BASE DE DATOS
            include '../connection.php'; //Conexión con base de datos

            $clave= md5($clave);

            $consulta = "INSERT INTO usuarios (id_usuario, usuario, clave, id_tipo_usuario, id_status_usuario, nombre, apellido, cedula, edad, fecha_nacimiento, telefono_1, telefono_2, correo, id_discapacidad, id_alergia, fecha_registro) VALUES (NULL, '$usuario', '$clave', '$tipo_usuario', '$status_usuario', '$nombre', '$apellido', '$cedula', '$edad', '$nacimiento', '$telefono_1', '$telefono_2',  '$correo', '$discapacidad', '$alergia', now())";
            $query = mysqli_query($conexion, $consulta);

            if($query){
                header ("location: ../../parts/login.php");
            }else{
                header ("location: ../../parts/register.php");
                ?>
                <div class= "alerta">No se pudo realizar el registro</div> 
                <?php
            }
        }
   }
}
?>

<body>

<div class= "mensaje"><a href= "../../parts/login.php">Usuario regitrado correctamente</a></div>

</body>