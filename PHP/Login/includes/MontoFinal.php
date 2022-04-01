<?php
session_start();
$totalD = 0;
$totalS = 0;
if (isset($_SESSION['carrito'])) {
    $arreglo = $_SESSION['carrito'];
    for ($i = 0; $i < count($arreglo); $i++) {
        $totalD = $totalD + ($arreglo[$i]['Precio_dolares'] * $arreglo[$i]['Cantidad']);
        $totalS = $totalS + ($arreglo[$i]['Precio_soles'] * $arreglo[$i]['Cantidad']);
    }
}

echo ("$" . $totalD . " - S/" . $totalS);
