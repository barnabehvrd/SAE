<?php

require_once 'database/database.php';
use database\database;

require "language.php" ;



// Error handling with try-catch block
try {
    // Retrieve form data
    $pwd = $_POST['pwd'];
    $Mail_Uti = $_POST['mail'];

    // Handle password attempts
    if (!isset($_SESSION['test_pwd'])) {
        $_SESSION['test_pwd'] = 5;
    }

    // Connect to database
    $db = new database();

    // Check if user email exists
    $returnQueryIdUti = $db->select('SELECT Id_Uti FROM UTILISATEUR WHERE UTILISATEUR.Mail_Uti=:mail', [':mail' => $Mail_Uti]);
    
    // Handle invalid email
    if ($returnQueryIdUti == NULL) {
        unset($Id_Uti);
        $_SESSION['erreur'] = $htmlAdresseMailInvalide;
    } else {

    echo var_dump($returnQueryIdUti);

    // Extract user ID
    $Id_Uti = $returnQueryIdUti[0]["Id_Uti"];

    // On transforme Id_Uti en entier
    $Id_Uti = (int)$Id_Uti;
    
    // Verify password using stored procedure
    $test = $db->select('CALL verifMotDePasse(:Id_Uti, :pwd)', [':Id_Uti' => $Id_Uti, ':pwd' => $pwd]);

    echo "tesstttttttt";

    // Handle password verification
    if (isset($_SESSION['test_pwd']) && $_SESSION['test_pwd'] > -10) {
        if ((isset($test[0][1]) and $test[0][1] == 1) or (isset($test[0][0]) and $test[0][0] == 1)) {
            echo $htmlMdpCorrespondRedirectionAccueil;
            $_SESSION['Mail_Uti'] = $Mail_Uti;
            $_SESSION['Id_Uti'] = $Id_Uti;

            $returnIsProducteur = $db->select('CALL isProducteur(:Id_Uti)', [':Id_Uti' => $Id_Uti]);

            $reponse=$returnIsProducteur[0]["result"];
            if ($reponse!=NULL){
                $_SESSION["isProd"]=true;
            }else {
                $_SESSION["isProd"]=false;
            }
            $_SESSION['erreur'] = '';

            $returnIsAdmin = $db->select('SELECT Id_Uti FROM ADMINISTRATEUR WHERE Id_Uti=:Id_Uti', [':Id_Uti' => $Id_Uti]);
            
            if (count($returnIsAdmin)>0){
                $_SESSION["isAdmin"]=true;
            }else {
                $_SESSION["isAdmin"]=false;
            }
            $_SESSION['erreur'] = '';
        } else {
            $_SESSION['test_pwd']--;
            $_SESSION['erreur'] = $htmlMauvaisMdp . $_SESSION['test_pwd'] . $htmlTentatives;
        }
    }else {
        $_SESSION['erreur'] = $htmlErreurMaxReponsesAtteintes;
    }
    }
} catch (Exception $e) {
    // Handle any exceptions
    echo "An error occurred: " . $e->getMessage();
}