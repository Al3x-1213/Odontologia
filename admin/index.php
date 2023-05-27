<?php
include '../client/verificacion_sesion.php';

date_default_timezone_set('America/Caracas');
$fecha_actual = date("d-m-Y h:i:s");

$dia = date("d");
$mes = date("m");
$year = date("Y");

// function datosUsuario($id_usuario){
//   include '../client/conexion.php';
//   $consulta = "SELECT * FROM usuarios WHERE id_usuario = '$id_usuario'";
//   $select = $conexion->query($consulta);
//   $respuesta = mysqli_fetch_array($select);
//   echo $respuesta['nombre'];
//   // return mysqli_fetch_array($select);
// }

function nombre_apellido ($id_doctor){
  include '../client/conexion.php';
  $consulta = "SELECT id_usuario FROM doctores WHERE id_doctor = '$id_doctor'";
  $select = $conexion->query($consulta);

  $id = mysqli_fetch_array($select)['id_usuario'];
  $consulta = "SELECT nombre AND apellido FROM usuarios WHERE id_usuario = '$id'";
  $select = $conexion->query($consulta);
  return mysqli_fetch_array($select);
}

?>
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
  include 'components/menu.html'; ?>

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
  if ($select->num_rows > 0){ 
    mysqli_close($conexion)?>
    <h2 class="dia"> <?php echo $dia."-".$mes."-".$year ?> </h2>
    <div class="table">
      <div class="thead__table">
        <div class="thead id"> Id </div>
        <div class="thead"> Nombre del Paciente </div>
        <div class="thead"> Numero </div>
        <div class="thead"> Cedula </div>
        <div class="thead causa"> Causa de la Consulta </div>
        <div class="thead"> Nombre de Doctor </div>
        <div class="thead"> Acciones </div>
      </div>

      <?php 
      include '../client/conexion.php';
      $operator = "SELECT * FROM consultas WHERE fecha_atencion = '$year-$mes-$dia' AND id_status_consulta = 2";
      $select = $conexion->query($operator);
      while ($resultado = mysqli_fetch_array($select)) {
        $id = $resultado['id_usuario'];
        $consulta = "SELECT * FROM usuarios WHERE id_usuario = '$id'";
        $select = $conexion->query($consulta);
        $resultado2 = mysqli_fetch_array($select);

        $resultado3 = nombre_apellido($resultado['id_doctor']);
      ?>
        <div class="tbody__table">
          <div class="tbody id"><?php echo $resultado['id_consulta']; ?></div>
          <div class="tbody nom"><?php echo $resultado2['nombre'] . " " . $resultado2['apellido']; ?></div>
          <div class="tbody"><?php echo $resultado2['telefono_1']; ?></div>
          <div class="tbody"><?php echo $resultado2['cedula']; ?></div>
          <div class="tbody causa"><?php echo $resultado['causa']; ?></div>
          <div class="tbody nom"><?php echo $resultado3['nombre'] . " " . $resultado3['apellido']; ?></div>
          <div class="tbody"><a href="../client/crud/status1.php?id=<?php echo $resultado['id_consulta']?>"><button class="atendido">Atendido</button></a> <a href="../client/crud/status2.php?id=<?php echo $resultado['id_consulta']?>"><button class="eliminar">Eliminar</button></a></div>
        </div><?php } 
        mysqli_close($conexion);
        ?>
    </div>

    <button class="insertar"> Registrar Una Cita </button>

    <?php 
    include '../client/conexion.php';
    $operator = "SELECT * FROM consulta WHERE status = 1 AND dia = 'lunes'";
    $select = $conexion->query($operator); ?>

    <h2 class="dia"> Atendidos el <?php echo $dia."-".$mes."-".$year ?> </h2>
    <div class="table">
      <div class="thead__table">
        <div class="thead id"> Id </div>
        <div class="thead"> Nombre del Paciente </div>
        <div class="thead"> Numero </div>
        <div class="thead"> Cedula </div>
        <div class="thead causa"> Causa de la Consulta </div>
        <div class="thead"> Nombre de Doctor </div>
        <div class="thead"> Acciones </div>
      </div>

      <?php
      $operator = "SELECT * FROM consultas WHERE fecha_atencion = '$year-$mes-$dia' AND id_status_consulta = 1";
      $select = $conexion->query($operator);
      while ($resultado = mysqli_fetch_array($select)) {
        // $resultado2 = datosUsuario($resultado['id_usuario']);
        $resultado3 = nombre_apellido($resultado['id_doctor']);
      ?>
        <div class="tbody__table">
          <div class="tbody id"><?php echo $resultado['id_consulta']; ?></div>
          <div class="tbody nom"><?php echo $resultado2['nombre'] . " " . $resultado2['apellido']; ?></div>
          <div class="tbody"><?php echo $resultado2['telefono_1']; ?></div>
          <div class="tbody"><?php echo $resultado2['cedula']; ?></div>
          <div class="tbody causa"><?php echo $resultado['causa']; ?></div>
          <div class="tbody nom"><?php echo $resultado3['nombre'] . " " . $resultado3['apellido']; ?></div>
          <a href="../client/crud/status2.php?id=<?php echo $resultado['id_consulta']?>"><button class="eliminar">Eliminar</button></a></div>
        </div><?php } 
        mysqli_close($conexion);
        ?>
    </div> 
  <?php } ?> <!-- Para cerrar el condicional de las consultas -->

  <div class="space"></div>


  <?php include 'components/footer.html' ?>
  
<script src="js/confirm.js"></script>
<script src="js/modal.js"></script>
</body>
</html>