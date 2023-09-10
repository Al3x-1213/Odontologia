	<!-- <form action="" method="post" autocomplete="off">
		<div>
			<label for="search">Buscar:</label>
			<input type="text" name="search" id="search">

			<ul id="filter"></ul>
		</div>
	</form> -->

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
            /* ul {
                list-style-type: none;
                width: 300px;
                height: auto;
                position: absolute;
                margin-top: 10px;
                margin-left: 10px;
                color: #333;
            }

            li {
                background-color: #EEEEEE;
                border-top: 1px solid #9e9e9e;
                padding: 5px;
                width: 100%;
                float: left;
                cursor: pointer;
            } */
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
                    
                    <div class="searchPatients">
                        <form action="" method= "POST" autocomplete="off">
                            <div class="inputs">
                                <div class="inputRecibe">
                                    <label for="search">Buscar pacientes: </label><input type="text" placeholder="Datos del Paciente:" name="search" id="search">
                                </div>
                                <!-- <div>
                                    <button title="Buscar" class="botonBuscar"><i class="icon-search"></i></button>
                                </div> -->
                            </div>
                            <div class="filter">
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