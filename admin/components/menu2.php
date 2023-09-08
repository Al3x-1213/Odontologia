<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- ESTILOS CSS -->
        <link rel="stylesheet" href="../styles/normalize.css">
        <link rel="stylesheet" href="../admin/styles/menu2.css">
        <link rel="stylesheet" href="../Iconos/style.css">

        <!-- LETRAS UTILIZADAS -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Raleway:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap" rel="stylesheet">

        <style type="text/css">
            ul {
                list-style-type: none;
            }
	</style>
    </head>
    <body>
        <div class="header">
            <div class="menu2">
                <div class="nameUser">
                    <a href="index.php">@<?php echo $_SESSION['usuario']; ?></a>
                </div>
                <div class="buscadores">
                    <div class="buscadorFechas">
                        <form action="searchDates.php" method= "POST">
                            <div class="inputs">
                                <div class="inputRecibe">
                                    Buscar citas: <input type="date" name="buscar">
                                </div>
                                <div>
                                    <button title="Buscar" class="botonBuscar"><i class="icon-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                    <div class="buscadorPacientes">
                        <!-- <form action="searchPatients.php" method= "POST"> -->
                        <form action="" method= "POST" autocomplete="off">
                            <div class="inputs">
                                <div class="inputRecibe">
                                    <label for="search">Buscar pacientes: </label><input type="text" placeholder="Datos del Paciente:" name="search" id="search">
                                </div>
                                <!-- <div>
                                    <button title="Buscar" class="botonBuscar"><i class="icon-search"></i></button>
                                </div> -->
                            </div>
                            <div>
                                <ul id="filter"></ul>
                            </div>
                        </form>

                        
                    </div> 
                </div>
            </div>
        </div>
        <script src="js/searchFilter.js"></script>
    </body>
</html>