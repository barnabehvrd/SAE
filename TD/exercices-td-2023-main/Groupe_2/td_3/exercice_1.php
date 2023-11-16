<?php

/**
 * 
 * Exercice 1
 * 
 * Créez un formulaire de contact qui valide les données du formulaire (nom, e-mail,sujet, message) côté serveur. 
 * 
 * Lorsque le formulaire est soumis, envoyez un courriel à l'adresse spécifiée dans le formulaire.
 * Après l’envoi du message, affichez le mail sur la page.
 * 
 * Tips : 
 * Utilisez la fonction mail(), htmlspecialchars() et strip_tags()
 * 
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        form{
            display:flex;
            flex-direction: column;
            align-items: stretch;
            justify-content: center;
            width: 50vw;
            margin-left: auto;
            margin-right: auto
        }
        form input,textarea{
            margin-top: 16px;
        }
    </style>
</head>
<body>

    <form action="" method="post">
        <h1>Contacts</h1>


        <input type="text" name="nom" id="nom" placeholder="votre nom" required>
        <input type="text" name="email" id="email" placeholder="votre email" required>
        <input type="text" name="subject" id="subject" placeholder="Sujet" required>
        <textarea name="message" id="message" placeholder="votre message" required></textarea>
        <input type="submit" value="Envoyer">
    </form>


    <?php
    if (!empty($_POST["nom"]) && !empty($_POST["email"]) && !empty($_POST["subject"]) && !empty($_POST["message"])) {
        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            echo '<br/>Votre nom :' . htmlspecialchars ($_POST['nom']);
            echo '<br/>Votre email:' . filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            echo '<br/>Votre sujet de message: '. htmlspecialchars ($_POST['subject']);
            echo '<br/>Votre message: '. htmlspecialchars ($_POST['message']);
        }else{
            echo 'email invalide !';
        }
    }
    ?>

</body>
</html>