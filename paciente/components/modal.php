<div class="buttons__modal">
    <button class="insertar">Registrar una Cita</button>
</div>

<div class="modal display">
    <div class="flex-container">
        <form action="solicitarCita.php" method="POST" class="form-login">

            <h2>Solicitar una Cita</h2><span class="icon-cross xModal"></span>

            <?php
            include '../client/insert/solicitarCita.php'
            ?>

            <?php
            // CONSULTAR A BASE DE DATOS LAS CAUSAS DE CONSULTAS REGISTRADAS E IMPRIMIRLAS COMO OPCIÓN
            include '../client/connection.php'; //Conexión con base de datos

            $consulta = "SELECT * FROM causa_consulta";
            $query = mysqli_query($conexion, $consulta)
            ?>
            <label>Motivo: </label>
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
    </div>
</div>
<script src="js/searchConsulta.js"></script>