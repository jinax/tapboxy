<?php
require_once("config/DB.php");
require_once("config/Caja.php");
session_start();
$error = "";
$errorborrar = "";
$mensaje = "";
$mensajeborrado = "";
// Y comprobamos que el usuario se haya autentificado
if (!isset($_SESSION['nick'])) {
    $error = "Error - debe <a href='login.php'>identificarse</a>";
    die($error);
} else {
    $usu = DB::obtieneDatosUsuario($_SESSION['nick']);
    $_SESSION['usuarioID'] = (int) $usu->getUsuarioId();

    if (isset($_POST['creaCaja'])) {
        $tipocaja = '';
        $nombreCaj = trim($_POST['nombreCaja']);
        $nombreCaja = filter_var($nombreCaj, FILTER_SANITIZE_STRING);
        if ($_POST['tipo'] == 'Privada') {
            $tipocaja = 'Privada';
        } else {
            $tipocaja = 'Publica';
        }
        if (DB::verificaNombre($nombreCaja, 'Cajas', 'CajaNombre')) {
            $error = "Ya existe una caja con este nombre.";
        } else {
            if (DB::creaCaja($_SESSION['usuarioID'], $nombreCaja, $_POST['tags'], $tipocaja)) {
                $mensaje = '<p>Caja ' . $nombreCaja . ' creada con éxito!<p>';
            } else {
                // Si los valores no son validos, informa del error.
                $error = "Ha ocurrido un error";
            }
        }
    }
    if (isset($_POST['borraCaja']) && isset($_POST['nombreCajaBorrar'])) {
        $nombreCajaBorra = trim($_POST['nombreCajaBorrar']);
        $nombreCajaBorrar = filter_var($nombreCajaBorra, FILTER_SANITIZE_STRING);
        if (DB::verificaNombre($nombreCajaBorrar, 'Cajas', 'CajaNombre')) {
            if (DB::borraCaja($nombreCajaBorrar)) {
                $mensajeborrado = '<p>Caja ' . $nombreCajaBorrar . ' borrada con éxito!<p>';
            } else {
                // Si los valores no son validos, informa del error.
                $errorborrar = "Ha ocurrido un error al borrar";
            }
        } else {
            $errorborrar = "Esa caja no existe. No se puede borrar";
        }      
    }
}
?>

<?php include_once("include/menu.php") ?>

<!-- visualizar aquí las cajas existentes -->
<div id="innercaja">
</div>
<hr>
<!-- formularios -->
<div class="container">
    <form class="form-caja" action="" method="post">
        <fieldset>
            <legend>Nueva caja</legend>
            <div><span class="error"><?php echo $error; ?></span></div>
            <div class="form-group row">
                <div class="col">
                    <input type="text" class="form-control " name='nombreCaja' id="nombreCaja" placeholder="nombre de la caja" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col">
                    <input type="text" class="form-control " name='tags' id="tags" placeholder="etiqueta">
                </div>
            </div>
            <fieldset class="form-group">
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="tipo" id="Privada" value="Privada" checked="checked">
                        Privada
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="tipo" id="Publica" value="Publica">
                        Pública
                    </label>
                </div>
            </fieldset>
            <button type="submit" class="btn btn-success" name="creaCaja" id="creaCajaId">Crear</button>
        </fieldset>
        <div id="mensaje"><span><?php echo $mensaje; ?></span></div>
    </form>
    <form class="form-caja-borrar" action="" method="post">
        <fieldset>
            <legend>Borrar caja</legend>
            <div><span class="error"><?php echo $errorborrar; ?></span></div>
            <div class="form-group row">
                <div class="col">
                    <input type="text" class="form-control " name='nombreCajaBorrar' id="nombreCajaBorrar" placeholder="nombre de la caja" required>
                </div>
            </div>
            <button type="submit" class="btn btn-danger" name="borraCaja" id="borraCajaId">Borrar</button>
        </fieldset>
        <div id="mensaje"><span><?php echo $mensajeborrado; ?></span></div>
    </form>

</div>
<script>

$(document).ready(function() {
  $.ajax({
      url: "helpers/helperCajas.php",
      success: function(result) {
          $("#innercaja").html(result);
      }     
  });
});
</script>
<?php include_once("include/footer.php") ?>