
<?php
require_once('../config/DB.php');
require_once('../config/Audio.php');
session_start();

$nombreCajaAjax = $_GET['nombreCaja'];
$idCajaAjax = $_GET['idCaja'];
$audios = DB::obtieneAudios($idCajaAjax);
$resultado = '';

if (count($audios) > 0) {
    $resultado .= '<div class="div-wrap">';
    $resultado .= '<div class="divcaja">';
    $resultado .= '<div class="caja-titulo">' . $nombreCajaAjax . '</div>';
    $resultado .= '<div class="caja-cuerpo pads">';

    foreach ($audios as $audio) {
        $resultado .= '<div class="pad">';
        $resultado .= '<p>' . $audio->getAudioNombre() . '</p>';
        $resultado .= '<audio class="sound" src="assets/audio/' . $audio->getDireccion() . '"></audio>';
        $resultado .= '</div>';
    }
    $resultado .= '</div>';
    $resultado .= '</div>';
    $resultado .= '</div>';
}
echo $resultado;

?>