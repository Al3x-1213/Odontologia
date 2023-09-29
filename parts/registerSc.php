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

    <!-- FAVICON -->
    <link rel="icon" type="image/png" href="../img/favicon.png"/>

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
            include '../client/insert/insertSc.php';
            ?>

            <div id="grupo_cedula" class="grupo">
                <label>Cédula:</label>
                <div class="input-icon"><input type="number" maxlength="8"  name="cedula" class="input__form base" autocomplete="off"><i class="icon-warning display"></i> <i class="icon-checkmark1 display"></i></div>
                <div class="paragraf__error1 display">
                    <p>El campo no debe estar vacío<br>Debe tener entre 7 a 8 caracteres</p>
                </div>
                <div class="paragraf__error2 display">
                    <p>Caracter no permitido</p>
                </div>
            </div>

            <h3>Tu cuenta: </h3>

            <div id="grupo_usuario" class="grupo">
                <label>Usuario:</label>
                <div class="input-icon">
                    <input type="text" maxlength="30" name="usuario" class="input__form base" id="usuario" autocomplete="off">
                    <i class="icon-warning display"></i>
                    <i class="icon-checkmark1 display"></i>
                </div>
                <div class="paragraf__error1 display">
                    <p>Usuario no puede estar vacío<br>No pueden ser menos de 4 caracteres</p>
                </div>
                <div class="paragraf__error2 display">
                    <p>Caracter especial no permitido</p>
                </div>
                <div class="filterUsuario"></div>
            </div>

            <div id="grupo_clave" class="grupo">
                <label>Contraseña:</label>
                <div class="input-icon"><input type="password" maxlength="35"  name="clave" class="input__form base" autocomplete="off"><i class="icon-warning display"></i> <i class="icon-checkmark1 display"></i></div>
                <div class="paragraf__error1 display">
                    <p>Debe tener al menos 8 caracteres</p>
                </div>
                <div class="paragraf__error2 display">
                    <p>Debe tener al menos 1 caracter especial <br>Debe que tener al menos una letra en mayuscula</p>
                </div>
            </div>

            <div id="grupo_clave2" class="grupo">
                <label>Confirmar Contraseña:</label>
                <div class="input-icon"><input type="password" maxlength="35"  name="clave2" class="input__form base" autocomplete="off"><i class="icon-warning display"></i> <i class="icon-checkmark1 display"></i></div>
                <div class="paragraf__error1 display">
                    <p>La clave debe coincidir</p>
                </div>
                <div class="paragraf__error2 display">
                    <p>Este campo no puede estar vacío<br>Debe tener al menos 8 caracteres</p>
                </div>
            </div>

            <input class="button" type="submit" value="Registrarse" name="boton_reg">

            <p>¿Tienes una cuenta? <a href="login.php">Inicia Sesión</a></p>
        </form>
    </div>
</body>

<script src="../js/validacionRegistrarseSc.js"></script>
<script src="../js/searchFilterSc.js"></script>

</html>