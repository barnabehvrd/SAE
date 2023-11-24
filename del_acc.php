<?php
     function dbConnect(){
        $host = 'localhost';
        $dbname = 'sae3';
        $user = 'root';
        $password = '';
        return new PDO('mysql:host='.$host.';dbname='.$dbname,$user,$password);
      }
      $bdd=dbConnect();

    // Start session
    session_start();
    // forcé à 7 ATTENTION
    //$utilisateur=$_SESSION["Id_Uti"];
    $utilisateur=12;

    
    $isProducteur = $bdd->query('CALL isProducteur('.$utilisateur.');');
	$returnIsProducteur = $isProducteur->fetchAll(PDO::FETCH_ASSOC);
	$reponse=$returnIsProducteur[0]["result"];
    //var_dump($reponse);
    

    if ($reponse==NULL){
        //echo 'non producteur';
        $bdd=dbConnect();
        $queryGetProduitCommande = $bdd->query(('SELECT Id_Produit, Qte_Produit_Commande FROM produits_commandes WHERE Id_Uti ='.$utilisateur.';'));
        $returnQueryGetProduitCommande = $queryGetProduitCommande->fetchAll(PDO::FETCH_ASSOC);
        $iterateurProduit=0;
        $nbProduit=count($returnQueryGetProduitCommande);
        while ($iterateurProduit<$nbProduit){
          $Id_Produit=$returnQueryGetProduitCommande[$iterateurProduit]["Id_Produit"];
          $Qte_Produit_Commande=$returnQueryGetProduitCommande[$iterateurProduit]["Qte_Produit_Commande"];
          $updateProduit="UPDATE PRODUIT SET Qte_Produit = Qte_Produit+".$Qte_Produit_Commande." WHERE Id_Produit = ".$Id_Produit .";";
          //$bdd->exec($updateProduit);
          echo $updateProduit;
  
          $iterateurProduit++;
      }
  
        //$bdd->query(('DELETE FROM CONTENU WHERE Id_Commande='.$Id_Commande.';'));
        //$bdd->query(('DELETE FROM COMMANDE WHERE Id_Commande='.$Id_Commande.';'));
    }
    else{
        //echo ' producteur';
    }
    
?>