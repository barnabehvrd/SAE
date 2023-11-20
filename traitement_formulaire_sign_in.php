<?php
// Connexion à la base de données 
$utilisateur = "root";
$serveur = "localhost";
$motdepasse = "";
$basededonnees = "sae3";

// Récupération des données du formulaire
$pwd = $_POST['pwd'];
$Mail_Uti = $_POST['mail'];

// Création de la session
session_start();

$connexion = new mysqli($serveur, $utilisateur, $motdepasse, $basededonnees);

// Vérification de la connexion
if ($connexion->connect_error) {
    die("Connection failed: " . $connexion->connect_error);
}

// Récupération de l'ID utilisateur
$requete = 'SELECT Id_Uti FROM utilisateur WHERE utilisateur.Mail_Uti=?';
$stmt = $connexion->prepare($requete);
$stmt->bind_param("s", $Mail_Uti); // "s" indique que la valeur est une chaîne de caractères
$stmt->execute();
$stmt->bind_result($Id_Uti);
$stmt->fetch();
$stmt->close();
$connexion->close();
$connexion = new mysqli($serveur, $utilisateur, $motdepasse, $basededonnees);
$sql = "CALL verifMotDePasse(?, ?)";
// Vérification de la connexion
if ($connexion->connect_error) {
    die("Connection failed: " . $connexion->connect_error);
}
var_dump($Id_Uti);
var_dump($sql);
var_dump($pwd);
$stmt = $mysqli->prepare($sql);
// Appel de la procédure stockée
$stmt->bind_param("is", $Id_Uti, $pwd); // "is" indique que le premier paramètre est une chaîne de caractères et le deuxième est un entier
if ($stmt->execute()) {
    // Récupérer le résultat de la procédure stockée (paramètre de sortie)
    $stmt->bind_result($parametreSortie);

    // Vérifier si la procédure stockée a retourné des résultats
    if ($stmt->fetch()) {
        // Afficher la valeur récupérée
        echo "La valeur récupérée est : " . $parametreSortie;
    } else {
        echo "La procédure stockée n'a retourné aucun résultat.";
    }
} else {
    // Gérer l'erreur d'exécution de la procédure stockée
    die("L'exécution de la procédure stockée a échoué : " . $stmt->error);
}


// Récupération du résultat
// Récupérer le résultat de la procédure stockée (paramètre de sortie)
$stmt->bind_result($parametreSortie);
var_dump($parametreSortie);
// Récupérer la valeur de la sortie
$stmt->fetch();

$stmt->close();
// Utilisation du résultat dans votre application
/*
if ($result == 1) {
    echo "Le mot de passe correspond.";
    header('Location: index.php');
    $_SESSION['Mail_Uti'] = $Mail_Uti;
    $_SESSION['Id_Uti'] = $Id_Uti;
}
 else {
    echo "Le mot de passe ne correspond pas.";
    header('Location: form_sign_in.php');
}
*/
// Fermeture de la connexion
$connexion->close();
?>
