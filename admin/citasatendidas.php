<?php
include '../verificacion_sesion.php';
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

  <title>Consultorio Riccio - ADMINISTRADOR</title>
</head>

<body>
  <?php
  include 'components/menu.html'; ?>

  <h2 class="dia">Citas Atendidas</h2>

  <?php include '../client/conexion.php';?>
  <div class="table">
      <div class="thead__table">
        <!-- <div class="thead id">Id</div> -->
        <div class="thead">Paciente</div>
        <div class="thead">Cédula</div>
        <div class="thead">Edad</div>
        <!-- <div class="thead">Fecha de Nacimiento</div> -->
        <!-- <div class="thead">Télefono</div> -->
        <!-- <div class="thead">Télefono</div> -->
        <div class="thead causa">Causa de la Consulta</div>
        <div class="thead">Fecha de Atención</div>
        <!-- <div class="thead">Doctor</div> -->
        <!-- <div class="thead">Fecha de Solicitud</div> -->
        <div class="thead">Acciones</div>
      </div>

      <?php
      // VARIABLE GLOBAL: ID DEL USUARIO LOGUEADO
      $id= $_SESSION['id'];

      // OBTENER EL ID_DOCTOR según el ID_USUARIO
      $consulta = "SELECT id_doctor FROM doctores WHERE id_usuario = '$id'";
      $query = mysqli_query($conexion, $consulta);
      
      $respuesta = mysqli_fetch_array($query);
      $id_doctor = $respuesta['id_doctor'];

      //SELECT * FROM `consultas` INNER JOIN `usuarios` INNER JOIN `causa_consulta` INNER JOIN `doctores` INNER JOIN `status_consulta` ON `consultas`.`id_paciente` = `usuarios`.`id_usuario` AND `consultas`.`id_causa_consulta` = `causa_consulta`.`id_causa_consulta` AND `consultas`.`id_doctor` = `doctores`.`id_doctor` AND `consultas`.`id_status_consulta` = `status_consulta`.`id_status_consulta` WHERE `consultas`.`id_status_consulta` = 1
      
      // OBTENER LA INFORMACIÓN DE TODAS LAS CITAS ATENDIDAS POR EL DOCTOR QUE ESTÁ LOGUEADO
      $consulta = "SELECT * FROM consultas INNER JOIN usuarios INNER JOIN causa_consulta INNER JOIN doctores INNER JOIN status_consulta
      ON consultas.id_paciente = usuarios.id_usuario AND consultas.id_causa_consulta = causa_consulta.id_causa_consulta
      AND consultas.id_doctor = doctores.id_doctor AND consultas.id_status_consulta = status_consulta.id_status_consulta
      WHERE consultas.id_doctor = '$id_doctor' AND consultas.id_status_consulta = 1";
      $query = mysqli_query($conexion, $consulta);

      while ($resultado = mysqli_fetch_array($query)){
      ?>
        <div class="tbody__table">
          <!-- <div class="tbody id"><?php echo $resultado['id_consulta']; ?></div> -->
          <div class="tbody nom"><?php echo $resultado['nombre'] . " " . $resultado['apellido']; ?></div>
          <div class="tbody"><?php echo $resultado['cedula']; ?></div>
          <div class="tbody"><?php echo $resultado['edad']; ?></div>
          <!-- <div class="tbody"><?php //echo $resultado['fecha_nacimiento']; ?></div> -->
          <!-- <div class="tbody"><?php //echo $resultado['telefono_1']; ?></div> -->
          <!-- <div class="tbody"><?php //echo $resultado['telefono_2']; ?></div> -->
          <div class="tbody causa"><?php echo $resultado['causa_consulta']; ?></div>
          <div class="tbody"><?php echo $resultado['fecha_atencion']; ?></div>

          <!-- <div class="tbody nom"><?php
          // $id_doctor = $resultado['id_doctor'];

          // $consulta = "SELECT * FROM doctores INNER JOIN usuarios
          // ON doctores.id_usuario = usuarios.id_usuario WHERE id_doctor = '$id_doctor'";
          // $query = mysqli_query($conexion, $consulta);

          // while ($resultado = mysqli_fetch_array($query)){
          //   echo $resultado['nombre'] . " " . $resultado['apellido'];
          // }
          ?></div> -->

          <!-- <div class="tbody"><?php //echo $resultado['fecha_solicitud']; ?></div> -->
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