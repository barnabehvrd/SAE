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
      var_dump($_POST);

      $Id_Statut=$_POST["categorie"];
      $Id_Commande=$_POST["idCommande"];

      if ($Id_Statut==NULL){
        //rien ne se passe
        header('Location: delivery.php?');
      }
      else if ($Id_Statut==3){
        // annulation donc on rend les produits et le producteur ne voit plus la commande
        
      }
      else{
        //reste, on insert
        $updateCommande="UPDATE COMMANDE SET Id_Statut = ".$Id_Statut." WHERE Id_Commande = ".$Id_Commande .";";
        echo '<br>';
        echo $updateCommande;
        echo '<br>';
        echo $Id_Statut;
        echo '<br>';
        echo $Id_Commande;
        $bdd->exec($updateCommande);
      }
    
    header('Location: delivery.php?');
?>