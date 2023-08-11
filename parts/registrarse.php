<?php
session_start();
ob_start();
session_destroy();
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
    <link rel="stylesheet" href="../styles/mensajes.css">
    <link rel="stylesheet" href="../styles/registrarse.css">
    <link rel="stylesheet" href="../Iconos/style.css">

    <!-- LETRAS UTILIZADAS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">

    <title>Marisol Díaz - REGISTRARSE</title>
</head>

<body>
    <div class="flex__container">
        <form id="formulario" class="form" method="POST"> <!--action="../client/insertar.php"-->

            <a href="../"><i class="icon-cross"></i></a>
            <!-- TITULO -->
            <h2 class="title__form"><a href="../index.php">Registrarse</a></h2>

            <?php
            include '../client/insertar.php';
            ?>

            <p>¿Ha pedido cita previamente pero no tiene cuenta? <a href="registrarseSc.php">Regístrate aqui</a></p>

            <h3>Tu cuenta: </h3>

            <div id="grupo_usuario" class="grupo">
                <label>Usuario:</label>
                <div class="input-icon"><input type="text" maxlength="30" required name="usuario" class="input__form base" autocomplete="off"><i class="icon-warning display"></i> <i class="icon-checkmark confirm display"></i></div>
                <div class="paragraf__error display"> Usuario no puede estar vacío y sólo puede tener: numeros y letras y  algunos caractéres como . - _ </div>
            </div>

            <div id="grupo_clave" class="grupo">
                <label>Contraseña:</label>
                <div class="input-icon"><input type="password" maxlength="35" required name="clave" class="input__form base" autocomplete="off"><i class="icon-warning display"></i> <i class="icon-checkmark confirm display"></i></div>
                <div class="paragraf__error display"> Contraseña no puede tener menos de 4 caracteres y no puede estar vacia </div>
            </div>

            <div id="grupo_clave2" class="grupo">
                <label>Confirmar Contraseña:</label>
                <div class="input-icon"><input type="password" maxlength="35" required name="clave2" class="input__form base" autocomplete="off"><i class="icon-warning display"></i> <i class="icon-checkmark confirm display"></i></div>
                <div class="paragraf__error display"> Contraseña no coincide </div>
            </div>

            <h3>Datos Personales: </h3>

            <div id="grupo_nombre" class="grupo">
                <label>Nombre:</label>
                <div class="input-icon"><input type="text" maxlength="25" required name="nombre" class="input__form base" autocomplete="off"><i class="icon-warning display"></i> <i class="icon-checkmark confirm display"></i></div>
                <div class="paragraf__error display"> Nombre no puede tener numeros ni caracteres especiales </div>
            </div>

            <div id="grupo_apellido" class="grupo">
                <label>Apellido:</label>
                <div class="input-icon"><input type="text" maxlength="25" required name="apellido" class="input__form base" autocomplete="off"><i class="icon-warning display"></i> <i class="icon-checkmark confirm display"></i></div>
                <div class="paragraf__error display"> Apellido no puede tener numeros ni caracteres especiales </div>
            </div>

            <div id="grupo_cedula" class="grupo">
                <label>Cédula:</label>
                <div class="input-icon"><input type="number" maxlength="8" required name="cedula" class="input__form base" autocomplete="off"><i class="icon-warning display"></i> <i class="icon-checkmark confirm display"></i></div>
                <div class="paragraf__error display"> Cedula tiene que tener de 7 a 8 caractéres </div>
            </div>

            <?php
            $limiteFecha = date("Y-m-d");
            ?>

            <div id="grupo_nacimiento" class="grupo">
                <label>Fecha de Nacimiento:</label>
                <div class="input-icon"><input type="date" required name="nacimiento" max="<?= $limiteFecha; ?>" class="input__form base"><i class="icon-warning display"></i> <i class="icon-checkmark confirm display"></i></div>
                <div class="paragraf__error display"> la fecha no puede ser la misma o posterior a la de hoy </div>
            </div>

            <div id="grupo_telefono1" class="grupo">
                <label>Telefono celular:</label>
                <div class="input-icon"><input type="number" maxlength="11" required name="telefono1" class="input__form base" autocomplete="off"><i class="icon-warning display"></i> <i class="icon-checkmark confirm display"></i></div>
                <div class="paragraf__error display"> Telefono sólo puede tener 11 caracteres </div>
            </div>

            <div id="grupo_telefono2" class="grupo">
                <label>Telefono (Opcional):</label>
                <div class="input-icon"><input type="number" maxlength="11" required name="telefono2" class="input__form base" autocomplete="off"><i class="icon-warning display"></i> <i class="icon-checkmark confirm display"></i></div>
                <div class="paragraf__error display"> Telefono sólo puede tener 11 caracteres </div>
            </div>

            <div id="grupo_correo" class="grupo">
                <label>Correo Electrónico:</label>
                <div class="input-icon"><input type="email" maxlength="60" required name="correo" class="input__form base" autocomplete="off"><i class="icon-warning display"></i> <i class="icon-checkmark confirm display"></i></div>
                <div class="paragraf__error display"> Correo debe contener @ y . </div>
            </div>

            <input class="button" type="submit" value="Registrarse" name="boton_reg">

            <p>¿Tienes una cuenta? <a href="login.php">Inicia Sesión</a></p>
        </form>
    </div>
</body>

<script src="../js/validacionRegistrarse.js"></script>

</html>