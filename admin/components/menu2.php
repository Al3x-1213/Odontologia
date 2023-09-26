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
	</head>

	<body>
		<div class="container__menu2">
			<div class="name__menu2">
				<a href="index.php">@<?php echo $_SESSION['usuario']; ?></a>
			</div>
			<div class="search__menu2">
				<div class="searchDate__menu2">
					<form action="searchDates.php" method="POST">
						<div class="inputs__menu2">
							<label for="search" class="label__date"> Buscar Citas: </label>
							<div class="input__date">
								<input type="date" name="buscar">
							</div>
							<div>
								<button title="Buscar" class="button__date"><i class="icon-search"></i></button>
							</div>
						</div>
					</form>
				</div>

				<div class="searchPatients">
					<form action="" method="POST" autocomplete="off">
						<div class="inputs__menu2">
							<label for="search"> Buscar Pacientes: </label>
							<div class="input__data">
								<input type="text" placeholder="Datos del Paciente:" name="search" id="search">
							</div>
						</div>
						<div class="filter">
							<ul id="filter"></ul>
						</div>
					</form>
				</div>
			</div>
		</div>
		<script src="js/searchFilter.js"></script>
	</body>

	</html>