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
    //var_dump($_POST);

    $Id_Produit=$_POST["IdProductAmMdifier"];
    $Nom_Produit=$_POST["nomProduit"];
    $Categorie=$_POST["categorie"];
    $Prix=$_POST["prix"];
    $Prix_Unite=$_POST["unitPrix"];
    $Quantite=$_POST["quantite"];
    $Quantite_Unite=$_POST["unitQuantite"];

    $updateProduit= "UPDATE PRODUIT SET Nom_Produit = ".$Nom_Produit.", Id_Type_Produit = ".$Categorie.", Qte_Produit = ".$Quantite.", Id_Unite_Stock = ".$Quantite_Unite.", Prix_Produit_Unitaire = ".$Prix.", Id_unite_Prix = ".$Prix_Unite." WHERE Id_Produit = ".$Id_Produit .";";
    $bdd->exec($updateProduit);

    header('Location: product_modification.php');
?>