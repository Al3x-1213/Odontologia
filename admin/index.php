<?php
include '../client/verificationSessionAdmin.php';

include '../client/orderDate.php';
?>
<?php
date_default_timezone_set('America/Caracas');
$fechaActual = date("Y-m-d");
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
        <!-- <link rel="stylesheet" href="styles/buscador.css"> -->
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

        <?php
        // OBTENER EL ID_DOCTOR SEGÚN EL ID_USUARIO
        include '../client/obtenerId.php';
        
        // OBTENER LA INFORMACIÓN DE LAS CITAS PARA EL DÍA ACTUAL
        include '../client/connection.php';

        $consulta = "SELECT * FROM consultas WHERE fecha_atencion = '$fechaActual' AND id_doctor = '$idDoctor'
        AND id_status_consulta != 3 AND id_status_consulta != 4";
        $query = mysqli_query($conexion, $consulta);

        // VALIDACIÓN PARA COMPROBAR QUE LA TABLA NO ESTÉ VACIA
        if($query->num_rows == 0){
        ?>
            <h2 class="dia">No Hay Pacientes Por Atender Para Hoy</h2>
        <?php
        }
        else
        {     
            $consulta = "SELECT * FROM consultas INNER JOIN datos_personales INNER JOIN causa_consulta INNER JOIN doctores
            ON consultas.id_paciente = datos_personales.id_dato_personal AND causa_consulta.id_causa_consulta = consultas.id_causa_consulta AND doctores.id_doctor = consultas.id_doctor
            WHERE consultas.id_status_consulta = 2 AND consultas.fecha_atencion = '$fechaActual' AND consultas.id_doctor = '$idDoctor'
            ORDER BY hora_inicio ASC";
            $query = mysqli_query($conexion, $consulta);
        ?>
        
            <h2 class="dia"><?php echo ordenarFecha($fechaActual); ?></h2>
            
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
                while ($resultado = mysqli_fetch_array($query)){
                    $horaInicio = date("g:i a",strtotime($resultado['hora_inicio']));
                    $horaFin = date("g:i a",strtotime($resultado['hora_fin']));
                ?>
                    <div class="tbody__table">
                        <div class="tbody nom"><?php echo $resultado['nombre'] . " " . $resultado['apellido']; ?></div>
                        <div class="tbody"><?php echo $resultado['cedula']; ?></div>
                        <div class="tbody causa"><?php echo $resultado['causa_consulta']; ?></div>
                        <div class="tbody"><?php echo $horaInicio; ?></div>
                        <div class="tbody"><?php echo $horaFin; ?></div>
                        <div class="tbody contacto"><?php echo $resultado['telefono_1']." ".$resultado['telefono_2'] ; ?></div>
            
                        <div class="tbody">
                            <a href="../client/botones/attend.php?id=<?php echo $resultado['id_consulta'] ?>"><button title="Atendido" class="attend"><i class="icon-checkmark1 icon"></i></button></a>
                            <a href="../client/botones/cancel.php?id=<?php echo $resultado['id_consulta'] ?>"><button title="Cancelar" class="cancel"><i class="icon-cross icon"></i></button></a>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>

            <?php
            $consulta = "SELECT * FROM consultas INNER JOIN datos_personales INNER JOIN causa_consulta INNER JOIN doctores
            ON consultas.id_paciente = datos_personales.id_dato_personal AND causa_consulta.id_causa_consulta = consultas.id_causa_consulta AND doctores.id_doctor = consultas.id_doctor
            WHERE consultas.id_status_consulta = 1 AND consultas.fecha_atencion = '$fechaActual' AND consultas.id_doctor = '$idDoctor'
            ORDER BY hora_inicio DESC";
            $query = mysqli_query($conexion, $consulta);
            ?>
        
            <h2 class="dia"> Atendidos </h2>
            
            <div class="table">
                <div class="thead__table">
                    <div class="thead">Paciente</div>
                    <div class="thead">Cédula</div>
                    <div class="thead causa">Causa de la Consulta</div>
                    <div class="thead">Hora de Inicio</div>
                    <div class="thead">Hora de Culminación</div>
                    <div class="thead">Teléfono</div>
                </div>

                <?php
                while ($resultado = mysqli_fetch_array($query)){
                    $horaInicio = date("g:i a",strtotime($resultado['hora_inicio']));
                    $horaFin = date("g:i a",strtotime($resultado['hora_fin']));
                ?>
                    <div class="tbody__table">
                        <div class="tbody nom"><?php echo $resultado['nombre'] . " " . $resultado['apellido']; ?></div>
                        <div class="tbody"><?php echo $resultado['cedula']; ?></div>
                        <div class="tbody causa"><?php echo $resultado['causa_consulta']; ?></div>
                        <div class="tbody"><?php echo $horaInicio; ?></div>
                        <div class="tbody"><?php echo $horaFin; ?></div>
                        <div class="tbody contacto"><?php echo $resultado['telefono_1']." ".$resultado['telefono_2'] ; ?></div>
                    </div>
                <?php
                }
                ?>
            </div>
        <?php
        }
        mysqli_close($conexion);
        ?>

        <div class="space"></div>

        <?php
        include 'components/footer.html';
        // include '../client/eliminar_no_atendidas.php';
        ?>

        <script src="js/confirm.js"></script>
        <script src="js/modal.js"></script>
    </body>
</html>