<header>
    <div class="nav1">
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
            <div class="user">
                <h3>
                    <span><?php echo $_SESSION['session_usuario']; ?></span>
                    <span class="down"><i class="fas fa-angle-down"></i></span>
                    <span class="up"><i class="fas fa-angle-up"></i></span>
                    <ul>
                        <li>
                            <a href="carrito.php">
                                Carrito de compras
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
                            </a>
                        </li>
                        <li>
                            <a class="cerrarSesion" href="Login/register_login/logout.php">Cerrar Sesión</a>
                        </li>
                    </ul>
                </h3>
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
    <div>
        <nav class="nav2">
            <ul>
                <li>
                    <a href="Nosotros.php"><i class="fas fa-users"></i>Nosotros</a>
                </li>
                <li class="products">
                    <div>
                        <i class="fab fa-accusoft"></i>
                        Productos
                        <span class="down Da"><i class="fas fa-angle-down"></i></span>
                        <span class="up Ua"><i class="fas fa-angle-up"></i></span>
                    </div>
                    <ul class="subnav">
                        <li><a href="Tarjetas Graficas.php">Tarjetas Gráficas</a></li>
                        <li><a href="Procesadores.php">Procesadores</a></li>
                        <li><a href="Placas Madres.php">Placas Madres</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div class="ham">
            <div class="fas fa-bars"></div>
        </div>
    </div>
</header>