<?php
     function dbConnect(){
        $utilisateur = "inf2pj02";
        $serveur = "localhost";
        $motdepasse = "ahV4saerae";
        $basededonnees = "inf2pj_02";
        return new PDO('mysql:host=' . $serveur . ';dbname=' . $basededonnees, $utilisateur, $motdepasse);
        }

    session_start();
    $Id_Uti=$_SESSION["Id_Uti"];
    $bdd=dbConnect();
    $queryNbProduits = $bdd->query(('SELECT MAX(Id_Produit) FROM PRODUIT;'));
    $returnqueryNbProduits = $queryNbProduits->fetchAll(PDO::FETCH_ASSOC);
    $nbProduits = $returnqueryNbProduits[0]["MAX(Id_Produit)"]+1;
    $queryIdProd = $bdd->query(('SELECT Id_Prod FROM PRODUCTEUR WHERE Id_Uti='.$Id_Uti.';'));
    $returnQueryIdProd = $queryIdProd->fetchAll(PDO::FETCH_ASSOC);
    $IdProd = $returnQueryIdProd[0]["Id_Prod"];
    $Nom_Produit=$_POST["nomProduit"];
    $Type_De_Produit=$_POST["categorie"];
    $Prix=$_POST["prix"];
    $Unite_Prix=$_POST["unitPrix"];
    $Quantite=$_POST["quantite"];
    $Unite_Quantite=$_POST["unitQuantite"];
    
    
    $insertionProduit = "INSERT INTO PRODUIT (Id_Produit, Nom_Produit, Id_Type_Produit, Id_Prod, Qte_Produit, Id_Unite_Stock, Prix_Produit_Unitaire, Id_Unite_Prix) VALUES (".$nbProduits.", '".$Nom_Produit."', ".$Type_De_Produit.", ".$IdProd.", ".$Quantite.", ".$Unite_Quantite.", ".$Prix.", ".$Unite_Prix.");";
    echo $insertionProduit;
    //echo '<br>';
    //var_dump($_SESSION);
    
    $bdd->query($insertionProduit);
    header('Location: insert_product_picture.php');
?>


