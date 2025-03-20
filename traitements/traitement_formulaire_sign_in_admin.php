<?php

require_once 'database/database.php';
use database\database;

$db = new database();

// Error handling with try-catch block
try {
    // Retrieve form data
    $pwd = $_POST['pwd'];
    $Mail_Uti = $_POST['mail'];

    // Handle password attempts
    if (!isset($_SESSION['test_pwd'])) {
        $_SESSION['test_pwd'] = 5;
    }


    $returnQueryIdUti = $db->select('SELECT Id_Uti FROM UTILISATEUR WHERE UTILISATEUR.Mail_Uti=:Mail_Uti', array('Mail_Uti' => $Mail_Uti));

    // Handle invalid email
    if ($returnQueryIdUti == NULL) {
        unset($Id_Uti);
        $_SESSION['erreur'] = $htmlAdresseMailInvalide;
    } else {

    // Extract user ID
    $Id_Uti = $returnQueryIdUti[0]["Id_Uti"];

    $test = $db->select('CALL verifMotDePass(:Id_Uti, :pwd)', array('Id_Uti' => $Id_Uti, 'pwd' => $pwd));

    // Handle password verification
    if (isset($_SESSION['test_pwd']) && $_SESSION['test_pwd'] > 1) {
        if ((isset($test[0][1]) and $test[0][1] == 1) or (isset($test[0][0]) and $test[0][0] == 1)) {

            $returnQueryIdAdmin = $db->select('SELECT Id_Uti FROM ADMINISTRATEUR WHERE ADMINISTRATEUR.Id_Uti=:Id_Uti', array('Id_Uti' => $Id_Uti));

            if(($returnQueryIdAdmin)==null){
                echo ("
                <title>".$htmlErreur403."</title>
                <h1>".$htmlErreur403."</h1>
                <p>".$htmlPasAcces."</p>
                " );
            }else {
                $_SESSION['Mail_Uti'] = $Mail_Uti;
                $_SESSION['Id_Uti'] = $Id_Uti;
                $_SESSION['erreur'] = '';
                header('Location: ../panel_admin.php');
            }
        } else {
            $_SESSION['test_pwd']--;
            $_SESSION['erreur'] = $htmlMauvaisMdp.  $_SESSION['test_pwd'] .$htmlTentatives;
        }
    }else {
        $_SESSION['erreur'] = $htmlErreurMaxReponsesAtteintes;
    }
    }
} catch (Exception $e) {
    // Handle any exceptions
    echo "An error occurred: " . $e->getMessage();
}