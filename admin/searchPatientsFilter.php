<?php

// include '../client/connection.php';

// $buscar = $_POST['search'];

// $consulta = "SELECT * FROM usuarios WHERE nombre LIKE ? ORDER BY nombre ASC";
// $query = $conexion->query($consulta);

// $queryy= $query->prepare($consulta);

// $query->execute([$buscar. '%']);

// $contenido = "";

// while ($resultado = mysqli_fetch_array($query)){
//     $contenido .= "<li>". $resultado['nombre']. $resultado['apellido']. "(". $resultado['cedula']. ")". "</li>";
// }

// echo json_encode($contenido, JSON_UNESCAPED_UNICODE);
// // echo json_encode($contenido);

require '../client/conexion.php';

$con = new Database();
$pdo = $con->conectar();

$search = $_POST["search"];

$sql = "SELECT * FROM usuarios WHERE nombre LIKE ? ORDER BY nombre ASC";
$query = $pdo->prepare($sql);
$query->execute([$search . '%', $search . '%']);

$html = "";

while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
	$html .= "<li>". $resultado['nombre']. $resultado['apellido']. "(". $resultado['cedula']. ")". "</li>";
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);

?>