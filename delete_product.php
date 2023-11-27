<?php
     function dbConnect(){
      $utilisateur = "inf2pj02";
      $serveur = "localhost";
      $motdepasse = "ahV4saerae";
      $basededonnees = "inf2pj_02";
      // Connect to database
      return new PDO('mysql:host=' . $serveur . ';dbname=' . $basededonnees, $utilisateur, $motdepasse);
      }
      $bdd=dbConnect();
      $Id_Produit=$_POST["deleteIdProduct"];

      $bdd->query(('DELETE FROM CONTENU WHERE Id_Produit='.$Id_Produit.';'));
      $bdd->query(('DELETE FROM PRODUIT WHERE Id_Produit='.$Id_Produit.';'));

      // suppression de l'image (path à changer sur le serveur !!!!)
      $imgpath = "img_produit/".$Id_Produit.".png";
      //echo $imgpath;
      unlink( $imgpath ); 
    
    header('Location: mes_produits.php?');
?>