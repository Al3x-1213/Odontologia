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

  <div class="modal disable">
    <form class="form-login" method="POST" action="../client/insertar.php">
      <div class="header__form">
        <h2>Cita</h2> <span class="icon-cross"></span>
      </div>

      <label> Nombre del Paciente: </label>
      <input type="text" name="nombre" required="true" autocomplete="off">

      <label> Apellido del Paciente: </label>
      <input type="text" name="apellido" required="true" autocomplete="off">

      <label> Numero: </label>
      <input type="number" name="numero" required="true" autocomplete="off" minlength="11">

      <label> Cedula: </label>
      <input type="number" name="cedula" required="true" autocomplete="off" minlength="7">

      <label> Edad: </label>
      <input type="number" name="edad" required="true" autocomplete="off" minlength="1" maxlength="3">

      <label> Correo: </label>
      <input type="text" name="correo" required="true" autocomplete="off">

      <label> Clave: </label>
      <input type="password" name="clave" required="true" autocomplete="off">

      <div class="buttons__form">
        <input type="submit" value="Registrar Paciente" name="send" class="button__form loginSend">
        <input type="reset" value="Borrar" name="clear" class="button__form">
      </div>
    </form>
  </div>

  <?php include '../client/conexion.php';?>
    <h2 class="dia"> Pacientes </h2>
    <div class="table">
      <div class="thead__table">
        <div class="thead id">Id</div>
        <div class="thead">Nombre del Paciente</div>
        <div class="thead">Numero</div>
        <div class="thead">Cedula</div>
        <div class="thead">Edad</div>
        <div class="thead">Correo</div>
        <div class="thead"> Acciones </div>
      </div>

      <?php
      $operator = "SELECT * FROM paciente1";
      $select = $conexion->query($operator);
      while ($resultado = mysqli_fetch_array($select)) {
      ?>
        <div class="tbody__table">
          <div class="tbody id"><?php echo $resultado['id_paciente']; ?></div>
          <div class="tbody nom"><?php echo $resultado['nombre'] . " " . $resultado['apellido']; ?></div>
          <div class="tbody"><?php echo $resultado['numero']; ?></div>
          <div class="tbody"><?php echo $resultado['cedula']; ?></div>
          <div class="tbody"><?php echo $resultado['edad']; ?></div>
          <div class="tbody"><?php echo $resultado['correo']; ?></div>
          <div class="tbody"><a href="editar.php?id=<?php echo $resultado['id_paciente']?>"><button class="editar">Editar</button></a> <a href="../client/eliminar.php?id=<?php echo $resultado['id_paciente']?>"><button class="eliminar">Eliminar</button></a></div>
        </div><?php } ?>
    </div>
    <button class="insertar"> Registrar Un Paciente </button>

    <?php mysqli_close($conexion) ?>

<div class="space"></div>

<?php include 'components/footer.html' ?>
<script src="js/confirm.js"></script>
<script src="js/modal.js"></script>
</body>
</html>