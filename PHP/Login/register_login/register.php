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
    <title>Login de Usuarios</title>
</head>

<body>
    <?php
    //LLAMA A LA CONEXION CON LA BASE DE DATOS
    require_once("../includes/connection.php");
    //SE CREA UN SESSION_START PARA SABER SI YA SE INICIO UNA SESIÓN O NO
    session_start();
    //SE CREA UNA ESTRUCTURA CONDICIONAL
    if (isset($_POST["register"])) {
        //SI SE LLEGA A RECIBIR UN DATOS AL PRESIONAR UN BOTON CON EL NOMBRE "register"
        if (!empty($_POST['nombres']) && !empty($_POST['apellidos'] && !empty($_POST['usuario'])) && !empty($_POST['email']) && !empty($_POST['dni']) && !empty($_POST['direccion']) && !empty($_POST['ciudad']) && !empty($_POST['telefono']) && !empty($_POST['contraseña'])  && !empty($_POST['contraseña2'])) {
            //SI LOS CAMPOS RQUERIDOS PARA EL REGISTRO DEL USUARIO NO ESTAN VACIOS, SE HACE LAS SIGUIENTE VERIFICACIONES
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
                echo '<p class = "error">El DNI ingresado no es válido</p>';
            } else {
                if (strlen($telefono) != 9 /*or strlen($telefono) != 7*/) {
                    echo '<p class = "error">El número telefonico ingresado no es válido</p>';
                } else {
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
                            $query = $connection->prepare("INSERT INTO usuarios(USUARIO,EMAIL,NOMBRES,APELLIDOS,CONTRASEÑA,DNI,DIRECCION,CIUDAD,TELEFONO,ADMINIS) VALUES (:usuario,:email,:nombres,:apellidos,:contrasena_hash,:dni,:direccion,:ciudad,:telefono,1)");
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
    <div class="container_register">
        <div class="register">
            <form name="registerform" class="registerform" action="register.php" method="POST">
                <h1 class="loginform_titulo">Registro de Usuarios</h1>
                <div class="div_input">
                    <input type="text" name="nombres" id="nombres" class="input" size="32" placeholder="Nombres completos">
                </div>
                <div class="div_input">
                    <input type="text" name="apellidos" id="apellidos" class="input" size="32" placeholder="Apellidos completos">
                </div>
                <div class="div_input">
                    <input type="text" name="usuario" id="usuario" class="input" size="20" placeholder="Nombre de usuario">
                </div>
                <div class="div_input">
                    <input type="email" name="email" id="email" class="input" size="32" placeholder="Correo electrónico">
                </div>
                <div class="div_input">
                    <input type="number" name="dni" id="dni" class="input" size="32" placeholder="DNI">
                </div>
                <div class="div_input">
                    <input type="text" name="direccion" id="direccion" class="input" size="32" placeholder="Direccion domiciliaria">
                </div>
                <div class="div_input">
                    <input type="text" name="ciudad" id="ciudad" class="input" size="32" placeholder="Ciudad">
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