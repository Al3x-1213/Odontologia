<?php

if (!empty($_POST['boton_reg'])){

    // VERIFICAR QUE NO HAYAN CAMPOS VACIOS
    if (empty($_POST['usuario']) || empty($_POST['clave']) || empty($_POST['clave2'])
    || empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['cedula'])
    || empty($_POST['nacimiento']) || empty($_POST['telefono1']) || empty($_POST['correo'])){
    
        ?>
        <div class= "alerta">No deben haber campos vacios</div>
        <?php
    }
    else{
        //DATOS DEL FORMULARIO DE REGISTRO
        $usuario = $_POST['usuario'];
        $clave = $_POST['clave'];
        $clave_confirm = $_POST['clave2'];
        $tipo_usuario = "2";
        $status_usuario = "1";

        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $cedula = $_POST['cedula'];
        $nacimiento = $_POST['nacimiento'];
        $telefono_1 = $_POST['telefono1'];
        $telefono_2 = $_POST['telefono2'];
        $correo = $_POST['correo'];

        // VERIFICAR QUE AMBAS CONTRASEÑAS SEAN IGUALES
        if ($clave != $clave_confirm){
            ?>
            <div class= "alerta">Las contraseñas deben coincidir</div>
            <div class= "alerta">Por favor verificar</div>
            <?php
        }
        else{
            // CALCULAR EDAD

            //Fecha de nacimiento
            $nacimiento = $_POST['nacimiento'];

            $fecha_separada = explode('-', $nacimiento);
            $day = $fecha_separada[2];
            $month = $fecha_separada[1];
            $year = $fecha_separada[0];

            //Fecha Actual
            date_default_timezone_set('America/Caracas');

            $fecha_actual = getdate();

            $day_actual = $fecha_actual['mday'];
            $month_actual = $fecha_actual['mon'];
            $year_actual = $fecha_actual['year'];

            //Edad
            if($month_actual > $month){
                $edad = $year_actual - $year;
            }
            elseif($month_actual == $month && $day_actual == $day){
                $edad = $year_actual - $year;
            }
            elseif($month_actual == $month && $day_actual > $day){
                $edad = $year_actual - $year;
            }
            elseif($month_actual == $month && $day_actual < $day){
                $edad = $year_actual - $year;
                $edad = $edad - 1;
            }
            else{
                $edad = $year_actual - $year;
                $edad = $edad - 1;
            }

            //HACER REGISTRO EN BASE DE DATOS
            include 'conexion.php'; //Conexión con base de datos

            $clave= md5($clave);

            $consulta = "INSERT INTO usuarios VALUES(NULL, '$usuario', '$clave', '$tipo_usuario', '$status_usuario',
            '$nombre', '$apellido', '$cedula', '$edad', '$nacimiento', '$telefono_1', '$telefono_2',  '$correo', now())";
            $query = mysqli_query($conexion, $consulta);

            if($query){
                ?>
                <div class= "mensaje"><a href= "login.php">Usuario regitrado correctamente</a></div>
                <?php
            }
            else{
                ?>
                <div class= "alerta">No se pudo realizar el registro</div>
                <?php
            }
        }
    }
}

?>