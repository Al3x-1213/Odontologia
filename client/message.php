<?php 

session_start();
ob_start();
$_SESSION['mesaje'] = $messagge;

?>

<script>
    let mensaje = '';
</script>

<?php
switch ($_SESSION['mesaje']){
    case '1':?>
        <div class="messagge messagge__success" id="1">Usuario registrado exitosamente <i class="icon-cross"></i></div>
        <?php 
    break;
    case '2':?>
        <div class="messagge messagge__error" id="2">Usuario no pudo registrarse <i class="icon-cross"></i></div>
        <?php 
    break;
}

?>