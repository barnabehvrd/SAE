<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uploadDir = 'https://la-projets.univ-lemans.fr/~inf2pj02/img/';
    $uploadFile = $uploadDir . basename($_FILES['image']['name']);
    $response = array();

    // Vérifier si le fichier est une image
    $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
    $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
    if (!in_array($imageFileType, $allowedExtensions)) {
        $response['message'] = 'Seules les images de type JPG, JPEG, PNG et GIF sont autorisées.';
    } else {
        // Déplacer le fichier vers le répertoire d'upload
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
            $response['message'] = 'L\'image a été téléchargée avec succès.';
            // Vous pouvez également enregistrer le chemin de l'image dans une base de données si nécessaire.
        } else {
            $response['message'] = 'Erreur lors du téléchargement de l\'image.';
        }
    }

    echo $response['message'];
} else {
    http_response_code(405); // Méthode non autorisée
    echo 'Méthode non autorisée';
}
?>
