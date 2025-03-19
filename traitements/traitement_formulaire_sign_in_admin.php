<?php
// Error handling with try-catch block
try {
    // Retrieve form data
    $pwd = $_POST['pwd'];
    $Mail_Uti = $_POST['mail'];

    // Database connection
    $utilisateur = "inf2pj02";
    $serveur = "localhost";
    $motdepasse = "ahV4saerae";
    $basededonnees = "inf2pj_02";

    // Connect to database
    $bdd = new PDO('mysql:host=' . $serveur . ';dbname=' . $basededonnees, $utilisateur, $motdepasse);

    // Check if user email exists
    $queryIdUti = $bdd->query('SELECT Id_Uti FROM UTILISATEUR WHERE UTILISATEUR.Mail_Uti=\'' . $Mail_Uti . '\'');
    $returnQueryIdUti = $queryIdUti->fetchAll(PDO::FETCH_ASSOC);

    // Handle invalid email
    if ($returnQueryIdUti == NULL) {
        unset($Id_Uti);
        $_SESSION['erreur'] = $htmlAdresseMailInvalide;
    } else {
        // Extract user ID
        $Id_Uti = $returnQueryIdUti[0]["Id_Uti"];

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
        }

        // Vérifier si le nombre de tentatives est inférieur à 5
        if (!isset($userData['nb_tentatives_echec']) || $userData['nb_tentatives_echec'] < 5) {
            // MODIFICATION: Récupération du mot de passe hashé dans la base de données
            $queryPassword = $bdd->query('SELECT MotDePasse_Uti FROM UTILISATEUR WHERE Id_Uti = ' . $Id_Uti);
            $passwordData = $queryPassword->fetch(PDO::FETCH_ASSOC);

            // MODIFICATION: Vérification du mot de passe avec password_verify
            if ($passwordData && password_verify($pwd, $passwordData['MotDePasse_Uti'])) {
                // Mot de passe correct, réinitialiser le compteur
                $resetQuery = $bdd->query('UPDATE UTILISATEUR SET nb_tentatives_echec = 0 WHERE Id_Uti = ' . $Id_Uti);

                // Vérification si l'utilisateur est un administrateur
                $bdd3 = new PDO('mysql:host=' . $serveur . ';dbname=' . $basededonnees, $utilisateur, $motdepasse);
                $queryIdAdmin = $bdd3->query('SELECT Id_Uti FROM ADMINISTRATEUR WHERE ADMINISTRATEUR.Id_Uti=\'' . $Id_Uti . '\'');
                $returnQueryIdAdmin = $queryIdAdmin->fetchAll(PDO::FETCH_ASSOC); // Correction de la variable

                if (($returnQueryIdAdmin) == null) {
                    echo ("
                    <title>".$htmlErreur403."</title>
                    <h1>".$htmlErreur403."</h1>
                    <p>".$htmlPasAcces."</p>
                    ");
                } else {
                    $_SESSION['Mail_Uti'] = $Mail_Uti;
                    $_SESSION['Id_Uti'] = $Id_Uti;
                    $_SESSION['erreur'] = '';
                    header('Location: panel_admin.php');
                }
            } else {
                // Mot de passe incorrect, incrémenter le compteur
                $updateQuery = $bdd->query('UPDATE UTILISATEUR SET 
                    nb_tentatives_echec = nb_tentatives_echec + 1,
                    date_derniere_tentative = NOW() 
                    WHERE Id_Uti = ' . $Id_Uti);

                // Récupérer le nombre de tentatives restantes
                $tentativesRestantes = 5 - (($userData['nb_tentatives_echec'] ?? 0) + 1);
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