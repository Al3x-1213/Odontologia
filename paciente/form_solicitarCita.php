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

        <title>Marisol Díaz - PACIENTE</title>
    </head>
    <body>
        <?php
        include 'components/menu.html';
        include 'components/menu2.php';
        ?>

        <form action="solicitarCita.php" method="POST" class="form-login">
            <h2>Solicitar una Cita</h2>

            <?php
            // CONSULTAR A BASE DE DATOS LAS CAUSAS DE CONSULTAS REGISTRADAS E IMPRIMIRLAS COMO OPCIÓN
            include '../client/conexion.php'; //Conexión con base de datos

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

            if(strlen($limiteDay) == 1){
                $limiteDay = "0". $limiteDay;
            }
            else{
                $limiteDay = $limiteDay;
            }

            $limiteFecha = date("Y-m-$limiteDay");
            ?>
            <label>Fecha de Atención:</label>
            <input type="date" required="true" name="nacimiento" min="<?= $limiteFecha; ?>" class="input__form">

            <label>Turno:</label>
            <div class="seleccion">
                <input type="radio" required="true" name="turno" class=""> Mañana
                <input type="radio" required="true" name="turno" class=""> Tarde
            </div>

            <?php
            // CONSULTAR A BASE DE DATOS LOS NOMBRES DE LOS DOCTORES E IMPRIMIRLOS COMO OPCIÓN
            $consulta = "SELECT * FROM doctores INNER JOIN usuarios ON doctores.id_usuario = usuarios.id_usuario";
            $query = mysqli_query($conexion, $consulta)
            ?>
            <label>Doctor: </label>
            <select name="causa">
                <option value="0"></option>
                <?php
                $i = 0;
                while ($resultado = mysqli_fetch_array($query)) {
                    $i = $i + 1;
                ?>
                    <option value="<?php echo $i; ?>"><?php echo $resultado['nombre'] . " " . $resultado['apellido']; ?></option>
                <?php
                }
                ?>
            </select>

            <div class="buttons__form">
                <input type="reset" value="Borrar" name="clear" class="button__form">
                <input type="submit" value="Solicitar Cita" name="send" class="button__form loginSend">
            </div>
        </form>

        <!-- <div class="modal">
            <form class="form-login" method="POST" action="../client/crud/insertarCadmin.php">
                <div class="header__form">
                    <h2>Cita</h2> <a href="index.php"><span class="icon-cross"></span></a>
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