<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("includes/metadatos.php")
    ?>
    <!-- Personal -->
    <link rel="stylesheet" href="../CSS/Procesadores2.css">
    <title>Procesadores</title>
</head>

<body>
    <?php
    include("includes/header1.php")
    ?>
    <div class="main">
        <div class="title">
            <h1>PROCESADORES</h1>
        </div>
        <div class="tarjetas">
            <?php
            $sql = 'SELECT * FROM productos WHERE cod_categoria = \'C002PR\' AND stock > 0';
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
</body>

</html>