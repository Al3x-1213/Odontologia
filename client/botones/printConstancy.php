<?php

date_default_timezone_set('America/Caracas');
$fechaActual = date("Y-m-d");

// FECHA DE ATENCIÓN
include '../orderDate.php';
$diaSemana = diaSemana($fechaActual); // Saber que día de la semana cae
$fecha = explode("-", $fechaActual); // Separar fecha
$year = $fecha[0];
$month = $fecha[1];
$day = $fecha[2];
$mesAño = mesAño($month);

// OBTENER LA INFORMACIÓN DEL PACIENTE
$idPaciente = $_GET['id'];

include '../connection.php';

$consulta = "SELECT nombre, apellido, cedula, edad FROM datos_personales WHERE id_dato_personal = '$idPaciente'";
$query = mysqli_query($conexion, $consulta);

$respuesta = mysqli_fetch_array($query);
$nombre = $respuesta['nombre'];
$apellido = $respuesta['apellido'];
$cedula = $respuesta['cedula'];
$edad = $respuesta['edad'];

// GENERAL PDF CON LA INFORMACIÓN NECESARIA
use Dompdf\Dompdf;

include '../../Dompdf/autoload.inc.php';

$domPdf = new Dompdf();

$html = '
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../../admin/styles/constancia.css">
    </head>
    <body>
        <header>
            <div class="encabezado">
                <div class="imagen">
                    <img src="../../img/documento.png">
                </div>
                <div class="informacion">
                    <p class="linea1">Dra. Marisol Díaz Aira</p>
                    <p class="linea2">Odontólogo / Estética - Protesis</p>
                    <p class="linea3">odontologiamarisoldiaz@gmail.com</p>
                </div>
            </div>
        </header>

        <div class="franja">
            `
        </div>

        <div class="cuerpo">
            <h1>CONSTANCIA MÉDICA</h1>

            <div class="contenido">
            <p class="parrafo1">Por medio de la presente hago constar que el paciente '. '<b>'. $nombre. ' '. $apellido. '</b>'. ' de '. '<b>'. $edad. ' años'. '</b>'. ' de edad, portador de la cédula de identidad '. '<b>'.  'V-'. $cedula. '</b>'. ', asistió a una cita odontológica el día '. '<b>'. $diaSemana. ' '. $day. ' de '. $mesAño. ' de '. $year. '</b>'. '.'. '</p>
            <p class="parrafo2">Constancia que expide a petición de la parte interesada.</p>
            </div>

            <div class="atentamente">
                <p class="linea1">Atentamente</p>
                <p class="linea2">Dra. Marisol Díaz</p>
            </div>
        </div>

        <div class="franja">
            `
        </div>

        <div class="pie">
            <p class="linea1">Av. Francisco de Miranda, Edif. Lucerna - PB / #4. Chacao, Caracas</p>
            <p class="linea2">Telfs.: 0414 1369613 - 0212 2667455 / 2644194</p>
        </div>
    </body>
</html>
';

$domPdf->load_html($html);
$domPdf->render();
$domPdf->stream("documento.pdf", array('Attachment' => '0'));
// $domPdf->stream('documento.pdf');

?>



