<?php
include '../../client/verificationSession.php';
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- ESTILOS CSS -->
        <link rel="stylesheet" href="../../styles/normalize.css">
        <link rel="stylesheet" href="../styles/menu.css">
        <link rel="stylesheet" href="../styles/menu2.css">
        <!-- <link rel="stylesheet" href="styles/index.css"> -->
        <link rel="stylesheet" href="../../styles/mensajes.css">
        <link rel="stylesheet" href="../styles/tarjetasEdit.css">
        <link rel="stylesheet" href="../styles/iconosEditProfile.css">
        <link rel="stylesheet" href="../styles/footer.css">
        <link rel="stylesheet" href="../styles/modal.css">
        <link rel="stylesheet" href="../../Iconos/style.css">

        <!-- LETRAS UTILIZADAS -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Raleway:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap" rel="stylesheet">

        <title>Marisol Díaz - PACIENTE</title>
    </head>
    <body>
        <?php
        include '../components/menu.html';
        include '../components/menu2.php';
        ?>

        <?php
        // VARIABLE GLOBAL: ID DEL USUARIO LOGUEADO
        $id= $_SESSION['id'];

        // OBTENER LA INFORMACIÓN DEL PACIENTE QUE ESTÁ LOGUEADO
        include '../../client/connection.php'; //Conexión con base de datos

        $consulta = "SELECT clave FROM usuarios WHERE id_usuario = '$id'";
        $query = mysqli_query($conexion, $consulta);

        $resultado = mysqli_fetch_array($query);
        ?>

        <h2 class="dia">Editar Perfil de Usuario</h2>
        
        <div class="card editclave">
            <div class="thead">
                <div class="row">
                    <div class="column">Contraseña: </div>
                    <div class="mensaje">
                        <?php
                        include '../../client/updateClave.php';
                        ?>
                    </div>
                </div>
            </div>
            <div class="tbody">
                <div class="row">
                    <div class="column">
                        <form method="POST">
                            <div class="inputs">
                                <div class="input">
                                    <input type="password" required name="claveAnt" placeholder="Ingresa tu contraseña anterior" class="inputUpdate">
                                    <input type="password" required name="clave" placeholder="Nueva contraseña" class="inputUpdate">
                                    <input type="password" required name="clave2" placeholder="Confirmar contraseña" class="inputUpdate">
                                </div>
                                <div class="button">
                                    <input type="submit" value="Enviar" name="boton_upd">
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- <div class="column i"><a href="#">icono</a></div> -->
                </div>
            </div>
        </div>
    </body>
</html>