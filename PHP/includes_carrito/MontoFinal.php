<?php
session_start();
$total = 0;
if (isset($_SESSION['carrito'])) {
    $arreglo = $_SESSION['carrito'];
    for ($i = 0; $i < count($arreglo); $i++) {
        $total = $total + ($arreglo[$i]['Precio'] * $arreglo[$i]['Cantidad']);
    }
}

echo ("$" . $total);
