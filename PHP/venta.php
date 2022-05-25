<?php
session_start();
if (!isset($_SESSION['carrito'])) {
    header('Location: ./index.php');
}
$arreglo = $_SESSION['carrito'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("includes/metadatos.php")
    ?>
    <!-- Personal -->
    <link rel="stylesheet" href="../CSS/venta6.css">
    <title>Venta</title>
</head>
<!-- ESTRUCTURA DE LA MUESTRA DE INFORMACION DEL CLIENTE Y DE LOS PRODUCTOS DENTRO DEL CARRITO DE COMPRAS DEL USUSARIO -->

<body>
    <?php
    include("includes/header1.php")
    ?>
    <div class="main">
        <div class="error-div">
            <?php
            if (isset($_GET["error"])) {
                $error = ($_GET['error']);
                echo "<span class='error'>$error</span>";
            }
            ?>
        </div>
        <div class="formulario_lisproducts">
            <div class="formulario">
                <form action="gracias.php" id="formPago" method="POST">
                    <?php
                    $email = $_SESSION['email'];
                    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
                    foreach ($connection->query($sql) as $result) {
                    ?>
                        <div class="camposform">
                            <h1 class="titulo">Datos Personales</h1>


                            <hr>
                            <div class="input">
                                <h3>Correo electrónico:</h3>
                                <input type="email" name="email" value="<?php echo $result['email'] ?>" readonly>
                            </div>
                            <div class="input">
                                <h3>Nombres:</h3>
                                <input type="text" name="nombres" value="<?php echo $result['nombres'] ?>" readonly>
                            </div>
                            <div class="input">
                                <h3>Apellidos:</h3>
                                <input type="text" name="apellidos" value="<?php echo $result['apellidos'] ?>" readonly>
                            </div>
                            <div class="input">
                                <h3>DNI:</h3>
                                <input type="number" name="dni">
                            </div>
                            <div class="input">
                                <h3>Número de contacto (Celular):</h3>
                                <input type="number" name="telefono">
                            </div>
                        </div>
                        <div class="camposform">
                            <h1 class="titulo">Metodo de envio</h1>
                            <hr>
                            <p>El unico metodo que contamos es Delivery, introduzca los siguientes datos para prodecer con la compra.</p>
                            <div class="input">
                                <h3>Dirección domiciliaria:</h3>
                                <input type="text" name="direccion" id="direccion">
                            </div>
                            <div class="input">
                                <h3>Ciudad:</h3>
                                <input type="text" name="ciudad" id="ciudad">
                            </div>
                        </div>

                        <div class="camposform">
                            <h1 class="titulo">Metodo de Pago</h1>
                            <hr>
                            <div class="select-tarjeta">
                                <h3>Emisor de la tarjeta:</h3>
                                <div class="select">
                                    <div>
                                        <input type="radio" id="visa" name="tarjeta" value="huey">
                                        <label for="visa"><i class="fab fa-cc-visa"></i></label>
                                    </div>
                                    <div>
                                        <input type="radio" id="mastercad" name="tarjeta" value="huey">
                                        <label for="mastercad"><i class="fab fa-cc-mastercard"></i></label>
                                    </div>
                                    <div>
                                        <input type="radio" id="amex" name="tarjeta" value="huey">
                                        <label for="amex"><i class="fab fa-cc-amex"></i></label>
                                    </div>
                                </div>
                            </div>
                            <div class="input">
                                <h3>Numero de Tarjeta:</h3>
                                <input type="number" name="numeroTarjeta">
                            </div>
                            <div class="input">
                                <h3>Fecha de caducidad:</h3>
                                <input type="month" min="2022-06" name="fechaCaducidad">
                            </div>
                            <div class="input">
                                <h3>Titular de tarjeta:</h3>
                                <input type="text" name="titularTarjeta">
                            </div>
                            <div class="input">
                                <h3>CVV:</h3>
                                <input type="number" name="cvv">
                            </div>
                        </div>

                        <div class="venta-div">
                            <button class="submit" type="submit">Pagar</button>
                        </div>
                    <?php
                    }
                    ?>
                </form>
            </div>
            <div class="lisproducts">
                <div>
                    <div>
                        <h1 class="titulo">Lista de Productos</h1>
                        <hr>
                    </div>
                    <?php
                    $total = 0;
                    for ($i = 0; $i < count($arreglo); $i++) {
                        $total = $total + ($arreglo[$i]['Precio'] * $arreglo[$i]['Cantidad']);
                    }
                    ?>
                    <div class="total">
                        <h2>Total: <span><?php echo "$" . number_format($total, 2, '.', ',') ?></span></h2>
                    </div>
                    <div class="productos">
                        <h3>Productos </h3>
                        <i class="arrow-down fas fa-angle-down" aria-hidden="true"></i>
                        <i class="arrow-up fas fa-angle-up" aria-hidden="true"></i>
                    </div>
                    <div class="lista">
                        <?php
                        $total = 0;
                        for ($i = 0; $i < count($arreglo); $i++) {
                            $total = $total + ($arreglo[$i]['Precio'] * $arreglo[$i]['Cantidad']);
                        ?>
                            <div class="listProducts">
                                <div class="img">
                                    <img src="./../imagenes/<?php echo $arreglo[$i]['Imagen']; ?>" alt="">
                                </div>
                                <div class="datos">
                                    <div>
                                        <p><?php echo $arreglo[$i]['Nombre']; ?></p>
                                    </div>
                                    <div>
                                        <h3><span>Cantidad: </span><?php echo $arreglo[$i]['Cantidad']; ?></h3>
                                    </div>
                                    <div>
                                        <h3><span>Subtotal: </span><?php echo "$" . number_format($arreglo[$i]['Precio'] * $arreglo[$i]['Cantidad'], 2, '.', ',') ?></h3>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php
    include("includes/footer.php")
    ?>

    <script src="./../js/venta3.js"></script>
</body>

</html>