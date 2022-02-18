<?php
require_once("../../includes/connection.php");
session_start();
if (isset($_POST["editar"])) {
    if (!empty($_POST['nombres']) && !empty($_POST['apellidos'] && !empty($_POST['usuario'])) && !empty($_POST['email']) && !empty($_POST['dni']) && !empty($_POST['direccion']) && !empty($_POST['ciudad']) && !empty($_POST['telefono']) && !empty($_POST['contraseña'])) {
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $usuario = $_POST['usuario'];
        $email = $_POST['email'];
        $dni = $_POST['dni'];
        $direccion = $_POST['direccion'];
        $ciudad = $_POST['ciudad'];
        $telefono = $_POST['telefono'];
        $contraseña = $_POST['contraseña'];
        $contraseña_hash = password_hash($contraseña, PASSWORD_BCRYPT);
        $sql = "SELECT * FROM usuarios WHERE id_usuario='" . $_POST['id_usuario'] . "'";
        foreach ($connection->query($sql) as $result) {
            if ($result['usuario'] != $usuario) {
                $query = $connection->prepare("SELECT * FROM usuarios WHERE USUARIO=:usuario");
                $query->bindParam("usuario", $usuario, PDO::PARAM_STR);
                $query->execute();
                if ($query->rowCount() > 0) {
                    header("Location: ./usuarios.php?error=El nombre de usuario ingresado ya existe. Por favor, intente con otra.");
                }
                if ($query->rowCount() == 0) {
                    $query = $connection->prepare("UPDATE usuarios SET USUARIO=:usuario WHERE id_usuario='" . $_POST['id_usuario'] . "'");
                    $query->bindParam("usuario", $usuario, PDO::PARAM_STR);
                    $result = $query->execute();
                } else {
                    header("Location: ./usuarios.php?error=El correo electrónico ingresado ya se encuentra registrado");
                }
            }
            if ($result['email'] != $email) {
                $query = $connection->prepare("SELECT * FROM usuarios WHERE EMAIL=:email");
                $query->bindParam("email", $email, PDO::PARAM_STR);
                $query->execute();
                if ($query->rowCount() > 0) {
                    header("Location: ./usuarios.php?error=El correo electrónico ingresado ya se encuentra registrado");
                }
                if ($query->rowCount() == 0) {
                    $query = $connection->prepare("UPDATE usuarios SET EMAIL=:email WHERE id_usuario='" . $_POST['id_usuario'] . "'");
                    $query->bindParam("email", $email, PDO::PARAM_STR);
                    $result = $query->execute();
                } else {
                    header("Location: ./usuarios.php?error=El nombre de usuario ingresado ya existe. Por favor, intente con otra.");
                }
            }
            if ($result['dni'] != $dni) {
                if (strlen($dni) != 8) {
                    header("Location: ./usuarios.php?error=El DNI ingresado no es valido");
                } else {
                    $query = $connection->prepare("SELECT * FROM usuarios WHERE DNI=:dni");
                    $query->bindParam("dni", $dni, PDO::PARAM_INT);
                    $query->execute();
                    if ($query->rowCount() > 0) {
                        header("Location: ./usuarios.php?error=El DNI ingresado ya se encuentra registrado");
                    }
                    if ($query->rowCount() == 0) {
                        $query = $connection->prepare("UPDATE usuarios SET DNI=:dni WHERE id_usuario='" . $_POST['id_usuario'] . "'");
                        $query->bindParam("dni", $dni, PDO::PARAM_INT);
                        $result = $query->execute();
                    }
                }
            }
            if ($result['telefono'] != $telefono) {
                if (strlen($telefono) != 9 /*or strlen($telefono) != 7*/) {
                    header("Location: ./usuarios.php?error=El número telefonico ingresado no es válido");
                } else {
                    $query = $connection->prepare("SELECT * FROM usuarios WHERE TELEFONO=:telefono");
                    $query->bindParam("telefono", $telefono, PDO::PARAM_INT);
                    $query->execute();
                    if ($query->rowCount() > 0) {
                        header("Location: ./usuarios.php?error=El telefono ingresado ya se encuentra registrado");
                    }
                    if ($query->rowCount() == 0) {
                        $query = $connection->prepare("UPDATE usuarios SET TELEFONO=:telefono WHERE id_usuario='" . $_POST['id_usuario'] . "'");
                        $query->bindParam("telefono", $telefono, PDO::PARAM_INT);
                        $result = $query->execute();
                    }
                }
            }
        }
        $query = $connection->prepare("UPDATE usuarios SET NOMBRES=:nombres, APELLIDOS=:apellidos, CONTRASEÑA=:contrasena_hash, DIRECCION=:direccion, CIUDAD=:ciudad WHERE id_usuario='" . $_POST['id_usuario'] . "'");
        $query->bindParam("nombres", $nombres, PDO::PARAM_STR);
        $query->bindParam("apellidos", $apellidos, PDO::PARAM_STR);
        $query->bindParam("contrasena_hash", $contraseña_hash, PDO::PARAM_STR);
        $query->bindParam("direccion", $direccion, PDO::PARAM_STR);
        $query->bindParam("ciudad", $ciudad, PDO::PARAM_STR);
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