<?php
    require "language.php" ;

require_once 'database/database.php';
use database\database;

$db = new database();

$email = $_POST["email"];
$_SESSION["mailTemp"]=$email;


$emailCount = $db->select('SELECT COUNT(*) AS count FROM UTILISATEUR WHERE Mail_Uti = :mail')[0]['count'];

if ($emailCount > 0) {  
    // Génération d'un code aléatoire à 6 chiffres
    $code = rand(100000, 999999);
    $_SESSION["code"]=$code;
    // Envoi du code par e-mail
    $subject = $htmlReinVotreMdp;
    $message = $htmlTonMdpEst.$code;
    $headers = "From: no-reply@letalenligne.com";

    // Envoi de l'e-mail
    $mailSent = mail($email, $subject, $message, $headers);

    // Redirection
    if ($mailSent) {
        $_POST['popup'] = 'mdp_oublie/code';
    } else {
        $_SESSION['erreur'] = $htmlErreurMailIncorrect;
    }
}else {
    $_SESSION['erreur'] = $htmlPasMailDansBDD;
}
?>
