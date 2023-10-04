<?php
include '../../client/verificationSessionAdmin.php';
include '../../client/messagge.php';
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- FAVICON -->
        <link rel="icon" type="image/png" href="../../img/favicon.png"/>

        <!-- ESTILOS CSS -->
        <link rel="stylesheet" href="../../styles/normalize.css">
        <link rel="stylesheet" href="../../styles/mensajes.css">
        <link rel="stylesheet" href="../../styles/registrarse.css">
        <link rel="stylesheet" href="../../Iconos/style.css">

        <!-- LETRAS UTILIZADAS -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Raleway:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap" rel="stylesheet">

        <title>Marisol Díaz - ADMINISTRADOR</title>
    </head>

    <body>
        <div class="flex__container">
            <form class="form" method="POST" id="formulario1">
                <div class="header__form">
                    <h2 class="title__form"><a href="../index.php">Agendar una Cita</a></h2> <a href="../index.php"><i class="icon-cross"></i></a>
                </div>

                <?php
                include '../../client/insert/registerCitaSc.php';
                ?>

                <!-- DATOS DEL PACIENTE -->

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

                    <div class="filterCedula">

                    </div>
                </div>

                <?php
                // BLOQUEAR DÍAS DEL CALENDARIO
                date_default_timezone_set('America/Caracas');
                $fechaActual = date("Y-m-d");
                ?>
                <div id="grupo_nacimiento" class="grupo">
                    <label>Fecha de Nacimiento:</label>
                    <div class="input-icon">
                        <input type="date"  name="nacimiento" max="<?= $fechaActual; ?>" class="input__form base">
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
                        <input type="number" maxlength="7"  name="telefono1" class="input__form phone base" autocomplete="off">
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
                        <input type="number" maxlength="7" name="telefono2" class="input__form phone base" autocomplete="off">
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

                <?php
                // CONSULTAR A BASE DE DATOS LAS DISCAPACIDADES E IMPRIMIRLOS COMO OPCIÓN
                include '../../client/connection.php';

                $consulta = "SELECT * FROM discapacidades";
                $query = mysqli_query($conexion, $consulta)
                ?>
                <label>¿Tiene alguna discapacidad?</label>
                <select name="discapacidad">
                    <option value="0"></option>
                    <?php
                    while ($resultado = mysqli_fetch_array($query)) {
                    ?>
                        <option value="<?php echo $resultado['id_discapacidad']; ?>"><?php echo $resultado['discapacidad']; ?></option>
                    <?php
                    }
                    ?>
                </select>

                <label>¿Tiene alguna Alergia:</label>
                <div class="hora">
                    <input type="radio" required value="2" name="alergia" class=""> Sí
                    <input type="radio" required value="1" name="alergia" class=""> No
                </div>

                <!-- DATOS DE LA CONSULTA -->

                <h3>Datos de la Cita: </h3>

                <label>Tipo de Paciente: </label>
                <select name="tipoPaciente" id="tipoPaciente">
                    <option value="0"></option>
                    <option value="1">Particular</option>
                    <option value="2">Asegurado</option>

                </select>

                <label>Motivo de la Consulta: </label>
                <select name="causa" id="causa">

                </select>

                <?php
                // BLOQUEAR DÍAS DEL CALENDARIO
                date_default_timezone_set('America/Caracas');
                $fechaActual = date("Y-m-d");
                $fechaLimiteMin = strtotime($fechaActual."+ 1 days");
                $fechaLimiteMin = date("Y-m-d", $fechaLimiteMin);
                $fechaLimiteMax = strtotime($fechaActual."+ 21 days");
                $fechaLimiteMax = date("Y-m-d", $fechaLimiteMax);
                ?>
                <div id="grupo_atencion" class="grupo">
                    <label>Fecha de Atención:</label>
                    <input type="date" required name="atencion" min="<?= $fechaLimiteMin; ?>" max="<?= $fechaLimiteMax; ?>" class="input__form base" id="atencion">
                    <div id="blockedDate"></div>
                </div>
                
                <div id="grupo_seleccion" class="grupo">
                    <label>Turno:</label>
                    <div class="hora">
                        <input type="radio" required value="1" name="turno" class=""> Mañana
                        <input type="radio" required value="2" name="turno" class=""> Tarde
                    </div>
                </div>

                <?php
                // OBTENER EL ID_DOCTOR según el ID_USUARIO Y ENVIARLO DE FORMA OCULTA
                include '../../client/obtenerId.php';
                ?>
                <input type="hidden" name="id_doctor" value="<?php echo $idDoctor; ?>">

                <div class="buttons__form">
                    <input type="reset" value="Borrar" class="button__form remove">
                    <input type="submit" value="Agendar Cita" class="button__form loginSend" name="boton_c">
                </div>
            </form>
        </div>

    <script src="../js/searchFilterIc.js"></script>
    <script src="../js/validacionRegistrarseSc.js"></script>
    <script src="../../js/messagge.js"></script>
    <script src="../js/searchReasonSc.js"></script>
    <script src="../js/searchBlockedDatesSc.js"></script>
    </body>
</html>