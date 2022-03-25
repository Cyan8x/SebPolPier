<?php
session_start();
include("Login/includes/connection.php");
if (!isset($_SESSION['carrito'])) {
    header('Location: ./index.php');
}
if (!empty($_POST['direccionopc']) && !empty($_POST['ciudadopc'])) {
    $direccion_opc = $_POST['direccionopc'];
    $ciudad_opc = $_POST['ciudadopc'];
}else{
    $direccion_opc = 'NULL';
    $ciudad_opc = 'NULL';
}
$arreglo = $_SESSION['carrito'];
$totalD = 0;
$totalS = 0;
for ($i = 0; $i < count($arreglo); $i++) {
    $totalD = $totalD + ($arreglo[$i]['Precio_dolares'] * $arreglo[$i]['Cantidad']);
    $totalS = $totalS + ($arreglo[$i]['Precio_soles'] * $arreglo[$i]['Cantidad']);
}
//EN LA VARIABLE "fecha" SE ALMACENA EL DIA Y HORA EN QUE SI HIZO LA VENTA
$fecha = date('Y-m-d h:m:s');
$session_user = $_SESSION['session_usuario'];
$sql = "SELECT * FROM usuarios WHERE usuario = '$session_user'";
foreach ($connection->query($sql) as $result) {
    $email = $result['email'];
    $nombres = $result['nombres'];
    $email = $result['email'];
    $apellidos = $result['apellidos'];
    $dni = $result['dni'];
    $direccion = $result['direccion'];
    $ciudad = $result['ciudad'];
    $telefono = $result['telefono'];
    //SE INTRODUCE LOS DATOS DEL CLIENTE EN LA TABLA "ventas"
    $result2 = $connection->query("INSERT INTO ventas (usuario,email,nombres,apellidos,dni,direccion,ciudad,telefono,direccion_opc,ciudad_opc,fecha_compra) VALUES('$session_user','$email','$nombres','$apellidos','$dni','$direccion','$ciudad','$telefono','$direccion_opc','$ciudad_opc','$fecha')");
}
$id_venta = $connection->lastInsertId();
for ($i=0; $i < count($arreglo); $i++) {
    //SE INSERTA LOS DATOS DE LOS PRODUCTOS QUE ESTA COMPRANDO EL CLIENTE EN LA TABLA "detalle1_venta"
    $result3 = $connection->query("INSERT INTO detalle1_venta (cod_venta,cod_producto,cantidad,precio_dolares,precio_soles,subtotal_dolares,subtotal_soles) VALUES('$id_venta','".$arreglo[$i]['Cod_producto']."',".$arreglo[$i]['Cantidad'].",".$arreglo[$i]['Precio_dolares'].",".$arreglo[$i]['Precio_soles'].",".$arreglo[$i]['Precio_dolares']*$arreglo[$i]['Cantidad'].",".$arreglo[$i]['Precio_soles']*$arreglo[$i]['Cantidad'].")");
    //SE ACTUALIZA EL STOCK DE LOS PRODUCTOS QUE SON COMPRADOS POR CLIENTES
    $result4 = $connection->query("UPDATE productos SET stock = stock - ".$arreglo[$i]['Cantidad']." WHERE cod_producto = '".$arreglo[$i]['Cod_producto']."'");
}
//SE INSERTA EL ID DE LA VENTA, EL ID DEL DETALLE1_VENTA Y EL MONTO FINAL A PAGAR POR EL CLIENTE EN LA TABLA "detalle2_venta"
$result4 = $connection->query("INSERT INTO detalle2_venta (cod_venta,monto_finalD,monto_finalS) VALUES('$id_venta','$totalD','$totalS')");
unset($_SESSION['carrito']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Base -->
    <link rel="stylesheet" href="../CSS/base9.css">
    <!-- Personal -->
    <link rel="stylesheet" href="../CSS/gracias.css">
    <!-- Normalize -->
    <link rel="stylesheet" href="../CSS/normalize.css">
    <!-- Icon -->
    <link rel="shortcut icon" href="../imagenes/S.jpg">
    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/4c62087cc0.js" crossorigin="anonymous"></script>
    <title>Venta</title>
</head>

<body>
    <?php
    include("Login/includes/header1.php")
    ?>
    <div class="gracias">
        GRACIAS POR SU COMPRA
    </div>
    <?php
    include("Login/includes/footer.php")
    ?>
</body>
</html>