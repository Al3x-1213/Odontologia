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

$telefono = $_POST['telefono'];
$pref = $_POST['pref'];

$numero = $pref.$telefono;

echo "<br><br>".strlen($numero);

if(strlen($numero) != 11){
    echo "hola mundo";
}
?>
</html>