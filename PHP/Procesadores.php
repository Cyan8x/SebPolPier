<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/base.css">
    <link rel="stylesheet" href="../CSS/Procesadores.css">
    <link rel="stylesheet" href="../CSS/normalize.css">
    <link rel="shortcut icon" href="../imagenes/S.jpg">
    <script src="https://kit.fontawesome.com/4c62087cc0.js" crossorigin="anonymous"></script>
    <title>Procesadores</title>
</head>

<body>
    <?php
    include("Login/includes/header.php")
    ?>
    <div class="title">
        <div class="tittle_div">
            <div>
                <h1 class="titulo">PROCESADORES</h1>
            </div>
        </div>
    </div>
    <?php
    include("Login/includes/connection.php");
    ?>
    <div>
        <div class="tarjetas">
            <?php
            $sql = 'SELECT * FROM productos WHERE cod_categoria = \'C002PR\' AND stock > 0';
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