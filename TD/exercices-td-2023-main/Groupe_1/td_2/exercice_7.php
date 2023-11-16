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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    if (empty($_POST['mystere'])){
        $mystere = random_int(1, 100);
        $tries = 1;
    }
    else {
        $mystere = $_POST['mystere'];
        $tries = $_POST['tries']+1;
        echo 'tries : ' . $tries . '<br>';
        
        if ($tries > 10) {
            echo "Perdu !" . '<br>';
        }
    }

    if (!empty($_POST['nombre'])) {
        $nombre = intval($_POST['nombre']);
        if ($nombre < $mystere) {
            echo "C'est plus";
        } elseif ($nombre > $mystere) {
            echo "C'est moins";
        } else {
            echo "Bravo";
        }
    }

    ?>


    <form method="POST" action="">
        <input type="text" name="nombre">
        <input type="hidden" name="mystere" value="<?= $mystere ?>">
        <input type="hidden" name="tries" value="<?= $tries ?>">
        <input type="submit" value="Envoyer">
    </form>

</body>

</html>