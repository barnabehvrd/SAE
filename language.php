<?php
   session_start();
 
if (isset($_POST['language'])) {
    $_SESSION["language"] = $_POST['language'];
    header("Location: index.php");

} 
    if (isset($_SESSION["language"])) {
    switch ($_SESSION["language"]) {
        case 'fr':
            require "language_fr.php" ;
            break;

        case 'en':
            require "language_en.php" ;
            break;

        case 'es':
            require "language_es.php" ;
            break;

        case 'de':
            require "language_al.php" ;
            break;

        default:
        require "language_fr.php" ;
            break;
        }
    }else {
        require "language_fr.php" ;
 
    }

?>