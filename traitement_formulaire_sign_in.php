<?php
// Connexion à la base de données 
$utilisateur = "root";
$serveur = "localhost";
//$motdepasse = "";
$basededonnees = "sae3";

// Récupération des données du formulaire
$pwd = $_POST['pwd'];
$Mail_Uti = $_POST['mail'];


$connexion = new mysqli($serveur, $utilisateur, "", $basededonnees);
//check pwd procedure 

// Création de la session
session_start();

// Stockage de l'adresse mail dans la session
$_SESSION['Mail_Uti'] = $Mail_Uti;$requete = 'SELECT Id_Uti FROM utilisateur WHERE utilisateur.Mail_Uti=?';
$stmt = $connexion->prepare($requete);
$stmt->bind_param("s", $_SESSION['Mail_Uti']); // "s" indique que la valeur est une chaîne de caractères
$stmt->execute();
// Récupérez le résultat
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    // Fetch the result as an associative array
    $row = $result->fetch_assoc();

    $_SESSION['Id_Uti'] = $row['Id_Uti'];
}

// Fermeture de la connexion
$connexion->close();
header('Location: index.php');
echo $_SESSION['Mail_Uti'];
?>
