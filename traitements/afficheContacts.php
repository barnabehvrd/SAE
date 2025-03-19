<?php
    require "../language.php" ;

require_once 'database/database.php';
use database\database;

error_reporting(E_ALL);
ini_set("display_errors", 1);



function afficheContacts($id_user){
    $db = new database();

    $contacts = $db->select('CALL listeContact( :id_user);', array('id_user' => $id_user));

    if (count($contacts)==0){
        $test = $htmlPasDeConversation;
        echo($test);
    }else{
        foreach($contacts as $contact){
            afficherContact($contact);
        }
    }    
}

function afficherContact($contact){
    $str = $contact['Prenom_Uti'].' '.$contact['Nom_Uti'];
    ?>
    <form method="get">
        <input type="submit" value="<?php echo($str);?>">
        <input type="hidden" name="Id_Interlocuteur" value="<?php echo($contact['Id_Uti'])?>">
    </form>
    <?php
}

if (isset($_SESSION['Id_Uti'])){
    afficheContacts($_SESSION['Id_Uti']);
}



?>
