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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/base.css">
    <link rel="stylesheet" href="../CSS/venta.css">
    <link rel="stylesheet" href="../CSS/normalize.css">
    <link rel="shortcut icon" href="../imagenes/S.jpg">
    <script src="https://kit.fontawesome.com/4c62087cc0.js" crossorigin="anonymous"></script>
    <title>Venta</title>
</head>
<!-- ESTRUCTURA DE LA MUESTRA DE INFORMACION DEL CLIENTE Y DE LOS PRODUCTOS DENTRO DEL CARRITO DE COMPRAS DEL USUSARIO -->
<body>
    <?php
    include("Login/includes/header.php")
    ?>
    <?php
    include("Login/includes/connection.php");
    ?>
    <div class="formulario_lisproducts">
        <div class="formulario">
            <?php
            $session_user = $_SESSION['session_usuario'];
            $sql = "SELECT * FROM usuarios WHERE usuario = '$session_user'";
            foreach ($connection->query($sql) as $result) {
            ?>
                <form action="gracias.php" method="POST">
                    <div>
                        <h1>DATOS PERSONALES</h1>
                    </div>
                    <div>
                        <h3>Usuario</h3>
                        <input type="text" name="usuario" value="<?php echo $result['usuario'] ?>" readonly>
                    </div>
                    <div>
                        <h3>Correo electrónico</h3>
                        <input type="email" name="email" value="<?php echo $result['email'] ?>" readonly>
                    </div>
                    <div>
                        <h3>Nombres</h3>
                        <input type="text" name="nombres" value="<?php echo $result['nombres'] ?>" readonly>
                    </div>
                    <div>
                        <h3>Apellidos</h3>
                        <input type="text" name="apellidos" value="<?php echo $result['apellidos'] ?>" readonly>
                    </div>
                    <div>
                        <h3>DNI</h3>
                        <input type="text" name="dni" value="<?php echo $result['dni'] ?>" readonly>
                    </div>
                    <div>
                        <h3>Número de contacto</h3>
                        <input type="text" name="telefono" value="<?php echo $result['telefono'] ?>" readonly>
                    </div>
                    <div>
                        <h1>DATOS DEL LUGAR DE DESTINO</h1>
                    </div>
                    <div>
                        <h3>Dirección domiciliaria</h3>
                        <input type="text" name="direccion" value="<?php echo $result['direccion'] ?>" readonly>
                    </div>
                    <div>
                        <button type="button" id="direcN" class="direcN">Agregar dirección como nuevo lugar de destino</button>
                    </div>
                    <div>
                        <h3>Ciudad</h3>
                        <input type="text" name="ciudad" value="<?php echo $result['ciudad'] ?>" readonly>
                    </div>
                    <div>
                        <button type="button" id="ciudadN" class="ciudadN">Agregar nueva ciudad como lugar de destino</button>
                    </div>
                </form>
            <?php
            }
            ?>
        </div>
        <div class="lisproducts">
            <div>
                <div>
                    <h1>LISTA DE PRODUCTOS</h1>
                </div>
                <?php
                $totalD = 0;
                $totalS = 0;
                for ($i = 0; $i < count($arreglo); $i++) {
                    $totalD = $totalD + ($arreglo[$i]['Precio_dolares'] * $arreglo[$i]['Cantidad']);
                    $totalS = $totalS + ($arreglo[$i]['Precio_soles'] * $arreglo[$i]['Cantidad']);
                ?>
                    <div class="lisproducts_div">
                        <h3>Nombre: <?php echo $arreglo[$i]['Nombre']; ?></h3>
                        <h3>Cantidad: <?php echo $arreglo[$i]['Cantidad']; ?></h3>
                        <h3>Precio subtotal: <?php echo "$" . number_format($arreglo[$i]['Precio_dolares'] * $arreglo[$i]['Cantidad'], 2, '.', ',') . " - S/" . number_format($arreglo[$i]['Precio_soles'] * $arreglo[$i]['Cantidad'], 2, '.', ','); ?></h3>
                    </div>
                <?php
                }
                ?>
                <div>
                    <h2>Total: <?php echo "$" . number_format($totalD, 2, '.', ',') . " - S/" . number_format($totalS, 2, '.', ',') ?></h2>
                </div>
                <div class="link_pago">
                    <a href="gracias.php">PAGAR POR LOS PRODUCTOS</a>
                </div>
            </div>
        </div>
    </div>
    <div class="siesta">

    </div>
    <?php
    include("Login/includes/footer.php")
    ?>
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/jquery-ui.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/owl.carousel.min.js"></script>
    <script src="../js/jquery.magnific-popup.min.js"></script>
    <script src="../js/aos.js"></script>
    <script src="../js/mainx.js"></script>
    <script>
        $(document).ready(function() {
            $(".direcN").click(function() {
                $(this).after('<div><h3>Dirección del nuevo destino</h3><input name="direccionopc" type="text" id="direcN"/><button type="button" class="deleDirecN">Deshacer opción</button></div>');
                document.getElementById('direcN').disabled = true;
            });
            $(document).on('click', '.deleDirecN', function() {
                $(this).parent().remove();
                document.getElementById('direcN').disabled = false;
            });
            $(".ciudadN").click(function() {
                $(this).after('<div><h3>Ciudad del nuevo destino</h3><input type="text" name="ciudadopc" id="ciudadN"/><button type="button" class="deleCiudadN">Deshacer opción</button></div>');
                document.getElementById('ciudadN').disabled = true;
            });
            $(document).on('click', '.deleCiudadN', function() {
                $(this).parent().remove();
                document.getElementById('ciudadN').disabled = false;
            });
        });
    </script>
</body>

</html>