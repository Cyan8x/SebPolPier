<?php
session_start();
if (isset($_SESSION['carrito'])) {
    echo count($_SESSION['carrito']);
} else {
    echo 0;
}
