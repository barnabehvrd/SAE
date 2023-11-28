<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation de mot de passe</title>
</head>
<body>

    <h2>Réinitialisation de mot de passe</h2>

    <?php
    if (isset($_GET['result'])) {
        $result = $_GET['result'];
        if ($result === 'success') {
            echo '<p style="color: green;">Un code a été envoyé à votre adresse e-mail. Veuillez vérifier votre boîte de réception.</p>';
        } elseif ($result === 'failure') {
            echo '<p style="color: red;">L\'envoi du code a échoué. Veuillez réessayer.</p>';
        }
    }
    ?>

    <form action="traitement_form_forgot_pwd.php" method="post">
        <label for="email">Adresse e-mail :</label>
        <input type="email" id="email" name="email" required>

        <input type="submit" value="Envoyer le code">
    </form>

</body>
</html>
