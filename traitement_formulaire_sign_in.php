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

// Stockage de l'adresse mail dans la session

// Récupération de l'ID utilisateur
$requete = 'SELECT Id_Uti FROM utilisateur WHERE utilisateur.Mail_Uti=?';
$stmt = $connexion->prepare($requete);
$stmt->bind_param("s", $_SESSION['Mail_Uti']); // "s" indique que la valeur est une chaîne de caractères
$stmt->execute();
$stmt->bind_result($Id_Uti);
$stmt->fetch();
$stmt->close();

// Appel de la procédure stockée
$sql = "CALL verifMotDePasse(?, ?)";
$stmt = $connexion->prepare($sql);
$stmt->bind_param("si", $pwd, $Id_Uti); // "si" indique que le premier paramètre est une chaîne de caractères et le deuxième est un entier
$stmt->execute();
$stmt->close();

// Récupération du résultat
$selectResult = $connexion->query('SELECT @result as result');
$result = $selectResult->fetch_assoc()['result'];

// Utilisation du résultat dans votre application
if ($result == 1) {
    echo "Le mot de passe correspond.";
    header('Location: index.php');
    $_SESSION['Mail_Uti'] = $Mail_Uti;
    $_SESSION['Id_Uti'] = $Id_Uti;
echo 
} else {
    echo "Le mot de passe ne correspond pas.";
    header('Location: form_sign_in.php');
}

// Fermeture de la connexion
$connexion->close();
?>
