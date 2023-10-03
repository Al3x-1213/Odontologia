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

  <!-- FAVICON -->
  <link rel="icon" type="image/png" href="img/favicon.png"/>

  <!-- ESTILOS CSS -->
  <link rel="stylesheet" href="styles/normalize.css">
  <link rel="stylesheet" href="styles/header.css">
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
  <?php include 'components/menu.html'; ?>
  <?php include 'responsive/header.php'; ?>
  
  <a name="about"></a>
  <div class="flex__about">
    <div class="text text__about">
      <p>En nuestro consultorio, nos enfocamos en brindar una atención personalizada y de calidad a cada uno de nuestros pacientes, esforzándonos para ofrecer soluciones integrales y efectivas para cada necesidad dental.<br><br>
      Nos apasiona ayudar a nuestros pacientes a lograr una sonrisa saludable y radiante, y estamos comprometidos en hacer que su experiencia en nuestro consultorio sea lo más cómoda y agradable posible.</p>
    </div>
    <aside class="text aside ofrece">
      <h3>¿Qué ofrecemos?</h3>
        <p>Consulta Diagnóstica</p>
        <p>Limpieza Bucal</p>
        <p>Blanqueamiento Dental</p>
        <p>Limpieza bucal</p>
        <p>Obturación de Caries</p>
    </aside>
  </div>

  <div class="contact__container">
    <div class="text">
      <h3> Contáctenos </h3>
      <a name="contact"></a>
      <p>Puedes contactarnos a los siguientes números telefónicos</p>
      <p><b>0414 1369613  ||  0212 2667455  ||  0212 2644194</b></p>
    </div>
    <div class="direccion">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4665.387422099399!2d-66.85731362144323!3d10.49218665969381!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8c2a59db0c04f0d5%3A0x9e88ed05b996221f!2sEdificio%20Lucerna!5e0!3m2!1ses!2sve!4v1696034311054!5m2!1ses!2sve" width="400" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
  </div>

  <?php include 'components/footer.html' ?>
</body>
</html>