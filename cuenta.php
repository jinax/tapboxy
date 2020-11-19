<?php
require_once("config/DB.php");
session_start();

$error = "";
$errorborrar = "";
$mensaje = "";
if (!isset($_SESSION['nick'])) {
    $error = "Error - debe <a href='login.php'>identificarse</a>";
    die($error);
} else {
    $usuario = DB::obtieneDatosUsuario($_SESSION['nick']);

    if (isset($_POST['cambiopass'])) {
        $oldpass = trim($_POST['oldpass']);
        $sanitoldpass = filter_var($oldpass, FILTER_SANITIZE_STRING);
        if (DB::verificaUsuario($_SESSION['nick'], $sanitoldpass)){
            $passnueva = trim($_POST['newpass']);
            $sanitpassnueva = filter_var($passnueva, FILTER_SANITIZE_STRING);
            if(DB::cambiaContrasena($_SESSION['nick'], $sanitpassnueva)){
                $mensaje="contraseña cambiada con éxito!";
            }else{
                $error="error al cambiar la contraseña";
            }
        } else {
            $error = "password actual no es correcta";
        }
    }
    if (isset($_POST['borrarcuenta'])) {
        if(DB::borraUsuario($_SESSION['nick'])){
            session_unset();
            session_destroy();        
            header("Location: index.php");
        } else {
            $errorborrar="Ha ocurrido un error y la cuenta no pudo ser borrada!";
        }
    }
}
include_once("include/menu.php");
?>

<div class="container">
    <div class="cuenta">
    <h5>Cuenta de usuario</h5>
    <?php
    echo '<p>ID: ' . $usuario->getUsuarioID() . '<br />';
    echo 'Nombre: ' . $usuario->getNombre() . '<br />';
    echo 'Email: ' . $usuario->getEmail() . '<br />';
    echo 'Rol: ' . $usuario->getRol();
    echo '</p>'; 
    ?>
    </div>  
    <form class="form-cuenta" action="" method="post">
        <legend>Cambiar contraseña</legend>
        <div><span class="error"><?php echo $error; ?></span></div>
        <div class="form-group">
            <input type="password" class="form-control" name="oldpass" id="pass" placeholder="contraseña actual" required>
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="newpass" id="pass" placeholder="contraseña nueva" required>
        </div>
        <button type="submit" name="cambiopass" class="btn btn-primary">Cambiar</button>
        <div id="mensaje"><span><?php echo $mensaje; ?></span></div>
    </form>
    <form class="form-cuenta-borrar" action="" method="post">
        <legend>Borrar cuenta</legend>
        <small>
            Cuando borres tu cuenta perderás todos tus datos, se cerrará la conexión actual y serás redirigido a la página inicial. Para volver a entrar a la página tendrás que volver a darte de alta.
        </small> <br />

        <button type="submit" id="borraCuenta" name="borrarcuenta" class="btn btn-danger">Borrar</button>
        <div><span class="error"><?php echo $errorborrar; ?></span></div>
    </form>
</div>
<?php include_once("include/footer.php") ?>