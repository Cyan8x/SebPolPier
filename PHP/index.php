<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("includes/metadatos.php")
    ?>
    <!-- Personal -->
    <link rel="stylesheet" href="../CSS/index2.css">
    <title>SebPolPier</title>
</head>

<body>
    <?php
    include("includes/header1.php")
    ?>

    <div class="main">
        <div class="title">
            <h1>TARJETAS GRÁFICAS, PROCESADORES Y PLACAS MADRES</h1>
        </div>
        <div class="nav_productos">
            <ul>
                <li><a href="Tarjetas Graficas.php">Tarjetas Graficas</a></li>
                <li><a href="Procesadores.php">Procesadores</a></li>
                <li><a href="Placas Madres.php">Placas Madres</a></li>
            </ul>
        </div>
        <div class="subtitle">
            <h3>Marcas</h3>
        </div>
        <div class="global-marcas">
            <div class="glide">
                <div class="glide__track" data-glide-el="track">
                    <ul class="glide__slides">
                        <li class="glide__slide">
                            <div>
                                <img src="../imagenes/intel.jpg" alt="Intel">
                            </div>
                        </li>
                        <li class="glide__slide">
                            <div>
                                <img src="../imagenes/AMD1.jpg" alt="AMD">
                            </div>
                        </li>
                        <li class="glide__slide">
                            <div>
                                <img src="../imagenes/Nvidia.jpg" alt="Nvidia">
                            </div>
                        </li>
                        <li class="glide__slide">
                            <div>
                                <img src="../imagenes/Aorus1.jpg" alt="AORUS">
                            </div>
                        </li>
                        <li class="glide__slide">
                            <div>
                                <img src="../imagenes/Asus.jpg" alt="Asus">
                            </div>
                        </li>
                        <li class="glide__slide">
                            <div>
                                <img src="../imagenes/Gygabyte.jpg" alt="Gigabyte">
                            </div>
                        </li>
                        <li class="glide__slide">
                            <div>
                                <img src="../imagenes/MSI.jpg" alt="MSI">
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="glide__arrows" data-glide-el="controls">
                    <button style="
                transform: scaleX(1);" class="glide__arrow glide__arrow--left" data-glide-dir="<"></button>
                    <button style="
                transform: scaleX(-1);" class="glide__arrow glide__arrow--right" data-glide-dir=">"></button>
                </div>
            </div>
        </div>
        <div class="subtitle">
            <h3>Ultima Tendencia</h3>
        </div>
        <div class="tarjetas">
            <?php
            $sql = 'SELECT * FROM productos WHERE cod_producto = \'TG2021GIG001\' OR cod_producto = \'PR2021INT004\' OR cod_producto = \'PM2021ASR001\'';
            foreach ($connection->query($sql) as $result) {
            ?>
                <div class="tarjetas_div">
                    <div class="tarjetas_img">
                        <a target='_blank' href="Det_producto.php?cod_producto=<?php echo $result['cod_producto']; ?>">
                            <?php
                            echo "<img src=\"../imagenes/" . $result['imagen'] . "\" alt=\"" . $result['nombre'] . "\">";
                            ?>
                        </a>
                    </div>
                    <div class="tarjetas_nomPrecio">
                        <?php
                        echo "<a target='_blank' href=\"Det_producto.php?cod_producto=" . $result['cod_producto'] . "\"><h2>" . $result['nombre'] . "</h2></a>
                            <p>En stock: " . $result['stock'] . "</p>
                            <p style='color: rgb(13, 128, 13);'>Precio: $" . number_format($result['precio'], 2, '.', ',');
                        ?>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>

    <?php
    include("includes/footer.php")
    ?>
    <!-- Glide JS -->
    <script src="https://cdn.jsdelivr.net/npm/@glidejs/glide"></script>
    <script>
        const config = {
            type: 'carousel',
            perView: 4,
            autoplay: 2000,
            breakpoints: {
                900: {
                    perView: 2
                },
                600: {
                    perView: 1
                }
            }
        }
        new Glide('.glide', config).mount()
    </script>
    <!-- JS Personal -->
    <script src="./../js/api2.js"></script>
</body>

</html>