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
        <link rel="stylesheet" href="styles/usuarios.css">
        <link rel="stylesheet" href="styles/modal.css">
        <link rel="stylesheet" href="../Iconos/style.css">

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
        <?php
        include 'components/menu.html';
        include 'components/menu2.php';

        include 'parts/modalUser.php';
        ?>

        <h2 class="dia">Usuarios</h2>

        <?php
        include '../client/connection.php'; //Conexión con base de datos

        $consulta = "SELECT * FROM datos_personales";
        $query = mysqli_query($conexion, $consulta);
        ?>

        <div class="table slice"> <!--slice-->
            <div class="thead__table">
                <div class="thead">Paciente</div>
                <!-- <div class="thead">Usuario</div> -->
                <div class="thead cedula">Cédula</div>
                <div class="thead edad">Edad</div>
                <div class="thead">Fecha de Nacimiento</div>
                <div class="thead">Télefono</div>
                <div class="thead correo">Correo Electrónico</div>
                <div class="thead">Acciones</div>
            </div>

            <?php
            while ($resultado = mysqli_fetch_array($query)) {
                $fechaNacimiento = ordenarFecha($resultado['fecha_nacimiento']);
            ?>
                <div class="tbody__table">
                    <div class="tbody nom"><?php echo $resultado['nombre'] . " " . $resultado['apellido']; ?></div>
                    <!-- <div class="tbody"><?php echo $resultado['usuario']; ?></div> -->
                    <div class="tbody cedula"><?php echo $resultado['cedula']; ?></div>
                    <div class="tbody edad"><?php echo $resultado['edad']; ?></div>
                    <div class="tbody"><?php echo $fechaNacimiento; ?></div>
                    <div class="tbody contacto"><?php echo $resultado['telefono_1']." ". $resultado['telefono_2']; ?></div>
                    <div class="tbody correo"><?php echo $resultado['correo']; ?></div>

                    <div class="tbody">
                        <a href="editar.php?id=<?php echo $resultado['id_usuario']?>"><button title="Modificar" class="update"><i class="icon-pencil icon"></i></button></a>
                        <a href="../client/eliminar.php?id=<?php echo $resultado['id_usuario']?>"><button title="Eliminar" class="delete"><i class="icon-bin icon"></i></button></a>
                    </div>                
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
        <script src="js/modal.js"></script>
    </body>
</html>