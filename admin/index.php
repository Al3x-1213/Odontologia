<?php
include '../client/verificacion_sesion.php';

date_default_timezone_set('America/Caracas');
$fecha_actual = date("d-m-Y h:i:s");

$dia = date("d");
$mes = date("m");
$year = date("Y");

//Agarra de la tabla doctores el id_doctor, para obtener el id de usuario, y hacer la consulkta del nombre del doctor de la tabla usuario
function nombre_apellido_doctor($id)
{
  include '../client/conexion.php';
  $consulta = "SELECT id_usuario FROM doctores WHERE id_doctor = '$id'";
  $select = $conexion->query($consulta);
  $respuesta = mysqli_fetch_array($select);
  $id = $respuesta['id_usuario'];

  $consulta = "SELECT nombre, apellido FROM usuarios WHERE id_usuario = '$id'";
  $select = $conexion->query($consulta);
  $nombre_doctor = array();
  $respuesta = mysqli_fetch_array($select);
  $nombre_doctor[0] = $respuesta['nombre'];
  $nombre_doctor[1] = $respuesta['apellido'];
  return $nombre_doctor;
}
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
  <link rel="stylesheet" href="styles/buscador.css">
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
  include 'components/menu.html';
  include 'components/menu2.php';
  ?>
  
  <div class="modal disable">
    <form class="form-login" method="POST" action="../client/crud/insertarCadmin.php">
      <div class="header__form">
        <h2>Cita</h2> <span class="icon-cross"></span>
      </div>

      <label> Nombre del Paciente: </label>
      <input type="text" name="nombre" required autocomplete="off">

      <label> Apellido del Paciente: </label>
      <input type="text" name="apellido" required autocomplete="off">

      <label> Numero: </label>
      <input type="number" name="numero" required autocomplete="off" minlength="11">

      <label> Cedula: </label>
      <input type="number" name="cedula" required autocomplete="off" minlength="7">

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
      <input type="date" name="fecha" required min="">

      <label> Nombre del doctor: </label>
      <input type="text" name="nombre_doctor" required autocomplete="off">

      <div class="buttons__form">
        <input type="submit" value="Enviar" name="send" class="button__form loginSend">
        <input type="reset" value="Borrar" name="clear" class="button__form">
      </div>
    </form>
  </div>

  <!-- INICIA LA CONEXION CON LA BASE DE DATOS PARA HACER CONSULTAS -->
  <?php include '../client/conexion.php';
  $operator = "SELECT * FROM consultas WHERE fecha_atencion = '$year-$mes-$dia'";
  $select = $conexion->query($operator);

  //valida que la tabla de consultas de ese dia no esté vacía
  if ($select->num_rows > 0) {
    mysqli_close($conexion) ?>
    <h2 class="dia"> <?php echo $dia . "-" . $mes . "-" . $year ?> </h2>
    <div class="table">
      <div class="thead__table">
        <div class="thead"> Nombre del Paciente </div>
        <div class="thead"> Numero </div>
        <div class="thead"> Cedula </div>
        <div class="thead causa"> Causa de la Consulta </div>
        <div class="thead"> Acciones </div>
      </div>

      <?php
      include '../client/conexion.php';
      $consulta = "SELECT * FROM consultas INNER JOIN usuarios INNER JOIN causa_consulta INNER JOIN doctores ON consultas.id_paciente = usuarios.id_usuario AND causa_consulta.id_causa_consulta = consultas.id_causa_consulta AND doctores.id_doctor = consultas.id_doctor WHERE consultas.id_status_consulta = 2 AND consultas.fecha_atencion = '$year-$mes-$dia'";
      $select = $conexion->query($consulta);
      while ($datos_consulta = mysqli_fetch_array($select)) {
        $id_doctor = $datos_consulta['id_doctor'];
        $doctor = nombre_apellido_doctor($id_doctor);
      ?>
        <div class="tbody__table">
          <div class="tbody nom"><?php echo $datos_consulta['nombre'] . " " . $datos_consulta['apellido']; ?></div>
          <div class="tbody"><?php echo $datos_consulta['telefono_1']; ?></div>
          <div class="tbody"><?php echo $datos_consulta['cedula']; ?></div>
          <div class="tbody causa"><?php echo $datos_consulta['causa_consulta']; ?></div>
          <div class="tbody"><a href="../client/crud/status1.php?id=<?php echo $datos_consulta['id_consulta'] ?>"><button class="atendido">Atendido</button></a> <a href="../client/crud/status2.php?id=<?php echo $datos_consulta['id_consulta'] ?>"><button class="eliminar">Eliminar</button></a></div>
        </div>
      <?php }
      mysqli_close($conexion); ?>
    </div>

    <button class="insertar"> Registrar Una Cita </button>

    <h2 class="dia"> Atendidos </h2>
    <div class="table">
      <div class="thead__table">
        <div class="thead"> Nombre del Paciente </div>
        <div class="thead"> Numero </div>
        <div class="thead"> Cedula </div>
        <div class="thead causa"> Causa de la Consulta </div>
        <div class="thead"> Acciones </div>
      </div>

      <?php
      include '../client/conexion.php';
      $consulta = "SELECT * FROM consultas INNER JOIN usuarios INNER JOIN causa_consulta INNER JOIN doctores ON consultas.id_paciente = usuarios.id_usuario AND causa_consulta.id_causa_consulta = consultas.id_causa_consulta AND doctores.id_doctor = consultas.id_doctor WHERE consultas.id_status_consulta = 1 AND consultas.fecha_atencion = '$year-$mes-$dia'";
      $select = $conexion->query($consulta);
      while ($datos_consulta = mysqli_fetch_array($select)) {
        $id_doctor = $datos_consulta['id_doctor'];
        $doctor = nombre_apellido_doctor($id_doctor);
      ?>
        <div class="tbody__table">
          <div class="tbody nom"><?php echo $datos_consulta['nombre'] . " " . $datos_consulta['apellido']; ?></div>
          <div class="tbody"><?php echo $datos_consulta['telefono_1']; ?></div>
          <div class="tbody"><?php echo $datos_consulta['cedula']; ?></div>
          <div class="tbody causa"><?php echo $datos_consulta['causa_consulta']; ?></div>
          <div class="tbody"><a href="../client/crud/status2.php?id=<?php echo $datos_consulta['id_consulta'] ?>"><button class="eliminar">Eliminar</button></a></div>
        </div>
    </div>
    <?php } mysqli_close($conexion); ?>
  </div>
<?php } ?> <!-- Para cerrar el condicional de las consultas -->

<div class="space"></div>


<?php include 'components/footer.html' ?>

<script src="js/confirm.js"></script>
<script src="js/modal.js"></script>
</body>

</html>