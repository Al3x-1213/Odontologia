<?php
include '../client/verificationSession.php';
?>
<?php
function ordenarFecha($fechaOrdenada){
    $fecha = explode("-", $fechaOrdenada);
    return $fechaOrdenada = $fecha[2]."-".$fecha[1]."-".$fecha[0];
}
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
        // OBTENER EL ID_DOCTOR según el ID_USUARIO
        include '../client/obtenerId.php';

        //SELECT * FROM `consultas` INNER JOIN `usuarios` INNER JOIN `causa_consulta` INNER JOIN `doctores` INNER JOIN `status_consulta` ON `consultas`.`id_paciente` = `usuarios`.`id_usuario` AND `consultas`.`id_causa_consulta` = `causa_consulta`.`id_causa_consulta` AND `consultas`.`id_doctor` = `doctores`.`id_doctor` AND `consultas`.`id_status_consulta` = `status_consulta`.`id_status_consulta` WHERE `consultas`.`id_status_consulta` = 1
      
        // OBTENER LA INFORMACIÓN DE TODAS LAS CITAS ATENDIDAS POR EL DOCTOR QUE ESTÁ LOGUEADO
        include '../client/connection.php'; //Conexión con base de datos

        $consulta = "SELECT * FROM consultas INNER JOIN usuarios INNER JOIN causa_consulta INNER JOIN doctores INNER JOIN status_consulta
        ON consultas.id_paciente = usuarios.id_usuario AND consultas.id_causa_consulta = causa_consulta.id_causa_consulta
        AND consultas.id_doctor = doctores.id_doctor AND consultas.id_status_consulta = status_consulta.id_status_consulta
        WHERE consultas.id_doctor = '$id_doctor' AND consultas.id_status_consulta = 1";
        $query = mysqli_query($conexion, $consulta);
        ?>

        <h2 class="dia">Citas Atendidas</h2>

        <div class="table">
            <div class="thead__table">
                <div class="thead">Paciente</div>
                <div class="thead">Cédula</div>
                <div class="thead causa">Causa de la Consulta</div>
                <div class="thead">Fecha de Atención</div>
                <div class="thead">Hora de inicio</div>
                <div class="thead">Hora de culminación</div>
                <!-- <div class="thead">Acciones</div> -->
            </div>

            <?php
            while ($resultado = mysqli_fetch_array($query)) {
                $fechaAtencion = ordenarFecha($resultado['fecha_atencion'])
            ?>
                <div class="tbody__table">
                    <div class="tbody nom"><?php echo $resultado['nombre'] . " " . $resultado['apellido']; ?></div>
                    <div class="tbody"><?php echo $resultado['cedula']; ?></div>
                    <div class="tbody causa"><?php echo $resultado['causa_consulta']; ?></div>
                    <div class="tbody"><?php echo $fechaAtencion; ?></div>
                    <div class="tbody"><?php echo $resultado['hora_inicio']; ?></div>
                    <div class="tbody"><?php echo $resultado['hora_fin']; ?></div>

                    <!-- <div class="tbody">
                        <a href="../client/crud/status2.php?id=<?php echo $resultado['id_consulta']?>"><button class="eliminar">Eliminar</button></a>
                    </div> -->
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