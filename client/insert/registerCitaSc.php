<?php

if (!empty($_POST['boton_c'])){
    // VERIFICAR QUE NO HAYAN CAMPOS VACIOS
    if (empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['cedula']) || empty($_POST['nacimiento'])
    || empty($_POST['telefono1']) || empty($_POST['correo']) || empty($_POST['discapacidad']) || empty($_POST['alergia'])
    || empty($_POST['causa']) || empty($_POST['atencion']) || empty($_POST['turno']) || empty($_POST['id_doctor'])){
        ?>
        <div class= "alerta">No deben haber campos vacios</div>
        <?php
    }
    else{
        //DATOS DEL FORMULARIO
        $tipoUsuario = "2";
        $statusUsuario = "3";

        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $cedula = $_POST['cedula'];
        $nacimiento = $_POST['nacimiento'];
        $telefono_1 = $_POST['telefono1'];
        $telefono_2 = $_POST['telefono2'];
        $correo = $_POST['correo'];
        $discapacidad = $_POST['discapacidad'];
        $alergia = $_POST['alergia'];

        $causa = $_POST['causa'];
        $fechaAtencion = $_POST['atencion'];
        $turno = $_POST['turno'];
        $idDoctor = $_POST['id_doctor'];
        $idStatusConsulta = 3;

        // CALCULAR EDAD
        include '../../client/calcularEdad.php';

        //HACER REGISTRO EN BASE DE DATOS - TABLA DATOS_PERSONALES
        include '../../client/connection.php'; //Conexión con base de datos

        $consulta = "INSERT INTO datos_personales (id_dato_personal, nombre, apellido, cedula, edad, fecha_nacimiento, telefono_1,
        telefono_2, correo, id_discapacidad, id_alergia, fecha_registro) VALUES (NULL, '$nombre', '$apellido', '$cedula',
        '$edad', '$nacimiento', '$telefono_1', '$telefono_2', '$correo', '$discapacidad', '$alergia', now())";
        $query = mysqli_query($conexion, $consulta);

        if($query){
            $consulta = "SELECT id_dato_personal FROM datos_personales WHERE cedula = '$cedula'";
            $query = mysqli_query($conexion, $consulta);

            $resultado = mysqli_fetch_array($query);
            $idPaciente = $resultado['id_dato_personal'];

            //HACER REGISTRO EN BASE DE DATOS - TABLA CONSULTAS
            $consulta = "INSERT INTO consultas (id_consulta, id_paciente, id_causa_consulta, fecha_atencion, id_turno_consulta,
            hora_inicio, hora_fin, id_doctor, id_status_consulta, fecha_solicitud) VALUES (NULL, '$idPaciente', '$causa',
            '$fechaAtencion', '$turno', NULL, NULL, '$idDoctor', '$idStatusConsulta', now())";
            $query = mysqli_query($conexion, $consulta);

            if($query){
                ?>
                <div class= "mensaje"><a href= "../index.php">Cita agendada correctamente</a></div>
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
            <div class= "alerta">No se pudo realizar el aja</div>
            <?php
        }
    }
}

?>