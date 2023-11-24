<?php
     function dbConnect(){
        $host = 'localhost';
        $dbname = 'sae3';
        $user = 'root';
        $password = '';
        return new PDO('mysql:host='.$host.';dbname='.$dbname,$user,$password);
      }

    session_start();
    $Id_Uti=$_SESSION["Id_Uti"];
    $Url = $_GET;
    $Id_Prod=$Url["Id_Prod"];
    unset($Url["Id_Prod"]);

    $i=1;

    $bdd=dbConnect();
    $queryNbCommandes = $bdd->query(('SELECT MAX(Id_Commande) FROM COMMANDE;'));
    $returnqueryNbCommandes = $queryNbCommandes->fetchAll(PDO::FETCH_ASSOC);
    $nbCommandes = $returnqueryNbCommandes[0]["MAX(Id_Commande)"]+1;
    $insertionCommande = "INSERT INTO COMMANDE (Id_Commande, Id_Statut, Id_Prod, Id_Uti) VALUES ($nbCommandes, 1, $Id_Prod, $Id_Uti);";

    $bdd->query($insertionCommande);

    foreach ($Url as $produit => $quantite) {
      if ($quantite>0){        
        $insertionProduit = "INSERT INTO CONTENU (Id_Commande, Id_Produit, Qte_Produit_Commande, Num_Produit_Commande) VALUES ($nbCommandes, $produit, $quantite, $i);";
        $bdd->query($insertionProduit);
        $updateProduit="UPDATE PRODUIT SET Qte_Produit = Qte_Produit-".$quantite." WHERE Id_Produit = ".$produit .";";
        $bdd->exec($updateProduit);
        $i++;}
    }
    
    header('Location: commandes.php?Id_Prod=314');
?>
