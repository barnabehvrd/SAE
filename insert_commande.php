<?php


require_once 'database/database.php';
use database\database;

$db = new database();

  if(!isset($_SESSION)){
    session_start();
    }

    $Id_Uti=$_SESSION["Id_Uti"];
    $Url = $_GET;
    $Id_Prod=$Url["Id_Prod"];
    unset($Url["Id_Prod"]);

    // Connect to database
}
if(!isset($_SESSION)){
    session_start();
}
$Id_Uti=htmlspecialchars($_SESSION["Id_Uti"]);
$Url = $_GET;
$Id_Prod=htmlspecialchars($Url["Id_Prod"]);
unset($Url["Id_Prod"]);


    $nbCommandes = $db->select('SELECT MAX(Id_Commande) FROM COMMANDE;')[0]["MAX(Id_Commande)"]+1;

    $bindInsertionCommande = $db->query('INSERT INTO COMMANDE (Id_Commande, Id_Statut, Id_Prod, Id_Uti) VALUES (:nbCommandes, 1, :Id_Prod, :Id_Uti)', [
        'nbCommandes' => $nbCommandes,
        'Id_Prod' => $Id_Prod,
        'Id_Uti' => $Id_Uti
    ]);

    foreach ($Url as $produit => $quantite) {
      if ($quantite>0){

        $bindInsertionProduit = $db->query('INSERT INTO CONTENU (Id_Commande, Id_Produit, Qte_Produit_Commande, Num_Produit_Commande) VALUES (:nbCommandes, :produit, :quantite, :i)', [
            'nbCommandes' => $nbCommandes,
            'produit' => $produit,
            'quantite' => $quantite,
            'i' => $i
        ]);

        $bindUpdateProduit = $db->query('UPDATE PRODUIT SET Qte_Produit = Qte_Produit - :quantite WHERE Id_Produit = :produit', [
            'quantite' => $quantite,
            'produit' => $produit
        ]);


      }
    }
header('Location: achats.php');
?>