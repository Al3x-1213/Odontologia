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
        <link rel="stylesheet" href="../../styles/mensajes.css">
        <link rel="stylesheet" href="../../styles/registrarse.css">
        <link rel="stylesheet" href="../../styles/login.css">

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

        $respuesta = mysqli_fetch_array($query)
        ?>

        <div class="flex__container">
            <form method="POST" autocomplete="off" class="form form__alternative">
                <h2 class="title__form"><a href="pacientes.php">Editar Perfil de <?php echo $respuesta['nombre']. " ". $respuesta['apellido']; ?></a></h2>

                <?php
                include '../update/updateInformationUser.php';
                ?>

                <input type="hidden" name="id_dato_personal" value="<?php echo $respuesta['id_dato_personal']; ?>">

                <div id="grupo_nombre" class="grupo">
                    <label>Nombre:</label>
                    <div class="input-icon"><input type="text" maxlength="25" required name="nombre" value="<?php echo $respuesta['nombre']; ?>" class="input__form base"><i class="icon-warning display"></i> <i class="icon-checkmark1 display"></i></div>
                    <div class="paragraf__error1 display"> 
                        <p>Nombre no puede estar vacío<br>No pueden ser menos de 3 caracteres</p>
                    </div>
                    <div class="paragraf__error2 display">
                        <p>Carácter no permitido</p>
                    </div>
                </div>

                <div id="grupo_apellido" class="grupo">
                    <label>Apellido:</label>
                    <div class="input-icon"><input type="text" maxlength="25" required name="apellido" value="<?php echo $respuesta['apellido']; ?>" class="input__form base"><i class="icon-warning display"></i> <i class="icon-checkmark1 display"></i></div>
                    <div class="paragraf__error1 display"> 
                        <p>Apellido no puede estar vacío<br>No pueden ser menos de 3 caracteres</p>
                    </div>
                    <div class="paragraf__error2 display">
                        <p>Caracter no permitido</p>
                    </div>
                </div>

                <div id="grupo_cedula" class="grupo">
                    <label>Cédula:</label>
                    <div class="input-icon"><input type="number" maxlength="8" required name="cedula" value="<?php echo $respuesta['cedula']; ?>" class="input__form base"><i class="icon-warning display"></i> <i class="icon-checkmark1 display"></i></div>
                    <div class="paragraf__error1 display"> 
                        <p>El campo no debe estar vacío</p>
                    </div>
                    <div class="paragraf__error2 display">
                        <p>Caracter no permitido</p>
                    </div>
                </div>

                <?php
                $limiteFecha = date("Y-m-d");
                ?>

                <div id="grupo_nacimiento" class="grupo">
                    <label>Fecha de Nacimiento:</label>
                    <div class="input-icon"><input type="date" required name="nacimiento" max="<?= $limiteFecha; ?>" value="<?php echo $respuesta['nacimiento']; ?>" class="input__form base"><i class="icon-warning display"></i> <i class="icon-checkmark1 display"></i></div>
                    <div class="paragraf__error1 display"> 
                        <p>El campo no debe estar vacío</p>
                    </div>
                    <div class="paragraf__error2 display">
                        <p>Fecha no puede ser mayor a la fecha de hoy</p>
                    </div>
                </div>

                <div id="grupo_telefono1" class="grupo">
                    <label>Telefono celular:</label>
                    <div class="input-icon"><input type="number" maxlength="11" required name="telefono1" value="<?php echo $respuesta['telefono_1']; ?>" class="input__form base"><i class="icon-warning display"></i> <i class="icon-checkmark1 display"></i></div>
                    <div class="paragraf__error1 display"> 
                        <p>El campo no debe estar vacío <br>Deben haber 11 digitos</p>
                    </div>
                    <div class="paragraf__error2 display">
                        <p>Caracter no permitido</p>
                    </div>
                </div>

                <div id="grupo_telefono2" class="grupo">
                    <label>Telefono (Opcional):</label>
                    <div class="input-icon"><input type="number" maxlength="11" name="telefono2" value="<?php echo $respuesta['telefono_2']; ?>" class="input__form base"><i class="icon-warning display"></i> <i class="icon-checkmark1 display"></i></div>
                    <div class="paragraf__error1 display"> 
                        <p>Deben haber 11 digitos</p>
                    </div>
                    <div class="paragraf__error2 display">
                        <p>Caracter no permitido</p>
                    </div>
                </div>

                <div id="grupo_correo" class="grupo">
                    <label>Correo Electrónico:</label>
                    <div class="input-icon"><input type="email" maxlength="60" required name="correo" value="<?php echo $respuesta['correo']; ?>" class="input__form base"><i class="icon-warning display"></i> <i class="icon-checkmark1 display"></i></div>
                    <div class="paragraf__error1 display"> 
                        <p>debe contener "@" y "."</p>
                    </div>
                    <div class="paragraf__error2 display">
                        <p>El campo no puede estar vacío<br>No debe tener más 60 caracteres<br>No debe tener menos de 11 caracteres</p>
                    </div>
                </div>

                <!-- <label>¿Tiene alguna Discapacidad:</label>
                <div class="hora">
                    <input type="radio" required value="2" name="discapacidad"> Sí
                    <input type="radio" required value="1" name="discapacidad"> No
                </div>

                <label>¿Es alergico a algun medicamento:</label>
                <div class="hora">
                    <input type="radio" required value="2" name="alergia"> Sí
                    <input type="radio" required value="1" name="alergia"> No
                </div> -->

                <div class="buttons__form">
                    <input type="reset" value="Borrar" name="clear" class="button">
                    <input type="submit" value="Actualizar Usuario" name="button_upd" class="button">
                </div>
            </form>
        </div>
        <?php
        mysqli_close($conexion);
        ?>
    </body>

    
</html>