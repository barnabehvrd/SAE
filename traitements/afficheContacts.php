<?php
if(!isset($_SESSION)){
    session_start();
}
    require "language.php" ;
?>
<?php

require_once 'database/database.php';
use database\database;


$msgPasConv = $htmlPasDeConversation;

function afficheContacts($id_user){
    global $msgPasConv;
    require "language.php" ;

    $db = new database();

    $contacts = $db->select('CALL listeContact( :id_user);', array('id_user' => $id_user));

    if (count($contacts)==0){
        echo $msgPasConv;
    }else{
        foreach($contacts as $contact){
            afficherContact($contact);
        }
    }    
}

function afficherContact($contact){
    $str = $contact['Prenom_Uti'].' '.$contact['Nom_Uti'];
    ?>
    <form method="get" class="w-100">
        <input type="submit" class="btn btn-light" value="<?php echo($str);?>">
        <input type="hidden" name="Id_Interlocuteur" value="<?php echo($contact['Id_Uti'])?>">
    </form>
    <?php
}

if (isset($_SESSION['Id_Uti'])){
    afficheContacts($_SESSION['Id_Uti']);
}



?>
