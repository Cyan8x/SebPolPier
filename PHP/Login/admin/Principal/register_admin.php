<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../CSS/registerx.css">
    <link rel="stylesheet" href="../../../CSS/normalize.css">
    <link rel="shortcut icon" href="../../../imagenes/S.jpg">
    <script src="https://kit.fontawesome.com/4c62087cc0.js" crossorigin="anonymous"></script>
    <title>Login de Administradores</title>
</head>

<body>
    <?php
    require_once("../../includes/connection.php");
    session_start();
    if (isset($_POST["register"])) {
        if (!empty($_POST['nombres']) && !empty($_POST['apellidos'] && !empty($_POST['user_admin'])) && !empty($_POST['email']) && !empty($_POST['dni']) && !empty($_POST['telefono']) && !empty($_POST['contraseña'])  && !empty($_POST['contraseña2'])) {
            $nombres = $_POST['nombres'];
            $apellidos = $_POST['apellidos'];
            $user_admin = $_POST['user_admin'];
            $email = $_POST['email'];
            $dni = $_POST['dni'];
            $telefono = $_POST['telefono'];
            $contraseña = $_POST['contraseña'];
            $contraseña_hash = password_hash($contraseña, PASSWORD_BCRYPT);
            $contraseña2 = $_POST['contraseña2'];
            $contraseña2_hash = password_hash($contraseña2, PASSWORD_BCRYPT);
            if (strlen($dni) != 8) {
                echo '<p class = "error">El DNI ingresado no es válido</p>';
            } else {
                if (strlen($telefono) != 9 /*or strlen($telefono) != 7*/) {
                    echo '<p class = "error">El número telefonico ingresado no es válido</p>';
                } else {
                    if ($contraseña != $contraseña2) {
                        echo '<p class = "error">Las contraseñas no son identicas</p>';
                    } else {
                        $query = $connection->prepare("SELECT * FROM administradores WHERE EMAIL=:email");
                        $query->bindParam("email", $email, PDO::PARAM_STR);
                        $query->execute();
                        if ($query->rowCount() > 0) {
                            echo '<p class = "error">El correo electrónico ingresado ya se encuentra registrado</p>';
                        }
                        if ($query->rowCount() == 0) {
                            $query = $connection->prepare("INSERT INTO administradores(USER_ADMIN,EMAIL,NOMBRES,APELLIDOS,CONTRASEÑA,DNI,TELEFONO) VALUES (:user_admin,:email,:nombres,:apellidos,:contrasena_hash,:dni,:telefono)");
                            $query->bindParam("nombres", $nombres, PDO::PARAM_STR);
                            $query->bindParam("apellidos", $apellidos, PDO::PARAM_STR); 
                            $query->bindParam("user_admin", $user_admin, PDO::PARAM_STR);
                            $query->bindParam("email", $email, PDO::PARAM_STR);
                            $query->bindParam("contrasena_hash", $contraseña_hash, PDO::PARAM_STR);
                            $query->bindParam("dni", $dni, PDO::PARAM_INT);
                            $query->bindParam("telefono", $telefono, PDO::PARAM_INT);
                            $result = $query->execute();
                            if ($result) {
                                $message = "Cuenta correctamente creada";
                            } else {
                                $message = "Error al ingreso de datos";
                            }
                        } else {
                            $message = "El nombre de usuario ingresado ya existe. Por favor, intente con otra.";
                        }
                    }
                }
            }
        } else {
            $message = "Ninguno de los campos debe estar vacio";
        }
    }
    ?>
    <?php
    if (!empty($message)) {
        echo "<p class =\"error\">" . "Mensaje: " . $message . "</p>";
    }
    ?>
    <div class="container_register">
        <div class="register">
            <form name="registerform" class="registerform" action="register_admin.php" method="POST">
                <h1 class="loginform_titulo">Registro de Administradores</h1>
                <div class="div_input">
                    <input type="text" name="nombres" id="nombres" class="input" size="32" placeholder="Nombres completos">
                </div>
                <div class="div_input">
                    <input type="text" name="apellidos" id="apellidos" class="input" size="32" placeholder="Apellidos completos">
                </div>
                <div class="div_input">
                    <input type="text" name="user_admin" id="user_admin" class="input" size="20" placeholder="Usuario de administrador">
                </div>
                <div class="div_input">
                    <input type="email" name="email" id="email" class="input" size="32" placeholder="Correo electrónico">
                </div>
                <div class="div_input">
                    <input type="number" name="dni" id="dni" class="input" size="32" placeholder="DNI">
                </div>
                <div class="div_input">
                    <div class="esp">
                        <input type="number" name="telefono" id="telefono" class="input" size="32" placeholder="Numero telefónico o celular">
                        <p class="div_esp">
                            No considere el "+51" o el "01"
                        </p>
                    </div>
                </div>
                <div class="div_input">
                    <input type="password" name="contraseña" id="contraseña" class="input" size="32" placeholder="Contraseña">
                </div>
                <div class="div_input">
                    <input type="password" name="contraseña2" id="contraseña2" class="input" size="32" placeholder="Confirmar contraseña">
                </div>
                <div class="submit">
                    <div class="submit_div">
                        <button type="submit" name="register" class="button" value="Registrarse">Registrarse</button>
                    </div>
                </div>
                <div class="regtext">
                    <p class="regtext_p">
                        Si ya tienes una cuenta, <a href="login.php">logueate dando clic aquí</a>
                    </p>
                    <p class="regtext_p">
                        <a href="../../index.php">Pagina Principal de SebPolPier</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</body>

</html>