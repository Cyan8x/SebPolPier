<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../../CSS/login_px.css">
    <link rel="stylesheet" href="../../../../CSS/normalize.css">
    <link rel="shortcut icon" href="../../../../imagenes/S.jpg">
    <script src="https://kit.fontawesome.com/4c62087cc0.js" crossorigin="anonymous"></script>
    <title>Login de Administradores</title>
</head>

<body>
    <?php
    require_once("../../includes/connection.php");
    session_start();

    if (isset($_POST["login"])) {
        if (!empty($_POST['user_admin']) && !empty($_POST['contraseña'])) {
            $user_admin = $_POST['user_admin'];
            $contraseña = $_POST['contraseña'];
            $query = $connection->prepare("SELECT * FROM administradores WHERE USER_ADMIN=:user_admin");
            $query->bindParam("user_admin", $user_admin, PDO::PARAM_STR);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);
            if (!$result) {
                echo '<p class = "error">La combinacion del usuario y la contraseña son inválidos</p>';
            } else {
                if (password_verify($contraseña, $result['contraseña'])) {
                    $_SESSION['session_admin'] = $user_admin;
                    header("Location: ./index.php");
                } else {
                    $message = "Nombre de usuario o contraseña invalida";
                }
            }
        } else {
            $message = "Todos los campos deben ser llenados obligatioriamente";
        }
    }
    ?>
    <?php
    if (!empty($message)) {
        echo "<p class =\"error\">" . "MESSAGE: " . $message . "</p>";
    }
    ?>
    <div class="container_login">
        <div class="login">
            <form name="loginform" class="loginform" action="login_admin.php" method="POST">
                <h1 class="loginform_titulo">Login de Administradores</h1>
                <div class="div_input">
                    <input type="text" name="user_admin" id="user_admin" class="input" size="20" placeholder="Usuario de Administrador">
                </div>
                <div class="div_input">
                    <input type="password" name="contraseña" id="contraseña" class="input" size="20" placeholder="Contraseña">
                </div>
                <div class="submit">
                    <div class="submit_div">
                        <button type="submit" name="login" class="button" value="Ingresar">Ingresar</button>
                    </div>
                </div>
                <div class="regtext">
                    <p class="regtext_p">
                        <a href="../../../index.php">Pagina Principal de SebPolPier</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

</body>

</html>