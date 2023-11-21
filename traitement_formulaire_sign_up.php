<?php
// Connexion à la base de données (remplacez ces valeurs par les vôtres)
$utilisateur = "root";
$serveur = "localhost";
//$motdepasse = "root";
$basededonnees = "sae3";


// Récupération des données du formulaire
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$adresse = $_POST['adresse'];
$pwd = $_POST['pwd'];
$Mail_Uti = $_POST['mail'];
$producteur_check = isset($_POST['producteur_box']) ? $_POST['producteur_box'] : '';
if ($producteur_check=='on'){
    $_SESSION["is_producteur"]= true;
}
var_dump($producteur_check);
$connexion = new mysqli($serveur, $utilisateur, $motdepasse, $basededonnees);
// Récupération de la valeur maximum de Id_Uti
$requete = "SELECT MAX(Id_Uti) AS id_max FROM utilisateur";
$resultat = $connexion->query($requete);
$id_max = $resultat->fetch_assoc()['id_max'];

// Incrémentation de la valeur de $iduti
$iduti = $id_max + 1;
// Requête SQL d'insertion
$insertion = "INSERT INTO utilisateur (Id_Uti, Prenom_Uti, Nom_Uti, Adr_Uti, Pwd_Uti, Mail_Uti) VALUES ('$iduti', '$prenom', '$nom', '$adresse', '$pwd', '$Mail_Uti');";


// Exécution de la requête
if ($connexion->query($insertion) === TRUE) {
	
	
    echo "Enregistrement réussi.";

} else {
    echo "Erreur : " . $insertion . "<br>" . $connexion->error;
}

// Fermeture de la connexion
$connexion->close();
//header('Location: index.php');

?>