<?php

include '../client/connectionSearch.php';

$conexion = new Database();
$pdo = $conexion->conectar();

$buscar = $_POST["search"];

// $consulta = "SELECT * FROM datos_personales INNER JOIN cuentas ON datos_personales.id_dato_personal = cuentas.id_dato_personal
// WHERE (nombre LIKE ? OR apellido LIKE ? OR cedula LIKE ?) AND id_tipo_usuario = 2 ORDER BY nombre ASC";
$consulta = "SELECT * FROM datos_personales WHERE nombre LIKE ? OR apellido LIKE ? OR cedula LIKE ? ORDER BY nombre ASC";
$query = $pdo->prepare($consulta);
$query->execute([$buscar . '%', $buscar . '%', $buscar . '%']);

$contenido = "";

while ($resultado = $query->fetch(PDO::FETCH_ASSOC)){
    $idDatoPersonal = $resultado['id_dato_personal'];

    include '../client/connection.php';

    $consulta2 = "SELECT id_cuenta FROM cuentas WHERE id_dato_personal = '$idDatoPersonal'";
    $query2 = mysqli_query($conexion, $consulta2);
        
    $resultado2= mysqli_num_rows($query2);

    if ($resultado2 != 0){
        $respuesta = mysqli_fetch_array($query2);
        $idCuenta = $respuesta['id_cuenta'];

        $consulta2 = "SELECT id_doctor FROM doctores WHERE id_usuario = '$idCuenta'";
        $query2 = mysqli_query($conexion, $consulta2);

        $resultado2= mysqli_num_rows($query2);

        if ($resultado2 == 0){
            $contenido .= "<li><a href='searchPatients.php?id=".$resultado['id_dato_personal']."'>". $resultado["nombre"]. " ". $resultado["apellido"]. "<span class='cedulaSearch'> (".  $resultado["cedula"]. ") </span>". "</a></li>";
        }
    }
    else{
        $contenido .= "<li><a href='searchPatients.php?id=".$resultado['id_dato_personal']."'>". $resultado["nombre"]. " ". $resultado["apellido"]. "<span class='cedulaSearch'> (".  $resultado["cedula"]. ") </span>". "</a></li>";
    }

    // $contenido .= "<li><a href='searchPatients.php?id=".$resultado['id_dato_personal']."'>". $resultado["nombre"]. " ". $resultado["apellido"]. "<span class='cedulaSearch'> (".  $resultado["cedula"]. ") </span>". "</a></li>";
}

echo json_encode($contenido, JSON_UNESCAPED_UNICODE);

?>