<?php
include '../client/orderDate.php';

include '../client/connection.php';

// $buscar = $_POST['search'];
$buscar = isset($_POST['searchUser']) ? $conexion->real_escape_string($_POST['searchUser']) : null;

$columnas = ['nombre', 'apellido', 'cedula'];
$busqueda = '';

if ($buscar != null){
    $busqueda = "WHERE (";

    for ($i = 0; $i < 3; $i++){
        $busqueda .= $columnas[$i]. " LIKE '". $buscar. "%' OR ";
    }

    $busqueda = substr_replace($busqueda, "", -3);
    $busqueda .= ")";
}

$consulta = "SELECT * FROM datos_personales $busqueda ";
$query = mysqli_query($conexion, $consulta);

$resultado = mysqli_num_rows($query);

$contenido = '';

if ($resultado > 0){
    while ($respuesta = $query->fetch_assoc()){
        $fechaNacimiento = ordenarFecha($respuesta['fecha_nacimiento']);

        $contenido .= '<tr>';
        $contenido .= '<td>'. $respuesta['nombre'] . ' ' . $respuesta['apellido']. '</td>';
        $contenido .= '<td>'. $respuesta['cedula']. '</td>';
        $contenido .= '<td>'. $respuesta['edad']. '</td>';
        $contenido .= '<td>'. $fechaNacimiento. '</td>';
        $contenido .= '<td>'. $respuesta['telefono_1']. ' '. $respuesta['telefono_2']. '</td>';
        $contenido .= '<td>'. $respuesta['correo']. '</td>';        
        $contenido .= '<td><a href="../client/botones/update.php?id='. $respuesta['id_dato_personal']. '"><button title="Modificar" class="update"><i class="icon-pencil icon"></i></button></a>
        <a href="../client/eliminar.php?id='. $respuesta['id_dato_personal']. '"><button title="Eliminar" class="delete"><i class="icon-bin icon"></i></button></a></td>';        
        $contenido .= '</tr>';
    }
}
else{
    $contenido .= '<tr>';
    $contenido .= '<td colspan="7">No se encuentran resultados</td>';
    $contenido .= '</tr>';
}

echo json_encode($contenido, JSON_UNESCAPED_UNICODE);

?>