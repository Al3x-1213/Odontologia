<?php
include '../verificationSessionAdmin.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- META ETIQUETAS -->
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- ESTILOS CSS -->
        <link rel="stylesheet" href="../styles/normalize.css">
        <link rel="stylesheet" href="../Iconos/style.css">
        <link rel="stylesheet" href="../styles/login.css">

        <!-- LETRAS UTILIZADAS -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">

        <title>Marisol Díaz - ADMINISTRADOR</title>
    </head>
    <body>
        <?php 
        $idPaciente = $_GET['id'];

        include '../connection.php';
        $consulta = "SELECT * FROM datos_personales WHERE id_dato_personal = '$idPaciente'";
        $query = mysqli_query($conexion, $consulta);

        $resultado = mysqli_fetch_array($query)
        ?>

        <div class="flex__container">
            <form method="POST" autocomplete="off" class="form form__alternative">
                <?php
                include '../update/updateInformationUser.php';
                ?>

                <h2 class="title__form"><a href="pacientes.php">Editar</a></h2>

                <div class="fields__form">
                    <h3>Datos Personales: </h3>

                    <input type="hidden" name="id_dato_personal" value="<?php echo $resultado['id_dato_personal']; ?>">

                    <label for="nombre">Nombre:</label>
                    <input type="text" maxlength="25" required name="nombre" value="<?php echo $resultado['nombre']; ?>" class="input__form">

                    <label for="apellido">Apellido:</label>
                    <input type="text" maxlength="25" required name="apellido" value="<?php echo $resultado['apellido']; ?>" class="input__form">

                    <label for="cedula">Cédula:</label>
                    <input type="number" maxlength="8" required name="cedula" value="<?php echo $resultado['cedula']; ?>" class="input__form">

                    <?php
                    $limite_fecha = date("Y-m-d");
                    ?>
                    <label for="edad">Fecha de Nacimiento:</label>
                    <input type="date" required name="nacimiento" max="<?= $limite_fecha; ?>" value="<?php echo $resultado['nacimiento']; ?>" class="input__form">

                    <label for="numero">Número de Teléfono Celular:</label>
                    <input type="number" maxlength="11" required name="telefono1" value="<?php echo $resultado['telefono_1']; ?>" class="input__form">

                    <label for="numero">Número de Teléfono (opcional):</label>
                    <input type="number" maxlength="11" name="telefono2" value="<?php echo $resultado['telefono_2']; ?>" class="input__form">

                    <label for="correo">Correo Electrónico:</label>
                    <input type="email" maxlength="60" required name="correo" value="<?php echo $resultado['correo']; ?>" class="input__form">

                    <!------------------------------------------------>

                    <!-- <label>¿Tiene alguna Discapacidad?:</label>
                    <div class="hora">
                        <input type="radio" required value="2" name="discapacidad" class=""> Sí
                        <input type="radio" required value="1" name="discapacidad" class=""> No
                    </div>

                    <label>¿Tiene alguna Alergia?:</label>
                    <div class="hora">
                        <input type="radio" required value="2" name="alergia" class=""> Sí
                        <input type="radio" required value="1" name="alergia" class=""> No
                    </div> -->

                    <!------------------------------------------------>
                </div>
                <div class="buttons__form">
                    <input type="reset" value="Borrar" name="clear" class="button__form">
                    <input type="submit" value="Actualizar Usuario" name="button_upd" class="button__form loginSend">
                </div>

            </form>
        </div>
        <?php
        mysqli_close($conexion);
        ?>
    </body>
</html>