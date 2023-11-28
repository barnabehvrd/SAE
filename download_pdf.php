<?php
// Définit le type de contenu comme PDF
header('Content-Type: application/pdf');

// Définit le nom du fichier PDF
header('Content-Disposition: attachment; filename="donnees_aleatoires.pdf"');

// Génère le contenu PDF avec des données aléatoires
echo '<html>';
echo '<head><style>body {font-family: Arial, sans-serif;}</style></head>';
echo '<body>';
echo '<h1>Données Aléatoires</h1>';
echo '<p>Nom: ' . generateRandomString() . '</p>';
echo '<p>Email: ' . generateRandomEmail() . '</p>';
echo '</body>';
echo '</html>';

// Fonction pour générer une chaîne aléatoire
function generateRandomString($length = 10) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

// Fonction pour générer une adresse email aléatoire
function generateRandomEmail() {
    $domains = array('example.com', 'domain.com', 'test.org');
    return generateRandomString() . '@' . $domains[rand(0, count($domains) - 1)];
}
?>