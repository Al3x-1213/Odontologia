<?php

if (!empty($_POST['boton_c'])){
    // VERIFICAR QUE NO HAYAN CAMPOS VACIOS
    if (empty($_POST['cedula']) || empty($_POST['causa']) || empty($_POST['atencion']) || empty($_POST['turno']) || empty($_POST['id_doctor'])){
        ?>
        <div class= "alerta">No deben haber campos vacios</div>
        <?php
    }
    else{
        //DATOS DEL FORMULARIO
        $cedula = $_POST['cedula'];
        $causa = $_POST['causa'];
        $fechaAtencion = $_POST['atencion'];
        $turno = $_POST['turno'];
        $idDoctor = $_POST['id_doctor'];
        $idStatusConsulta = 3;

        // VERIFICAR QUE EL USUARIO CON LA CÉDULA INGRESADA SE ENCUENTRE REGISTRADO
        include '../connection.php'; //Conexión con base de datos

        $consulta = "SELECT id_dato_personal FROM datos_personales WHERE cedula = '$cedula'";
        $query = mysqli_query($conexion, $consulta);

        $resultado= mysqli_num_rows($query);

        if ($resultado == 0){
            ?>
            <div class= "alerta">Paciente no existe</div>
            <?php
        }
        else{
            $respuesta = mysqli_fetch_array($query);
            $idPaciente = $respuesta['id_dato_personal'];

            // INGRESAR LA CONSULTA A BASE DE DATOS
            $consulta = "INSERT INTO consultas (id_consulta, id_paciente, id_causa_consulta, fecha_atencion, id_turno_consulta,
            hora_inicio, hora_fin, id_doctor, id_status_consulta, fecha_solicitud) VALUES (NULL, '$idPaciente', '$causa',
            '$fechaAtencion', '$turno', NULL, NULL, '$idDoctor', '$idStatusConsulta', now())";
            $query = mysqli_query($conexion, $consulta);

            if($query){
                ?>
                <div class= "mensaje"><a href= "#">Cita agendada correctamente</a></div>
                <?php
            }
            else{
                ?>
                <div class= "alerta">No se pudo agendar la cita</div>
                <?php
            }
        }
    }
}

?>