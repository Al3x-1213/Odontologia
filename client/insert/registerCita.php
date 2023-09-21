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

        // COMPROBAR QUE EL PACIENTE NO TENGA UNA CITA POR ATENDER
        include '../connection.php'; //Conexión con base de datos

        $consulta = "SELECT id_consulta FROM consultas WHERE id_paciente = '$idPaciente' AND (id_status_consulta = 3 OR id_status_consulta = 2)";
        $query = mysqli_query($conexion, $consulta);

        $resultado= mysqli_num_rows($query);

        if ($resultado == 1){
            $consulta = "SELECT nombre, apellido FROM datos_personales WHERE id_dato_personal = '$idPaciente'";
            $query = mysqli_query($conexion, $consulta);

            $respuesta = mysqli_fetch_array($query);
            $nombre = $respuesta['nombre'];
            $apellido = $respuesta['apellido'];

            ?>
            <div class= "alerta"><a href= "index.php">Solicitud no enviada</a></div>
            <div class= "alerta"><a href= "index.php"><?php echo $nombre. " ". $apellido; ?> ya tiene una cita por atender</a></div>
            <?php
        }
        else{
             // INGRESAR LA CONSULTA A BASE DE DATOS
            $consulta = "INSERT INTO consultas (id_consulta, id_paciente, id_causa_consulta, fecha_atencion, id_turno_consulta, hora_inicio,
            hora_fin, id_doctor, id_status_consulta, fecha_solicitud) VALUES (NULL, '$idPaciente', '$causa', '$fechaAtencion', '$turno',
            NULL, NULL, '$idDoctor', '$idStatusConsulta', now())";
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