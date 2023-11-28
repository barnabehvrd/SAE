<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validation du Code</title>
</head>
<body>

    <h2>Validation du Code</h2>

    <?php /*
    if (isset($_GET['result'])) {
        $result = $_GET['result'];
        if ($result === 'success') {
            echo '<p style="color: green;">un code vous a été envoyer par mail</p>';
        } elseif ($result === 'failure') {
            echo '<p style="color: red;">Le code n\'a pas pu etre envoyer a votre adresse mail si le problème perssiste contacter un administratueur </p>';
        }elseif ($result === 'failure1') {
            echo '<p style="color: red;">le code inscrit est mauvais vous aller pouvoir en générer un nouveau</p>';
            sleep(10);
            header("Location: form_code.php?");
        }
    }*/
    ?>

    <form action="traitement_code.php" method="post">
        <label for="code">Code de réinitialisation :</label>
        <input type="text" id="code" name="code" required>

        <input type="submit" value="Valider le code">
    </form>

</body>
</html>
