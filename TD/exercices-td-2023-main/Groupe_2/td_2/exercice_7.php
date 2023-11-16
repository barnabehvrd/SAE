<?php

/**
 * 
 * Exercice 7
 * 
 * Objectif : L'objectif de cet exercice est de créer un jeu en PHP où l'utilisateur doit deviner un nombre aléatoire choisi par l'ordinateur
 * L'ordinateur choisit un nombre aléatoire entre 1 et 100 et le garde secret.
 * Le programme demande à l'utilisateur de deviner ce nombre.
 * L'utilisateur a un nombre limité de tentatives (par exemple, 10).
 * 
 * À chaque tentative de l'utilisateur, le programme doit fournir des indices pour aider l'utilisateur à deviner le nombre. Les indices sont les suivants :
 *  Si le nombre deviné est plus petit que le nombre secret, affichez "Trop petit".
 *  Si le nombre deviné est plus grand que le nombre secret, affichez "Trop grand".
 *  Si l'utilisateur devine le nombre, affichez "Bravo, vous avez deviné le nombre !" et terminez le jeu.
 * 
 * Le jeu se termine lorsque l'utilisateur devine le nombre correctement ou après avoir utilisé toutes ses tentatives. Dans ce dernier cas, affichez le nombre secret.
 * 
 */

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="../../packexo/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
</head>
<body>
    <header>
        <a href="javascript:history.back()">Retour</a>
        <h1>Bienvenue sur les exercices de PHP</h1>
        <a href="">Actualiser</a>
    </header>

    <?php
    $text_indication="Entrer un chiffre";
    if(isset($_POST["randomValue"])){
        $valeur_aleatoire = $_POST["randomValue"];
    }
    else {
        $valeur_aleatoire = rand(1, 100);        
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombre'])) {
        $essai = $_POST['nombre'];
        
        if ($essai == $valeur_aleatoire) {
            $text_indication ="Bravo, vous avez trouvé le juste prix !";
            $valeur_aleatoire = rand(1, 100);
        } elseif ($essai < $valeur_aleatoire) {
            $text_indication ="Trop petit !";
        } else {
            $text_indication ="Trop grand !";
        }
    }
    ?>

    <h2>Choisissez un nombre :</h2>

    <form action="" method="POST">
        Chiffre : <input type="number" name="nombre">
        <input type="hidden" name="randomValue" value="<?php echo $valeur_aleatoire; ?>">
        <input type="submit" value="Essayer">
    </form>
    <?php echo "<h3 id=\"text_indication\">$text_indication</h3>";?>

</body>
</html>
