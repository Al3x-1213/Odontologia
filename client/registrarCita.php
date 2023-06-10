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
        $id_doctor = $_POST['id_doctor'];
        $id_status_consulta = 3;

        // VERIFICAR QUE EL USUARIO CON LA CÉDULA INGRESADA SE ENCUENTRE REGISTRADO

        include '../client/conexion.php'; //Conexión con base de datos

        $consulta = "SELECT id_usuario FROM usuarios WHERE cedula = '$cedula'";
        $query = mysqli_query($conexion, $consulta);

        $resultado= mysqli_num_rows($query);

        if ($resultado == 0){
            ?>
            <div class= "alerta">Paciente no existe</div>
            <?php
        }
        else{
            $respuesta = mysqli_fetch_array($query);
            $id_paciente = $respuesta['id_usuario'];

            // INGRESAR LA CONSULTA A BASE DE DATOS
            $consulta = "INSERT INTO consultas VALUES(NULL, '$id_paciente', '$causa', '$fechaAtencion', '$turno', '', '', '$id_doctor', '$id_status_consulta', now())";
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