<?php

if (!empty($_POST['boton_c'])){
    // VERIFICAR QUE NO HAYAN CAMPOS VACIOS
    if (empty($_POST['causa']) || empty($_POST['atencion']) || empty($_POST['turno']) || empty($_POST['doctor'])){
        ?>
        <div class= "alerta">No deben haber campos vacios</div>
        <?php
    }
    else{
        // VARIABLE GLOBAL: ID DEL USUARIO LOGUEADO
        $id= $_SESSION['id'];

        //DATOS DEL FORMULARIO
        $causa = $_POST['causa'];
        $fechaAtencion = $_POST['atencion'];
        $turno = $_POST['turno'];
        $idDoctor = $_POST['doctor'];
        $idStatusConsulta = 3;

        // INGRESAR LA CONSULTA A BASE DE DATOS
        include '../client/connection.php'; //Conexión con base de datos

        $consulta = "INSERT INTO consultas VALUES(NULL, '$id', '$causa', '$fechaAtencion',
        '$turno', '', '', '$idDoctor', '$idStatusConsulta', now())";
        $query = mysqli_query($conexion, $consulta);

        if($query){
            ?>
            <div class= "mensaje"><a href= "index.php">Su solicitud fue enviada correctamente</a></div>
            <?php
        }
        else{
            ?>
            <div class= "alerta">No se pudo realizar la solicitud</div>
            <?php
        }    
    }
}

?>