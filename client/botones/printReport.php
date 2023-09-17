<?php
include '../verificationSessionAdmin.php';

include '../orderDate.php';
?>
<?php

date_default_timezone_set('America/Caracas');
$fechaActual = date("Y-m-d");

// OBTENER EL ID_DOCTOR SEGÚN EL ID_USUARIO
include '../obtenerId.php';
        
// OBTENER LA INFORMACIÓN DE LAS CITAS PARA EL DÍA ACTUAL
include '../connection.php';

$consulta = "SELECT * FROM consultas INNER JOIN datos_personales INNER JOIN causa_consulta INNER JOIN doctores
ON consultas.id_paciente = datos_personales.id_dato_personal AND causa_consulta.id_causa_consulta = consultas.id_causa_consulta AND doctores.id_doctor = consultas.id_doctor
WHERE consultas.id_status_consulta = 2 AND consultas.fecha_atencion = '$fechaActual' AND consultas.id_doctor = '$idDoctor'
ORDER BY hora_inicio ASC";
// echo $consulta;
$query = mysqli_query($conexion, $consulta);

$fechaActual = ordenarFecha($fechaActual);


// GENERAR PDF CON LA INFORMACIÓN NECESARIA
use Dompdf\Dompdf;

include '../../Dompdf/autoload.inc.php';

$domPdf = new Dompdf();

$html = '
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../../admin/styles/report.css">
    </head>
    <body>
        <h2>'. $fechaActual. '</h2>

        <table>
            <thead>
                <tr>
                    <th>Paciente</th>
                    <th>Cédula</th>
                    <th>Motivo de la Consulta</th>
                    <th>Hora de Atención</th>
                    <th>Teléfono</th>
                </tr>
            </thead>
            <tbody>'.
                while ($resultado = mysqli_fetch_array($query)){.
                    '<tr>
                        <td></td>
                    </tr>'.
                }.
            '</tbody>
        </table>

    </body>
</html>
';

$domPdf->set_paper ('a4','landscape');
$domPdf->load_html($html);
$domPdf->render();
$domPdf->stream("documento.pdf", array('Attachment' => '0'));
// $domPdf->stream('documento.pdf');

?>
<table>
    <thead>
        <tr>
            <th>Paciente</th>
            <th>Cédula</th>
            <th>Motivo de la Consulta</th>
            <th>Hora de Atención</th>
            <th>Teléfono</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td></td>
        </tr>
    </tbody>
</table>


