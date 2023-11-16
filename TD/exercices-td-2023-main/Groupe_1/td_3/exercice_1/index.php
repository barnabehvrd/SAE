<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de contact</title>
            <link rel="stylesheet" href="../../styles/styles.css">

</head>
<body>
    <div class="center">
    <h3>Formulaire de contact</h3>    
    <form action="sendForm.php" method="POST" class="vertical">
        <input type="text" placeholder="Nom" name="nom">
        <input type="email" placeholder="Adresse mail" name="email">
        <input type="text" placeholder="Sujet" name="sujet">
        <textarea placeholder="Ecrivez votre message ici" name="message"></textarea>
        <input type="submit" value="Envoyer">
    </form>

    </div>
    
</body>
</html>