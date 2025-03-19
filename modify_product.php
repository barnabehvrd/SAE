<?php

    require_once 'database/database.php';
    use database\database;

    $db = new database();

    //var_dump($_POST);
    $Id_Produit = htmlspecialchars($_POST["IdProductAModifier"]);
    $Nom_Produit = htmlspecialchars($_POST["nomProduit"]);
    $Categorie = htmlspecialchars($_POST["categorie"]);
    $Prix = htmlspecialchars($_POST["prix"]);
    $Prix_Unite = htmlspecialchars($_POST["unitPrix"]);
    $Quantite = htmlspecialchars($_POST["quantite"]);
    $Quantite_Unite = htmlspecialchars($_POST["unitQuantite"]);


    $db->query('UPDATE PRODUIT SET Nom_Produit = :Nom_Produit, Id_Type_Produit = :Categorie, Qte_Produit = :Quantite, Id_Unite_Stock = :Quantite_Unite, Prix_Produit_Unitaire = :Prix, Id_unite_Prix = :Prix_Unite WHERE Id_Produit = :Id_Produit', [
        'Nom_Produit' => $Nom_Produit,
        'Categorie' => $Categorie,
        'Quantite' => $Quantite,
        'Quantite_Unite' => $Quantite_Unite,
        'Prix' => $Prix,
        'Prix_Unite' => $Prix_Unite,
        'Id_Produit' => $Id_Produit
    ]);

    //modification de l'image
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si le fichier a été correctement téléchargé
    if (isset($_FILES["image"])) {
        // Spécifier le chemin du dossier de destination
        $targetDir = __DIR__ . "/img_produit/";
        // Obtenir le nom du fichier téléchargé
        $utilisateur = "inf2pj02";
        $serveur = "localhost";
        $motdepasse = "ahV4saerae";
        $basededonnees = "inf2pj_02";
        if(!isset($_SESSION)){
            session_start();
            }


        // Obtenir l'extension du fichie
        $extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);

        // Utiliser l'extension dans le nouveau nom du fichier
        $newFileName = $_SESSION["Id_Produit"] . '.' . $extension;

        // Créer le chemin complet du fichier de destination
        $targetPath = $targetDir . $newFileName;
        
        unlink( $targetPath ); 
        // Déplacer le fichier téléchargé vers le dossier de destination
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetPath)) {
            echo "<br>' $htmlImgTelecSucces  $newFileName<br>";
        } else {
            echo $htmlImgTelecRate . error_get_last()['message'] . "<br>";
            header('Location: mes_produits.php?erreur='. error_get_last()['message'] );
        }
    } else {
        echo $htmlSelecImg."<br>";
    }
    header('Location: produits.php');    
}
    header('Location: produits.php');
?>