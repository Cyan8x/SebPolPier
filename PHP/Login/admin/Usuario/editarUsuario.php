<?php
require_once("../../includes_login/connection.php");
session_start();
if (isset($_POST["editar"])) {
    if (!empty($_POST['nombres']) && !empty($_POST['apellidos']) && !empty($_POST['email']) && !empty($_POST['contraseña'])) {
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $email = $_POST['email'];
        $contraseña = $_POST['contraseña'];
        $contraseña_hash = password_hash($contraseña, PASSWORD_BCRYPT);
        $sql = "SELECT * FROM usuarios WHERE id_user='" . $_POST['id_user'] . "'";
        foreach ($connection->query($sql) as $result) {
            if ($result['email'] != $email) {
                $query = $connection->prepare("SELECT * FROM usuarios WHERE EMAIL=:email");
                $query->bindParam("email", $email, PDO::PARAM_STR);
                $query->execute();
                if ($query->rowCount() > 0) {
                    header("Location: ./usuarios.php?error=El correo electrónico ingresado ya se encuentra registrado");
                }
                if ($query->rowCount() == 0) {
                    $query = $connection->prepare("UPDATE usuarios SET EMAIL=:email WHERE id_user='" . $_POST['id_user'] . "'");
                    $query->bindParam("email", $email, PDO::PARAM_STR);
                    $result = $query->execute();
                } else {
                    header("Location: ./usuarios.php?error=El correo electrónico ingresado ya se encuentra registrado");
                }
            }
        }
        $query = $connection->prepare("UPDATE usuarios SET NOMBRES=:nombres, APELLIDOS=:apellidos, CONTRASEÑA=:contrasena_hash WHERE id_user='" . $_POST['id_user'] . "'");
        $query->bindParam("nombres", $nombres, PDO::PARAM_STR);
        $query->bindParam("apellidos", $apellidos, PDO::PARAM_STR);
        $query->bindParam("contrasena_hash", $contraseña_hash, PDO::PARAM_STR);
        $result = $query->execute();
        if ($result) {
            header("Location: ./usuarios.php?success=Usuario correctamente editado");
        } else {
            header("Location: ./usuarios.php?error=Error al ingreso de datos");
        }
    } else {
        header("Location: ./usuarios.php?error=Ninguno de los campos debe estar vacio");
    }
}
