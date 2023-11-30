<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation de mot de passe</title>
</head>
<body>

    <h2>Réinitialisation de mot de passe</h2>

    <form action="traitement_form_forgot_pwd.php" method="post">
        <label for="email">Adresse e-mail :</label>
        <input type="email" id="email" pattern="[A-Za-z0-9._-]{1,20}@[A-Za-z0-9.-]{1,16}\.[A-Za-z]{1,4}" name="email" required>
        <input type="submit" value="Envoyer le code">
    </form>

</body>
</html>
