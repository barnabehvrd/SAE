<?php

$host = 'localhost';
$dbname = 'films';
$user = 'root';
$password = 'root';

// Connnexion a la BDD
$bdd = new PDO('mysql:host='.$host.';dbname='.$dbname, $user, $password);

// Lire tout les films
$films_query = $bdd->query('SELECT * FROM films');
$films = $films_query->fetchAll(PDO::FETCH_ASSOC);

var_dump($films);



// Executer des reqûetes de sur la base 

$add_films_query = $bdd->prepare('INSERT INTO films (titre,genre,annee_sortie,realisateur) VALUES ("Avatar 2","Action","2022","James Cameron")');
$add_films_query_return = $add_films_query->execute();
