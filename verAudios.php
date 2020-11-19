<?php
require_once("config/DB.php");
require_once("config/Audio.php");

// Recuperamos la información de la sesión

session_start();
$error = "";
$errorborrar = "";
$nombreCaja = "";
$idCaja = "";

$src = 'assets/audio/';
$mensaje = "";
$mensajeborrado = "";

$nombreCaja = urldecode($_GET['nombreCaja']);
$idCaja = urldecode($_GET['idCaja']);

$_SESSION['nombreCaja'] = $nombreCaja;
$_SESSION['idCaja'] = $idCaja;


// Y comprobamos que el usuario se haya autentificado
if (!isset($_SESSION['nick'])) {
    $error = "Error - debe <a href='login.php'>identificarse</a>";
    die($error);
} else {
    if (isset($_POST['subeAudio']) && (isset($_FILES['audio']))) {
        $error = "";
        $subidaOK = true;
        $audioNombre = $_POST['nombreAudio'];
        $archivoNombre = $_FILES['audio']['name'];
        $audioSize = $_FILES['audio']['size'];
        $audioTmp = $_FILES['audio']['tmp_name'];
        $audioType = $_FILES['audio']['type'];
        $archivoNombreCmps = explode(".", $archivoNombre);
        $audioExt = strtolower(end($archivoNombreCmps));
        $extensions = array("mp3", "wav", "ogg");
        $archivoUrl = md5(time() . $archivoNombre) . '.' . $audioExt;

        if (in_array($audioExt, $extensions) === false) {
            $error .= 'Extensión no soportada, debe ser un audio mp3, wav o ogg. ';
            $subidaOK = false;
        }

        if ($audioSize > 1048576) {
            $error .= 'El archivo debe pesar menos de 1 MB. ';
            $subidaOK = false;
        }

        if ($error == "") {
            if (!move_uploaded_file($audioTmp, 'assets/audio/' . $archivoUrl)) {
                $subidaOK = false;
            }
            if (DB::verificaNombre($audioNombre, 'Audios', 'AudioNombre')) {
                $error .= "Ya existe un audio con este nombre.";
            }else{
                if ($subidaOK && DB::subeAudio($idCaja, $audioNombre, $archivoUrl)) {
                    $mensaje = '<p>Audio ' . $audioNombre . ' creado con éxito!<p>';
                } else {
                    // Si los valores no son validos, informa del error.
                    $error .= 'Ha ocurrido un error. ';
                }
            }   
        }
    }
    if (isset($_POST['borraAudio']) && (isset($_POST['nombreAudioBorrar']))) {
        $nombreAudioBorrar = trim($_POST['nombreAudioBorrar']);
        $audioABorrar = DB::obtieneAudioBorrar($nombreAudioBorrar);
        $audioArchivoDir = $audioABorrar->getDireccion();
        $audioUrl = $src . $audioArchivoDir;
        if (DB::verificaNombre($nombreAudioBorrar, 'Audios', 'AudioNombre')) {            
            if (DB::borraAudio($nombreAudioBorrar)) {
                if(unlink($audioUrl)){
                    $mensajeborrado = '<p>Audio ' . $nombreAudioBorrar . ' borrado con éxito!<p>';
                } else {
                    $mensajeborrado = '<p>Audio ' . $nombreAudioBorrar . ' borrado de la base de datos con éxito! Pero el archivo en si no fue borrado<p>';
                }
            } else {
                // Si los valores no son validos, informa del error.
                $errorborrar = "Ha ocurrido un error al borrar";
            }
        } else{
            $errorborrar = 'El nombre ' . $nombreAudioBorrar . ' no existe!';
        }
        
    }
}
?>

<?php include_once("include/menu.php") ?>

<!-- visualizar aquí audios existentes -->
<div id="inneraudio">
</div>

<hr>

<!-- formularios -->
<div class="container">
    <form class="form-audio" action="" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>Subir nuevo audio</legend>
            <div><span class="error"><?php echo $error; ?></span></div>
            <div class="form-group">
                <input type="file" class="form-control-file" name='audio' id="subeAudio" placeholder="audio" required>
                <small id="fileHelp" class="form-text text-muted">Puedes subir archivos de tipo mp3, wav, ogg de menos de 1MB</small>
            </div>
            <div class="form-group row">
                <div class="col">
                    <input type="text" class="form-control" name='nombreAudio' id="nombreAudio" placeholder="nombre del audio" required>
                </div>
            </div>
            <button type="submit" class="btn btn-success" name="subeAudio" id="subirAudioId">Subir</button>
        </fieldset>
        <div id="mensaje"><span><?php echo $mensaje; ?></span></div>
    </form>
    <form class="form-audio-borrar" action="" method="post">
        <fieldset>
            <legend>Borrar audio</legend>
            <div><span class="error"><?php echo $errorborrar; ?></span></div>
            <div class="form-group row">
                <div class="col">
                    <input type="text" class="form-control " name='nombreAudioBorrar' id="nombreAudioBorrar" placeholder="nombre del audio" required>
                </div>
            </div>
            <button type="submit" class="btn btn-danger" name="borraAudio" id="borrarAudioId">Borrar</button>
        </fieldset>
        <div id="mensaje"><span><?php echo $mensajeborrado; ?></span></div>
    </form>
</div>

<script>

    $(document).ready(function() {
        let nombreCaja = "<?php echo $nombreCaja; ?>";
        let idCaja = "<?php echo $idCaja; ?>";
        let urlHelper = "helpers/helperAudios.php?idCaja=" + idCaja + "&nombreCaja=" + nombreCaja; 
        $.ajax({
            type: 'GET',
            url: urlHelper,
            success: function(result) {
                $("#inneraudio").html(result);
                const sounds = document.querySelectorAll(".sound");
                const pads = document.querySelectorAll(".pads div");
                pads.forEach((pad, index) => {
                    pad.addEventListener("click", function() {
                        sounds[index].currentTime = 0;
                        sounds[index].play();
                    });
                });
            },
            error: function() {
                alert("error");
            }
        });
    });

</script>
<?php include_once("include/footer.php") ?>