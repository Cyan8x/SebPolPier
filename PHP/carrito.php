<?php
//LLAMA A LA CONEXION CON LA BASE DE DATOS
include("Login/includes_login/connection.php");
//SE CREA UN SESSION_START PARA SABER SI YA SE INICIO UNA SESIÓN O NO
session_start();
//SE CREA UNA ESTRUCTURA CONDICIONAL
if (isset($_SESSION['session_usuario'])) {
    //SI EXISTE UNA SESSION INICIADA EN LA PAGINA WEB, SE HACE EL SIGUIENTE CODIGO
    if (isset($_SESSION['carrito'])) {
        //si existe EL ARREGLO CON EL NOMBRE CARRITO, buscamos si ya esta agregado ese producto
        if (isset($_GET['cod_producto'])) {
            $arreglo = $_SESSION['carrito'];
            $encontro = false;
            $numero = 0;
            for ($i = 0; $i < count($arreglo); $i++) {
                if ($arreglo[$i]['Cod_producto'] == $_GET['cod_producto']) {
                    $encontro = true;
                    $numero = $i;
                }
            }
            if ($encontro == true) {
                $arreglo[$numero]['Cantidad'] = $arreglo[$numero]['Cantidad'] + 1;
                $_SESSION['carrito'] = $arreglo;
                header("Location: ./carrito.php");
            } else {
                //si no estaba el registro, LO CREAMOS Y LO INTRODUCIMOS DENTRO DEL ARREGLO CARRITO
                $cod_orig = '';
                $imagen = '';
                $nombre = '';
                $stock = '';
                $precio = '';
                $res = $connection->query("SELECT * FROM productos WHERE cod_producto=\"" . $_GET['cod_producto'] . "\"") or die($connection->error);
                $det_prod = $res->fetch(PDO::FETCH_BOTH);
                $cod_orig = $det_prod[4];
                $imagen = $det_prod[5];
                $nombre = $det_prod[6];
                $stock = $det_prod[7];
                $precio = $det_prod[8];
                $arregloNuevo = array(
                    'Cod_producto' => $_GET['cod_producto'],
                    'Cod_orig' => $cod_orig,
                    'Nombre' => $nombre,
                    'Imagen' => $imagen,
                    'Stock' => $stock,
                    'Precio' => $precio,
                    'Cantidad' => 1
                );
                array_push($arreglo, $arregloNuevo);
                $_SESSION['carrito'] = $arreglo;
                header("Location: ./carrito.php");
            }
        }
    } else {
        //SI NO EXISTE EL ARREGLO CARRITO, creamos la variable de session
        if (isset($_GET['cod_producto'])) {
            $cod_orig = '';
            $imagen = '';
            $nombre = '';
            $stock = '';
            $precio = '';
            $res = $connection->query("SELECT * FROM productos WHERE cod_producto=\"" . $_GET['cod_producto'] . "\"") or die($connection->error);
            $det_prod = $res->fetch(PDO::FETCH_BOTH);
            $cod_orig = $det_prod[4];
            $imagen = $det_prod[5];
            $nombre = $det_prod[6];
            $stock = $det_prod[7];
            $precio = $det_prod[8];
            $arreglo[] = array(
                'Cod_producto' => $_GET['cod_producto'],
                'Cod_orig' => $cod_orig,
                'Nombre' => $nombre,
                'Imagen' => $imagen,
                'Stock' => $stock,
                'Precio' => $precio,
                'Cantidad' => 1
            );
            $_SESSION['carrito'] = $arreglo;
            header("Location: ./carrito.php");
        }
    }
} else {
    //SI NO EXISTE UNA SESION INICIADA EN LA PAGINA WEB, LO REDIRECCIONAMOS AL SIGUIENTE LINK
    header("Location: ../../../SebPolPier/PHP/Login/register_login/index.html");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("includes/metadatos.php")
    ?>
    <!-- Personal -->
    <link rel="stylesheet" href="../CSS/carrito6.css">
    <title>Carrito</title>
</head>
<!-- ESTRUCTURA DEL CARRITO DE COMPRAS -->

<body>
    <?php
    include("includes/header1.php")
    ?>
    <div class="main">
        <div class="car-flex">
            <div class="car">
                <h2>Carrito de Compras</h2>
                <hr>
                <div class="car-item">
                    <ul>
                        <?php
                        $total = 0;
                        if (isset($_SESSION['carrito'])) {
                            $arregloCarrito = $_SESSION['carrito'];
                            for ($i = 0; $i < count($arregloCarrito); $i++) {
                                $total = $total + ($arregloCarrito[$i]['Precio'] * $arregloCarrito[$i]['Cantidad']);
                        ?>
                                <li>
                                    <div class="det-style product-img">
                                        <img src="../imagenes/<?php echo $arregloCarrito[$i]['Imagen']; ?>" alt="<?php echo $arregloCarrito[$i]['Nombre']; ?>">
                                    </div>
                                    <div class="det-style product-nomPrec">
                                        <a target='_blank' href="Det_producto.php?cod_producto=<?php echo $arregloCarrito[$i]['Cod_producto']; ?>"><?php echo $arregloCarrito[$i]['Nombre'] . " (" . $arregloCarrito[$i]['Cod_orig'] . ")"; ?></a>
                                        <p><?php echo "$" . number_format($arregloCarrito[$i]['Precio'], 2, '.', ',') ?></p>
                                    </div>
                                    <div class="det-style product-cant">
                                        <div>
                                            <button class="incrementar">+</button>
                                            <input class="cant" type="text" value="<?php echo $arregloCarrito[$i]['Cantidad']; ?>" data-stock="<?php echo $arregloCarrito[$i]['Stock']; ?>" data-id="<?php echo $arregloCarrito[$i]['Cod_producto']; ?>" data-precio="<?php echo $arregloCarrito[$i]['Precio']; ?>" readonly>
                                            <button class="reducir">-</button>
                                        </div>
                                    </div>
                                    <div class="det-style precioTotItem">
                                        <h3 class="cod_<?php echo $arregloCarrito[$i]['Cod_producto']; ?>">
                                            <?php echo "$" . number_format($arregloCarrito[$i]['Precio'] * $arregloCarrito[$i]['Cantidad'], 2, '.', ',') ?>
                                        </h3>
                                    </div>
                                    <div class="det-style eliminar">
                                        <a href="carrito.php" class="btnEliminar elim" data-id="<?php echo $arregloCarrito[$i]['Cod_producto']; ?>"><i class="fas fa-trash"></i></a>
                                    </div>
                                </li>
                        <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="total">
                <div class="total_articulos">
                    <h2>Articulos</h2>
                    <h2>
                        <span class="articulosTotal">
                            <?php
                            if (isset($_SESSION['carrito'])) {
                                echo count($_SESSION['carrito']);
                            } else {
                                echo 0;
                            }
                            ?>
                        </span>
                    </h2>
                </div>
                <hr>
                <div class="monto_final">
                    <h2 class="labe">Total</h2>
                    <h2 class="valor Fin"><?php echo "$" . number_format($total, 2, '.', ',') ?></h2>
                </div>
                <hr>
                <div class="venta-div">
                    <a href="venta.php">Proceder a pagar</a>
                </div>
            </div>
        </div>
    </div>
    <div class="seguir_compr">
        <a href="index.php">Seguir comprando</a>
    </div>
    <?php
    include("includes/footer.php")
    ?>
    <script src="./../js/carrito7.js"></script>
</body>

</html>