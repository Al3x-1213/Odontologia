<?php
include '../client/verificacion_sesion.php';

function fecha_nacimiento($fecha){
    $fecha_nacimiento = explode("-", $fecha);
    return $fecha = $fecha_nacimiento[2]."-".$fecha_nacimiento[1]."-".$fecha_nacimiento[0];
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
                <form class="form-login" method="POST"> <!--action="../client/insertar.php"-->
                    <div class="header__form">
                        <h2>Registrar un Usuario</h2> <span class="icon-cross"></span>
                    </div>

                    <?php
                    include '../client/insertarDoc.php';
                    ?>

                    <h3>Tu cuenta: </h3>

                    <label for="nombre">Usuario:</label>
                    <input type="text" maxlength="30" required="true" name="usuario" class="input__form" autocomplete="off">

                    <label for="clave">Contraseña:</label>
                    <input type="password" maxlength="35" required="true" name="clave" class="input__form">

                    <label for="clave">Confirmar Contraseña:</label>
                    <input type="password" maxlength="35" required="true" name="clave2" class="input__form">

                    <label for="clave">Tipo de Usuario:</label>
                    <div class="seleccion">
                        <input type="radio" required="true" value="1" name="tipoUser" class=""> Doctor
                        <input type="radio" required="true" value="2" name="tipoUser" class=""> Paciente
                    </div>


                    <h3>Datos Personales: </h3>

                    <label for="nombre">Nombre:</label>
                    <input type="text" maxlength="25" required="true" name="nombre" class="input__form" autocomplete="off">

                    <label for="apellido">Apellido:</label>
                    <input type="text" maxlength="25" required="true" name="apellido" class="input__form">

                    <label for="cedula">Cédula:</label>
                    <input type="number" maxlength="8" required="true" name="cedula" class="input__form">

                    <?php
                    $limite_fecha = date("Y-m-d"); 
                    ?>
                    <label for="edad">Fecha de Nacimiento:</label>
                    <input type="date" required="true" name="nacimiento" max="<?= $limite_fecha; ?>" class="input__form">

                    <label for="numero">Número de Teléfono Celular:</label>
                    <input type="number" maxlength="11" required="true" name="telefono1" class="input__form">

                    <label for="numero">Número de Teléfono (opcional):</label>
                    <input type="number" maxlength="11" name="telefono2" class="input__form">

                    <label for="correo">Correo Electrónico:</label>
                    <input type="email" maxlength="60" required="true" name="correo" class="input__form" autocomplete="off">

                    <div class="buttons__form">
                        <input type="reset" value="Borrar" name="clear" class="button__form">
                        <input type="submit" value="Registrar Paciente" name="boton_reg" class="button__form loginSend">
                    </div>
                </form>
            </div>
        </div>

        <?php
        include '../client/conexion.php'; //Conexión con base de datos

        $consulta = "SELECT * FROM usuarios WHERE id_tipo_usuario = 2";
        $query = mysqli_query($conexion, $consulta);
        ?>

        <h2 class="dia">Pacientes</h2>

        <div class="table">
            <div class="thead__table">
                <!-- <div class="thead id">Id</div> -->
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
                $fecha_de_nacimiento = fecha_nacimiento($resultado['fecha_nacimiento']);
            ?>
                <div class="tbody__table">
                    <!-- <div class="tbody id"><?php //echo $resultado['id_paciente']; ?></div> -->
                    <div class="tbody nom"><?php echo $resultado['nombre'] . " " . $resultado['apellido']; ?></div>
                    <div class="tbody"><?php echo $resultado['usuario']; ?></div>
                    <div class="tbody cedula"><?php echo $resultado['cedula']; ?></div>
                    <div class="tbody edad"><?php echo $resultado['edad']; ?></div>
                    <div class="tbody"><?php echo $fecha_de_nacimiento; ?></div>
                    <div class="tbody contacto"><?php echo $resultado['telefono_1']." ". $resultado['telefono_2']; ?></div>
                    <div class="tbody correo"><?php echo $resultado['correo']; ?></div>

                    <div class="tbody"><a href="editar.php?id=<?php echo $resultado['id_usuario']?>"><button class="editar">Editar</button></a>
                    <a href="../client/eliminar.php?id=<?php echo $resultado['id_usuario']?>"><button class="eliminar">Eliminar</button></a></div>                
                </div>
            <?php
            }
            ?>
        </div>

        <!-- <button class="insertar"> Registrar Un Usuario </button> -->

        <div class="space"></div>

        <?php
        mysqli_close($conexion);
        ?>

        <?php
        include 'components/footer.html';
        ?>

        <script src="js/confirm.js"></script>
        <script src="js/modal.js"></script>
    </body>
</html>