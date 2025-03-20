<?php

require_once 'database/database.php';
use database\database;



error_reporting(E_ALL);
ini_set("display_errors", 1);

function envoyerMessage($id_user, $id_other_people, $content){
    $db = new database();

    $db->query('CALL envoyerMessage(:id_user, :id_other_people, :content);', array('id_user' => $id_user, 'id_other_people' => $id_other_people, 'content' => $content));
    
}


if (isset($_SESSION['Id_Uti'], $_GET['Id_Interlocuteur'], $_POST['content'])){
    if ($_POST['content']!=""){
        envoyerMessage($_SESSION['Id_Uti'], $_GET['Id_Interlocuteur'], htmlspecialchars($_POST['content']));
    }
    unset($_POST['content']);
    header("Refresh:0");
}
    
?>