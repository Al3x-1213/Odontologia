<?php

include '../client/connectionSearch.php';
include '../client/orderDate.php';

$conexion = new Database();
$pdo = $conexion->conectar();

$buscar = $_POST["atencion"];

$diaSemana = diaSemana($buscar);

$contenido = "";

if ($diaSemana == "Sábado " || $diaSemana == "Domingo "){
    $contenido .= "<p>Fecha no disponible</p>";
}
else{
    $consulta = "SELECT id_fecha_bloqueada FROM fechas_bloqueadas WHERE fecha_bloqueada = ?";
    $query = $pdo->prepare($consulta);
    $query->execute([$buscar]);

    while ($resultado = $query->fetch(PDO::FETCH_ASSOC)){
        $contenido .= "<p>Fecha no disponible</p>";
    }
}

echo json_encode($contenido, JSON_UNESCAPED_UNICODE);

?>