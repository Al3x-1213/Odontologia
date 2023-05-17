<?php
session_start();
ob_start();
$sesion = $_SESSION['sesion'];
$_SESSION['admin'] = 1;
if ($sesion == null || $sesion == 0) {
  header('location:../index.php');
  session_unset();
  die();
}; ?>

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

  <title> Consultorio Riccio Administrador </title>
</head>

<body>
  <?php
  include 'components/menu.html'; ?>

  <h2 class="dia"> Citas Atendidas </h2>

  <?php include '../client/conexion.php';?>
  <div class="table">
      <div class="thead__table">
        <div class="thead id">Id</div>
        <div class="thead">Nombre del Paciente</div>
        <div class="thead">Numero</div>
        <div class="thead">Cedula</div>
        <div class="thead causa">Causa de la Consulta</div>
        <div class="thead">Nombre de Doctor</div>
        <div class="thead">Fecha de Solicitud</div>
        <div class="thead">Fecha de Atencion</div>
        <div class="thead"> Acciones </div>
      </div>

      <?php
      $operator = "SELECT * FROM consulta WHERE status = 1";
      $select = $conexion->query($operator);
      while ($resultado = mysqli_fetch_array($select)) {
      ?>
        <div class="tbody__table">
          <div class="tbody id"><?php echo $resultado['id_consulta']; ?></div>
          <div class="tbody nom"><?php echo $resultado['nombre'] . " " . $resultado['apellido']; ?></div>
          <div class="tbody"><?php echo $resultado['numero']; ?></div>
          <div class="tbody"><?php echo $resultado['cedula']; ?></div>
          <div class="tbody causa"><?php echo $resultado['causa']; ?></div>
          <div class="tbody nom"><?php echo $resultado['nombre_doctora']; ?></div>
          <div class="tbody"><?php echo $resultado['fecha_solicitud']; ?></div>
          <div class="tbody"><?php echo $resultado['fecha_atencion']; ?></div>
          <div class="tbody"><a href="../client/crud/status2.php?id=<?php echo $resultado['id_consulta']?>"><button class="eliminar">Eliminar</button></a></div>
        </div><?php } ?>
    </div>

    <div class="space"></div>

    <?php mysqli_close($conexion) ?>

  <?php include 'components/footer.html' ?>
<script src="js/confirm.js"></script>
<script src="js/modal.js"></script>
</body>
</html>