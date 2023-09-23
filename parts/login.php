<?php
session_start();
ob_start();
// $mensaje = $_SESSION['mensaje'];
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
        <!-- <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet"> -->

        <title>Marisol Díaz - INICIAR SESIÓN</title>
    </head>

    <body>
        <?php 
            // if($mensaje == 1){ 
            //     ?>
                <!-- <div class="messagge messagge__success"> Usuario Registrado Exitosamente <i class="icon-cross messagge__icon"></i> </div> -->
                <?php
            // }else if($mensaje == 2){
            //     ?>
                <!-- <div class="messagge messagge__error"> Error al registrar usuario <i class="icon-cross messagge__icon"></i> </div> -->
                <?php
            // }
        ?>
        <div class="flex__container flex__container-alternative">
            <form class="form form-alternative" method="POST">
                <!-- CODIGO DE ICONO -->
                <a href="../"><i class="icon-cross"></i></a>
                <div class="icon__form">
                  <div class="icon__head"></div>
                  <div class="icon__body"></div>
                </div>

                <!-- TITULO -->
                <h2 class="title__form">Iniciar Sesión</h2>

                <?php
                include '../client/validationLogin.php';
                ?>

                <div class="fields__form">
                    <label>Usuario:</label>
                    <input type="text" maxlength="30" required="true" name="usuario" class="input__form" autocomplete="off">

                    <label>Contraseña:</label>
                    <input type="password" maxlength="35" required="true" name="clave" class="input__form">

                    <input class="button" type="submit" value="Enviar" name="boton_log">

                    <p>¿No tienes una cuenta? <a href="register.php">Regístrate</a></p>
                    <p>¿Has olvidado tu contraseña? <a href="recover.php">Recupérala aquí</a></p>
                </div>
            </form>
        </div>
    </body>

    <!-- <script src="../js/messagge.js"></script> -->
</html>