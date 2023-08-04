<?php

if (!empty($_POST['boton_c'])){
    // VERIFICAR QUE NO HAYAN CAMPOS VACIOS
    if (empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['cedula']) || empty($_POST['nacimiento'])|| empty($_POST['telefono1'])
    || empty($_POST['correo']) || empty($_POST['causa']) || empty($_POST['atencion']) || empty($_POST['turno']) || empty($_POST['id_doctor'])){
        ?>
        <div class= "alerta">No deben haber campos vacios</div>
        <?php
    }
    else{
        //DATOS DEL FORMULARIO
        $tipo_usuario = "2";
        $status_usuario = "3";

        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $cedula = $_POST['cedula'];
        $nacimiento = $_POST['nacimiento'];
        $telefono_1 = $_POST['telefono1'];
        $telefono_2 = $_POST['telefono2'];
        $correo = $_POST['correo'];
        $causa = $_POST['causa'];
        $fechaAtencion = $_POST['atencion'];
        $turno = $_POST['turno'];
        $id_doctor = $_POST['id_doctor'];
        $id_status_consulta = 3;

        // CALCULAR EDAD
        include 'calcularEdad.php';

        //HACER REGISTRO EN BASE DE DATOS - TABLA USUARIOS
        include '../client/conexion.php'; //Conexión con base de datos

        $consulta = "INSERT INTO usuarios VALUES(NULL, NULL, NULL,  '$tipo_usuario', '$status_usuario', '$nombre',
        '$apellido','$cedula', '$edad', '$nacimiento', '$telefono_1', '$telefono_2',  '$correo', now())";
        $query = mysqli_query($conexion, $consulta);

        if($query){
            ?>
            <!-- <div class= "mensaje"><a href= "#">Cita agendada correctamente</a></div> -->
            <?php
            $consulta = "SELECT id_usuario FROM usuarios WHERE cedula = '$cedula'";
            $query = mysqli_query($conexion, $consulta);

            $respuesta = mysqli_fetch_array($query);
            $id_paciente = $respuesta['id_usuario'];

            //HACER REGISTRO EN BASE DE DATOS - TABLA CONSULTAS
            $consulta = "INSERT INTO consultas VALUES(NULL, '$id_paciente', '$causa', '$fechaAtencion', '$turno', NULL, NULL, '$id_doctor', '$id_status_consulta', now())";
            $query = mysqli_query($conexion, $consulta);

            if($query == 1){
                ?>
                <div class= "mensaje"><a href= "#">Cita agendada correctamente</a></div>
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
}

?>