<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

function afficheMessages($id_user, $id_other_people){
    $bdd = dbConnect();
    $query = $bdd->query(('CALL listeMessage('.$id_user.', '.$id_other_people.');'));
    $messages = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach($messages as $message){
        echo('untruc');
    }
}

if (isset($_SESSION['Id_Uti'])){
    if (isset($_POST['Id_Interlocuteur'])){
        afficheMessages($_SESSION['Id_Uti'], $POST['Id_Interlocuteur']);
    }else {
        echo('Veuillez selectionner une conversation.');
    }
}else{
    echo('Vous n\'êtes pas connecté, vous ne devriez pas avoir accès à cette page.</br>
            Veuillez contacter un administrateur au plus tôt.');
}
    
?>