<?php
require_once('../config/DB.php');
require_once('../config/Caja.php');
session_start();
$cajas = DB::obtieneCajas($_SESSION["usuarioID"]);
$resultado = '';
if (count($cajas) > 0) {
    $resultado .= '<div class="div-wrap" id="caja-externa">';
    $resultado .= '<div class="container-cajas">';
    foreach ($cajas as $caja) {
        $idCaja = $caja->getCajaID();
        $_SESSION['idCaja'] = $idCaja;
        $nombreCaja = urlencode($caja->getCajaNombre());
        $_SESSION['nombreCaja'] = $nombreCaja;
        $tipo = $caja->getTipo();

        if ($tipo == 'Publica') {
            $resultado .= '<div class="divcaja publica cajaSencilla">';
        } else {
            $resultado .= '<div class="divcaja privada cajaSencilla">';
        }
        $resultado .= '<a href="verAudios.php?idCaja=' . $idCaja . '&nombreCaja=' . $nombreCaja . '" class="stretched-link">';
        $resultado .= '<p>' . $caja->getCajaNombre() . '</p>';
        $resultado .= '</a>';
        $resultado .= '</div>';
    }
    $resultado .= '</div>';
    $resultado .= '</div>';
    echo $resultado;
}
