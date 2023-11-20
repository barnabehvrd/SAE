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

function afficheMessages($id_user, $id_other_people){
    $bdd = dbConnect();
    $query = $bdd->query(('CALL listeMessage('.$id_user.', '.$id_other_people.');'));
    $messages = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach($messages as $message){
        echo('untruc');
    }
}

if (isset($_SESSION['Id_Uti'])){
    afficheMessages($_SESSION['Id_Uti'], $POST['Id_Dest']);
}
    
?>