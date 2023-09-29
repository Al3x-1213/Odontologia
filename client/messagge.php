<?php 
if(isset($_SESSION['mensaje']) && isset($_SESSION['error']) && $_SESSION['error'] == 2){
    ?> <div class="messagge messagge__success"><?php echo $_SESSION['mensaje']; ?><i class="icon-cross messagge__icon"></i></div> <?php
    unset($_SESSION['mensaje']);
    unset($_SESSION['error']);
}else if(isset($_SESSION['mensaje']) && isset($_SESSION['error']) && $_SESSION['error'] == 1){
    ?> <div class="messagge messagge__error"><?php echo $_SESSION['mensaje']; ?><i class="icon-cross messagge__icon"></i></div> <?php
    unset($_SESSION['mensaje']);
    unset($_SESSION['error']);
}else if(isset($_SESSION['mensaje']) && isset($_SESSION['error']) && $_SESSION['error'] == 3){
    ?> <div class="messagge messagge__info"><?php echo $_SESSION['mensaje']; ?><i class="icon-cross messagge__icon"></i></div> <?php
    unset($_SESSION['mensaje']);
    unset($_SESSION['error']);
}
?>