<?php

if (!empty($_POST['boton_upd'])){
    // VERIFICAR QUE NO HAYAN CAMPOS VACIOS
    if (empty($_POST['usuario'])){
        ?>
        <div class= "alerta">No deben haber campos vacios</div>
        <?php
    }
    else{
        // VARIABLE GLOBAL: ID DEL USUARIO LOGUEADO
        $id= $_SESSION['id'];

        //DATOS DEL FORMULARIO DE REGISTRO
        $usuario = $_POST['usuario'];

        //HACER REGISTRO EN BASE DE DATOS
        include 'conexion.php'; //Conexión con base de datos

        $consulta = "UPDATE usuarios SET usuario = '$usuario' WHERE id_usuario = '$id'";
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

?>