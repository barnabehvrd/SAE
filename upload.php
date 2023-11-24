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
            // Afficher un message d'erreur spécifique en fonction du code d'erreur
            switch ($_FILES["image"]["error"]) {
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    echo "Erreur : la taille du fichier est trop grande.";
                    break;
                case UPLOAD_ERR_PARTIAL:
                    echo "Erreur : le fichier n'a été que partiellement téléchargé.";
                    break;
                case UPLOAD_ERR_NO_FILE:
                    echo "Erreur : aucun fichier n'a été téléchargé.";
                    break;
                case UPLOAD_ERR_NO_TMP_DIR:
                    echo "Erreur : le dossier temporaire est manquant.";
                    break;
                case UPLOAD_ERR_CANT_WRITE:
                    echo "Erreur : échec de l'écriture du fichier sur le disque.";
                    break;
                case UPLOAD_ERR_EXTENSION:
                    echo "Erreur : une extension PHP a arrêté le téléchargement du fichier.";
                    break;
                default:
                    echo "Une erreur inconnue s'est produite lors du téléchargement de l'image.";
            }
        }
    } else {
        echo "Veuillez sélectionner une image.";
    }
}

?>