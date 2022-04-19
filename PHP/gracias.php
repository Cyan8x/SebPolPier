<?php
session_start();
include("Login/includes_login/connection.php");
if (!isset($_SESSION['carrito'])) {
    header('Location: ./index.php');
}
if (!empty($_POST['direccionopc']) && !empty($_POST['ciudadopc'])) {
    $direccion_opc = $_POST['direccionopc'];
    $ciudad_opc = $_POST['ciudadopc'];
} else {
    $direccion_opc = 'NULL';
    $ciudad_opc = 'NULL';
}
$arreglo = $_SESSION['carrito'];
$total = 0;
for ($i = 0; $i < count($arreglo); $i++) {
    $total = $total + ($arreglo[$i]['Precio'] * $arreglo[$i]['Cantidad']);
}
//EN LA VARIABLE "fecha" SE ALMACENA EL DIA Y HORA EN QUE SI HIZO LA VENTA
$fecha = date('Y-m-d h:m:s');
$session_user = $_SESSION['session_usuario'];
$sql = "SELECT * FROM usuarios WHERE usuario = '$session_user'";
foreach ($connection->query($sql) as $result) {
    $id_user = $result['id_user'];
    //SE INTRODUCE LOS DATOS DEL CLIENTE EN LA TABLA "ventas"
    // Estados de un pedido:
    //     -Pagado y falta enviar
    //     -Pagado y enviado
    $result2 = $connection->query("INSERT INTO ventas (id_user,montoFinal,fecha_compra,estado) VALUES('$id_user','$total','$fecha','Pagado y falta enviar')");
}
$id_venta = $connection->lastInsertId();
for ($i = 0; $i < count($arreglo); $i++) {
    //SE INSERTA LOS DATOS DE LOS PRODUCTOS QUE ESTA COMPRANDO EL CLIENTE EN LA TABLA "det_venta"
    $result3 = $connection->query("INSERT INTO det_venta (id_venta,cod_producto,cantidad,subtotal) VALUES('$id_venta','" . $arreglo[$i]['Cod_producto'] . "'," . $arreglo[$i]['Cantidad'] . "," . $arreglo[$i]['Precio'] * $arreglo[$i]['Cantidad'] . ")");
    //SE ACTUALIZA EL STOCK DE LOS PRODUCTOS QUE SON COMPRADOS POR CLIENTES
    $result4 = $connection->query("UPDATE productos SET stock = stock - " . $arreglo[$i]['Cantidad'] . " WHERE cod_producto = '" . $arreglo[$i]['Cod_producto'] . "'");
}
unset($_SESSION['carrito']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("includes/metadatos.php")
    ?>
    <!-- Personal -->
    <link rel="stylesheet" href="../CSS/gracias.css">
    <title>Venta</title>
</head>

<body>
    <?php
    include("includes/header1.php")
    ?>
    <div class="gracias">
        GRACIAS POR SU COMPRA
    </div>
    <?php
    include("includes/footer.php")
    ?>
</body>

</html>