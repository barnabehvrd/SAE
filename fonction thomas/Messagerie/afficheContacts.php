<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

function dbConnect(){
    $host = 'localhost';
    $dbname = 'sae3';
    $user = 'root';
    $password = '';

    $bdd = new PDO('mysql:host='.$host.';dbname='.$dbname,$user,$password);
    return $bdd;
}

function afficheContacts($id_user){
    $bdd = dbConnect();
    $query = $bdd->query(('CALL listeContact('.$id_user.');'));
    $contacts = $query->fetchAll(PDO::FETCH_ASSOC);
    var_dump($contacts);
    if (count($contacts)==0){
        echo('Vous n\'avez pas de conversation engagée pour le moment 😓');
    }else{
        foreach($contacts as $contact){
            afficherContact($contact);
        }
    }    
}

function afficherContact($contact){
    ?>
    <form method="post">
        <label><?php $contact['Prenom_Uti'].' '.$contact['Nom_Uti']?></label>
        <input type="hidden" id="Id_Interlocuteur" value="<?php $contact['Id_Uti']?>">
    </form>
    <?php
}

if (isset($_SESSION['Id_Uti'])){
    afficheContacts($_SESSION['Id_Uti']);
}
    
?>
