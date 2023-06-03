<?php
include '../client/verificacion_sesion.php';
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

        <title>Consultorio Riccio - PACIENTE</title>
    </head>
    <body>
        <?php
        include 'components/menu.html';
        include 'components/menu2.php';
        ?>

        <?php
        // VARIABLE GLOBAL: ID DEL USUARIO LOGUEADO
        $id= $_SESSION['id'];

        // OBTENER LA INFORMACIÓN DE TODAS LAS CITAS A LAS QUE ASISTIÓ EL PACIENTE QUE ESTÁ LOGUEADO
        include '../client/conexion.php'; //Conexión con base de datos

        $consulta = "SELECT * FROM consultas INNER JOIN usuarios INNER JOIN causa_consulta INNER JOIN doctores INNER JOIN status_consulta
        ON consultas.id_paciente = usuarios.id_usuario AND consultas.id_causa_consulta = causa_consulta.id_causa_consulta
        AND consultas.id_doctor = doctores.id_doctor AND consultas.id_status_consulta = status_consulta.id_status_consulta
        WHERE consultas.id_status_consulta = 1 AND consultas.id_paciente = '$id'";
        $query = mysqli_query($conexion, $consulta);
        ?>

        <h2 class="dia">Historial de citas</h2>

        <div class="table">
            <div class="thead__table">
                <!-- <div class="thead id">Id</div> -->
                <!-- <div class="thead">Paciente</div> -->
                <!-- <div class="thead">Cédula</div> -->
                <!-- <div class="thead">Edad</div> -->
                <!-- <div class="thead">Fecha de Nacimiento</div> -->
                <!-- <div class="thead">Télefono</div> -->
                <!-- <div class="thead">Télefono</div> -->
                <div class="thead causa">Causa de la Consulta</div>
                <div class="thead">Fecha de Atención</div>
                <div class="thead">Doctor</div>
                <!-- <div class="thead">Fecha de Solicitud</div> -->
                <!-- <div class="thead">Acciones</div> -->
            </div>

            <?php
            while ($resultado = mysqli_fetch_array($query)) {
            ?>
                <div class="tbody__table">
                    <!-- <div class="tbody id"><?php //echo $resultado['id_consulta']; ?></div> -->
                    <!-- <div class="tbody nom"><?php //echo $resultado['nombre'] . " " . $resultado['apellido']; ?></div> -->
                    <!-- <div class="tbody"><?php //echo $resultado['cedula']; ?></div> -->
                    <!-- <div class="tbody"><?php //echo $resultado['edad']; ?></div> -->
                    <!-- <div class="tbody"><?php //echo $resultado['fecha_nacimiento']; ?></div> -->
                    <!-- <div class="tbody"><?php //echo $resultado['telefono_1']; ?></div> -->
                    <!-- <div class="tbody"><?php //echo $resultado['telefono_2']; ?></div> -->
                    <div class="tbody causa"><?php echo $resultado['causa_consulta']; ?></div>
                    <div class="tbody"><?php echo $resultado['fecha_atencion']; ?></div>

                    <div class="tbody nom"><?php
                    $id_doctor = $resultado['id_doctor'];

                    $consulta = "SELECT * FROM doctores INNER JOIN usuarios
                    ON doctores.id_usuario = usuarios.id_usuario WHERE id_doctor = '$id_doctor'";
                    $query = mysqli_query($conexion, $consulta);

                    $resultado = mysqli_fetch_array($query);
                    echo $resultado['nombre'] . " " . $resultado['apellido'];                    

                    ?></div>
                </div>
            <?php
            }
            ?>
        </div>









        <!-- <div class="modal">
            <form class="form-login" method="POST" action="../client/crud/insertarCadmin.php">
                <div class="header__form">
                    <h2>Cita</h2> <a href="../index.php"><span class="icon-cross"></span></a>
                </div>

                <label> Nombre del Paciente: </label>
                <input type="text" name="nombre" required="true" autocomplete="off">

                <label> Apellido del Paciente: </label>
                <input type="text" name="apellido" required="true" autocomplete="off">

                <label> Numero: </label>
                <input type="number" name="numero" required="true" autocomplete="off" minlength="11">

                <label> Cedula: </label>
                <input type="number" name="cedula" required="true" autocomplete="off" minlength="7">

                <label> Causa: </label>
                <select name="causa">
                    <option value="Consulta odontologica general">Consulta odontologica general</option>
                    <option value="Montura de breakers">Montura de breakers</option>
                    <option value="Mantenimiento de breakers">Mantenimiento de breakers</option>
                    <option value="Operaciones Menores">Operaciones Menores</option>
                    <option value="Limpieza Buca">Limpieza Bucal</option>
                    <option value="Tratamiento de Caries">Tratamiento de Caries</option>
                </select>

                <label> Dia: </label>
                <select name="dia">
                    <option value="lunes">lunes</option>
                    <option value="martes">martes</option>
                    <option value="miercoles">miercoles</option>
                    <option value="jueves">jueves</option>
                    <option value="viernes">viernes</option>
                </select>

                <label> Nombre del doctor: </label>
                <input type="text" name="nombre_doctor" required="true" autocomplete="off">

                <div class="buttons__form">
                    <input type="submit" value="Iniciar Sesión" name="send" class="button__form loginSend">
                    <input type="reset" value="Borrar" name="clear" class="button__form">
                </div>
            </form>
        </div> -->
    </body>
</html>