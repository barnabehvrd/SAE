<?php
// Définit le type de contenu comme PDF
header('Content-Type: application/pdf');

// Définit le nom du fichier PDF
header('Content-Disposition: attachment; filename="fichier_vide.pdf"');

// Génère le contenu PDF (page vide)
echo '<html>';
echo '<body>';
echo '</body>';
echo '</html>';
?>