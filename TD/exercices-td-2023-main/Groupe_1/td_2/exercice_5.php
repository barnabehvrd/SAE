<?php

/**
 * 
 * Exercice 5
 * 
 * Créez une fonction qui prend une chaîne de caractères en entrée et retourne cette chaîne inversée (par exemple, "Hello" deviendrait "olleH").
 * 
 */

 function inverser_chaine($string){
    $nouvelle_chaine = '';
    $longueur_chaine = strlen($string);
    for($i = $longueur_chaine-1; $i >= 0; $i--){
        $nouvelle_chaine .= $string[$i];
    }
    return $nouvelle_chaine;
 }

 echo inverser_chaine('Hello !');
