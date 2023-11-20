<?php

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
