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
        <link rel="stylesheet" href="../styles/login.css">
        <link rel="stylesheet" href="../styles/mensajes.css">
        <link rel="stylesheet" href="../Iconos/style.css">

        <!-- LETRAS UTILIZADAS -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">

        <title>Marisol Díaz - INICIAR SESIÓN</title>
    </head>

    <body>
        <div class="flex__container flex__container-alternative">
            <form class="form form-alternative" method="POST">

                <h2 class="title__form">Recuperar Contraseña</h2>

                <?php
                include '../client/recoverPassword.php';
                ?>

                <div class="fields__form">
                    <label>Ingresa tu usuario:</label>
                    <input type="text" maxlength="30" required="true" name="usuario" class="input__form" autocomplete="off">

                    <input class="button" type="submit" value="Enviar" name="boton_rec">
                </div>
            </form>
        </div>
    </body>
</html>