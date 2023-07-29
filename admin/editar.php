<?php
include '../client/verificacion_sesion.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <!-- META ETIQUETAS -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- ESTILOS CSS -->
  <link rel="stylesheet" href="../styles/normalize.css">
  <link rel="stylesheet" href="../Iconos/style.css">
  <link rel="stylesheet" href="../styles/login.css">

  <!-- LETRAS UTILIZADAS -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">

  <title>Consultorio Riccio</title>
</head>

<?php 

$id = $_GET['id'];

include '../client/conexion.php';
$consulta = "SELECT * FROM usuarios WHERE id_usuario = '$id'";
$select = ($conexion->query($consulta));

$resultado = mysqli_fetch_array($select);
?>

<body>
  <div class="flex__container">
    <form class="form form__alternative" method="POST">

      <!-- TITULO -->
      <h2 class="title__form"><a href="pacientes.php">Editar</a></h2>

      <div class="fields__form">

        <label for="nombre">Nombre:</label>
        <input type="text" maxlength="30" required="true" name="nombre" class="input__form" autocomplete="off" value="<?php echo $resultado['nombre'] ?>">

        <label for="apellido">Apellido:</label>
        <input type="text" maxlength="30" required="true" name="apellido" class="input__form" value="<?php echo $resultado['apellido'] ?>">

        <label for="edad">Edad:</label>
        <input type="number" maxlength="2" required="true" name="edad" class="input__form" value="<?php echo $resultado['edad'] ?>">

        <label for="cedula">Cedula:</label>
        <input type="number" maxlength="8" required="true" name="cedula" class="input__form" value="<?php echo $resultado['cedula'] ?>">

        <label for="numero">Numero de Telefono:</label>
        <input type="number" maxlength="11" required="true" name="numero" class="input__form" value="<?php echo $resultado['numero'] ?>">

        <label for="correo">Correo:</label>
        <input type="email" maxlength="60" required="true" name="correo" class="input__form" autocomplete="off" value="<?php echo $resultado['correo'] ?>">

        <input class="button" type="submit" value="Enviar">

      </div>

    </form>
  </div>
  <?php mysqli_close($conexion) ?>
</body>
</html>