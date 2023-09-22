<?php

include 'client/connectionSearch.php';

$conexion = new Database();
$pdo = $conexion->conectar();

$buscar = $_POST["cedula"];

$consulta = "SELECT id_dato_personal FROM datos_personales WHERE cedula = ?";
$query = $pdo->prepare($consulta);
$query->execute([$buscar]);

$contenido = "";

while ($resultado = $query->fetch(PDO::FETCH_ASSOC)){
    $contenido .= "<p class='paragraf__error'>Número de cédula registrado <i class='icon-warning'></i></p>";
}

echo json_encode($contenido, JSON_UNESCAPED_UNICODE);

?>