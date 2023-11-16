<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reponse de mail</title>
    <link rel="stylesheet" href="../../styles/styles.css">

</head>
<body>

<?php

$nom = $_POST['nom'];
$email = $_POST['email'];
$sujet = $_POST['email'];
$message = $_POST['message'];

if (strlen($nom) < 2) {
    echo 'Vous devez avoir un nom valide';
} else if (preg_match('^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$', $email)) {
    echo 'Vous devez avoir une adresse email valide';
} else if (strlen($sujet) < 2) {
    echo 'Vous devez avoir un sujet valide';
} else if (strlen($message) < 10 || strlen($message) > 500) {
    echo "Votre message n'est pas de la bonne longueur";
} else {

    $textToSend = $nom . " vous a envoyé un message (adresse mail : " . $email . ") : <br><br>" . $message;

    $isSent = mail('dec.legal@orange.fr', $sujet, $textToSend);
    if ($isSent) {
        echo 'Email envoyé';
        echo "<br>";
        echo "<code>" . $textToSend . "</code>";
    } else {
        echo 'Erreur';
    }

}
?>
    
</body>
</html>
