<?php

/**
 * 
 * Exercice 6
 * 
 * Écrivez une fonction qui vérifie si une chaîne de caractères est un palindrome (elle se lit de la même manière de gauche à droite et de droite à gauche). Affichez le résultat.
 * 
 */

 include('exercice_5.php');

 function isPalindrome($string){
    $string = strtolower($string);
    return $string === inverser_chaine($stirng);
 }