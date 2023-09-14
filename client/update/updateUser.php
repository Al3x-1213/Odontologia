<?php
include '../verificationSession.php';
?>
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
        $idUsuario= $_SESSION['id'];

        //DATOS DEL FORMULARIO
        $usuario = $_POST['usuario'];

        // echo $idUsuario. "<br>";
        // echo $usuario. "<br>";

        //HACER REGISTRO EN BASE DE DATOS
        include '../connection.php'; //Conexión con base de datos

        $consulta = "UPDATE cuentas SET usuario = '$usuario' WHERE id_cuenta = '$idUsuario'";
        // echo $consulta;
        $query = mysqli_query($conexion, $consulta);

        if($query){
            header("location: ../../paciente/perfilPaciente.php");
            ?>
            <!-- <div class= "mensaje"><a href= "../perfilPaciente.php">Actualizado correctamente</a></div> -->
            <?php
        }
        else{
            ?>
            <!-- <div class= "alerta">No se pudo actualizar</div> -->
            <?php
        }  
    }
}

?>