<?php
     function dbConnect(){
        $host = 'localhost';
        $dbname = 'sae3';
        $user = 'root';
        $password = '';
        return new PDO('mysql:host='.$host.';dbname='.$dbname,$user,$password);
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