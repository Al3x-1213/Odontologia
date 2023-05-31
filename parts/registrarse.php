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

        <!-- LETRAS UTILIZADAS -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">

        <title>Consultorio Riccio</title>
    </head>

    <body>
        <div class="container__img">
            <img src="../img/loginfondo.png" alt="imagen de fondo" class="imgfondo">
        </div>
        <div class="flex__container">
            <form class="form form__alternative" method="POST"> <!--action="../client/insertar.php"-->

                <!-- TITULO -->
                <h2 class="title__form"><a href="../index.php">Registrarse</a></h2>

                <?php
                include '../client/insertar.php';
                ?>

                <div class="fields__form">
                    <h3>Tu cuenta: </h3>

                    <label for="nombre">Usuario:</label>
                    <input type="text" maxlength="30" required="true" name="usuario" class="input__form" autocomplete="off">

                    <label for="clave">Contraseña:</label>
                    <input type="password" maxlength="35" required="true" name="clave" class="input__form">

                    <label for="clave">Confirmar Contraseña:</label>
                    <input type="password" maxlength="35" required="true" name="clave2" class="input__form">

                    <h3>Datos Personales: </h3>

                    <label for="nombre">Nombre:</label>
                    <input type="text" maxlength="25" required="true" name="nombre" class="input__form" autocomplete="off">

                    <label for="apellido">Apellido:</label>
                    <input type="text" maxlength="25" required="true" name="apellido" class="input__form">

                    <label for="cedula">Cédula:</label>
                    <input type="number" maxlength="8" required="true" name="cedula" class="input__form">

                    <?php
                    $limite_fecha = date("Y-m-d"); 
                    ?>
                    <label for="edad">Fecha de Nacimiento:</label>
                    <input type="date" required="true" name="nacimiento" max="<?= $limite_fecha; ?>" class="input__form">

                    <label for="numero">Número de Teléfono Celular:</label>
                    <input type="number" maxlength="11" required="true" name="telefono1" class="input__form">

                    <label for="numero">Número de Teléfono (opcional):</label>
                    <input type="number" maxlength="11" name="telefono2" class="input__form">

                    <label for="correo">Correo Electrónico:</label>
                    <input type="email" maxlength="60" required="true" name="correo" class="input__form" autocomplete="off">

                    <input class="button" type="submit" value="Registrarse" name="boton_reg">
                </div>
            </form>
        </div>
    </body>
</html>