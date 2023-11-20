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

$host = 'localhost';
$dbname = 'sae3';
$user = 'root';
$password = '';
$bdd = new PDO('mysql:host='.$host.';dbname='.$dbname,$user,$password);


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
