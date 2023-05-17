<?php
session_start();
ob_start();
$sesion = $_SESSION['sesion'];
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

  <title> Consultorio Riccio Paciente </title>
</head>

<body>

  <div class="modal">
    <form class="form-login" method="POST" action="../client/crud/insertarCadmin.php">
      <div class="header__form">
        <h2>Cita</h2> <a href="../index.php"><span class="icon-cross"></span></a>
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
        <input type="submit" value="Iniciar Sesión" name="send" class="button__form loginSend">
        <input type="reset" value="Borrar" name="clear" class="button__form">
      </div>
    </form>
</div>