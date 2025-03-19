<?php

require_once 'database/database.php';
use database\database;

$db = new database();


      $Id_Produit=$_POST["deleteIdProduct"];

      $db->query('DELETE FROM CONTENU WHERE Id_Produit = :idProduct', ['idProduct' => $Id_Produit]);

      $db->query('DELETE FROM PRODUIT WHERE Id_Produit = :idProduct', ['idProduct' => $Id_Produit]);

      // suppression de l'image (path à changer sur le serveur !!!!)
      $imgpath = "img_produit/".$Id_Produit.".png";
      //echo $imgpath;
      unlink( $imgpath ); 
    header('Location: produits.php');
?>