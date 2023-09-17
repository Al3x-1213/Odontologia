<?php

if (!empty($_POST['button_rec'])){
    // VERIFICAR QUE NO HAYAN CAMPOS VACIOS
    if (empty($_POST['clave']) || empty($_POST['clave2'])){
        ?>
        <div class= "alerta">No deben haber campos vacios</div>
        <?php
    }else{
        // //DATOS DEL FORMULARIO
        $idDatoPersonal = $_POST['id_dato_personal'];
        $clave = $_POST['clave'];
        $claveConfirm = $_POST['clave2'];
        
        // VERIFICAR QUE AMBAS CONTRASEÑAS SEAN IGUALES
        if ($clave != $claveConfirm){
            ?>
            <div class= "alerta">Las contraseñas deben coincidir</div>
            <div class= "alerta">Por favor verificar</div>
            <?php
        }
        else{
            // OBTENER EL ID DE LA CUENTA
            include 'client/connection.php'; //Conexión con base de datos        

            $consulta = "SELECT id_cuenta FROM cuentas WHERE id_dato_personal = '$idDatoPersonal'";
            $query = mysqli_query($conexion, $consulta);

            $respuesta = mysqli_fetch_array($query);
            $idCuenta = $respuesta['id_cuenta'];

            $clave = md5($clave);

            // HACER CAMBIO DE CONTRASEÑA
            $consulta = "UPDATE cuentas SET clave = '$clave' WHERE id_cuenta = '$idCuenta'";
            $query = mysqli_query($conexion, $consulta);

            if ($query){
                ?>
                <div class= "mensaje"><a href= "../../admin/registeredUser.php">Usuario actualizado correctamente</a></div> 
                <?php
            }
            else{
                ?>
                <div class= "alerta">No se pudo actualizar el usuario</div> 
                <?php
            }
        }
    }
}

?>