<?php
// Détruisez toutes les variables de session
if (!isset($_SESSION)) {
    session_start();
}

// Détruisez la session
session_destroy();
header('Location: index.php');

?>