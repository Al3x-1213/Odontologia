<?php 
session_start();
ob_start();
session_destroy();
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <!-- META ETIQUETAS -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- ESTILOS CSS -->
  <link rel="stylesheet" href="styles/normalize.css">
  <link rel="stylesheet" href="styles/menu.css">
  <link rel="stylesheet" href="styles/index.css">
  <link rel="stylesheet" href="styles/footer.css">
  <link rel="stylesheet" href="Iconos/style.css">

  <!-- LETRAS UTILIZADAS -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Raleway:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap" rel="stylesheet">

  <title>Consultorio MARISOL DÍAZ</title>
</head>

<body>
  <a name="menu"></a>
  <?php include 'components/menu.html' ?>
  <div class="img__container"> <img src="img/consultorio riccio.jpg" alt="consultio de riccio" class="img"></div>
  
  <a name="acercade"></a>
  <div class="container flex">
    <div class="text__container text1">
      <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Officiis explicabo magnam inventore illum, culpa hic odit similique ratione, incidunt fugiat esse quo ipsam sit reprehenderit, voluptas at natus optio maiores.
      Magni beatae, porro expedita exercitationem autem id modi, illum dolore asperiores alias velit nam assumenda ipsa perspiciatis similique adipisci. Itaque mollitia excepturi ex molestias soluta, ab sed repellat unde perspiciatis?</p>
    </div>
    <aside class="text__container text2">
      <h3>¿Qué ofrecemos?</h3>
      <ul>
        <li>Consulta Diagnóstica</li>
        <li>Limpieza Bucal</li>
        <li>Blanqueamiento Dental</li>
        <li>Limpieza bucal</li>
        <li>Obturación de Caries</li>
      </ul>
    </aside>
  </div>

  <div class="contactanos">
    <div class="address">
      <h3> Contáctenos </h3>
      <a name="contactanos"></a>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad illo sapiente nulla dolor odit? Autem facere eligendi tempora saepe quas aliquid blanditiis, vitae laboriosam necessitatibus ullam itaque aut obcaecati! Fuga!</p>
      <p>Teléfono: <b>+58 xxxx xxxx  ||  +58 xxxx xxxx</b></p>
    </div>
    <div class="imgadd">
      <!-- <img src="img/direccion.jpeg" alt="direccion de consultio riccio" class="direccion"> -->
      <a href="https://www.google.com/maps/place/Edificio+Lucerna/@10.4923621,-66.8570139,20.29z/data=!4m14!1m7!3m6!1s0x8c2a59db0c04f0d5:0x9e88ed05b996221f!2sEdificio+Lucerna!8m2!3d10.49236!4d-66.8568355!16s%2Fg%2F11srjp38h9!3m5!1s0x8c2a59db0c04f0d5:0x9e88ed05b996221f!8m2!3d10.49236!4d-66.8568355!16s%2Fg%2F11srjp38h9?hl=es&entry=ttu">
        <img src="img/direccion.png" alt="direccion de consultio riccio" class="direccion">
      </a>
    </div>
  </div>

  <?php include 'components/footer.html' ?>
</body>
</html>