<!DOCTYPE html>
<html lang="es">

<head>
  <!-- META ETIQUETAS -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- ESTILOS CSS -->
  <link rel="stylesheet" href="../styles/normalize.css">
  <link rel="stylesheet" href="../styles/login.css">
  <link rel="stylesheet" href="../styles/mensajes.css">
  <link rel="stylesheet" href="../Iconos/style.css">

  <!-- LETRAS UTILIZADAS -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">

  <title>Consultorio Riccio</title>
</head>

<body>
  <div class="flex__container">
    <form class="form form__alternative" method="POST"> <!--action="../client/insertar.php"-->

      <a href="../"><i class="icon-cross"></i></a>

      <!-- TITULO -->
      <h2 class="title__form">Registrarse</h2>

      <?php
      include '../client/insertar.php'
      ?>

      <div class="fields__form">
        <h3>Tu cuenta: </h3>

        <label>Usuario:</label>
        <input type="text" maxlength="30" required="true" name="usuario" class="input__form" autocomplete="off">

        <label>Contraseña:</label>
        <input type="password" maxlength="50" required="true" name="clave" class="input__form">

        <label>Confirmar Contraseña:</label>
        <input type="password" maxlength="50" required="true" name="clave2" class="input__form">

        <h3>Datos Personales: </h3>

        <label>Nombre:</label>
        <input type="text" maxlength="30" required="true" name="nombre" class="input__form" autocomplete="off">

        <label>Apellido:</label>
        <input type="text" maxlength="30" required="true" name="apellido" class="input__form">

        <label>Cédula:</label>
        <input type="number" maxlength="8" required="true" name="cedula" class="input__form">

        <label>Fecha de Nacimiento:</label>
        <input type="date" required="true" name="nacimiento" class="input__form">

        <label>Número de Teléfono Celular:</label>
        <input type="number" maxlength="11" required="true" name="telefono1" class="input__form">

        <label>Número de Teléfono (opcional):</label>
        <input type="number" maxlength="11" name="telefono2" class="input__form">

        <label>Correo Electrónico:</label>
        <input type="email" maxlength="60" name="correo" class="input__form" autocomplete="off">

        <input class="button" type="submit" value="Registrarse" name="boton_reg">
      </div>
    </form>
  </div>
</body>

</html>