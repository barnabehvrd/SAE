<?php require "language.php"; ?>
<?php
require_once 'database/database.php';
use database\database;

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Définir les variables manquantes
$htmlAdresseMailInvalide = "Adresse e-mail invalide.";
$htmlMdpCorrespondRedirectionAccueil = "Mot de passe correct. Redirection vers l'accueil...";
$htmlMauvaisMdp = "Mot de passe incorrect. Tentatives restantes : ";
$htmlTentatives = " tentatives.";
$htmlErreurMaxReponsesAtteintes = "Nombre maximum de tentatives atteint. Veuillez réessayer plus tard.";

try {
    // Retrieve form data
    $pwd = $_POST['pwd'];
    $Mail_Uti = $_POST['mail'];
    echo "Form data retrieved: pwd = $pwd, mail = $Mail_Uti<br>";

    // Connect to database
    $db = new database();
    echo "Connected to database<br>";

    // Check if user email exists
    $returnQueryIdUti = $db->select('SELECT Id_Uti FROM UTILISATEUR WHERE UTILISATEUR.Mail_Uti=:mail', [':mail' => $Mail_Uti]);
    echo "Query executed: SELECT Id_Uti FROM UTILISATEUR WHERE Mail_Uti = $Mail_Uti<br>";

    // Handle invalid email
    if ($returnQueryIdUti == NULL) {
        unset($Id_Uti);
        $_SESSION['erreur'] = $htmlAdresseMailInvalide;
        echo "Invalid email: $Mail_Uti<br>";
    } else {
        // Extract user ID
        $Id_Uti = $returnQueryIdUti[0]["Id_Uti"];
        echo "User ID found: $Id_Uti<br>";

        // Vérifier si la dernière tentative date de plus de 30 minutes
        $userData = $db->select('SELECT date_derniere_tentative, nb_tentatives_echec FROM UTILISATEUR WHERE Id_Uti = :id', [':id' => $Id_Uti]);
        echo "User data retrieved: " . print_r($userData, true) . "<br>";

        // Réinitialiser le compteur si plus de 30 minutes se sont écoulées
        if (isset($userData[0]['date_derniere_tentative']) && $userData[0]['date_derniere_tentative'] != NULL) {
            $derniereTentative = strtotime($userData[0]['date_derniere_tentative']);
            $tempsEcoule = time() - $derniereTentative;
            echo "Time since last attempt: $tempsEcoule seconds<br>";

            // Si plus de 30 minutes se sont écoulées (1800 secondes)
            if ($tempsEcoule > 1800) {
                $db->query('UPDATE UTILISATEUR SET nb_tentatives_echec = 0 WHERE Id_Uti = :id', [':id' => $Id_Uti]);
                $userData[0]['nb_tentatives_echec'] = 0;
                echo "Attempt counter reset<br>";
            }
        }

        // Vérifier si le nombre de tentatives est inférieur à 5
        if (!isset($userData[0]['nb_tentatives_echec']) || $userData[0]['nb_tentatives_echec'] < 5) {
            // Récupération du mot de passe hashé dans la base de données
            $passwordData = $db->select('SELECT Pwd_Uti FROM UTILISATEUR WHERE Id_Uti = :id', [':id' => $Id_Uti]);
            echo "Password data retrieved: " . print_r($passwordData, true) . "<br>";

            // Vérification du mot de passe avec password_verify
            if (!empty($passwordData) && password_verify($pwd, $passwordData[0]['Pwd_Uti'])) {
                // Mot de passe correct, réinitialiser le compteur
                $db->query('UPDATE UTILISATEUR SET nb_tentatives_echec = 0 WHERE Id_Uti = :id', [':id' => $Id_Uti]);
                echo "Password correct<br>";

                echo $htmlMdpCorrespondRedirectionAccueil;
                $_SESSION['Mail_Uti'] = $Mail_Uti;
                $_SESSION['Id_Uti'] = $Id_Uti;

                $returnIsProducteur = $db->select('CALL isProducteur(:Id_Uti)', [':Id_Uti' => $Id_Uti]);
                $reponse = $returnIsProducteur[0]["result"];
                echo "Is producteur: " . print_r($reponse, true) . "<br>";

                if ($reponse != NULL) {
                    $_SESSION["isProd"] = true;
                } else {
                    $_SESSION["isProd"] = false;
                }

                $_SESSION['erreur'] = '';
                header('Location: ../index.php');
            } else {
                // Mot de passe incorrect, incrémenter le compteur
                $db->select('UPDATE UTILISATEUR SET 
                    nb_tentatives_echec = COALESCE(nb_tentatives_echec, 0) + 1,
                    date_derniere_tentative = NOW() 
                    WHERE Id_Uti = :id', [':id' => $Id_Uti]);
                echo "Password incorrect<br>";

                // Récupérer le nombre de tentatives restantes
                $tentativesRestantes = 5 - ((isset($userData[0]['nb_tentatives_echec']) ? $userData[0]['nb_tentatives_echec'] : 0) + 1);
                $_SESSION['erreur'] = $htmlMauvaisMdp . $tentativesRestantes . $htmlTentatives;
                echo "Remaining attempts: $tentativesRestantes<br>";
            }
        } else {
            $_SESSION['erreur'] = $htmlErreurMaxReponsesAtteintes;
            echo "Maximum attempts reached<br>";
        }
    }
} catch (Exception $e) {
    // Handle any exceptions
    echo "An error occurred: " . $e->getMessage();
}
?>



<?php
/* <<< HEAD
        // Vérifier si la dernière tentative date de plus de 30 minutes
        $resetTimeQuery = $bdd->query('SELECT date_derniere_tentative, nb_tentatives_echec FROM UTILISATEUR WHERE Id_Uti = ' . $Id_Uti);
        $userData = $resetTimeQuery->fetch(PDO::FETCH_ASSOC);

        // Réinitialiser le compteur si plus de 30 minutes se sont écoulées
        if ($userData['date_derniere_tentative'] != NULL) {
            $derniereTentative = strtotime($userData['date_derniere_tentative']);
            $tempsEcoule = time() - $derniereTentative;

            // Si plus de 30 minutes se sont écoulées (1800 secondes)
            if ($tempsEcoule > 1800) {
                $bdd->query('UPDATE UTILISATEUR SET nb_tentatives_echec = 0 WHERE Id_Uti = ' . $Id_Uti);
                $userData['nb_tentatives_echec'] = 0;
            }
===
    // Extract user ID
    $Id_Uti = $returnQueryIdUti[0]["Id_Uti"];

    // Verify password using stored procedure
    $test = $db->select('CALL verifMotDePasse(:Id_Uti, :pwd)', [':Id_Uti' => $Id_Uti, ':pwd' => $pwd]);

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
                header('Location: ../panel_admin.php');
            }else {
                $_SESSION["isAdmin"]=false;
                header('Location: ../index.php');
            }

            $_SESSION['erreur'] = '';
        } else {
            $_SESSION['test_pwd']--;
            $_SESSION['erreur'] = $htmlMauvaisMdp . $_SESSION['test_pwd'] . $htmlTentatives;
>>> main */
?>



