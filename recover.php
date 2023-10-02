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
        <link rel="stylesheet" href="styles/normalize.css">
        <link rel="stylesheet" href="styles/login.css">
        <link rel="stylesheet" href="styles/mensajes.css">
        <link rel="stylesheet" href="Iconos/style.css">

        <!-- LETRAS UTILIZADAS -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">

        <title>Marisol Díaz - RECUPERAR CONTRASEÑA</title>
    </head>

    <body>
        <div class="flex__container">
            <form class="form__recover" method="POST">

                <h2 class="title__form">Recuperar Contraseña</h2>

                <?php
                include 'client/update/recoverPassword.php';
                ?>

                <div class="fields__form">
                    <?php
                    $idDatoPersonal = $_GET['id'];
                    ?>
                    <input type="hidden" name="id_dato_personal" value="<?php echo $idDatoPersonal; ?>">

                    <label for="clave">Contraseña Nueva:</label>
                    <input type="password" maxlength="35" required name="clave" class="input__form">

                    <label for="clave">Confirmar Contraseña Nueva:</label>
                    <input type="password" maxlength="35" required name="clave2" class="input__form">

                    <input class="input__button" type="submit" value="Restablecer Contraseña" name="button_rec">
                </div>
            </form>
        </div>
    </body>
</html>