<?php
    include("../../includes/connection.php");
    $result = $connection->prepare("DELETE FROM usuarios WHERE id_usuario='".$_POST['id']."'");
    $result->execute();
    echo 'listo';
?>