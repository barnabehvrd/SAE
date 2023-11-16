<?php

/**
 * 
 * Exercice 3
 * 
 * Écrivez un programme qui affiche tous les nombres de 1 à 100. 
 * Cependant, pour les multiples de 3, affichez "Fizz" à la place du nombre, et pour les multiples de 5, affichez "Buzz". 
 *  Pour les nombres qui sont à la fois des multiples de 3 et de 5, affichez "FizzBuzz".
 * 
 */

 for ($i = 1; $i <= 100; $i++) {
    if ($i % 3 == 0 && $i % 5 == 0) {
        echo "FizzBuzz ";
    } elseif ($i % 3 == 0) {
        echo "Fizz ";
    } elseif ($i % 5 == 0) {
        echo "Buzz ";
    } else {
        echo $i . ' ';
    }
}