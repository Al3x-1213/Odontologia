<?php
include '../client/verificationSessionAdmin.php';
include '../client/orderDate.php';

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
        <link rel="stylesheet" href="../styles/normalize.css">
        <link rel="stylesheet" href="../styles/mensajes.css">
        <link rel="stylesheet" href="styles/index.css">
        <link rel="stylesheet" href="styles/menu.css">
        <link rel="stylesheet" href="styles/menu2.css">
        <link rel="stylesheet" href="styles/footer.css">
        <link rel="stylesheet" href="styles/iconsButtons.css">
        <link rel="stylesheet" href="styles/search.css">
        <link rel="stylesheet" href="styles/tables.css">
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

        include '../client/messagge.php';

        include 'responsive/header.php';

        ?>
        <h2 class="dia">Bloquear Fecha</h2>

        <div class="blockDateForm">
            <div class="receive">
                <form action="../client/insert/blockDate.php" method="POST" autocomplete="off">
                    <div class="inputs">
                        <input type="date" required name="bloquear" min="<?= $fechaActual; ?>" class="input__form base">
                        <button title="Bloquear" class="button__date"><i class="icon-lock"></i></button>
                    </div>
                </form>
            </div>
        </div>

        <div class="table blockDate">
            <table>
                <thead>
                    <tr>
                        <th>Fechas Bloqueadas</th>
                        <th>Desbloquear</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include '../client/connection.php'; //Conexión con base de datos

                    $consulta = "SELECT * FROM fechas_bloqueadas ORDER BY fecha_bloqueada DESC";
                    $query = mysqli_query($conexion, $consulta);

                    while ($resultado = mysqli_fetch_array($query)) {
                        $fechaBloqueada = ordenarFecha($resultado['fecha_bloqueada']);
                    ?>
                        <tr>
                            <td><?php echo $fechaBloqueada; ?></td>
                            <td><a href="../client/delete/deleteBlockeDates.php?id=<?php echo $resultado['id_fecha_bloqueada'] ?>"><button title="Desbloquear" class="block"><i class="icon-unlocked icon"></i></button></a></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        
        <?php
        include 'components/footer.html';
        mysqli_close($conexion);
        ?>
    </body>
    <script src="../js/messagge.js"></script>
</html>