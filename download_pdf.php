<?php
// Définir le type de contenu comme PDF
header('Content-Type: application/pdf');

// Indiquer que le contenu sera téléchargé en tant que fichier PDF avec le nom 'output.pdf'
header('Content-Disposition: inline; filename=output.pdf');

// Générer le contenu PDF en utilisant des balises HTML
echo '<html>
        <head>
            <title>Mon PDF</title>
        </head>
        <body>
            <h1>Mon PDF</h1>
            <p>Ceci est le contenu du PDF généré depuis PHP.</p>
        </body>
      </html>';
?>