<?php
require_once("config/DB.php");
require_once("include/menuPrincipal.php");
// Comprobamos si ya se ha enviado el formulario
$error = "";
$mensaje = "";
if (isset($_POST['enviar'])) {
  if (empty($_POST['nick']) || empty($_POST['pass']) || empty($_POST['email'])) {
    $error = "Debes introducir todos los datos";
  } else {
    $email = trim($_POST['email']);
    $us = trim($_POST['nick']);
    $user = filter_var($us, FILTER_SANITIZE_STRING);
    $pa = trim($_POST['pass']);
    $pass = filter_var($pa, FILTER_SANITIZE_STRING);
    $seguir = true;

    if (DB::verificaNombre($user, 'Usuarios', 'Nombre')) {
      $seguir = false;
      $error = "Ya existe un usuario con este nombre.";
    }

    if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
      $seguir = false;
      $error = "El email no es válido.";
    }

    if ($seguir) {
      if (DB::altaUsuario($user, $pass, $email)) {
        $mensaje = '<p>Alta realizada con éxito!<p>
        <p><a href="login.php">Acceder a la página con contraseña</a></p>';
      } else {
        // Si los valores no son validos, informa del error.
        $error = "Ha ocurrido un error";
      }
    }
  }
}
?>

<div class="container" id="container_login">

  <form action="" class="form-alta" method="post">
    <fieldset>
      <legend>Formulário de registro</legend>
      <div><span class="error"><?php echo $error; ?></span></div>
      <div class="form-group row">
        <div class="col">
          <label for="nick">Nombre</label>
          <input type="text" class="form-control" name='nick' id="nick" placeholder="nombre" pattern="[a-zA-Z0-9-_]{4,20}" required>
        </div>
      </div>
      <div class="form-group row">
        <div class="col">
          <label for="email">Email</label>
          <input type="email" class="form-control" name='email' id="email" placeholder="email" pattern="[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?" required>
        </div>
      </div>
      <div class="form-group row">
        <div class="col">
          <label for="pass">Contraseña</label>
          <input type="password" class="form-control" name="pass" id="pass" placeholder="contraseña" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$" required>
          <!-- una mayuscula, minuscula, numero y puede haber caracteres especiales -->
          <small>La contraseña debe tener como mínimo 8 caracteres, una mayúscula, una minúscula, un número y puede tener caracteres especiales.</small>
        </div>
      </div>
      <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modalAlta" name="enviar">Enviar</button>
    </fieldset>
    <div id="mensaje"><span><?php echo $mensaje; ?></span></div>
  </form>
</div>

<?php include_once("include/footer.php") ?>