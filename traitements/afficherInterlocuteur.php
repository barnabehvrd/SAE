<?php

require_once 'database/database.php';
use database\database;

$db = new database();

if (isset($_GET['Id_Interlocuteur'])){

    $interlocuteur = $db->select('CALL isProducteur(:Id_Interlocuteur);', array('Id_Interlocuteur' => $_GET['Id_Interlocuteur']));

    echo ($interlocuteur[0]['Nom_Uti'].' '.$interlocuteur[0]['Prenom_Uti'].($interlocuteur[0]['result']));

}

?>