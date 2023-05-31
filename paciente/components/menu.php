<header>
    <a href="index.php" class="title">
        <h1>Paciente</h1>
    </a>
    
    <nav>
        <ul class="list__menu">
            <li class="item__menu">
                <a href="index.php">
                    <div class="border__nav-header"></div>Historial de Citas<i class="icon-paste"></i>
                </a>
            </li>
            <li class="item__menu">
                <a href="#">
                    <div class="border__nav-header"></div>Solicitar Cita<i class="icon-address-book"></i>
                </a>
            </li>
            <li class="item__menu">
                <a href="#">
                    <div class="border__nav-header"></div>@<?php echo $_SESSION['usuario']; ?><i class="icon-folder"></i>
                </a>
            </li>
        </ul>
    </nav>

    <div class="buttons">
        <a href="../client/cerrarSesion.php"><button class="login">Cerrar Sesión</button></a>
    </div>
</header>