<?php
require 'assets/db/config.php';
if (isset($_POST['login'])) {
    $errMsg = '';

    // Obtener datos del FORMULARIO
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave']; // No encriptar aquí, solo obtener la entrada del usuario

    if ($usuario == '') {
        $errMsg = 'Escriba su usuario';
    }
    if ($clave == '') {
        $errMsg = 'Escriba su contraseña';
    }

    if ($errMsg == '') {
        try {
            $stmt = $connect->prepare('SELECT id, nombre, usuario, clave, cargo, "usuarios" AS tipo FROM usuarios WHERE usuario = :usuario UNION SELECT codpaci, nombrep AS nombre, usuario, clave, cargo, "customers" AS tipo FROM customers WHERE usuario = :usuario');
            
            $stmt->execute(array(':usuario' => $usuario));
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($data == false) {
                $errMsg = "Usuario $usuario no encontrado.";
            } else {
                // Comparar contraseña dependiendo del tipo de hash
                if ($data['tipo'] == "usuarios" && md5($clave) == $data['clave']) {
                    // Usuarios: Comparar con MD5
                    loginSuccessful($data);
                } elseif ($data['tipo'] == "customers" && password_verify($clave, $data['clave'])) {
                    // Customers: Comparar con password_hash()
                    loginSuccessful($data);
                } else {
                    $errMsg = 'Contraseña incorrecta.';
                }
            }
        } catch (PDOException $e) {
            $errMsg = $e->getMessage();
        }
    }
}

function loginSuccessful($data) {
    session_start();
    $_SESSION['id'] = $data['id'];
    $_SESSION['nombre'] = $data['nombre'];
    $_SESSION['usuario'] = $data['usuario'];
    $_SESSION['clave'] = $data['clave'];
    $_SESSION['cargo'] = $data['cargo'];
    $_SESSION['tipo'] = $data['tipo']; 

    if ($_SESSION['cargo'] == 1) {
        header('Location: view/admin/admin.php');
    } else if ($_SESSION['cargo'] == 2) {
        header('Location: view/user/user.php');
    }

    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/css/all.min.css">
    <link rel="stylesheet" href="assets/css/sweetalert.css">
    <link rel="icon" href="assets/img/logo.png" type="image/x-icon"/>
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
</head>
<body>
    <div class="contenedor">
        <div class="img">
            <img src="assets/img/bg.svg" alt="">
        </div>
        <div class="contenido-login">
            <form autocomplete="off" method="POST" role="form">
                <img src="assets/img/logo.jpg" alt="Logo" style="height: 200px;">
                <h2 style="font-size: 20px;">Login</h2>
                <?php
                if (isset($errMsg)) {
                    echo '<div style="color:#FF0000;text-align:center;font-size:20px;">'.$errMsg.'</div>';  
                }
                ?>
                <div class="input-div nit">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <input type="text" name="usuario" value="<?php if(isset($_POST['usuario'])) echo $_POST['usuario'] ?>" autocomplete="off" placeholder="USUARIO">
                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <input type="password" required="true" name="clave" placeholder="CONTRASEÑA">
                    </div>
                </div>
                <button class="btn" name='login' type="submit"> Iniciar sesion </button>
                <a href="./Recuperar.php">¿Olvidaste tu contraseña?</a>
            </form>
            <div id="msg_error" class="alert alert-danger" role="alert" style="display: none"></div>
        </div>
    </div>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/sweetalert.min.js"></script>
</body>
</html>
