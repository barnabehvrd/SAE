<?php

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si le fichier a été correctement téléchargé
   if (isset($_FILES["image"])) {
        // Spécifier le chemin du dossier de destination
        $targetDir = "home/inf2pj02/public_html/img/";
        // Obtenir le nom du fichier téléchargé
        $utilisateur = "inf2pj02";
        $serveur = "localhost";
        $motdepasse = "ahV4saerae";
        $basededonnees = "inf2pj_02";
        session_start();
        // Connect to database
        $Id_Uti=$_SESSION[0]["Id_Uti"];
        var_dump($Id_Uti);
        $bdd = new PDO('mysql:host=' . $serveur . ';dbname=' . $basededonnees, $utilisateur, $motdepasse);
        $requete = 'SELECT PRODUCTEUR.Id_Prod FROM PRODUCTEUR JOIN UTILISATEUR ON PRODUCTEUR.Id_Uti = UTILISATEUR.Id_Uti WHERE UTILISATEUR.Id_Uti='.$Id_Uti;
        echo ($requete);
        $Id_Prod = $bdd->query(('SELECT PRODUCTEUR.Id_Prod FROM PRODUCTEUR JOIN UTILISATEUR ON PRODUCTEUR.Id_Uti = UTILISATEUR.Id_Uti WHERE UTILISATEUR.Id_Uti='.$Id_Uti.';'));
        $fileName = $Id_Prod;
        // Créer le chemin complet du fichier de destination
        $targetPath = $targetDir . $fileName;
        // Déplacer le fichier téléchargé vers le dossier de destination
            move_uploaded_file($_FILES["image"]["tmp_name"], $targetPath);
            echo "L'image a été téléchargée avec succès.";

   } else {
        echo "Veuillez sélectionner une image.";
    }
}

?>

