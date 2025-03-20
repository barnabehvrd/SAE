<?php
require_once 'database/database.php';
use database\database;

$db = new database();


      $Id_Commande=$_POST["deleteValeur"];

      $returnQueryGetProduitCommande = $db->select('
        SELECT Id_Produit, Qte_Produit_Commande
        FROM produits_commandes
        WHERE Id_Commande = :Id_Commande',
        ['Id_Commande' => $Id_Commande]);


      $iterateurProduit=0;
      $nbProduit=count($returnQueryGetProduitCommande);
      while ($iterateurProduit<$nbProduit){
        $Id_Produit=$returnQueryGetProduitCommande[$iterateurProduit]["Id_Produit"];
        $Qte_Produit_Commande=$returnQueryGetProduitCommande[$iterateurProduit]["Qte_Produit_Commande"];

        $bindUpdateProduit -> $db->query('DELETE FROM CONTENU WHERE Id_Produit = :idProduct', ['idProduct' => $Id_Produit]);

        $iterateurProduit++;
      }

        $bindUpdateStatutCommande -> $db->query('UPDATE COMMANDE SET Id_Statut = 3 WHERE Id_Commande = :Id_Commande ;', ['Id_Commande' => $Id_Commande]);
    
    header('Location: achats.php?');
?>