<?php
   
 
// Récupère la langue sélectionnée depuis le formulaire
if (isset($_POST['language']) || isset($_SESSION["language"])) {
    $_SESSION["language"] = $_POST['language'];

    // Utilisez une structure de commutation pour gérer différentes langues
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
} else {
    require "language_fr.php" ; }
?>
