<?php
    // Recuperamos la información de la sesión
    session_start();   
    // Y la eliminamos
    session_unset();
    session_destroy();
    header("Location: index.php");
?>