<?php

/**
 * 
 * Exercice 2
 * 
 * Créez un programme qui demande à l'utilisateur de saisir son âge. En fonction de l'âge (définit dans une variable), affichez un message indiquant s'il est mineur ou majeur
 * 
 */

$age = $_GET['age'];

if($age < 18){
    echo 'Tu est mineur !';
}else{
    echo 'Tu est majeur !';
}