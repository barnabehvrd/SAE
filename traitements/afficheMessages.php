<?php

require "language.php" ;

require_once 'database/database.php';
use database\database;

if(!isset($_SESSION)){
    session_start();
}

function afficheMessages($id_user, $id_other_people){
    $db = new database();

    $messages = $db->select('CALL conversation( :id_user, :id_other_people);', array('id_user' => $id_user, 'id_other_people' => $id_other_people));

    foreach($messages as $message){
        afficheMessage($message);
    }
}

function afficheMessage($message){
    $contenu = $message['Contenu_Msg'];
    $date = $message['Date_Msg'];
    if ($message['Emetteur']==$_SESSION['Id_Uti']){
        echo('<div class="messageEnvoye message"><p>'.$contenu.'</p></div>');
    }else {
        echo('<div class="messageRecu message"><p>'.$contenu.'</p></div>');
    }
    
}


if (isset($_SESSION['Id_Uti'])){
    if (isset($_GET['Id_Interlocuteur'])){
        afficheMessages($_SESSION['Id_Uti'], $_GET['Id_Interlocuteur']);
        $formDisabled=false;
    }else {
        echo($htmlSelectConversation);
        $formDisabled=true;
    }
}else{
    echo($htmlPasAccesPageContactAdmin);
    $formDisabled=true;
}
?>