<?php
require_once("config/DB.php");
require_once("config/Caja.php");

session_start();
if (!isset($_SESSION['nick'])) {
    include_once("include/menuPrincipal.php");
}else{
    include_once("include/menu.php");
}

$mensaje = "";
$resBusqueda = "";
if (isset($_POST['campobuscar']) || isset($_POST['botonbuscar'])) {
    $busqueda = trim($_POST['campobuscar']);
    $sanitbusqueda = filter_var($busqueda, FILTER_SANITIZE_STRING);
    $cajasBusqueda = DB::obtieneBusquedaCajas($sanitbusqueda);
    if (count($cajasBusqueda) > 0) {
        $resBusqueda .= '<div class="div-wrap" id="caja-externa">';
        $resBusqueda .= '<div class="container-cajas">';
        foreach ($cajasBusqueda as $caja) {
            $idCajaBusqueda = $caja->getCajaID();
            $nombreCajaBusqueda = urlencode($caja->getCajaNombre());
            $tipo = $caja->getTipo();
            $resBusqueda .= '<div class="divcaja publica cajaSencilla">';
            $resBusqueda .= '<a href="verAudioBusqueda.php?idCajaBusqueda=' . $idCajaBusqueda . '&nombreCajaBusqueda=' . $nombreCajaBusqueda . '" class="stretched-link">';
            $resBusqueda .= '<p>' . $caja->getCajaNombre() . '</p>';
            $resBusqueda .= '</a>';
            $resBusqueda .= '</div>';
        }
        $resBusqueda .= '</div>';
        $resBusqueda .= '</div>';
    } else {
        $resBusqueda = '<div class="div-wrap" id="caja-externa">no se ha encontrado ninguna caja pública con estos términos!</div>';
    }
}
?>

<!-- visualizar aquí las cajas existentes -->
<div id="innercaja">
    <?php echo $resBusqueda ?>;
</div>

<?php include_once("include/footer.php") ?>