<?php
include '../verificationSessionAdmin.php';
include '../orderDate.php';

date_default_timezone_set('America/Caracas');
$fechaActual = date("Y-m-d");
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
        <link rel="stylesheet" href="../../admin/styles/normalize.css">
        <link rel="stylesheet" href="../../admin/styles/mensajes.css">
        <link rel="stylesheet" href="../../admin/styles/index.css">
        <link rel="stylesheet" href="../../styles/iconsButtons.css">
        <link rel="stylesheet" href="../../admin/styles/search.css">
        <link rel="stylesheet" href="../../admin/styles/tables.css">
        <link rel="stylesheet" href="../../Iconos/style.css">

        <!-- LETRAS UTILIZADAS -->
        <!-- <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Raleway:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap" rel="stylesheet"> -->

        <title>Marisol Díaz - ADMINISTRADOR</title>
    </head>
    <body>
        <h2 class="dia">Bloquear Fecha</h2>

        <div class="searchUsers">
            <form method= "POST" autocomplete="off">
                <?php
                include '../insert/blockDate.php';
                ?>
                <div class="inputs">
                    <input type="date" required name="bloquear" min="<?= $fechaActual; ?>" class="input__form base">
                    <input type="submit" value="Bloquear Fecha" name="button_block" class="button">
                </div>
            </form>
        </div>

        <div class="table">
            <table>
                <thead>
                    <tr>
                        <th>Fechas Bloqueadas</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include '../connection.php'; //Conexión con base de datos

                    $consulta = "SELECT * FROM fechas_bloqueadas ORDER BY fecha_bloqueada DESC";
                    $query = mysqli_query($conexion, $consulta);

                    while ($resultado = mysqli_fetch_array($query)) {
                        $fechaBloqueada = ordenarFecha($resultado['fecha_bloqueada']);
                    ?>
                        <tr>
                            <td><?php echo $fechaBloqueada; ?></td>
                            <td><a href="../delete/deleteBlockeDates.php?id=<?php echo $resultado['id_fecha_bloqueada'] ?>"><button title="Bloquear Fecha" class="block"><i class="icon-blocked icon"></i></button></a></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        
        <?php
        mysqli_close($conexion);
        ?>

        <!-- <div class="space"></div> -->
    </body>
</html>