<?php

include '../connection.php';

$idFechaBloqueada = $_GET['id'];

$consulta = "DELETE FROM fechas_bloqueadas WHERE id_fecha_bloqueada = '$idFechaBloqueada'";
$query = mysqli_query($conexion, $consulta);

if($query){
    ?>
    <div class= "mensaje">Fecha desbloqueada</div>
    <?php
}

?>