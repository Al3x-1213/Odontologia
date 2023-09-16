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
    }else{
        // USUARIO RECIBIDO DEL FORMULARIO
        $usuario = $_POST['usuario'];
        // echo $usuario;

        include 'connection.php'; // Conexión con base de datos

        $consulta = "SELECT * FROM cuentas WHERE usuario = '$usuario'";
        // echo $consulta;
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
            // echo $idCuenta;

            $consulta = "SELECT id_dato_personal FROM cuentas WHERE id_cuenta = '$idCuenta'";
            // echo $consulta;
            $query = mysqli_query($conexion, $consulta);

            $respuesta = mysqli_fetch_array($query);
            $idDatoPersonal = $respuesta['id_dato_personal'];
            // echo $idDatoPersonal;

            $consulta = "SELECT correo FROM datos_personales WHERE id_dato_personal = '$idDatoPersonal'";
            // echo $consulta;
            $query = mysqli_query($conexion, $consulta);

            $respuesta = mysqli_fetch_array($query);
            $correo = $respuesta['correo'];

            // echo $correo;

            // //ENVIAR MENSAJE POR CORREO PARA QUE EL USUARIO PUEDA RECUPERAR LA CONTRASEÑA
            // require '../PHPMailer-6.8.1/src/PHPMailer.php';
            // require '../PHPMailer-6.8.1/src/SMTP.php';
            // require '../PHPMailer-6.8.1/src/Exception.php';

            // $mail = new PHPMailer(true);

            // try{
            //     $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            //     $mail->isSMTP();
            //     $mail->Host = 'smtp.gmail.com';
            //     $mail->SMTPAuth = true;
            //     $mail->Username = 'veroitr39@gmail.com';
            //     $mail->Password = 'lxhmcqkezlruxppe';
            //     $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            //     $mail->Port = 587;

            //     $mail->CharSet = 'UTF-8';
            //     $mail->setFrom('veroitr39@gmail.com', 'Doctora Marisol Díaz');
            //     $mail->addAddress($correo, 'RECUPERACIÓN DE CONTRASEÑA');
            //     $mail->addCC($correo);

            //     $mail->isHTML(true);
            //     $mail->Subject = 'RECUPERACIÓN DE CONTRASEÑA';
            //     $mail->Body = 'Estimado/a '. $nombre. ' '. $apellido. ', '. '<br>'.
            //     'Le escribimos para confirmar su consulta odontológica. Su cita está programada para el '. '<b>'.
            //     $diaSemana. $day. ' de '. $mesAño. ' de '. $year. '</b>'. ' a las '. '<b>'. $horaAtencion. '</b>'. '<br><br>'.
            //     'Le recordamos que debe llegar con 15 minutos de anticipación.'. '<br><br>'.
            //     'Número de contacto: 0414-1369613 / 0212-2667465 / 0212-2644194'. '<br>'.
            //     'Dirección: <a href="https://www.google.com/maps/place/Edificio+Lucerna/@10.4923621,-66.8570139,20.29z/data=!4m14!1m7!3m6!1s0x8c2a59db0c04f0d5:0x9e88ed05b996221f!2sEdificio+Lucerna!8m2!3d10.49236!4d-66.8568355!16s%2Fg%2F11srjp38h9!3m5!1s0x8c2a59db0c04f0d5:0x9e88ed05b996221f!8m2!3d10.49236!4d-66.8568355!16s%2Fg%2F11srjp38h9?hl=es&entry=ttu">Av. Francisco de Miranda, Edif. Lucerna - PB / #4. Chacao, Caracas</a>'. '<br><br>'.
            //     'Esperamos atenderle pronto y brindarle el mejor servicio.'. '<br><br>'.
            //     'Atentamente,'. '<br>'.
            //     '<b>'. 'Consultorio Odontológico Marisol Díaz'. '</b>';
            //     $mail->send();
                
            //     echo "Confirmación de cita enviada correctamente";
            // }
            // catch (Exception $e) {
            //     echo 'Mensaje ' . $mail->ErrorInfo;
            // }
        }
    }
}

?>