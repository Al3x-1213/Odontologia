<div class="buttons__modal">
    <button class="insertar">Registrar una Cita</button>
</div>

<div class="modal display">
    <div class="flex-container">
        <form action="solicitarCita.php" method="POST" class="form-login">

            <h2>Solicitar una Cita</h2><span class="icon-cross xModal"></span>

            <?php
            // include '../client/insert/solicitarCita.php'
            ?>

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
            <label>Fecha de Atención:</label>
            <input type="date" required name="atencion" min="<?= $fechaLimiteMin; ?>" max="<?= $fechaLimiteMax; ?>" class="input__form" id="atencion">

            <div id="blockedDate"></div>

            <label>Turno:</label>
            <div class="seleccion">
                <input type="radio" required value="1" name="turno" class=""> Mañana
                <input type="radio" required value="2" name="turno" class=""> Tarde
            </div>

            <?php
            // CONSULTAR A BASE DE DATOS LOS NOMBRES DE LOS DOCTORES E IMPRIMIRLOS COMO OPCIÓN
            include '../client/connection.php'; //Conexión con base de datos

            $consulta = "SELECT * FROM doctores INNER JOIN datos_personales INNER JOIN cuentas
            ON doctores.id_usuario = cuentas.id_cuenta AND cuentas.id_dato_personal = datos_personales.id_dato_personal";
            $query = mysqli_query($conexion, $consulta);
            
            ?>
            <label>Doctor: </label>
            <select name="doctor">
                <option value="0"></option>
                <?php
                while ($respuesta = mysqli_fetch_array($query)){
                ?>
                    <option value="<?php echo $respuesta['id_dato_personal']; ?>"><?php echo $respuesta['nombre'] . " " . $respuesta['apellido']; ?></option>
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
</div>
<script src="js/searchConsulta.js"></script>
<script src="js/searchReason.js"></script>
<script src="js/searchBlockedDates.js"></script>