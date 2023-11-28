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
      $Id_Commande=$_POST["deleteValeur"];

      $queryGetProduitCommande = $bdd->query(('SELECT Id_Produit, Qte_Produit_Commande FROM produits_commandes  WHERE Id_Commande ='.$Id_Commande.';'));
      $returnQueryGetProduitCommande = $queryGetProduitCommande->fetchAll(PDO::FETCH_ASSOC);
      $iterateurProduit=0;
      $nbProduit=count($returnQueryGetProduitCommande);
      while ($iterateurProduit<$nbProduit){
        $Id_Produit=$returnQueryGetProduitCommande[$iterateurProduit]["Id_Produit"];
        $Qte_Produit_Commande=$returnQueryGetProduitCommande[$iterateurProduit]["Qte_Produit_Commande"];
        $updateProduit="UPDATE PRODUIT SET Qte_Produit = Qte_Produit+".$Qte_Produit_Commande." WHERE Id_Produit = ".$Id_Produit .";";
        $bdd->exec($updateProduit);

        $iterateurProduit++;
      }
      $updateStatutCommande="UPDATE COMMANDE SET Statut_Commande = 3 WHERE Id_Commande = ".$Id_Commande .";";
      $bdd->exec($updateStatutCommande);

      //$bdd->query(('DELETE FROM CONTENU WHERE Id_Commande='.$Id_Commande.';'));
      //$bdd->query(('DELETE FROM COMMANDE WHERE Id_Commande='.$Id_Commande.';'));
      //echo 'DELETE FROM COMMANDE WHERE Id_Commande='.$Id_Commande.';';
    
    header('Location: commandes.php?');
?>