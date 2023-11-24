<?php

// Start session
session_start();
// Database connection
$utilisateur = "inf2pj02";
$serveur = "localhost";
$motdepasse = "ahV4saerae";
$basededonnees = "inf2pj_02";
$Mail_Uti=$_SESSION["Mail_Uti"];
$Id_Uti=$_SESSION["Id_Uti"];
echo ($Mail_Uti);
// Connect to database
$bdd = new PDO('mysql:host=' . $serveur . ';dbname=' . $basededonnees, $utilisateur, $motdepasse);
// Check if user email exists
$query = $bdd->query('DELETE FROM COMMANDE WHERE UTILISATEUR.Mail_Uti=\'' . $Mail_Uti . '\'');
$query = $bdd->query('DELETE FROM UTILISATEUR WHERE UTILISATEUR.Mail_Uti=\'' . $Mail_Uti . '\'');
$Id_Uti = $query->fetchAll(PDO::FETCH_ASSOC);
?>