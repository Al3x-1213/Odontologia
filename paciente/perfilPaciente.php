<?php
include '../client/verificationSessionPatient.php';

include '../client/orderDate.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ESTILOS CSS -->
    <link rel="stylesheet" href="../styles/normalize.css">
    <link rel="stylesheet" href="../styles/mensajes.css">
    <link rel="stylesheet" href="styles/menu.css">
    <link rel="stylesheet" href="styles/menu2.css">
    <link rel="stylesheet" href="styles/tablasPerfil.css">
    <link rel="stylesheet" href="styles/iconosEditProfile.css">
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

    include '../client/messagge.php';
    ?>

    <?php
    // VARIABLE GLOBAL: ID DEL USUARIO LOGUEADO
    $idUsuario = $_SESSION['id'];

    // OBTENER LA INFORMACIÓN DEL PACIENTE QUE ESTÁ LOGUEADO
    include '../client/connection.php'; //Conexión con base de datos

    $consulta = "SELECT * FROM datos_personales INNER JOIN cuentas
        ON datos_personales.id_dato_personal = cuentas.id_dato_personal
        WHERE id_cuenta = '$idUsuario'";
    $query = mysqli_query($conexion, $consulta);
    ?>

    <h2 class="dia">Perfil de Usuario</h2>

    <?php
    while ($resultado = mysqli_fetch_array($query)) {
        $fechaNacimiento = ordenarFecha($resultado['fecha_nacimiento'])
    ?>
        <div class="tables">
            <div class="table">
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

            <div class="table contactInformation">
                <div class="thead">
                    <div class="row container">
                        <div class="column titulo">Información de Contacto</div>
                        <div class="buttonEditable hide"><input type="submit" form="editContactInformation" value="Guardar Cambios" name="boton_upd"></div>
                    </div>
                </div>
                <form action="../client/update/updateContactInformation.php" method="post" id="editContactInformation">
                    <div class="tbody">
                        <div class="row b">
                            <div class="column">Télefono Principal</div>
                            <div class="column" id="divEditable1"><?php echo $resultado['telefono_1']; ?></div>
                            <div class="inputEditable hide" id="inputEditable1">
                                <input type="number" maxlength="11" required value="<?php echo $resultado['telefono_1']; ?>" name="telefono1">
                            </div>
                        </div>
                        <div class="row b">
                            <div class="column">Télefono Secundario</div>
                            <div class="column" id="divEditable2"><?php echo $resultado['telefono_2']; ?></div>
                            <div class="inputEditable hide" id="inputEditable2">
                                <input type="number" maxlength="11" value="<?php echo $resultado['telefono_2']; ?>" name="telefono2">
                            </div>
                        </div>
                        <div class="row">
                            <div class="column">Correo Electrónico</div>
                            <div class="column" id="divEditable3"><?php echo $resultado['correo']; ?></div>
                            <div class="inputEditable hide" id="inputEditable3">
                                <input type="email" maxlength="60" required value="<?php echo $resultado['correo']; ?>" name="correo">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="tableAccount">
            <div class="table accountInformation">
                <div class="thead">
                    <div class="row container">
                        <div class="column titulo2">Cuenta de Usuario</div>
                        <div class="buttonEditable2 hide"><input type="submit" form="editAccountInformation" value="Guardar Cambios" name="boton_upd"></div>
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
                                    echo "*";
                                }
                                ?>
                            </div>
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
<script src="js/messagge.js"></script>

</html>