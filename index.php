
<?php
session_start();
if (!isset($_SESSION['nick'])) {
    include_once("include/menuPrincipal.php");
} else {
    include_once("include/menu.php");
}

include_once("include/content.php");
include_once("include/footer.php");
?>