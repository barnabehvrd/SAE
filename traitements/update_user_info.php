<?php
require_once 'database/database.php';
use database\database;
$db = new database();

if (isset($_POST['new_nom'], $_POST['new_prenom'], $_POST['rue'], $_POST['code'], $_POST['ville'], $_POST['pwd'])) {
    $adr = $_POST['rue'] .", ". $_POST['code']. " ".mb_strtoupper($_POST['ville']);

    // Hashage du mot de passe avec password_hash
    $hashed_password = password_hash($_POST['pwd'], PASSWORD_DEFAULT);

    // Utilisation de la classe database pour la mise à jour (de la branche main)
    $db->query('UPDATE UTILISATEUR SET Nom_Uti = :nom, Prenom_Uti = :prenom, Adr_Uti = :adr, Pwd_Uti = :pwd WHERE Mail_Uti = :mail',
        array(
            'nom' => $_POST['new_nom'],
            'prenom' => $_POST['new_prenom'],
            'adr' => $adr,
            'pwd' => $hashed_password, // Utilisation du mot de passe hashé
            'mail' => $_SESSION['Mail_Uti']
        ));
    } header('Location: ../index.php');
?>