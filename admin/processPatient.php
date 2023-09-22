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
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Raleway:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap" rel="stylesheet">

        <title>Marisol Díaz - ADMINISTRADOR</title>
    </head>
    <body>
        <style>
        .enlaces{
            padding: 10px;
            display: flex;
            flex-wrap: wrap;
            justify-content: left;
        }

        .enlace{
            width: 14%;
            text-align:center;
            margin: 2px 16px 15px 16px;
            box-shadow: 1px 1px 2px 0.5px rgb(148, 147, 147);
            border: solid white 1px;
        }
        </style>
        <?php
        include 'components/menu.html';
        include 'components/menu2.php';
        ?>

        <?php
        $idConsulta = $_GET['id'];

        // OBTENER EL ID_DOCTOR SEGÚN EL ID_USUARIO
        include '../client/obtenerId.php';
      
        // OBTENER LA INFORMACIÓN DE LA CITA QUE SERÁ CONFIRMADA
        include '../client/connection.php'; //Conexión con base de datos
        ?>

        <?php
        $consulta = "SELECT * FROM consultas INNER JOIN datos_personales INNER JOIN causa_consulta INNER JOIN doctores INNER JOIN status_consulta INNER JOIN turno_consulta
        ON consultas.id_paciente = datos_personales.id_dato_personal AND consultas.id_causa_consulta = causa_consulta.id_causa_consulta AND consultas.id_turno_consulta = turno_consulta.id_turno_consulta
        AND consultas.id_doctor = doctores.id_doctor AND consultas.id_status_consulta = status_consulta.id_status_consulta
        WHERE consultas.id_consulta = '$idConsulta'";
        $query = mysqli_query($conexion, $consulta);

        $resultado = mysqli_fetch_array($query);
        ?>

        <!-- ASIGNAR HORARIO Y CONFIRMAR CITA -->
        <h2 class="dia"><?php echo "Confirmar Cita de <span class=nombre_paciente>".$resultado['nombre']." ".$resultado["apellido"]."</span>"; ?></h2>

        <form method="POST" action="../client/botones/confirmar.php">
            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th>Cédula</th>
                            <th>Edad</th>
                            <th>Motivo de la Consulta</th>
                            <th>Teléfono</th>
                            <th>Turno</th>
                            <th>Hora de Inicio</th>
                            <th>Hora de Culminación</th>
                        </tr>
                    </thead>
                    <tbody>                        
                        <tr>
                            <td><?php echo $resultado['cedula']; ?></td>
                            <td><?php echo $resultado['edad']; ?></td>
                            <td><?php echo $resultado['causa_consulta']; ?></td>
                            <td><?php echo $resultado['telefono_1']. "<br>". $resultado['telefono_2']; ?></td>
                            <td><?php echo $resultado['turno_consulta']; ?></td>
                            <?php
                            if ($resultado['id_turno_consulta'] == 1){
                            ?>
                                <td><input type="time" required min="08:00" max="12:00" name="hora_inicio"></td>
                                <td><input type="time" required min="08:00" max="12:00" name="hora_fin"></td>
                            <?php
                            }
                            elseif ($resultado['id_turno_consulta'] == 2){
                            ?>
                                <td><input type="time" required min="13:00" max="16:00" name="hora_inicio"></td>
                                <td><input type="time" required min="13:00" max="16:00" name="hora_fin"></td>
                            <?php
                            }
                            ?>
                            <input type="hidden" value="<?php echo $resultado['fecha_atencion']; ?>" name="fechaAtencion">
                        </tr>   
                    </tbody>
                </table>
            </div>
            <input type="submit" class="confirmar" value="Confirmar Cita">
        </form>

        <!-- CITAS PARA EL DÍA DE ATENCIÓN -->

        <?php
        $fechaAtencion = ordenarFecha($resultado['fecha_atencion']);
        ?>

        <h2 class="dia"><?php echo "Citas del ". $fechaAtencion; ?></h2>

        <div class="table">
            <table>
                <?php
                $fechaAtencion = $resultado['fecha_atencion'];
                $turnoConsulta = $resultado['id_turno_consulta'];

                $consulta = "SELECT * FROM consultas INNER JOIN datos_personales INNER JOIN causa_consulta INNER JOIN doctores INNER JOIN status_consulta INNER JOIN turno_consulta
                ON consultas.id_paciente = datos_personales.id_dato_personal AND consultas.id_causa_consulta = causa_consulta.id_causa_consulta AND consultas.id_turno_consulta = turno_consulta.id_turno_consulta
                AND consultas.id_doctor = doctores.id_doctor AND consultas.id_status_consulta = status_consulta.id_status_consulta
                WHERE consultas.id_doctor = '$idDoctor' AND consultas.id_status_consulta = 2 AND 
                consultas.fecha_atencion = '$fechaAtencion' AND consultas.id_turno_consulta = '$turnoConsulta'
                ORDER BY hora_inicio ASC";
                $query = mysqli_query($conexion, $consulta);
                $query2 = mysqli_query($conexion, $consulta);
                ?>
                
                <thead>
                    <?php
                    while ($resultado = mysqli_fetch_array($query)){
                        $horaInicio = date("g:i a",strtotime($resultado['hora_inicio']));
                        $horaFin = date("g:i a",strtotime($resultado['hora_fin']));
                    ?>
                        <th class="tamaño"><?php echo $horaInicio. " - ". $horaFin; ?></th>
                    <?php
                    }
                    ?>
                </thead>
                <tbody>
                    <?php
                    while ($resultado2 = mysqli_fetch_array($query2)){
                        $horaInicio = date("g:i a",strtotime($resultado['hora_inicio']));
                        $horaFin = date("g:i a",strtotime($resultado['hora_fin']));
                    ?>
                        <td class="tamaño"><?php echo $resultado2['nombre']. " ". $resultado2['apellido']. "<br>". $resultado2['causa_consulta']. "<br>"; ?></td>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- <div class="table">
            <table>
                <thead>
                    <tr>
                        <th>Paciente</th>
                        <th>Cédula</th>
                        <th>Edad</th>
                        <th>Motivo de la Consulta</th>
                        <th>Teléfono</th>
                        <th>Hora de Atención</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    // $fechaAtencion = $resultado['fecha_atencion'];

                    // $consulta = "SELECT * FROM consultas INNER JOIN datos_personales INNER JOIN causa_consulta INNER JOIN doctores INNER JOIN status_consulta INNER JOIN turno_consulta
                    // ON consultas.id_paciente = datos_personales.id_dato_personal AND consultas.id_causa_consulta = causa_consulta.id_causa_consulta AND consultas.id_turno_consulta = turno_consulta.id_turno_consulta
                    // AND consultas.id_doctor = doctores.id_doctor AND consultas.id_status_consulta = status_consulta.id_status_consulta
                    // WHERE consultas.id_doctor = '$idDoctor' AND consultas.id_status_consulta = 2 AND consultas.fecha_atencion = '$fechaAtencion'
                    // ORDER BY hora_inicio ASC";
                    // $query = mysqli_query($conexion, $consulta);

                    // while ($resultado = mysqli_fetch_array($query)){
                    //     $horaInicio = date("g:i a",strtotime($resultado['hora_inicio']));
                    //     $horaFin = date("g:i a",strtotime($resultado['hora_fin']));
                    ?>
                        <tr>
                            <td><?php echo $resultado['nombre']. " ". $resultado['apellido']; ?></td>
                            <td><?php echo $resultado['cedula']; ?></td>
                            <td><?php echo $resultado['edad']; ?></td>
                            <td><?php echo $resultado['causa_consulta']; ?></td>
                            <td><?php echo $resultado['telefono_1']. "<br>". $resultado['telefono_2']; ?></td>
                            <td><?php echo $horaInicio. " - ". $horaFin; ?></td>
                        </tr>
                    <?php
                    // }
                    ?>
                </tbody>
            </table>
        </div> -->
        
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

<!-- <td><?php echo $resultado['nombre']. " ". $resultado['apellido']; ?></td> -->
<!-- . "<br>". $resultado['causa_consulta']. "<br>". $horaInicio. " - ". $horaFin -->