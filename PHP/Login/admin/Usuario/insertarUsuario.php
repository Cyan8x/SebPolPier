<?php
require_once("../../includes_login/connection.php");
session_start();
if (isset($_POST["guardar"])) {
    if (!empty($_POST['nombres']) && !empty($_POST['apellidos']) && !empty($_POST['email']) && !empty($_POST['contraseña']) && !empty($_POST['contraseña2'])) {
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $email = $_POST['email'];
        $contraseña = $_POST['contraseña'];
        $contraseña_hash = password_hash($contraseña, PASSWORD_BCRYPT);
        $contraseña2 = $_POST['contraseña2'];
        $contraseña2_hash = password_hash($contraseña2, PASSWORD_BCRYPT);
        if ($contraseña != $contraseña2) {
            header("Location: ./usuarios.php?error=Las contraseñas no son identicas");
        } else {
            $query = $connection->prepare("SELECT * FROM usuarios WHERE EMAIL=:email");
            $query->bindParam("email", $email, PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() > 0) {
                header("Location: ./usuarios.php?error=El correo electrónico ingresado ya se encuentra registrado");
            }
            if ($query->rowCount() == 0) {
                $query = $connection->prepare("INSERT INTO usuarios(EMAIL,NOMBRES,APELLIDOS,CONTRASEÑA) VALUES (:email,:nombres,:apellidos,:contrasena_hash)");
                $query->bindParam("nombres", $nombres, PDO::PARAM_STR);
                $query->bindParam("apellidos", $apellidos, PDO::PARAM_STR);
                $query->bindParam("email", $email, PDO::PARAM_STR);
                $query->bindParam("contrasena_hash", $contraseña_hash, PDO::PARAM_STR);
                $result = $query->execute();
                if ($result) {
                    header("Location: ./usuarios.php?success=Usuario correctamente insertado");
                } else {
                    header("Location: ./usuarios.php?error=Error al ingreso de datos");
                }
            } else {
                header("Location: ./usuarios.php?error=El correo electrónico ingresado ya se encuentra registrado");
            }
        }
    } else {
        header("Location: ./usuarios.php?error=Ninguno de los campos debe estar vacio");
    }
}
