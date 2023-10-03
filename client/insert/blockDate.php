<?php

if (!empty($_POST['button_block'])){
    // VERIFICAR QUE NO HAYAN CAMPOS VACIOS
    if (empty($_POST['bloquear'])){
        session_start();
        $_SESSION['mensaje'] = "No deben haber campos vacios";
        $_SESSION['error'] = 1;
        header("location: ../../login.php");
    }
    else{
        // DATOS DEL FORMULARIO
        $bloquearFecha = $_POST['bloquear'];

        // echo $bloquearFecha;

        // CONSULTA A BASE DE DATOS
        include '../connection.php';

        $consulta = "SELECT id_fecha_bloqueada FROM fechas_bloqueadas WHERE fecha_bloqueada = ' $bloquearFecha'";
        // echo $consulta;
        $query = mysqli_query($conexion, $consulta);

        $resultado= mysqli_num_rows($query);

        if ($resultado > 0){
            ?>
            <div class= "alerta">Esta fecha se encuentra bloqueada</div>
            <?php
        }
        else{
            // echo "si";
            $consulta = "INSERT INTO fechas_bloqueadas (id_fecha_bloqueada, fecha_bloqueada) VALUES (NULL, '$bloquearFecha')";
            // echo $consulta;
            $query = mysqli_query($conexion, $consulta);
            if($query){
                ?>
                <div class= "mensaje">Fecha bloqueada</div>
                <?php
            }
            else{
                ?>
                <div class= "alerta">No se pudo realizar el proceso</div>
                <?php
            }
        }
    }
}

?>