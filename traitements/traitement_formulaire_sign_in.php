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

    // Connect to database
    $db = new database();

    // Check if user email exists
    $returnQueryIdUti = $db->select('SELECT Id_Uti FROM UTILISATEUR WHERE UTILISATEUR.Mail_Uti=:mail', [':mail' => $Mail_Uti]);

    // Handle invalid email
    if ($returnQueryIdUti == NULL) {
        unset($Id_Uti);
        $_SESSION['erreur'] = $htmlAdresseMailInvalide;
    } else {
        // Extract user ID
        $Id_Uti = $returnQueryIdUti[0]["Id_Uti"];

        // Vérifier si la dernière tentative date de plus de 30 minutes
        $userData = $db->select('SELECT date_derniere_tentative, nb_tentatives_echec FROM UTILISATEUR WHERE Id_Uti = :id', [':id' => $Id_Uti]);

        // Réinitialiser le compteur si plus de 30 minutes se sont écoulées
        if (isset($userData[0]['date_derniere_tentative']) && $userData[0]['date_derniere_tentative'] != NULL) {
            $derniereTentative = strtotime($userData[0]['date_derniere_tentative']);
            $tempsEcoule = time() - $derniereTentative;

            // Si plus de 30 minutes se sont écoulées (1800 secondes)
            if ($tempsEcoule > 1800) {
                $db->query('UPDATE UTILISATEUR SET nb_tentatives_echec = 0 WHERE Id_Uti = :id', [':id' => $Id_Uti]);
                $userData[0]['nb_tentatives_echec'] = 0;
            }
        }

        // Vérifier si le nombre de tentatives est inférieur à 5
        if (!isset($userData[0]['nb_tentatives_echec']) || $userData[0]['nb_tentatives_echec'] < 5) {
            // Récupération du mot de passe hashé dans la base de données
            $passwordData = $db->select('SELECT Pwd_Uti FROM UTILISATEUR WHERE Id_Uti = :id', [':id' => $Id_Uti]);

            // Vérification du mot de passe avec password_verify
            if (!empty($passwordData) && password_verify($pwd, $passwordData[0]['Pwd_Uti'])) {
                // Mot de passe correct, réinitialiser le compteur
                $db->query('UPDATE UTILISATEUR SET nb_tentatives_echec = 0 WHERE Id_Uti = :id', [':id' => $Id_Uti]);

                $_SESSION['Mail_Uti'] = $Mail_Uti;
                $_SESSION['Id_Uti'] = $Id_Uti;

                $returnIsProducteur = $db->select('CALL isProducteur(:Id_Uti)', [':Id_Uti' => $Id_Uti]);
                $reponse = $returnIsProducteur[0]["result"];

                if ($reponse != NULL) {
                    $_SESSION["isProd"] = true;
                } else {
                    $_SESSION["isProd"] = false;
                }

                $_SESSION['erreur'] = '';
                header('Location: ../index.php');
                exit(0); // pk ca quitte pas la pop up ? ils ont fait quoi avec leur code ?
            } else {
                // Mot de passe incorrect, incrémenter le compteur
                $db->select('UPDATE UTILISATEUR SET 
                    nb_tentatives_echec = COALESCE(nb_tentatives_echec, 0) + 1,
                    date_derniere_tentative = NOW() 
                    WHERE Id_Uti = :id', [':id' => $Id_Uti]);

                // Récupérer le nombre de tentatives restantes
                $tentativesRestantes = 5 - ((isset($userData[0]['nb_tentatives_echec']) ? $userData[0]['nb_tentatives_echec'] : 0) + 1);
                $_SESSION['erreur'] = $htmlMauvaisMdp . $tentativesRestantes . $htmlTentatives;
            }
        } else {
            $_SESSION['erreur'] = $htmlErreurMaxReponsesAtteintes;
        }
    }
} catch (Exception $e) {
    // Handle any exceptions
    echo "An error occurred: " . $e->getMessage();
}
?>