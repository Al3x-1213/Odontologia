<div class="buttons__modal">
    <div class="button__modal">
        <button class="insertar">Registrar un Usuario</button>
    </div>
</div>

<div class="modal display">
    <div class="flex-container">
        <form action="../client/insert/insertDoctor.php" method="POST" class="form-login alternative">

            <div class="header__form">
                <h2>Registrar un Usuario</h2> <span class="icon-cross xModal"></span>
            </div>

            <h3>Tu cuenta: </h3>

            <div id="grupo_usuario" class="grupo">
                <label>Usuario:</label>
                <div class="input-icon">
                    <input type="text" maxlength="30" name="usuario" class="input__form base" id="usuario" autocomplete="off">
                    <i class="icon-warning display"></i>
                    <i class="icon-checkmark1 check display"></i>
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
                <div class="input-icon"><input type="password" maxlength="35"  name="clave" class="input__form base" autocomplete="off"><i class="icon-warning display"></i> <i class="icon-checkmark1 check display"></i></div>
                <div class="paragraf__error1 display">
                    <p>Debe tener al menos 8 caracteres</p>
                </div>
                <div class="paragraf__error2 display">
                    <p>Debe tener al menos 1 caracter especial <br>Debe que tener al menos una letra en mayuscula</p>
                </div>
            </div>

            <div id="grupo_clave2" class="grupo">
                <label>Confirmar Contraseña:</label>
                <div class="input-icon"><input type="password" maxlength="35"  name="clave2" class="input__form base" autocomplete="off"><i class="icon-warning display"></i> <i class="icon-checkmark1 check display"></i></div>
                <div class="paragraf__error1 display">
                    <p>La clave debe coincidir</p>
                </div>
                <div class="paragraf__error2 display">
                    <p>Este campo no puede estar vacío<br>Debe tener al menos 8 caracteres</p>
                </div>
            </div>

            <label for="clave">Tipo de Usuario:</label>
            <div class="seleccion">
                <input type="radio" required value="1" name="tipoUser"> Doctor
                <input type="radio" required value="2" name="tipoUser"> Paciente
            </div>


            <h3>Datos Personales: </h3>

            <div id="grupo_nombre" class="grupo">
                <label>Nombre:</label>
                <div class="input-icon"><input type="text" maxlength="25"  name="nombre" class="input__form base" autocomplete="off"><i class="icon-warning display"></i> <i class="icon-checkmark1 check display"></i></div>
                <div class="paragraf__error1 display">
                    <p>Este campo no debe estar vacío<br>No deben haber menos de 3 caracteres ni más de 25</p>
                </div>
                <div class="paragraf__error2 display">
                    <p>Carácter no permitido</p>
                </div>
            </div>

            <div id="grupo_apellido" class="grupo">
                <label>Apellido:</label>
                <div class="input-icon"><input type="text" maxlength="25"  name="apellido" class="input__form base" autocomplete="off"><i class="icon-warning display"></i> <i class="icon-checkmark1 check display"></i></div>
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
                    <i class="icon-checkmark1 check display"></i>
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
            $limite_fecha = date("Y-m-d");
            ?>
            <div id="grupo_nacimiento" class="grupo">
                <label>Fecha de Nacimiento:</label>
                <div class="input-icon">
                    <input type="date"  name="nacimiento" max="<?= $limite_fecha; ?>" class="input__form base">
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
                    <i class="icon-warning display"></i> <i class="icon-checkmark1 check display"></i>
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
                    <i class="icon-warning display"></i><i class="icon-checkmark1 check display"></i>
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
                <div class="input-icon"><input type="email" maxlength="60"  name="correo" class="input__form base" autocomplete="off"><i class="icon-warning display"></i> <i class="icon-checkmark1 check display"></i></div>
                <div class="paragraf__error1 display">
                    <p>debe contener "@" y "."</p>
                </div>
                <div class="paragraf__error2 display">
                    <p>El campo no puede estar vacío<br>No debe tener más 60 caracteres<br>No debe tener menos de 11 caracteres</p>
                </div>
            </div>

            <?php
            // CONSULTAR A BASE DE DATOS LAS DISCAPACIDADES E IMPRIMIRLOS COMO OPCIÓN
            include '../client/connection.php';

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