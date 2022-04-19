<?php
    include("../../includes_login/connection.php");
    $result = $connection->prepare("DELETE FROM usuarios WHERE id_user='".$_POST['id']."'");
    $result->execute();
    echo 'listo';
?>