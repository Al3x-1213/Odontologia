<?php
include '../client/verificacion_sesion.php';
?>
<?php
function ordenarFecha($fecha){
    $separarFecha = explode("-", $fecha);
    return $fechaOrdenada = $separarFecha[2]."-".$separarFecha[1]."-".$separarFecha[0];
}
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
        <link rel="stylesheet" href="styles/menu2.css">
        <!-- <link rel="stylesheet" href="styles/index.css"> -->
        <link rel="stylesheet" href="styles/tablasPerfil.css">
        <link rel="stylesheet" href="styles/iconosEditProfile.css">
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

        <title>Marisol Díaz - PACIENTE</title>
    </head>
    <body>
        <?php
        include 'components/menu.html';
        include 'components/menu2.php';
        ?>

        <?php
        // VARIABLE GLOBAL: ID DEL USUARIO LOGUEADO
        $id= $_SESSION['id'];

        // OBTENER LA INFORMACIÓN DEL PACIENTE QUE ESTÁ LOGUEADO
        include '../client/conexion.php'; //Conexión con base de datos

        $consulta = "SELECT * FROM usuarios WHERE id_usuario = '$id'";
        $query = mysqli_query($conexion, $consulta);
        ?>

        <h2 class="dia">Perfil de Usuario</h2>
        
        <?php
        while($resultado = mysqli_fetch_array($query)){
            $fechaNacimiento = ordenarFecha($resultado['fecha_nacimiento'])
        ?>
            <div class="table basicInformation">
                <div class="thead">
                    <div class="row">
                        <div class="column">Información Básica</div>
                    </div>
                </div>
                <div class="tbody">
                    <div class="row b">
                        <div class="column">Nombre</div>
                        <div class="column"><?php echo $resultado['nombre']. " ". $resultado['apellido']; ?></div>
                        <!-- <div class="column i"><a href="#">icono</a></div> -->
                    </div>
                    <div class="row b">
                        <div class="column">Cédula</div>
                        <div class="column"><?php echo $resultado['cedula']; ?></div>
                        <!-- <div class="column i"><a href="#">icono</a></div> -->
                    </div>
                    <div class="row">
                        <div class="column">Fecha de Nacimiento</div>
                        <div class="column"><?php echo $fechaNacimiento; ?></div>
                        <!-- <div class="column i"><a href="#">icono</a></div> -->
                    </div> 
                </div>
            </div>

            <div class="table contactInformation">
                <div class="thead">
                    <div class="row">
                        <div class="column">Información de Contacto</div>
                    </div>
                </div>
                <div class="tbody">
                    <div class="row b">
                        <div class="column">Télefono Principal</div>
                        <div class="column"><?php echo $resultado['telefono_1']; ?></div>
                        <div class="column i"><a href="editarPerfil/editarTelefonoP.php">icono</a></div>
                    </div>
                    <div class="row b">
                        <div class="column">Télefono Secundario</div>
                        <div class="column"><?php echo $resultado['telefono_2']; ?></div>
                        <div class="column i"><a href="editarPerfil/editarTelefonoS.php">icono</a></div>
                    </div>
                    <div class="row">
                        <div class="column">Correo Electrónico</div>
                        <div class="column"><?php echo $resultado['correo']; ?></div>
                        <div class="column i"><a href="editarPerfil/editarCorreo.php">icono</a></div>
                    </div> 
                </div>
            </div>

            <div class="table profile">
                <div class="thead">
                    <div class="row">
                        <div class="column">Perfil</div>
                    </div>
                </div>
                <div class="tbody">
                    <div class="row b">
                        <div class="column">Usuario</div>
                        <div class="column"><?php echo $resultado['usuario']; ?></div>
                        <div class="column i"><a href="#">icono</a></div>
                    </div>
                    <div class="row b">
                        <div class="column">Contraseña</div>
                        <div class="column">
                            <?php
                            $clave = $resultado['clave'];
                            $claveArray = str_split($clave);

                            $contador = 0;
                            foreach($claveArray as $elemento){
                                $contador = $contador + 1;
                                echo "*";
                            }
                            ?>
                        </div>
                        <div class="column i"><a href="#">icono</a></div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </body>
</html>