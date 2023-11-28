<?php
// Définit le type de contenu comme PDF
header('Content-Type: application/pdf');

// Définit le nom du fichier PDF
header('Content-Disposition: attachment; filename="commande.pdf"');

// Génère le contenu PDF (page vide)
?>
<html>
<head><style>body {font-family: Arial, sans-serif;}</style></head>
<body>
    Ceci est en test;
</body>
</html>
