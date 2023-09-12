<?php
include '../client/verificationSessionAdmin.php';

include '../client/orderDate.php';

$tableShow = $_GET['value'];

if($tableShow == '' || $tableShow == null){
    $tableShow = 1;
}

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
        <link rel="stylesheet" href="styles/usuarios.css">
        <link rel="stylesheet" href="styles/modal.css">
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
        ?>

        <div >
            <button class="insertar">Registrar un Usuario</button>
        </div>

        <div class="modal disable">
            <div class="flex-container">
                <form class="form-login" method="POST" action="../client/insert/insertRegistered.php">

                    <div class="header__form">
                        <h2>Registrar un Usuario</h2> <span class="icon-cross"></span>
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

                    <!------------------------------------------------>

                    <label>¿Tiene alguna Discapacidad?:</label>
                    <div class="hora">
                        <input type="radio" required value="2" name="discapacidad" class=""> Sí
                        <input type="radio" required value="1" name="discapacidad" class=""> No
                    </div>

                    <label>¿Tiene alguna Alergia?:</label>
                    <div class="hora">
                        <input type="radio" required value="2" name="alergia" class=""> Sí
                        <input type="radio" required value="1" name="alergia" class=""> No
                    </div>

                    <!------------------------------------------------>

                    <div class="buttons__form">
                        <input type="reset" value="Borrar" name="clear" class="button__form">
                        <input type="submit" value="Registrar Usuario" name="boton_reg" class="button__form loginSend">
                    </div>
                </form>
            </div>
        </div>

        <h2 class="dia">Usuarios</h2>

        <div class="users">
            <div class="dia"><a class="<?php if($tableShow == 1){?>selection<?php }else{?><?php } ?>" href="registeredUser.php?value=<?php echo 1 ?>">Todos</a></div>
            <div class="dia"><a class="<?php if($tableShow == 2){?>selection<?php }else{?><?php } ?>" href="registeredUser.php?value=<?php echo 2 ?>">Pacientes</a></div>
            <div class="dia"><a class="<?php if($tableShow == 3){?>selection<?php }else{?><?php } ?>" href="registeredUser.php?value=<?php echo 3 ?>">Doctores</a></div>
        </div>

        <?php
        include '../client/connection.php'; //Conexión con base de datos

        // TODOS LOS USUARIOS
        $consulta = "SELECT * FROM usuarios";
        $query = mysqli_query($conexion, $consulta);
        ?>

        <div class="table slice <?php if($tableShow == 1){?>active<?php }else{?> desactive <?php } ?>"> <!--slice-->
            <div class="thead__table">
                <div class="thead">Paciente</div>
                <div class="thead">Usuario</div>
                <div class="thead cedula">Cédula</div>
                <div class="thead edad">Edad</div>
                <div class="thead">Fecha de Nacimiento</div>
                <div class="thead">Télefono</div>
                <div class="thead correo">Correo Electrónico</div>
                <div class="thead">Acciones</div>
            </div>

            <?php
            while ($resultado = mysqli_fetch_array($query)) {
                $fechaNacimiento = ordenarFecha($resultado['fecha_nacimiento']);
            ?>
                <div class="tbody__table">
                    <div class="tbody nom"><?php echo $resultado['nombre'] . " " . $resultado['apellido']; ?></div>
                    <div class="tbody"><?php echo $resultado['usuario']; ?></div>
                    <div class="tbody cedula"><?php echo $resultado['cedula']; ?></div>
                    <div class="tbody edad"><?php echo $resultado['edad']; ?></div>
                    <div class="tbody"><?php echo $fechaNacimiento; ?></div>
                    <div class="tbody contacto"><?php echo $resultado['telefono_1']." ". $resultado['telefono_2']; ?></div>
                    <div class="tbody correo"><?php echo $resultado['correo']; ?></div>

                    <div class="tbody">
                        <a href="editar.php?id=<?php echo $resultado['id_usuario']?>"><button title="Modificar" class="update"><i class="icon-pencil icon"></i></button></a>
                        <a href="../client/eliminar.php?id=<?php echo $resultado['id_usuario']?>"><button title="Eliminar" class="delete"><i class="icon-bin icon"></i></button></a>
                    </div>                
                </div>
            <?php
            }
            ?>
        </div>

        <?php
        // PACIENTES
        $consulta = "SELECT * FROM usuarios WHERE id_tipo_usuario = 2";
        $query = mysqli_query($conexion, $consulta);
        ?>

        <div class="table slice <?php if($tableShow == 2){?>active<?php }else{?>desactive<?php } ?>">
            <div class="thead__table">
                <div class="thead">Paciente</div>
                <div class="thead">Usuario</div>
                <div class="thead cedula">Cédula</div>
                <div class="thead edad">Edad</div>
                <div class="thead">Fecha de Nacimiento</div>
                <div class="thead">Télefono</div>
                <div class="thead correo">Correo Electrónico</div>
                <div class="thead">Acciones</div>
            </div>

            <?php
            while ($resultado = mysqli_fetch_array($query)) {
                $fechaNacimiento = ordenarFecha($resultado['fecha_nacimiento']);
            ?>
                <div class="tbody__table">
                    <div class="tbody nom"><?php echo $resultado['nombre'] . " " . $resultado['apellido']; ?></div>
                    <div class="tbody"><?php echo $resultado['usuario']; ?></div>
                    <div class="tbody cedula"><?php echo $resultado['cedula']; ?></div>
                    <div class="tbody edad"><?php echo $resultado['edad']; ?></div>
                    <div class="tbody"><?php echo $fechaNacimiento; ?></div>
                    <div class="tbody contacto"><?php echo $resultado['telefono_1']." ". $resultado['telefono_2']; ?></div>
                    <div class="tbody correo"><?php echo $resultado['correo']; ?></div>

                    <div class="tbody">
                        <a href="editar.php?id=<?php echo $resultado['id_usuario']?>"><button title="Modificar" class="update"><i class="icon-pencil icon"></i></button></a>
                        <a href="../client/eliminar.php?id=<?php echo $resultado['id_usuario']?>"><button title="Eliminar" class="delete"><i class="icon-bin icon"></i></button></a>
                    </div>                
                </div>
            <?php
            }
            ?>
        </div>

        <?php
        // DOCTORES
        $consulta = "SELECT * FROM usuarios WHERE id_tipo_usuario = 1";
        // $consulta = "SELECT * FROM doctores INNER JOIN usuarios ON doctores.id_usuario = usuarios.id_usuario";
        $query = mysqli_query($conexion, $consulta);
        ?>

        <div class="table slice <?php if($tableShow == 3){?>active<?php }else{?> desactive <?php } ?>"> <!--slice-->
            <div class="thead__table">
                <div class="thead">Paciente</div>
                <div class="thead">Usuario</div>
                <div class="thead cedula">Cédula</div>
                <div class="thead edad">Edad</div>
                <div class="thead">Fecha de Nacimiento</div>
                <div class="thead">Télefono</div>
                <div class="thead correo">Correo Electrónico</div>
                <div class="thead">Acciones</div>
            </div>

            <?php
            while ($resultado = mysqli_fetch_array($query)) {
                $fechaNacimiento = ordenarFecha($resultado['fecha_nacimiento']);
            ?>
                <div class="tbody__table">
                    <div class="tbody nom"><?php echo $resultado['nombre'] . " " . $resultado['apellido']; ?></div>
                    <div class="tbody"><?php echo $resultado['usuario']; ?></div>
                    <div class="tbody cedula"><?php echo $resultado['cedula']; ?></div>
                    <div class="tbody edad"><?php echo $resultado['edad']; ?></div>
                    <div class="tbody"><?php echo $fechaNacimiento; ?></div>
                    <div class="tbody contacto"><?php echo $resultado['telefono_1']." ". $resultado['telefono_2']; ?></div>
                    <div class="tbody correo"><?php echo $resultado['correo']; ?></div>

                    <div class="tbody">
                        <a href="editar.php?id=<?php echo $resultado['id_usuario']?>"><button title="Modificar" class="update"><i class="icon-pencil icon"></i></button></a>
                        <a href="../client/eliminar.php?id=<?php echo $resultado['id_usuario']?>"><button title="Eliminar" class="delete"><i class="icon-bin icon"></i></button></a>
                    </div>                
                </div>
            <?php
            }
            ?>
        </div>
        
        <?php
        mysqli_close($conexion);
        ?>

        <div class="space"></div>

        <?php
        include 'components/footer.html';
        ?>

        <script src="js/confirm.js"></script>
        <script src="js/modal.js"></script>
    </body>
</html>