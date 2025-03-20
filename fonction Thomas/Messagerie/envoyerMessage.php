<?php

require_once 'database/database.php';
use database\database;

function envoyerMessage($id_user, $id_other_people, $content){
    $db = new database();

    $db->select('CALL envoyerMessage (:id_user, :id_other_people, :content);', [
            'id_user' => $id_user,
            'id_other_people' => $id_other_people,
            'content' => $content
    ]);


    
    
}


if (isset($_SESSION['Id_Uti'], $_GET['Id_Interlocuteur'], $_POST['content'])){
    if ($_POST['content']!=""){
        envoyerMessage($_SESSION['Id_Uti'], $_GET['Id_Interlocuteur'], htmlspecialchars($_POST['content']));
    }
    unset($_POST['content']);
    header("Refresh:0");
}
    
?>