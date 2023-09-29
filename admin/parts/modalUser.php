<div class="buttons__modal">
    <button class="insertar">Registrar un Usuario</button>
</div>

<div class="modal display">
    <div class="flex-container">
        <form action="../client/insert/insertDoctor.php" method="POST" class="form-login">

            <div class="header__form">
                <h2>Registrar un Usuario</h2> <span class="icon-cross xModal"></span>
            </div>

            <h3>Tu cuenta: </h3>

            <label for="nombre">Usuario:</label>
            <input type="text" maxlength="30" required name="usuario" class="input__form" autocomplete="off">

            <label for="clave">Contraseña:</label>
            <input type="password" maxlength="35" required name="clave" class="input__form">

            <label for="clave">Confirmar Contraseña:</label>
            <input type="password" maxlength="35" required name="clave2" class="input__form">

            <label for="clave">Tipo de Usuario:</label>
            <div class="seleccion">
                <input type="radio" required value="1" name="tipoUser"> Doctor
                <input type="radio" required value="2" name="tipoUser"> Paciente
            </div>


            <h3>Datos Personales: </h3>

            <label for="nombre">Nombre:</label>
            <input type="text" maxlength="25" required name="nombre" class="input__form" autocomplete="off">

            <label for="apellido">Apellido:</label>
            <input type="text" maxlength="25" required name="apellido" class="input__form">

            <label for="cedula">Cédula:</label>
            <input type="number" maxlength="8" required name="cedula" class="input__form">

            <?php
            $limite_fecha = date("Y-m-d");
            ?>
            <label for="edad">Fecha de Nacimiento:</label>
            <input type="date" required name="nacimiento" max="<?= $limite_fecha; ?>" class="input__form">

            <label for="numero">Número de Teléfono Celular:</label>
            <input type="number" maxlength="11" required name="telefono1" class="input__form">

            <label for="numero">Número de Teléfono (opcional):</label>
            <input type="number" maxlength="11" name="telefono2" class="input__form">

            <label for="correo">Correo Electrónico:</label>
            <input type="email" maxlength="60" required name="correo" class="input__form" autocomplete="off">

            <?php
            // CONSULTAR A BASE DE DATOS LAS DISCAPACIDADES E IMPRIMIRLOS COMO OPCIÓN
            include '../client/connection.php';

            $consulta = "SELECT * FROM discapacidades";
            $query = mysqli_query($conexion, $consulta)
            ?>
            <label>¿Tiene alguna Discapacidad:</label>
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

            <label>¿Tiene alguna Alergia?:</label>
            <div class="hora">
                <input type="radio" required value="2" name="alergia" class=""> Sí
                <input type="radio" required value="1" name="alergia" class=""> No
            </div>

            <div class="buttons__form">
                <input type="reset" value="Borrar" name="clear" class="button__form">
                <input type="submit" value="Registrar Usuario" name="boton_reg" class="button__form loginSend">
            </div>
        </form>
    </div>
</div>