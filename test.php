<?php
session_start();
ob_start();
$_SESSION['mesaje'] = 1;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/mensajes.css">
    <link rel="stylesheet" href="Iconos/style.css">

    <title>Marisol Díaz - ADMINISTRADOR</title>
</head>

<!-- <body>
    <form method="post" action="client/blockCitation.php">

        <label> Fecha: </label>
        <input type="date" name="fecha">

        <label> Turno:</label>
        <input type="radio" value="1" name="turno"> Mañana
        <input type="radio" value="2" name="turno"> Tarde

        <input type="submit" value="enviar">
    </form>
</body> -->

<div class="messagge messagge__error"> malo washu washu washu <i class="icon-cross messagge__icon"></i> </div>

</html>