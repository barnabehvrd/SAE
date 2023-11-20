<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

function afficheMessages($id_user, $id_other_people){
    $bdd = dbConnect();
    $query = $bdd->query(('CALL conversation('.$id_user.', '.$id_other_people.');'));
    $messages = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach($messages as $message){
        afficheMessage($message);
    }
}

function afficheMessage($message){
    $contenu = $message['Contenu_Msg'];
    $date = $message['Date_Msg'];
    if ($message['Emetteur']==$_SESSION['Id_Uti']){
        echo('<a class=messageEnvoye>'.$contenu.'</a>');
    }else {
        echo('<a class=messageRecu>'.$contenu.'</a>');
    }
    
}

$_SESSION['Id_Uti'] = 2;

if (isset($_SESSION['Id_Uti'])){
    if (isset($_GET['Id_Interlocuteur'])){
        afficheMessages($_SESSION['Id_Uti'], $_GET['Id_Interlocuteur']);
    }else {
        echo('Veuillez selectionner une conversation.');
    }
}else{
    echo('Vous n\'êtes pas connecté, vous ne devriez pas avoir accès à cette page.</br>
            Veuillez contacter un administrateur au plus tôt.');
}
    
?>