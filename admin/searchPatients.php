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

        <!-- ESTILOS CSS -->
        <link rel="stylesheet" href="../styles/normalize.css">
        <link rel="stylesheet" href="styles/menu.css">
        <link rel="stylesheet" href="styles/index.css">
        <link rel="stylesheet" href="styles/iconsButtons.css">
        <link rel="stylesheet" href="styles/footer.css">
        <link rel="stylesheet" href="styles/modal.css">
        <link rel="stylesheet" href="styles/tables.css">
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

        //RESPONSIVE TABLE
        include 'responsive/header.php';
        ?>
        <?php
        // PACIENTE PARA BUSCAR
        $idPaciente = $_GET['id'];

        // OBTENER EL ID_DOCTOR según el ID_USUARIO
        include '../client/obtenerId.php';

        // DATOS DEL PACIENTE
        include '../client/connection.php'; //Conexión con base de datos
        
        $consulta = "SELECT * FROM datos_personales INNER JOIN alergias INNER JOIN discapacidades
        ON datos_personales.id_alergia = alergias.id_alergia AND datos_personales.id_discapacidad = discapacidades.id_discapacidad
        WHERE id_dato_personal = '$idPaciente'";
        $query = $conexion->query($consulta);

        $respuesta = mysqli_fetch_array($query)
        ?>
    
        <h2 class="dia"><?php echo $respuesta['nombre'] . " " . $respuesta['apellido']; ?></h2>

        <table>
            <thead>
                <tr>
                    <th>Cédula</th>
                    <th>Edad</th>
                    <th>Teléfono</th>
                    <th>Correo Electrónico</th>
                    <th>Alergia</th>
                    <th>Discapacidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $respuesta['cedula']; ?></td>
                    <td><?php echo $respuesta['edad']; ?></td>
                    <td><?php echo $respuesta['telefono_1'] . "<br>" . $respuesta['telefono_2']; ?></td>
                    <td><?php echo $respuesta['correo']; ?></td>
                    <td><?php echo $respuesta['alergia']; ?></td>
                    <td><?php echo $respuesta['discapacidad']; ?></td>
                    <td>
                        <a href="../client/botones/printConstancy.php?id=<?php echo $resultado['id_consulta'] ?>"><button title="Constancia" class="print"><i class="icon-printer1 icon"></i></button></a>
                    </td>
                </tr>
            </tbody>
        </table>

        <h2 class="dia">Historial de consultas</h2>

        <table>
            <thead>
                <tr>
                    <th>Motivo de la Consulta</th>
                    <th>Fecha de Atención</th>
                    <th>Hora de Atención</th>
                </tr>
            </thead>
            <tbody>
            <?php
            // HISTORIAL DE LAS CONSULTAS DEL PACIENTE
            $consulta = "SELECT * FROM consultas INNER JOIN datos_personales INNER JOIN causa_consulta INNER JOIN doctores INNER JOIN status_consulta
            ON consultas.id_paciente = datos_personales.id_dato_personal AND consultas.id_causa_consulta = causa_consulta.id_causa_consulta
            AND consultas.id_doctor = doctores.id_doctor AND consultas.id_status_consulta = status_consulta.id_status_consulta WHERE consultas.id_doctor = '$idDoctor' AND consultas.id_status_consulta = '1' AND consultas.id_paciente = '$idPaciente'
            ORDER BY fecha_atencion DESC";
            $query = mysqli_query($conexion, $consulta);

            while ($respuesta = mysqli_fetch_array($query)) {
                $fechaAtencion = ordenarFecha($respuesta['fecha_atencion']);
                $horaInicio = date("g:i a",strtotime($respuesta['hora_inicio']));
                $horaFin = date("g:i a",strtotime($respuesta['hora_fin']));
            ?>
                <tr class="tbody__table">
                    <td><?php echo $respuesta['causa_consulta']; ?></td>
                    <td><?php echo $fechaAtencion; ?></td>
                    <td><?php echo $horaInicio . " - " . $horaFin; ?></td>
                </tr>
            <?php
            }
            ?>
            </tbody>
        </table>

        <?php
        mysqli_close($conexion);
        ?>
        
        <div class="space"></div>
        
        <?php
        include 'components/footer.html';
        ?>

        <script src="js/confirm.js"></script>
    </body>
</html>