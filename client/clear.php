<?php  

include 'connection.php';

$consulta = "SELECT id_consulta FROM consultas WHERE id_status_consulta = 2 AND DATEDIFF(CURDATE(), fecha_atencion) > 0";
$query = $conexion->query($consulta);

if($query->num_rows > 0){
    while($respuesta = mysqli_fetch_array($query)){

        $id_consulta = $respuesta['id_consulta'];

        echo "<br>". $id_consulta ."<br>" ;

        $consulta2 = "UPDATE consultas SET id_status_consulta = 1 WHERE id_consulta = '$id_consulta'";
        $query2 = $conexion->query($consulta2); 
        if($query2){
            echo "<br> hola <br>";
        }else{
            echo "<br> nenei nenei <br>";
        }
    }
}

mysqli_close($conexion);

?>