<?php

// Vérifier si le dossier "/img/" existe, sinon le créer
if (!file_exists('img')) {
    mkdir('img', 0777, true);
}
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si le fichier a été correctement téléchargé
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        // Spécifier le chemin du dossier de destination
        $targetDir = "img/";

        // Obtenir le nom du fichier téléchargé
        $fileName = basename($_FILES["image"]["name"]);

        // Créer le chemin complet du fichier de destination
        $targetPath = $targetDir . $fileName;

        // Déplacer le fichier téléchargé vers le dossier de destination
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetPath)) {
            echo "L'image a été téléchargée avec succès.";
        } else {
            echo "Une erreur s'est produite lors du téléchargement de l'image.";
        }
    } else {
        echo "Veuillez sélectionner une image.";
    }
}
?>