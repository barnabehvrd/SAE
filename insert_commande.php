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
    $nbCommandes = $returnqueryNbCommandes[0]["MAX(Id_Commande)"];
    $insertionCommande = "INSERT INTO COMMANDE (Id_Commande, Id_Statut, Id_Prod, Id_Uti) VALUES ($nbCommandes, 1, $Id_Prod, $Id_Uti);";
    echo $nbCommandes;
    foreach ($Url as $produit => $quantite) {

        
        
        
    }


//header('Location: commandes.php?Id_Prod=314');
?>