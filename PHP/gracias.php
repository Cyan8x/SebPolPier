<?php
session_start();
include("Login/includes_login/connection.php");
if (!isset($_SESSION['carrito'])) {
    header('Location: ./index.php');
}

function venta($connection, $dni, $telefono, $direccion, $ciudad){
    $arreglo = $_SESSION['carrito'];
    $total = 0;
    for ($i = 0; $i < count($arreglo); $i++) {
        $total = $total + ($arreglo[$i]['Precio'] * $arreglo[$i]['Cantidad']);
    }
    //EN LA VARIABLE "fecha" SE ALMACENA EL DIA Y HORA EN QUE SI HIZO LA VENTA
    $fecha = date('Y-m-d h:m:s');
    $email = $_SESSION['email'];
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    foreach ($connection->query($sql) as $result) {
        $id_user = $result['id_user'];
        //SE INTRODUCE LOS DATOS DEL CLIENTE EN LA TABLA "ventas"
        // Estados de un pedido:
        //     -Pagado y falta enviar
        //     -Pagado y enviado
        $result2 = $connection->query("INSERT INTO ventas (id_user,montoFinal,dni,telefono,direccion,ciudad,fecha_compra,estado) VALUES('$id_user','$total',$dni,$telefono,'$direccion','$ciudad','$fecha','Pagado y falta enviar')");
    }
    $id_venta = $connection->lastInsertId();
    for ($i = 0; $i < count($arreglo); $i++) {
        //SE INSERTA LOS DATOS DE LOS PRODUCTOS QUE ESTA COMPRANDO EL CLIENTE EN LA TABLA "det_venta"
        $result3 = $connection->query("INSERT INTO det_venta (id_venta,cod_producto,cantidad,subtotal) VALUES('$id_venta','" . $arreglo[$i]['Cod_producto'] . "'," . $arreglo[$i]['Cantidad'] . "," . $arreglo[$i]['Precio'] * $arreglo[$i]['Cantidad'] . ")");
        //SE ACTUALIZA EL STOCK DE LOS PRODUCTOS QUE SON COMPRADOS POR CLIENTES
        $result4 = $connection->query("UPDATE productos SET stock = stock - " . $arreglo[$i]['Cantidad'] . " WHERE cod_producto = '" . $arreglo[$i]['Cod_producto'] . "'");
    }
    unset($_SESSION['carrito']);
}

if (!empty($_POST['dni']) && !empty($_POST['telefono']) && $_POST['tarjeta'] && !empty($_POST['numeroTarjeta']) && !empty($_POST['fechaCaducidad']) && !empty($_POST['titularTarjeta']) && !empty($_POST['cvv']) && !empty($_POST['direccion']) && !empty($_POST['ciudad'])) {
    if (strlen(strval($_POST['dni'])) == 8) {
        if (strlen(strval($_POST['telefono'])) == 9) {
            venta($connection,$_POST['dni'],$_POST['telefono'],$_POST['direccion'],$_POST['ciudad']);
        } else {
            $message = "Numero de contacto invalido";
            header("Location: ../../../../SebPolPier/PHP/venta.php?error=" . $message);
        }
    } else {
        $message = "DNI invalido";
            header("Location: ../../../../SebPolPier/PHP/venta.php?error=" . $message);
    }
} else {
    $message = "Ninguno de los campos debe estar vacio";
    header("Location: ../../../../SebPolPier/PHP/venta.php?error=" . $message);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("includes/metadatos.php")
    ?>
    <!-- Personal -->
    <link rel="stylesheet" href="../CSS/gracias3.css">
    <title>Venta</title>
</head>

<body>
    <?php
    include("includes/header1.php")
    ?>
    <div class="main">
        <h1>GRACIAS</h1>
    </div>
    <?php
    include("includes/footer.php")
    ?>
</body>

</html>