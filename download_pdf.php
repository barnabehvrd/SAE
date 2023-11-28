<?php
// Définir le type de contenu pour PDF
header('Content-Type: application/pdf');

// Spécifier le nom du fichier PDF
header('Content-Disposition: attachment; filename="exemple.pdf"');

// Générer le contenu PDF
echo '<!DOCTYPE html>
<html>
<head>
    <title>Exemple PDF</title>
</head>
<body>
    <h1>Contenu du PDF</h1>
    <p>Ceci est un exemple de fichier PDF généré en utilisant PHP sans bibliothèque externe.</p>
</body>
</html>';
?>