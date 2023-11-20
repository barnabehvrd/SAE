<?php
/*
// Connexion à la base de données 
$utilisateur = "root";
$serveur = "localhost";
$motdepasse = "";
$basededonnees = "sae3";


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
*/

// Récupération des données du formulaire
$pwd = $_POST['pwd'];
$Mail_Uti = $_POST['mail'];

// Création de la session
session_start();

$host = 'localhost';
$dbname = 'sae3';
$user = 'root';
$password = '';
$bdd = new PDO('mysql:host='.$host.';dbname='.$dbname,$user,$password);
$query = $bdd->query(('SELECT Id_Uti FROM utilisateur WHERE utilisateur.Mail_Uti=\''.$Mail_Uti.'\';'));
$Id_Uti = $query->fetchAll(PDO::FETCH_ASSOC);
$Id_Uti=($Id_Uti[0]["Id_Uti"]);
echo('CALL verifMotDePasse('.$Id_Uti.','. $pwd . ');');
$query = $bdd->query(('CALL verifMotDePasse(  '.$Id_Uti.','. $pwd . ');'));
$test = $query->fetchAll(PDO::FETCH_ASSOC);
var_dump($test[0]);

if ($test[0][1] == 1) {
    echo "Le mot de passe correspond.";
    header('Location: index.php');
    $_SESSION['Mail_Uti'] = $Mail_Uti;
    $_SESSION['Id_Uti'] = $Id_Uti;
}
 else {
    echo "Le mot de passe ne correspond pas.";
    header('Location: form_sign_in.php');
}

// Fermeture de la connexion
?>
