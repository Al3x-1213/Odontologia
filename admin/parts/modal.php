<div class="buttons__modal">
    <button class="insertar">Registrar una Cita</button>
    <a href="../client/botones/printReport.php"><button title="Reporte" class="print printReport"><i class="icon-printer1 icon"></i></button></a>
</div>

<div class="modal display">
    <div class="flex-container">
        <form method="POST" id="formulario" class="form-login">
            <div class="header__form">
                <h2>Agendar una Cita</h2> <span class="icon-cross xModal"></span>
            </div>

            <?php
            include '../client/connection.php'; //Conexión con base de datos
            include '../client/insert/registerCita.php';
            ?>
            
            <div class="searchPatients">
                <div class="inputs">
                    <div class="inputRecibe">
                        <label for="search"> Buscar pacientes: </label><input type="text" placeholder="Datos del Paciente:" name="search2" id="search2">
                    </div>
                </div>
                <select id="filter2" name="id_paciente" class="display input__form"></select>
            </div>

            <label>Tipo de Paciente: </label>
            <select name="tipoPaciente" id="tipoPaciente">
                <option value="0"></option>
                <option value="1">Asegurado</option>
                <option value="2">Particular</option>
            </select>

            <label>Motivo de la Consulta: </label>
            <select name="causa" id="causa">
                    
            </select>

            <?php
            // BLOQUEAR DÍAS DEL CALENDARIO
            date_default_timezone_set('America/Caracas');
            $fechaActual = date("Y-m-d");
            ?>
            <label>Fecha de Atención:</label>
            <input type="date" required name="atencion" min="<?= $fechaActual; ?>" class="input__form">

            <label>Turno:</label>
            <div class="seleccion">
                <input type="radio" required value="1" name="turno" class=""> Mañana
                <input type="radio" required value="2" name="turno" class=""> Tarde
            </div>

            <?php
            // OBTENER EL ID_DOCTOR según el ID_USUARIO Y ENVIARLO DE FORMA OCULTA
            include '../client/obtenerId.php';
            ?>
            <input type="hidden" name="id_doctor" value="<?php echo $idDoctor; ?>">

            <div class="buttons__form">
                <input type="reset" value="Borrar" class="button__form">
                <input type="submit" value="Agendar Cita" class="button__form loginSend" name="boton_c">
            </div>

            <p>¿El paciente no se encuentra registrado? <a href="parts/modalRegisterSc.php">Agenda su cita aquí</a></p>
        </form>
    </div>
</div>
<script src="js/searchConsulta.js"></script>
<script src="js/searchReason.js"></script>