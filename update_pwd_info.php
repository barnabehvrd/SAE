<?php
$pwd1 = htmlspecialchars($_POST['pwd1']);
$pwd2 = htmlspecialchars($_POST['pwd2']);
if ($pwd1==$pwd2 && $pwd1!==null){

    $utilisateur = "inf2pj02";
    $serveur = "localhost";
    $motdepasse = "ahV4saerae";
    $basededonnees = "inf2pj_02";
    $bdd = new PDO('mysql:host='.$serveur.';dbname='.$basededonnees,$utilisateur,$motdepasse);
    session_start();
    // Préparez la requête SQL en utilisant des requêtes préparées pour des raisons de sécurité
    $update = "UPDATE UTILISATEUR SET Pwd_Uti = :pwd WHERE Mail_Uti = :mail";
    $stmt = $bdd->prepare($update);
    $stmt->bindParam(':pwd', $pwd1, PDO::PARAM_STR);
    $stmt->bindParam(':mail', $_SESSION["Mail_Uti"], PDO::PARAM_STR);
    $stmt->execute();
header('Location: user_informations.php');
}
?>