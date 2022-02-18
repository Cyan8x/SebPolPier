<?php
    //LLAMAMOS A LAS CONSTANTES
    require_once("constants.php");
    try {
        //SE INTENTA LA CONEXION CON LA BASE DE DATOS
        $connection = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASS);
    } catch (Exception $e) {
        //SI NO SE LLEGA A CONECTAR LA BASE DE DATOS, QUE ME MUESTRE EL ERROR
        die($e->getMessage());
    }
?>
