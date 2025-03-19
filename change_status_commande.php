<?php

require_once 'database/database.php';
use database\database;

$db = new database();

      var_dump($_POST);

      $Id_Statut=$_POST["categorie"];
      $Id_Commande=$_POST["idCommande"];

      if ($Id_Statut==NULL){
        //rien ne se passe
        header('Location: delivery.php?');
      }

      else if ($Id_Statut==3){

          $bindUpdateCommande = $db->query('UPDATE COMMANDE SET Id_Statut = :Id_Statut WHERE Id_Commande = :Id_Commande', [
            'Id_Statut' => $Id_Statut,
            'Id_Commande' => $Id_Commande
          ]);

        $returnQueryGetProduitCommande = $db->query('SELECT Id_Produit, Qte_Produit_Commande FROM produits_commandes  WHERE Id_Commande = :Id_Commande', [
          'Id_Commande' => $Id_Commande
        ]);

        $iterateurProduit=0;
        $nbProduit=count($returnQueryGetProduitCommande);


        while ($iterateurProduit<$nbProduit){
          $Id_Produit=$returnQueryGetProduitCommande[$iterateurProduit]["Id_Produit"];
          $Qte_Produit_Commande=$returnQueryGetProduitCommande[$iterateurProduit]["Qte_Produit_Commande"];

          $db->query('UPDATE PRODUIT SET Qte_Produit = Qte_Produit + :Qte_Produit_Commande WHERE Id_Produit = :Id_Produit', [
            'Qte_Produit_Commande' => $Qte_Produit_Commande,
            'Id_Produit' => $Id_Produit
          ]);

        }
      }

      else{
        //reste, on insert

        $db->query('UPDATE COMMANDE SET Id_Statut = :Id_Statut WHERE Id_Commande = :Id_Commande', [
          'Id_Statut' => $Id_Statut,
          'Id_Commande' => $Id_Commande
        ]);

        /*echo '<br>';
        echo $updateCommande;
        echo '<br>';
        echo $Id_Statut;
        echo '<br>';
        echo $Id_Commande;*/
      }
    header('Location: delivery.php?');
?>