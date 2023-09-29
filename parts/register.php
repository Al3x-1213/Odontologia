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
        <form method="POST" id="formulario" class="form">

            <a href="../"><i class="icon-cross"></i></a>
            <!-- TITULO -->
            <h2 class="title__form"><a href="../index.php">Registrarse</a></h2>

            <p>¿Ha pedido cita previamente pero no tiene cuenta? <a href="registerSc.php">Regístrate aqui</a></p>

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

            <h3>Datos Personales: </h3>

            <div id="grupo_nombre" class="grupo">
                <label>Nombre:</label>
                <div class="input-icon"><input type="text" maxlength="25"  name="nombre" class="input__form base" autocomplete="off"><i class="icon-warning display"></i> <i class="icon-checkmark1 display"></i></div>
                <div class="paragraf__error1 display">
                    <p>Este campo no debe estar vacío<br>No deben haber menos de 3 caracteres ni más de 25</p>
                </div>
                <div class="paragraf__error2 display">
                    <p>Carácter no permitido</p>
                </div>
            </div>

            <div id="grupo_apellido" class="grupo">
                <label>Apellido:</label>
                <div class="input-icon"><input type="text" maxlength="25"  name="apellido" class="input__form base" autocomplete="off"><i class="icon-warning display"></i> <i class="icon-checkmark1 display"></i></div>
                <div class="paragraf__error1 display">
                    <p>Este campo no debe estar vacío<br>No deben haber menos de 3 caracteres ni más de 25</p>
                </div>
                <div class="paragraf__error2 display">
                    <p>Caracter no permitido</p>
                </div>
            </div>

            <div id="grupo_cedula" class="grupo">
                <label>Cédula:</label>
                <div class="input-icon"><input type="number" maxlength="8" name="cedula" class="input__form base" id="cedula" autocomplete="off">
                    <i class="icon-warning display"></i>
                    <i class="icon-checkmark1 display"></i>
                </div>
                <div class="paragraf__error1 display">
                    <p>El campo no debe estar vacío<br>Debe tener entre 7 a 8 caracteres</p>
                </div>
                <div class="paragraf__error2 display">
                    <p>Caracter no permitido</p>
                </div>
                <div class="filterCedula"></div>
            </div>

            <?php
            $limiteFecha = date("Y-m-d");
            ?>

            <div id="grupo_nacimiento" class="grupo">
                <label>Fecha de Nacimiento:</label>
                <div class="input-icon">
                    <input type="date"  name="nacimiento" max="<?= $limiteFecha; ?>" class="input__form base">
                </div>
            </div>

            <div id="grupo_telefono1" class="grupo">
                <label>Telefono celular:</label>
                <div class="input-icon">
                    <select class="pref__numberPhone" name="prefNumber1" required>
                        <option value="0"> - </option>
                        <option value="0212">0212</option>
                        <option value="0412">0412</option>
                        <option value="0414">0414</option>
                        <option value="0424">0424</option>
                        <option value="0416">0416</option>
                        <option value="0426">0426</option>
                    </select>
                    <input type="number" maxlength="11"  name="telefono1" class="input__form phone base" autocomplete="off">
                    <i class="icon-warning display"></i> <i class="icon-checkmark1 display"></i>
                </div>
                <div class="paragraf__error1 display">
                    <p>El campo no debe estar vacío <br>Deben haber 7 digitos</p>
                </div>
                <div class="paragraf__error2 display">
                    <p>Caracter no permitido</p>
                </div>
            </div>

            <div id="grupo_telefono2" class="grupo">
                <label>Telefono (Opcional):</label>
                <div class="input-icon">
                    <select class="pref__numberPhone" name="prefNumber2" required>
                        <option value="0"> - </option>
                        <option value="0212">0212</option>
                        <option value="0412">0412</option>
                        <option value="0414">0414</option>
                        <option value="0424">0424</option>
                        <option value="0416">0416</option>
                        <option value="0426">0426</option>
                    </select>
                    <input type="number" maxlength="11" name="telefono2" class="input__form phone base" autocomplete="off">
                    <i class="icon-warning display"></i><i class="icon-checkmark1 display"></i>
                </div>
                <div class="paragraf__error1 display">
                    <p>Deben haber 7 digitos</p>
                </div>
                <div class="paragraf__error2 display">
                    <p>Caracter no permitido</p>
                </div>
            </div>

            <div id="grupo_correo" class="grupo">
                <label>Correo Electrónico:</label>
                <div class="input-icon"><input type="email" maxlength="60"  name="correo" class="input__form base" autocomplete="off"><i class="icon-warning display"></i> <i class="icon-checkmark1 display"></i></div>
                <div class="paragraf__error1 display">
                    <p>debe contener "@" y "."</p>
                </div>
                <div class="paragraf__error2 display">
                    <p>El campo no puede estar vacío<br>No debe tener más 60 caracteres<br>No debe tener menos de 11 caracteres</p>
                </div>
            </div>

            <label>¿Tiene alguna Discapacidad:</label>
            <div class="hora">
                <input type="radio"  value="2" name="discapacidad"> Sí
                <input type="radio"  value="1" name="discapacidad"> No
            </div>

            <label>¿Es alergico a algun medicamento:</label>
            <div class="hora">
                <input type="radio"  value="2" name="alergia"> Sí
                <input type="radio"  value="1" name="alergia"> No
            </div>

            <input class="button" type="submit" value="Registrarse" name="boton_reg">

            <?php 
            include '../client/insert/insert.php';
            ?>

            <p>¿Tienes una cuenta? <a href="login.php">Inicia Sesión</a></p>
        </form>
    </div>
</body>

<script src="../js/validacionRegistrarse.js"></script>
<script src="../js/searchFilter.js"></script>
</html>