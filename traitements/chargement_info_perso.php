<?php

require_once 'database/database.php';
use database\database;

$db = new database();

// Préparez la requête SQL en utilisant des requêtes préparées pour des raisons de sécurité
$requete = 'SELECT * FROM UTILISATEUR WHERE UTILISATEUR.Mail_Uti=?';


$result = $db->select('SELECT * FROM UTILISATEUR WHERE UTILISATEUR.Mail_Uti=:Mail_Uti', array('Mail_Uti' => $_SESSION['Mail_Uti']));
?>