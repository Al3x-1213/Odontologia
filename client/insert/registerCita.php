<?php

if (!empty($_POST['boton_c'])){
    // VERIFICAR QUE NO HAYAN CAMPOS VACIOS
    if (empty($_POST['id_paciente']) || empty($_POST['causa']) || empty($_POST['atencion']) || empty($_POST['turno']) || empty($_POST['id_doctor'])){
        ?>
        <div class= "alerta">No deben haber campos vacios</div>
        <?php
    }
    else{
        //DATOS DEL FORMULARIO
        $idPaciente = $_POST['id_paciente'];
        $causa = $_POST['causa'];
        $fechaAtencion = $_POST['atencion'];
        $turno = $_POST['turno'];
        $idDoctor = $_POST['id_doctor'];
        $idStatusConsulta = 3;

        include '../connection.php'; //Conexión con base de datos

        // INGRESAR LA CONSULTA A BASE DE DATOS
        $consulta = "INSERT INTO consultas (id_consulta, id_paciente, id_causa_consulta, fecha_atencion, id_turno_consulta, hora_inicio,
        hora_fin, id_doctor, id_status_consulta, fecha_solicitud) VALUES (NULL, '$idPaciente', '$causa', '$fechaAtencion', '$turno',
        NULL, NULL, '$idDoctor', '$idStatusConsulta', now())";
        $query = mysqli_query($conexion, $consulta);
        if($query){
            session_start();
            $_SESSION['mensaje'] = "Cita registrada, en espera de confirmacion";
            $_SESSION['error'] = 3;
            header("location: ../../admin/index.php");
        }else{
            session_start();
            $_SESSION['mensaje'] = "Error al procesar la cita";
            $_SESSION['error'] = 1;
            header("location: ../../admin/index.php");
        }
    }
}

?>