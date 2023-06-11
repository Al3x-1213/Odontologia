<?php
include '../client/verificacion_sesion.php';

date_default_timezone_set('America/Caracas');
$fecha_actual = date("d-m-Y h:i:s");

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
        <link rel="stylesheet" href="styles/menu.css">
        <link rel="stylesheet" href="styles/buscador.css">
        <link rel="stylesheet" href="styles/index.css">
        <link rel="stylesheet" href="../styles/mensajes.css">
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

        include 'parts/modal.php';
        ?>

        <!-- INICIA LA CONEXION CON LA BASE DE DATOS PARA HACER CONSULTAS -->
        <?php
        // OBTENER EL ID_DOCTOR según el ID_USUARIO
        include '../client/obtenerId.php';
        include '../client/conexion.php';
        $operator = "SELECT * FROM consultas WHERE fecha_atencion = '$year-$mes-$dia' AND id_doctor = '$id_doctor'";
        $select = $conexion->query($operator);

        //valida que la tabla de consultas de ese dia no esté vacía
        if ($select->num_rows > 0) {
            mysqli_close($conexion) ?>
            <h2 class="dia"> <?php echo $dia . "-" . $mes . "-" . $year ?> </h2>
            
            <div class="table">
                <div class="thead__table">
                    <div class="thead">Paciente</div>
                    <div class="thead">Cédula</div>
                    <div class="thead causa">Causa de la Consulta</div>
                    <div class="thead">Hora de Inicio</div>
                    <div class="thead">Hora de Culminación</div>
                    <div class="thead">Teléfono</div>
                    <div class="thead"> Acciones </div>
                </div>

                <?php
                include '../client/conexion.php';
      
                $consulta = "SELECT * FROM consultas INNER JOIN usuarios INNER JOIN causa_consulta INNER JOIN doctores
                ON consultas.id_paciente = usuarios.id_usuario AND causa_consulta.id_causa_consulta = consultas.id_causa_consulta AND doctores.id_doctor = consultas.id_doctor
                WHERE consultas.id_status_consulta = 2 AND consultas.fecha_atencion = '$year-$mes-$dia' AND consultas.id_doctor = '$id_doctor'
                ORDER BY hora_inicio ASC";
                $select = $conexion->query($consulta);

                while ($datos_consulta = mysqli_fetch_array($select)) {?>
                    <div class="tbody__table">
                        <div class="tbody nom"><?php echo $datos_consulta['nombre'] . " " . $datos_consulta['apellido']; ?></div>
                        <div class="tbody"><?php echo $datos_consulta['cedula']; ?></div>
                        <div class="tbody causa"><?php echo $datos_consulta['causa_consulta']; ?></div>
                        <div class="tbody"><?php echo $datos_consulta['hora_inicio']; ?></div>
                        <div class="tbody"><?php echo $datos_consulta['hora_fin']; ?></div>
                        <div class="tbody contacto"><?php echo $datos_consulta['telefono_1']." ".$datos_consulta['telefono_2'] ; ?></div>
          
                        <div class="tbody"><a href="../client/botones/atendido.php?id=<?php echo $datos_consulta['id_consulta'] ?>"><button class="atendido">Atendido</button></a>
                        <a href="../client/botones/cancelar.php?id=<?php echo $datos_consulta['id_consulta'] ?>"><button class="eliminar">Cancelar</button></a></div>
                    </div>
                <?php
                }
                mysqli_close($conexion); ?>
            </div>

        <!-- <button class="insertar"> Registrar Una Cita </button> -->
        
        <h2 class="dia"> Atendidos </h2>
        
        <div class="table">
            <div class="thead__table">
                <div class="thead">Paciente</div>
                <div class="thead">Cédula</div>
                <div class="thead causa">Causa de la Consulta</div>
                <div class="thead">Hora de Inicio</div>
                <div class="thead">Hora de Culminación</div>
                <div class="thead">Teléfono</div>
                <div class="thead"> Acciones </div>
            </div>

            <?php
            include '../client/obtenerId.php';
            include '../client/conexion.php';

            $consulta = "SELECT * FROM consultas INNER JOIN usuarios INNER JOIN causa_consulta INNER JOIN doctores
            ON consultas.id_paciente = usuarios.id_usuario AND causa_consulta.id_causa_consulta = consultas.id_causa_consulta AND doctores.id_doctor = consultas.id_doctor
            WHERE consultas.id_status_consulta = 1 AND consultas.fecha_atencion = '$year-$mes-$dia' AND consultas.id_doctor = '$id_doctor'
            ORDER BY hora_inicio DESC";
            $select = $conexion->query($consulta);

            while ($datos_consulta = mysqli_fetch_array($select)) {?>
                <div class="tbody__table">
                    <div class="tbody nom"><?php echo $datos_consulta['nombre'] . " " . $datos_consulta['apellido']; ?></div>
                    <div class="tbody"><?php echo $datos_consulta['cedula']; ?></div>
                    <div class="tbody causa"><?php echo $datos_consulta['causa_consulta']; ?></div>
                    <div class="tbody"><?php echo $datos_consulta['hora_inicio']; ?></div>
                    <div class="tbody"><?php echo $datos_consulta['hora_fin']; ?></div>
                    <div class="tbody contacto"><?php echo $datos_consulta['telefono_1']." ".$datos_consulta['telefono_2'] ; ?></div>
          
                    <div class="tbody"><a href="../client/botones/cancelar.php?id=<?php echo $datos_consulta['id_consulta'] ?>"><button class="eliminar">Cancelar</button></a></div>
                </div>
            <?php
            }
            mysqli_close($conexion); ?>
        </div>
        <?php
        }
        ?> <!-- Para cerrar el condicional de las consultas -->

        <div class="space"></div>

        <?php
        include 'components/footer.html';
        include '../client/eliminar_no_atendidas.php'
        ?>

        <script src="js/confirm.js"></script>
        <script src="js/modal.js"></script>
    </body>
</html>