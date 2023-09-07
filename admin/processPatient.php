<?php
include '../client/verificationSession.php';

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

        <?php
        $idConsulta = $_GET['id'];

        // OBTENER EL ID_DOCTOR SEGÚN EL ID_USUARIO
        include '../client/obtenerId.php';
      
        // OBTENER LA INFORMACIÓN DE LA CITA QUE SERÁ CONFIRMADA
        include '../client/connection.php'; //Conexión con base de datos

        $consulta = "SELECT * FROM consultas INNER JOIN usuarios INNER JOIN causa_consulta INNER JOIN doctores INNER JOIN status_consulta INNER JOIN turno_consulta
        ON consultas.id_paciente = usuarios.id_usuario AND consultas.id_causa_consulta = causa_consulta.id_causa_consulta AND consultas.id_turno_consulta = turno_consulta.id_turno_consulta
        AND consultas.id_doctor = doctores.id_doctor AND consultas.id_status_consulta = status_consulta.id_status_consulta
        WHERE consultas.id_consulta = '$idConsulta'";
        $query = mysqli_query($conexion, $consulta);

        $resultado = mysqli_fetch_array($query);
        ?>

        <h2 class="dia"><?php echo "Confirmar Cita de <span class=nombre_paciente>".$resultado['nombre']." ".$resultado["apellido"]."</span>"; ?></h2>

        <form method="POST" action="../client/botones/confirmar.php">
            <div class="table">
                <div class="thead__table">
                    <div class="thead">Cédula</div>
                    <div class="thead edad">Edad</div>
                    <div class="thead causa">Causa de la Consulta</div>
                    <div class="thead">Teléfono</div>
                    <div class="thead">Turno</div>
                    <div class="thead">Hora de Inicio</div>
                    <div class="thead">Hora de Culminación</div>
                </div>

                <div class="tbody__table">
                    <input type="hidden" name="id_consulta" value="<?php echo $resultado['id_consulta'] ?>">

                    <div class="tbody"><?php echo $resultado['cedula']; ?></div>
                    <div class="tbody edad"><?php echo $resultado['edad']; ?></div>
                    <div class="tbody causa"><?php echo $resultado['causa_consulta']; ?></div>
                    <div class="tbody contacto"><?php echo $resultado['telefono_1']." ". $resultado['telefono_2']; ?></div>
                    <div class="tbody"><?php echo $resultado['turno_consulta']; ?></div>
                    <div class="tbody"><input type="time" required name="hora_inicio"></div>
                    <div class="tbody"><input type="time" required name="hora_fin"></div>
                    <input type="hidden" value="<?php echo $resultado['fecha_atencion']; ?>" name="fechaAtencion">
                </div>
            </div>

            <input type="submit" class="confirmar" value="Confirmar Cita">
        </form>

        <?php
        $fechaAtencion = $resultado['fecha_atencion'];

        $consulta = "SELECT * FROM consultas INNER JOIN usuarios INNER JOIN causa_consulta INNER JOIN doctores INNER JOIN status_consulta INNER JOIN turno_consulta
        ON consultas.id_paciente = usuarios.id_usuario AND consultas.id_causa_consulta = causa_consulta.id_causa_consulta AND consultas.id_turno_consulta = turno_consulta.id_turno_consulta
        AND consultas.id_doctor = doctores.id_doctor AND consultas.id_status_consulta = status_consulta.id_status_consulta
        WHERE consultas.id_doctor = '$id_doctor' AND consultas.id_status_consulta = 2 AND consultas.fecha_atencion = '$fechaAtencion'
        ORDER BY hora_inicio ASC";
        
        $fechaAtencion = ordenarFecha($resultado['fecha_atencion']);
        ?>

        <h2 class="dia"><?php echo "Citas del ".$fechaAtencion; ?></h2>

        <div class="table">
            <div class="thead__table">
                <div class="thead">Paciente</div>
                <div class="thead">Cédula</div>
                <div class="thead edad">Edad</div>
                <div class="thead causa">Causa de la Consulta</div>
                <div class="thead">Teléfono</div>
                <div class="thead">Hora de Inicio</div>
                <div class="thead correo">Hora de Culminación</div>
            </div>

            <?php
            while ($resultado = mysqli_fetch_array($query)){
            ?>
                <div class="tbody__table">
                    <div class="tbody nom"><?php echo $resultado['nombre'] . " ". $resultado['apellido']; ?></div>
                    <div class="tbody"><?php echo $resultado['cedula']; ?></div>
                    <div class="tbody edad"><?php echo $resultado['edad']; ?></div>
                    <div class="tbody causa"><?php echo $resultado['causa_consulta']; ?></div>
                    <div class="tbody contacto"><?php echo $resultado['telefono_1']. " ". $resultado['telefono_2']; ?></div>
                    <div class="tbody"><?php echo $resultado['hora_inicio']; ?></div>       
                    <div class="tbody"><?php echo $resultado['hora_fin']; ?></div>      
                </div>
            <?php
            }
            ?>
        </div>
        
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