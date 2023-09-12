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
        <link rel="stylesheet" href="styles/footer.css">
        <link rel="stylesheet" href="styles/modal.css">
        <link rel="stylesheet" href="styles/tabla.css">
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
        // PACIENTE PARA BUSCAR
        $id_user = $_GET['id'];

        // OBTENER EL ID_DOCTOR según el ID_USUARIO
        include '../client/obtenerId.php';

        // DATOS DEL PACIENTE
        include '../client/connection.php'; //Conexión con base de datos
        
        $consulta = "SELECT * FROM usuarios WHERE id_usuario = '$id_user' AND id_tipo_usuario = 2";
        $query = $conexion->query($consulta);
        ?>
    
        <h2 class="dia">Pacientes</h2>

        <div class="table">
            <div class="thead__table">
                <div class="thead">Paciente</div>
                <div class="thead">Cédula</div>
                <div class="thead">Edad</div>
                <div class="thead">Fecha de Nacimiento</div>
                <div class="thead contacto">Télefono</div>
                <div class="thead correo">Correo Electrónico</div>
                <div class="thead">Acciones</div>
            </div>

            <?php
            while ($resultado = mysqli_fetch_array($query)) {
                $fechaNacimiento = ordenarFecha($resultado['fecha_nacimiento']);
            ?>
                <div class="tbody__table">
                    <div class="tbody nom"><?php echo $resultado['nombre'] . " " . $resultado['apellido']; ?></div>
                    <div class="tbody"><?php echo $resultado['cedula']; ?></div>
                    <div class="tbody"><?php echo $resultado['edad']; ?></div>
                    <div class="tbody"><?php echo $fechaNacimiento; ?></div>
                    <div class="tbody"><?php echo $resultado['telefono_1']. " ". $resultado['telefono_2']; ?></div>
                    <div class="tbody correo"><?php echo $resultado['correo']; ?></div>
                    <div class="tbody">
                        <a href="../client/botones/atendido.php?id=<?php echo $resultado['id_consulta'] ?>"><button title="Editar" class="modificar"><i class="icon-pencil icon"></i></button></a>
                        <a href="../client/botones/cancelar.php?id=<?php echo $resultado['id_consulta'] ?>"><button title="Eliminar" class="cancelar"><i class="icon-bin icon"></i></button></a>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>

        <h2 class="dia">Historial de consultas</h2>

        <div class="table table2">
            <div class="thead__table">
                <div class="thead thead2">Causa de la Consulta</div>
                <div class="thead thead2">Fecha de Atención</div>
                <div class="thead thead2">Hora de Inicio</div>
                <div class="thead thead2">Hora de Culminación</div>
            </div>

            <?php

            // HISTORIAL DE LAS CONSULTAS DEL PACIENTE
            $consulta = "SELECT * FROM consultas INNER JOIN usuarios INNER JOIN causa_consulta INNER JOIN doctores INNER JOIN status_consulta
            ON consultas.id_paciente = usuarios.id_usuario AND consultas.id_causa_consulta = causa_consulta.id_causa_consulta
            AND consultas.id_doctor = doctores.id_doctor AND consultas.id_status_consulta = status_consulta.id_status_consulta
            WHERE consultas.id_doctor = '$id_doctor' AND consultas.id_status_consulta = '1' AND usuarios.cedula = '$paciente'
            ORDER BY fecha_atencion DESC";
            // echo $consulta;
            // $query = $conexion->query($consulta);
            $query = mysqli_query($conexion, $consulta);

            while ($resultado = mysqli_fetch_array($query)) {
                $fechaAtencion = ordenarFecha($resultado['fecha_atencion']);
                $horaInicio = date("g:i a",strtotime($resultado['hora_inicio']));
                $horaFin = date("g:i a",strtotime($resultado['hora_fin']));
            ?>
                <div class="tbody__table">
                    <div class="tbody tbody2"><?php echo $resultado['causa_consulta']; ?></div>
                    <div class="tbody tbody2"><?php echo $fechaAtencion; ?></div>
                    <div class="tbody tbody2"><?php echo $horaInicio; ?></div>
                    <div class="tbody tbody2"><?php echo $horaFin; ?></div>
                </div>
            <?php
            }
            ?>
        </div>

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