<?php
include '../client/verificationSessionAdmin.php';
include '../client/orderDate.php';

date_default_timezone_set('America/Caracas');
$fechaActual = date("Y-m-d");

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
        <link rel="stylesheet" href="styles/tables.css">
        <link rel="stylesheet" href="../styles/mensajes.css">
        <link rel="stylesheet" href="styles/iconsButtons.css">
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

        // MENUS DE LOS INDEX
        include 'components/menu.html';
        include 'components/menu2.php';

        if(isset($_SESSION['mensaje']) && isset($_SESSION['error']) && $_SESSION['error'] == 2){
            ?> <div class="messagge messagge__success"><?php echo $_SESSION['mensaje']; ?><i class="icon-cross messagge__icon"></i></div> <?php
            unset($_SESSION['mensaje']);
            unset($_SESSION['error']);
        }else if(isset($_SESSION['mensaje']) && isset($_SESSION['error']) && $_SESSION['error'] == 1){
            ?> <div class="messagge messagge__error"><?php echo $_SESSION['mensaje']; ?><i class="icon-cross messagge__icon"></i></div> <?php
            unset($_SESSION['mensaje']);
            unset($_SESSION['error']);
        }

        //RESPONSIVE TABLE
        include 'responsive/header.php';

        //MARCAR COMO ATENIDAS LAS CONSULTAS QUE LA DOCTORA OLVIDÓ
        include '../client/clearStatus2.php';

        //MODAL PARA ELIMINAR PACIENTES
        include 'parts/modal.php';
        ?>

        <?php
        // OBTENER EL ID_DOCTOR SEGÚN EL ID_USUARIO
        include '../client/obtenerId.php';

        // OBTENER LA INFORMACIÓN DE LAS CITAS PARA EL DÍA ACTUAL
        include '../client/connection.php';

        $consulta = "SELECT * FROM consultas WHERE fecha_atencion = '$fechaActual' AND id_doctor = '$idDoctor'
            AND id_status_consulta != 3 AND id_status_consulta != 4";
        $query = mysqli_query($conexion, $consulta);

        // VALIDACIÓN PARA COMPROBAR QUE LA TABLA NO ESTÉ VACIA
        if ($query->num_rows == 0) {
        ?>
            <h2 class="dia">No Hay Pacientes Por Atender Para Hoy</h2>
        <?php
        } else {
        ?>
            <!-- CITAS POR ATENDER -->
            <h2 class="dia"><?php echo ordenarFecha($fechaActual); ?></h2>

            <table>
                <thead>
                    <tr>
                        <th>Paciente</th>
                        <th>Cédula</th>
                        <th>Motivo de la Consulta</th>
                        <th>Hora de Atención</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $consulta = "SELECT * FROM consultas INNER JOIN datos_personales INNER JOIN causa_consulta INNER JOIN doctores
                            ON consultas.id_paciente = datos_personales.id_dato_personal AND causa_consulta.id_causa_consulta = consultas.id_causa_consulta AND doctores.id_doctor = consultas.id_doctor
                            WHERE consultas.id_status_consulta = 2 AND consultas.fecha_atencion = '$fechaActual' AND consultas.id_doctor = '$idDoctor'
                            ORDER BY hora_inicio ASC";
                    $query = mysqli_query($conexion, $consulta);

                    while ($resultado = mysqli_fetch_array($query)) {
                        $horaInicio = date("g:i a", strtotime($resultado['hora_inicio']));
                        $horaFin = date("g:i a", strtotime($resultado['hora_fin']));
                    ?>
                        <tr>
                            <td><?php echo $resultado['nombre'] . " " . $resultado['apellido']; ?></td>
                            <td><?php echo $resultado['cedula']; ?></td>
                            <td><?php echo $resultado['causa_consulta']; ?></td>
                            <td><?php echo $horaInicio . " - " . $horaFin; ?></td>
                            <td><?php echo $resultado['telefono_1'] . "<br>" . $resultado['telefono_2']; ?></td>
                            <td>
                                <a href="../client/botones/attend.php?id=<?php echo $resultado['id_consulta'] ?>"><button title="Atendido" class="attend"><i class="icon-checkmark1 icon atend"></i></button></a>
                                <a href="../client/botones/cancel.php?id=<?php echo $resultado['id_consulta'] ?>"><button title="Cancelar" class="cancel"><i class="icon-cross icon cancel"></i></button></a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>

            <!-- CITAS ATENDIDAS -->
            <h2 class="dia"> Atendidos </h2>

            <table>
                <thead>
                    <tr>
                        <th>Paciente</th>
                        <th>Cédula</th>
                        <th>Motivo de la Consulta</th>
                        <th>Hora de Atención</th>
                        <th>Teléfono</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $consulta = "SELECT * FROM consultas INNER JOIN datos_personales INNER JOIN causa_consulta INNER JOIN doctores
                            ON consultas.id_paciente = datos_personales.id_dato_personal AND causa_consulta.id_causa_consulta = consultas.id_causa_consulta AND doctores.id_doctor = consultas.id_doctor
                            WHERE consultas.id_status_consulta = 1 AND consultas.fecha_atencion = '$fechaActual' AND consultas.id_doctor = '$idDoctor'
                            ORDER BY hora_inicio DESC";
                    $query = mysqli_query($conexion, $consulta);

                    while ($resultado = mysqli_fetch_array($query)) {
                        $horaInicio = date("g:i a", strtotime($resultado['hora_inicio']));
                        $horaFin = date("g:i a", strtotime($resultado['hora_fin']));
                    ?>
                        <tr>
                            <td><?php echo $resultado['nombre'] . " " . $resultado['apellido']; ?></td>
                            <td><?php echo $resultado['cedula']; ?></td>
                            <td><?php echo $resultado['causa_consulta']; ?></td>
                            <td><?php echo $horaInicio . " - " . $horaFin; ?></td>
                            <td><?php echo $resultado['telefono_1'] . "<br>" . $resultado['telefono_2']; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        <?php
        }
        mysqli_close($conexion);
        ?>

        <div class="space"></div>

        <?php
        include 'components/footer.html';
        ?>

        <script src="js/confirm.js"></script>
        <script src="js/modal.js"></script>
        <script src="../js/messagge.js"></script>
    </body>

</html>