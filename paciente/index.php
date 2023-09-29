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

        <!-- FAVICON -->
        <link rel="icon" type="image/png" href="../img/favicon.png"/>

        <!-- ESTILOS CSS -->
        <link rel="stylesheet" href="../styles/normalize.css">
        <link rel="stylesheet" href="../styles/mensajes.css">
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

        include 'components/modal.php';

        include '../client/messagge.php';

        include 'responsive/header.php';
        ?>

        <?php
        // VARIABLE GLOBAL: ID DEL USUARIO LOGUEADO
        $idUsuario = $_SESSION['id'];

        // OBTENER LA INFORMACIÓN DE TODAS LAS CITAS A LAS QUE ASISTIÓ EL PACIENTE QUE ESTÁ LOGUEADO
        include '../client/connection.php'; //Conexión con base de datos

        $consulta = "SELECT * FROM consultas INNER JOIN datos_personales INNER JOIN causa_consulta INNER JOIN doctores INNER JOIN status_consulta
        ON consultas.id_paciente = datos_personales.id_dato_personal AND consultas.id_causa_consulta = causa_consulta.id_causa_consulta
        AND consultas.id_doctor = doctores.id_doctor AND consultas.id_status_consulta = status_consulta.id_status_consulta
        WHERE consultas.id_status_consulta = 1 AND consultas.id_paciente = '$idUsuario'
        ORDER BY fecha_atencion DESC";
        $query = mysqli_query($conexion, $consulta);
        ?>

        <h2 class="dia">Historial de citas</h2>

        <div class="table">
            <div class="thead__table">
                <div class="thead causa">Causa de la Consulta</div>
                <div class="thead">Fecha de Atención</div>
                <div class="thead">Doctor</div>
            </div>

            <?php
            while ($resultado = mysqli_fetch_array($query)) {
            ?>
                <div class="tbody__table">
                    <div class="tbody causa"><?php echo $resultado['causa_consulta']; ?></div>
                    <?php
                    $fechaAtencion = ordenarFecha($resultado['fecha_atencion']);
                    ?>
                    <div class="tbody"><?php echo $fechaAtencion; ?></div>

                    <div class="tbody"><?php
                    $idDoctor = $resultado['id_doctor'];

                    $consulta = "SELECT * FROM doctores INNER JOIN datos_personales INNER JOIN cuentas
                    ON doctores.id_usuario = cuentas.id_cuenta AND cuentas.id_dato_personal = datos_personales.id_dato_personal
                    WHERE id_doctor = '$idDoctor'";
                    $query2 = mysqli_query($conexion, $consulta);

                    $resultado = mysqli_fetch_array($query2);
                    echo $resultado['nombre'] . " " . $resultado['apellido'];                    
                    ?></div>
                </div>
            <?php
            }
            mysqli_close($conexion);
            ?>
        </div>

        <?php
        
        include 'components/footer.html';

        ?>
    </body>

    <script src="../js/messagge.js"></script>
    <script src="js/modal.js"></script>
</html>