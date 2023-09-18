<?php
include '../client/orderDate.php';

include '../client/connection.php';

$buscar = $_POST['search'];

$consulta = "SELECT * FROM datos_personales";
$query = mysqli_query($conexion, $consulta);

$resultado = mysqli_num_rows($query);

$contenido = '';

if ($resultado > 0){
    while ($resultado = $query->fetch_assoc()){
        $fechaNacimiento = ordenarFecha($resultado['fecha_nacimiento']);

        $contenido .= '<tr>';
        $contenido .= '<td>'. $resultado['nombre'] . ' ' . $resultado['apellido']. '</td>';
        $contenido .= '<td>'. $resultado['cedula']. '</td>';
        $contenido .= '<td>'. $resultado['edad']. '</td>';
        $contenido .= '<td>'. $fechaNacimiento. '</td>';
        $contenido .= '<td>'. $resultado['telefono_1']. ' '. $resultado['telefono_2']. '</td>';
        $contenido .= '<td>'. $resultado['correo']. '</td>';        
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