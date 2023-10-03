<?php
include '../client/orderDate.php';

include '../client/connection.php';

$buscar = isset($_POST['searchUser']) ? $conexion->real_escape_string($_POST['searchUser']) : null;

$columnas = ['nombre', 'apellido', 'cedula'];
$busqueda = '';

// BUSQUEDA SI HAY ALGO EN EL INPUT
if ($buscar != null){
    $busqueda = "WHERE (";

    for ($i = 0; $i < 3; $i++){
        $busqueda .= $columnas[$i]. " LIKE '". $buscar. "%' OR ";
    }

    $busqueda = substr_replace($busqueda, "", -3);
    $busqueda .= ")";
}

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

// CONSULTA A BASE DE DATOS
$consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM datos_personales INNER JOIN alergias INNER JOIN discapacidades
ON datos_personales.id_alergia = alergias.id_alergia AND datos_personales.id_discapacidad = discapacidades.id_discapacidad
$busqueda $condicion";
$query = mysqli_query($conexion, $consulta);

$resultado = mysqli_num_rows($query);

// TOTAL DE REGISTROS FILTRADOS
$consultaFiltro = "SELECT FOUND_ROWS()";
$queryFiltro = mysqli_query($conexion, $consultaFiltro);

$resultadoFiltro = $queryFiltro->fetch_array();

$totalFiltro = $resultadoFiltro[0];

// TOTAL DE REGISTROS
$consultaSinFiltro = "SELECT count(id_dato_personal) FROM datos_personales";
$querySinFiltro = mysqli_query($conexion, $consultaSinFiltro);

$resultadoSinFiltro = $querySinFiltro->fetch_array();

$totalRegistros = $resultadoSinFiltro[0];

// MOSTRAR INFORMACIÓN
$contenido = [];
$contenido['totalRegistros'] = $totalRegistros;
$contenido['totalFiltro'] = $totalFiltro;
$contenido['data'] = '';
$contenido['paginacion'] = '';

if ($resultado > 0){
    while ($respuesta = $query->fetch_assoc()){
        $fechaNacimiento = ordenarFecha($respuesta['fecha_nacimiento']);

        $contenido['data'] .= '<tr>';
        $contenido['data'] .= '<td>'. $respuesta['nombre'] . ' ' . $respuesta['apellido']. '</td>';
        $contenido['data'] .= '<td>'. $respuesta['cedula']. '</td>';
        $contenido['data'] .= '<td>'. $respuesta['edad']. '</td>';
        $contenido['data'] .= '<td>'. $fechaNacimiento. '</td>';
        $contenido['data'] .= '<td>'. $respuesta['telefono_1']. '<br>'. $respuesta['telefono_2']. '</td>';
        $contenido['data'] .= '<td>'. $respuesta['correo']. '</td>';
        $contenido['data'] .= '<td>'. $respuesta['alergia']. '</td>';
        $contenido['data'] .= '<td>'. $respuesta['discapacidad']. '</td>';
        
        $idDatoPersonal = $respuesta['id_dato_personal'];

        $consulta2 = "SELECT id_cuenta FROM cuentas INNER JOIN datos_personales
        ON cuentas.id_dato_personal = datos_personales.id_dato_personal
        WHERE datos_personales.id_dato_personal = '$idDatoPersonal'";
        $query2 = mysqli_query($conexion, $consulta2);

        $resultado2= mysqli_num_rows($query2);

        if ($resultado2 == 0){
            $contenido['data'] .= '<td><a href="updateInformationUser.php?id='. $respuesta['id_dato_personal']. '"><button title="Modificar" class="update"><i class="icon-pencil icon"></i></button></a>
            <a><button title="Sin cuenta" class="noUser"><i class="icon-user-times icon"></i></button></a></td>';        
            $contenido['data'] .= '</tr>';
        }
        else{
            $respuesta2 = mysqli_fetch_array($query2);
            $idCuenta = $respuesta2['id_cuenta'];

            $consulta3 = "SELECT id_status_usuario FROM cuentas WHERE id_cuenta = '$idCuenta'";
            $query3 = mysqli_query($conexion, $consulta3);

            $respuesta3 = mysqli_fetch_array($query3);
            $idStatusUsuario = $respuesta3['id_status_usuario'];

            if ($idStatusUsuario == 1){
                $contenido['data'] .= '<td><a href="updateInformationUser.php?id='. $respuesta['id_dato_personal']. '"><button title="Modificar" class="update"><i class="icon-pencil icon"></i></button></a>
                <a href="../client/botones/inactive.php?id='. $respuesta['id_dato_personal']. '"><button title="Desactivar" class="inactive"><i class="icon-toggle-on icon"></i></button></a></td>';        
                $contenido['data'] .= '</tr>';
            }
            elseif ($idStatusUsuario == 2){
                $contenido['data'] .= '<td><a href="updateInformationUser.php?id='. $respuesta['id_dato_personal']. '"><button title="Modificar" class="update"><i class="icon-pencil icon"></i></button></a>
                <a href="../client/botones/active.php?id='. $respuesta['id_dato_personal']. '"><button title="Activar" class="active"><i class="icon-toggle-on icon"></i></button></a></td>';        
                $contenido['data'] .= '</tr>';
            }
        }
    }
}
else{
    $contenido['data'] .= '<tr>';
    $contenido['data'] .= '<td colspan="9">No se encuentran resultados</td>';
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