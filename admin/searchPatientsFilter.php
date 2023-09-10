<?php

include '../client/connectionSearch.php';

$conexion = new Database();
$pdo = $conexion->conectar();

$buscar = $_POST["search"];

$consulta = "SELECT nombre, apellido, cedula FROM usuarios WHERE nombre LIKE ? OR apellido LIKE ? OR cedula LIKE ? ORDER BY nombre ASC";
$query = $pdo->prepare($consulta);
$query->execute([$buscar . '%', $buscar . '%', $buscar . '%']);

$contenido = "";

while ($resultado = $query->fetch(PDO::FETCH_ASSOC)) {
    // $contenido .= "<li onclick=\"mostrar('" . $resultado["nombre"] . "')\">" . $resultado["nombre"] . " - " . $resultado["apellido"] . "</li>";
    $contenido .= "<li><a>". $resultado["nombre"]. " ". $resultado["apellido"]. " (".  $resultado["cedula"]. ")". "</a></li>";
}

echo json_encode($contenido, JSON_UNESCAPED_UNICODE);

?>