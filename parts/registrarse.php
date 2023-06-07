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

        <title>Marisol Díaz - REGISTRARSE</title>
    </head>

    <body>
        <div class="flex__container">
            <form class="form form__alternative" method="POST"> <!--action="../client/insertar.php"-->

                <a href="../"><i class="icon-cross"></i></a>
                <!-- TITULO -->
                <h2 class="title__form"><a href="../index.php">Registrarse</a></h2>

                <?php
                include '../client/insertar.php';
                ?>

                <div class="fields__form">
                    <h3>Tu cuenta: </h3>

                    <label for="nombre">Usuario:</label>
                    <input type="text" maxlength="30" required="true" name="usuario" class="input__form usuario" autocomplete="off">

                    <label for="clave">Contraseña:</label>
                    <input type="password" maxlength="35" required="true" name="clave" class="input__form clave">

                    <label for="clave">Confirmar Contraseña:</label>
                    <input type="password" maxlength="35" required="true" name="clave2" class="input__form clave2">

                    <h3>Datos Personales: </h3>

                    <label for="nombre">Nombre:</label>
                    <input type="text" maxlength="25" required="true" name="nombre" class="input__form nombre" autocomplete="off">

                    <label for="apellido">Apellido:</label>
                    <input type="text" maxlength="25" required="true" name="apellido" class="input__form apellido">

                    <label for="cedula">Cédula:</label>
                    <input type="number" maxlength="8" required="true" name="cedula" class="input__form cedula">

                    <?php
                    $limiteFecha = date("Y-m-d"); 
                    ?>
                    <label for="edad">Fecha de Nacimiento:</label>
                    <input type="date" required="true" name="nacimiento" max="<?= $limiteFecha; ?>" class="input__form nacimiento">

                    <label for="numero">Teléfono Celular: </label>
                    <input type="number" maxlength="11" required="true" name="telefono1" class="input__form telefono1">

                    <label for="numero">Teléfono (opcional):</label>
                    <input type="number" maxlength="11" name="telefono2" class="input__form telefono2">

                    <label for="correo">Correo Electrónico:</label>
                    <input type="email" maxlength="60" required="true" name="correo" class="input__form correo" autocomplete="off">

                    <input class="button" type="submit" value="Registrarse" name="boton_reg">
                </div>
            </form>
        </div>
    </body>

    <script src="../js/validacionRegistrarse.js"></script>
</html>