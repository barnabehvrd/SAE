<?php
    function dbConnect(){
        $host = 'localhost';
        $dbname = 'sae3';
        $user = 'root';
        $password = '';
        return new PDO('mysql:host='.$host.';dbname='.$dbname,$user,$password);
    }

    $bdd=dbConnect();
    $queryNbProduits = $bdd->query(('SELECT MAX(Id_Produit) FROM PRODUIT;'));
    $returnqueryNbProduits = $queryNbProduits->fetchAll(PDO::FETCH_ASSOC);
    $nbProduits = $returnqueryNbProduits[0]["MAX(Id_Produit)"]+1;

    session_start();
    $Id_Uti=$_SESSION["Id_Uti"];
    $Nom_Produit=$_POST["nomProduit"];
    $Type_De_Produit=$_POST["categorie"];
    $Prix=$_POST["prix"];
    $Unite_Prix=$_POST["unitPrix"];
    $Quantite=$_POST["quantite"];
    $Unite_Quantite=$_POST["unitQuantite"];
    
    
    $insertionProduit = "INSERT INTO PRODUIT (Id_Produit, Nom_Produit, Id_Type_Produit, Id_Prod, Qte_Produit, Id_Unite_Stock, Prix_Produit_Unitaire, Id_Unite_Prix) VALUES (".$nbProduits.", '".$Nom_Produit."', ".$Type_De_Produit.", ".$Id_Uti.", ".$Quantite.", ".$Unite_Quantite.", ".$Prix.", ".$Unite_Prix.");";
    //echo $insertionProduit;
    
    $bdd->query($insertionProduit);
    header('Location: mes_produits.php');
?>


