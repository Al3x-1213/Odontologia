<?php

include '../verificacion_sesion.php';

// session_start();
// ob_start();
// $sesion = $_SESSION['sesion'];
// $_SESSION['admin'] = 1;
// if ($sesion == null || $sesion == 0) {
//   header('location:../index.php');
//   session_unset();
//   die();
// };
?>

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
    <form class="form-login" method="POST" action="../client/crud/insertarCadmin.php">
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

      <label> Causa: </label>
      <select name="causa">
        <option value="Consulta odontologica general">Consulta odontologica general</option>
        <option value="Montura de breakers">Montura de breakers</option>
        <option value="Mantenimiento de breakers">Mantenimiento de breakers</option>
        <option value="Operaciones Menores">Operaciones Menores</option>
        <option value="Limpieza Buca">Limpieza Bucal</option>
        <option value="Tratamiento de Caries">Tratamiento de Caries</option>
      </select>

      <label> Dia: </label>
      <select name="dia">
        <option value="lunes">lunes</option>
        <option value="martes">martes</option>
        <option value="miercoles">miercoles</option>
        <option value="jueves">jueves</option>
        <option value="viernes">viernes</option>
      </select>

      <label> Nombre del doctor: </label>
      <input type="text" name="nombre_doctor" required="true" autocomplete="off">

      <div class="buttons__form">
        <input type="submit" value="Enviar" name="send" class="button__form loginSend">
        <input type="reset" value="Borrar" name="clear" class="button__form">
      </div>
    </form>
  </div>

  <?php include '../client/conexion.php';
  $operator = "SELECT * FROM consulta WHERE dia = 'lunes' AND status != 2";
  $select = $conexion->query($operator);

  if ($select->num_rows > 0) { ?>
    <h2 class="dia"> Lunes </h2>
    <div class="table">
      <div class="thead__table">
        <div class="thead id">Id</div>
        <div class="thead">Nombre del Paciente</div>
        <div class="thead">Numero</div>
        <div class="thead">Cedula</div>
        <div class="thead causa">Causa de la Consulta</div>
        <div class="thead">Nombre de Doctor</div>
        <div class="thead"> Acciones </div>
      </div>

      <?php
      $operator = "SELECT * FROM consulta WHERE dia = 'lunes' AND status = 0";
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
          <div class="tbody"><a href="../client/crud/status1.php?id=<?php echo $resultado['id_consulta']?>"><button class="atendido">Atendido</button></a> <a href="../client/crud/status2.php?id=<?php echo $resultado['id_consulta']?>"><button class="eliminar">Eliminar</button></a></div>
        </div><?php } ?>
    </div>

    <button class="insertar"> Registrar Una Cita </button>

    <?php $operator = "SELECT * FROM consulta WHERE status = 1 AND dia = 'lunes'";
    $select = $conexion->query($operator); ?>

    <h3 class="dia">Atendidos del Lunes</h3>
    <div class="table">
      <div class="thead__table">
        <div class="thead id aten">Id</div>
        <div class="thead aten">Nombre del Paciente</div>
        <div class="thead aten">Numero</div>
        <div class="thead aten">Cedula</div>
        <div class="thead causa aten">Causa de la Consulta</div>
        <div class="thead aten">Nombre de Doctor</div>
        <div class="thead aten"> Acciones </div>
      </div>

      <?php
      while ($resultado = mysqli_fetch_array($select)) {
      ?>
        <div class="tbody__table">
          <div class="tbody id"><?php echo $resultado['id_consulta']; ?></div>
          <div class="tbody nom"><?php echo $resultado['nombre'] . " " . $resultado['apellido']; ?></div>
          <div class="tbody"><?php echo $resultado['numero']; ?></div>
          <div class="tbody"><?php echo $resultado['cedula']; ?></div>
          <div class="tbody causa"><?php echo $resultado['causa']; ?></div>
          <div class="tbody nom"><?php echo $resultado['nombre_doctora']; ?></div>
          <div class="tbody"><a href="../client/crud/status3.php?id=<?php echo $resultado['id_consulta'] ?>"><button class="volver">Volver</button></a> <a href="../client/crud/status2.php?id=<?php echo $resultado['id_consulta']?>"><button class="eliminar">Eliminar</button></a></div>
        </div><?php }
      mysqli_close($conexion) ?> <!-- Para cerrar el while de las consultas atendidas -->
    </div> 
  <?php } ?> <!-- Para cerrar el condicional de las consultas -->

  <div class="space"></div>

  <!-- CITAS DEL MARTES -->

  <?php include '../client/conexion.php';
  $operator = "SELECT * FROM consulta WHERE dia = 'martes'  AND status != 2";
  $select = $conexion->query($operator);

  if ($select->num_rows > 0) { ?>
    <h2 class="dia"> Martes </h2>
    <div class="table">
      <div class="thead__table">
        <div class="thead id">Id</div>
        <div class="thead">Nombre del Paciente</div>
        <div class="thead">Numero</div>
        <div class="thead">Cedula</div>
        <div class="thead causa">Causa de la Consulta</div>
        <div class="thead">Nombre de Doctor</div>
        <div class="thead"> Acciones </div>
      </div>

      <?php
      $operator = "SELECT * FROM consulta WHERE dia = 'martes' AND status = 0";
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
          <div class="tbody"><a href="../client/crud/status1.php?id=<?php echo $resultado['id_consulta']?>"><button class="atendido">Atendido</button></a> <a href="../client/crud/status2.php?id=<?php echo $resultado['id_consulta']?>"><button class="eliminar">Eliminar</button></a></div>
        </div><?php } ?>
    </div>

    <button class="insertar"> Registrar Una Cita </button>

    <?php $operator = "SELECT * FROM consulta WHERE status = 1 AND dia = 'martes'";
    $select = $conexion->query($operator); ?>

    <h3 class="dia">Atendidos del Martes</h3>
    <div class="table">
      <div class="thead__table">
        <div class="thead id aten">Id</div>
        <div class="thead aten">Nombre del Paciente</div>
        <div class="thead aten">Numero</div>
        <div class="thead aten">Cedula</div>
        <div class="thead causa aten">Causa de la Consulta</div>
        <div class="thead aten">Nombre de Doctor</div>
        <div class="thead aten"> Acciones </div>
      </div>

      <?php
      while ($resultado = mysqli_fetch_array($select)) {
      ?>
        <div class="tbody__table">
          <div class="tbody id"><?php echo $resultado['id_consulta']; ?></div>
          <div class="tbody nom"><?php echo $resultado['nombre'] . " " . $resultado['apellido']; ?></div>
          <div class="tbody"><?php echo $resultado['numero']; ?></div>
          <div class="tbody"><?php echo $resultado['cedula']; ?></div>
          <div class="tbody causa"><?php echo $resultado['causa']; ?></div>
          <div class="tbody nom"><?php echo $resultado['nombre_doctora']; ?></div>
          <div class="tbody"><a href="../client/crud/status3.php?id=<?php echo $resultado['id_consulta'] ?>"><button class="volver">Volver</button></a> <a href="../client/crud/status2.php?id=<?php echo $resultado['id_consulta']?>"><button class="eliminar">Eliminar</button></a></div>
        </div><?php }
      mysqli_close($conexion) ?> <!-- Para cerrar el while de las consultas atendidas -->
    </div>  
  <?php } ?> <!-- Para cerrar el condicional de las consultas -->

  <div class="space"></div>

  <!-- CITAS DE MIERCOLES -->

  <?php include '../client/conexion.php';
  $operator = "SELECT * FROM consulta WHERE dia = 'miercoles'  AND status != 2";
  $select = $conexion->query($operator);

  if ($select->num_rows > 0) { ?>
    <h2 class="dia"> Miercoles </h2>
    <div class="table">
      <div class="thead__table">
        <div class="thead id">Id</div>
        <div class="thead">Nombre del Paciente</div>
        <div class="thead">Numero</div>
        <div class="thead">Cedula</div>
        <div class="thead causa">Causa de la Consulta</div>
        <div class="thead">Nombre de Doctor</div>
        <div class="thead"> Acciones </div>
      </div>

      <?php
      $operator = "SELECT * FROM consulta WHERE dia = 'miercoles' AND status = 0";
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
          <div class="tbody"><a href="../client/crud/status1.php?id=<?php echo $resultado['id_consulta']?>"><button class="atendido">Atendido</button></a> <a href="../client/crud/status2.php?id=<?php echo $resultado['id_consulta']?>"><button class="eliminar">Eliminar</button></a></div>
        </div><?php } ?>
    </div>

    <button class="insertar"> Registrar Una Cita </button>

    <?php $operator = "SELECT * FROM consulta WHERE status = 1 AND dia = 'miercoles'";
    $select = $conexion->query($operator); ?>

    <h3 class="dia">Atendidos del Miercoles</h3>
    <div class="table">
      <div class="thead__table">
        <div class="thead id aten">Id</div>
        <div class="thead aten">Nombre del Paciente</div>
        <div class="thead aten">Numero</div>
        <div class="thead aten">Cedula</div>
        <div class="thead causa aten">Causa de la Consulta</div>
        <div class="thead aten">Nombre de Doctor</div>
        <div class="thead aten"> Acciones </div>
      </div>

      <?php
      while ($resultado = mysqli_fetch_array($select)) {
      ?>
        <div class="tbody__table">
          <div class="tbody id"><?php echo $resultado['id_consulta']; ?></div>
          <div class="tbody nom"><?php echo $resultado['nombre'] . " " . $resultado['apellido']; ?></div>
          <div class="tbody"><?php echo $resultado['numero']; ?></div>
          <div class="tbody"><?php echo $resultado['cedula']; ?></div>
          <div class="tbody causa"><?php echo $resultado['causa']; ?></div>
          <div class="tbody nom"><?php echo $resultado['nombre_doctora']; ?></div>
          <div class="tbody"><a href="../client/crud/status3.php?id=<?php echo $resultado['id_consulta'] ?>"><button class="atendido volver">Volver</button></a> <a href="../client/crud/status2.php?id=<?php echo $resultado['id_consulta']?>"><button class="eliminar">Eliminar</button></a></div>
        </div><?php }
      mysqli_close($conexion) ?> <!-- Para cerrar el while de las consultas atendidas -->
    </div>  
  <?php } ?> <!-- Para cerrar el condicional de las consultas -->

  <div class="space"></div>

    <!-- CITAS DEL JUEVES-->

  <?php include '../client/conexion.php';
  $operator = "SELECT * FROM consulta WHERE dia = 'jueves'  AND status != 2";
  $select = $conexion->query($operator);

  if ($select->num_rows > 0) { ?>
    <h2 class="dia"> Jueves </h2>
    <div class="table">
      <div class="thead__table">
        <div class="thead id">Id</div>
        <div class="thead">Nombre del Paciente</div>
        <div class="thead">Numero</div>
        <div class="thead">Cedula</div>
        <div class="thead causa">Causa de la Consulta</div>
        <div class="thead">Nombre de Doctor</div>
        <div class="thead"> Acciones </div>
      </div>

      <?php
      $operator = "SELECT * FROM consulta WHERE dia = 'jueves' AND status = 0";
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
          <div class="tbody"><a href="../client/crud/status1.php?id=<?php echo $resultado['id_consulta']?>"><button class="atendido">Atendido</button></a> <a href="../client/crud/status2.php?id=<?php echo $resultado['id_consulta']?>"><button class="eliminar">Eliminar</button></a></div>
        </div><?php } ?>
    </div>

    <button class="insertar"> Registrar Una Cita </button>

    <?php $operator = "SELECT * FROM consulta WHERE status = 1 AND dia = 'jueves'";
    $select = $conexion->query($operator); ?>

    <h3 class="dia">Atendidos del Jueves</h3>
    <div class="table">
      <div class="thead__table">
        <div class="thead id aten">Id</div>
        <div class="thead aten">Nombre del Paciente</div>
        <div class="thead aten">Numero</div>
        <div class="thead aten">Cedula</div>
        <div class="thead causa aten">Causa de la Consulta</div>
        <div class="thead aten">Nombre de Doctor</div>
        <div class="thead aten"> Acciones </div>
      </div>

      <?php
      while ($resultado = mysqli_fetch_array($select)) {
      ?>
        <div class="tbody__table">
          <div class="tbody id"><?php echo $resultado['id_consulta']; ?></div>
          <div class="tbody nom"><?php echo $resultado['nombre'] . " " . $resultado['apellido']; ?></div>
          <div class="tbody"><?php echo $resultado['numero']; ?></div>
          <div class="tbody"><?php echo $resultado['cedula']; ?></div>
          <div class="tbody causa"><?php echo $resultado['causa']; ?></div>
          <div class="tbody nom"><?php echo $resultado['nombre_doctora']; ?></div>
          <div class="tbody"><a href="../client/crud/status3.php?id=<?php echo $resultado['id_consulta'] ?>"><button class=" volver">Volver</button></a> <a href="../client/crud/status2.php?id=<?php echo $resultado['id_consulta']?>"><button class="eliminar">Eliminar</button></a></div>
        </div><?php }
      mysqli_close($conexion) ?> <!-- Para cerrar el while de las consultas atendidas -->
    </div>  
  <?php } ?> <!-- Para cerrar el condicional de las consultas -->

  <div class="space"></div>

  <!-- CITAS DEL VIERNES-->

  <?php include '../client/conexion.php';
  $operator = "SELECT * FROM consulta WHERE dia = 'viernes'  AND status != 2";
  $select = $conexion->query($operator);

  if ($select->num_rows > 0) { ?>
    <h2 class="dia"> Viernes </h2>
    <div class="table">
      <div class="thead__table">
        <div class="thead id">Id</div>
        <div class="thead">Nombre del Paciente</div>
        <div class="thead">Numero</div>
        <div class="thead">Cedula</div>
        <div class="thead causa">Causa de la Consulta</div>
        <div class="thead">Nombre de Doctor</div>
        <div class="thead"> Acciones </div>
      </div>

      <?php
      $operator = "SELECT * FROM consulta WHERE dia = 'viernes' AND status = 0";
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
          <div class="tbody"><a href="../client/crud/status1.php?id=<?php echo $resultado['id_consulta']?>"><button class="atendido">Atendido</button></a> <a href="../client/crud/status2.php?id=<?php echo $resultado['id_consulta']?>"><button class="eliminar">Eliminar</button></a></div>
        </div><?php } ?>
    </div>

    <button class="insertar"> Registrar Una Cita </button>

    <?php $operator = "SELECT * FROM consulta WHERE status = 1 AND dia = 'viernes'";
    $select = $conexion->query($operator); ?>

    <h3 class="dia">Atendidos del Viernes</h3>
    <div class="table">
      <div class="thead__table">
        <div class="thead id aten">Id</div>
        <div class="thead aten">Nombre del Paciente</div>
        <div class="thead aten">Numero</div>
        <div class="thead aten">Cedula</div>
        <div class="thead causa aten">Causa de la Consulta</div>
        <div class="thead aten">Nombre de Doctor</div>
        <div class="thead aten"> Acciones </div>
      </div>

      <?php
      while ($resultado = mysqli_fetch_array($select)) {
      ?>
        <div class="tbody__table">
          <div class="tbody id"><?php echo $resultado['id_consulta']; ?></div>
          <div class="tbody nom"><?php echo $resultado['nombre'] . " " . $resultado['apellido']; ?></div>
          <div class="tbody"><?php echo $resultado['numero']; ?></div>
          <div class="tbody"><?php echo $resultado['cedula']; ?></div>
          <div class="tbody causa"><?php echo $resultado['causa']; ?></div>
          <div class="tbody nom"><?php echo $resultado['nombre_doctora']; ?></div>
          <div class="tbody"><a href="../client/crud/status3.php?id=<?php echo $resultado['id_consulta'] ?>"><button class=" volver">Volver</button></a> <a href="../client/crud/status2.php?id=<?php echo $resultado['id_consulta']?>"><button class="eliminar">Eliminar</button></a></div>
        </div><?php }
      mysqli_close($conexion) ?> <!-- Para cerrar el while de las consultas atendidas -->
    </div>  
  <?php } ?> <!-- Para cerrar el condicional de las consultas -->

  <?php include 'components/footer.html' ?>
  
<script src="js/confirm.js"></script>
<script src="js/modal.js"></script>
</body>
</html>