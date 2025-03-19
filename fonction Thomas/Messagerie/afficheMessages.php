<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once 'database/database.php';
use database\database;

function afficheMessages($id_user, $id_other_people){
    $db = new database();

    $db->select('CALL conversation(:id_user, :id_other_people);', [
            'id_user' => $id_user,
            'id_other_people' => $id_other_people
    ]);


}

function afficheMessage($message){
    $contenu = $message['Contenu_Msg'];
    $date = $message['Date_Msg'];
    if ($message['Emetteur']==$_SESSION['Id_Uti']){
        echo('<div><div class="messageEnvoye message"><a>'.$contenu.'</a></div></div>');
    }else {
        echo('<div><div class="messageRecu message"><a>'.$contenu.'</a></div></div>');
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