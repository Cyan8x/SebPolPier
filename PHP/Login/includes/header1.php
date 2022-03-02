<header class="header">
    <div class="nomEmpresa  nav1">
        <a class="sebpolpier" href="index.php">
            <img src="../imagenes/SebPolPier.jpg" alt="">
        </a>
        <?php
        require_once("Login/includes/connection.php");
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_SESSION['session_usuario'])) {
        ?>
            <div class="Bienvenido">
                <div class="Bienvenido_div">
                    <a href="carrito.php">
                        <div class="icon">
                            <i class="fas fa-shopping-cart"></i>
                            <span>
                                <?php
                                if (isset($_SESSION['carrito'])) {
                                    echo count($_SESSION['carrito']);
                                } else {
                                    echo 0;
                                }
                                ?>
                            </span>
                        </div>
                    </a>
                </div>
                <h2>¡¡¡Bienvenido, <span class="user"><?php echo $_SESSION['session_usuario']; ?></span>¡¡¡ <a class="cerrarSesion" href="Login/register_login/logout.php">Cerrar Sesión</a></h2>
            <?php
        } else { ?>
                <div class="login">
                    <a href="Login/register_login/index.html">Inicia Sesión</a>
                </div>
            <?php
        }
            ?>
            </div>
    </div>
    <!-- Menu responsive -->
    <nav class="nav">
        <ul class="nav__ul">
            <li class="nav__li">
                <a href="Nosotros.php"><i class="fas fa-users"></i>Nosotros</a>
            </li>
            <li class="nav__li product  products">
                <a href="#"><i class="fab fa-accusoft"></i>Productos</a>
                <ul class="submenu  subnav">
                    <li class="submenu_li"><a href="Tarjetas Graficas.php">Tarjetas Gráficas</a></li>
                    <li class="submenu_li"><a href="Procesadores.php">Procesadores</a></li>
                    <li class="submenu_li"><a href="Placas Madres.php">Placas Madres</a></li>
                </ul>
            </li>
        </ul>
        <div class="nav__responsive-button-container  ham">
            <div class="nav__responsive-button  fas fa-bars"></div>
        </div>





        <!-- <ul class="nav__responsive-ul">
            <div class="nav__responsive-button-container">
                <div class="nav__responsive-button  fas fa-bars"></div>
            </div>
            <div class="nav__li-container">
                <li class="nav__responsive-li"><a href="Nosotros.php"><i class="fas fa-users"></i>Nosotros</a></li>
                <li class="nav__responsive-li product"><a href="#"><i class="fab fa-accusoft"></i>Productos</a>
                    <ul class="submenu">
                        <li class="submenu_li"><a href="Tarjetas Graficas.php">Tarjetas Gráficas</a></li>
                        <li class="submenu_li"><a href="Procesadores.php">Procesadores</a></li>
                        <li class="submenu_li"><a href="Placas Madres.php">Placas Madres</a></li>
                    </ul>
                </li>
            </div>
        </ul> -->
    </nav>
</header>