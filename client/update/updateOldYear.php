<?php

$fechaActualT = explode("-", $fechaActual);

$fechaActualT2 = $fechaActualT[1]."-".$fechaActualT[2];

$consulta = "SELECT * FROM datos_personales WHERE fecha_nacimiento LIKE '%$fechaActualT2'";
$query = mysqli_query($conexion, $consulta);

while($resultado = mysqli_fetch_array($query)){
    $NewYearOld = $resultado['edad']+1;
    $idDatosPersonalesE = $resultado['id_dato_personal'];

    $consulta2 = "UPDATE datos_personales SET edad = '$NewYearOld' WHERE id_dato_personal = '$idDatosPersonalesE'";
    $query2 = mysqli_query($conexion, $consulta2);
}

mysqli_close($conexion);

?>
