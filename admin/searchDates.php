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
        include '../client/obtenerId.php';?>

        <?php 
        if($day >= $dia && $month >= $mes && $Year >= $year){
        ?>
            <h2 class="dia"><?php echo ordenarFecha($fechaBuscar); ?></h2>

            <div class="table">
                <div class="thead__table">
                    <div class="thead">Paciente</div>
                    <div class="thead">Cédula</div>
                    <div class="thead edad">Edad</div>
                    <div class="thead causa">Causa de la Consulta</div>
                    <div class="thead">Hora de Inicio</div>
                    <div class="thead">Hora Final</div>
                    <div class="thead">Télefono</div>
                    <div class="thead">Acciones</div>
                </div>

                <?php
                // CITAS POR ATENDER: OBTENER LA INFORMACIÓN DE TODAS LAS CITAS POR ATENDER POR EL DOCTOR QUE ESTÁ LOGUEADO EN LA FECHA INGRESADA
                include '../client/connection.php'; //Conexión con base de datos

                $consulta = "SELECT * FROM consultas INNER JOIN usuarios INNER JOIN causa_consulta INNER JOIN doctores INNER JOIN status_consulta
                ON consultas.id_paciente = usuarios.id_usuario AND consultas.id_causa_consulta = causa_consulta.id_causa_consulta
                AND consultas.id_doctor = doctores.id_doctor AND consultas.id_status_consulta = status_consulta.id_status_consulta
                WHERE consultas.id_doctor = '$id_doctor' AND consultas.fecha_atencion = '$fechaBuscar' AND consultas.id_status_consulta != 3
                ORDER BY hora_inicio ASC";
                $query = mysqli_query($conexion, $consulta);

                while ($resultado = mysqli_fetch_array($query)){
                    $horaInicio = date("g:i a",strtotime($resultado['hora_inicio']));
                    $horaFin = date("g:i a",strtotime($resultado['hora_fin']));
                ?>
                    <div class="tbody__table">
                        <div class="tbody nom"><?php echo $resultado['nombre'] . " " . $resultado['apellido']; ?></div>
                        <div class="tbody"><?php echo $resultado['cedula']; ?></div>
                        <div class="tbody edad"><?php echo $resultado['edad']; ?></div>
                        <div class="tbody causa"><?php echo $resultado['causa_consulta']; ?></div>
                        <div class="tbody"><?php echo $horaInicio; ?></div>
                        <div class="tbody"><?php echo $horaFin; ?></div>
                        <div class="tbody contacto"><?php echo $resultado['telefono_1']. " ". $resultado['telefono_2']; ?></div>

                        <div class="tbody">
                            <a href="../client/botones/cancelar.php?id=<?php echo $resultado['id_consulta'] ?>"><button class="eliminar">Cancelar</button></a>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
            <?php
        }else{ ?>
            <h2 class="dia"><?php echo ordenarFecha($fechaBuscar); ?></h2>

            <div class="table">
                <div class="thead__table">
                    <div class="thead">Paciente</div>
                    <div class="thead">Cédula</div>
                    <div class="thead edad">Edad</div>
                    <div class="thead causa">Causa de la Consulta</div>
                    <div class="thead">Hora de Inicio</div>
                    <div class="thead">Hora Final</div>
                    <div class="thead">Télefono</div>
                    <!-- <div class="thead">Acciones</div> -->
                </div>

                <?php
                $consulta = "SELECT * FROM consultas INNER JOIN usuarios INNER JOIN causa_consulta INNER JOIN doctores INNER JOIN status_consulta
                ON consultas.id_paciente = usuarios.id_usuario AND consultas.id_causa_consulta = causa_consulta.id_causa_consulta
                AND consultas.id_doctor = doctores.id_doctor AND consultas.id_status_consulta = status_consulta.id_status_consulta
                WHERE consultas.id_doctor = '$id_doctor' AND consultas.fecha_atencion = '$fechaBuscar' AND  consultas.id_status_consulta != 4
                ORDER BY hora_inicio ASC";
                $query = mysqli_query($conexion, $consulta);

                while ($resultado = mysqli_fetch_array($query)){
                    $horaInicio = date("g:i a",strtotime($resultado['hora_inicio']));
                    $horaFin = date("g:i a",strtotime($resultado['hora_fin']));
                ?>
                    <div class="tbody__table">
                        <div class="tbody nom"><?php echo $resultado['nombre'] . " " . $resultado['apellido']; ?></div>
                        <div class="tbody"><?php echo $resultado['cedula']; ?></div>
                        <div class="tbody edad"><?php echo $resultado['edad']; ?></div>
                        <div class="tbody causa"><?php echo $resultado['causa_consulta']; ?></div>
                        <div class="tbody"><?php echo $horaInicio; ?></div>
                        <div class="tbody"><?php echo $horaFin; ?></div>
                        <div class="tbody"><?php echo $resultado['telefono_1']. " " . $resultado['telefono_2']; ?></div>

                        <!-- <div class="tbody">
                            <a href="../client/botones/cancelar.php?id=<?php echo $resultado['id_consulta'] ?>"><button class="eliminar">Cancelar</button></a>
                        </div> -->
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
        ?>

        <script src="js/confirm.js"></script>
        <script src="js/modal.js"></script>
    </body>
</html>