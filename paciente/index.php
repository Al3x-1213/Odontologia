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
        <link rel="stylesheet" href="styles/tables.css">
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

        $consulta = "SELECT id_dato_personal FROM cuentas WHERE id_cuenta = '$idUsuario'";
        $query = mysqli_query($conexion, $consulta);

        $respuesta = mysqli_fetch_array($query);
        $idDatoPersonal = $respuesta['id_dato_personal'];

        $consulta = "SELECT * FROM consultas WHERE id_paciente = '$idDatoPersonal' AND
        (id_status_consulta = 1 OR id_status_consulta = 2 OR id_status_consulta = 3)";
        $query = mysqli_query($conexion, $consulta);

        $resultado = mysqli_num_rows($query);

        // VALIDACIÓN PARA COMPROBAR QUE HAYAN REGISTROS
        if ($resultado == 0){
            ?>
            <h2 class="dia">No Hay Citas Registradas</h2>
            <?php
        }
        else{
        ?>
            <!-- CITAS DEL PACIENTE LOGUEADO -->
            <h2 class="dia">Historial de citas</h2>

            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th>Motivo de la Consulta</th>
                            <th>Fecha de Atención</th>
                            <th>Doctor</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $consulta = "SELECT * FROM consultas INNER JOIN datos_personales INNER JOIN causa_consulta INNER JOIN doctores INNER JOIN status_consulta
                        ON consultas.id_paciente = datos_personales.id_dato_personal AND consultas.id_causa_consulta = causa_consulta.id_causa_consulta
                        AND consultas.id_doctor = doctores.id_doctor AND consultas.id_status_consulta = status_consulta.id_status_consulta
                        WHERE (consultas.id_status_consulta = 1 OR consultas.id_status_consulta = 2 OR consultas.id_status_consulta = 3) AND consultas.id_paciente = '$idDatoPersonal'
                        ORDER BY fecha_atencion DESC";
                        // echo $consulta;
                        $query = mysqli_query($conexion, $consulta);

                        while ($respuesta = mysqli_fetch_array($query)) {
                            $fechaAtencion = ordenarFecha($respuesta['fecha_atencion']);
                        ?>
                            <tr>
                                <td><?php echo $respuesta['causa_consulta']; ?></td>
                                <td><?php echo $fechaAtencion; ?></td>
                                <td>
                                    <?php
                                    $idDoctor = $respuesta['id_doctor'];

                                    $consulta = "SELECT * FROM doctores INNER JOIN datos_personales INNER JOIN cuentas
                                    ON doctores.id_usuario = cuentas.id_cuenta AND cuentas.id_dato_personal = datos_personales.id_dato_personal
                                    WHERE id_doctor = '$idDoctor'";
                                    $query2 = mysqli_query($conexion, $consulta);

                                    $respuesta2 = mysqli_fetch_array($query2);
                                    echo $respuesta2['nombre'] . " " . $respuesta2['apellido'];                    
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($respuesta['id_status_consulta'] == 1){
                                    ?>
                                        <div class="status statusAttend">Atendido</div>
                                    <?php
                                    }
                                    elseif ($respuesta['id_status_consulta'] == 2){
                                    ?>
                                        <div class="status statusToAttend">Por Atender</div>
                                    <?php
                                    }
                                    elseif ($respuesta['id_status_consulta'] == 3){
                                    ?>
                                        <div class="status statusToConfirm">Por Confirmar</div>
                                    <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        <?php
        }

        mysqli_close($conexion);
        ?>

        <div class="space"></div>

        <?php
        include 'components/footer.html';
        ?>
    </body>

    <script src="../js/messagge.js"></script>
    <script src="js/modal.js"></script>
</html>