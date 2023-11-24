<?php


// Error handling with try-catch block
try {
    // Retrieve form data
    $pwd = $_POST['pwd'];
    $Mail_Uti = $_POST['mail'];

    // Start session
    session_start();

    // Handle password attempts
    if (!isset($_SESSION['test_pwd'])) {
        $_SESSION['test_pwd'] = 5;
    }

    // Database connection
    $utilisateur = "inf2pj02";
    $serveur = "localhost";
    $motdepasse = "ahV4saerae";
    $basededonnees = "inf2pj_02";

    // Connect to database
    $bdd = new PDO('mysql:host=' . $serveur . ';dbname=' . $basededonnees, $utilisateur, $motdepasse);

    // Check if user email exists
    $query = $bdd->query('SELECT Id_Uti FROM UTILISATEUR WHERE UTILISATEUR.Mail_Uti=\'' . $Mail_Uti . '\'');
    $Id_Uti = $query->fetchAll(PDO::FETCH_ASSOC);

    // Handle invalid email
    if ($Id_Uti == NULL) {
        unset($Id_Uti);
        header('Location: form_sign_in.php?mail=adresse mail invalide');
        exit();
    } else {

    // Extract user ID
    $Id_uti = $Id_Uti[0]["Id_Uti"];
    
    // Verify password using stored procedure
    //echo('CALL verifMotDePasse(' . $Id_uti . ', \'' . $pwd . '\');');
    $query = $bdd->query('CALL verifMotDePasse(' . $Id_uti . ', \'' . $pwd . '\')');

    $test = $query->fetchAll(PDO::FETCH_ASSOC);

    // Handle password verification
    if (isset($_SESSION['test_pwd']) && $_SESSION['test_pwd'] > 1) {
        if ($test[0][1] == 1) {
            // Successful login
            echo "Le mot de passe correspond. Vous allez etre redirigé vers la page d'accueil";
            $_SESSION['Mail_Uti'] = $Mail_Uti;
            $_SESSION['Id_Uti'] = $Id_Uti;
            header('Location: index.php');
        } else {
            // Incorrect password
            $_SESSION['test_pwd']--;
            header('Location: form_sign_in.php?pwd=mauvais mot de passe il vous restes ' . $_SESSION['test_pwd'] . ' tentative(s)');
        }
    }else {
        header('Location: form_sign_in.php?pwd=vous avez épuisé toutes vos tentatives de connection');
    }
    }
} catch (Exception $e) {
    // Handle any exceptions
    echo "An error occurred: " . $e->getMessage();
    exit();
}