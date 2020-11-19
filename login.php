<?php
require_once("config/DB.php");
session_start();
$error = "";

if (isset($_SESSION['nick'])) {  
    header("Location: verCajas.php");
}

// Comprobamos si ya se ha enviado el formulario
if (isset($_POST['enviar'])) {
    $error = "";
    if (empty($_POST['nick']) || empty($_POST['pass'])) {
        $error = "Debes introducir un nombre de usuario y una contraseña";
    } else {
        // Comprobamos las credenciales con la base de datos
        $nombreUsu = trim($_POST['nick']);
        $nombreSanit = filter_var($nombreUsu, FILTER_SANITIZE_STRING);
        $pass = trim($_POST['pass']);
        $passSanit = filter_var($pass, FILTER_SANITIZE_STRING);
        if (DB::verificaUsuario($nombreSanit, $passSanit)) {
            $_SESSION['nick'] = $nombreSanit;
            header("Location: verCajas.php");
        } else {
            // Si las credenciales no son válidas, se vuelven a pedir
            $error = "Usuario o contraseña no válidos!";
        }
    }
}
?>
<?php include_once("include/menuPrincipal.php") ?>
<div class="container" id="container_login">
    
    <form class="form-login"  action="" method="post">
    <legend>Login</legend>
        <div><span class="error"><?php echo $error; ?></span></div>
        <div class="form-group">
            <label for="nick">Nombre</label>
            <input type="text" class="form-control" name="nick" id="nick" placeholder="nombre">
        </div>
        <div class="form-group">
            <label for="pass">Contraseña</label>
            <input type="password" class="form-control" name="pass" id="pass" placeholder="contraseña">
        </div>
        <button type="submit" name="enviar" class="btn btn-primary">Entrar</button>
        <p id="altafrase"><a href="alta.php">darse de alta</a></p>
    </form>
    <br>
    
</div>
<?php include_once("include/footer.php") ?>