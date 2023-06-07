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

        //Fecha de nacimiento
        $nacimiento = $_POST['nacimiento'];

        $fecha_separada = explode('-', $nacimiento);
        $day = $fecha_separada[2];
        $month = $fecha_separada[1];
        $yearN = $fecha_separada[0];

        //Fecha Actual
        date_default_timezone_set('America/Caracas');

        $fecha_actual = getdate();

        $day_actual = $fecha_actual['mday'];
        $month_actual = $fecha_actual['mon'];
        $year_actual = $fecha_actual['year'];

        //Edad

        if($month_actual > $month){
            $edad = $year_actual - $yearN;
        }
        elseif($month_actual == $month && $day_actual == $day){
            $edad = $year_actual - $yearN;
        }
        elseif($month_actual == $month && $day_actual > $day){
            $edad = $year_actual - $yearN;
        }
        elseif($month_actual == $month && $day_actual < $day){
            $edad = $year_actual - $yearN;
            $edad = $edad - 1;
        }
        else{
            $edad = $year_actual - $yearN;
            $edad = $edad - 1;
        }

        //HACER REGISTRO EN BASE DE DATOS
        include '../client/conexion.php'; //Conexión con base de datos

        $consulta = "INSERT INTO usuarios VALUES(NULL, '', '', '$tipo_usuario', '$status_usuario', '$nombre',
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

            $consulta = "INSERT INTO consultas VALUES(NULL, '$id_paciente', '$causa', '$fechaAtencion', '$turno', '', '', '$id_doctor', '$id_status_consulta', now())";
            $query = mysqli_query($conexion, $consulta);

            if($query){
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