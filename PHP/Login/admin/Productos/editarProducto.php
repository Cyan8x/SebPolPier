<?php
require_once("../../includes_login/connection.php");
session_start();
if (isset($_POST["editar"])) {
    if (!empty($_POST['marca']) && !empty($_POST['categoria']) && !empty($_POST['proveedor']) && !empty($_POST['nombre']) && !empty($_POST['stock']) && !empty($_POST['precio'])) {
        if ($_FILES['imagen']['name'] != " ") {
            $carpeta = "../../../../imagenes/";
            $nombre = $_FILES['imagen']['name'];
            $temp = explode('.', $nombre);
            $extension = end($temp);
            $nombreFinal = time() . '.' . $extension;
            if ($extension == 'jpg' || $extension == 'png') {
                if (move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta . $nombreFinal)) {
                    $fila = $connection->prepare("SELECT imagen FROM productos WHERE cod_producto='" . $_POST['cod_producto'] . "'");
                    $fila->execute();
                    $id = $fila->fetch();
                    if (file_exists('../../../../imagenes/' . $id[0])) {
                        unlink('../../../../imagenes/' . $id[0]);
                    }
                    $result = $connection->prepare("UPDATE productos SET imagen='" . $nombreFinal . "' WHERE cod_producto='" . $_POST['cod_producto'] . "'");
                    $result->execute();
                } else {
                    header("Location: ./productos.php?error=No se pudo editar la imagen, intentelo nuevamente");
                }
            } else {
                header("Location: ./productos.php?error=Debe ingresar una imagen valida");
            }
        }
        $marca = $_POST['marca'];
        $categoria = $_POST['categoria'];
        $proveedor = $_POST['proveedor'];
        $nombre = $_POST['nombre'];
        $stock = $_POST['stock'];
        $precio = $_POST['precio'];
        $query = $connection->prepare("UPDATE productos SET COD_MARCA=:marca, COD_CATEGORIA=:categoria, COD_PROV=:proveedor, NOMBRE=:nombre, STOCK=:stock, PRECIO=:precio WHERE cod_producto='" . $_POST['cod_producto'] . "'");
        $query->bindParam("marca", $marca, PDO::PARAM_STR);
        $query->bindParam("categoria", $categoria, PDO::PARAM_STR);
        $query->bindParam("proveedor", $proveedor, PDO::PARAM_STR);
        $query->bindParam("nombre", $nombre, PDO::PARAM_STR);
        $query->bindParam("stock", $stock, PDO::PARAM_INT);
        $query->bindParam("precio", $precio, PDO::PARAM_STR);
        $result = $query->execute();
        if ($result) {
            header("Location: ./productos.php?success=Producto correctamente editado");
        } else {
            header("Location: ./productos.php?error=Error al editar los datos del producto");
        }
    } else {
        header("Location: ./productos.php?error=Ninguno de los campos debe estar vacio");
    }
}
