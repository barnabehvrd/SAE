<?php
    require "language.php" ;

    require_once 'database/database.php';
    use database\database;

    $db = new database();
?>
<?php
    if(!isset($_SESSION)){
        session_start();
        }

    $Id_Uti=$_SESSION["Id_Uti"];

    $returnqueryNbProduits = $db->select('SELECT MAX(Id_Produit) FROM PRODUIT;');

    $nbProduits = $returnqueryNbProduits[0]["MAX(Id_Produit)"]+1;



    $returnQueryIdProd = $db->select('SELECT Id_Prod FROM PRODUCTEUR WHERE Id_Uti=:Id_Uti;', [
        'Id_Uti' => $Id_Uti
    ]);

    $IdProd = $returnQueryIdProd[0]["Id_Prod"];
    $Nom_Produit=$_POST["nomProduit"];
    $Type_De_Produit=$_POST["categorie"];
    $Prix=$_POST["prix"];
    $Unite_Prix=$_POST["unitPrix"];
    $Quantite=$_POST["quantite"];
    $Unite_Quantite=$_POST["unitQuantite"];

    //insertion de l'image
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

        // Obtenir l'extension du fichie
        $extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);

        // Utiliser l'extension dans le nouveau nom du fichier
        $newFileName = $nbProduits . '.' . $extension;

            // Créer le chemin complet du fichier de destination
            $newFileName = $nbProduits . '.' . $extension;
            $targetPath = $targetDir . $newFileName;

            // Vérifier si le fichier existe avant de le supprimer
            if (file_exists($targetPath)) {
                unlink($targetPath);
                echo $htmlSuppImgSucces.".<br>";
            }

            // Déplacer le fichier téléchargé vers le dossier de destination
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetPath)) {
                echo "<br>".$htmlImgTelecSucces, $newFileName."<br>";
            } else {
                echo $htmlImgTelecRate . error_get_last()['message'] . "<br>";
                header('Location: mes_produits.php?erreur='. error_get_last()['message']);
            }

    } else {
        echo $htmlSelecImg."<br>";
    }
    
}
    $_SESSION["Id_Produit"]=$nbProduits;


    $db->query("INSERT INTO PRODUIT (Id_Produit, Nom_Produit, Id_Type_Produit, Id_Prod, Qte_Produit, Id_Unite_Stock, Prix_Produit_Unitaire, Id_Unite_Prix) VALUES (:nbProduits, :Nom_Produit, :Type_De_Produit, :IdProd, :Quantite, :Unite_Quantite, :Prix, :Unite_Prix)", [
        'nbProduits' => $nbProduits,
        'Nom_Produit' => $Nom_Produit,
        'Type_De_Produit' => $Type_De_Produit,
        'IdProd' => $IdProd,
        'Quantite' => $Quantite,
        'Unite_Quantite' => $Unite_Quantite,
        'Prix' => $Prix,
        'Unite_Prix' => $Unite_Prix
    ]);

    header('Location: produits.php');
?>
