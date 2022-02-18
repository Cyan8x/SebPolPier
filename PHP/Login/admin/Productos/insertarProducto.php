<?php
require_once("./../../includes/connection.php");
session_start();
if (isset($_POST["guardar"])) {
    if (!empty($_POST['cod_producto']) && !empty($_POST['marca']) && !empty($_POST['categoria']) && !empty($_POST['proveedor']) && !empty($_POST['cod_orig_prod']) && !empty($_POST['nombre']) && !empty($_POST['stock']) && !empty($_POST['precio_dolares'])  && !empty($_POST['precio_soles'])) {
        $carpeta = "../../../../imagenes/";
        $nombre = $_FILES['imagen']['name'];
        $temp = explode('.', $nombre);
        $extension = end($temp);
        $nombreFinal = time() . '.' . $extension;
        if ($extension == 'jpg' || $extension == 'png') {
            if (move_uploaded_file($_FILES['imagen']['tmp_name'],$carpeta.$nombreFinal)) {
                $cod_producto = $_POST['cod_producto'];
                $marca = $_POST['marca'];
                $categoria = $_POST['categoria'];
                $proveedor = $_POST['proveedor'];
                $cod_orig_prod = $_POST['cod_orig_prod'];
                $nombre = $_POST['nombre'];
                $stock = $_POST['stock'];
                $precio_dolares = $_POST['precio_dolares'];
                $precio_soles = $_POST['precio_soles'];
                $query = $connection->prepare("SELECT * FROM productos WHERE COD_PRODUCTO=:cod_producto OR COD_ORIG_PROD=:cod_orig_prod");
                $query->bindParam("cod_producto", $cod_producto, PDO::PARAM_STR);
                $query->bindParam("cod_orig_prod", $cod_orig_prod, PDO::PARAM_STR);
                $query->execute();
                if ($query->rowCount() > 0) {
                    header("Location: ./productos.php?error=El COD_PRODUCTO o COD_ORIGNAL_PRODUCTO ingresado ya se encuentra registrado");
                }
                if ($query->rowCount() == 0) {
                    $query = $connection->prepare("INSERT INTO productos(COD_PRODUCTO,COD_MARCA,COD_CATEGORIA,COD_PROV,COD_ORIG_PROD,IMAGEN,NOMBRE,STOCK,PRECIO_DOLARES,PRECIO_SOLES) VALUES (:cod_producto,:marca,:categoria,:proveedor,:cod_orig_prod,'".$nombreFinal."',:nombre,:stock,:precio_dolares,:precio_soles)");
                    $query->bindParam("cod_producto", $cod_producto, PDO::PARAM_STR);
                    $query->bindParam("marca", $marca, PDO::PARAM_STR);
                    $query->bindParam("categoria", $categoria, PDO::PARAM_STR);
                    $query->bindParam("proveedor", $proveedor, PDO::PARAM_STR);
                    $query->bindParam("cod_orig_prod", $cod_orig_prod, PDO::PARAM_STR);
                    $query->bindParam("nombre", $nombre, PDO::PARAM_STR);
                    $query->bindParam("stock", $stock, PDO::PARAM_INT);
                    $query->bindParam("precio_dolares", $precio_dolares, PDO::PARAM_STR);
                    $query->bindParam("precio_soles", $precio_soles, PDO::PARAM_STR);
                    $result = $query->execute();
                    if ($result) {
                        header("Location: ./productos.php?success=Producto correctamente insertado");
                    } else {
                        header("Location: ./productos.php?error=Error al insertar los datos del producto");
                    }
                }
            }else{
                header("Location: ./productos.php?error=No se pudo subir la imagen, intentelo nuevamente");
            }
        } else {
            header("Location: ./productos.php?error=Debe ingresar una imagen valida");
        }
    } else {
        header("Location: ./productos.php?error=Ninguno de los campos debe estar vacio");
    }
}
