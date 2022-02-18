<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/base.css">
    <link rel="stylesheet" href="../CSS/index12.css">
    <link rel="stylesheet" href="../CSS/normalize.css">
    <link rel="shortcut icon" href="../imagenes/S.jpg">
    <script src="https://kit.fontawesome.com/4c62087cc0.js" crossorigin="anonymous"></script>
    <title>SebPolPier</title>
</head>

<body>
    <header class="header">
        <div class="nomEmpresa">
            <div class="nomEmpresa_div">
                <div class="marca">
                    <a href="index.php"><img src="../imagenes/SebPolPier.jpg" alt=""></a>
                </div>
                <?php
                require_once("Login/includes/connection.php");
                session_start();
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
        </div>
        <!-- Menu responsive -->
        <nav class="nav">
            <ul class="nav__ul">
                <div>
                    <li class="nav__li pad0"><a href="#marcas"><i class="fas fa-trademark"></i>Marcas</a></li>
                    <li class="nav__li"><a href="#ultimaTendencia"><i class="fas fa-microchip"></i>Ultima Tendencia</a></li>
                    <li class="nav__li"><a href="Nosotros.php"><i class="fas fa-users"></i>Nosotros</a></li>
                    <li class="nav__li product"><a href="#"><i class="fab fa-accusoft"></i>Productos</a>
                        <ul class="submenu">
                            <li class="submenu_li"><a href="Tarjetas Graficas.php">Tarjetas Gráficas</a></li>
                            <li class="submenu_li"><a href="Procesadores.php">Procesadores</a></li>
                            <li class="submenu_li"><a href="Placas Madres.php">Placas Madres</a></li>
                        </ul>
                    </li>
                </div>
            </ul>
            <ul class="nav__responsive-ul">
                <div class="nav__responsive-button-container">
                    <div class="nav__responsive-button  fas fa-bars"></div>
                </div>
                <div class="nav__li-container">
                    <li class="nav__responsive-li"><a href="#marcas"><i class="fas fa-trademark"></i>Marcas</a></li>
                    <li class="nav__responsive-li"><a href="#ultimaTendencia"><i class="fas fa-microchip"></i>Ultima Tendencia</a></li>
                    <li class="nav__responsive-li"><a href="Nosotros.php"><i class="fas fa-users"></i>Nosotros</a></li>
                    <li class="nav__responsive-li product"><a href="#"><i class="fab fa-accusoft"></i>Productos</a>
                        <ul class="submenu">
                            <li class="submenu_li"><a href="Tarjetas Graficas.php">Tarjetas Gráficas</a></li>
                            <li class="submenu_li"><a href="Procesadores.php">Procesadores</a></li>
                            <li class="submenu_li"><a href="Placas Madres.php">Placas Madres</a></li>
                        </ul>
                    </li>
                </div>
            </ul>
        </nav>
    </header>
    <div class="sub_nav">
        <div class="sub_nav_div">
            <p>BUSCAR VENTAS</p>
        </div>
    </div>
    <div class="title">
        <div class="tittle_div">
            <div>
                <h1 class="tittle_h1">TARJETAS GRÁFICAS, PROCESADORES Y PLACAS MADRES</h1>
            </div>
        </div>
    </div>
    <div class="nav_productos">
        <ul class="nav_productos_ul">
            <li class="nav__li"><a href="Tarjetas Graficas.php">Tarjetas Graficas</a></li>
            <li class="nav__li"><a href="Procesadores.php">Procesadores</a></li>
            <li class="nav__li"><a href="Placas Madres.php">Placas Madres</a></li>
        </ul>
    </div>
    <div class="subtitle">
        <div class="subtittle_div">
            <div>
                <h3>DISFRUTA DE NUESTRAS OFERTAS</h3>
            </div>
        </div>
    </div>
    <div class="img_principal">
        <div>
            <img src="../imagenes/procesador.png" alt="">
        </div>
    </div>
    <div class="subtitle">
        <div class="subtittle_div">
            <div>
                <h3>Marcas</h3>
            </div>
        </div>
    </div>
    <div class="global_marcas" id="marcas">
        <div class="Marcas">
            <div class="Marcas_div">
                <img src="../imagenes/intel.jpg" alt="Intel">
            </div>
            <div class="Marcas_div">
                <img src="../imagenes/AMD1.jpg" alt="AMD">
            </div>
            <div class="Marcas_div">
                <img src="../imagenes/Nvidia.jpg" alt="Nvidia">
            </div>
            <div class="Marcas_div">
                <img src="../imagenes/Aorus1.jpg" alt="AORUS">
            </div>
            <div class="Marcas_div">
                <img src="../imagenes/Asus.jpg" alt="Asus">
            </div>
            <div class="Marcas_div">
                <img src="../imagenes/Gygabyte.jpg" alt="Gigabyte">
            </div>
            <div class="Marcas_div">
                <img src="../imagenes/MSI.jpg" alt="MSI">
            </div>
        </div>
    </div>
    <div class="subtitle">
        <div class="subtittle_div">
            <div>
                <h3>Ultima Tendencia</h3>
            </div>
        </div>
    </div>
    <?php
    include("Login/includes/connection.php");
    ?>
    <div id="ultimaTendencia">
        <div class="tarjetas">
            <?php
            $sql = 'SELECT * FROM productos WHERE cod_producto = \'TG2021GIG001\' OR cod_producto = \'PR2021INT004\' OR cod_producto = \'PM2021ASR001\'';
            foreach ($connection->query($sql) as $result) {
            ?>
                <div class="tarjetas_div">
                    <div class="tarjetas_img">
                        <a href="Det_producto.php?cod_producto=<?php echo $result['cod_producto']; ?>">
                            <?php
                            echo "<img class= \"a_img\" src=\"../imagenes/" . $result['imagen'] . "\" alt=\"" . $result['nombre'] . "\">";
                            ?>
                        </a>
                    </div>
                    <div class="tarjetas_nomPrecio">
                        <?php
                        echo "<a href=\"Det_producto.php?cod_producto=" . $result['cod_producto'] . "\"><h2>" . $result['nombre'] . "</h2></a>
                            <p>En stock: " . $result['stock'] . "</p>
                            <p>$" . number_format($result['precio_dolares'], 2, '.', ',') . " - S/" . number_format($result['precio_soles'], 2, '.', ',') . "</p>";
                        ?>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <?php
    include("Login/includes/footer.php")
    ?>
</body>

</html>