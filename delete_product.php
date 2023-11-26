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
    
    header('Location: mes_produits.php?');
?>