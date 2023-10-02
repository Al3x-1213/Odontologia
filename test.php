<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST">
        <select name="pref">
            <option value="0"> --- </option>
            <option value="0424"> 0424 </option>
            <option value="0212"> 0212 </option>
        </select>

        <input type="text" name="telefono">
        <input type="submit">
    </form>
</body>

<?php

$cadena = "hola mundo";

$cadenaMayuscula = ucfirst($cadena);

// echo $cadena. "<br>";
// echo $cadenaMayuscula. "<br>";

$cadenaMayusculaL = ucwords($cadena);
// echo $cadenaMayusculaL. "<br>";

// *****************************************

$cadena = "hOLa muNdO";
echo $cadena. "<br>";
$cadena = strtolower($cadena);
echo $cadena. "<br>";
$cadena = ucwords($cadena);
echo $cadena. "<br>";




?>
</html>