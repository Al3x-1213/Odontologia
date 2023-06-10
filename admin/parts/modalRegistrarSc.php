<?php
include '../../client/verificacion_sesion.php';?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ESTILOS CSS -->
    <link rel="stylesheet" href="../../styles/normalize.css">
    <link rel="stylesheet" href="../styles/menu.css">
    <link rel="stylesheet" href="../../styles/mensajes.css">
    <link rel="stylesheet" href="../styles/footer.css">
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
        <form class="form" method="POST">
            <div class="header__form">
                <h2 class="title__form"><a href="../index.php">Agendar una Cita</a></h2> <a href="../index.php"><i class="icon-cross"></i></a>
            </div>

            <?php
            include '../../client/registrarCitaSc.php';
            ?>

            <h3>Datos Personales: </h3>

            <div id="grupo_nombre" class="grupo">
                <label>Nombre:</label>
                <div class="input-icon"><input type="text" maxlength="25" required name="nombre" class="input__form base" autocomplete="off"><i class="icon-warning display"></i> <i class="icon-checkmark display"></i></div>
                <div class="paragraf__error display"> Nombre no puede tener numeros ni caracteres especiales </div>
            </div>

            <div id="grupo_apellido" class="grupo">
                <label>Apellido:</label>
                <div class="input-icon"><input type="text" maxlength="25" required name="apellido" class="input__form base" autocomplete="off"><i class="icon-warning display"></i> <i class="icon-checkmark display"></i></div>
                <div class="paragraf__error display"> Apellido no puede tener numeros ni caracteres especiales </div>
            </div>

            <div id="grupo_cedula" class="grupo">
                <label>Cédula:</label>
                <div class="input-icon"><input type="number" maxlength="8" required name="cedula" class="input__form base" autocomplete="off"><i class="icon-warning display"></i> <i class="icon-checkmark display"></i></div>
                <div class="paragraf__error display"> Cedula tiene que tener de 7 a 8 caractéres </div>
            </div>

            <?php
            $limiteFecha = date("Y-m-d");
            ?>
            <div id="grupo_nacimiento" class="grupo">
                <label>Fecha de Nacimiento:</label>
                <div class="input-icon"><input type="date" required name="nacimiento" max="<?= $limiteFecha; ?>" class="input__form base"><i class="icon-warning display"></i> <i class="icon-checkmark display"></i></div>
                <div class="paragraf__error display"> la fecha no puede ser la misma o posterior a la de hoy </div>
            </div>

            <div id="grupo_telefono1" class="grupo">
                <label>Telefono celular:</label>
                <div class="input-icon"><input type="number" maxlength="11" required name="telefono1" class="input__form base" autocomplete="off"><i class="icon-warning display"></i> <i class="icon-checkmark display"></i></div>
                <div class="paragraf__error display"> Telefono sólo puede tener 11 caracteres </div>
            </div>

            <div id="grupo_telefono2" class="grupo">
                <label>Telefono (Opcional):</label>
                <div class="input-icon"><input type="number" maxlength="11" required name="telefono2" class="input__form base" autocomplete="off"><i class="icon-warning display"></i> <i class="icon-checkmark display"></i></div>
                <div class="paragraf__error display"> Telefono sólo puede tener 11 caracteres </div>
            </div>

            <div id="grupo_correo" class="grupo">
                <label>Correo Electrónico:</label>
                <div class="input-icon"><input type="email" maxlength="60" required name="correo" class="input__form base" autocomplete="off"><i class="icon-warning display"></i> <i class="icon-checkmark display"></i></div>
                <div class="paragraf__error display"> Correo debe contener @ y . </div>
            </div>

            <h3>Datos de la Cita: </h3>

            <?php
            // CONSULTAR A BASE DE DATOS LAS CAUSAS DE CONSULTAS REGISTRADAS E IMPRIMIRLAS COMO OPCIÓN
            include '../../client/conexion.php'; //Conexión con base de datos

            $consulta = "SELECT * FROM causa_consulta";
            $query = mysqli_query($conexion, $consulta)
            ?>

            <div id="grupo_causa" class="grupo">
                <label>Causa: </label>
                <select name="causa">
                    <option value="0"></option>
                    <?php
                    $i = 0;
                    while ($resultado = mysqli_fetch_array($query)) {
                        $i = $i + 1;
                    ?>
                        <option value="<?php echo $i; ?>"><?php echo $resultado['causa_consulta']; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>

            <?php
            // BLOQUEAR DÍAS DEL CALENDARIO PARA QUE LA SOLICITUD SE HAGA CON MÍNIMO TRES DIAS DE ANTICIPACIÓN
            $day = date("d");
            $limiteDay = $day + 3;

            if (strlen($limiteDay) == 1) {
                $limiteDay = "0" . $limiteDay;
            } else {
                $limiteDay = $limiteDay;
            }

            $limiteFecha = date("Y-m-$limiteDay");
            ?>

            <div id="grupo_atencion" class="grupo">
                <label>Fecha de Atención:</label>
                <input type="date" required name="atencion" min="<?= $limiteFecha; ?>" class="input__form base">
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
            <input type="hidden" name="id_doctor" value="<?php echo $id_doctor; ?>">

            <div class="buttons__form">
                <input type="reset" value="Borrar" class="button__form">
                <input type="submit" value="Agendar Cita" class="button__form loginSend" name="boton_c">
            </div>
        </form>
    </div>

<script src="../../js/validacionRegistrarse.js"></script>
</body>
</html>