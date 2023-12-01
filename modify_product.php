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
    $Id_Produit=$_POST["IdProductAModifier"];
    $Nom_Produit=$_POST["nomProduit"];
    $Categorie=$_POST["categorie"];
    $Prix=$_POST["prix"];
    $Prix_Unite=$_POST["unitPrix"];
    $Quantite=$_POST["quantite"];
    $Quantite_Unite=$_POST["unitQuantite"];

    $updateProduit= "UPDATE PRODUIT SET Nom_Produit = '".$Nom_Produit."', Id_Type_Produit = ".$Categorie.", Qte_Produit = ".$Quantite.", Id_Unite_Stock = ".$Quantite_Unite.", Prix_Produit_Unitaire = ".$Prix.", Id_unite_Prix = ".$Prix_Unite." WHERE Id_Produit = ".$Id_Produit .";";
    $bdd->exec($updateProduit);


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
        session_start();


        // Obtenir l'extension du fichie
        $extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);

        // Utiliser l'extension dans le nouveau nom du fichier
        $newFileName = $_SESSION["Id_Produit"] . '.' . $extension;

        // Créer le chemin complet du fichier de destination
        $targetPath = $targetDir . $newFileName;
        
        unlink( $targetPath ); 
        // Déplacer le fichier téléchargé vers le dossier de destination
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetPath)) {
            echo "<br>L'image a été téléchargée avec succès. Nouveau nom du fichier : $newFileName<br>";
        } else {
            echo "Le déplacement du fichier a échoué. Erreur : " . error_get_last()['message'] . "<br>";
            header('Location: mes_produits.php?erreur='. error_get_last()['message'] );
        }
    } else {
        echo "Veuillez sélectionner une image.<br>";
    }
    header('Location: mes_produits.php');    
}
    header('Location: mes_produits.php');
?>