<?php
include '../client/verificationSessionPatient.php';
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- ESTILOS CSS -->
        <link rel="stylesheet" href="../styles/normalize.css">
        <link rel="stylesheet" href="styles/menu.css">
        <link rel="stylesheet" href="styles/index.css">
        <link rel="stylesheet" href="styles/footer.css">
        <link rel="stylesheet" href="styles/modal.css">
        <link rel="stylesheet" href="../Iconos/style.css">

        <!-- LETRAS UTILIZADAS -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Raleway:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap" rel="stylesheet">

        <title>Marisol Díaz - PACIENTE</title>
    </head>
    <body>
        <?php
        include 'components/menu.html';
        include 'components/menu2.php';
        ?>
        <div class="flex-container">
            <form action="solicitarCita.php" method="POST" class="form-login">
                <h2>Solicitar una Cita</h2>

                <?php
                include '../client/insert/solicitarCita.php'
                ?>

                <label>Tipo de Paciente: </label>
                    <!-- Asegurado<input type="radio" value="1" name="tipoPaciente" id="tipoPaciente">
                    Particular<input type="radio" value="2" name="tipoPaciente" id="tipoPaciente"> -->
                    <!-- <input type="text" name="tipoPaciente" id="tipoPaciente"> -->
                    <select name="tipoPaciente" id="tipoPaciente">
                        <option value="0"></option>
                        <option value="1">Asegurado</option>
                        <option value="2">Particular</option>
                    </select>

                <?php
                // CONSULTAR A BASE DE DATOS LAS CAUSAS DE CONSULTAS REGISTRADAS E IMPRIMIRLAS COMO OPCIÓN
                include '../client/connection.php'; //Conexión con base de datos

                $consulta = "SELECT * FROM causa_consulta";
                $query = mysqli_query($conexion, $consulta)
                ?>
                <label>Motivo: </label>
                <select name="causa" id="causa">
                    
                </select>

                <?php
                // BLOQUEAR DÍAS DEL CALENDARIO
                date_default_timezone_set('America/Caracas');
                $fechaActual = date("Y-m-d");
                ?>
                <label>Fecha de Atención:</label>
                <input type="date" required="true" name="atencion" min="<?= $fechaActual; ?>" class="input__form">

                <label>Turno:</label>
                <div class="seleccion">
                    <input type="radio" required value="1" name="turno" class=""> Mañana
                    <input type="radio" required value="2" name="turno" class=""> Tarde
                </div>

                <?php
                // CONSULTAR A BASE DE DATOS LOS NOMBRES DE LOS DOCTORES E IMPRIMIRLOS COMO OPCIÓN
                $consulta = "SELECT * FROM doctores INNER JOIN datos_personales INNER JOIN cuentas
                ON doctores.id_usuario = cuentas.id_cuenta AND cuentas.id_dato_personal = datos_personales.id_dato_personal";
                $query = mysqli_query($conexion, $consulta)
                ?>
                <label>Doctor: </label>
                <select name="doctor">
                    <option value="0"></option>
                    <?php
                    $i = 0;
                    while ($resultado = mysqli_fetch_array($query)) {
                        $i = $i + 1;
                    ?>
                        <option value="<?php echo $i; ?>"><?php echo $resultado['nombre'] . " " . $resultado['apellido']; ?></option>
                    <?php
                    }
                    ?>
                </select>

                <div class="buttons__form">
                    <input type="reset" value="Borrar" class="button__form">
                    <input type="submit" value="Solicitar Cita" class="button__form loginSend" name="boton_c">
                </div>
            </form>
        </div>
        <script src="js/searchReason.js"></script>
    </body>
</html>