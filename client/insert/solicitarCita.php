<?php

if (!empty($_POST['boton_c'])){
    // VERIFICAR QUE NO HAYAN CAMPOS VACIOS
    if (empty($_POST['causa']) || empty($_POST['atencion']) || empty($_POST['turno']) || empty($_POST['doctor'])){
        ?>
        <div class= "alerta">No deben haber campos vacios</div>
        <?php
    }
    else{
        // VARIABLE GLOBAL: ID DEL USUARIO LOGUEADO
        $idCuenta = $_SESSION['id'];

        //DATOS DEL FORMULARIO
        $causa = $_POST['causa'];
        $fechaAtencion = $_POST['atencion'];
        $turno = $_POST['turno'];
        $idDoctor = $_POST['doctor'];
        $idStatusConsulta = 3;

        // CAPTURAR EL ID DE LOS DATOS PERSONALES
        include '../client/connection.php'; //Conexión con base de datos

        $consulta = "SELECT id_dato_personal FROM cuentas WHERE id_cuenta = '$idCuenta'";
        $query = mysqli_query($conexion, $consulta);
        
        $respuesta = mysqli_fetch_array($query);
        $idPaciente = $respuesta['id_dato_personal'];

        // COMPROBAR QUE EL PACIENTE NO TENGA UNA CITA POR ATENDER
        $consulta = "SELECT id_consulta FROM consultas WHERE id_paciente = '$idPaciente' AND (id_status_consulta = 3 OR id_status_consulta = 2)";
        $query = mysqli_query($conexion, $consulta);

        $resultado= mysqli_num_rows($query);

        if ($resultado == 1){
            ?>
            <div class= "mensaje"><a href= "index.php">Solicitud no enviada. Ya tiene una cita por atender</a></div>
            <?php
        }
        else{
            // INGRESAR LA CONSULTA A BASE DE DATOS
            $consulta = "INSERT INTO consultas (id_consulta, id_paciente, id_causa_consulta, fecha_atencion, id_turno_consulta,
            hora_inicio, hora_fin, id_doctor, id_status_consulta, fecha_solicitud) VALUES(NULL, '$idPaciente', '$causa',
            '$fechaAtencion', '$turno', NULL, NULL, '$idDoctor', '$idStatusConsulta', now())";
            $query = mysqli_query($conexion, $consulta);

            if($query){
                ?>
                <div class= "mensaje"><a href= "index.php">Su solicitud fue enviada correctamente</a></div>
                <?php
            }
            else{
                ?>
                <div class= "alerta">No se pudo realizar la solicitud</div>
                <?php
            }
        }
    }
}

?>