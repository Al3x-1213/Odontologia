<?php
include '../client/verificationSessionAdmin.php';

include '../client/orderDate.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ESTILOS CSS -->
    <link rel="stylesheet" href="../styles/normalize.css">
    <link rel="stylesheet" href="styles/menu.css">
    <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" href="styles/tables.css">
    <link rel="stylesheet" href="styles/footer.css">
    <link rel="stylesheet" href="styles/modal.css">
    <link rel="stylesheet" href="../Iconos/style.css">

    <!-- LETRAS UTILIZADAS -->
    <!-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Raleway:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap" rel="stylesheet"> -->

    <title>Marisol Díaz - ADMINISTRADOR</title>
</head>

<body>
    <?php
    include 'components/menu.html';
    include 'components/menu2.php';

    //RESPONSIVE TABLE
    include 'responsive/header.php';
    ?>

    <?php
    // OBTENER EL ID_DOCTOR según el ID_USUARIO
    include '../client/obtenerId.php';

    // OBTENER LA INFORMACIÓN DE TODAS LAS CITAS ATENDIDAS POR EL DOCTOR QUE ESTÁ LOGUEADO
    include '../client/connection.php'; //Conexión con base de datos

    $consulta = "SELECT * FROM consultas WHERE id_doctor = '$idDoctor' AND id_status_consulta = 1";
    $query = mysqli_query($conexion, $consulta);

    // VALIDACIÓN PARA COMPROBAR QUE LA TABLA NO ESTÉ VACIA
    if ($query->num_rows == 0) {
    ?>
        <h2 class="dia">No Hay Pacientes Por Atender Para Hoy</h2>
    <?php
    } else {
    ?>

        <!-- CITAS ATENDIDAS -->
        <h2 class="dia">Citas Atendidas</h2>

        <table>
            <thead>
                <tr>
                    <th>Paciente</th>
                    <th>Cédula</th>
                    <th>Motivo de la Consulta</th>
                    <th>Fecha de Atención</th>
                    <th>Hora de Atención</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $consulta = "SELECT * FROM consultas INNER JOIN datos_personales INNER JOIN causa_consulta INNER JOIN doctores INNER JOIN status_consulta
                        ON consultas.id_paciente = datos_personales.id_dato_personal AND consultas.id_causa_consulta = causa_consulta.id_causa_consulta
                        AND consultas.id_doctor = doctores.id_doctor AND consultas.id_status_consulta = status_consulta.id_status_consulta
                        WHERE consultas.id_doctor = '$idDoctor' AND consultas.id_status_consulta = 1";
                $query = mysqli_query($conexion, $consulta);

                while ($resultado = mysqli_fetch_array($query)) {
                    $fechaAtencion = ordenarFecha($resultado['fecha_atencion']);
                    $horaInicio = date("g:i a", strtotime($resultado['hora_inicio']));
                    $horaFin = date("g:i a", strtotime($resultado['hora_fin']));
                ?>
                    <tr>
                        <td><?php echo $resultado['nombre'] . " " . $resultado['apellido']; ?></td>
                        <td><?php echo $resultado['cedula']; ?></td>
                        <td><?php echo $resultado['causa_consulta']; ?></td>
                        <td><?php echo $fechaAtencion; ?></td>
                        <td><?php echo $horaInicio . " - " . $horaFin; ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    <?php
    }
    ?>

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