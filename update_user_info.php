
<?php
$utilisateur = "root";
$serveur = "localhost";
$basededonnees = "sae3";
$connexion = new mysqli($serveur, $utilisateur, "", $basededonnees);
// Vérifiez la connexion
if ($connexion->connect_error) {
die("Erreur de connexion : " . $connexion->connect_error);  
}
// Préparez la requête SQL en utilisant des requêtes préparées pour des raisons de sécurité
$requete = 'SELECT Id_Uti FROM utilisateur WHERE utilisateur.Mail_Uti=?';
$stmt = $connexion->prepare($requete);
$stmt->bind_param("s", $_SESSION['Mail_Uti']); // "s" indique que la valeur est une chaîne de caractères
$stmt->execute();
$Id_Uti = $stmt->get_result();
echo($Id_Uti);
?>