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
    if (isset($_POST["login"])) {
        //SI SE LLEGA A RECIBIR UN DATOS AL PRESIONAR UN BOTON CON EL NOMBRE "LOGIN"
        if (!empty($_POST['usuario']) && !empty($_POST['contraseña'])) {
            //SI LOS CAMPOS RQUERIDOS PARA EL LOGIN DEL USUARIO NO ESTAN VACIOS, SE HACE LAS SIGUIENTE VERIFICACIONES
            $usuario = $_POST['usuario'];
            $contraseña = $_POST['contraseña'];
            $query = $connection->prepare("SELECT * FROM usuarios WHERE USUARIO=:usuario");
            $query->bindParam("usuario", $usuario, PDO::PARAM_STR);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);
            if (!$result) {
                echo '<p class = "error">Usuario no existe.</p>';
            } else {
                if (password_verify($contraseña, $result['contraseña'])) {
                    if ($result['adminis'] == 1) {
                        $_SESSION['session_admin'] = $usuario;
                        header("Location: ../../../../SebPolPier/PHP/Login/admin/Principal/index.php");
                    } else {
                        $_SESSION['session_usuario'] = $usuario;
                        header("Location: ../../../../SebPolPier/PHP/index.php");
                    }
                } else {
                    $message = "Contraseña invalida";
                }
            }
        } else {
            //SI LOS CAMPOS ESTAN VACIOS, SE MUESTRA UN MENSAJE DE ERROR
            $message = "Todos los campos deben ser llenados obligatioriamente";
        }
    }
    ?>
    <?php
    if (!empty($message)) {
        echo "<p class =\"error\">" . "MESSAGE: " . $message . "</p>";
    }
    ?>
    <!-- SE MUESTRA EL MISMO FORMULARIO QUE ESTABA EN EL ARCHIVO DE "index.html" -->
    <div class="container">
        <div class="form">
            <form name="loginform" action="login.php" method="POST">
                <h1>Login de Usuarios</h1>
                <div class="div_input">
                    <input type="text" name="usuario" id="usuario" placeholder="Nombre de Uusuario">
                </div>
                <div class="div_input">
                    <input type="password" name="contraseña" id="contraseña" placeholder="Contraseña">
                </div>
                <div class="submit">
                    <div>
                        <button type="submit" name="login" value="Ingresar">Ingresar</button>
                    </div>
                </div>
                <div class="regtext">
                    <p>
                        Si no tienes una cuenta, <a href="register.php">registrate dando clic aquí</a>
                    </p>
                    <p>
                        <a href="../../index.php">Pagina Principal de SebPolPier</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</body>

</html>