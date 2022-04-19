<?php
    include("../../includes_login/connection.php");
    $fila = $connection->prepare("SELECT imagen FROM productos WHERE cod_producto='".$_POST['id']."'");
    $fila->execute();
    $id = $fila->fetch();
    if (file_exists('../../../../imagenes/'.$id[0])) {
        unlink('../../../../imagenes/'.$id[0]);
    }
    $result = $connection->prepare("DELETE FROM productos WHERE cod_producto='".$_POST['id']."'");
    $result->execute();
    echo 'listo';
?>