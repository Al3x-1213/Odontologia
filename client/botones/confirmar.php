<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$idConsulta = $_POST['id_consulta'];
$fechaAtencion = $_POST['fechaAtencion'];
$horaInicio = $_POST['hora_inicio'];
$horaFin = $_POST['hora_fin'];

// echo $idConsulta. "<br>";
// echo $fechaAtencion. "<br>";
// echo $horaInicio. "<br>";
// echo $horaFin. "<br>";


// FECHA DE ATENCIÓN
include '../orderDate.php';
$diaSemana = diaSemana($fechaAtencion); // Saber que día de la semana cae
$fecha = explode("-", $fechaAtencion); // Separar fecha
$year = $fecha[0];
$month = $fecha[1];
$day = $fecha[2];
$mesAño = mesAño($month);

// HORA DE ATENCIÓN
$horaAtencion = date("g:i a",strtotime($horaInicio)); // Cambiar a formato 12 horas

// ASIGNACIÓN DEL HORARIO EN EL QUE EL PACIENTE SERÁ ATENDIDO
include '../connection.php';

$consulta = "UPDATE consultas SET id_status_consulta = 2, hora_inicio = '$horaInicio', hora_fin = '$horaFin' WHERE id_consulta = '$idConsulta'";
// echo $consulta;
$query = mysqli_query($conexion, $consulta);

if($query){
    // echo "si";
    // OBTENER EL ID DEL PACIENTE QUE SERÁ ATENDIDO
    $consulta = "SELECT id_paciente FROM consultas WHERE id_consulta = '$idConsulta'";
    $query = mysqli_query($conexion, $consulta);

    $respuesta = mysqli_fetch_array($query);
    $idPaciente = $respuesta['id_paciente'];
    // echo $idPaciente;

    // OBTENER LA INFORMACIÓN DEL PACIENTE QUE SERÁ ATENDIDO
    $consulta = "SELECT nombre, apellido, correo FROM datos_personales WHERE id_dato_personal = '$idPaciente'";
    // echo $consulta;
    $query = mysqli_query($conexion, $consulta);

    $respuesta = mysqli_fetch_array($query);
    $nombre = $respuesta['nombre'];
    $apellido = $respuesta['apellido'];
    $correo = $respuesta['correo'];

    // echo $nombre. "<br>";
    // echo $apellido. "<br>";
    // echo $correo. "<br>";

    //ENVIAR MENSAJE DE CONFIRMACIÓN AL PACIENTE POR CORREO

    require '../../PHPMailer-6.8.1/src/PHPMailer.php';
    require '../../PHPMailer-6.8.1/src/SMTP.php';
    require '../../PHPMailer-6.8.1/src/Exception.php';

    $mail = new PHPMailer(true);

    try{
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'veroitr39@gmail.com';
        $mail->Password = 'lxhmcqkezlruxppe';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->CharSet = 'UTF-8';
        $mail->setFrom('veroitr39@gmail.com', 'Doctora Marisol Díaz');
        $mail->addAddress($correo, 'CONFIRMACIÓN DE CITA');
        $mail->addCC($correo);

        $mail->isHTML(true);
        $mail->Subject = 'CONFIRMACIÓN DE CITA';
        $mail->Body = 'Estimado/a '. $nombre. ' '. $apellido. ', '. '<br>'.
        'Le escribimos para confirmar su consulta odontológica. Su cita está programada para el '. '<b>'.
        $diaSemana. $day. ' de '. $mesAño. ' de '. $year. '</b>'. ' a las '. '<b>'. $horaAtencion. '</b>'. '<br><br>'.
        'Le recordamos que debe llegar con 15 minutos de anticipación.'. '<br><br>'.
        'Número de contacto: 0414-1369613 / 0212-2667465 / 0212-2644194'. '<br>'.
        'Dirección: <a href="https://www.google.com/maps/place/Edificio+Lucerna/@10.4923621,-66.8570139,20.29z/data=!4m14!1m7!3m6!1s0x8c2a59db0c04f0d5:0x9e88ed05b996221f!2sEdificio+Lucerna!8m2!3d10.49236!4d-66.8568355!16s%2Fg%2F11srjp38h9!3m5!1s0x8c2a59db0c04f0d5:0x9e88ed05b996221f!8m2!3d10.49236!4d-66.8568355!16s%2Fg%2F11srjp38h9?hl=es&entry=ttu">Av. Francisco de Miranda, Edif. Lucerna - PB / #4. Chacao, Caracas</a>'. '<br><br>'.
        'Esperamos atenderle pronto y brindarle el mejor servicio.'. '<br><br>'.
        'Atentamente,'. '<br>'.
        '<b>'. 'Consultorio Odontológico Marisol Díaz'. '</b>';
        $mail->send();
        
        echo "Confirmación de cita enviada correctamente";
    }
    catch (Exception $e) {
        echo 'Mensaje ' . $mail->ErrorInfo;
    }
    // header('location: ../../admin/porConfirmar.php');
}

?>