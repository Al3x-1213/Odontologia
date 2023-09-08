<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Marisol Díaz - ADMINISTRADOR</title>
    </head>
</html>
<form method="post">
    <label> Paciente: </label>
    <input type="text" name="paciente">

    <input type="submit" value="enviar">
</form>

<?php

include 'client/connection.php';

$dato = $_POST['paciente'];

$consulta="SELECT * FROM usuarios WHERE cedula = '$dato' AND id_tipo_usuario = 2";
$query = mysqli_query($conexion, $consulta);

$respuesta = mysqli_fetch_array($query);

if(!empty($respuesta)){
    echo "este paciente es " . $respuesta['nombre'] . " " . $respuesta['apellido'] . " y su cedula es " . $respuesta['cedula'];
}else{
    $consulta="SELECT * FROM usuarios WHERE nombre = '$dato' AND id_tipo_usuario = 2";
    $query = mysqli_query($conexion, $consulta);

    while($respuesta=mysqli_fetch_array($query)){
        echo $respuesta['nombre'] . " " . $respuesta['apellido'] . " " . $respuesta['cedula'] . "<br><br>";
    }
}

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
// 
?>
// <!-- <div class= "mensaje"><a href= "#">Cita agendada correctamente</a></div> -->
// <?php
    //     $consulta = "SELECT id_usuario FROM usuarios WHERE cedula = '$cedula'";
    //     $query1 = mysqli_query($conexion, $consulta);

    //     $id_paciente = mysqli_fetch_array($query1)['id_usuario'];

    //     //HACER REGISTRO EN BASE DE DATOS - TABLA CONSULTAS
    //     $consulta = "INSERT INTO consultas (id_consulta, id_paciente, id_causa_consulta, fecha_atencion, id_turno_consulta, hora_inicio, hora_fin, id_doctor, id_status_consulta, fecha_solicitud) VALUES (NULL, '$id_paciente', '$causa', '$fechaAtencion', '$turno', NULL, NULL, '$idDoctor', '$idStatusConsulta', now())";
    //     $query1 = mysqli_query($conexion, $consulta);

    //     if ($query1) {
    //     
    ?>
<!-- //         <div class="mensaje"><a href="#">Gay exitoso</a></div> -->
// <?php
    //     } else {
    //         echo $id_paciente;
    //         echo $cedula;
    //     
    ?>
<!-- //         <div class="alerta"> No, maricon </div> -->
// <?php
    //     }
    // } else {
    //     
    ?>
<!-- //     <div class="alerta">jodio pa</div> -->
// <?php
    // }
    ?>

<?php

// $usuario = $_POST['usuario'];
// $clave = $_POST['clave'];
// $claveConfirm = $_POST['clave2'];
// $tipo_usuario = "2";
// $status_usuario = "1";

// $nombre = $_POST['nombre'];
// $apellido = $_POST['apellido'];
// $cedula = $_POST['cedula'];
// $nacimiento = $_POST['nacimiento'];
// $telefono_1 = $_POST['telefono1'];
// $telefono_2 = $_POST['telefono2'];
// $correo = $_POST['correo'];
// $discapacidad = $_POST['discapacidad'];
// $alergia = $_POST['alergia'];

// include "client/calcularEdad.php";

// echo $usuario;
// echo "<br><br>";
// echo $clave;
// echo "<br><br>";
// echo $claveConfirm;
// echo "<br><br>";
// echo $tipo_usuario;
// echo "<br><br>";
// echo $status_usuario;
// echo "<br><br>";
// echo $nombre;
// echo "<br><br>";
// echo $apellido;
// echo "<br><br>";
// echo $cedula;
// echo "<br><br>";
// echo $nacimiento;
// echo "<br><br>";
// echo $edad;
// echo "<br><br>";
// echo $telefono_1;
// echo "<br><br>";
// echo $telefono_2;
// echo "<br><br>";
// echo $correo;
// echo "<br><br>";
// echo $discapacidad;
// echo "<br><br>";
// echo $alergia;
// echo "<br><br>";

?>