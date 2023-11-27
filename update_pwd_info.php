<?php
$pwd1 = $_POST['pwd1'];
$pwd2 = $_POST['pwd2'];
if ($pwd1==$pwd2 && $pwd1!==null){

    $utilisateur = "inf2pj02";
    $serveur = "localhost";
    $motdepasse = "ahV4saerae";
    $basededonnees = "inf2pj_02";
    $bdd = new PDO('mysql:host='.$serveur.';dbname='.$basededonnees,$utilisateur,$motdepasse);
    session_start();
    // Préparez la requête SQL en utilisant des requêtes préparées pour des raisons de sécurité
    $update="UPDATE UTILISATEUR SET Pwd_Uti = '".$pwd1."' WHERE Mail_Uti = '".$_SESSION["Mail_Uti"] ."';";
    echo ($update);
    $bdd->exec($update);
header('Location: user_informations.php');
}
?>