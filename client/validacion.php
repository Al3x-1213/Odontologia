<?php

if (!empty($_POST['boton_log'])){
    // VALIDAR QUE LOS CAMPOS NO ESTÉN VACIOS
    if (empty($_POST['usuario']) || empty($_POST['clave'])){
        ?>
        <div class= "alerta">No deben haber campos vacios</div>
        <?php
    }
    else{
        // DATOS RECIBIDOS DEL LOGUEO PARA SER VALIDADOS DENTRO DE LA BASE DE DATOS
        $usuario = $_POST['usuario'];
        $clave = $_POST['clave'];
        $clave = md5($clave);

        session_start(); // Inicia una sesión
        ob_start();

        include 'conexion.php'; // Conexión con base de datos

        $consulta = "SELECT * FROM usuarios WHERE usuario = '$usuario' and clave = '$clave'";

        // VARIABLES GLOBALES
        $tipo_usuario = mysqli_fetch_array(mysqli_query($conexion, $consulta))['id_tipo_usuario'];
        $usuario = mysqli_fetch_array(mysqli_query($conexion, $consulta))['usuario'];

        $_SESSION['usuario'] = $usuario; 
        $_SESSION['tipo_usuario'] = $tipo_usuario;

        // VALIDACIÓN DEL USUARIO INGRESADO
        if(mysqli_fetch_array(mysqli_query($conexion, $consulta))['id_tipo_usuario'] == 1){ // Administrador / Doctor
            if(mysqli_fetch_array(mysqli_query($conexion, $consulta))['id_status_usuario'] == 1){
                // echo "doctor";
                header("location: ../admin/index.php");
            }
            else{
                ?>
                <div class= "alerta">Usuario inactivo</div>
                <?php
            }
        }
        elseif(mysqli_fetch_array(mysqli_query($conexion, $consulta))['id_tipo_usuario'] == 2){ // Paciente
            if(mysqli_fetch_array(mysqli_query($conexion, $consulta))['id_status_usuario'] == 1){
                echo "paciente";
                // header("location: paciente.php");
            }
            else{
                ?>
                <div class= "alerta">Usuario inactivo</div>
                <?php
            }
        }
        else{
            ?>
            <div class= "alerta">Usuario / Contraseña</div>
            <div class= "alerta">Incorrecto</div>
            <?php
        }
        // mysqli_free_result(mysqli_query($conexion, $consulta));
        mysqli_close($conexion); //Cerrar la conexion con la base de datos
    }
}

// /* DATOS RECIBIDOS DEL LOGUEO PARA SER VALIDADOS DENTRO DE LA BASE DE DATOS */
// $nombre_usuario=$_POST['nombre_usuario'];
// $clave=$_POST['clave'];

// /* ESTO ES PARA VARIABLES GLOBALES  */
// session_start();
// ob_start();
// $_SESSION['sesion'] = 0;

// /* VALIDAR QUE LOS DATOS NO ESTÉN VACIOS  */
// if($nombre_usuario == '' || $clave == ''){
//     header('Location:../index.php');
// }else{
//     $clave=md5($clave);

//     include 'conexion.php';

//     $validar = "SELECT * FROM admin WHERE nombre_usuario='$nombre_usuario'";
//     $validando = $conexion->query($validar);

//     $respuesta = mysqli_fetch_array($validando);

//     if($respuesta['clave'] != $clave){
//         mysqli_close($conexion);
//         ?> <script> alert("nombre_usuario o contraseña equivocado") </script> <?php
//         header('Location:../parts/login.html');
//     }else{
//         $validar = "SELECT * FROM admin WHERE nombre_usuario='$nombre_usuario' AND clave='$clave'";
//         $validando = $conexion->query($validar);
//         if($validando->num_rows > 0){
//             /* CONSULTA A LA BASE DE DATOS PARA VER SI EL USUARIO ESTÁ AHÍ */
//             $_SESSION['sesion'] = 1;
    
//             /* CERRAR LA CONSULTA DE LA BASE DE DATOS */
//             mysqli_close($conexion);
//             header('Location:../admin/index.php');
//         }else{
//             mysqli_close($conexion);
//             header('Location:../index.php');
//         }
//     }
// }

?>