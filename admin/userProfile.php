<?php
include '../client/verificationSessionAdmin.php';
include '../client/orderDate.php';
?>

<!DOCTYPE html>
<html lang="es">
    <head>
    <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- FAVICON -->
        <link rel="icon" type="image/png" href="../img/favicon.png"/>

        <!-- ESTILOS CSS -->
        <link rel="stylesheet" href="../styles/normalize.css">
        <link rel="stylesheet" href="styles/menu.css">
        <link rel="stylesheet" href="styles/index.css">
        <link rel="stylesheet" href="../styles/mensajes.css">
        <link rel="stylesheet" href="styles/tablasPerfil.css">
        <link rel="stylesheet" href="styles/iconsButtons.css">
        <link rel="stylesheet" href="styles/footer.css">
        <link rel="stylesheet" href="../Iconos/style.css">

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
        <?php
        include 'components/menu.html';
        include 'components/menu2.php';

        include '../client/messagge.php';
        ?>

        <?php
        // VARIABLE GLOBAL: ID DEL USUARIO LOGUEADO
        $idUsuario = $_SESSION['id'];

        // OBTENER LA INFORMACIÓN DEL PACIENTE QUE ESTÁ LOGUEADO
        include '../client/connection.php'; //Conexión con base de datos

        $consulta = "SELECT * FROM datos_personales INNER JOIN cuentas INNER JOIN discapacidades INNER JOIN alergias
        ON datos_personales.id_dato_personal = cuentas.id_dato_personal AND datos_personales.id_discapacidad = discapacidades.id_discapacidad
        AND datos_personales.id_alergia = alergias.id_alergia
        WHERE id_cuenta = '$idUsuario'";
        $query = mysqli_query($conexion, $consulta);
        ?>

        <h2 class="dia">Perfil de Usuario</h2>

        <?php
        while ($resultado = mysqli_fetch_array($query)){
            $fechaNacimiento = ordenarFecha($resultado['fecha_nacimiento'])
        ?>
            <div class="tables">
                <div class="tableEdit">
                    <div class="thead">
                        <div class="column">Información Básica</div>
                    </div>
                    <div class="tbody">
                        <div class="row b">
                            <div class="column">Nombre</div>
                            <div class="column"><?php echo $resultado['nombre'] . " " . $resultado['apellido']; ?></div>
                        </div>
                        <div class="row b">
                            <div class="column">Cédula</div>
                            <div class="column"><?php echo $resultado['cedula']; ?></div>
                        </div>
                        <div class="row">
                            <div class="column">Fecha de Nacimiento</div>
                            <div class="column"><?php echo $fechaNacimiento; ?></div>
                        </div>
                    </div>
                </div>

                <div class="tableEdit contactInformation">
                    <div class="thead">
                        <div class="row container">
                            <div class="column titulo">Información de Contacto</div>
                            <div class="buttonEditable hide"><input type="submit" form="editContactInformation" value="Guardar Cambios" name="button_upd"></div>
                        </div>
                    </div>
                    <form action="../client/update/updateContactInformation.php" method="post" id="editContactInformation">
                        <div class="tbody">
                            <div class="row b">
                                <div class="column">Télefono Principal</div>
                                <div class="column" id="divEditable1"><?php echo $resultado['telefono_1']; ?></div>
                                <div class="inputEditable hide" id="inputEditable1">
                                    <select name="prefNumber1" class="pref__input">
                                        <option value="<?php echo substr($resultado['telefono_1'], 0, 4) ?>"> <?php echo substr($resultado['telefono_1'], 0, 4) ?> </option>
                                        <option value="0212">0212</option>
                                        <option value="0412">0412</option>
                                        <option value="0414">0414</option>
                                        <option value="0424">0424</option>
                                        <option value="0416">0416</option>
                                        <option value="0426">0426</option>
                                        </select><input type="number" maxlength="7" required value="<?php echo substr($resultado['telefono_1'], 4, 10); ?>" name="telefono1">
                                </div>
                                <div class="column icono"><button onclick="event.preventDefault()" title="Editar" class="edit" id="button1"><i class="icon-arrow_forward_ios icon"></i></button></div>
                            </div>
                            <div class="row b">
                                <div class="column">Télefono Secundario</div>
                                <div class="column" id="divEditable2"><?php echo $resultado['telefono_2']; ?></div>
                                <div class="inputEditable hide" id="inputEditable2">
                                    <select name="prefNumber2" class="pref__input">
                                        <option value="<?php echo substr($resultado['telefono_2'], 0, 4) ?>"> <?php echo substr($resultado['telefono_2'], 0, 4) ?> </option>
                                        <option value="0">-</option>
                                        <option value="0212">0212</option>
                                        <option value="0412">0412</option>
                                        <option value="0414">0414</option>
                                        <option value="0424">0424</option>
                                        <option value="0416">0416</option>
                                        <option value="0426">0426</option>
                                    </select><input type="number" maxlength="7" value="<?php echo substr($resultado['telefono_2'], 4, 10); ?>" name="telefono2">
                                </div>
                                <div class="column icono"><button onclick="event.preventDefault()" title="Editar" class="edit" id="button2"><i class="icon-arrow_forward_ios icon"></i></button></div>
                            </div>
                            <div class="row">
                                <div class="column">Correo Electrónico</div>
                                <div class="column" id="divEditable3"><?php echo $resultado['correo']; ?></div>
                                <div class="inputEditable hide" id="inputEditable3">
                                    <input type="email" maxlength="60" required value="<?php echo $resultado['correo']; ?>" name="correo">
                                </div>
                                <div class="column icono"><button onclick="event.preventDefault()" title="Editar" class="edit" id="button3"><i class="icon-arrow_forward_ios icon"></i></button></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="tables">
                <div class="tableEdit medicalInformation">
                    <div class="thead">
                        <div class="column">Información Médica</div>
                    </div>
                    <div class="tbody">
                        <div class="row b">
                            <div class="column">Discapacidad</div>
                            <div class="column"><?php echo $resultado['discapacidad']; ?></div>
                        </div>
                        <div class="row">
                            <div class="column">Alergia</div>
                            <div class="column"><?php echo $resultado['alergia']; ?></div>
                        </div>
                    </div>
                </div>

                <div class="tableEdit accountInformation">
                    <div class="thead">
                        <div class="row container">
                            <div class="column titulo">Cuenta de Usuario</div>
                            <div class="buttonEditable2 hide"><input type="submit" form="editAccountInformation" value="Guardar Cambios" name="button_upd"></div>
                        </div>
                    </div>
                    <form action="../client/update/updateUser.php" method="post" id="editAccountInformation">
                        <div class="tbody">
                            <div class="row b">
                                <div class="column">Usuario</div>
                                <div class="column" id="divEditable4"><?php echo $resultado['usuario']; ?></div>
                                <div class="inputEditable hide" id="inputEditable4">
                                    <input type="text" maxlength="30" required value="<?php echo $resultado['usuario']; ?>" name="usuario">
                                </div>
                                <!-- <div class="column icono"><button onclick="event.preventDefault()" title="Editar" class="edit" id="button4"><i class="icon-arrow_forward_ios icon"></i></button></div> -->
                            </div>
                            <div class="row b">
                                <div class="column">Contraseña</div>
                                <div class="column" id="password">
                                    <?php
                                    $clave = $resultado['clave'];
                                    $claveArray = str_split($clave);

                                    $contador = 0;
                                    foreach ($claveArray as $elemento) {
                                        $contador = $contador + 1;
                                        echo "•";
                                    }
                                    ?>
                                </div>
                                <div class="column icono"><button onclick="event.preventDefault()" title="Editar" class="edit" id="button5"><i class="icon-arrow_forward_ios icon"></i></button></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <?php
        }

        include 'components/footer.html';
        ?>
    </body>
    <script src="js/editarPerfil.js"></script>
    <script src="../js/messagge.js"></script>
</html>