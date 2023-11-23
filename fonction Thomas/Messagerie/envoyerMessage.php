<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

function envoyerMessage($id_user, $id_other_people, $content){
    $bdd = dbConnect();
    $query = $bdd->query(('CALL envoyerMessage('.$id_user.', '.$id_other_people.", '".$content."');"));
    
    
}

$_SESSION['Id_Uti'] = 2;

if (isset($_SESSION['Id_Uti'], $_GET['Id_Interlocuteur'], $_POST['content'])){
    if ($_POST['content']!=""){
        envoyerMessage($_SESSION['Id_Uti'], $_GET['Id_Interlocuteur'], $_POST['content']);
    }
    unset($_POST['content']);
    header("Refresh:0");
}
    
?>

BITE</a><img src="https://i.etsystatic.com/25272370/r/il/61a8e1/3840343796/il_570xN.3840343796_ja1h.jpg"><a>🖕