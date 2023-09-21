<?php
include '../client/verificationSessionAdmin.php';

include '../client/orderDate.php';
?>
<?php
date_default_timezone_set('America/Caracas');
$fechaActual = date("Y-m-d");

$dia = date("d");
$mes = date("m");
$year = date("Y");
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- ESTILOS CSS -->
        <link rel="stylesheet" href="../styles/normalize.css">
        <link rel="stylesheet" href="styles/tables.css">
        <link rel="stylesheet" href="styles/iconsButtons.css">
        <link rel="stylesheet" href="styles/menu.css">
        <link rel="stylesheet" href="styles/footer.css">
        <link rel="stylesheet" href="styles/modal.css">
        <link rel="stylesheet" href="styles/index.css">
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
        <?php
        // FECHA PARA BUSCAR
        $fechaBuscar = $_POST['buscar'];

        $fechaSeparada = explode('-', $fechaBuscar);
        $day = $fechaSeparada[2];
        $month = $fechaSeparada[1];
        $Year = $fechaSeparada[0];

        // OBTENER EL ID_DOCTOR según el ID_USUARIO
        include '../client/obtenerId.php';
        ?>

        <?php 
        if($day >= $dia && $month >= $mes && $Year >= $year){
        ?>
            <h2 class="dia"><?php echo ordenarFecha($fechaBuscar); ?></h2>

            <table>
                <thead>
                    <tr>
                        <th>Paciente</th>
                        <th>Cédula</th>
                        <th>Edad</th>
                        <th>Motivo de la Consulta</th>
                        <th>Hora de Atención</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                // BUSCAR DÍA SELECCIONADO
                $consulta = "SELECT * FROM consultas INNER JOIN datos_personales INNER JOIN causa_consulta INNER JOIN doctores INNER JOIN status_consulta
                ON consultas.id_paciente = datos_personales.id_dato_personal AND consultas.id_causa_consulta = causa_consulta.id_causa_consulta
                AND consultas.id_doctor = doctores.id_doctor AND consultas.id_status_consulta = status_consulta.id_status_consulta
                WHERE consultas.id_doctor = '$idDoctor' AND consultas.fecha_atencion = '$fechaBuscar' AND consultas.id_status_consulta != 3
                ORDER BY hora_inicio ASC";
                $query = mysqli_query($conexion, $consulta);

                while ($respuesta = mysqli_fetch_array($query)) {
                    $horaInicio = date("g:i a",strtotime($respuesta['hora_inicio']));
                    $horaFin = date("g:i a",strtotime($respuesta['hora_fin']));
                ?>
                    <tr>
                        <td><?php echo $respuesta['nombre']. " ". $respuesta['apellido']; ?></td>
                        <td><?php echo $respuesta['cedula']; ?></td>
                        <td><?php echo $respuesta['edad']; ?></td>
                        <td><?php echo $respuesta['causa_consulta']; ?></td>
                        <td><?php echo $horaInicio . " - " . $horaFin; ?></td>
                        <td><?php echo $respuesta['telefono_1'] . "<br>" . $respuesta['telefono_2']; ?></td>
                        <td>
                            <a href="../client/botones/cancel.php?id=<?php echo $respuesta['id_consulta'] ?>"><button title="Cancelar" class="cancel"><i class="icon-cross icon"></i></button></a>
                        </td>
                    </tr>
                <?php
                }
                ?>
                </tbody>
            </table>
        <?php
        }
        else{ 
        ?>
            <h2 class="dia"><?php echo ordenarFecha($fechaBuscar); ?></h2>

            <table>
                <thead>
                    <tr>
                        <th>Paciente</th>
                        <th>Cédula</th>
                        <th>Edad</th>
                        <th>Motivo de la Consulta</th>
                        <th>Hora de Atención</th>
                        <th>Teléfono</th>                        
                    </tr>
                </thead>
                <tbody>
                <?php
                // BUSCAR DÍA SELECCIONADO
                $consulta = "SELECT * FROM consultas INNER JOIN datos_personales INNER JOIN causa_consulta INNER JOIN doctores INNER JOIN status_consulta
                ON consultas.id_paciente = datos_personales.id_dato_personal AND consultas.id_causa_consulta = causa_consulta.id_causa_consulta
                AND consultas.id_doctor = doctores.id_doctor AND consultas.id_status_consulta = status_consulta.id_status_consulta
                WHERE consultas.id_doctor = '$idDoctor' AND consultas.fecha_atencion = '$fechaBuscar' AND  consultas.id_status_consulta != 4
                ORDER BY hora_inicio ASC";
                $query = mysqli_query($conexion, $consulta);

                while ($respuesta = mysqli_fetch_array($query)) {
                    $horaInicio = date("g:i a",strtotime($respuesta['hora_inicio']));
                    $horaFin = date("g:i a",strtotime($respuesta['hora_fin']));
                ?>
                    <tr>
                        <td><?php echo $respuesta['nombre']. " ". $respuesta['apellido']; ?></td>
                        <td><?php echo $respuesta['cedula']; ?></td>
                        <td><?php echo $respuesta['edad']; ?></td>
                        <td><?php echo $respuesta['causa_consulta']; ?></td>
                        <td><?php echo $horaInicio . " - " . $horaFin; ?></td>
                        <td><?php echo $respuesta['telefono_1'] . "<br>" . $respuesta['telefono_2']; ?></td>                        
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
    </body>
</html>