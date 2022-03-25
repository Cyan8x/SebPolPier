<?php
include("./../Login/includes/connection.php");
$sql = 'SELECT * FROM productos WHERE stock > 0';
// $array = array();
$array2 = array();
foreach ($connection->query($sql) as $result) {
    $arrayaux = array(
        "cod_producto"=> $result['cod_producto'],
        "cod_marca"=> $result['cod_marca'],
        "cod_categoria"=> $result['cod_categoria'],
        "cod_prov"=> $result['cod_prov'],
        "cod_orig_prod"=> $result['cod_orig_prod'],
        "imagen"=> $result['imagen'],
        "nombre"=> $result['nombre'],
        "stock"=> $result['stock'],
        "precio_dolares"=> $result['precio_dolares'],
        "precio_soles"=> $result['precio_soles']
    );
    // array_push($array, $result);
    array_push($array2, $arrayaux);
}

echo json_encode($array2);
?>