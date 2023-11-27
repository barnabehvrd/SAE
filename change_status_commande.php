<?php
     function dbConnect(){
        $host = 'localhost';
        $dbname = 'sae3';
        $user = 'root';
        $password = '';
        return new PDO('mysql:host='.$host.';dbname='.$dbname,$user,$password);
      }
      $bdd=dbConnect();
      var_dump($_POST);

      $Id_Statut=$_POST["categorie"];
      $Id_Commande=$_POST["idCommande"];

      if ($Id_Statut==0){
        //rien ne se passe
      }
      else if ($Id_Statut==3){
        // annulation donc on rend les produits et le producteur ne voit plus la commande
        
      }
      else{
        //reste, on insert
        $updateCommande="UPDATE COMMANDE SET Id_Statut = ".$Id_Statut." WHERE Id_Commande = ".$Id_Commande .";";
        $bdd->exec($updateCommande);
      }
    
    header('Location: delivery.php?');
?>