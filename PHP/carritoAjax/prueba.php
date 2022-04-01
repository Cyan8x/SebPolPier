<?php
include("./../Login/includes/connection.php");
//SE CREA UN SESSION_START PARA SABER SI YA SE INICIO UNA SESIÓN O NO
session_start();
//SE CREA UNA ESTRUCTURA CONDICIONAL
$arreglo = array(       );
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
                echo json_encode($arreglo);
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
                echo json_encode($arreglo);
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
            echo json_encode($arreglo);
        }
    }
} else {
    //SI NO EXISTE UNA SESION INICIADA EN LA PAGINA WEB, LO REDIRECCIONAMOS AL SIGUIENTE LINK
    header("Location: ../../../SebPolPier/PHP/Login/register_login/index.html");
}

echo json_encode($arreglo);
?>
