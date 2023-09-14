<?php

include '../client/connectionSearch.php';

$conexion = new Database();
$pdo = $conexion->conectar();

$buscar = $_POST["search"];

$consulta = "SELECT * FROM datos_personales INNER JOIN cuentas ON datos_personales.id_dato_personal = cuentas.id_dato_personal
WHERE (nombre LIKE ? OR apellido LIKE ? OR cedula LIKE ?) AND id_tipo_usuario = 2 ORDER BY nombre ASC";
$query = $pdo->prepare($consulta);
$query->execute([$buscar . '%', $buscar . '%', $buscar . '%']);

$contenido = "";

while ($resultado = $query->fetch(PDO::FETCH_ASSOC)) {
    $contenido .= "<li><a href='searchPatients.php?id=".$resultado['id_dato_personal']."'>". $resultado["nombre"]. " ". $resultado["apellido"]. "<span class='cedulaSearch'> (".  $resultado["cedula"]. ") </span>". "</a></li>";
}

echo json_encode($contenido, JSON_UNESCAPED_UNICODE);

?>