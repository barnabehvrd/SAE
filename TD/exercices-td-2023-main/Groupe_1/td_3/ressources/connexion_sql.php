<?php

$host = 'localhost';
$dbname = 'films';
$user = 'root';
$password = 'root';

// Connnexion a la BDD
$bdd = new PDO('mysql:host='.$host.';dbname='.$dbname, $user, $password);

// $bdd devient un objet qui permet d'intéragir avec la BDD
echo var_dump($bdd);