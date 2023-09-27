<?php

include '../../client/connectionSearch.php';

$conexion = new Database();
$pdo = $conexion->conectar();

$tipoPaciente = $_POST["tipoPaciente"];

if ($tipoPaciente == 2){
    $consulta = "SELECT * FROM causa_consulta WHERE id_seguro = 2";
    $query = $pdo->prepare($consulta);
    $query->execute();

    $contenido = '<option value="0"></option>';

    while ($respuesta = $query->fetch(PDO::FETCH_ASSOC)){
        $contenido .= '<option value="'. $respuesta['id_causa_consulta']. '">'. $respuesta['codigo']. ' - '. $respuesta['causa_consulta']. '</option>';
    }
}
elseif ($tipoPaciente == 1){
    $consulta = "SELECT * FROM causa_consulta";
    $query = $pdo->prepare($consulta);
    $query->execute();

    $contenido = '<option value="0"></option>';

    while ($respuesta = $query->fetch(PDO::FETCH_ASSOC)){
        $contenido .= '<option value="'. $respuesta['id_causa_consulta']. '">'. $respuesta['codigo']. ' - '. $respuesta['causa_consulta']. '</option>';
    }
}
elseif ($tipoPaciente == 0){
    $contenido = '<option value="0"></option>';
}

echo json_encode($contenido, JSON_UNESCAPED_UNICODE);

?>