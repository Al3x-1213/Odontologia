<?php

// CALCULAR EDAD

//Fecha de nacimiento
$nacimiento = $_POST['nacimiento'];

$fechaSeparada = explode('-', $nacimiento);
$dayNacimiento = $fechaSeparada[2];
$monthNacimiento = $fechaSeparada[1];
$yearNacimiento = $fechaSeparada[0];

//Fecha Actual
date_default_timezone_set('America/Caracas');

$fechaActual = getdate();

$dayActual = $fechaActual['mday'];
$monthActual = $fechaActual['mon'];
$yearActual = $fechaActual['year'];

//Edad

if($monthActual > $monthNacimiento){
    $edad = $yearActual - $yearNacimiento;
}
elseif($monthActual == $monthNacimiento && $dayActual == $dayNacimiento){
    $edad = $yearActual - $yearNacimiento;
}
elseif($monthActual == $monthNacimiento && $dayActual > $dayNacimiento){
    $edad = $yearActual - $yearNacimiento;
}
elseif($monthActual == $monthNacimiento && $dayActual < $dayNacimiento){
    $edad = $yearActual - $yearNacimiento;
    $edad = $edad - 1;
}
else{
    $edad = $yearActual - $yearNacimiento;
    $edad = $edad - 1;
}

?>