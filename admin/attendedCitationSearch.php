<?php
session_start();
include '../client/orderDate.php';

// OBTENER EL ID_DOCTOR según el ID_USUARIO
include '../client/obtenerId.php';

include '../client/connection.php';

// LÍMITE Y PÁGINA
$limite = isset($_POST['numeroRegistros']) ? $conexion->real_escape_string($_POST['numeroRegistros']) : 10;
$pagina = isset($_POST['pagina']) ? $conexion->real_escape_string($_POST['pagina']) : 0;

if ($pagina == 0){
    $inicio = 0;
    $pagina = 1;
}
else{
    $inicio = ($pagina - 1) * $limite;
}

$condicion = "LIMIT $inicio, $limite";

$consulta = "SELECT * FROM consultas INNER JOIN datos_personales INNER JOIN causa_consulta INNER JOIN doctores INNER JOIN status_consulta
ON consultas.id_paciente = datos_personales.id_dato_personal AND consultas.id_causa_consulta = causa_consulta.id_causa_consulta
AND consultas.id_doctor = doctores.id_doctor AND consultas.id_status_consulta = status_consulta.id_status_consulta
WHERE consultas.id_doctor = '$idDoctor' AND consultas.id_status_consulta = 1 ORDER BY fecha_atencion DESC
$condicion";

$query = mysqli_query($conexion, $consulta);

$resultado = mysqli_num_rows($query);

// TOTAL DE REGISTROS
$consultaSinFiltro = "SELECT count(id_consulta) FROM consultas WHERE consultas.id_doctor = '$idDoctor' AND consultas.id_status_consulta = 1";
$querySinFiltro = mysqli_query($conexion, $consultaSinFiltro);

$resultadoSinFiltro = $querySinFiltro->fetch_array();

$totalRegistros = $resultadoSinFiltro[0];

// MOSTRAR INFORMACIÓN
$contenido = [];
$contenido['totalRegistros'] = $totalRegistros;
$contenido['data'] = '';
$contenido['paginacion'] = '';

if ($resultado > 0){
    while ($respuesta = $query->fetch_assoc()){
        $fechaAtencion = ordenarFecha($respuesta['fecha_atencion']);
        $horaInicio = date("g:i a", strtotime($respuesta['hora_inicio']));
        $horaFin = date("g:i a", strtotime($respuesta['hora_fin']));

        $contenido['data'] .= '<tr>';
        $contenido['data'] .= '<td>'. $respuesta['nombre'] . ' ' . $respuesta['apellido']. '</td>';
        $contenido['data'] .= '<td>'. $respuesta['cedula']. '</td>';
        $contenido['data'] .= '<td>'. $respuesta['causa_consulta']. '</td>';
        $contenido['data'] .= '<td>'. $fechaAtencion. '</td>';
        $contenido['data'] .= '<td>'. $horaInicio . " - " . $horaFin. '</td>';
    }
}
else{
    $contenido['data'] .= '<tr>';
    $contenido['data'] .= '<td colspan="7">No se encuentran resultados</td>';
    $contenido['data'] .= '</tr>';
}

// PAGINACIÓN
if ($contenido['totalRegistros'] > 0){
    // Número de páginas necesarias
    $totalPaginas = ceil($contenido['totalRegistros'] / $limite);

    $contenido['paginacion'] .= '<nav>';
    $contenido['paginacion'] .= '<ul>';

    // Límite en la paginación
    $inicioPaginacion = 1;

    if (($pagina - 2) > 1){
        $inicioPaginacion = $pagina - 2;
    }

    $finalpaginacion = $inicioPaginacion + 5;

    if ($finalpaginacion > $totalPaginas){
        $finalpaginacion = $totalPaginas;
    }

    // Imprimir paginación
    for ($i = $inicioPaginacion; $i <= $finalpaginacion; $i++){
        if ($pagina == $i){
            $contenido['paginacion'] .= '<li class="paginaActiva"><a href="#">'. $i. '</a></li>';
        }
        else{
            $contenido['paginacion'] .= '<li><a href="#" onclick="filtrarInformacion('. $i. ')">'. $i. '</a></li>';
        } 
    }

    $contenido['paginacion'] .= '</ul>';
    $contenido['paginacion'] .= '</nav>';
}

echo json_encode($contenido, JSON_UNESCAPED_UNICODE);

?>