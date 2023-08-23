<div>
    <button class="insertar">Registrar una Cita</button>
</div>

<div class="modal disable">
    <div class="flex-container">
        <form id="formulario" class="form-login" method="POST">
            <div class="header__form">
                <h2>Agendar una Cita</h2> <span class="icon-cross"></span>
            </div>

            <?php
            include '../client/insert/registerCita.php';
            ?>

            <!-- <div id="grupo_cedula" class="grupo">
                <label>Cédula:</label>
                <div class="input-icon">
                    <input type="number" maxlength="8" required name="cedula" class="input__form base" autocomplete="off"><i class="icon-warning display"></i><i class="icon-checkmark confirm display"></i>
                </div>
                <div class="paragraf__error display">La cédula debe tener 7 u 8 caractéres</div>
            </div>-->

            <label>Cédula: </label>
            <input type="number" maxlength="8" required="true" name="cedula" class="input__form">

            <?php
            // CONSULTAR A BASE DE DATOS LAS CAUSAS DE CONSULTAS REGISTRADAS E IMPRIMIRLAS COMO OPCIÓN
            include '../client/connection.php'; //Conexión con base de datos

            $consulta = "SELECT * FROM causa_consulta";
            $query = mysqli_query($conexion, $consulta)
            ?>
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
            <label>Fecha de Atención:</label>
            <input type="date" required="true" name="atencion" min="<?= $limiteFecha; ?>" class="input__form">

            <label>Turno:</label>
            <div class="seleccion">
                <input type="radio" required="true" value="1" name="turno" class=""> Mañana
                <input type="radio" required="true" value="2" name="turno" class=""> Tarde
            </div>

            <?php
            // OBTENER EL ID_DOCTOR según el ID_USUARIO Y ENVIARLO DE FORMA OCULTA
            include '../client/obtenerId.php';
            ?>
            <input type="hidden" name="id_doctor" value="<?php echo $id_doctor; ?>">

            <div class="buttons__form">
                <input type="reset" value="Borrar" class="button__form">
                <input type="submit" value="Agendar Cita" class="button__form loginSend" name="boton_c">
            </div>

            <p>¿El paciente no se encuentra registrado? <a href="parts/modalRegisterSc.php">Agenda su cita aquí</a></p>
        </form>
    </div>
</div>
<!-- <script src="../js/validacionRegistrarse.js"></script> -->
