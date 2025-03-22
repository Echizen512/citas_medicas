<?php
require 'assets/db/config.php';
if (isset($_POST['recuperar'])) {
    $errMsg = '';


    $usuario = $_POST['usuario'];
    $nueva_clave = $_POST['nueva_clave'];

    if ($usuario == '') {
        $errMsg = 'Digite su usuario';
    }
    if ($nueva_clave == '') {
        $errMsg = 'Digite la nueva contraseña';
    }

    if ($errMsg == '') {
        try {
            // Verificar si el usuario existe en las tablas
            $stmt = $connect->prepare('SELECT id, clave FROM usuarios WHERE usuario = :usuario UNION SELECT codpaci, clave FROM customers WHERE usuario = :usuario');
            $stmt->execute(array(':usuario' => $usuario));
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($data == false) {
                $errMsg = 'Usuario incorrecto.';
            } else {
                // Actualizar la contraseña en ambas tablas si es necesario
                $hashed_password = password_hash($nueva_clave, PASSWORD_DEFAULT);
                
                // Actualizar en la tabla 'usuarios'
                $update_stmt = $connect->prepare('UPDATE usuarios SET clave = :clave WHERE usuario = :usuario');
                $update_stmt->execute(array(':clave' => $hashed_password, ':usuario' => $usuario));
                
                // Actualizar en la tabla 'customers'
                $update_stmt_customers = $connect->prepare('UPDATE customers SET clave = :clave WHERE usuario = :usuario');
                $update_stmt_customers->execute(array(':clave' => $hashed_password, ':usuario' => $usuario));

                $successMsg = 'Contraseña actualizada con éxito.';
            }
        } catch (PDOException $e) {
            $errMsg = $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>Recuperar Contraseña</title>
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
                <img src="assets/img/logo.jpg" alt="Logo" style="height: 180px;">
                <h2 style="font-size: 20px;">Recuperar Contraseña</h2>
                <?php
                if (isset($errMsg)) {
                    echo '<div style="color:#FF0000;text-align:center;font-size:20px;">'.$errMsg.'</div>';  
                }
                if (isset($successMsg)) {
                    echo '<div style="color:#00FF00;text-align:center;font-size:20px;">'.$successMsg.'</div>';
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
                        <input type="password" required="true" name="nueva_clave" placeholder="NUEVA CONTRASEÑA">
                    </div>
                </div>
                <button class="btn" name='recuperar' type="submit">Actualizar Contraseña</button>
                <a href="./login.php">Volver al Login</a>
            </form>
            <div id="msg_error" class="alert alert-danger" role="alert" style="display: none"></div>
        </div>
    </div>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/sweetalert.min.js"></script>
</body>
</html>
