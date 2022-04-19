<?php
include("Login/includes_login/connection.php");
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
<?php
    include("includes/metadatos.php")
    ?>
    <!-- Personal -->
    <link rel="stylesheet" href="../CSS/Det_producto4.css">
    <title>Producto</title>
</head>

<body>
    <?php
    include("includes/header1.php")
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
                        <p class="p1"><?php echo "Precio: $" . number_format($det_prod[8], 2, '.', ',')?></p>
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
    include("includes/footer.php")
    ?>
</body>

</html>