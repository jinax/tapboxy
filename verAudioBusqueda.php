<?php
require_once("config/DB.php");
require_once("config/Audio.php");
session_start();
if (!isset($_SESSION['nick'])) {
    include_once("include/menuPrincipal.php");
} else {
    include_once("include/menu.php");
}
$resultadoAudio = "";
$nombreCajaBusqueda = urldecode($_GET['nombreCajaBusqueda']);
$idCajaBusqueda = urldecode($_GET['idCajaBusqueda']);
$audiosBusqueda = DB::obtieneAudios($idCajaBusqueda);

if (count($audiosBusqueda) > 0) {
    $resultadoAudio .= '<div class="div-wrap">';
    $resultadoAudio .= '<div class="divcaja">';
    $resultadoAudio .= '<div class="caja-titulo">' . $nombreCajaBusqueda . '</div>';
    $resultadoAudio .= '<div class="caja-cuerpo pads">';

    foreach ($audiosBusqueda as $audio) {
        $resultadoAudio .= '<div class="pad">';
        $resultadoAudio .= '<p>' . $audio->getAudioNombre() . '</p>';
        $resultadoAudio .= '<audio class="sound" src="assets/audio/' . $audio->getDireccion() . '"></audio>';
        $resultadoAudio .= '</div>';
    }
    $resultadoAudio .= '</div>';
    $resultadoAudio .= '</div>';
    $resultadoAudio .= '</div>';
}
?>

<!-- visualizar aquí audios existentes -->
<div id="inneraudio">
    <?php echo $resultadoAudio; ?>
</div>
<hr>
<?php include_once("include/footer.php") ?>