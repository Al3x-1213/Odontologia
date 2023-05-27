<!-- // session_start();
// ob_start();
// $sesion = $_SESSION['sesion'];
// $_SESSION['admin'] = 1;
// if ($sesion == null || $sesion == 0) {
//   header('location:../index.php');
//   session_unset();
//   die();
// }; -->

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- ESTILOS CSS -->
  <link rel="stylesheet" href="../styles/normalize.css">
  <link rel="stylesheet" href="styles/menu.css">
  <link rel="stylesheet" href="styles/index.css">
  <link rel="stylesheet" href="styles/footer.css">
  <link rel="stylesheet" href="styles/modal.css">
  <link rel="stylesheet" href="../Iconos/style.css">

  <!-- LETRAS UTILIZADAS -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Raleway:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap" rel="stylesheet">

  <title>Consultorio Riccio - ADMINISTRADOR</title>
</head>

<body>
  <?php

  echo "hola";  

  include '../client/conexion.php';
  $consulta = "SELECT nombre AND apellido FROM usuarios WHERE id_usuario = 1";
  $select = $conexion->query($consulta);
  $respuesta = mysqli_fetch_array($select);
  echo $respuesta['nombre'] . " " . $respuesta['apellido'];
  ?>
</body>

</html>