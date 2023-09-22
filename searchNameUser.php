<?php

include 'client/connectionSearch.php';

$conexion1 = new Database();
$pdo = $conexion1->conectar();

$buscar = $_POST["search"];

$consulta = "SELECT * FROM cuentas WHERE usuario = '$buscar'";
$query = $pdo->prepare($consulta);

$contenido = "";

if($query->num_rows > 0){
    
}


echo json_encode($contenido, JSON_UNESCAPED_UNICODE);

?>