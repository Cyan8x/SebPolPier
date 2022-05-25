<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../CSS/login_register.css">
    <link rel="stylesheet" href="../../../CSS/normalize.css">
    <link rel="shortcut icon" href="../../../imagenes/S.jpg">
    <script src="https://kit.fontawesome.com/4c62087cc0.js" crossorigin="anonymous"></script>
    <title>Login de Usuarios</title>
</head>

<body>
    <?php
    //LLAMA A LA CONEXION CON LA BASE DE DATOS
    require_once("../includes_login/connection.php");
    //SE CREA UN SESSION_START PARA SABER SI YA SE INICIO UNA SESIÓN O NO
    session_start();
    //SE CREA UNA ESTRUCTURA CONDICIONAL
    if (isset($_POST["register"])) {
        //SI SE LLEGA A RECIBIR UN DATOS AL PRESIONAR UN BOTON CON EL NOMBRE "register"
        if (!empty($_POST['nombres']) && !empty($_POST['apellidos']) && !empty($_POST['email']) && !empty($_POST['contraseña'])  && !empty($_POST['contraseña2'])) {
            //SI LOS CAMPOS RQUERIDOS PARA EL REGISTRO DEL USUARIO NO ESTAN VACIOS, SE HACE LAS SIGUIENTE VERIFICACIONES
            $nombres = $_POST['nombres'];
            $apellidos = $_POST['apellidos'];
            $email = $_POST['email'];
            $contraseña = $_POST['contraseña'];
            $contraseña_hash = password_hash($contraseña, PASSWORD_BCRYPT);
            $contraseña2 = $_POST['contraseña2'];
            $contraseña2_hash = password_hash($contraseña2, PASSWORD_BCRYPT);
            if ($contraseña != $contraseña2) {
                echo '<p class = "error">Las contraseñas no son identicas</p>';
            } else {
                $query = $connection->prepare("SELECT * FROM usuarios WHERE EMAIL=:email");
                $query->bindParam("email", $email, PDO::PARAM_STR);
                $query->execute();
                if ($query->rowCount() > 0) {
                    echo '<p class = "error">El correo electrónico ingresado ya se encuentra registrado</p>';
                }
                if ($query->rowCount() == 0) {
                    $query = $connection->prepare("INSERT INTO usuarios(EMAIL,NOMBRES,APELLIDOS,CONTRASEÑA,ADMINIS) VALUES (:email,:nombres,:apellidos,:contrasena_hash,0)");
                    $query->bindParam("nombres", $nombres, PDO::PARAM_STR);
                    $query->bindParam("apellidos", $apellidos, PDO::PARAM_STR);
                    $query->bindParam("email", $email, PDO::PARAM_STR);
                    $query->bindParam("contrasena_hash", $contraseña_hash, PDO::PARAM_STR);
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
        } else {
            //SI LOS CAMPOS ESTAN VACIOS, SE MUESTRA UN MENSAJE DE ERROR
            $message = "Ninguno de los campos debe estar vacio";
        }
    }
    ?>
    <?php
    if (!empty($message)) {
        echo "<p class =\"error\">" . "Mensaje: " . $message . "</p>";
    }
    ?>
    <!-- ESTRUCTURA DE FORMULARIO DE REGISTRO DE USUARIOS  -->
    <div class="container">
        <div class="form">
            <form name="registerform" action="register.php" method="POST">
                <h1>Registro de Usuarios</h1>
                <div class="div_input">
                    <input type="text" name="nombres" id="nombres" placeholder="Nombres completos">
                </div>
                <div class="div_input">
                    <input type="text" name="apellidos" id="apellidos" placeholder="Apellidos completos">
                </div>
                <div class="div_input">
                    <input type="email" name="email" id="email" placeholder="Correo electrónico">
                </div>
                <div class="div_input">
                    <input type="password" name="contraseña" id="contraseña" placeholder="Contraseña">
                </div>
                <div class="div_input">
                    <input type="password" name="contraseña2" id="contraseña2" placeholder="Confirmar contraseña">
                </div>
                <div class="submit">
                    <div>
                        <button type="submit" name="register" value="Registrarse">Registrarse</button>
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