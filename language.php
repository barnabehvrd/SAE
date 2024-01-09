<?php
   session_start();
 
if (isset($_POST['language'])) {
    $_SESSION["language"] = $_POST['language'];
} 
    if (isset($_SESSION["language"])) {
    switch ($_SESSION["language"]) {
        case 'fr':
            require "language_fr.php" ;
            header("Location: index.php");
 
            break;

        case 'en':
            require "language_en.php" ;
            header("Location: index.php");
          
            break;

        case 'es':
            require "language_es.php" ;
            header("Location: index.php");
    
            break;

        case 'de':
            require "language_al.php" ;
            header("Location: index.php");

            break;

        default:
        require "language_fr.php" ;
        header("Location: index.php");

            break;
        }
    }else {
        require "language_fr.php" ;
        header("Location: index.php");
 
    }

?>