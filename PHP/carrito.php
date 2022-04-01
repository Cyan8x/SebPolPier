<?php
//LLAMA A LA CONEXION CON LA BASE DE DATOS
include("Login/includes/connection.php");
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
                $precio_dolares = '';
                $precio_soles = '';
                $res = $connection->query("SELECT * FROM productos WHERE cod_producto=\"" . $_GET['cod_producto'] . "\"") or die($connection->error);
                $det_prod = $res->fetch(PDO::FETCH_BOTH);
                $cod_orig = $det_prod[4];
                $imagen = $det_prod[5];
                $nombre = $det_prod[6];
                $stock = $det_prod[7];
                $precio_dolares = $det_prod[8];
                $precio_soles = $det_prod[9];
                $arregloNuevo = array(
                    'Cod_producto' => $_GET['cod_producto'],
                    'Cod_orig' => $cod_orig,
                    'Nombre' => $nombre,
                    'Imagen' => $imagen,
                    'Stock' => $stock,
                    'Precio_dolares' => $precio_dolares,
                    'Precio_soles' => $precio_soles,
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
            $precio_dolares = '';
            $precio_soles = '';
            $res = $connection->query("SELECT * FROM productos WHERE cod_producto=\"" . $_GET['cod_producto'] . "\"") or die($connection->error);
            $det_prod = $res->fetch(PDO::FETCH_BOTH);
            $cod_orig = $det_prod[4];
            $imagen = $det_prod[5];
            $nombre = $det_prod[6];
            $stock = $det_prod[7];
            $precio_dolares = $det_prod[8];
            $precio_soles = $det_prod[9];
            $arreglo[] = array(
                'Cod_producto' => $_GET['cod_producto'],
                'Cod_orig' => $cod_orig,
                'Nombre' => $nombre,
                'Imagen' => $imagen,
                'Stock' => $stock,
                'Precio_dolares' => $precio_dolares,
                'Precio_soles' => $precio_soles,
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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Base -->
    <link rel="stylesheet" href="../CSS/base10.css">
    <!-- Personal -->
    <link rel="stylesheet" href="../CSS/carrito3.css">
    <!-- Normalize -->
    <link rel="stylesheet" href="../CSS/normalize.css">
    <!-- Icon -->
    <link rel="shortcut icon" href="../imagenes/S.jpg">
    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/4c62087cc0.js" crossorigin="anonymous"></script>
    <title>Carrito</title>
</head>
<!-- ESTRUCTURA DEL CARRITO DE COMPRAS -->

<body>
    <?php
    include("Login/includes/header1.php")
    ?>
    <div class="main">
        <div class="car-flex">
            <div class="car">
                <h2>Carrito de Compras</h2>
                <hr>
                <div class="car-item">
                    <ul>
                        <?php
                        $totalD = 0;
                        $totalS = 0;
                        if (isset($_SESSION['carrito'])) {
                            $arregloCarrito = $_SESSION['carrito'];
                            for ($i = 0; $i < count($arregloCarrito); $i++) {
                                $totalD = $totalD + ($arregloCarrito[$i]['Precio_dolares'] * $arregloCarrito[$i]['Cantidad']);
                                $totalS = $totalS + ($arregloCarrito[$i]['Precio_soles'] * $arregloCarrito[$i]['Cantidad']);
                        ?>
                                <li>
                                    <div>
                                        <img class="img_prod-div-img" src="../imagenes/<?php echo $arregloCarrito[$i]['Imagen']; ?>" alt="<?php echo $arregloCarrito[$i]['Nombre']; ?>">
                                    </div>
                                    <div>
                                        <a href="Det_producto.php?cod_producto=<?php echo $arregloCarrito[$i]['Cod_producto']; ?>"><?php echo $arregloCarrito[$i]['Nombre'] . " (" . $arregloCarrito[$i]['Cod_orig'] . ")"; ?></a>
                                        <p><?php echo "$" . number_format($arregloCarrito[$i]['Precio_dolares'], 2, '.', ',') . " - S/" . number_format($arregloCarrito[$i]['Precio_soles'], 2, '.', ','); ?></p>
                                    </div>
                                    <div>
                                        <button class="incrementar">+</button>
                                        <input class="cant" type="text" value="<?php echo $arregloCarrito[$i]['Cantidad']; ?>" data-stock="<?php echo $arregloCarrito[$i]['Stock']; ?>" data-id="<?php echo $arregloCarrito[$i]['Cod_producto']; ?>" data-preciod="<?php echo $arregloCarrito[$i]['Precio_dolares']; ?>" data-precios="<?php echo $arregloCarrito[$i]['Precio_soles']; ?>" readonly>
                                        <button class="reducir">-</button>
                                    </div>
                                    <div>
                                        <h3 class="cod_<?php echo $arregloCarrito[$i]['Cod_producto']; ?>">
                                            <?php echo "$" . number_format($arregloCarrito[$i]['Precio_dolares'] * $arregloCarrito[$i]['Cantidad'], 2, '.', ',') . " - S/" . number_format($arregloCarrito[$i]['Precio_soles'] * $arregloCarrito[$i]['Cantidad'], 2, '.', ','); ?>
                                        </h3>
                                    </div>
                                    <div>
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
                <div>
                    <h2 ><span class="articulosTotal"><?php
                                                if (isset($_SESSION['carrito'])) {
                                                    echo count($_SESSION['carrito']);
                                                } else {
                                                    echo 0;
                                                }
                                                ?></span> articulos</h2>
                    <h2 class="precioArticulos Fin"><?php echo "$" . number_format($totalD, 2, '.', ',') . " - S/" . number_format($totalS, 2, '.', ',') ?></h2>
                </div>
                <div>
                    <h2 class="labe">Total</h2>
                    <h2 class="valor Fin"><?php echo "$" . number_format($totalD, 2, '.', ',') . " - S/" . number_format($totalS, 2, '.', ',') ?></h2>
                </div>
                <div class="venta-div">
                    <a href="venta.php">Proceder a pagar</a>
                </div>
            </div>
        </div>
        <!-- <div class="row">
            <div class="carrito_Total-div">
                <div class="carrito_Total-div-div">
                    <div class="row carrito_compra ">
                        <div class="det_producto carrito_compra-comtenido">
                            <div class="carrito_compra-comtenido-div">
                                <div class="titulo">
                                    <h1>Carrito de Compra</h1>
                                </div>
                                <hr class="separador">
                                <div class="carrito">
                                    <ul class="carrito_lista">
                                        <?php
                                        $totalD = 0;
                                        $totalS = 0;
                                        if (isset($_SESSION['carrito'])) {
                                            $arregloCarrito = $_SESSION['carrito'];
                                            for ($i = 0; $i < count($arregloCarrito); $i++) {
                                                $totalD = $totalD + ($arregloCarrito[$i]['Precio_dolares'] * $arregloCarrito[$i]['Cantidad']);
                                                $totalS = $totalS + ($arregloCarrito[$i]['Precio_soles'] * $arregloCarrito[$i]['Cantidad']);
                                        ?>
                                                <li class="lista_elemento">
                                                    <div class="lista_elemento-div">
                                                        <div class="det_producto imagen_producto">
                                                            <span>
                                                                <img class="img_prod-div-img" src="../imagenes/<?php echo $arregloCarrito[$i]['Imagen']; ?>" alt="<?php echo $arregloCarrito[$i]['Nombre']; ?>">
                                                            </span>
                                                        </div>
                                                        <div class="det_producto nom_precio ">
                                                            <div class="nom_producto">
                                                                <a href="Det_producto.php?cod_producto=<?php echo $arregloCarrito[$i]['Cod_producto']; ?>"><?php echo $arregloCarrito[$i]['Nombre'] . " (" . $arregloCarrito[$i]['Cod_orig'] . ")"; ?></a>
                                                            </div>
                                                            <div class="precio_producto">
                                                                <div>
                                                                    <span class="precio_producto-h5">
                                                                        <?php echo "$" . number_format($arregloCarrito[$i]['Precio_dolares'], 2, '.', ',') . " - S/" . number_format($arregloCarrito[$i]['Precio_soles'], 2, '.', ','); ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="det_producto cantTotal_precioTotal">
                                                            <div class="row">
                                                                <div class="det_producto cantTotal_precioTotal-div">
                                                                    <div class="row">
                                                                        <div class="det_producto cantTotal">
                                                                            <div class="input-group cantTotal_div">
                                                                                <div class="boton_menos">
                                                                                    <button onclick="location.reload()" class="js-btn-minus btnIncrementar" type="button">&minus;</button>
                                                                                </div>
                                                                                <input type="text" class="form-control txtCantidad" data-id="<?php echo $arregloCarrito[$i]['Cod_producto']; ?>" data-preciod="<?php echo $arregloCarrito[$i]['Precio_dolares']; ?>" data-precios="<?php echo $arregloCarrito[$i]['Precio_soles']; ?>" data-stock="<?php echo $arregloCarrito[$i]['Stock']; ?>" value="<?php echo $arregloCarrito[$i]['Cantidad']; ?>" readonly>
                                                                                <div class="boton_mas">
                                                                                    <button onclick="location.reload()" class="js-btn-plus btnIncrementar" type="button">&plus;</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="det_producto precioTotal">
                                                                            <div class="precioTotal-div">
                                                                                <h5 class="cod_<?php echo $arregloCarrito[$i]['Cod_producto']; ?>">
                                                                                    <?php echo "$" . number_format($arregloCarrito[$i]['Precio_dolares'] * $arregloCarrito[$i]['Cantidad'], 2, '.', ',') . " - S/" . number_format($arregloCarrito[$i]['Precio_soles'] * $arregloCarrito[$i]['Cantidad'], 2, '.', ','); ?>
                                                                                </h5>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="elim_producto">
                                                                    <div>
                                                                        <a href="carrito.php" class="btnEliminar elim" data-id="<?php echo $arregloCarrito[$i]['Cod_producto']; ?>"><i class="fas fa-trash"></i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="det_producto arts-monto-venta_final">
                            <div class="arts-monto-venta_final-div">
                                <div class="arts-monto_final">
                                    <div class="arts_precioTotal">
                                        <div class="arts_precioTotal-div">
                                            <h5 class="articulosTotal"><?php
                                                                        if (isset($_SESSION['carrito'])) {
                                                                            echo count($_SESSION['carrito']);
                                                                        } else {
                                                                            echo 0;
                                                                        }
                                                                        ?> articulos</h5>
                                            <h5 class="precioArticulos Fin"><?php echo "$" . number_format($totalD, 2, '.', ',') . " - S/" . number_format($totalS, 2, '.', ',') ?></h5>
                                        </div>
                                    </div>
                                    <div class="montoFinal">
                                        <div>
                                            <h5 class="labe">Total</h5>
                                            <h5 class="valor Fin"><?php echo "$" . number_format($totalD, 2, '.', ',') . " - S/" . number_format($totalS, 2, '.', ',') ?></h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="venta">
                                    <div class="venta-div">
                                        <a href="venta.php">Proceder a pagar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
    <div class="seguir_compr">
        <div>
            <a class="SegCom" href="index.php">Seguir comprando</a>
        </div>
    </div>
    <?php
    include("Login/includes/footer.php")
    ?>
    <!-- <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/jquery-ui.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/owl.carousel.min.js"></script>
    <script src="../js/jquery.magnific-popup.min.js"></script>
    <script src="../js/aos.js"></script>
    <script src="../js/mainx.js"></script>
    <script>
        $(document).ready(
            function() {
                $(".btnEliminar").click(
                    function(event) {
                        var id = $(this).data('id');
                        var boton = $(this);
                        $.ajax({
                            method: 'POST',
                            url: 'Login/includes/eliminarCarrito.php',
                            data: {
                                id: id
                            }
                        }).done(
                            function(respuesta) {
                                boton.parent('div').parent('div').parent('div').parent('div').parent('div').parent('li').remove();
                            }
                        );
                    }
                );
                $(".txtCantidad").keyup(
                    function() {
                        var cantidad = $(this).val();
                        var precioD = $(this).data('preciod');
                        var precioS = $(this).data('precios');
                        var id = $(this).data('id');
                        incrementar(cantidad, precioD, precioS, id);
                    }
                );
                $(".btnIncrementar").click(
                    function() {
                        var precioD = $(this).parent('div').parent('div').find('input').data('preciod');
                        var precioS = $(this).parent('div').parent('div').find('input').data('precios');
                        var id = $(this).parent('div').parent('div').find('input').data('id');
                        var cantidad = $(this).parent('div').parent('div').find('input').val();
                        //var data = <?php //echo json_encode($arregloCarrito); 
                                        ?>;
                        incrementar(cantidad, precioD, precioS, id);
                    }
                );
                function incrementar(cantidad, precioD, precioS, id) {
                    var multD = parseFloat(cantidad) * parseFloat(precioD);
                    var multS = parseFloat(cantidad) * parseFloat(precioS);
                    $(".cod_" + id).text("$" + multD + " - S/" + multS);
                    $.ajax({
                        method: 'POST',
                        url: 'Login/includes/actualizar.php',
                        data: {
                            id: id,
                            cantidad: cantidad
                        }
                    });
                }
            }
        );
    </script> -->

    <script>
        <?php
        if (isset($_SESSION['carrito'])) {
        ?>
            var x = '<?php echo json_encode($_SESSION['carrito']); ?>';
        <?php
        } else {
        ?>
            var x;
        <?php
        }
        ?>
    </script>
    <script src="./../js/carrito6.js"></script>
</body>

</html>