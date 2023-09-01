<?php

// $host = 'localhost';
// $user = 'root';
// $passwd = '';
// $nameDB = 'consultorio';
// $conexion = new mysqli($host, $user, $passwd, $nameDB);

// if($conexion->connect_error){
//     die('Error de conexión: ' . $conexion->connect_error);
// }
// if (!$conexion->set_charset("utf8")) {
//     printf("Error cargando el conjunto de caracteres utf8: %s\n", $conexion->error);
//     exit();
// }

// $tipoUsuario = "2";
// $statusUsuario = "3";

// $nombre = "alex";
// $apellido = "urdaneta";
// $cedula = "28424292";
// $nacimiento = "2000-12-13";
// $edad = "22";
// $telefono_1 = "04242124928";
// $telefono_2 = "02124812132";
// $correo = "alejandrourdaneta1213@gmail.com";
// $discapacidad = "1";
// $alergia = "2";

// $causa = "1";
// $fechaAtencion = "2023-08-30";
// $turno = "1";
// $idDoctor = "1";
// $idStatusConsulta = "3";

// $consulta = "INSERT INTO usuarios (id_usuario, usuario, clave, id_tipo_usuario, id_status_usuario, nombre, apellido, cedula, edad, fecha_nacimiento, telefono_1, telefono_2, correo, id_discapacidad, id_alergia, fecha_registro) VALUES (NULL, NULL, NULL, '$tipoUsuario', '$statusUsuario', '$nombre', '$apellido', '$cedula', '$edad', '$nacimiento', '$telefono_1', '$telefono_2', '$correo', '$discapacidad', '$alergia', now())";
// $query = mysqli_query($conexion, $consulta);

// if ($query == 1) {
// ?>
//     <!-- <div class= "mensaje"><a href= "#">Cita agendada correctamente</a></div> -->
//     <?php
//     $consulta = "SELECT id_usuario FROM usuarios WHERE cedula = '$cedula'";
//     $query1 = mysqli_query($conexion, $consulta);

//     $id_paciente = mysqli_fetch_array($query1)['id_usuario'];

//     //HACER REGISTRO EN BASE DE DATOS - TABLA CONSULTAS
//     $consulta = "INSERT INTO consultas (id_consulta, id_paciente, id_causa_consulta, fecha_atencion, id_turno_consulta, hora_inicio, hora_fin, id_doctor, id_status_consulta, fecha_solicitud) VALUES (NULL, '$id_paciente', '$causa', '$fechaAtencion', '$turno', NULL, NULL, '$idDoctor', '$idStatusConsulta', now())";
//     $query1 = mysqli_query($conexion, $consulta);

//     if ($query1) {
//     ?>
//         <div class="mensaje"><a href="#">Gay exitoso</a></div>
//     <?php
//     } else {
//         echo $id_paciente;
//         echo $cedula;
//     ?>
//         <div class="alerta"> No, maricon </div>
//     <?php
//     }
// } else {
//     ?>
//     <div class="alerta">jodio pa</div>
// <?php
// }
?>