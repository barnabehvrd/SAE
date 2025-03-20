<?php

require_once __DIR__ . '/../database/database.php';
use database\database;

$db = new database();

if(!isset($_SESSION)){
  session_start();
  }

if (isset($_POST["Id_Uti"])){
  $utilisateur=htmlspecialchars($_POST["Id_Uti"]);// l'admin supprime
  $delParAdmin=true;
}else{
  $utilisateur=htmlspecialchars($_SESSION["Id_Uti"]);
  $msg="?msg=compte supprimer";
  $delParAdmin=false;
}

  $returnIsProducteur = $db->select('CALL isProducteur(:utilisateur)', [':utilisateur' => $utilisateur]);
  $reponse=$returnIsProducteur[0]["result"];
    //var_dump($reponse);
    

    if ($reponse==NULL){
        $returnQueryGetProduitCommande = $db->select('SELECT Id_Produit, Qte_Produit_Commande FROM produits_commandes WHERE Id_Uti = :utilisateur', array('utilisateur' => $utilisateur));

        $iterateurProduit=0;
        $nbProduit=count($returnQueryGetProduitCommande);
        while ($iterateurProduit<$nbProduit){
          $Id_Produit=$returnQueryGetProduitCommande[$iterateurProduit]["Id_Produit"];
          $Qte_Produit_Commande=$returnQueryGetProduitCommande[$iterateurProduit]["Qte_Produit_Commande"];

          $bindUpdateProduit = $db->select('UPDATE PRODUIT SET Qte_Produit = Qte_Produit + :Qte_Produit_Commande WHERE Id_Produit = :Id_Produit', array('Qte_Produit_Commande' => $Qte_Produit_Commande, 'Id_Produit' => $Id_Produit));

          $test = $db->select('DELETE FROM CONTENU WHERE Id_Produit = :Id_Produit', array('Id_Produit' => $Id_Produit));
          
          $iterateurProduit++;
      }

        $test = $db->query('DELETE FROM COMMANDE WHERE Id_Uti= :utilisateur', array('utilisateur' => $utilisateur));


        $test = $db->query('DELETE FROM MESSAGE WHERE Emetteur= :utilisateur OR Destinataire=:utilisateur', array('utilisateur' => $utilisateur));


        $test = $db->query('DELETE FROM UTILISATEUR WHERE Id_Uti=:utilisateur', array('utilisateur' => $utilisateur));
    }
    else{


      $returnQueryIdProd = $db->select('SELECT Id_Prod FROM PRODUCTEUR WHERE Id_Uti=:Id_Uti', array('Id_Uti' => $utilisateur));

      $IdProd = $returnQueryIdProd[0]["Id_Prod"];

        $returnQueryGetProduitCommande = $db->select('SELECT Id_Produit FROM PRODUIT WHERE Id_Prod = :IdProd', array('IdProd' => $IdProd));

        $iterateurProduit=0;
        //var_dump($returnQueryGetProduitCommande);
        $nbProduit=count($returnQueryGetProduitCommande);
        while ($iterateurProduit<$nbProduit){
          $Id_Produit=$returnQueryGetProduitCommande[$iterateurProduit]["Id_Produit"];

          $delContenu = $db->query('DELETE FROM CONTENU WHERE Id_Produit = :Id_Produit', array('Id_Produit' => $Id_Produit));


          $delProduit = $db->query('DELETE FROM PRODUIT WHERE Id_Produit = :Id_Produit', array('Id_Produit' => $Id_Produit));

          $iterateurProduit++;
      }

        $delCommande = $db->query('DELETE FROM COMMANDE WHERE Id_Uti = :utilisateur', array('utilisateur' => $utilisateur));


        $delCommande=$db->query('DELETE FROM COMMANDE WHERE Id_Prod = :IdProd', array('IdProd' => $IdProd));


        $demMessage=$db->query('DELETE FROM MESSAGE WHERE Emetteur= :utilisateur OR Destinataire= :utilisateur', array('utilisateur' => $utilisateur));


        $delProducteur=$db->query('DELETE FROM PRODUCTEUR WHERE Id_Uti= :utilisateur', array('utilisateur' => $utilisateur));

        $delUtilisateur=$db->query('DELETE FROM UTILISATEUR WHERE Id_Uti= :utilisateur', array('utilisateur' => $utilisateur));
    }

    if ($delParAdmin==false){
      header('Location: log_out.php'.$msg);
    }
    else{
      header('Location: ../panel_admin.php');
    }

    
    
?>