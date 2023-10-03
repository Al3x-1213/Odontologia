<?php
session_start();
ob_start();
// session_destroy();
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <!-- META ETIQUETAS -->
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- FAVICON -->
        <link rel="icon" type="image/png" href="img/favicon.png"/>

        <!-- ESTILOS CSS -->
        <link rel="stylesheet" href="styles/normalize.css">
        <link rel="stylesheet" href="styles/registrarse.css">
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
        <?php 
        include 'client/messagge.php';
        ?>

        <div class="flex__container">
            <form class="form__recover" method="POST">

            <a href="index.php"><i class="icon-undo2"></i></a>

                <h2 class="title__form">Recuperar Contraseña</h2>

                <?php
                include 'client/update/recoverPassword.php';
                ?>

                <div class="fields__form">
                    <?php
                    $idDatoPersonal = $_GET['id'];
                    ?>
                    <input type="hidden" name="id_dato_personal" value="<?php echo $idDatoPersonal; ?>">

                    <div id="grupo_clave" class="grupo">
                    <label>Contraseña:</label>
                    <div class="input-icon"><input type="password" maxlength="35" name="clave" class="input__form base" autocomplete="off">
                        <i class="icon-eye"></i>
                        <i class="icon-eye-blocked display"></i>
                        <i class="icon-warning display"></i>
                        <i class="icon-checkmark1 display"></i>
                    </div>
                    <div class="paragraf__error1 display">
                        <p>Debe tener al menos 8 caracteres</p>
                    </div>
                    <div class="paragraf__error2 display">
                        <p>Debe tener al menos 1 caracter especial <br>Debe que tener al menos una letra en mayuscula</p>
                    </div>
                </div>

                <div id="grupo_clave2" class="grupo">
                    <label>Confirmar Contraseña:</label>
                    <div class="input-icon"><input type="password" maxlength="35" name="clave2" class="input__form base" autocomplete="off">
                        <i class="icon-eye"></i>
                        <i class="icon-eye-blocked display"></i>
                        <i class="icon-warning display"></i>
                        <i class="icon-checkmark1 display"></i>
                    </div>
                    <div class="paragraf__error1 display">
                        <p>La clave debe coincidir</p>
                    </div>
                    <div class="paragraf__error2 display">
                        <p>Este campo no puede estar vacío<br>Debe tener al menos 8 caracteres</p>
                    </div>
                </div>
                </div>
            </form>
        </div>
    </body>
    <script src="js/messagge.js"></script>
    <script src="admin/js/editPassword.js"></script>
    <script src="js/seePassword.js"></script>
</html>