<?php
include("Login/includes/connection.php");
if (isset($_GET['cod_producto'])) {
    $resultado = $connection->query("SELECT * FROM productos WHERE cod_producto=\"" . $_GET['cod_producto'] . "\"") or die($connection->error);
    if ($resultado->rowCount() > 0) {
        $det_prod = $resultado->fetch(PDO::FETCH_BOTH);
    } else {
        header('Location: ../../SebPolPier/PHP/index.php');
    }
} else {
    header('Location: ../../SebPolPier/PHP/index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Base -->
    <link rel="stylesheet" href="../CSS/base10.css">
    <!-- Personal -->
    <link rel="stylesheet" href="../CSS/Det_producto3.css">
    <!-- Normalize -->
    <link rel="stylesheet" href="../CSS/normalize.css">
    <!-- Icon -->
    <link rel="shortcut icon" href="../imagenes/S.jpg">
    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/4c62087cc0.js" crossorigin="anonymous"></script>
    <title>Producto</title>
</head>

<body>
    <?php
    include("Login/includes/header1.php")
    ?>
    <div class="main">
        <div class="info_product">
            <div class="img_product">
                <img src="../imagenes/<?php echo $det_prod[5]; ?>" alt="<?php echo $det_prod[6]; ?>">
            </div>
            <div class="det_producto">
                <div>
                    <h2><?php echo $det_prod[6] . " (" . $det_prod[4] . ")"; ?></h2>
                    <div>
                        <p class="p1"><?php echo "Precio: $" . number_format($det_prod[8], 2, '.', ',') . " - S/" . number_format($det_prod[9], 2, '.', ','); ?></p>
                        <p class="p2">En stock: <?php echo $det_prod[7]; ?> articulos</p>
                        <div class="submit">
                            <div>
                                <a href="carrito.php?cod_producto=<?php echo $det_prod[0]; ?>">AÑADIR AL CARRITO DE COMPRAS</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    include("Login/includes/footer.php")
    ?>
</body>

</html>