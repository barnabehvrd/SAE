<?php

require_once 'database/database.php';
use database\database;

$db = new database();


$result = $db->select('SELECT * FROM UTILISATEUR WHERE UTILISATEUR.Mail_Uti=:Mail_Uti', array('Mail_Uti' => $_SESSION['Mail_Uti']));
?>