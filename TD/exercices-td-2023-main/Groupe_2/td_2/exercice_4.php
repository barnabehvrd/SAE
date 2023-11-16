<?php

/**
 * 
 * Exercice 4
 * 
 * Écrivez une fonction qui calcule la factorielle d'un nombre donné par l'utilisateur. Ensuite, affichez le résultat.
 * 
 */

 // Sans recursivité

 function calculerFactorielle($n) {
    if ($n < 0) {
        return "La factorielle n'est définie que pour les entiers positifs.";
    } elseif ($n == 0) {
        return 1; // Factorielle de 0 est 1
    } else {
        $fact = 1;
        for ($i = 1; $i <= $n; $i++) {
            $fact *= $i;
        }
        return $fact;
    }
}

// Exemple d'utilisation :
$nombre = 5;
$resultat = calculerFactorielle($nombre);
echo "La factorielle de $nombre est $resultat";

// Avec recursivité

function calculerFactorielleR($n) {
    if ($n < 0) {
        return "La factorielle n'est définie que pour les entiers positifs.";
    } elseif ($n == 0) {
        return 1; // Cas de base : factorielle de 0 est 1
    } else {
        return $n * calculerFactorielleR($n - 1);
    }
}

// Exemple d'utilisation :
$nombre = 5;
$resultat = calculerFactorielleR($nombre);
echo "La factorielle de $nombre est $resultat";