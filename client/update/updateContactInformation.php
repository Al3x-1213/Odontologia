<?php
session_start();
ob_start();

if (!(isset($_SESSION['id'])) && !(isset($_SESSION['usuario'])) && !(isset($_SESSION['tipo_usuario']))){
    $_SESSION['mensaje'] = "Error al intentar actualizar los datos del usuario";
    $_SESSION['error'] = 1;
    header("location: ../../admin/editProfile.php");
}

if (!empty($_POST['boton_upd'])) {
    // VERIFICAR QUE NO HAYAN CAMPOS VACIOS
    if (empty($_POST['telefono1'])) {
?>
        <div class="alerta">No deben haber campos vacios</div>
        <?php
    } else {
        // VARIABLE GLOBAL: ID DEL USUARIO LOGUEADO
        $idUsuario = $_SESSION['id'];

        //DATOS DEL FORMULARIO DE REGISTRO
        $prefijo_1 = $_POST['pref1'];
        $telefono_1 = $_POST['telefono1'];
        $prefijo_2 = $_POST['pref2'];
        $telefono_2 = $_POST['telefono2'];
        $correo = $_POST['correo'];

        $telefonoCP_1 = $prefijo_1.$telefono_1;
        $telefonoCP_2 = $prefijo_2.$telefono_2;

        //HACER REGISTRO EN BASE DE DATOS
        include '../connection.php'; //Conexión con base de datos

        $consulta = "SELECT id_dato_personal FROM cuentas WHERE id_cuenta = '$idUsuario'";
        $query = mysqli_query($conexion, $consulta);

        $resultado = mysqli_fetch_array($query);
        $idDatoPersonal = $resultado['id_dato_personal'];

        $consulta = "UPDATE datos_personales SET telefono_1 = '$telefonoCP_1', telefono_2 = '$telefonoCP_2', correo = '$correo'
        WHERE id_dato_personal = '$idDatoPersonal'";
        $query = mysqli_query($conexion, $consulta);

        if($query && $_SESSION['tipo_usuario'] == 1) {
            $_SESSION['mensaje'] = "Datos de usuario actualizados";
            $_SESSION['error'] = 3;
            header("location: ../../admin/editProfile.php");
        }else if($query && $_SESSION['tipo_usuario'] == 2) {
            $_SESSION['mensaje'] = "Datos de usuario actualizados";
            $_SESSION['error'] = 3;
            header("location: ../../paciente/perfilPaciente.php");
        }else if(!($query) && $_SESSION['tipo_usuario'] == 1){
            $_SESSION['mensaje'] = "Error al intentar actualizar los datos del usuario";
            $_SESSION['error'] = 1;
            header("location: ../../admin/editProfile.php");
        }else{
            $_SESSION['mensaje'] = "Error al intentar actualizar los datos del usuario";
            $_SESSION['error'] = 1;
            header("location: ../../paciente/perfilPaciente.php");
        }
    }
}

?>