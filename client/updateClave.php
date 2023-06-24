<?php

if (!empty($_POST['boton_upd'])){
    // VERIFICAR QUE NO HAYAN CAMPOS VACIOS
    if (empty($_POST['clave'])){
        ?>
        <div class= "alerta">No deben haber campos vacios</div>
        <?php
    }
    else{
        // VARIABLE GLOBAL: ID DEL USUARIO LOGUEADO
        $id= $_SESSION['id'];

        // DATOS DEL FORMULARIO DE REGISTRO
        $claveAnt = $_POST['claveAnt'];
        $clave = $_POST['clave'];
        $claveConfirm = $_POST['clave2'];

        // CONFIRMAR QUE LA CONTRASEÑA ANTERIOR SEA CORRECTA
        include 'conexion.php'; //Conexión con base de datos

        $consulta = "SELECT clave FROM usuarios WHERE id_usuario = '$id'";
        $query = mysqli_query($conexion, $consulta);

        $resultado = mysqli_fetch_array($query);
        $claveDB = $resultado['clave'];
        $claveAnt= md5($claveAnt);

        if($claveDB != $claveAnt){
            ?>
            <div class= "alerta">Las contraseña no es correcta</div>
            <div class= "alerta">Por favor verificar</div>
            <?php
        }
        else{
            // VERIFICAR QUE AMBAS CONTRASEÑAS SEAN IGUALES
            if ($clave != $claveConfirm){
                ?>
                <div class= "alerta">Las contraseñas deben coincidir</div>
                <div class= "alerta">Por favor verificar</div>
                <?php
            }
            else{
                //HACER REGISTRO EN BASE DE DATOS
                include 'conexion.php'; //Conexión con base de datos

                $clave= md5($clave);

                $consulta = "UPDATE usuarios SET clave = '$clave' WHERE id_usuario = '$id'";
                $query = mysqli_query($conexion, $consulta);

                if($query){
                    ?>
                    <div class= "mensaje"><a href= "../perfilPaciente.php">Actualizado correctamente</a></div>
                    <?php
                }
                else{
                    ?>
                    <div class= "alerta">No se pudo actualizar</div>
                    <?php
                }
            }
        }
    }
}

?>