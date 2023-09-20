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
        <link rel="stylesheet" href="styles/iconsButtons.css">
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
        // OBTENER EL ID_DOCTOR SEGÚN EL ID_USUARIO
        include '../client/obtenerId.php';
      
        // OBTENER LA INFORMACIÓN DE TODAS LAS CITAS POR CONFIRMAR DEL DOCTOR QUE ESTÁ LOGUEADO
        include '../client/connection.php'; //Conexión con base de datos

        $consulta = "SELECT * FROM consultas WHERE id_doctor = '$idDoctor' AND id_status_consulta = 3";
        $query = mysqli_query($conexion, $consulta);

        // VALIDACIÓN PARA COMPROBAR QUE LA TABLA NO ESTÉ VACIA
        if($query->num_rows == 0){
        ?>
            <h2 class="dia">No Hay Citas Por Confirmar</h2>
        <?php
        }
        else
        {
        ?>
            <!-- CITAS POR CONFIRMAR -->
            <h2 class="dia">Citas por Confirmar</h2>

            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th>Paciente</th>
                            <th>Cédula</th>
                            <th>Edad</th>
                            <th>Motivo de la Consulta</th>
                            <th>Fecha de Atención</th>
                            <th>Turno</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $consulta = "SELECT * FROM consultas INNER JOIN datos_personales INNER JOIN causa_consulta INNER JOIN doctores INNER JOIN status_consulta INNER JOIN turno_consulta
                        ON consultas.id_paciente = datos_personales.id_dato_personal AND consultas.id_causa_consulta = causa_consulta.id_causa_consulta AND consultas.id_turno_consulta = turno_consulta.id_turno_consulta
                        AND consultas.id_doctor = doctores.id_doctor AND consultas.id_status_consulta = status_consulta.id_status_consulta
                        WHERE consultas.id_doctor = '$idDoctor' AND consultas.id_status_consulta = 3
                        ORDER BY fecha_atencion ASC";
                        $query = mysqli_query($conexion, $consulta);

                        while ($resultado = mysqli_fetch_array($query)){
                            $fechaAtencion = ordenarFecha($resultado['fecha_atencion']);
                        ?>
                            <tr>
                                <td><?php echo $resultado['nombre']. " ". $resultado['apellido']; ?></td>
                                <td><?php echo $resultado['cedula']; ?></td>
                                <td><?php echo $resultado['edad']; ?></td>
                                <td><?php echo $resultado['causa_consulta']; ?></td>
                                <td><?php echo $fechaAtencion; ?></td>
                                <td><?php echo $resultado['turno_consulta']; ?></td>
                                <td><a href="processPatient.php?id=<?php echo $resultado['id_consulta']?>"><button title="Procesar" class="process"><i class="icon-cogs icon"></i></button></a></td>
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

        <script src="js/confirm.js"></script>
        <script src="js/modal.js"></script>
    </body>
</html>