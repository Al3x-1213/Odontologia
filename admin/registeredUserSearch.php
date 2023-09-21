<?php
include '../client/orderDate.php';

include '../client/connection.php';

// $buscar = $_POST['search'];
$buscar = isset($_POST['searchUser']) ? $conexion->real_escape_string($_POST['searchUser']) : null;

$columnas = ['nombre', 'apellido', 'cedula'];
$busqueda = '';

if ($buscar != null){
    $busqueda = "WHERE (";

    for ($i = 0; $i < 3; $i++){
        $busqueda .= $columnas[$i]. " LIKE '". $buscar. "%' OR ";
    }

    $busqueda = substr_replace($busqueda, "", -3);
    $busqueda .= ")";
}

$consulta = "SELECT * FROM datos_personales $busqueda ";
$query = mysqli_query($conexion, $consulta);

$resultado = mysqli_num_rows($query);

$contenido = '';

if ($resultado > 0){
    while ($respuesta = $query->fetch_assoc()){
        $fechaNacimiento = ordenarFecha($respuesta['fecha_nacimiento']);

        $contenido .= '<tr>';
        $contenido .= '<td>'. $respuesta['nombre'] . ' ' . $respuesta['apellido']. '</td>';
        $contenido .= '<td>'. $respuesta['cedula']. '</td>';
        $contenido .= '<td>'. $respuesta['edad']. '</td>';
        $contenido .= '<td>'. $fechaNacimiento. '</td>';
        $contenido .= '<td>'. $respuesta['telefono_1']. '<br>'. $respuesta['telefono_2']. '</td>';
        $contenido .= '<td>'. $respuesta['correo']. '</td>';
        
        $idDatoPersonal = $respuesta['id_dato_personal'];

        $consulta2 = "SELECT id_cuenta FROM cuentas INNER JOIN datos_personales
        ON cuentas.id_dato_personal = datos_personales.id_dato_personal
        WHERE datos_personales.id_dato_personal = '$idDatoPersonal'";
        $query2 = mysqli_query($conexion, $consulta2);

        $resultado2= mysqli_num_rows($query2);

        if ($resultado2 == 0){
            $contenido .= '<td><a href="../client/botones/update.php?id='. $respuesta['id_dato_personal']. '"><button title="Modificar" class="update"><i class="icon-pencil icon"></i></button></a>
            <a href="../client/botones/active.php?id='. $respuesta['id_dato_personal']. '"><button title="Sin cuenta" class="noUser"><i class="icon-user-times icon"></i></button></a></td>';        
            $contenido .= '</tr>';
        }
        else{
            $respuesta2 = mysqli_fetch_array($query2);
            $idCuenta = $respuesta2['id_cuenta'];

            $consulta3 = "SELECT id_status_usuario FROM cuentas WHERE id_cuenta = '$idCuenta'";
            $query3 = mysqli_query($conexion, $consulta3);

            $respuesta3 = mysqli_fetch_array($query3);
            $idStatusUsuario = $respuesta3['id_status_usuario'];

            if ($idStatusUsuario == 1){
                $contenido .= '<td><a href="../client/botones/update.php?id='. $respuesta['id_dato_personal']. '"><button title="Modificar" class="update"><i class="icon-pencil icon"></i></button></a>
                <a href="../client/botones/inactive.php?id='. $respuesta['id_dato_personal']. '"><button title="Desactivar" class="inactive"><i class="icon-toggle-on icon"></i></button></a></td>';        
                $contenido .= '</tr>';
            }
            elseif ($idStatusUsuario == 2){
                $contenido .= '<td><a href="../client/botones/update.php?id='. $respuesta['id_dato_personal']. '"><button title="Modificar" class="update"><i class="icon-pencil icon"></i></button></a>
                <a href="../client/botones/active.php?id='. $respuesta['id_dato_personal']. '"><button title="Activar" class="active"><i class="icon-toggle-on icon"></i></button></a></td>';        
                $contenido .= '</tr>';
            }




        }
    }
}
else{
    $contenido .= '<tr>';
    $contenido .= '<td colspan="7">No se encuentran resultados</td>';
    $contenido .= '</tr>';
}

echo json_encode($contenido, JSON_UNESCAPED_UNICODE);

?>