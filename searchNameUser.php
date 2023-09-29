<?php

include 'client/connectionSearch.php';

$conexion = new Database();
$pdo = $conexion->conectar();

$buscar = $_POST["usuario"];

$consulta = "SELECT id_cuenta FROM cuentas WHERE usuario = ?";
$query = $pdo->prepare($consulta);
$query->execute([$buscar]);

$contenido = "";

while ($resultado = $query->fetch(PDO::FETCH_ASSOC)){
    $contenido .= "<p class='paragraf__error3'>Este nombre de usuario ya se encuentra registrado</p>";
}

echo json_encode($contenido, JSON_UNESCAPED_UNICODE);

?>