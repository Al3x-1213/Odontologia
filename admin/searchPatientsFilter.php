<?php

include '../client/connection.php';

$buscar = $_POST['search'];

$consulta = "SELECT nombre, apellido, cedula FROM usuarios WHERE nombre LIKE ? ORDER BY nombre ASC";
$query = $conexion->query($consulta);

$query->execute([$buscar. '%']);

$contenido = "";

while ($resultado = mysqli_fetch_array($query)){
    $contenido .= "<li>". $resultado['nombre']. $resultado['apellido']. "(". $resultado['cedula']. ")". "</li>";
}

echo json_encode($contenido, JSON_UNESCAPED_UNICODE);
?>