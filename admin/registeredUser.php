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

        <!-- FAVICON -->
        <link rel="icon" type="image/png" href="../img/favicon.png"/>

        <!-- ESTILOS CSS -->
        <link rel="stylesheet" href="styles/modal.css">
        <link rel="stylesheet" href="styles/modalUser.css">
        <link rel="stylesheet" href="../styles/normalize.css">
        <link rel="stylesheet" href="../styles/mensajes.css">
        <link rel="stylesheet" href="styles/menu.css">
        <link rel="stylesheet" href="styles/index.css">
        <link rel="stylesheet" href="styles/search.css">
        <link rel="stylesheet" href="styles/tables.css">
        <link rel="stylesheet" href="styles/iconsButtons.css">
        <link rel="stylesheet" href="styles/footer.css">
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

        //RESPONSIVE TABLE
        include 'responsive/header.php';

        include '../client/messagge.php';

        include 'parts/modalUser.php';
        ?>

        <h2 class="dia">Usuarios Registrados</h2>

        <div class="searchTable">
            <div class="receive">
                <label for="searchUser">Buscar: </label>
                <input type="text" placeholder="Datos del usuario " autocomplete="off" name="searchUser" id="searchUser">
            </div>
            <div class="show">
                <label for="numeroRegistros">Mostrar: </label>
                <select name="numeroRegistros" id="numeroRegistros">
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                </select>
                <label for="numeroRegistros"> registros</label>
            </div>
        </div>

        <div class="table">
            <table>
                <thead>
                    <tr>
                        <th>Paciente</th>
                        <th>Cédula</th>
                        <th>Edad</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Teléfono</th>
                        <th>Correo Electrónico</th>
                        <th>Alergia</th>
                        <th>Discapacidad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="content">
                        
                </tbody>
            </table>
        </div>

        <div class="pagination">
            <div class="quantityDisplayed">
                <label id="numeroPagina"></label>
            </div>
            <div class="navPagination" id="navPaginacion">

            </div>
        </div>

        <div class="space"></div>

        <?php
        include 'components/footer.html';
        ?>

        <script src="js/confirm.js"></script>
        <script src="../js/messagge.js"></script>
        <script src="js/modal.js"></script>
        <script src="js/searchUsers.js"></script>
        <script src="js/validacionRegistrarse.js"></script>
        <script src="../js/searchFilter.js"></script>
    </body>
</html>