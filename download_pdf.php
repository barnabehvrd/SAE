<?php
require('fpdf/fpdf.php'); // Assurez-vous d'ajuster le chemin vers le fichier FPDF

class MonPDF extends FPDF
{
    // En-tête
    function Header()
    {
        // Titre
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 5, 'Mon Document', 0, 1, 'C');

        // Ligne de séparation
        $this->Cell(0, 0, '', 'T');
        $this->Ln(5); // Saut de ligne réduit
    }

    // Pied de page
    function Footer()
    {
        // Numéro de page
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }
}

// Créer une instance de MonPDF
$pdf = new MonPDF();
$pdf->AddPage();

// Ajouter les valeurs
$pdf->SetFont('Arial', '', 12);

$pdf->Cell(0, 5, 'Producteur', 0, 1);
$pdf->Cell(0, 5, 'PROFESSION', 0, 1);
$pdf->Cell(0, 5, 'ADRESSE', 0, 1);

// Informations sur le client
$pdf->Cell(0, 5, 'Client CLIENT', 0, 0, 'R');
$pdf->Ln();
$pdf->Cell(0, 5, 'ADRESSE CLIENT', 0, 0, 'R');
$pdf->Ln(10); // Sauts de ligne réduits

// Informations sur la commande
$pdf->Cell(0, 5, 'COMMANDE XXX :', 0, 1);

// Tableau avec des produits générés aléatoirement
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 8, 'Produit', 1);
$pdf->Cell(40, 8, 'Prix Unitaire', 1);
$pdf->Cell(30, 8, 'Quantité', 1);
$pdf->Cell(40, 8, 'Prix', 1);
$pdf->Ln();

// Génération de produits aléatoires (exemple avec 3 produits)
$produits = [
    ['Produit 1', 10, 2],
    ['Produit 2', 15, 3],
    ['Produit 3', 20, 1],
];

$pdf->SetFont('Arial', '', 12);
foreach ($produits as $produit) {
    $pdf->Cell(40, 8, $produit[0], 1);
    $pdf->Cell(40, 8, '$' . number_format($produit[1], 2), 1);
    $pdf->Cell(30, 8, $produit[2], 1);
    $pdf->Cell(40, 8, '$' . number_format($produit[1] * $produit[2], 2), 1);
    $pdf->Ln();
}

$pdf->Ln(5); // Saut de ligne réduit

// Total
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(110, 8, 'TOTAL', 1);
$pdf->Cell(40, 8, '$' . number_format(array_sum(array_column($produits, 1)), 2), 1);
$pdf->Ln(); // Saut de ligne

// Impression
$pdf->Ln(5); // Saut de ligne réduit
$pdf->Cell(0, 5, 'IMPRESSION', 0, 1);

// Enregistrer le PDF dans un fichier temporaire
$nom_fichier = tempnam(sys_get_temp_dir(), 'pdf');
$pdf->Output($nom_fichier, 'F');

// Envoi des en-têtes pour le téléchargement
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="exemple.pdf"');
header('Content-Length: ' . filesize($nom_fichier));

// Envoyer le contenu du fichier
readfile($nom_fichier);

// Supprimer le fichier temporaire
unlink($nom_fichier);
?>