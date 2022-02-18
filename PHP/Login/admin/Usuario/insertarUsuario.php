<?php
require_once("../../includes/connection.php");
session_start();
if (isset($_POST["guardar"])) {
    if (!empty($_POST['nombres']) && !empty($_POST['apellidos'] && !empty($_POST['usuario'])) && !empty($_POST['email']) && !empty($_POST['dni']) && !empty($_POST['direccion']) && !empty($_POST['ciudad']) && !empty($_POST['telefono']) && !empty($_POST['contraseña'])  && !empty($_POST['contraseña2'])) {
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
        $contraseña2 = $_POST['contraseña2'];
        $contraseña2_hash = password_hash($contraseña2, PASSWORD_BCRYPT);
        if (strlen($dni) != 8) {
            header("Location: ./usuarios.php?error=El DNI ingresado no es valido");
        } else {
            if (strlen($telefono) != 9 /*or strlen($telefono) != 7*/) {
                header("Location: ./usuarios.php?error=El número telefonico ingresado no es válido");
            } else {
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
                        $query = $connection->prepare("INSERT INTO usuarios(USUARIO,EMAIL,NOMBRES,APELLIDOS,CONTRASEÑA,DNI,DIRECCION,CIUDAD,TELEFONO) VALUES (:usuario,:email,:nombres,:apellidos,:contrasena_hash,:dni,:direccion,:ciudad,:telefono)");
                        $query->bindParam("nombres", $nombres, PDO::PARAM_STR);
                        $query->bindParam("apellidos", $apellidos, PDO::PARAM_STR);
                        $query->bindParam("usuario", $usuario, PDO::PARAM_STR);
                        $query->bindParam("email", $email, PDO::PARAM_STR);
                        $query->bindParam("contrasena_hash", $contraseña_hash, PDO::PARAM_STR);
                        $query->bindParam("dni", $dni, PDO::PARAM_INT);
                        $query->bindParam("direccion", $direccion, PDO::PARAM_STR);
                        $query->bindParam("ciudad", $ciudad, PDO::PARAM_STR);
                        $query->bindParam("telefono", $telefono, PDO::PARAM_INT);
                        $result = $query->execute();
                        if ($result) {
                            header("Location: ./usuarios.php?success=Usuario correctamente insertado");
                        } else {
                            header("Location: ./usuarios.php?error=Error al ingreso de datos");
                        }
                    } else {
                        header("Location: ./usuarios.php?error=El nombre de usuario ingresado ya existe. Por favor, intente con otra.");
                    }
                }
            }
        }
    } else {
        header("Location: ./usuarios.php?error=Ninguno de los campos debe estar vacio");
    }
}
