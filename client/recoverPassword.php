<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (!empty($_POST['button_rec'])){
    // VERIFICAR QUE NO HAYAN CAMPOS VACIOS
    if (empty($_POST['usuario'])){
        ?>
        <div class= "alerta">No deben haber campos vacios</div>
        <?php
    }
    else{
        // USUARIO RECIBIDO DEL FORMULARIO
        $usuario = $_POST['usuario'];

        // CONSULTAR DATOS DEL USUARIO
        include 'connection.php'; // Conexión con base de datos

        $consulta = "SELECT * FROM cuentas WHERE usuario = '$usuario'";
        $query = mysqli_query($conexion, $consulta);

        $resultado= mysqli_num_rows($query);

        if ($resultado == 0){
            ?>
            <div class= "alerta">Este usuario no existe</div>
            <?php
        }
        else{
            $respuesta = mysqli_fetch_array($query);
            $idCuenta = $respuesta['id_cuenta'];

            $consulta = "SELECT * FROM datos_personales INNER JOIN cuentas
            ON datos_personales.id_dato_personal = cuentas.id_dato_personal
            WHERE id_cuenta = '$idCuenta'";
            $query = mysqli_query($conexion, $consulta);

            $respuesta = mysqli_fetch_array($query);
            $nombre = $respuesta['nombre'];
            $apellido = $respuesta['apellido'];
            $correo = $respuesta['correo'];

            //ENVIAR MENSAJE POR CORREO PARA QUE EL USUARIO PUEDA RECUPERAR LA CONTRASEÑA
            require '../PHPMailer-6.8.1/src/PHPMailer.php';
            require '../PHPMailer-6.8.1/src/SMTP.php';
            require '../PHPMailer-6.8.1/src/Exception.php';

            $mail = new PHPMailer(true);

            try{
                // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'odontologiamarisoldiaz@gmail.com';
                $mail->Password = 'ywususziyehtedag';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->CharSet = 'UTF-8';
                $mail->setFrom('odontologiamarisoldiaz@gmail.com', 'Doctora Marisol Díaz');
                $mail->addAddress($correo, 'RECUPERACIÓN DE CONTRASEÑA');
                $mail->addCC($correo);

                $mail->isHTML(true);
                $mail->Subject = 'RECUPERACIÓN DE CONTRASEÑA';
                $mail->Body = 'Hola '. $nombre. ' '. $apellido. ', '. '<br>'.
                'Te enviamos este mensaje porque recibimos una solicitud para restablecer tu contraseña. Si no hiciste esta solicitud, puedes ignorar este mensaje.'. '<br><br>'.
                'Para crear una nueva contraseña, haz clic en el enlace adjunto.'. '<br><br>'.
                '<a href="http://localhost/tesis/odontologia/recover.php?id='. $respuesta['id_dato_personal']. '">Recuperar Contraseña</a>'. '<br><br>'.
                'Agradecemos tu confianza.'. '<br>'.
                '<b>'. 'Consultorio Odontológico Marisol Díaz'. '</b>';
                $mail->send();
                
                echo "Link para recuperar contraseña enviado correctamente";
            }
            catch (Exception $e) {
                echo 'Mensaje ' . $mail->ErrorInfo;
            }
            
        }
    }
}

?>